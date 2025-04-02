<div class="card border-0 shadow-sm">
    <div class="card-body text-center py-5">
        <i class="fas {{ $icon ?? 'fa-inbox' }} fa-3x text-muted mb-3"></i>
        <h4 class="text-muted">{{ $title ?? 'Nenhum registro encontrado' }}</h4>
        <p class="text-muted mb-0">{{ $message ?? 'Quando houver dados, eles aparecerão aqui' }}</p>
        
        @isset($action)
            <div class="mt-3">
                {{ $action }}
            </div>
        @endisset
    </div>
</div>