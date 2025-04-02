<?php

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function edita_tarefa()
    {
        $task = Task::factory()->create();

        $this->get(route('tasks.edit', $task))
            ->assertOk()
            ->assertViewHas('task');
    }

    /** @test */
    public function atualiza_tarefa()
    {
        $task = Task::factory()->create(['description' => 'Antiga']);

        $this->put(route('tasks.update', $task), [
            'description' => 'Nova descrição'
        ])->assertRedirect(route('projects.tasks.index', $task->project));

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'description' => 'Nova descrição'
        ]);
    }
}
