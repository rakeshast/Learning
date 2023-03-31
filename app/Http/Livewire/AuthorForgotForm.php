<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class AuthorForgotForm extends Component
{

    public $email;

    public function ForgotHandler(){
        $this->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.required' => "The :attribute is required",
            'email.email' => "Invalid email address",
            'email.exists' => "The :attribute is not registered"
        ]);

        $token = base64_encode(Str::random(64));
        DB::table('password_resets')->insert([
            'email' => $this->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        $user = User::where('email', $this->email)->first();
        $link = route('author/reset-form', ['token'=> $token, 'email' => $this->email]);
        $body_message = "We are received a request to reset the password for <b>Larablog</b> account associated with ". $this->email .". <br> You can reset your password by clicking the button below";
        $body_message.= "<br>";
        $body_message.= '<a href="'.$link.'" target=""__blank>Reset Password</a>';
        $body_message.= "<br>";
        $body_message.= "if you did not request for a password reset, Please ignore this email";

        $data = array(
            'name' => $user->name,
        );

        
    }

    public function render()
    {
        return view('livewire.author-forgot-form');
    }
}
