<?php

use App\Models\ContactMessage;
use App\Models\User;

it('shows contact messages in admin area with search filter and pagination', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $customer = User::factory()->create(['role' => 'user']);

    ContactMessage::create([
        'user_id' => $customer->id,
        'name' => 'Maria Cliente',
        'email' => 'maria@example.com',
        'subject' => 'Troca de produto',
        'message' => 'Quero trocar um produto.',
        'status' => ContactMessage::STATUS_NEW,
    ]);

    ContactMessage::create([
        'name' => 'Joao Cliente',
        'email' => 'joao@example.com',
        'subject' => 'Outro assunto',
        'message' => 'Mensagem qualquer.',
        'status' => ContactMessage::STATUS_READ,
    ]);

    $this->actingAs($admin)
        ->get(route('admin.messages.index', ['search' => 'maria']))
        ->assertOk()
        ->assertSee('Maria Cliente')
        ->assertSee('Troca de produto')
        ->assertDontSee('joao@example.com');
});

it('filters contact messages by status', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    ContactMessage::create([
        'name' => 'Mensagem Nova',
        'email' => 'nova@example.com',
        'subject' => 'Nova',
        'message' => 'Texto',
        'status' => ContactMessage::STATUS_NEW,
    ]);

    ContactMessage::create([
        'name' => 'Mensagem Arquivada',
        'email' => 'arquivada@example.com',
        'subject' => 'Arquivada',
        'message' => 'Texto',
        'status' => ContactMessage::STATUS_ARCHIVED,
    ]);

    $this->actingAs($admin)
        ->get(route('admin.messages.index', ['status' => ContactMessage::STATUS_ARCHIVED]))
        ->assertOk()
        ->assertSee('Mensagem Arquivada')
        ->assertDontSee('Mensagem Nova');
});

it('opens message details marks it as read and updates status', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $message = ContactMessage::create([
        'name' => 'Maria Cliente',
        'email' => 'maria@example.com',
        'subject' => 'Ajuda',
        'message' => 'Preciso de ajuda.',
        'status' => ContactMessage::STATUS_NEW,
    ]);

    $this->actingAs($admin)
        ->get(route('admin.messages.show', $message))
        ->assertOk()
        ->assertSee('Preciso de ajuda.');

    expect($message->fresh())
        ->status->toBe(ContactMessage::STATUS_READ)
        ->read_at->not->toBeNull();

    $this->actingAs($admin)
        ->patch(route('admin.messages.status', $message), ['status' => ContactMessage::STATUS_ANSWERED])
        ->assertRedirect();

    expect($message->fresh()->status)->toBe(ContactMessage::STATUS_ANSWERED);
});

it('prevents common users from accessing admin messages', function () {
    $user = User::factory()->create(['role' => 'user']);

    $this->actingAs($user)->get(route('admin.messages.index'))->assertForbidden();
});
