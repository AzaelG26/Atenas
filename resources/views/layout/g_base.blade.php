
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
    //aqui se inicia el carrito con el localstorage, json
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    //con esto vamos actualizando la cantidad de productos en el carro
    function updateCartCount() {
        const totalItems = cart.length; // con esto hacemos que cada entrada sea individual
        document.getElementById('cart-count').textContent = totalItems;
    }

    // con esta funcion practicamente se agrega un elemento al fakin carrito
    function addToCart(name, price, menuId) {
    const quantityInput = document.getElementById(`quantity${menuId}`);
    const quantity = parseInt(quantityInput.value);

    if (isNaN(price) || isNaN(quantity) || quantity <= 0) {
        alert('Cantidad no válida.');
        return;
    }

    const existingItem = cart.find(item => item.menuId === menuId);

    if (existingItem) {
        existingItem.quantity += quantity; // Aumenta la cantidad si el producto ya existe
    } else {
        cart.push({ menuId, name, price: parseFloat(price), quantity });
    }

    localStorage.setItem('cart', JSON.stringify(cart));
    alert(`${quantity} ${name}(s) añadido(s) al carrito.`);
    updateCartCount();
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


    //con esto eliminamos un producto del carrito
    function removeFromCart(index) {
        cart.splice(index, 1);
        localStorage.setItem('cart', JSON.stringify(cart));
        toggleCart();
        updateCartCount();
    }

    //con las siguientes funciones, hacemos que se pueda incrementar o disminuir la cantidad de eelemntos que querramos llevar en el carrito
    function increaseQuantity(menuId, stock) {
        const quantityInput = document.getElementById(`quantity${menuId}`);
        const stockElement = document.getElementById(`stock${menuId}`);
        let currentQuantity = parseInt(quantityInput.value);
        let currentStock = parseInt(stockElement.textContent);

        if (currentQuantity < stock && currentStock > 0) {
            quantityInput.value = currentQuantity + 1;
            stockElement.textContent = currentStock - 1;
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
        }
    }

    function clearCart() {
        //con esto vaciamos el carro y actualizamos el localstorage
        cart = [];
        localStorage.setItem('cart', JSON.stringify(cart));

        //y con esto se va actualizando la vista y el contador muejejej
        toggleCart();
        updateCartCount();

        alert('El carrito ha sido vaciado.');
    }


    // con esto se limpia correctamente la vista cuando eliminamos elementos del carrito y se queda vacío
    //porque cuando se quedaba vacío y se cerraba el modal, era de que por ejemplo como si el modal siguiera abierto, entonces para esto es esta funcion
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

    //con esta funcion me aseguro que el carrito no este vacio, y cuando se quiera pasar a la vista de post_carro, le mande 
    //la noti diciendole que el carro esta vacio
    //aparte de que me aseguro de que el form se mande de forma segura
    function confirmCart() {
    if (cart.length === 0) {
        alert('El carrito está vacío.');
        return;
        }

        const form = document.createElement('form');
        form.method = 'GET'; // Cambiar el método a GET para redirigir correctamente
        form.action = '{{ route("addresses.form") }}';
        form.innerHTML = `
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="cart" value='${JSON.stringify(cart)}'>
        `;
        document.body.appendChild(form);
        form.submit();
    }




    //cuando carga la pagina, esto hace que se inicialice el contador para el carrito
    document.addEventListener('DOMContentLoaded', function () {
        updateCartCount();
    });
</script> 



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @stack('scripts')
</body>
</html>
