<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use App\Models\User;
use App\Models\TaskGroup;
use Carbon\Carbon;
use DateTime;

class CreateTaskTest extends TestCase
{
    use RefreshDatabase;

    
    protected $user, $taskGroup;
    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        //create Task Group with factory
        $this->taskGroup = TaskGroup::factory()->create([
            'user_id' => $this->user->id,
        ]);
    }


    /**
     * A Task creation page contains livewire component with login.
     *
     * @return void
     */
    public function test_task_creation_page_contains_livewire_component_with_login()
    {
        $this->actingAs($this->user)
            ->get(route('create'))
            ->assertSeeLivewire('create-task');
        
    }


    /**
     * A Task creation page redirects to login screen without login.
     *
     * @return void
     */
    public function test_task_creation_page_redirects_to_login_screen_without_login()
    {
        $this->get(route('create'))
            ->assertRedirect(route('login'));
    }

    /**
     * A Task can be created.
     *
     * @return void
     */

    public function test_can_create_task_with_iterations_daily()
    {
        $this->assertDatabaseCount('tasks', 0);
        $this->assertDatabaseCount('task_schedules', 0);

        Livewire::actingAs($this->user)
            ->test('create-task')
            ->set('title', 'Daily task')
            ->set('description', 'This is my first task')
            ->set('recurrence', 'daily')
            ->set('durationType', 'iteration')
            ->set('iterations', 5)
            ->set('taskGroup', $this->taskGroup->id)
            ->call('createTask');
            //->assertRedirect(route('create'));

        $this->assertDatabaseCount('tasks', 5);
        $this->assertDatabaseCount('task_schedules', 1);
    }

    /**
     * A Task cannot be created without title.
     *
     * @return void
     */

    public function test_cannot_create_task_with_iterations_daily_without_title()
    {
        $this->assertDatabaseCount('tasks', 0);
        $this->assertDatabaseCount('task_schedules', 0);

        Livewire::actingAs($this->user)
            ->test('create-task')
            ->set('description', 'This is my first task')
            ->set('recurrence', 'daily')
            ->set('durationType', 'iteration')
            ->set('iterations', 5)
            ->set('taskGroup', $this->taskGroup->id)
            ->call('createTask')
            ->assertHasErrors(['title' => 'required']);

        $this->assertDatabaseCount('tasks', 0);
        $this->assertDatabaseCount('task_schedules', 0);
    }

    /**
     * A Task can be created without description.
     *
     * @return void
     */

    public function test_can_create_task_with_iterations_daily_without_description()
    {
        $this->assertDatabaseCount('tasks', 0);
        $this->assertDatabaseCount('task_schedules', 0);

        Livewire::actingAs($this->user)
            ->test('create-task')
            ->set('title', 'My first task without description')
            ->set('recurrence', 'daily')
            ->set('durationType', 'iteration')
            ->set('iterations', 5)
            ->set('taskGroup', $this->taskGroup->id)
            ->call('createTask');

        $this->assertDatabaseCount('tasks', 5);
        $this->assertDatabaseCount('task_schedules', 1);
    }

    /**
     * A Task can be created without task group.
     *
     * @return void
     */

    public function test_can_create_task_with_iterations_daily_without_task_group()
    {
        $this->assertDatabaseCount('tasks', 0);
        $this->assertDatabaseCount('task_schedules', 0);

        Livewire::actingAs($this->user)
            ->test('create-task')
            ->set('title', 'My first task without task group')
            ->set('description', 'This is my first task')
            ->set('durationType', 'iteration')
            ->set('iterations', 5)
            ->call('createTask');

        $this->assertDatabaseCount('tasks', 5);
        $this->assertDatabaseCount('task_schedules', 1);
    }

    /**
     * A Task can be created with iterations monday.
     *
     * @return void
     */

    public function test_can_create_task_with_iterations_monday()
    {
        $this->assertDatabaseCount('tasks', 0);
        $this->assertDatabaseCount('task_schedules', 0);

        Livewire::actingAs($this->user)
            ->test('create-task')
            ->set('title', 'My first task monday')
            ->set('description', 'This is my first task')
            ->set('recurrence', 'monday')
            ->set('durationType', 'iteration')
            ->set('iterations', 5)
            ->set('taskGroup', $this->taskGroup->id)
            ->call('createTask');
            //->assertRedirect(route('create'));

        $this->assertDatabaseCount('tasks', 5);
        $this->assertDatabaseCount('task_schedules', 1);
    }

    /**
     * A Task can be created with iterations tuesday.
     *
     * @return void
     */

    public function test_can_create_task_with_iterations_tuesday()
    {
        $this->assertDatabaseCount('tasks', 0);
        $this->assertDatabaseCount('task_schedules', 0);

        Livewire::actingAs($this->user)
            ->test('create-task')
            ->set('title', 'My first task tuesday')
            ->set('description', 'This is my first task')
            ->set('recurrence', 'tuesday')
            ->set('durationType', 'iteration')
            ->set('iterations', 5)
            ->set('taskGroup', $this->taskGroup->id)
            ->call('createTask');
        //->assertRedirect(route('create'));

        $this->assertDatabaseCount('tasks', 5);
        $this->assertDatabaseCount('task_schedules', 1);
    }

    /**
     * A Task can be created with iterations wednesday.
     *
     * @return void
     */

    public function test_can_create_task_with_iterations_wednesday()
    {
        $this->assertDatabaseCount('tasks', 0);
        $this->assertDatabaseCount('task_schedules', 0);

        Livewire::actingAs($this->user)
            ->test('create-task')
            ->set('title', 'My first task wednesday')
            ->set('description', 'This is my first task')
            ->set('recurrence', 'wednesday')
            ->set('durationType', 'iteration')
            ->set('iterations', 5)
            ->set('taskGroup', $this->taskGroup->id)
            ->call('createTask');
        //->assertRedirect(route('create'));

        $this->assertDatabaseCount('tasks', 5);
        $this->assertDatabaseCount('task_schedules', 1);
    }

    /**
     * A Task can be created with iterations friday.
     *
     * @return void
     */

    public function test_can_create_task_with_iterations_friday()
    {
        $this->assertDatabaseCount('tasks', 0);
        $this->assertDatabaseCount('task_schedules', 0);

        Livewire::actingAs($this->user)
            ->test('create-task')
            ->set('title', 'My first task friday')
            ->set('description', 'This is my first task')
            ->set('recurrence', 'friday')
            ->set('durationType', 'iteration')
            ->set('iterations', 5)
            ->set('taskGroup', $this->taskGroup->id)
            ->call('createTask');
        //->assertRedirect(route('create'));

        $this->assertDatabaseCount('tasks', 5);
        $this->assertDatabaseCount('task_schedules', 1);
    }

    /**
     * A Task can be created with iterations fifth of each month.
     *
     * @return void
     */

    public function test_can_create_task_with_iterations_fifth_of_each_month()
    {
        $this->assertDatabaseCount('tasks', 0);
        $this->assertDatabaseCount('task_schedules', 0);

        Livewire::actingAs($this->user)
            ->test('create-task')
            ->set('title', 'My first task')
            ->set('description', 'This is my first task fifth of each month')
            ->set('recurrence', 'fifth_each_month')
            ->set('durationType', 'iteration')
            ->set('iterations', 5)
            ->set('taskGroup', $this->taskGroup->id)
            ->call('createTask');
        //->assertRedirect(route('create'));

        $this->assertDatabaseCount('tasks', 5);
        $this->assertDatabaseCount('task_schedules', 1);
    }


    /**
     * A Task can be created with iterations fifth of march each year.
     *
     * @return void
     */

    public function test_can_create_task_with_iterations_fifth_each_year()
    {
        $this->assertDatabaseCount('tasks', 0);
        $this->assertDatabaseCount('task_schedules', 0);

        Livewire::actingAs($this->user)
            ->test('create-task')
            ->set('title', 'My first task')
            ->set('description', 'This is my first task fifth of each year')
            ->set('recurrence', 'fifth_each_month')
            ->set('durationType', 'iteration')
            ->set('iterations', 5)
            ->set('taskGroup', $this->taskGroup->id)
            ->call('createTask');
        //->assertRedirect(route('create'));

        $this->assertDatabaseCount('tasks', 5);
        $this->assertDatabaseCount('task_schedules', 1);
    }


    /**
     * A Task can be created with dates daily.
     * Date Range
     * @return void
     */

    public function test_can_create_task_with_dates_daily()
    {
        $this->assertDatabaseCount('tasks', 0);
        $this->assertDatabaseCount('task_schedules', 0);

        $startDate = Carbon::today()->format('Y-m-d');
        $endDate = Carbon::today()->addDays(3)->format('Y-m-d');
        // dd(Carbon::today()->format('Y-m-d'),Carbon::today()->addDays(3)->format('Y-m-d'));
        // dd(now()->format('Y-m-d'));
        // // add days in now()->format('Y-m-d') to get end date

        // $startDate = Carbon::parse('2023-09-14');
        // $endDate = Carbon::parse('2023-09-17');
        
        Livewire::actingAs($this->user)
            ->test('create-task')
            ->set('title', 'My first task')
            ->set('description', 'This is my first task dates daily')
            ->set('recurrence', 'daily')
            ->set('durationType', 'from-to')
            ->set('startDate',$startDate)
            ->set('endDate',$endDate)
            ->set('taskGroup', $this->taskGroup->id)
            ->call('createTask');
        $this->assertDatabaseCount('tasks', 4);
        $this->assertDatabaseCount('task_schedules', 1);
    }

    /**
     * A private helpng function to count specific days within date range
     * Date Range
     * @return void
     */
    private function countSpecificDays($startDate, $endDate, $dayNumber)
    {
        $start = new DateTime($startDate);
        $end = new DateTime($endDate);
        $count = 0;
        while ($start <= $end) {
            if ($start->format('N') == $dayNumber) {
                $count++;
            }

            $start->modify('+1 day'); 
        }

        return $count;
    }

    /**
     * A Task can be created with dates monday.
     * Date Range
     * @return void
     */
    public function test_can_create_task_with_dates_monday()
    {
        $this->assertDatabaseCount('tasks', 0);
        $this->assertDatabaseCount('task_schedules', 0);

        $startDate = Carbon::today()->format('Y-m-d');
        $endDate = Carbon::today()->addDays(11)->format('Y-m-d');

        //calculate how many mondays will come in-between these dates
        $mondays = $this->countSpecificDays($startDate, $endDate, 1);

        Livewire::actingAs($this->user)
            ->test('create-task')
            ->set('title', 'My first task')
            ->set('description', 'This is my first task dates monday')
            ->set('recurrence', 'monday')
            ->set('durationType', 'from-to')
            ->set('startDate', $startDate)
            ->set('endDate', $endDate)
            ->set('taskGroup', $this->taskGroup->id)
            ->call('createTask');
        $this->assertDatabaseCount('tasks', $mondays);
        $this->assertDatabaseCount('task_schedules', 1);
    }

    /**
     * A Task can be created with dates tuesday.
     * Date Range
     * @return void
     */

    public function test_can_create_task_with_dates_tuesday()
    {
        $this->assertDatabaseCount('tasks', 0);
        $this->assertDatabaseCount('task_schedules', 0);

        $startDate = Carbon::today()->format('Y-m-d');
        $endDate = Carbon::today()->addDays(11)->format('Y-m-d');

        //calculate how many tuesdays will come in-between these dates
        $tuesdays = $this->countSpecificDays($startDate, $endDate, 2);

        Livewire::actingAs($this->user)
            ->test('create-task')
            ->set('title', 'My first task')
            ->set('description', 'This is my first task dates tuesday') 
            ->set('recurrence', 'tuesday')
            ->set('durationType', 'from-to')
            ->set('startDate', $startDate)
            ->set('endDate', $endDate)
            ->set('taskGroup', $this->taskGroup->id)
            ->call('createTask');
        $this->assertDatabaseCount('tasks', $tuesdays);
        $this->assertDatabaseCount('task_schedules', 1);
    }

    /**
     * A Task can be created with dates wednesday.
     * Date Range
     * @return void
     */
    public function test_can_create_task_with_dates_wednesday()
    {
        $this->assertDatabaseCount('tasks', 0);
        $this->assertDatabaseCount('task_schedules', 0);

        $startDate = Carbon::today()->format('Y-m-d');
        $endDate = Carbon::today()->addDays(11)->format('Y-m-d');

        //calculate? how many wednesdays will come in-between start and end dates
        $wednesdayCount = $this->countSpecificDays($startDate, $endDate, 3);

        Livewire::actingAs($this->user)
            ->test('create-task')
            ->set('title', 'My first task')
            ->set('description', 'This is my first task dates wednesday')
            ->set('recurrence', 'wednesday')
            ->set('durationType', 'from-to')
            ->set('startDate', $startDate)
            ->set('endDate', $endDate)
            ->set('taskGroup', $this->taskGroup->id)
            ->call('createTask');
        $this->assertDatabaseCount('tasks', $wednesdayCount);
        $this->assertDatabaseCount('task_schedules', 1);
    }

    /**
     * A Task can be created with dates friday.
     * Date Range
     * @return void
     */
    public function test_can_create_task_with_dates_friday()
    {
        $this->assertDatabaseCount('tasks', 0);
        $this->assertDatabaseCount('task_schedules', 0);

        $startDate = Carbon::today()->format('Y-m-d');
        $endDate = Carbon::today()->addDays(11)->format('Y-m-d');

        //calculate how many friday will come in-between start and end dates
        $fridayCount = $this->countSpecificDays($startDate, $endDate, 5);

        Livewire::actingAs($this->user)
            ->test('create-task')
            ->set('title', 'My first task')
            ->set('description', 'This is my first task dates friday')
            ->set('recurrence', 'friday')
            ->set('durationType', 'from-to')
            ->set('startDate', $startDate)
            ->set('endDate', $endDate)
            ->set('taskGroup', $this->taskGroup->id)
            ->call('createTask');
        $this->assertDatabaseCount('tasks', $fridayCount);
        $this->assertDatabaseCount('task_schedules', 1);
    }

    /**
     * A Task can be created with dates fifth of each month.
     * Date Range
     * @return void
     */

    public function test_can_create_task_with_dates_fifth_of_each_month()
    {
        $this->assertDatabaseCount('tasks', 0);
        $this->assertDatabaseCount('task_schedules', 0);

        $startDate = Carbon::today()->format('Y-m-d');
        $endDate = Carbon::today()->addDays(25)->format('Y-m-d');

        //calculate how many fifth of each month will come in-between start and end dates

        $fifth_of_each_monthCount = 0;
        $start = new DateTime($startDate);
        $end = new DateTime($endDate);
        while ($start <= $end) {
            if ($start->format('d') == 5) {
                $fifth_of_each_monthCount++;
            }
            $start->modify('+1 day'); 
        }


        Livewire::actingAs($this->user)
            ->test('create-task')
            ->set('title', 'My first task')
            ->set('description', 'This is my first task dates fifth of each month')
            ->set('recurrence', 'fifth_each_month')
            ->set('durationType', 'from-to')
            ->set('startDate', $startDate)
            ->set('endDate', $endDate)
            ->set('taskGroup', $this->taskGroup->id)
            ->call('createTask');
        $this->assertDatabaseCount('tasks', $fifth_of_each_monthCount);
        $this->assertDatabaseCount('task_schedules', 1);
    }

    /**
     * A Task can be created with dates fifth of march each year.
     * Date Range
     * @return void
     */

    public function test_can_create_task_with_dates_fifth_of_march_each_year()
    {
        $this->assertDatabaseCount('tasks', 0);
        $this->assertDatabaseCount('task_schedules', 0);

        $startDate = Carbon::today()->format('Y-m-d');
        $endDate = Carbon::today()->addDays(365)->format('Y-m-d');

        //calculate how many fifth of march will come in-between start and end dates
        $fifth_of_march_each_year_count = 0;
        $start = new DateTime($startDate);
        $end = new DateTime($endDate);
        while ($start <= $end) {
            if ($start->format('m-d') == '03-05') {
                $fifth_of_march_each_year_count++;
            }
            $start->modify('+1 day'); 
        }

        Livewire::actingAs($this->user)
            ->test('create-task')
            ->set('title', 'My first task')
            ->set('description', 'This is my first task fifth of march each year')
            ->set('recurrence', 'fifth_each_year')
            ->set('durationType', 'from-to')
            ->set('startDate', $startDate)
            ->set('endDate', $endDate)
            ->set('taskGroup', $this->taskGroup->id)
            ->call('createTask');
        $this->assertDatabaseCount('tasks', $fifth_of_march_each_year_count);
        $this->assertDatabaseCount('task_schedules', 1);

    }
}
