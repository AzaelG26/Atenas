@extends('layouts.g_base')

@section('title', 'Menu') 

@section('styles')
    <style>
.header-image {
    width: 100%;
    height: 200px;
    background: url('/path-to-your-image/atenas1.png') no-repeat center center;
    background-size: cover;
}

.menu-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start; /* Alinea las tarjetas a la izquierda */
    padding: 20px;
}

.menu-card {
    width: 100%;
    max-width: 18rem;
    margin: 15px;
    border: none;
    background-color: #f5f5f5;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    transition: transform 0.3s ease;
}

.menu-card:hover {
    transform: translateY(-5px);
}

.menu-card img {
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
    width: 100%;
    height: auto;
}

.card-title, .card-price {
    font-weight: bold;
}

.card-price {
    color: #ff5722;
}

.btn-add {
    background-color: black; /* Azul marino oscuro */
    color: white;
    border: none;
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    position: relative;
    overflow: hidden;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.btn-add::after {
    content: '';
    position: absolute;
    width: 0;
    height: 3px;
    left: 50%;
    bottom: 0;
    background-color: #FFD700; /* Dorado */
    transition: width 0.4s ease, left 0.4s ease;
}

.btn-add:hover::after {
    width: 100%;
    left: 0;
}

.btn-add:hover {
    background-color: #131718; /* Azul más claro al hacer hover */
    color: #FFD700; /* Texto dorado */
}


.btn-shiny {
    background-color: #0C1011; /*#0C1011 */
    color: white;
    border: none;
    width: 100%;
    padding: 10px;
    position: relative;
    overflow: hidden;
    border-radius: 8px;
    transition: color 0.3s ease;
}

.btn-shiny::after {
    content: '';
    position: absolute;
    width: 0;
    height: 3px;
    left: 50%;
    bottom: 0;
    background-color: #FFD700;
    transition: width 0.4s ease, left 0.4s ease;
}

.btn-shiny:hover::after {
    width: 100%;
    left: 0;
}

.btn-shiny:hover {
    color: #FFD700;
}

.side-menu, .navbar {
    background-color: #333;
    color: white;
}

.side-menu a, .navbar-nav .nav-link {
    color: white;
    padding: 10px 15px;
    display: block;
    text-decoration: none;
    transition: background 0.3s ease;
}

.side-menu a:hover, .navbar-nav .nav-link:hover {
    background-color: #2c3e50;
}

/* Efecto brilloso en los enlaces del menú */
.side-menu a.btn-shiny, .navbar-nav .nav-link.btn-shiny {
    background-color: transparent;
    padding: 10px 15px;
    color: white;
    text-decoration: none;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.side-menu a.btn-shiny::after, .navbar-nav .nav-link.btn-shiny::after {
    background-color: #FFD700;
}

.navbar-toggler {
    margin-left: auto; 
}

.dropdown-menu {
    right: 0; 
    left: auto;
}

.navbar-nav .nav-link {
    font-size: 0.9rem;
}

.side-menu {
    position: fixed;
    left: 0;
    top: 0;
    width: 200px;
    height: 100%;
    padding: 20px;
    background-color: #333;
}

@media (max-width: 768px) {
    .menu-card {
        width: calc(50% - 30px); /* Dos tarjetas por fila en pantallas medianas */
    }
}

@media (max-width: 576px) {
    .menu-card {
        width: 100%; /* Una tarjeta por fila en pantallas pequeñas */
    }
}

.modal-dialog {
    max-width: 650px; /* Cambia el tamaño del modal */
    margin: 30px auto;
}

.modal-content {
    border-radius: 15px;
    padding: 20px;
}

.modal-body img {
    width: 100%;
    height: auto;
    max-width: 600px; /* Establece el tamaño máximo de la imagen */
    display: block;
    margin: 0 auto 15px;
    border-radius: 15px;
}

@media (max-width: 768px) {
    .modal-dialog {
        max-width: 90%;
    }

    .modal-body img {
        max-width: 100%;
    }
}

@media (max-width: 576px) {
    .modal-dialog {
        max-width: 100%;
        margin: 10px;
    }

    .modal-body img {
        max-width: 100%;
    }
}


@media (max-width: 950px) {
    .side-menu {
        display: none; 
    }

    .content-wrapper {
        margin-left: 0; 
    }
}

@media (max-width: 576px) {
    .navbar-nav .nav-link {
        font-size: 0.8rem;
    }
}

.btn-pay {
        background-color: #0C1011;
        color: white;
        font-weight: bold;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }
    .btn-pay:hover {
        background-color: #218838;
    }
    .quantity-selector {
        font-size: 1.2rem;
    }

    .cart-icon {
            position: relative;
            font-size: 1.5rem;
            color: white;
            cursor: pointer;
        }

        .cart-count {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: #ff5722;
            color: white;
            border-radius: 50%;
            padding: 3px 6px;
            font-size: 0.8rem;
        }

    </style>
@endsection

@section('content')
<div class="header-image"></div>

<nav class="navbar navbar-expand-md navbar-dark bg-dark d-md-none">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav ms-auto">
                <!-- Categorías del menú -->
            </ul>
        </div>
    </div>
</nav>

<aside class="side-menu d-none d-md-block">
    <h4 class="text-center">Categorías</h4>
    @foreach ($categorias as $categoria)
        <a href="#Categoria_{{ $categoria->nombre }}" class="btn-shiny">{{ $categoria->nombre }}</a>
    @endforeach
</aside>

<div class="container mt-4">
    <div class="d-flex justify-content-end">
        <div class="cart-icon" onclick="toggleCart()">
            🛒
            <span class="cart-count" id="cart-count">0</span>
        </div>
    </div>

    @foreach ($categorias as $categoria)
        <h2 id="Categoria_{{ $categoria->nombre }}" class="text-center my-4">{{ $categoria->nombre }}</h2>
        <div class="row menu-container">
            @foreach ($categoria->comidas as $comida)
                <div class="col-md-4">
                    <div class="card menu-card">
                        <img src="{{ asset('images/' . $comida->nombre . '.png') }}" class="card-img-top" alt="{{ $comida->nombre }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $comida->nombre }}</h5>
                            <p class="card-text">{{ $comida->descripcion }}</p>
                            <p class="card-text">Precio: MX${{ number_format($comida->precio, 2) }}</p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal{{ $comida->id }}">Ver Detalles</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>

@foreach ($categorias as $categoria)
    @foreach ($categoria->comidas as $comida)
        <div class="modal fade" id="modal{{ $comida->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $comida->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel{{ $comida->id }}">{{ $comida->nombre }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="{{ asset('images/' . $comida->nombre . '.png') }}" alt="{{ $comida->nombre }}" class="img-fluid">
                        <p>{{ $comida->descripcion }}</p>
                        <h6 class="mt-3">Precio: MX${{ number_format($comida->precio, 2) }}</h6>
                        <!-- Pasamos el precio como un número real -->
                        <button class="btn btn-primary" onclick="addToCart('{{ $comida->nombre }}', {{ $comida->precio }})">Agregar al Carrito</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endforeach

<!-- Modal para el carrito -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartModalLabel">Carrito de Compras</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body" id="cart-items">
                <!-- Aquí se mostrarán los productos -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    updateCartCount();
});

// Recuperar el carrito almacenado o inicializarlo vacío
let cart = JSON.parse(localStorage.getItem('cart')) || [];

// Actualizar el conteo del carrito
function updateCartCount() {
    document.getElementById('cart-count').textContent = cart.length;
}

// Añadir un producto al carrito
function addToCart(name, price) {
    if (isNaN(price)) {
        console.error(`Error: El precio recibido no es un número. Precio: ${price}`);
        return;
    }
    cart.push({ name, price });
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();
    alert(`${name} añadido al carrito.`);
}


// Mostrar el contenido del carrito
function toggleCart() {
    const cartItemsContainer = document.getElementById('cart-items');
    cartItemsContainer.innerHTML = '';
    let total = 0;
    
    if (cart.length === 0) {
        cartItemsContainer.innerHTML = '<p>No hay productos en el carrito.</p>';
    } else {
        cart.forEach((item, index) => {
            total += item.price;
            const itemRow = document.createElement('div');
            itemRow.classList.add('cart-item');
            itemRow.innerHTML = `
                <p>${item.name} - MX$${item.price.toFixed(2)}</p>
                <button onclick="removeFromCart(${index})" class="btn btn-sm btn-outline-danger">Eliminar</button>
            `;
            cartItemsContainer.appendChild(itemRow);
        });
        cartItemsContainer.innerHTML += `<h5>Total: MX$${total.toFixed(2)}</h5>`;
    }
    
    const cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
    cartModal.show();
}

// Eliminar un producto del carrito
function removeFromCart(index) {
    cart.splice(index, 1);
    localStorage.setItem('cart', JSON.stringify(cart));
    toggleCart();
    updateCartCount();
}

</script>
@endsection
