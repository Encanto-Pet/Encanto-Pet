<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessageMail;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function create(): View
    {
        return view('contact');
    }

    public function adminCreate(): View
    {
        return view('admin.contact');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'subject' => ['required', 'string', 'max:160'],
            'message' => ['required', 'string', 'max:4000'],
        ]);

        $contactMessage = ContactMessage::create([
            ...$validated,
            'user_id' => $request->user()?->id,
            'status' => ContactMessage::STATUS_NEW,
        ]);

        try {
            Mail::to(config('contact.to'))->send(new ContactMessageMail($contactMessage));
        } catch (\Throwable $exception) {
            Log::warning('Contact message saved, but mail delivery failed.', [
                'contact_message_id' => $contactMessage->id,
                'error' => $exception->getMessage(),
            ]);
        }

        return back()->with('success', __('Mensagem enviada com sucesso.'));
    }
}
