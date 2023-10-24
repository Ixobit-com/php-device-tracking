<?php

namespace App\Http\Livewire\Admin\User;

use App\Http\Traits\ComponentHelperTrait;
use App\Http\Traits\NotificationTrait;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Update extends Component
{
    use NotificationTrait, ComponentHelperTrait;

    public int     $userId = 0;

    public array   $roles = [];

    public ?string $bannedAt = null;

    public string $name = '';

    public string $email = '';

    public string $role = '';

    public bool   $passwordModal = false;

    public string $password = '';

    public string $password_confirmation = '';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->roles = User::USER_ROLES;
    }

    /**
     * ban user, except admin.
     */
    public function banUser(): void
    {
        $user = User::find($this->userId);

        if ($user->hasRole('admin')) {
            $this->sendNotification('Cannot ban admin', 'error');

            return;
        }

        $now = now();
        $user->update(['banned_at' => $now]);
        $this->bannedAt = $now;

        $this->sendNotification('Successfully banned user', 'success');
    }

    /**
     * unban user.
     */
    public function unbanUser(): void
    {
        $user = User::find($this->userId);
        $user->update(['banned_at' => null]);
        $this->bannedAt = null;

        $this->sendNotification('Successfully unbanned user', 'success');
    }

    /**
     * open update or password modal with preview data.
     */
    public function openModal(bool $passwordModal = false): void
    {
        $this->passwordModal = $passwordModal;
        $this->showModal = true;
        $user = User::find($this->userId);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
    }

    /**
     * update user main fields.
     */
    public function update(): void
    {
        $user = User::find($this->userId);
        $validated = $this->validate(
            [
                'name' => ['required', 'max:255'],
                'email' => ['required', 'email', Rule::unique('users')->ignore($this->userId)],
                'role' => ['required', 'in:'.implode(',', User::USER_ROLES)],
            ]
        );
        $user->update($validated);

        $this->sendNotification('Successfully updated user', 'success');
        $this->emit('userUpdated');
        $this->closeModal();
    }

    /**
     * Update users password.
     */
    public function updatePassword(): void
    {
        $user = User::find($this->userId);
        $validated = $this->validate(
            [
                'password' => ['nullable', 'confirmed', 'min:8', 'max:20', "regex:/^((?=.*\d)(?=.*[A-Z])(?=.*\W).{8,20})$/"],
            ]
        );
        $validated['password'] = Hash::make($this->password);
        $user->update($validated);

        $this->sendNotification('Successfully updated users password', 'success');
        $this->emit('userUpdated');
        $this->closeModal();
    }
}
