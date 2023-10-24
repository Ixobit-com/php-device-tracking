<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\Redirector;
use WireUi\Traits\Actions;

class Logout extends Component
{
    use Actions;

    /**
     * Logout and redirect to login page.
     */
    public function logout(): Redirector|RedirectResponse
    {
        session()->flush();
        auth()->logout();

        Session::flash('notification', [
            'type' => 'success',
            'message' => 'Successfully logout',
        ]);

        return redirect()->to('/login');
    }
}
