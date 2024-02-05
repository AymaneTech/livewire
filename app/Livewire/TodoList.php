<?php

namespace App\Livewire;

use Livewire\Attributes\Rule;
use Livewire\Component;

class TodoList extends Component
{
    #[Rule("required")]
    public $name;

    public function create()
    {
        $this->validate();
        dd($this->name);
    }
    public function render()
    {
        return view('livewire.todo-list');
    }
}
