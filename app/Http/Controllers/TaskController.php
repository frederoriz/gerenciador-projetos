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
        try {
            $taskStatus = TaskStatus::list();
            $tasks = $project->tasks()->orderBy('created_at', 'desc')->get();
            return view('tasks.index', compact('project', 'tasks', 'taskStatus'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Erro ao carregar as tarefas.');
        }
    }

    /**
     * Mostra o formulário para criar um novo recurso.
     */
    public function create(Project $project)
    {
        try {
            $taskStatus = TaskStatus::list();
            return view('tasks.create', compact('project', 'taskStatus'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Erro ao carregar o formulário de criação.');
        }
    }

    /**
     * Armazena um recurso recém-criado no armazenamento.
     */
    public function store(Request $request, Project $project)
    {
        try {
            $validated = $this->validator($request);
            $project->tasks()->create($validated);

            return redirect()->route('projects.tasks.index', $project)
                ->with('success', 'Tarefa criada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Erro ao criar a tarefa.');
        }
    }

    /**
     * Mostra o formulário para editar o recurso especificado.
     */
    public function edit(Task $task)
    {
        try {
            $project = $task->project;
            $taskStatus = TaskStatus::list();
            return view('tasks.edit', compact('task', 'project', 'taskStatus'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Erro ao carregar o formulário de edição.');
        }
    }

    /**
     * Atualiza o recurso especificado no armazenamento.
     */
    public function update(Request $request, Task $task)
    {
        try {
            $validated = $this->validator($request);
            $task->update($validated);

            return redirect()->route('projects.tasks.index', $task->project)
                ->with('success', 'Tarefa atualizada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Erro ao atualizar a tarefa.');
        }
    }

    /**
     * Remove o recurso especificado do armazenamento.
     */
    public function destroy(Task $task)
    {
        try {
            $project = $task->project;
            $task->delete();

            return redirect()->route('projects.tasks.index', $project)
                ->with('success', 'Tarefa excluída com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Erro ao excluir a tarefa.');
        }
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
