<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatus;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    /**
     * Exibe uma lista do recurso.
     */
    public function index(Project $project)
    {
        $taskStatus = TaskStatus::list();
        $tasks = $project->tasks()->orderBy('created_at', 'desc')->get();
        return view('tasks.index', compact('project', 'tasks', 'taskStatus'));
    }

    /**
     * Mostra o formulário para criar um novo recurso.
     */
    public function create(Project $project)
    {
        $taskStatus = TaskStatus::list();
        return view('tasks.create', compact('project', 'taskStatus'));
    }

    /**
     * Armazena um recurso recém-criado no armazenamento.
     */
    public function store(Request $request, Project $project)
    {
        $validated = $this->validator($request);
        $project->tasks()->create($validated);

        return redirect()->route('projects.tasks.index', $project)
            ->with('success', 'Tarefa criada com sucesso!');
    }

    /**
     * Mostra o formulário para editar o recurso especificado.
     */
    public function edit(Task $task)
    {
        $project = $task->project;
        $taskStatus = TaskStatus::list();
        return view('tasks.edit', compact('task', 'project', 'taskStatus'));
    }

    /**
     * Atualiza o recurso especificado no armazenamento.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $this->validator($request);
        $task->update($validated);

        return redirect()->route('projects.tasks.index', $task->project)
            ->with('success', 'Tarefa atualizada com sucesso!');
    }

    /**
     * Remove o recurso especificado do armazenamento.
     */
    public function destroy(Task $task)
    {
        $project = $task->project;
        $task->delete();

        return redirect()->route('projects.tasks.index', $project)
            ->with('success', 'Tarefa excluída com sucesso!');
    }

    /**
     * Valida os dados da requisição.
     */
    private function validator(Request $request)
    {
        return $request->validate([
            'description' => 'required|string|max:1000',
            'status' => ['required', Rule::enum(TaskStatus::class)],
        ]);
    }
}
