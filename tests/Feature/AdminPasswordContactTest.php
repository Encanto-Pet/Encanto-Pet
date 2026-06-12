<?php

use App\Mail\ContactMessageMail;
use App\Models\ContactMessage;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

it('allows an admin to update password with the correct current password', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
        'password' => Hash::make('old-secret-password'),
    ]);

    $this->actingAs($admin)->put(route('admin.password.update'), [
        'current_password' => 'old-secret-password',
        'password' => 'new-secret-password',
        'password_confirmation' => 'new-secret-password',
    ])->assertRedirect();

    $admin->refresh();

    expect(Hash::check('new-secret-password', $admin->password))->toBeTrue();
    expect($admin->password)->not->toBe('new-secret-password');
});

it('rejects admin password update with wrong current password', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
        'password' => Hash::make('old-secret-password'),
    ]);

    $this->actingAs($admin)->put(route('admin.password.update'), [
        'current_password' => 'wrong-password',
        'password' => 'new-secret-password',
        'password_confirmation' => 'new-secret-password',
    ])->assertSessionHasErrors('current_password');

    expect(Hash::check('old-secret-password', $admin->fresh()->password))->toBeTrue();
});

it('rejects admin password update when confirmation does not match', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
        'password' => Hash::make('old-secret-password'),
    ]);

    $this->actingAs($admin)->put(route('admin.password.update'), [
        'current_password' => 'old-secret-password',
        'password' => 'new-secret-password',
        'password_confirmation' => 'different-password',
    ])->assertSessionHasErrors('password');
});

it('prevents common users from accessing admin password screen', function () {
    $user = User::factory()->create(['role' => 'user']);

    $this->actingAs($user)->get(route('admin.password.edit'))->assertForbidden();
});

it('stores and emails a valid contact message to the configured recipient', function () {
    Mail::fake();
    config(['contact.to' => 'cestoubag@gmail.com']);

    $user = User::factory()->create(['role' => 'user']);

    $this->actingAs($user)->post(route('contact.store'), [
        'name' => 'Maria Cliente',
        'email' => 'maria@example.com',
        'subject' => 'Pedido',
        'message' => 'Gostaria de falar sobre meu pedido.',
    ])->assertRedirect()->assertSessionHas('success');

    $this->assertDatabaseHas('contact_messages', [
        'user_id' => $user->id,
        'name' => 'Maria Cliente',
        'email' => 'maria@example.com',
        'subject' => 'Pedido',
        'status' => ContactMessage::STATUS_NEW,
    ]);

    Mail::assertSent(ContactMessageMail::class, function (ContactMessageMail $mail) {
        return $mail->hasTo('cestoubag@gmail.com')
            && $mail->contactMessage->email === 'maria@example.com';
    });
});

it('validates required contact message fields', function () {
    Mail::fake();

    $user = User::factory()->create(['role' => 'user']);

    $this->actingAs($user)->post(route('contact.store'), [])
        ->assertSessionHasErrors(['name', 'email', 'subject', 'message']);

    Mail::assertNothingSent();
});

it('validates contact email format', function () {
    Mail::fake();

    $user = User::factory()->create(['role' => 'user']);

    $this->actingAs($user)->post(route('contact.store'), [
        'name' => 'Maria Cliente',
        'email' => 'email-invalido',
        'subject' => 'Pedido',
        'message' => 'Mensagem válida.',
    ])->assertSessionHasErrors('email');

    Mail::assertNothingSent();
});
