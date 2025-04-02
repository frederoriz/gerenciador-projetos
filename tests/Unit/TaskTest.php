<?php

namespace Tests\Unit;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa a criação de uma tarefa com dados válidos.
     *
     * @return void
     */
    public function pertence_a_um_projeto()
    {
        $task = Task::factory()->create();
        $this->assertNotNull($task->project);
    }

    /**
     * Testa a criação de uma tarefa com dados válidos.
     *
     * @return void
     */
    public function status_padrao_e_pendente()
    {
        $task = Task::factory()->create();
        $this->assertEquals('pending', $task->fresh()->status);
    }
}