<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));
        $status = (string) $request->query('status', '');

        $messages = ContactMessage::query()
            ->with('user')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('subject', 'like', "%{$search}%");
                });
            })
            ->when(in_array($status, ContactMessage::statusValues(), true), fn ($query) => $query->where('status', $status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.messages.index', [
            'messages' => $messages,
            'search' => $search,
            'status' => $status,
            'statusOptions' => ContactMessage::statusOptions(),
            'newMessagesCount' => ContactMessage::where('status', ContactMessage::STATUS_NEW)->count(),
        ]);
    }

    public function show(ContactMessage $message): View
    {
        if ($message->status === ContactMessage::STATUS_NEW) {
            $message->markWithStatus(ContactMessage::STATUS_READ);
        }

        return view('admin.messages.show', [
            'message' => $message->fresh('user'),
            'statusOptions' => ContactMessage::statusOptions(),
            'newMessagesCount' => ContactMessage::where('status', ContactMessage::STATUS_NEW)->count(),
        ]);
    }

    public function updateStatus(Request $request, ContactMessage $message): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(ContactMessage::statusValues())],
        ]);

        $message->markWithStatus($validated['status']);

        return back()->with('success', __('Status da mensagem atualizado com sucesso.'));
    }
}
