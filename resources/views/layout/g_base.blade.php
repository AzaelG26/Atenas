
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Menú')</title>

    <link rel="icon" href="LOGO_ATENAS_high_quality_transparent.png">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
   

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="module" src="https://cdn.jsdelivr.net/npm/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>


    {{-- btn desplegable --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Layout</title>

    <style>
        body{
            background-color: #0C1011;
        }
        html {
            scroll-behavior: smooth;
        }
        .content {
            padding: 20px;
            overflow-y: auto;
        }
        @media (min-width: 992px) {
            .content {
                margin-left: 0;
            }
        }
        .links{
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-decoration: none;           
            color:#be952c;
            font-size: 17px;
            height: 50px;
        }
        .nav-item  {
            color: #be952c;                         
            transition: color 0.1s ease, box-shadow 0.1s ease, font-size 0.1s ease, background-color 0.1s ease;
            padding: 10px 15px; 
            position: relative;             
            font-family: "Karla", sans-serif;
            text-decoration: none; 
        }
        .nav-item:hover {
            background-color: rgb(35, 35, 46)
        }
/* 
        .nav-item .links:hover {
            text-decoration: none;
            font-size: 19px;
            color: #8CD2F0;   
            height: 100%;          
            cursor: pointer;
            background-color: transparent; 
        }

        .nav-item .links::after {
            content: '';
            position: absolute;
            width: 0;
            height: 3px;
            left: 0;
            bottom: 0;
            background-color: #ffc400;
            transition: width 0.5s ease;
        }

        .nav-item .links:hover::after {
            width: 100%; 
        } */
                 
        .nav-link:hover{
            color:#8CD2F0;
            /* filter: drop-shadow(0px 0px 1px rgb(151, 124, 116)); */
            font-size: 18px;
            background-color: #2929294b;


        } 
        .nav-link.active {
            background-color: #2929294b;
        }

        .btn-cart {
            right: 20px;
            z-index: 1000;
            background-color: #131718;
            color: #be952c;
            padding: 10px;
            border-radius: 10px;
            border: none;    
            transition: transform 0.2s ease;    
        }   
        .btn-cart:hover{
            transform: translateY(3px);
            box-shadow: 0px 0px 10px rgba(7, 7, 7, 0.959);
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
        /* Tarjetas de menú */
        .col-md-4 .menu-card {
            margin-bottom: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .col-md-4 .menu-card:hover {
            transform: scale(1.05);
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
        }
    
    </style>
        @stack('styles')
   
</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">      
            <a href="{{ route('welcome') }}" class="btn btn-warning d-flex align-items-center gap-2" style="text-decoration: none; color: white; background-color: #daa520; border: none; padding: 0.5rem 1rem; border-radius: 0.5rem;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                    <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
                </svg>
                <span>Ir al inicio</span>
            </a>

            @php
                $hiddenRoutes = ['addresses.form', 'post_carro', 'vista.pago'];
            @endphp

            @if (!in_array(Route::currentRouteName(), $hiddenRoutes))
                <button onclick="toggleCart()" class="btn-cart">
                    <i class="bi bi-cart3"></i> Carrito (<span id="cart-count">0</span>)
                </button>
            @endif
        </div>
    </nav>

    <div style="background-color: rgba(12, 12, 12, 0.616); width:20em" class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
        <div class="offcanvas-header" style="border-bottom:1px solid #be952c; display: flex; justify-content:space-between; align-items:center;">
            <a href="{{route('menu')}}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <h5 style=" color: #be952c; font-size: 20px; " class="offcanvas-title" id="offcanvasSidebarLabel">Categorias</h5>                
            </a>
            <a>
                <button style="background:transparent; border:transparent" type="button" class="text-reset" data-bs-dismiss="offcanvas" aria-label="Cerrar">
                    <i class="bi bi-x" style="font-size: 30px; color:#be952c"></i>
                </button>
            </a>                   
        </div>


        <div class="offcanvas-body p-0">
            <ul class="nav flex-column" style="width: 100%">
                <li>                    
                    <ul class="nav flex-column mb-auto">
                        @isset($categorias)
                        @foreach ($categorias as $categoria)
                            <li class="nav-item">
                                <a class="links nav-link" href="#Categoria_{{ $categoria->id }}">
                                    <svg class="bi pe-none" width="16" height="16"><use xlink:href="#icon-name"></use></svg>
                                    {{ $categoria->name }}
                                </a>
                            </li>
                        @endforeach
                        @endisset
                        <li class="nav-item">
                            <a class="links nav-link" href="/">
                                <svg class="bi pe-none" width="16" height="17"><use xlink:href="#icon-name"></use></svg>
                                Ir a inicio
                            </a>
                        </li>
                    </ul>
                    <hr>                   
                </li>
            </ul>
        </div>
    </div>
    <div>
        <main>
            @yield('content')
        </main>
    </div>
    
    

    <script>
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    function updateCartCount() {
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        document.getElementById('cart-count').textContent = totalItems;
        checkCartLimit();
    }

    function checkCartLimit() {
        const totalItemsInCart = cart.reduce((sum, item) => sum + item.quantity, 0);
        const addButtons = document.querySelectorAll('.btn-primary');

        addButtons.forEach(button => {
            button.disabled = totalItemsInCart >= 10;
        });
    }

    function addToCart(name, price, menuId) {
    const quantityInput = document.getElementById(`quantity${menuId}`);
    const quantity = parseInt(quantityInput.value);

    if (isNaN(price) || isNaN(quantity) || quantity <= 0) {
        alert('Cantidad no válida.');
        return;
    }

    const totalItemsInCart = cart.reduce((sum, item) => sum + item.quantity, 0);

    if (totalItemsInCart + quantity > 10) {
        alert('No puedes agregar más de 10 productos en total al carrito.');
        return;
    }

    const existingItem = cart.find(item => item.menuId === menuId);

    if (existingItem) {
        existingItem.quantity += quantity;
    } else {
        cart.push({ menuId, name, price: parseFloat(price), quantity });
    }

    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount(); 

    const currentModal = bootstrap.Modal.getInstance(document.getElementById(`modal${menuId}`));
    if (currentModal) {
        currentModal.hide();
    }

    const cartModalElement = document.getElementById('cartModal');
    if (cartModalElement) {
        const cartModal = new bootstrap.Modal(cartModalElement);
        toggleCart(); 
        cartModal.show();
    } else {
        console.error('El modal con ID "cartModal" no se encontró en el DOM.');
    }
}


    function toggleCart() {
        const cartItemsContainer = document.getElementById('cart-items');
        cartItemsContainer.innerHTML = ''; 
        let total = 0;

        if (cart.length === 0) {
            cartItemsContainer.innerHTML = '<p>No hay productos en el carrito.</p>';
        } else {
            cart.forEach((item, index) => {
                total += item.price * item.quantity;
                const itemRow = document.createElement('div');
                itemRow.classList.add('cart-item');
                itemRow.innerHTML = `
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <p>${item.name} - MX$${item.price.toFixed(2)} x ${item.quantity}</p>
                    </div>
                `;
                cartItemsContainer.appendChild(itemRow);
            });
            cartItemsContainer.innerHTML += `<h5 class="mt-3">Total: MX$${total.toFixed(2)}</h5>`;
        }

        const cartModalElement = document.getElementById('cartModal');
        if (cartModalElement) {
            const cartModal = new bootstrap.Modal(cartModalElement);
            cartModal.show();
        } else {
            console.error('El modal con ID "cartModal" no se encontró en el DOM.');
        }
    }

    function increaseQuantity(menuId, stock) {
        const quantityInput = document.getElementById(`quantity${menuId}`);
        const stockElement = document.getElementById(`stock${menuId}`);
        const buttonElement = document.querySelector(`button[onclick="increaseQuantity('${menuId}', '${stock}')"]`);
        let currentQuantity = parseInt(quantityInput.value);
        let currentStock = parseInt(stockElement.textContent);

        const totalItemsInCart = cart.reduce((sum, item) => sum + item.quantity, 0);
        const projectedTotal = totalItemsInCart + 1; 

        if (projectedTotal > 10) {
            alert('No puedes agregar más productos. Límite de 10 alcanzado.');
            buttonElement.disabled = true; 
            return;
        }

        if (currentQuantity < stock && currentStock > 0) {
            quantityInput.value = currentQuantity + 1;

            stockElement.textContent = currentStock - 1;

            if (projectedTotal === 10) {
                buttonElement.disabled = true;
            }
        } else {
            alert('No puedes agregar más del stock disponible.');
        }
    }

    function decreaseQuantity(menuId) {
        const quantityInput = document.getElementById(`quantity${menuId}`);
        const stockElement = document.getElementById(`stock${menuId}`);
        let currentQuantity = parseInt(quantityInput.value);
        let currentStock = parseInt(stockElement.textContent);

        if (currentQuantity > 1) {
            quantityInput.value = currentQuantity - 1;
            stockElement.textContent = currentStock + 1;

            const existingItem = cart.find(item => item.menuId === menuId);
            if (existingItem) {
                existingItem.quantity -= 1;

                if (existingItem.quantity <= 0) {
                    cart = cart.filter(item => item.menuId !== menuId);
                }
            }

            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
        }
    }

    function clearCart() {
    cart = [];
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();

    fetch('/cart/clear', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('El carrito ha sido vaciado.');
                toggleCart();
            } else {
                alert('Hubo un error al intentar vaciar el carrito.');
            }
        })
        .catch(error => {
            console.error('Error al vaciar el carrito:', error);
            alert('Ocurrió un problema al vaciar el carrito.');
        });
}


    document.addEventListener('hidden.bs.modal', function (event) {
        if (event.target.id === 'cartModal') {
            document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
            document.body.classList.remove('modal-open');
            document.body.style = '';
        }
    });

    document.getElementById('cartModal').addEventListener('hidden.bs.modal', function () {
        document.body.style = '';
        document.body.classList.remove('modal-open');
        document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
    });

    function confirmCart() {
        if (cart.length === 0) {
            alert('El carrito está vacío.');
            return;
        }

        const form = document.createElement('form');
        form.method = 'GET';
        form.action = '{{ route("addresses.form") }}';
        form.innerHTML = `
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="cart" value='${JSON.stringify(cart)}'>
        `;
        document.body.appendChild(form);
        form.submit();
    }

    document.addEventListener('DOMContentLoaded', function () {
        updateCartCount();
    });
</script>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @stack('scripts')
</body>
</html>
