<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;
use App\Models\TaskSchedule;
use Carbon\Carbon;
class CreateTask extends Component
{
    public $title;
    public $description;
    public $durationType ='from-to'; 
    public $iterations ;
    public $startDate;
    public $endDate;
    public $recurrence='daily';
    public $taskGroups;
    public $taskGroup;

    // validation of above fields
    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'durationType' => 'required|in:from-to,iteration',
        'startDate' => 'nullable|date|required_if:durationType,from-to|after_or_equal:today',
        'endDate' => 'nullable|date|required_if:durationType,from-to|after_or_equal:startDate',
        'recurrence' => 'required|in:daily,monday,tuesday,wednesday,friday,fifth_each_month,fifth_each_year',
        'iterations' => 'nullable|integer|required_if:durationType,iteration|min:1|max:999',
        'taskGroup' => 'nullable|exists:task_groups,id',
    ];
    public function mount()
    {
        //fetch all the task groups
        $this->taskGroups = auth()->user()->taskGroups;
        if($this->taskGroups->count() > 0){
            $this->taskGroup = $this->taskGroups->first()->id;
        }
    }
    public function createTask(){

        //validate the data
        $validatedData = $this->validate();
        $recurrencePattern = $validatedData['recurrence'];
        $totalTasks=0;
        //check if the duration type is from-to (Date Range)
        if ($validatedData['durationType'] === 'from-to') {
            //parse the start and end date
            $startDate = Carbon::parse($validatedData['startDate']);
            $endDate = Carbon::parse($validatedData['endDate']);
            // Create the task schedule
            $currentDate = $startDate;
            $taskSchedule= TaskSchedule::create([
                'recurrence_pattern' => $validatedData['recurrence'],
                'start_date' => $startDate,
                'end_date' => $endDate,
                'schedule_type' => 'date_range',
                'user_id' => auth()->user()->id,
            ]);
            //move to the previous day to include the current day
            $currentDate = $startDate->copy()->subDay();
            // Create Todo Task between date range
            while ($endDate->gt($currentDate)) {
                // Calculate the due date
                $dueDate = $this->calculateDueDate($recurrencePattern, $currentDate);
                if($dueDate->gt($endDate)){
                    break;
                }

                // Create the task
                Task::create([
                    'user_id' => auth()->user()->id,
                    'task_schedule_id' => $taskSchedule->id, 
                    'task_group_id' => $validatedData['taskGroup'], 
                    'title' => $validatedData['title'],
                    'description' => $validatedData['description'],
                    'due_date' => $dueDate,
                    'completed' => false,
                ]);
                $currentDate = $dueDate;
                $totalTasks++;
            }
        } else {
            // Create the task schedule
            $taskSchedule = TaskSchedule::create([
                'recurrence_pattern' => $validatedData['recurrence'],
                'iterations' => $validatedData['iterations'],
                'schedule_type' => 'iteration',
                'user_id' => auth()->user()->id,
            ]);
            $dueDate = Carbon::now();
            $dueDate->subDay();
            // Create tasks based on the specified number of iterations
            for ($i = 0; $i < $validatedData['iterations']; $i++) {
                $dueDate = $this->calculateDueDate($recurrencePattern, $dueDate);
                Task::create([
                    'user_id' => auth()->user()->id,
                    'task_schedule_id' => $taskSchedule->id, 
                    'task_group_id' => $validatedData['taskGroup'], 
                    'title' => $validatedData['title'],
                    'description' => $validatedData['description'],
                    'due_date' => $dueDate,
                    'completed' => false,
                ]);
                $totalTasks++;
             }
            
        }

        if($totalTasks > 0){
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'message' => 'Total '.$totalTasks. ' Task(s) has been created successfully!',
            ]);
            // Reset input fields
            $this->resetInputFields();
        }
        else{
            $this->dispatchBrowserEvent('swal:warning', [
                'type' => 'warning',
                'message' => 'No Task Added!',
                'text' => 'Please check the dates and try again.',
            ]);
        }

    }
    //calculate the due date
    private function calculateDueDate($recurrencePattern, $startDate)
    {
        $dueDate = $startDate->copy();

        switch ($recurrencePattern) {
            case 'daily':
                $dueDate->addDay();
                break;
            case 'monday':
                $dueDate->next(Carbon::MONDAY);
                break;
            case 'tuesday':
                $dueDate->next(Carbon::TUESDAY);
                break;
            case 'wednesday':
                $dueDate->next(Carbon::WEDNESDAY);
                break;
            case 'friday':
                $dueDate->next(Carbon::FRIDAY);
                break;
            case 'fifth_each_month':
                $dueDate->addMonths(1)->day(5);
                break;
            case 'fifth_each_year':
                $dueDate->addYear()->month(3)->day(5);
                break;
        }

        return $dueDate;
    }
    private function resetInputFields(){
        $this->title = '';
        $this->description = '';
        $this->durationType ='from-to';
        $this->iterations = '';
        $this->startDate = '';
        $this->endDate = '';
        $this->recurrence='daily';
        $this->taskGroup = '';
    }
    public function render()
    {
        return view('livewire.create-task');
    }
}
