<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        try {
            $projects = Project::all();
            return view('projects.index', compact('projects'));
        } catch (\Exception $e) {
            return redirect()->route('projects.index')->with('error', 'Erro ao carregar os projetos.');
        }
    }

    public function create()
    {
        try {
            return view('projects.create');
        } catch (\Exception $e) {
            return redirect()->route('projects.index')->with('error', 'Erro ao carregar o formulário de criação.');
        }
    }

    public function store(Request $request)
    {
        try {
            $this->validator($request);

            Project::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'end_date' => $request->input('end_date'),
            ]);

            return redirect()->route('projects.index')->with('success', 'Projeto criado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('projects.index')->with('error', 'Erro ao criar o projeto.');
        }
    }

    public function edit(Project $project)
    {
        try {
            $project = Project::find($project->id);

            if (!$project) {
                return redirect()->route('projects.index')->with('error', 'Projeto não encontrado.');
            }

            return view('projects.edit', compact('project'));
        } catch (\Exception $e) {
            return redirect()->route('projects.index')->with('error', 'Erro ao carregar o formulário de edição.');
        }
    }

    public function update(Request $request, Project $project)
    {
        try {
            $this->validator($request);

            $project->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'end_date' => $request->input('end_date'),
            ]);

            return redirect()->route('projects.index')->with('success', 'Projeto atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('projects.index')->with('error', 'Erro ao atualizar o projeto.');
        }
    }

    public function destroy(Project $project)
    {
        try {
            $project->delete();

            return redirect()->route('projects.index')->with('success', 'Projeto excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('projects.index')->with('error', 'Erro ao excluir o projeto.');
        }
    }

    private function validator(Request $request)
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'end_date' => 'required|date',
        ]);
    }
}
