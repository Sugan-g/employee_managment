<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminLogin extends Component
{
    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function login()
    {
        try {
            $credentials = $this->validate();
            Log::info('Validation passed', $credentials);

            if (Auth::guard('admin')->attempt($credentials)) {
                session()->flash('message', 'Login successful');
                return redirect(route('employees'));
            }

            session()->flash('error', 'Invalid credentials');
        } catch (\Exception $e) {
            Log::error('Validation failed', ['error' => $e->getMessage()]);
            session()->flash('error', 'Validation failed');
        }
    }

    public function logout()
    {
        
        Auth::guard('admin')->logout();

        session()->invalidate();
        session()->regenerateToken();
        
        return redirect(route('login'));
    }


    public function render()
    {
        
        if (Auth::guard('admin')->check()) {
            return redirect(route('employees'));
        }

        return view('livewire.admin-login')->layout('layouts.app');
    }
}
