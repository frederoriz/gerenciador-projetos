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
            @if ($projects->isEmpty())
                @include('components.empty-state', [
                    'icon' => 'fa-tasks',
                    'title' => 'Nenhum projeto cadastrado',
                ])
            @else
                @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->created_at->format('d/m/Y') }}</td>
                        <td>{{ $project->end_date->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('projects.tasks.index', $project) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('projects.tasks.create', $project) }}" class="btn btn-sm btn-success">
                                <i class="fas fa-plus"></i>
                            </a>
                            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
                                style="display:inline;">
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
