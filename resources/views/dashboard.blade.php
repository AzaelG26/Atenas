{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>                
            </div>
        </div>
    </div>
</x-app-layout> --}}

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
      <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
      <span class="fs-4">Menú</span>
    </a>
    <hr>

    <ul class="nav nav-pills flex-column mb-auto">
      <li class="#">
        <a href="#" class="nav-link link-body-emphasis" aria-current="page">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
          Datos de usuario
        </a>
      </li>
      <li>
        <a href="#" class="nav-link link-body-emphasis">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
          Dashboard
        </a>
      </li>
      <li>
        <a href="#" class="nav-link link-body-emphasis">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
          Orders
        </a>
      </li>
      <li>
        <a href="#" class="nav-link link-body-emphasis">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
          Products
        </a>
      </li>
      <li>
        <a href="#" class="nav-link link-body-emphasis">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
          Customers
        </a>
      </li>
    </ul>
    <hr>
    <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a  class="nav-link btn dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userMenu">
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">Perfil</a>
                    <form method="POST" action="{{ route('logout') }}" >
                        @csrf
                            <button type="submit" style="text-decoration: none; width:100%" class="btn btn-link p-0" onclick="event.preventDefault(); this.closest('form').submit();">
                            Cerrar sesión
                        </button>
                    </form>
                    @if(Auth::user()->rol !== 'customer')
                        <div>
                            @auth 
                                <a href="{{ route('register') }}" style="text-decoration: none; width:100%;" class="btn btn-link p-0">Register</a>
                            @endauth
                        </div>
                    @endif
                </div>
            </li>
        </ul>
        <hr>
    
    
  </div>
    
</body>
</html>  --}}
{{-- 
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

        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

    <style>
        body {
            margin: 0;
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
            color: rgb(134, 123, 56);
            text-decoration: none;
            
        }
        .nav-item .links {
            color: #be952c;                         
            font-size: 17px; 
            transition: color 0.1s ease, box-shadow 0.1s ease, font-size 0.1s ease, background-color 0.1s ease;
            padding: 10px 15px; 
            position: relative; 
            font-family: "Karla", sans-serif;
            text-decoration: none; 
        }

        .nav-item .links:hover {
            text-decoration: none;
            font-size: 19px;
            color: #8CD2F0; 
            
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
            transition: width 0.4s ease;
        }

        .nav-item .links:hover::after {
            width: 100%; 
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

    <div style="background-color: rgba(12, 12, 12, 0.616);" class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
        <div class="offcanvas-header">
            <a href="/" title="Toca para volver al inicio" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <h5 style="color: #be952c; font-size: 25px; " class="offcanvas-title" id="offcanvasSidebarLabel">Menú</h5>                
            </a>
            <button style="background:transparent; border:transparent" type="button" class="text-reset" data-bs-dismiss="offcanvas" aria-label="Cerrar">
                <i class="bi bi-x" style="font-size: 40px"></i>
            </button>
        </div>
        <hr>

        <div class="offcanvas-body p-0">
            <ul class="nav flex-column" style="width: 100%">
                

                <li class="nav-item" style="height: 50px;">
                    <a href="{{route('profile.edit')}}" class="links" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="personasSubmenu">
                        <i class="bi bi-people"></i> Datos personales 
                    </a>                    
                </li>

                <li class="nav-item" style="height: 50px">
                    <a class="links" data-bs-toggle="collapse" href="#direccionesSubmenu" role="button" aria-expanded="false" aria-controls="direccionesSubmenu">
                        <i class="bi bi-map"></i> Direcciones 
                    </a>
                </li>
                <li class="nav-item" style="height: 50px">
                    <a  class="links {{ request()->routeIs('link_persona_direccion') ? 'active' : '' }}">
                        <i class="bi bi-link"></i> Vincular Persona a Dirección
                    </a>
                </li>
                <li class="nav-item" style="height: 50px">
                    <a class="links" data-bs-toggle="collapse" href="#usuariosSubmenu" role="button" aria-expanded="false" aria-controls="usuariosSubmenu">
                        <i class="bi bi-people"></i> Usuarios 
                    </a>                                    
                </li>
                <li>     
                
                <hr>
                <li >
                    <ul style="list-style-type: none;">
                        <li class="dropdown">
                            
                            <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none " data-bs-toggle="dropdown" aria-expanded="false">
                                <ion-icon name="person-sharp"></ion-icon>
                                &nbsp;
                                <strong style="color: #be952c;">{{ Auth::user()->name }} <span style="color: #be952c"> &#9660;</span> </strong>
                                &nbsp;
                        
                            </a>
                            <ul class="dropdown-menu text-small shadow">
                                <li><a class="dropdown-item" href="#">New project...</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">
                                    <form method="POST" action="{{ route('logout') }}" >
                                        @csrf
                                        <button type="submit" style="text-decoration: none; width:100%" class="btn btn-link p-0" onclick="event.preventDefault(); this.closest('form').submit();">
                                            Cerrar sesión
                                        </button>
                                    </form>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                

            
        </div>
    </div>

    <div class="container mt-8">
        <main >
            @yield('content')
        </main>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @stack('scripts')
</body>
</html> --}}

@extends('layout.sidebar')    
@section('title', 'Datos de usuario')
    
@section('content')
    <h1>Hola</h1>
@endsection
