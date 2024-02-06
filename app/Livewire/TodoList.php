<?php

namespace App\Livewire;

use App\Models\Todo;
use Exception;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class TodoList extends Component
{

    use WithPagination;

    #[Rule("required")]
    public $name;

    public $search;

    public $editingId;

    #[Rule("required")]
    public $editingName;

    public function create()
    {
        $validated = $this->validateOnly("name");
        Todo::create($validated);
        $this->reset("name");

        $this->resetPage();
        session()->flash("success", "saved!");
    }

    public function toggle(Todo $todo)
    {
        $todo->completed = !$todo->completed;
        $todo->save();
    }

    public function delete($todoId)
    {
        try {
            Todo::findOrFail($todoId)->delete();
        } catch (Exception $e) {
            session()->flash("error", "Failed to delete todo!");
            return;
        }
    }

    public function edit(Todo $todo)
    {
        $this->editingId = $todo->id;
        $this->editingName = $todo->name;
    }

    public function cancelEdit()
    {
        $this->reset("editingId", "editingName");
    }

    public function update()
    {
        $this->validateOnly("editingName");
        Todo::find($this->editingId)->update([
            "name" => $this->editingName,
        ]);
        $this->cancelEdit();
    }

    public function render()
    {
        return view('livewire.todo-list', [
            "todos" => Todo::latest()->where("name", "like", "%" . $this->search . "%")->paginate(10)
        ]);
    }
}
