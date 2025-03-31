
@extends('layouts.app')
@section('content')
<h1>Projetos</h1>
<a href="{{ route('projects.create') }}" class="btn btn-primary">Novo Projeto</a>
<table class="table mt-3">
    <thead>
        <tr>
            <th>Título</th>
            <th>Data de Criação</th>
            <th>Data de Entrega</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($projects as $project)
        <tr>
            <td>{{ $project->title }}</td>
            <td>{{ $project->created_at->format('d/m/Y') }}</td>
            <td>{{ $project->due_date->format('d/m/Y') }}</td>
            <td>
                <a href="{{ route('projects.show', $project->id) }}" class="btn btn-sm btn-info">Ver</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection