<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class ShowTaskTest extends TestCase
{
    use RefreshDatabase;


    protected $user;
    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }
    /**
     * A test to show take page contains livewire component
     *
     * @return void
     */

    public function test_show_tasks_page_contains_livewire_component_with_login()
    {
        $this->actingAs($this->user)
            ->get(route('dashboard'))
            ->assertSeeLivewire('show-tasks');
    }

    /**
     * A test to show take page redirect to login screen without login
     *
     * @return void
     */

    public function test_show_tasks_page_redirect_to_login_screen_without_login()
    {
        $this->get(route('dashboard'))
        ->assertRedirect(route('login'));
    }

    /**
     * A test to show take page contains livewire component and show today tasks
     *
     * @return void
     */
    public function test_show_tasks_today()
    {
        $this->actingAs($this->user)
            ->get(route('dashboard'))
            ->assertSeeLivewire('show-tasks')
            ->assertSee('today');
    }

    /**
     * A test to show take page contains livewire component and show tomorrow tasks
     *
     * @return void
     */
    public function test_show_tasks_tomorrow()
    {
        $this->actingAs($this->user)
            ->get(route('dashboard'))
            ->assertSeeLivewire('show-tasks')
            ->assertSee('tomorrow');
    }

    /**
     * A test to show take page contains livewire component and show next week tasks
     *
     * @return void
     */
    public function test_show_tasks_next_week()
    {
        $this->actingAs($this->user)
            ->get(route('dashboard'))
            ->assertSeeLivewire('show-tasks')
            ->assertSee('next_week');
    }

    /**
     * A test to show take page contains livewire component and show near future tasks
     *
     * @return void
     */
    public function test_show_tasks_near_future()
    {
        $this->actingAs($this->user)
            ->get(route('dashboard'))
            ->assertSeeLivewire('show-tasks')
            ->assertSee('near_future');
    }

    /**
     * A test to show take page contains livewire component and show near future tasks 
     *
     * @return void
     */
    public function test_show_tasks_future()
    {
        $this->actingAs($this->user)
            ->get(route('dashboard'))
            ->assertSeeLivewire('show-tasks')
            ->assertSee('future');
    }

    /**
     * A test to show take page contains livewire component and show all completed tasks
     *
     * @return void
     */
    public function test_show_tasks_completed()
    {
        $this->actingAs($this->user)
            ->get(route('dashboard'))
            ->assertSeeLivewire('show-tasks')
            ->assertSee('completed');
    }

}
