@extends('layouts.app')
@section('content')
<h1>Criar Projeto</h1>
<form action="{{ route('projects.store') }}" method="POST">
    @method('POST')
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Título*</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
    </div>
    
    <div class="mb-3">
        <label for="end_date" class="form-label">Data de Entrega*</label>
        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}" required>
    </div>

    <div class="mb-3">
        <label for="title" class="form-label">Descrição*</label>
        <textarea class="form-control" id="description" name="description" rows="4">{{ old('description') }}</textarea>
    </div>

    <button type="submit" class="btn btn-success">Salvar</button>
</form>
@endsection
