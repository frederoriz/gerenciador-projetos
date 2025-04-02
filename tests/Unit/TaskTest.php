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
    public function test_belongs_to_a_project()
    {
        $task = Task::factory()->create();
        $this->assertNotNull($task->project);
    }

    /**
     * Test the creation of a task with valid data.
     *
     * @return void
     */
    public function test_default_status_is_pending()
    {
        $task = Task::factory()->create();
        $this->assertEquals('pending', $task->fresh()->status);
    }
}