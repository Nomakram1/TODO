<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;
use Carbon\Carbon;

class ShowTasks extends Component
{
    public $tasks;
    public $selectedTask;

    public function mount()
    {
        //fetch all the tasks of current user along with task group
        $this->tasks = Task::with('taskGroup')->where('user_id', auth()->user()->id)->get();
        $this->selectedTask = 'all';
    }
    public function markComplete($task_id){
        //get the status of completed of current user and inverse it
        $status = Task::find($task_id)->completed;
        Task::find($task_id)->update(['completed'=>!$status]);
        //fetch the records again
        $this->selectTask($this->selectedTask);
    }
    public function selectTask($tasktype)
    {
        $this->selectedTask = $tasktype;
        if($tasktype == 'all'){
            //fetch all the tasks of current user along with task group
            $this->tasks = Task::with('taskGroup')->where('user_id', auth()->user()->id)->get();
        }
        else if($tasktype== 'tomorrow'){
            //fetch the records whose due_date is tomorrow of current user
            $this->tasks = Task::with('taskGroup')->where('due_date',Carbon::tomorrow())->where('completed', 0)->where('user_id',auth()->user()->id)->get();
        }elseif($tasktype == 'today'){
            //fetch the records whose due_date is today
            $this->tasks = Task::with('taskGroup')->where('due_date',Carbon::today())->where('completed', 0)->where('user_id', auth()->user()->id)->get();
        }elseif($tasktype == 'next_week'){
            //fetch the records whose due_date is from start day of next week till end day of next week from now
            $this->tasks = Task::with('taskGroup')->whereBetween('due_date',[Carbon::now()->startOfWeek()->addWeek(),Carbon::now()->endOfWeek()->addWeek()])->where('completed', 0)->where('user_id', auth()->user()->id)->get();
        }
        elseif($tasktype== 'near_future'){
            //fetch the records whose due_date is from start day of next week till end day of next week from now
            $this->tasks = Task::with('taskGroup')->whereBetween('due_date',[Carbon::now()->startOfWeek()->addWeeks(2),Carbon::now()->endOfWeek()->addWeeks(2)])->where('completed', 0)->where('user_id', auth()->user()->id)->get();
        }
        else if($tasktype== 'future'){
            //fetch the records whose due_date is from start day of next week till end day of next week from now
            $this->tasks = Task::with('taskGroup')->where('due_date','>',Carbon::now()->endOfWeek()->addWeeks(2))->where('completed', 0)->where('user_id', auth()->user()->id)->get();
        }
        else if($tasktype=='completed'){
            //fetch the records which are completed
            $this->tasks = Task::with('taskGroup')->where('completed',1)->where('user_id', auth()->user()->id)->get();
        }
    }
    public function render()
    {
        return view('livewire.show-tasks');
    }
}
