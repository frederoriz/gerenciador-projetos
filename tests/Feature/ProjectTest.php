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
     * @return void
     */
    public function lista_projetos()
    {
        Project::factory()->count(3)->create();

        $response = $this->get(route('projects.index'));
        $response->assertOk()
            ->assertViewHas('projects');
    }

    /**
     * Test the project creation form.
     *
     * @return void
     */
    public function cria_projeto_valido()
    {
        $data = [
            'title' => 'Novo Projeto',
            'due_date' => now()->addWeek()->format('Y-m-d')
        ];

        $this->post(route('projects.store'), $data)
            ->assertRedirect(route('projects.index'));

        $this->assertDatabaseHas('projects', $data);
    }

    /**
     * Test the project creation form with invalid data.
     *
     * @return void
     */
    public function valida_campos_obrigatorios()
    {
        $this->post(route('projects.store'), [])
            ->assertSessionHasErrors(['title', 'due_date']);
    }
}
