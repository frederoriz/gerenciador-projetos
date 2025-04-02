@extends('layouts.app')
@section('content')
    <h1>Tarefas do Projeto: {{ $project->title }}</h1>
    <a href="{{ route('projects.tasks.create', ['project' => $project->id]) }}" class="btn btn-primary">Nova Tarefa</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Descrição</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @if ($tasks->isEmpty())
                @include('components.empty-state', [
                    'icon' => 'fa-tasks',
                    'title' => 'Nenhuma tarefa cadastrada',
                ])
            @else
                @foreach ($project->tasks as $task)
                    <tr>
                        <td>{{ $task->description }}</td>
                        <td>{{ $taskStatus[$task->status] }}</td>
                        <td>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection
