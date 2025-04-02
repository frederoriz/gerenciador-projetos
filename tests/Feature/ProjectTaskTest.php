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
     * Testa a listagem de tarefas de um projeto.
     *
     * @return void
     */
    public function lista_tarefas_do_projeto()
    {
        $project = Project::factory()
            ->hasTasks(3)
            ->create();

        $response = $this->get(route('projects.tasks.index', $project));
        $response->assertOk()
            ->assertViewHas('tasks');
    }

    /**
     * Testa o formulário de criação de tarefa.
     *
     * @return void
     */
    public function cria_tarefa_no_projeto()
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