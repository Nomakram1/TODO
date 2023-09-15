<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TaskGroup;

class CreateTaskGroup extends Component
{
    public $title;
    public $description;
    // Validation rules
    protected $rules = [
        'title' => 'required|string|max:255|unique:task_groups,title',
        'description' => 'nullable|string',
    ];
    public function createTaskGroup(){
        //apply validation rules
        $validatedData = $this->validate();
        // Check if validation passes
        if ($validatedData) {
            // Create task group
            $taskGroup = TaskGroup::create([
                'title' => $this->title,
                'description' => $this->description,
                'user_id' => auth()->user()->id,
            ]);

            if ($taskGroup) {
                // Reset input fields
                $this->title = '';
                $this->description = '';
                $this->dispatchBrowserEvent('swal:modal', [
                    'type' => 'success',
                    'message' => 'Task Group created successfully!',
                ]);
            }
        }
    }
    public function redirectToCreate(){
        return redirect()->route('create');
    }
    public function render()
    {
        return view('livewire.create-task-group');
    }
}
