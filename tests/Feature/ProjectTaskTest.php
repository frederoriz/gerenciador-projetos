<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function lista_tarefas_do_projeto()
    {
        $project = Project::factory()
            ->hasTasks(3)
            ->create();

        $response = $this->get(route('projects.tasks.index', $project));
        $response->assertOk()
            ->assertViewHas('tasks');
    }

    /** @test */
    public function cria_tarefa_no_projeto()
    {
        $project = Project::factory()->create();
        $taskData = ['description' => 'Nova tarefa'];

        $this->post(route('projects.tasks.store', $project), $taskData)
            ->assertRedirect(route('projects.tasks.index', $project));

        $this->assertDatabaseHas('tasks', [
            ...$taskData,
            'project_id' => $project->id
        ]);
    }
}