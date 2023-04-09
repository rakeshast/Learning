<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class Authors extends Component
{
    public $name, $email, $username, $author_type, $direct_publisher;

    public function addAuthor(){
        dd("working");
    }

    public function render()
    {
        return view('livewire.authors', [
            'authors' => User::where('id', '!=', auth()->id())->get(),
        ]);
    }
}
