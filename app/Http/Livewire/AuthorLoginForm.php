<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthorLoginForm extends Component
{
    public $email, $password;

    public function LoginHandler()
    {
        $this->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:5'
        ], [
            'email.required' => "Enter your email address",
            'email.email' => "Invalid email address",
            'email.exists' => "This email is not registered in database",
            'password.required' => "Password is required"
        ]); 

        $creds = array('email' => $this->email, 'password' => $this->password);

        if (Auth::guard('web')->attempt($creds)) {
            $checkUser = User::where('email', $this->email)->first();
            if ($checkUser->blocked == 1) {
                Auth::guard('web')->logout();
                return redirect('/author/login')->with('fail', "Your account has been blocked");
                // return redirect()->route('/author/login')->with('fail', "Your account has been blocked");
            }else{
                // return redirect()->route('/author/home');
                return redirect('/author/home');
            }
        }else{
            session()->flash('fail', "Incurrect email or password");
        }
    }

    public function render()
    {
        return view('livewire.author-login-form');
    }
}
