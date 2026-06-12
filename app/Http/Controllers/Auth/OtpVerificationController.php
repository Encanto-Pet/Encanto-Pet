<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\EmailVerificationCode;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class OtpVerificationController extends Controller
{
    public function show(Request $request): RedirectResponse|View
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        $latestCode = $this->getActiveCode($user->id);

        if (! $latestCode) {
            $latestCode = $this->generateAndSend($user);
        }

        return view('auth.otp-verify', [
            'email'          => $user->email,
            'resendCooldown' => $this->resendCooldown($latestCode),
        ]);
    }

    public function verify(Request $request): RedirectResponse
    {
        $request->validate([
            'code' => ['required', 'string', 'size:6', 'regex:/^[0-9]{6}$/'],
        ]);

        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        $record = EmailVerificationCode::where('user_id', $user->id)
            ->whereNull('used_at')
            ->latest()
            ->first();

        if (! $record) {
            return back()->withErrors(['code' => 'Nenhum código ativo encontrado. Clique em "Reenviar email".']);
        }

        if ($record->isExpired()) {
            return back()->withErrors(['code' => 'Seu código expirou. Clique em "Reenviar email" para receber um novo.']);
        }

        if ($record->hasExceededAttempts()) {
            return back()->withErrors(['code' => 'Muitas tentativas incorretas. Clique em "Reenviar email" para receber um novo código.']);
        }

        if ($record->code !== $request->code) {
            $record->increment('attempts');
            $remaining = 5 - $record->fresh()->attempts;

            $message = $remaining > 0
                ? "Código inválido. Você tem {$remaining} tentativa(s) restante(s)."
                : 'Muitas tentativas incorretas. Clique em "Reenviar email" para receber um novo código.';

            return back()->withErrors(['code' => $message]);
        }

        $record->update(['used_at' => now()]);
        $user->markEmailAsVerified();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    public function resend(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        $latest = EmailVerificationCode::where('user_id', $user->id)
            ->latest()
            ->first();

        if ($latest && $latest->created_at->diffInSeconds(now()) < 60) {
            return back()->withErrors(['resend' => 'Aguarde 60 segundos antes de solicitar um novo código.']);
        }

        $this->generateAndSend($user);

        return back()->with('status', 'Um novo código foi enviado para o seu email!');
    }

    private function generateAndSend($user): EmailVerificationCode
    {
        EmailVerificationCode::where('user_id', $user->id)->delete();

        $code = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $record = EmailVerificationCode::create([
            'user_id'    => $user->id,
            'code'       => $code,
            'expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send(new OtpMail($code, $user->name));

        return $record;
    }

    private function getActiveCode(int $userId): ?EmailVerificationCode
    {
        return EmailVerificationCode::where('user_id', $userId)
            ->whereNull('used_at')
            ->where('expires_at', '>', now())
            ->where('attempts', '<', 5)
            ->latest()
            ->first();
    }

    private function resendCooldown(EmailVerificationCode $code): int
    {
        $secondsSinceCreation = (int) $code->created_at->diffInSeconds(now());

        return max(0, 60 - $secondsSinceCreation);
    }
}
