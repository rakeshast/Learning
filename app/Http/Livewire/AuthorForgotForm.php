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
        // $link = Route::get('password.reset-form')->with(
        //     ['token' => $token, 'email' => $this->email]
        // );
        // dd($link);
        $link = route('author.reset-form', ['token'=>$token, 'email'=>$this->email]);
        // $link = 'http://larablog.local/author/password/reset/'.$token . '?email='.$this->email;
        //  $link = route('author.reset-form', ['token'=> $token, 'email' => $this->email]);
        //  dd($link);
        $body_message = "We are received a request to reset the password for <b>Larablog</b> account associated with ". $this->email .". <br> You can reset your password by clicking the button below";
        $body_message.= "<br>";
        $body_message.= '<a href="'.$link.'" target=""__blank>Reset Password</a>';
        $body_message.= "<br>";
        $body_message.= "if you did not request for a password reset, Please ignore this email";

        $data = array(
            'name' => $user->name,
            'body_message' => $body_message,
        );

        Mail::send('forgot-email-template', $data, function($message) use ($user){
            $message->from('noreply@example.com', 'larablog');
            $message->to($user->email, $user->name)
                    ->subject('Reset password');
        });

        // $mail_body = view('forgot-email-template', $data)->render();
        
        // $mailConfig = array(
        //     'mail_from_email' => env("EMAIL_FROM_ADDRESS"),
        //     'mail_from_name' => env("EMAIL_FROM_NAME"),
        //     'mail_recipient_email' => $user->email,
        //     'mail_recipient_name' => $user->name,
        //     'mail_subject' => "Reset Password",
        //     'mail_body' => $mail_body,
        // );

        // sendMail($mailConfig);

        $this->email = null;
        session()->flash("success", "We have e-mailed your password reset link");
        
    }

    public function render()
    {
        return view('livewire.author-forgot-form');
    }
}
