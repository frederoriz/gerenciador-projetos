<?php

namespace Tests\Feature;

use App\Enums\TaskStatus;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa a listagem de tarefas.
     *
     * @return void
     */
    public function edita_tarefa()
    {
        $task = Task::factory()->create();

        $this->get(route('tasks.edit', $task))
            ->assertOk()
            ->assertViewHas('task');
    }

    /**
     * Testa a criação de uma tarefa com dados válidos.
     *
     * @return void
     */
    public function atualiza_tarefa()
    {
        $task = Task::factory()->create([
            'description' => 'Antiga',
            'status' => TaskStatus::PENDING->value
        ]);

        $response = $this->put(route('tasks.update', $task), [
            'description' => 'Nova descrição',
            'status' => TaskStatus::COMPLETED->value // Campo obrigatório
        ]);

        $response->assertRedirect(route('projects.tasks.index', $task->project));

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'description' => 'Nova descrição',
            'status' => TaskStatus::COMPLETED->value
        ]);
    }
}
