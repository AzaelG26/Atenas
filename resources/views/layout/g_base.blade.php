
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Menú')</title>
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
            <button class="btn btn-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
                <i class="bi bi-list" style="font-size: 1.5rem;"></i>
            </button>        
            <!-- Botón para abrir el modal del carrito -->
            <button onclick="toggleCart()" class="btn-cart">
                <i class="bi bi-cart3"></i> Carrito (<span id="cart-count">0</span>)
            </button>    
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
    // Aquí se inicializa el carrito con el localStorage en formato JSON
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Función para actualizar la cantidad de productos en el carrito
    // Función para actualizar la cantidad de productos en el carrito
    function updateCartCount() {
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        document.getElementById('cart-count').textContent = totalItems;
    }

    // Función para verificar si el límite global de productos ha sido alcanzado
    function checkCartLimit() {
        const totalItemsInCart = cart.reduce((sum, item) => sum + item.quantity, 0);
        const addButtons = document.querySelectorAll('.btn-primary');
        
        // Deshabilitar todos los botones de incremento si el total de productos es 10 o más
        if (totalItemsInCart >= 10) {
            addButtons.forEach(button => button.disabled = true); // Deshabilitar todos los botones de incremento
        } else {
            addButtons.forEach(button => button.disabled = false); // Habilitar los botones si el límite no se alcanza
        }
    }

    // Función para agregar un producto al carrito
    function addToCart(name, price, menuId) {
        const quantityInput = document.getElementById(`quantity${menuId}`);
        const quantity = parseInt(quantityInput.value);

        if (isNaN(price) || isNaN(quantity) || quantity <= 0) {
            alert('Cantidad no válida.');
            return;
        }

        // Calcular el total de productos en el carrito
        const totalItemsInCart = cart.reduce((sum, item) => sum + item.quantity, 0);

        // Validar si se supera el límite de 10 productos
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
        alert(`${quantity} ${name}(s) añadido(s) al carrito.`);
        updateCartCount();
        checkCartLimit();  // Recheck the cart limit
    }

    // Función para mostrar el carrito dentro del modal
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
                        <button onclick="removeFromCart(${index})" class="btn btn-sm btn-outline-danger">Eliminar</button>
                    </div>
                `;
                cartItemsContainer.appendChild(itemRow);
            });
            cartItemsContainer.innerHTML += `<h5 class="mt-3">Total: MX$${total.toFixed(2)}</h5>`;
        }

        const cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
        cartModal.show();
    }

    // Función para eliminar un producto del carrito
    function removeFromCart(index) {
        cart.splice(index, 1);
        localStorage.setItem('cart', JSON.stringify(cart));
        toggleCart();
        updateCartCount();
        checkCartLimit(); // Recheck the cart limit after removal
    }

    // Función para incrementar la cantidad de un producto
    function increaseQuantity(menuId, stock) {
        const quantityInput = document.getElementById(`quantity${menuId}`);
        const stockElement = document.getElementById(`stock${menuId}`);
        let currentQuantity = parseInt(quantityInput.value);
        let currentStock = parseInt(stockElement.textContent);

        const totalItemsInCart = cart.reduce((sum, item) => sum + item.quantity, 0);

        // Verificar si el carrito ya tiene 10 o más productos
        if (totalItemsInCart >= 10) {
            alert('No puedes agregar más productos, el límite de 10 productos ha sido alcanzado.');
            return;
        }

        if (currentQuantity < stock && currentStock > 0) {
            quantityInput.value = currentQuantity + 1;
            stockElement.textContent = currentStock - 1;
        } else {
            alert('No puedes agregar más del stock disponible.');
        }

        checkCartLimit();  // Recheck the cart limit when increasing quantity
    }

    // Función para disminuir la cantidad de un producto
    function decreaseQuantity(menuId) {
        const quantityInput = document.getElementById(`quantity${menuId}`);
        const stockElement = document.getElementById(`stock${menuId}`);
        let currentQuantity = parseInt(quantityInput.value);
        let currentStock = parseInt(stockElement.textContent);

        if (currentQuantity > 1) {
            quantityInput.value = currentQuantity - 1;
            stockElement.textContent = currentStock + 1;
        }

        checkCartLimit();  // Recheck the cart limit after decreasing quantity
    }

    // Función para vaciar el carrito
    function clearCart() {
    // Vaciar el carrito en el navegador
    cart = [];
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();

    // Realizar una solicitud AJAX al servidor para vaciar el carrito en la sesión
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


    // Limpia la vista correctamente al cerrar el modal
    document.addEventListener('hidden.bs.modal', function (event) {
        if (event.target.id === 'cartModal') {
            document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
            document.body.classList.remove('modal-open');
            document.body.style = '';
        }
    });

    // Limpieza adicional para asegurarse de que el modal funcione correctamente
    document.getElementById('cartModal').addEventListener('hidden.bs.modal', function () {
        document.body.style = '';
        document.body.classList.remove('modal-open');
        document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
    });

    // Validar carrito antes de enviar el formulario
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

    // Inicializar contador del carrito al cargar la página
    document.addEventListener('DOMContentLoaded', function () {
        updateCartCount();
    });
</script>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @stack('scripts')
</body>
</html>
