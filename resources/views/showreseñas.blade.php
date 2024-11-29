@extends('layout.sidebar')

@section('title', 'Ver Reseñas')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4" style="font-size: 2rem; color: #be952c;">¡Ve nuestras reseñas!</h1>
        
        <div class="list-group">
            @foreach($reseñas as $reseña)
                <div class="list-group-item p-4 mb-3" style="background-color: #333; color: #fff; border-radius: 10px; border: 1px solid #444;">
                    <p style="font-size: 1.2rem; font-style: italic;">"{{ $reseña->contenido }}"</p>
                    <div class="d-flex justify-content-between">
                        <small class="text-muted" style="font-size: 1rem;">Por: Usuario #{{ $reseña->usuario_id }}</small>
                        <span class="badge rounded-pill" style="background-color: #be952c;">¡Gracias por tu reseña!</span>
                    </div>

                    <!-- Mostrar las estrellas basadas en el rating -->
                    <div class="mt-2">
                        @for($i = 1; $i <= 5; $i++)
                            @if($reseña->rating >= $i)
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#ff9e0b" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.396.195-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.32-.158-.888.283-.95l4.898-.696 2.178-4.455c.197-.403.73-.403.927 0l2.178 4.455 4.898.696c.441.062.612.63.283.95l-3.522 3.356.83 4.73c.078.443-.35.787-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#666" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.396.195-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.32-.158-.888.283-.95l4.898-.696 2.178-4.455c.197-.403.73-.403.927 0l2.178 4.455 4.898.696c.441.062.612.63.283.95l-3.522 3.356.83 4.73c.078.443-.35.787-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                            @endif
                        @endfor
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
