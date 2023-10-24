<?php

namespace App\Http\Livewire\Auth;

use App\Http\Traits\NotificationTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Login extends Component
{
    use NotificationTrait;

    public string $email;

    public string $password;

    protected array $rules = [
        'email' => ['required', 'email'],
        'password' => ['required', 'min:8'],
    ];

    /**
     * Login and redirect to /.
     *
     * @return RedirectResponse|void
     */
    public function login()
    {
        $this->validate();

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if (auth()->attempt($credentials)) {
            Session::flash('notification', [
                'type' => 'success',
                'message' => 'Successfully login',
            ]);

            return redirect()->intended();
        }

        $this->sendNotification('Invalid login credentials.', 'error');
    }
}
