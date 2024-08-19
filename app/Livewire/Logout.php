<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Logout extends Component
{
    public function logout()
    {
        Auth::guard('auth.admin')->logout(); // Use 'admin' if using admin guard

        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('admin/login'); // Redirect to the login page or another route
    }

    public function render()
    {
        // return view('livewire.logout')->layout('layouts.app');
        return redirect()->route('admin.login');
    }
}
