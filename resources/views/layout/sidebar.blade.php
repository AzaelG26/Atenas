<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'dashboard')</title>
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
        body {
            margin: 0;
            background-color:#0C1011;
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
            transition: all 0.2s ease;            
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
            color:#ce9d22;
            /* filter: drop-shadow(0px 0px 1px rgb(151, 124, 116)); */
            background-color: #2929294b;


        } 
        
        .links.active {        
            background-color: #2929294b;
        }
    </style>
        @stack('styles')
   
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="btn btn-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
                <i class="bi bi-list" style="font-size: 1.5rem;"></i>
            </button>            
        </div>
    </nav>
    {{--  --}}
    <div style="background-color: rgba(12, 12, 12, 0.616); width:20em" class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
        <div class="offcanvas-header" style="border-bottom:1px solid #be952c; display: flex; justify-content:space-between; align-items:center;">
            <a href="/" title="Toca para volver al inicio" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <h5 style=" color: #be952c; font-size: 20px; " class="offcanvas-title" id="offcanvasSidebarLabel">Menú</h5>                
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
                    <a class="links nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}" href="{{ route('profile.edit') }}" >
                        <ion-icon name="person-sharp"></ion-icon> Usuario 
                    </a>                    
                </li>
                <li>
                    <a class="links nav-link {{ request()->routeIs('showreseñas') ? 'active' : '' }}" href="{{ route('showreseñas') }}">
                        <i class="bi bi-ticket"></i> Ver Reseñas
                    </a>
                </li>
          
                <li>
                    <a class="links nav-link {{ request()->routeIs('tickets') ? 'active' : '' }}" href="{{ route('tickets') }}">
                        <i class="bi bi-ticket"></i> Ver Tickets
                    </a>
                </li>

                <li>
                    <a class="links nav-link {{ request()->routeIs('tickets.create') ? 'active' : '' }}" href="{{ route('tickets.create') }}">
                        <i class="bi bi-plus-circle"></i> Comunicate con el Administrador 
                    </a>
                </li>

                
                    <a class="links nav-link {{ request()->routeIs('personas.create') ? 'active' : '' }}" href="{{route('personas.create')}}">
                        <i class="bi bi-person-vcard"></i> Datos personales 
                    </a>
                </li>
                </li>
                <li>
                    <a class="links nav-link {{ request()->routeIs('auditoria') ? 'active' : '' }}" href="{{route('auditoria')}}">
                        <i class="bi bi-person-vcard"></i> Auditoria 
                    </a>
                </li>
                <li>
                <li>
                <a class="links nav-link {{ request()->routeIs('historial') ? 'active' : '' }}" href="{{route('historial')}}">
    <i class="bi bi-person-vcard"></i> Historial de Pedidos
    {{ request()->routeIs('historial') ? ' (active)' : '' }}
</a>

                    </a>
                    <a class="links nav-link" {{ request()->routeIs('orders') ? 'active' : '' }} href="{{route('orders')}}" >
                        <i>
                            <img width="15" height="15" src="https://img.icons8.com/ios/50/ce9d22/purchase-order.png" alt="purchase-order"/>
                        </i> ordenes 
                    </a>                                    
                </li>
                <li style="border-top:1px solid#be952c">                     
                    <div class="dropdown" data-bs-theme="dark">
                        <a>
                            
                        </a>
                        <button style="width:100%; border:none; color:#be952c" class="btn dropdown-toggle" type="button" id="dropdownMenuButtonDark" data-bs-toggle="dropdown" aria-expanded="false">
                            {{Auth::user()->name}} 
                        </button>
                        <ul style="width:100%;" class="dropdown-menu" aria-labelledby="dropdownMenuButtonDark">
                            <li><a class="dropdown-item" style="color:#be952c" href="/">Ir a inicio</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf                                                                                                                    
                                    <button type="submit" style="text-decoration: none; width:100% " class="btn btn-link p-0" onclick="event.preventDefault(); this.closest('form').submit();">
                                        <a style="color:#be952c" class="dropdown-item"> Log out</a>
                                    </button>                                                                            
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>    
        </div>
    </div>

    <div>
        <main>
            @yield('content')
        </main>
    </div>

    @stack('scripts') 

    

</body>
</html>