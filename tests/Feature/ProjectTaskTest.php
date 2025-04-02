<?php

namespace Tests\Feature;

use App\Enums\TaskStatus;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests the listing of project tasks.
     *
     */
    public function test_list_project_tasks()
    {
        $project = Project::factory()
            ->hasTasks(3)
            ->create();

        $response = $this->get(route('projects.tasks.index', $project));
        $response->assertOk()
            ->assertViewHas('tasks');
    }

    /**
     * Tests the task creation form.
     *
     */
    public function test_create_task_in_project()
    {
        $project = Project::factory()->create();
        $taskData = [
            'description' => 'Nova tarefa',
            'status' => TaskStatus::PENDING->value,
        ];

        $this->post(route('projects.tasks.store', $project), $taskData)
            ->assertRedirect(route('projects.tasks.index', $project));

        $this->assertDatabaseHas('tasks', [
            ...$taskData,
            'project_id' => $project->id
        ]);
    }
}