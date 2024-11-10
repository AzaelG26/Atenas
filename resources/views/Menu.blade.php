@extends('layout.g_base')

@section('title', 'Menu')

@section('styles')

    <style>

    html {
        scroll-behavior: smooth;
    }
        
        /* Imagen de cabecera */
        .header-image {
            width: 100%;
            height: 200px;
            background: url('/path-to-your-image/atenas1.png') no-repeat center center;
            background-size: cover;
        }

        /* Barra lateral responsiva */
        .side-menu {
            background-color: #000;
            color: white;
            padding: 20px;
            width: 280px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            transition: transform 0.3s ease;
            z-index: 1050;
        }

        /* Botón para abrir el menú lateral */
        .side-menu-toggle {
            position: fixed;
            top: 20px;
            left: 20px;
            font-size: 24px;
            color: #FFD700;
            background: none;
            border: none;
            z-index: 1100;
            display: none; /* Ocultar en pantallas grandes */
        }

        /* Mostrar el botón en pantallas pequeñas */
        @media (max-width: 992px) {
            .side-menu-toggle {
                display: block;
            }
        }

        /* Botón para cerrar el menú lateral */
        .side-menu-close {
            font-size: 24px;
            color: #FFD700;
            background: none;
            border: none;
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 1100;
            display: none; /* Mostrar solo en modo móvil */
        }

        /* Responsividad para la barra lateral */
       /* Mostrar el botón de apertura solo en pantallas pequeñas */
    @media (max-width: 992px) {
        .side-menu-toggle {
            display: block;
        }

        /* Configuración para el menú lateral en pantallas pequeñas */
        .side-menu {
            transform: translateX(-100%); /* Oculto inicialmente */
        }

        /* Mostrar el menú lateral al activar la clase "show" */
        .side-menu.show {
            transform: translateX(0);
        }

        /* Mostrar el botón de cierre solo cuando el menú esté abierto */
        .side-menu.show .side-menu-close {
            display: block;
        }
    }

    /* Ocultar ambos botones en pantallas grandes */
    @media (min-width: 992px) {
        .side-menu-toggle, .side-menu-close {
            display: none;
        }

        /* Mantener el menú siempre visible en pantallas grandes */
        .side-menu {
            transform: translateX(0);
        }
    }

        .side-menu h4, .side-menu a {
            color: #ffffff;
        }

        .side-menu hr {
            border-top: 1px solid #ffffff;
            opacity: 0.3;
        }

        .side-menu .nav-link {
            color: #ffffff;
            font-size: 1rem;
            display: flex;
            align-items: center;
            transition: color 0.3s ease;
        }

        .side-menu .nav-link svg {
            margin-right: 8px;
        }

        .side-menu .nav-link:hover {
            color: #FFD700;
        }

        /* Tarjetas de menú */
        .menu-container .menu-card {
            margin-bottom: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .menu-container .menu-card:hover {
            transform: scale(1.05);
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
        }

        /* Botón dentro de la tarjeta */
        .btn-add {
            background-color: black;
            color: white;
            border: none;
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .btn-add:hover {
            background-color: #131718;
            color: #FFD700;
        }

        /* Ajuste de columnas en dispositivos pequeños */
        @media (max-width: 992px) {
            .menu-container .col-md-4 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
        @media (min-width: 992px) {
        .side-menu-toggle {
            display: none;
        }
    }

    .btn-cart {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 1000;
    background-color: #007bff;
    color: #fff;
    padding: 10px;
    border-radius: 50%;
}

    </style>
@endsection

@section('content')
<button class="side-menu-toggle" id="openMenuButton" onclick="toggleSideMenu()">
    ☰
</button>

<div class="d-flex">
    <!-- Barra lateral de categorías -->
    <div class="side-menu" id="sideMenu">
        <!-- Botón de cierre para el menú lateral -->
        <button class="side-menu-close" id="closeMenuButton" onclick="toggleSideMenu()">
            ×
        </button>
        
        <h4>Categorías</h4>
        <hr>
        <ul class="nav flex-column mb-auto">
            @foreach ($categorias as $categoria)
                <li class="nav-item">
                    <a class="nav-link" href="#Categoria_{{ $categoria->id }}">
                        <svg class="bi pe-none" width="16" height="16"><use xlink:href="#icon-name"></use></svg>
                        {{ $categoria->name }}
                    </a>
                </li>
            @endforeach
        </ul>
        <hr>
    </div>

    <!-- Botón para abrir el modal del carrito -->
    <button onclick="toggleCart()" class="btn btn-cart">
        🛒 Carrito (<span id="cart-count">0</span>)
    </button>

    <!-- Contenido principal -->
    <div class="container mt-5 pt-5">
        @foreach ($categorias as $categoria)
            <h2 id="Categoria_{{ $categoria->id }}" class="text-center my-4">{{ $categoria->name }}</h2>
            <div class="row menu-container">
                @foreach ($categoria->menu as $menu)
                    <div class="col-md-4">
                        <div class="card menu-card">
                            <img src="path/to/image.jpg" class="card-img-top" alt="{{ $menu->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $menu->name }}</h5>
                                <p class="card-text">{{ $menu->description }}</p>
                                <p class="card-text">Precio: MX${{ $menu->price }}</p>
                                <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#modal{{ $menu->id }}">Ver Detalles</button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para detalles del producto -->
                    <div class="modal fade" id="modal{{ $menu->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $menu->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel{{ $menu->id }}">{{ $menu->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                </div>
                                <div class="modal-body">
                                    <img src="path/to/image.jpg" alt="{{ $menu->name }}" class="img-fluid">
                                    <p>{{ $menu->description }}</p>
                                    <h6 class="mt-3">Precio: MX${{ $menu->price }}.00</h6>
                                    <button class="btn btn-primary" onclick="addToCart('{{ $menu->name }}', '{{ $menu->price }}')">Agregar al Carrito</button>
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
</div>

<!-- Modal del Carrito -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartModalLabel">Carrito de Compras</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body" id="cart-items">
                <!-- Aquí se mostrarán los elementos del carrito -->
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
// Inicializa el carrito desde localStorage
let cart = JSON.parse(localStorage.getItem('cart')) || [];

// Actualiza la cantidad de elementos en el carrito
function updateCartCount() {
    document.getElementById('cart-count').textContent = cart.length;
}

// Agrega un producto al carrito
function addToCart(name, price) {
    if (isNaN(price)) {
        console.error(`Error: El precio no es un número. Precio: ${price}`);
        return;
    }
    cart.push({ name, price: parseFloat(price) });
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();
    alert(`${name} añadido al carrito.`);
}

// Muestra los productos en el carrito dentro del modal
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

// Elimina un producto del carrito
function removeFromCart(index) {
    cart.splice(index, 1);
    localStorage.setItem('cart', JSON.stringify(cart));
    toggleCart();
    updateCartCount();
}

// Al cargar la página, inicializa el contador del carrito
document.addEventListener('DOMContentLoaded', function () {
    updateCartCount();
});
</script>

<script>
  function toggleSideMenu() {
    const sideMenu = document.getElementById("sideMenu");
    const openButton = document.getElementById("openMenuButton");
    const closeButton = document.getElementById("closeMenuButton");

    // Alternar la clase "show" para mostrar/ocultar el menú
    sideMenu.classList.toggle("show");

    // Mostrar u ocultar los botones según el estado del menú y el ancho de pantalla
    if (window.innerWidth <= 992) {
        if (sideMenu.classList.contains("show")) {
            openButton.style.display = "none";
            closeButton.style.display = "block";
        } else {
            openButton.style.display = "block";
            closeButton.style.display = "none";
        }
    }
}

// Asegúrate de ocultar los botones en pantallas grandes al redimensionar
window.addEventListener('resize', () => {
    const openButton = document.getElementById("openMenuButton");
    const closeButton = document.getElementById("closeMenuButton");
    if (window.innerWidth > 992) {
        openButton.style.display = "none";
        closeButton.style.display = "none";
    } else if (!document.getElementById("sideMenu").classList.contains("show")) {
        openButton.style.display = "block";
        closeButton.style.display = "none";
    }
});

 // Función para desplazarse suavemente hasta la categoría
 function scrollToCategory(event, categoryId) {
      event.preventDefault(); // Evita el salto instantáneo
      const categoryElement = document.getElementById(categoryId);
      if (categoryElement) {
          window.scrollTo({
              top: categoryElement.offsetTop - 80, // Ajusta la posición según la altura del menú superior
              behavior: 'smooth' // Habilita desplazamiento suave
          });
      }
  }

</script>
@endsection