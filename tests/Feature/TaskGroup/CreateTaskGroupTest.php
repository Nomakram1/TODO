<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Livewire\Livewire;
use App\Models\User;

class CreateTaskGroupTest extends TestCase
{
    use RefreshDatabase;


    protected $user;
    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /**
     * A Task Group creation page contains livewire component.
     *
     * @return void
     */

    public function test_task_group_creation_page_contains_livewire_component_with_login()
    {
        $this->actingAs($this->user)
            ->get(route('create-task-group'))
            ->assertSeeLivewire('create-task-group');
    }

    /**
     * A Task Group creation page redirects to login screen without login.
     *
     * @return void
     */

    public function test_task_group_creation_page_redirect_to_login_screen_without_login()
    {
        $this->get(route('create-task-group'))
            ->assertRedirect(route('login'));
    }

    /**
     * A Task Group can be created.
     *
     * @return void
     */

    public function test_can_create_task_group()
    {
        $this->assertDatabaseCount('task_groups', 0);

        Livewire::actingAs($this->user)
            ->test('create-task-group')
            ->set('title', 'My first task Group')
            ->set('description', 'This is my first task')
            ->call('createTaskGroup');

        $this->assertDatabaseCount('task_groups', 1);
    }

    /**
     * A Task Group cannot be created without title.
     *
     * @return void
     */

    public function test_cannot_create_task_group_without_title()
    {
        $this->assertDatabaseCount('task_groups', 0);

        Livewire::actingAs($this->user)
            ->test('create-task-group')
            ->set('description', 'This is my first task')
            ->call('createTaskGroup')
            ->assertHasErrors(['title' => 'required']);

        $this->assertDatabaseCount('task_groups', 0);
    }

    /**
     * A Task Group can be created without description.
     *
     * @return void
     */

    public function test_can_create_task_group_without_description()
    {
        $this->assertDatabaseCount('task_groups', 0);

        Livewire::actingAs($this->user)
            ->test('create-task-group')
            ->set('title', 'My first task Group')
            ->call('createTaskGroup')
            ->assertHasNoErrors(['description' => 'nullable']);

        $this->assertDatabaseCount('task_groups', 1);
    }
}
