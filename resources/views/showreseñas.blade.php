@extends('layout.sidebar')    

@section('title', 'Ver Reseñas')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4" style="font-size: 2rem; color: #be952c;">¡ve nuestras reseñas!</h1>
        
        <div class="list-group">
            @foreach($reseñas as $reseña)
                <div class="list-group-item p-4 mb-3" style="background-color: #333; color: #fff; border-radius: 10px; border: 1px solid #444;">
                    <p style="font-size: 1.2rem; font-style: italic;">"{{ $reseña->contenido }}"</p>
                    <div class="d-flex justify-content-between">
                        <small class="text-muted" style="font-size: 1rem;">Por: Usuario #{{ $reseña->usuario_id }}</small>
                        <span class="badge rounded-pill" style="background-color: #be952c;">¡Gracias por tu reseña!</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('styles')
    
@endpush
