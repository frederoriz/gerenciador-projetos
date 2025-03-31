@extends('layouts.app')
@section('content')
<h1>Tarefas do Projeto: {{ $project->title }}</h1>
<a href="{{ route('tasks.create', ['project' => $project->id]) }}" class="btn btn-primary">Nova Tarefa</a>
<table class="table mt-3">
    <thead>
        <tr>
            <th>Descrição</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($project->tasks as $task)
        <tr>
            <td>{{ $task->description }}</td>
            <td>{{ $task->status ? 'Concluída' : 'Pendente' }}</td>
            <td>
                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-warning">Editar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
