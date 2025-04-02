<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
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
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Projeto excluído com sucesso!');
    }

    /**
     * Validate the request data.
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
