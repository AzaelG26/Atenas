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
@endsection

@section('content')


    {{-- <!-- Botón para abrir el modal del carrito -->
    <button onclick="toggleCart()" class="btn-cart">
        <i class="bi bi-cart3"></i> Carrito (<span id="cart-count">0</span>)
    </button> --}}

    <!-- Contenido principal -->
    <div class="container mt-5 pt-5">
        @foreach ($categorias as $categoria)
            <h2 id="Categoria_{{ $categoria->id }}" class="text-center my-4" id="title-name-category" style="border-bottom: 1px solid #ce9d22; color: white; height:2em"> &nbsp;&nbsp;{{ $categoria->name }}</h2>
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
                <button type="button" class="btn btn-secondary" id="btn-cerrar-modal" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endsection


{{-- @section('scripts')
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
@endsection --}}