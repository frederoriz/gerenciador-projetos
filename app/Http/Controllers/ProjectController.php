<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Exibe uma lista dos recursos.
     */
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    /**
     * Mostra o formulário para criar um novo recurso.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Armazena um recurso recém-criado no armazenamento.
     */
    public function store(Request $request)
    {
        $this->validator($request);

        Project::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'end_date' => $request->input('end_date'),
        ]);

        return redirect()->route('projects.index')->with('success', 'Projeto criado com sucesso!');
    }

    /**
     * Mostra o formulário para editar o recurso especificado.
     */
    public function edit(Project $project)
    {

        $project = Project::find($project->id);

        if (!$project) {
            return redirect()->route('projects.index')->with('error', 'Projeto não encontrado.');
        }

        return view('projects.edit', compact('project'));
    }

    /**
     * Atualiza o recurso especificado no armazenamento.
     */
    public function update(Request $request, Project $project)
    {
        $this->validator($request);

        $project->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'end_date' => $request->input('end_date'),
        ]);

        return redirect()->route('projects.index')->with('success', 'Projeto atualizado com sucesso!');
    }

    /**
     * Remove o recurso especificado do armazenamento.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Projeto excluído com sucesso!');
    }

    /**
     * Valida os dados da requisição.
     *
     * @param Request $request
     * @return void
     */
    private function validator(Request $request)
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'end_date' => 'nullable|date',
        ]);
    }
}
