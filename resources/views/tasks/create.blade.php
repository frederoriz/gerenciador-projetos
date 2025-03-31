@extends('layouts.app')
@section('content')
<h1>Criar Tarefa</h1>
<form action="{{ route('tasks.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="project" class="form-label">Projeto*</label>
        <input type="text" class="form-control" id="project" name="project" value="{{ $project->title }}" readonly>
    </div>

    <input type="hidden" name="project_id" value="{{ $project->id }}">

    <div class="mb-3">
        <label for="status">Status</label>
        <select class="form-select" id="status" name="status" required>
            @php
                $selected = old('status') ?? '';
            @endphp
            <option value="" disabled selected>Selecione o status</option>
            @foreach ($taskStatus as $key => $value)
                <option value="{{ $key }}" @if ($selected == $key) selected @endif> {{ $value }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="due_date" class="form-label">Data de Entrega*</label>
        <input type="date" class="form-control" id="due_date" name="due_date" value="{{ old('due_date') }}" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Descrição*</label>
        <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
    </div>

    <button type="submit" class="btn btn-success">Salvar</button>
</form>

@endsection
