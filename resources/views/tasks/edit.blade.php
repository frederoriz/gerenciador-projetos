@extends('layouts.app')
@section('content')
    <h1>Editar Tarefa</h1>
    <form action="{{ route('tasks.update', $task) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <div class="mb-3">
            <label for="project" class="form-label">Projeto*</label>
            <input type="text" class="form-control" id="project" name="project" value="{{ $project->title }}" readonly>
        </div>

        <div class="mb-3">
            <label for="status">Status</label>
            <select class="form-select" id="status" name="status" required>
                @php
                    $selected = old('status') ?? $task->status;
                @endphp
                @foreach ($taskStatus as $key => $value)
                    <option value="{{ $key }}" @if ($selected == $key) selected @endif> {{ $value }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrição*</label>
            <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description') ?? $task->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
@endsection
