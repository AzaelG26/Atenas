@extends('layout.g_base')

@section('title', 'Menu')

@section('styles')
    <style>
        body {
            background-color: #0C1011;
        }

        html {
            scroll-behavior: smooth;
        }

        .d-flex {
            border-bottom: 1px solid #FFD700;
        }

        /* Imagen de cabecera */
        .header-image {
            width: 100%;
            height: 200px;
            background: url('/path-to-your-image/atenas1.png') no-repeat center center;
            background-size: cover;
        }

        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card .card-title {
            font-size: 18px;
            font-weight: bold;
        }

        .menu-container {
            gap: 20px;
        }

        .menu-card img {
            border-radius: 10px;
        }
    </style>
@endsection

@section('content')
<div class="container-fluid mt-3">
    <div class="pb-1 mb-4" style="color: white; display: flex; justify-content:flex-end;">  
        @if (Auth::check() && optional(Auth::user()->people)->employees && Auth::user()->people->employees->admin == true)  
            <a href="{{route('edit.menu')}}" style="text-decoration: none; color:black">
                <button type="button" class="btn btn-warning">
                    <i class="bi bi-pencil-square"></i> Editar    
                </button>
            </a>
        @endif
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
                                <p>{{ $menu->description }}</p>
                                <h6>Precio: MX${{ $menu->price }}.00</h6>
                                <p>Stock disponible: 
                                    <strong id="stock{{ $menu->id_menu }}">{{ $menu->stock->stock ?? 'Sin stock' }}</strong>
                                </p>

                                @if ($menu->stock && $menu->stock->stock > 0)
                                    <div class="d-flex align-items-center">
                                        <button class="btn btn-secondary" onclick="decreaseQuantity('{{ $menu->id_menu }}')">-</button>
                                        <input type="number" id="quantity{{ $menu->id_menu }}" class="form-control mx-2 text-center" value="1" min="1" max="{{ $menu->stock->stock }}" readonly style="width: 70px;">
                                        <button class="btn btn-primary" onclick="increaseQuantity('{{ $menu->id_menu }}', '{{ $menu->stock->stock }}')" id="button{{ $menu->id_menu }}">+</button>
                                    </div>

                                    <button class="btn btn-success mt-3" 
                                        onclick="addToCart('{{ $menu->name }}', '{{ $menu->price }}', '{{ $menu->id_menu }}')">
                                        Agregar al Carrito
                                    </button>
                                @else
                                    <p class="text-danger mt-3">Producto sin stock</p>
                                @endif
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
            <div class="modal-body" id="cart-items"></div>
            <div class="modal-footer">
                <button type="button" onclick="clearCart()" class="btn btn-danger mt-3">Vaciar Carrito</button>
                <button type="button" onclick="confirmCart()" class="btn btn-success mt-3">Confirmar Carrito</button>
                <button type="button" class="btn btn-secondary" id="btn-cerrar-modal" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">

@if (session('success'))
    <script>
        alert('{{ session('success') }}')
    </script>
@endif

@if (session('error'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'error',
            title: '¡Error!',
            text: '{{ session('error') }}',
            confirmButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
        });
    </script>
@endif
@endsection


