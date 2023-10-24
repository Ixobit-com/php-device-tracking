<?php

namespace App\Http\Livewire\Admin\User;

use App\Http\Traits\ComponentHelperTrait;
use App\Http\Traits\NotificationTrait;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Create extends Component
{
    use NotificationTrait, ComponentHelperTrait;

    protected array $rules;

    public array    $roles = [];

    public string $name = '';

    public string $email = '';

    public string $role = '';

    public string $password = '';

    public string $password_confirmation = '';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->rules = [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'role' => ['required', 'in:'.implode(',', User::USER_ROLES)],
            'password' => ['required', 'confirmed', 'min:8', 'max:20', "regex:/^((?=.*\d)(?=.*[A-Z])(?=.*\W).{8,20})$/"],
        ];
        $this->roles = User::USER_ROLES;
    }

    /**
     * Create new user.
     */
    public function store(): void
    {
        $validated = $this->validate();
        $validated['password'] = Hash::make($this->password);

        User::create($validated);
        $this->sendNotification('Successfully created user', 'success');
        $this->emit('userCreated');
        $this->closeModal();
    }
}
