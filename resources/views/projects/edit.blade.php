@extends('layouts.app')
@section('content')
<h1>Editar Projeto</h1>
<form action="{{ route('projects.update') }}" method="PUT">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Título*</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') ?? $project->title }}" required>
    </div>

    <div class="mb-3">
        <label for="due_date" class="form-label">Data de Entrega*</label>
        <input type="date" class="form-control" id="due_date" name="due_date" value="{{ old('due_date') ?? $project->due_date }}" required>
    </div>

    <div class="mb-3">
        <label for="title" class="form-label">Descrição*</label>
        <textarea class="form-control" id="description" name="description" rows="4">{{ old('description') ?? $project->description }}</textarea>
    </div>

    <button type="submit" class="btn btn-success">Salvar</button>
</form>
@endsection

