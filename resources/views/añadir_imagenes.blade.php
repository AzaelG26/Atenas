@extends('layout.g_base')

@section('tittle', 'Añadir Imagenes')

@section('content')
<div class="container mt-5 pt-5">
    @foreach ($categorias as $categoria)
        <h2 id="Categoria_{{ $categoria->id }}" class="text-center my-4">{{ $categoria->name }}</h2>
        <div class="row menu-container">
            @foreach ($categoria->menu as $menu)
                <div class="col-md-4">
                    <div class="card menu-card">
                        <!-- Imagen del producto, si tiene -->
                        @if($menu->imagenes->isNotEmpty())
                            <img src="{{ Storage::url($menu->imagenes->first()->file_path) }}" class="card-img-top" alt="{{ $menu->name }}">

                        @else
                            <img src="path/to/default/image.jpg" class="card-img-top" alt="Imagen no disponible">
                        @endif
                        
                        <div class="card-body">
                            <h5 class="card-title">{{ $menu->name }}</h5>
                            <p class="card-text">{{ $menu->description }}</p>
                            <p class="card-text">Precio: MX${{ $menu->price }}</p>
                            
                            <!-- Formulario para modificar y añadir imagen -->
                            <form action="{{ route('imagenes.store') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                                @csrf
                                <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                
                                <div class="mb-3">
                                    <label for="file_path" class="form-label">Subir Imagen</label>
                                    <input type="file" class="form-control" name="file_path" id="file_path" required>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Guardar Imagen</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>

@endsection