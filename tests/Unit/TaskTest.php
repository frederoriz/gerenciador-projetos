<?php

namespace Tests\Unit;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function pertence_a_um_projeto()
    {
        $task = Task::factory()->create();
        $this->assertNotNull($task->project);
    }

    /** @test */
    public function status_padrao_e_pendente()
    {
        $task = Task::factory()->create(['status' => null]);
        $this->assertEquals('pending', $task->fresh()->status);
    }
}