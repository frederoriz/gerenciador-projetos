<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the project index route.
     *
     */
    public function test_list_projects()
    {
        Project::factory()->count(3)->create();

        $response = $this->get(route('projects.index'));
        $response->assertOk()
            ->assertViewHas('projects');
    }

    /**
     * Test the project creation form.
     *
     */
    public function test_create_valid_project()
    {
        $data = [
            'title' => 'Novo Projeto',
            'end_date' => now()->addWeek()->format('Y-m-d')
        ];

        $this->post(route('projects.store'), $data)
            ->assertRedirect(route('projects.index'));

        $this->assertDatabaseHas('projects', [
            'title' => $data['title'],
            'end_date' => $data['end_date'] . ' 00:00:00', // Adiciona o horário padrão
        ]);
    }

}
