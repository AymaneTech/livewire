<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Rule;
use L ivewire\WithPagination;

class Clicker extends Component
{
    use WithPagination;

    #[Rule("required|min:2")]
    public $name;
    
    #[Rule("required|email|unique:users")]
    public $email;

    #[Rule("required|email|unique:users")]
    public $password;

    public function CreateNewUser()
    {
        $this->validate();

        User::create([
            "name" => $this->name,
            "email" => $this->email,
            "password" => $this->password,
        ]);
        $this->reset();
        request()->session()->flash("success", "you create your account succesffully");
    }
    public function render()
    {
        $users = User::paginate(4);
        return view('livewire.clicker', [
            "users" => $users,
        ]);
    }
}
