@extends('layout.g_base')

@section('title', 'Menu')
    <script nomodule src="https://cdn.jsdelivr.net/npm/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

@section('styles')

    <style>
        body{
            background-color: #0C1011;
        }
        html {
            scroll-behavior: smooth;
        }
        .d-flex{
            border-bottom: 1px solid #FFD700;
        }
        
        /* Imagen de cabecera */
        .header-image {
            width: 100%;
            height: 200px;
            background: url('/path-to-your-image/atenas1.png') no-repeat center center;
            background-size: cover;
        }
    </style>
    @push('styles')

@endsection

@section('content')
<div class="container-fluid mt-3">
    <div class="pb-1 mb-4" style="color: white; display: flex; justify-content:flex-end;">
        
        <a href="{{route('edit.menu')}}" style="text-decoration: none; color:black">
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="bi bi-pencil-square"></i> Editar    
            </button>
        </a>
    </div>
</div>

<div class="container mt-5 pt-5">
    

    @foreach ($categorias as $categoria)
        <div id="Categoria_{{ $categoria->id }}" class="pb-3 mb-4" style="border-bottom: 1px solid #ce9d22; color: white; display: flex; justify-content:space-between;">
            <span class="fs-4 subtitle-persons"> &nbsp; &nbsp;{{ $categoria->name }}</span>                  
        </div>
        
        <div class="row menu-container">
            @foreach ($categoria->menu as $menu)
                <div class="col-md-4">
                    <div class="card menu-card">
                        <img src="path/to/image.jpg" class="card-img-top" alt="{{ $menu->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $menu->name }}</h5>
                            <p class="card-text">{{ $menu->description }}</p>
                            <p class="card-text">Precio: MX${{ $menu->price }}</p>
                            <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#modal{{ $menu->id_menu }}">Ver Detalles</button>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modal{{ $menu->id_menu }}" tabindex="-1" aria-labelledby="modalLabel{{ $menu->id_menu }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel{{ $menu->id_menu }}">{{ $menu->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                <img src="path/to/image.jpg" alt="{{ $menu->name }}" class="img-fluid">
                                <p>{{ $menu->description }}</p>
                                <h6 class="mt-3">Precio: MX${{ $menu->price }}.00</h6>
                                <p>Stock disponible: <strong id="stock{{ $menu->id_menu }}">{{ $menu->stock->stock }}</strong></p>

                                <div class="d-flex align-items-center">
                                    <button class="btn btn-secondary" onclick="decreaseQuantity('{{ $menu->id_menu }}')">-</button>
                                    <input type="number" id="quantity{{ $menu->id_menu }}" class="form-control mx-2 text-center" value="1" min="1" max="{{ $menu->stock->stock }}" readonly style="width: 70px;">
                                    <button class="btn btn-primary" onclick="increaseQuantity('{{ $menu->id_menu }}', '{{ $menu->stock->stock }}')" data-menu-id="{{ $menu->id_menu }}">+</button>

                                </div>

                                <button class="btn btn-success mt-3" 
                                    onclick="addToCart('{{ $menu->name }}', '{{ $menu->price }}', '{{ $menu->id_menu }}')">
                                    Agregar al Carrito
                                </button>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>

    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartModalLabel">Carrito de Compras</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body" id="cart-items">
                
                </div>
                <div class="modal-footer">
                    <button onclick="clearCart()" class="btn btn-danger">Vaciar Carro</button>
                    <button type="button" onclick="confirmCart()" class="btn btn-success mt-3">Confirmar Carrito</button>
                    <button type="button" class="btn btn-secondary" id="btn-cerrar-modal" data-bs-dismiss="modal">Cerrar</button>
                </div>

            </div>
        </div>
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">


    @if (session('success'))
        <script>
            alert("{{ session('success') }}")
        </script>
    @endif

@endsection


