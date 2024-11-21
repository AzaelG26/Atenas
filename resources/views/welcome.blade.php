<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Inicio')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Para íconos de redes sociales --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
        
    <style>
         /* #loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #0C1011;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        /* Spinner del loader */
        .spinner-border {
            width: 3rem;
            height: 3rem;
            color: #ffc400;
        } */

        html {
            scroll-behavior: smooth;
        }

        #body {
            margin: 0;
            width: 100vw;
            background-color: #0C1011; /* Cambia a un color opaco para comprobar */
            overflow-x: auto;
            overflow-y: auto; /* Asegúrate de que el overflow-y esté en auto */

        }        
 
        .sticky-top{
            margin: 0;
        }
        
        .container-fluid{
            display: flex;
            justify-content: space-between;
            margin: 0;
            height: auto;
            width: 100%;
            background-color: rgba(12, 12, 12, 0.616)
        }
        
        .navbar-nav .nav-link {
            color: #be952c; 
            font-size: 17px; 
            transition: color 0.1s ease, box-shadow 0.1s ease, font-size 0.1s ease, background-color 0.1s ease;
            padding: 10px 15px; 
            position: relative; 
            font-family: "Karla", sans-serif;
            text-decoration: none; 
        }

        .navbar-nav .nav-link:hover {
            text-decoration: none;
            font-size: 18px;
            color: #8CD2F0; 
            background-color: transparent; 
        }

        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 3px;
            left: 0;
            bottom: 0;
            background-color: #ffc400;
            transition: width 0.4s ease;
        }

        .navbar-nav .nav-link:hover::after {
            width: 100%; 
        }

        .navbar-nav {
            display: flex;
            
            flex-direction: column;
            justify-content: flex-end;
            width: 90vw;
        } 
                
        .nav-link {
            color: #6c757d; 
            text-decoration: none;
        }

        .nav-link:hover {
            color: #8CD2F0; 
            text-decoration: underline; 
        }

        #icons{
            display: flex;
            width: 10em;
            justify-content: flex-end;
        }

        #container-conocenos-index{
            display: flex;
            justify-content: center;
            width: auto;
            height: 25em;
            margin-top: 200px;
        }

        #interno-conocenos-index{
            width: 90%;
            height: 100%;
        }

        #container-galeria-index{
            display: flex;
            justify-content: center;
            width: auto;
            height: auto;
            margin-top: 30em;
        }

        #interno-galeria-index{
            width: 90%;
            height: 100%;
        }

        #container-menu-index{
            display: flex;
            justify-content: center;
            width: auto;
            height: 25em;
            margin-top: 30em;

        }

        #interno-menu-index{
            width: 90%;
            height: 100%;
        }

        #container-resenias-index{
            display: flex;
            justify-content: center;
            width: auto;
            height: 25em;
            margin-top: 30em;

        }

        #interno-resenias-index{
            width: 90%;
            height: 100%;
        }

        #container-contacto-index{
            display: flex;
            justify-content: center;
            width: auto;
            height: 25em;
            margin-top: 30em;

        }

        #interno-contacto-index{
            width: 90%;
            height: 100%;
        }


        #navegation{
            display: flex;
            margin: 0;
            align-items: flex-start;
            background-attachment: fixed; 
            height: 200px;
            transition: top 0.5s ease; 
            position: sticky;
            top: 0;     
            z-index: 1000; 
        }
         
        #contenedor-navegador{
            display: flex;
            margin: 0;
            align-items: flex-start;
            flex-wrap: nowrap;
        }
        #logo-atenas:active{
            filter: drop-shadow(1px 1px 2px rgb(151, 124, 116));
        }

        .navbar {
            position: fixed;
            top: 0; 
            margin: 0; 
            padding: 0;
            width: 100%;
            transition: top 0.3s ease-in-out;
        }


        #img{
            height: 700px;
            background-image: url('flat-lay-burger-fries-plate-with-copyspace.jpg'); 
            background-size: cover;
            background-attachment: fixed;
            box-shadow: 0px 3px 10px rgba(39, 39, 39, 0.8);

        }
        .subtitulos{
            color: white;
        }
        .subtitulos:hover{
            color: #ffc400;
        }

        /* Animacion */

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInLeft {
            from { opacity: 0; transform: translateX(-50px); }
            to { opacity: 1; transform: translateX(0); }
        }

        
        .hero {
            padding: 100px 0;
            text-align: center;
            animation: fadeIn 1s;
            
        }

        .hero h1,h3 {            
            animation: fadeInUp 1.5s;
        } 
        .navbar-toggler{
            color:#8CD2F0;;
        }
    </style>
    <script nomodule src="https://cdn.jsdelivr.net/npm/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script type="module" src="https://cdn.jsdelivr.net/npm/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DynaPuff:wght@400..700&family=Monda:wght@400..700&display=swap" rel="stylesheet">

</head>
<body id="body">
     {{-- <!-- Loader -->
    <div id="loader">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Cargando...</span>
        </div>
    </div>
    
    <!-- Contenido de la página -->
    <div id="img">
        <div id="navegation" class="sticky-top">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <!-- Contenido del navbar -->
                </div>
            </nav>
        </div>
        <div class="hero">
            <h1>¡Prueba la Felicidad en Cada Mordida!</h1>
            <h3>Elige calidad, elige sabor, elige disfrutar</h3>
        </div>
    </div>
        <!-- JavaScript para ocultar el loader cuando la página haya cargado -->
    <script>
        window.addEventListener('load', function() {
            document.getElementById('loader').style.display = 'none';
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

     --}}
    <div id="img">
        {{-- <img src="LOGO_ATENAS.jpg" alt="sjjj"> --}}
        <div id="navegation" class="sticky-top">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#img">
                        <img id="logo-atenas" style="cursor:-webkit-grabbing;" width="120px" src="LOGO_ATENAS_high_quality_transparent.png" alt="logo_atenas">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="#img">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#container-conocenos-index">Conócenos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"href="#container-galeria-index">Galeria</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#container-menu-index">Menú</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#container-contacto-index">Contacto</a>
                            </li>
                            <li class="nav-item" style="display: flex; margin-right:50px">
                                <a class="nav-link" href="{{route('reseñas.index')}}">Reseñas</a>
                                
                            </li>
                            
                            <li class="nav-item" style="display: flex; margin-right:70px">
                                <a class="nav-link" href="{{route('carrito')}}">
                                    <ion-icon name="cart"></ion-icon>
                                </a>    
                                &nbsp;

                             @if (Route::has('login'))
                                <a class="nav-link"  href="{{route('login')}}">
                                    <ion-icon name="person-sharp"></ion-icon>
                                </a>                                                                  
                            </li>
                            @endif
                        </ul>
                    
                </div>
            </nav>
        </div>

        
        <div style="text-align:center;" class="hero">
            <h1 style="color: rgb(255, 255, 255); font-family: 'DynaPuff', system-ui; font-size:4em;">¡Prueba la Felicidad en Cada Mordida!</h1>
            <h3 style="color: rgb(255, 255, 255); font-family: 'DynaPuff', system-ui; font-size:2em;">Elige calidad, elige sabor, elige disfrutar</h3>
        </div>
    </div>

    
    

    
            {{-- src="img2.jpg"
        src="img3.jpg"  --}}


        <section id="container-conocenos-index">
            <div id="interno-conocenos-index">                
                <div class="card" style="height: 35em;background-color: #131718; box-shadow: 0px 1px 10px rgba(29, 29, 29, 0.911);">
                    <div class="card-header">
                        <div style="display:flex; justify-content:center; align-items:center;height:100px; font-family: 'Monda', sans-serif;"><h2 class="subtitulos" style="cursor:context-menu;">Conócenos</h2></div>                        
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="container-galeria-index">
            <div id="interno-galeria-index">                
                <div class="card" style="height: auto; background-color: #131718; box-shadow: 0px 1px 10px rgba(29, 29, 29, 0.911);">
                    <div class="card-header">
                        <div style="display:flex; justify-content:center; align-items:center; height:100px; font-family: 'Monda', sans-serif;">
                            <h2 class="subtitulos" style="cursor:context-menu;">Galeria</h2>
                        </div>                        
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        
                        <div class="row">
                            <!-- Carrusel 1 -->
                            <div class="col-md-4">
                                <div id="carouselExample1" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner" style="border-radius: 15px; overflow: hidden;">
                                        <div class="carousel-item active">
                                            <img src="img1.jpg" class="d-block w-100" alt="Imagen 1">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="img2.jpg" class="d-block w-100" alt="Imagen 2">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="img3.jpg" class="d-block w-100" alt="Imagen 3">
                                        </div>
                                    </div>
                                    {{-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample1" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample1" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    </button> --}}
                                </div>
                            </div>
                            
                            <!-- Carrusel 2 -->
                            <div class="col-md-4">
                                <div id="carouselExample2" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner" style="border-radius: 15px; overflow: hidden;">
                                        <div class="carousel-item active">
                                            <img src="img4.jpg" class="d-block w-100" alt="Imagen 4">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="img5.jpg" class="d-block w-100" alt="Imagen 5">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="img6.jpg" class="d-block w-100" alt="Imagen 6">
                                        </div>
                                    </div>
                                    {{-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample2" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample2" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    </button> --}}
                                </div>
                            </div>
                            
                            <!-- Carrusel 3 -->
                            <div class="col-md-4">
                                <div id="carouselExample3" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner" style="border-radius: 15px; overflow: hidden;">
                                        <div class="carousel-item active">
                                            <img src="img7.jpg" class="d-block w-100" alt="Imagen 7">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="img8.jpg" class="d-block w-100" alt="Imagen 8">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="img9.jpg" class="d-block w-100" alt="Imagen 9">
                                        </div>
                                    </div>
                                    {{-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample3" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample3" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    </button> --}}
                                </div>
                            </div>

                            <!-- Carrusel 2 -->
                            <div class="col-md-4">
                                <div id="carouselExample4" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner" style="border-radius: 15px; overflow: hidden;">
                                        <div class="carousel-item active">
                                            <img src="img1.jpg" class="d-block w-100" alt="Imagen 4">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="img5.jpg" class="d-block w-100" alt="Imagen 5">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="img6.jpg" class="d-block w-100" alt="Imagen 6">
                                        </div>
                                    </div>
                                    {{-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample2" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample2" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    </button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section id="container-menu-index">
            <div id="interno-menu-index">                
                <div class="card" style="height: 35em;background-color: #131718; box-shadow: 0px 1px 10px rgba(29, 29, 29, 0.911);">
                    <div class="card-header">
                        <div style="display:flex; justify-content:center; align-items:center;height:100px; font-family: 'Monda', sans-serif;"><h2 class="subtitulos" style="cursor:context-menu;">Ménu</h2></div>
                        
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    </div>
                </div>
            </div>
        </section>


        <section id="container-resenias-index">
            <div id="interno-resenias-index">                
                <div class="card" style="height: 35em;background-color: #131718; box-shadow: 0px 1px 10px rgba(29, 29, 29, 0.911);">
                    <div class="card-header">
                        <div style="display:flex; justify-content:center; align-items:center;height:100px; font-family: 'Monda', sans-serif;"><h2 class="subtitulos" style="cursor:context-menu;">Reseñas</h2></div>                        
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    </div>
                </div>
            </div>
        </section>


        <section id="container-contacto-index">
            <div id="interno-contacto-index">                
                <div class="card" style="height: 35em;background-color: #131718; box-shadow: 0px 1px 10px rgba(29, 29, 29, 0.911);">
                    <div class="card-header">
                        <div style="display:flex; justify-content:center; align-items:center;height:100px; font-family: 'Monda', sans-serif;"><h2 class="subtitulos" style="cursor:context-menu;">Contacto</h2></div>                        
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    </div>
                </div>
            </div>
        </section>
    
        <section style=" margin-top:300px; width:99%;">
            @include('layout.base')
        </section>

            
    <script>
        let lastScrollTop = 0;

        // Obtenemos el elemento de la barra de navegación
        const navbar = document.querySelector('.navbar');
        const container_fluid = document.querySelector('.container-fluid');
        // Manejador del evento de scroll
        window.addEventListener('scroll', function () {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            // Si se desliza hacia abajo, ocultar la barra de navegación
            if (scrollTop > lastScrollTop) {
                
                navbar.style.top = "-200px"; // Ajusta este valor si es necesario

            } else {
                // Si se desliza hacia arriba, mostrar la barra de navegación
                navbar.style.top = "0";

            }

            // Actualizamos la posición previa del scroll
            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // Evita números negativos
        });

        // Asegurar que la barra de navegación esté visible al refrescar la página
        window.addEventListener('load', function() {
            navbar.style.top = "0";
        });
    </script>
    @if (session('success'))
        <script>
            alert('{{session('success')}}')
        </script>        
    @endif

</body>
</html>