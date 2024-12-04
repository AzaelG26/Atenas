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
    <link rel="icon" href="LOGO_ATENAS_high_quality_transparent.png">



<style>
        html {
            scroll-behavior: smooth;
        }

        #body {
            margin: 0;
            width: 100%;
            background-color: #0C1011; 
            overflow-x: auto;
            overflow-y: auto; 

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
            width: 100%;
            height: auto;
            margin-top: 200px;
        }

        #interno-conocenos-index{
            width: 94%;
            height: auto;
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
            height: auto;
        } 

        #container-menu-index{
            display: flex;
            justify-content: center;
            width: 100vw;
            height: auto;
            margin-top: 30em;

        }

        #interno-menu-index{
            width: 90%;
            height: auto;
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
            width:100vw;;
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
            height: auto;
            width: auto;
            background-image: url('top-view-burger-fries-with-sauces-copy-space.jpg'); 
            /* filter: blur(5px); */
            background-size: cover;            
            background-attachment: fixed;
            box-shadow: 0px 3px 10px rgba(39, 39, 39, 0.8);
        }
        #img-menu{
            height: auto;
            width: auto;
            background-image: url('person-serving-food-restaurant.jpg'); 
            /* filter: blur(5px); */
            background-size: cover;            
            background-attachment: fixed;
            opacity: 0.5;
        }
        .subtitulos, .text-muted{
            font-family: "Lato", sans-serif;
            font-weight: 400;
            font-style: normal;
            color: rgb(255, 255, 255);
        }
        .text-muted{
            text-align: center;
            padding-top: 10%;
            color: rgb(255, 0, 0) !important;            
        }
        .subtitulos:hover{
            color: #e0a91e;
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
            font-size: 3em;
        } 
        .navbar-toggler{
            color:#8CD2F0;;
        }
        
        .contenedor-about .card-body, .card-galery{
            transition: all 0.4s ease;
        }
        .contenedor-about .card-body:hover{
            transform: scale(1.02);
        }
        .contenedor-about .card-galery:hover{
            transform: scale(1.09);
        }

        .contenido-menu{
            width:100%;
            height: auto;
            display: flex;
            flex-direction:column;
            align-items:center; 
        }

        .contenedor-platillos{
            width: 33%;
            padding-left: 10%
        }
        .platillos{
            font-size: 17px; 
            color:white; 
            width:100%; 
        }
        .mapa{
            width: 100%;
        }
        /* Media query para pantallas pequeñas */
        @media (max-width: 1030px) {
            #picture-menu{
                display: none;
            }
            .contenedor-platillos{
                width: 50%;
                padding-left: 5%
            }
            
            .contenedor-about{
                width: 95vw;
            }
            .mapa{
                width: 100%;
            }
            .content-about {
                width: 90%; /* Ajusta el ancho al contenedor */
                height: 80vh; /* Permite que la altura se ajuste dinámicamente */
            }

            #interno-conocenos-index .card .card-body:not(.content-about) {
                display: none;
            }

            .hero h1, .hero h3 {
                font-size: 1.5em; /* Ajusta el tamaño del texto */
                margin-bottom: 10px;
            }

            #container-conocenos-index {
                margin-top: 50px; /* Reduce el margen para pantallas pequeñas */
            }
        }


        #loader {
        display: flex;
          --ANIMATION-DELAY-MULTIPLIER: 70ms;

            justify-content: center;
            align-items: center;
            width: 100vw;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #223033;
            z-index: 9999;
            --color: hsl(0, 0%, 87%);
            --animation: 2s ease-in-out infinite;
            animation: colorChange 4s infinite alternate; /* Duración y repetición de la animación */      
        }

        /* Animación de cambio de color */
        @keyframes colorChange {
            0% {
            background-color: #fffeb4; /* Negro */
            }
            25% {
            background-color: #b0d2e2; /* Azul claro */
            }
            50% {
            background-color: #acf3e3; /* Morado */
            }
            75% {
            background-color: #fffeb4; /* Rojo */
            }
            100% {
            background-color: #ffe7cd; /* Naranja */
            }
        }

        #loader span {
            padding: 0;
            margin: 0;
            letter-spacing: -5rem;
            animation-delay: 0s;
            transform: translateY(4rem);
            animation: hideAndSeek 1s alternate infinite cubic-bezier(0.86, 0, 0.07, 1);
        }
        #loader .l {
            animation-delay: calc(var(--ANIMATION-DELAY-MULTIPLIER) * 0);
        }
        #loader .o {
            animation-delay: calc(var(--ANIMATION-DELAY-MULTIPLIER) * 1);
        }
        #loader .a {
            animation-delay: calc(var(--ANIMATION-DELAY-MULTIPLIER) * 2);
        }
        #loader .d {
            animation-delay: calc(var(--ANIMATION-DELAY-MULTIPLIER) * 3);
        }
        #loader .ispan {
            animation-delay: calc(var(--ANIMATION-DELAY-MULTIPLIER) * 4);
        }
        #loader .n {
            animation-delay: calc(var(--ANIMATION-DELAY-MULTIPLIER) * 5);
        }
        #loader .g {
            animation-delay: calc(var(--ANIMATION-DELAY-MULTIPLIER) * 6);
        }
        .letter {
            width: fit-content;
            height: 3rem;
        }
        .i {
            margin-inline: 5px;
        }
        @keyframes hideAndSeek {
            0% {
            transform: translateY(4rem);
            }
            100% {
            transform: translateY(0rem);
            }
        }
        .btn-ordenar-menu{
            padding: 10px;
            color: white;
            background-color: #e0a91e;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
            transition: all 0.2s ease;
        }
        .btn-ordenar-menu:hover{
            transform: translateY(2px);
        }


        /*  ESTRELLAS */
        .star-rating {
            direction: rtl; /* Para invertir el orden de las estrellas */
            display: inline-block;
            font-size: 30px;
            position: relative;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            color: gray;
            cursor: pointer;
        }

        .star-rating input:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: gold;
        }

        .star-rating label:active {
            transform: scale(0.9);
        }

        /* Para ocultar el select original */
        select {
            display: none;
        }

        .star-rating {
            color: gold; /* Cambia el color a dorado para las estrellas llenas */
            font-size: 1.5em; /* Tamaño de las estrellas */
        }

        .star-rating i {
            margin-right: 3px; /* Espaciado entre las estrellas */
        }
    </style>
    <script nomodule src="https://cdn.jsdelivr.net/npm/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script type="module" src="https://cdn.jsdelivr.net/npm/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arimo:ital,wght@0,400..700;1,400..700&family=Courgette&family=DynaPuff:wght@400..700&family=Karla:ital,wght@0,200..800;1,200..800&family=Monda:wght@400..700&family=Oleo+Script:wght@400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">

    
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>


<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body id="body">
    <div id="loader">
        <span class="l">
            <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 11 18"
            height="18"
            width="11"
            class="letter"
            >
            <path
                fill="black"
                d="M0.28 16.14V0.94L3.7 0.64L5.7 1.64V12.3L8.5 12.06L10.5 13.06V16.44L2.28 17.14L0.28 16.14ZM3.5 12.7V0.859999L0.48 1.12V15.94L8.3 15.26V12.28L3.5 12.7Z"
            ></path>
            </svg>
        </span>
        <span class="o">
            <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 16 18"
            height="18"
            width="16"
            class="letter"
            >
            <path
                fill="black"
                d="M8.94 17.24C8.84667 17.2533 8.74667 17.26 8.64 17.26C8.54667 17.26 8.45333 17.26 8.36 17.26C7.66667 17.26 7.02667 17.16 6.44 16.96C5.86667 16.7733 5.30667 16.5533 4.76 16.3C3.33333 15.5933 2.28667 14.6 1.62 13.32C0.966667 12.0267 0.64 10.4933 0.64 8.72C0.64 7.68 0.766667 6.67333 1.02 5.7C1.28667 4.71333 1.68 3.82667 2.2 3.04C2.72 2.24 3.36667 1.58667 4.14 1.08C4.92667 0.573332 5.84667 0.273333 6.9 0.18C7.00667 0.166666 7.10667 0.159999 7.2 0.159999C7.29333 0.159999 7.38667 0.159999 7.48 0.159999C8.14667 0.159999 8.74 0.246666 9.26 0.419999C9.78 0.579999 10.3067 0.766666 10.84 0.979999C11.8 1.36667 12.6 1.94 13.24 2.7C13.88 3.46 14.36 4.35333 14.68 5.38C15 6.39333 15.16 7.48 15.16 8.64C15.16 9.72 15.0333 10.7533 14.78 11.74C14.5267 12.7267 14.14 13.62 13.62 14.42C13.1133 15.2067 12.4667 15.8467 11.68 16.34C10.9067 16.8467 9.99333 17.1467 8.94 17.24ZM6.92 16.04C7.94667 15.96 8.84 15.68 9.6 15.2C10.36 14.7067 10.9867 14.0733 11.48 13.3C11.9733 12.5133 12.34 11.64 12.58 10.68C12.8333 9.70667 12.96 8.69333 12.96 7.64C12.96 6.68 12.8467 5.76667 12.62 4.9C12.4067 4.02 12.0733 3.24 11.62 2.56C11.1667 1.88 10.5933 1.34667 9.9 0.959999C9.22 0.559999 8.41333 0.359999 7.48 0.359999C7.38667 0.359999 7.29333 0.359999 7.2 0.359999C7.12 0.359999 7.02667 0.366666 6.92 0.38C5.89333 0.473333 5 0.766666 4.24 1.26C3.48 1.74 2.84667 2.37333 2.34 3.16C1.83333 3.93333 1.45333 4.8 1.2 5.76C0.96 6.70667 0.84 7.69333 0.84 8.72C0.84 9.72 0.953333 10.6667 1.18 11.56C1.40667 12.44 1.74667 13.22 2.2 13.9C2.65333 14.5667 3.22667 15.0933 3.92 15.48C4.61333 15.8667 5.42 16.06 6.34 16.06C6.44667 16.06 6.54667 16.06 6.64 16.06C6.73333 16.06 6.82667 16.0533 6.92 16.04ZM6.92 12.94C6.86667 12.94 6.81333 12.9467 6.76 12.96C6.72 12.96 6.67333 12.96 6.62 12.96C5.82 12.96 5.18667 12.6133 4.72 11.92C4.26667 11.2267 4.04 10.0667 4.04 8.44C4.04 7.28 4.16667 6.34667 4.42 5.64C4.67333 4.93333 5.02 4.41333 5.46 4.08C5.9 3.73333 6.38667 3.54 6.92 3.5C6.97333 3.5 7.02667 3.5 7.08 3.5C7.13333 3.48667 7.18667 3.48 7.24 3.48C8.02667 3.48 8.64 3.82 9.08 4.5C9.52 5.16667 9.74 6.31333 9.74 7.94C9.74 9.67333 9.47333 10.9267 8.94 11.7C8.42 12.46 7.74667 12.8733 6.92 12.94ZM6.86 12.74C7.64667 12.6733 8.28667 12.2733 8.78 11.54C9.28667 10.8067 9.54 9.60667 9.54 7.94C9.54 7.18 9.49333 6.53333 9.4 6C9.30667 5.46667 9.16667 5.03333 8.98 4.7C8.91333 4.68667 8.84667 4.68 8.78 4.68C8.71333 4.66667 8.64667 4.66 8.58 4.66C7.79333 4.66 7.20667 5.07333 6.82 5.9C6.43333 6.71333 6.24 7.89333 6.24 9.44C6.24 10.2133 6.29333 10.8733 6.4 11.42C6.50667 11.9533 6.66 12.3933 6.86 12.74Z"
            ></path>
            </svg>
        </span>
        <span class="a">
            <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 15 18"
            height="18"
            width="15"
            class="letter"
            >
            <path
                fill="black"
                d="M9.28 15.76L8.54 13.38L6.96 13.52L5.98 17.02L2.58 17.32L0.58 16.32L4.96 0.699999L8.26 0.419999L10.26 1.42L14.72 16.48L11.28 16.76L9.28 15.76ZM5.12 0.899999L0.88 16.08L3.8 15.84L4.8 12.34L8.36 12.02L9.42 15.56L12.44 15.3L8.1 0.64L5.12 0.899999ZM5.5 9.42C5.75333 8.59333 5.96 7.80667 6.12 7.06C6.29333 6.31333 6.44 5.56667 6.56 4.82H6.64C6.74667 5.55333 6.88 6.27333 7.04 6.98C7.21333 7.67333 7.42 8.42 7.66 9.22L5.5 9.42Z"
            ></path>
            </svg>
        </span>
        <span class="d">
            <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 14 18"
            height="18"
            width="14"
            class="letter"
            >
            <path
                fill="black"
                d="M0.28 16.24V1.04L4.44 0.679999C4.61333 0.666666 4.78 0.66 4.94 0.66C5.1 0.646666 5.24667 0.64 5.38 0.64C6.11333 0.64 6.76667 0.726666 7.34 0.899999C7.92667 1.07333 8.56667 1.32667 9.26 1.66C10.1933 2.08667 10.9533 2.61333 11.54 3.24C12.1267 3.85333 12.56 4.61333 12.84 5.52C13.12 6.41333 13.26 7.50667 13.26 8.8C13.26 10.4933 12.9733 11.92 12.4 13.08C11.84 14.24 11.0667 15.1333 10.08 15.76C9.09333 16.3733 7.95333 16.74 6.66 16.86L2.28 17.24L0.28 16.24ZM4.64 15.68C5.89333 15.5733 7 15.2133 7.96 14.6C8.93333 13.9867 9.69333 13.1133 10.24 11.98C10.7867 10.8467 11.06 9.45333 11.06 7.8C11.06 5.53333 10.5733 3.80667 9.6 2.62C8.64 1.43333 7.21333 0.84 5.32 0.84C5.18667 0.84 5.04667 0.846666 4.9 0.859999C4.75333 0.859999 4.60667 0.866666 4.46 0.879999L0.48 1.22V16.02L4.64 15.68ZM3.5 3.9L4.08 3.86C4.22667 3.84667 4.36 3.84 4.48 3.84C4.61333 3.82667 4.74667 3.82 4.88 3.82C5.57333 3.82 6.14 3.94667 6.58 4.2C7.03333 4.45333 7.36667 4.88667 7.58 5.5C7.80667 6.11333 7.92 6.97333 7.92 8.08C7.92 9.65333 7.59333 10.8067 6.94 11.54C6.28667 12.26 5.4 12.6667 4.28 12.76L3.5 12.82V3.9ZM5.7 12.2C6.38 11.9067 6.88667 11.4333 7.22 10.78C7.55333 10.1133 7.72 9.21333 7.72 8.08C7.72 6.66667 7.52 5.65333 7.12 5.04C7.06667 5.02667 7.01333 5.02 6.96 5.02C6.90667 5.02 6.85333 5.02 6.8 5.02C6.68 5.02 6.56 5.02667 6.44 5.04C6.33333 5.04 6.22 5.04667 6.1 5.06L5.7 5.08V12.2Z"
            ></path>
            </svg>
        </span>
        <span class="ispan">
            <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 6 17"
            height="18"
            width="6"
            class="letter i"
            >
            <path
                fill="black"
                d="M0.38 15.96V0.76L3.86 0.439999L5.86 1.44V16.64L2.38 16.94L0.38 15.96ZM0.58 0.94V15.74L3.66 15.46V0.66L0.58 0.94Z"
            ></path>
            </svg>
        </span>
        <span class="n">
            <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 13 18"
            height="18"
            width="13"
            class="letter"
            >
            <path
                fill="black"
                d="M7.22 15.82L5.72 12.44V16.92L2.28 17.22L0.28 16.22V1.02L3.52 0.74L5.52 1.74L7 4.94V0.64L10.48 0.319999L12.48 1.32V16.54L9.22 16.82L7.22 15.82ZM7.2 0.819999V6.42C7.2 6.56667 7.20667 6.80667 7.22 7.14C7.23333 7.46 7.24667 7.8 7.26 8.16C7.28667 8.50667 7.30667 8.80667 7.32 9.06C7.33333 9.3 7.34 9.42 7.34 9.42L7.28 9.46C7.28 9.46 7.26 9.38667 7.22 9.24C7.19333 9.09333 7.14667 8.92 7.08 8.72C7.01333 8.50667 6.94 8.31333 6.86 8.14L3.4 0.959999L0.48 1.2V16L3.52 15.76V10.52C3.52 10.36 3.51333 10.0867 3.5 9.7C3.48667 9.31333 3.47333 8.90667 3.46 8.48C3.46 8.05333 3.45333 7.69333 3.44 7.4C3.42667 7.09333 3.42 6.94 3.42 6.94L3.48 6.92C3.48 6.92 3.51333 7.05333 3.58 7.32C3.66 7.57333 3.76667 7.84 3.9 8.12L7.4 15.62L10.28 15.36V0.539999L7.2 0.819999Z"
            ></path>
            </svg>
        </span>
        <span class="g">
            <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 15 18"
            height="18"
            width="15"
            class="letter"
            >
            <path
                fill="black"
                d="M14.04 13.72C13.64 14.6533 12.9933 15.44 12.1 16.08C11.22 16.72 10.1333 17.0933 8.84 17.2C8.72 17.2133 8.6 17.22 8.48 17.22C8.36 17.22 8.24 17.22 8.12 17.22C7.12 17.22 6.16667 17.0467 5.26 16.7C4.36667 16.3533 3.57333 15.8333 2.88 15.14C2.18667 14.4333 1.64 13.54 1.24 12.46C0.84 11.38 0.64 10.1 0.64 8.62C0.64 7.48667 0.78 6.42667 1.06 5.44C1.34 4.44 1.74667 3.55333 2.28 2.78C2.82667 2.00667 3.48667 1.38667 4.26 0.92C5.03333 0.453333 5.90667 0.179999 6.88 0.0999997C6.96 0.0866657 7.04 0.0799987 7.12 0.0799987C7.2 0.0799987 7.28 0.0799987 7.36 0.0799987C8.33333 0.0799987 9.28 0.299999 10.2 0.74C11.1333 1.18 11.9467 1.78 12.64 2.54C13.3467 3.3 13.8467 4.16 14.14 5.12L11.76 6.46L12.04 6.44L14.04 7.44V13.72ZM5.9 7.16V10L8.98 9.74V11.46C8.80667 11.8067 8.52667 12.1067 8.14 12.36C7.76667 12.6 7.37333 12.7333 6.96 12.76C6.90667 12.7733 6.84667 12.78 6.78 12.78C6.72667 12.78 6.66667 12.78 6.6 12.78C5.73333 12.78 5.08 12.4333 4.64 11.74C4.2 11.0467 3.98 9.92 3.98 8.36C3.98 6.94667 4.20667 5.82 4.66 4.98C5.11333 4.14 5.84 3.68 6.84 3.6H7.06C7.60667 3.6 8.07333 3.76 8.46 4.08C8.86 4.4 9.14667 4.86667 9.32 5.48L11.9 4.02C11.6733 3.38 11.36 2.78 10.96 2.22C10.5733 1.64667 10.0867 1.18 9.5 0.819999C8.91333 0.459999 8.2 0.28 7.36 0.28C7.29333 0.28 7.22 0.28 7.14 0.28C7.06 0.28 6.98 0.286666 6.9 0.299999C5.63333 0.406666 4.54667 0.846666 3.64 1.62C2.73333 2.38 2.04 3.37333 1.56 4.6C1.08 5.81333 0.84 7.15333 0.84 8.62C0.84 10.14 1.06 11.4533 1.5 12.56C1.94 13.6667 2.56667 14.52 3.38 15.12C4.19333 15.72 5.16 16.02 6.28 16.02C6.37333 16.02 6.46 16.02 6.54 16.02C6.63333 16.02 6.72667 16.0133 6.82 16C8.07333 15.8933 9.12667 15.54 9.98 14.94C10.8467 14.3267 11.4733 13.5733 11.86 12.68V6.66L5.9 7.16ZM9.2 5.78C9.14667 5.59333 9.08667 5.42 9.02 5.26C8.95333 5.08667 8.88 4.93333 8.8 4.8C8.2 4.85333 7.70667 5.06667 7.32 5.44C6.94667 5.8 6.66667 6.29333 6.48 6.92L10.8 6.56L9.2 5.78ZM7.8 11.26L6.24 10.46C6.26667 10.9933 6.32 11.4133 6.4 11.72C6.49333 12.0133 6.62667 12.3 6.8 12.58C6.84 12.5667 6.88667 12.56 6.94 12.56C7.28667 12.5333 7.63333 12.4267 7.98 12.24C8.32667 12.04 8.59333 11.8067 8.78 11.54V11.14L7.8 11.26Z"
            ></path>
            </svg>
        </span>
    </div>


    
    <div id="img">
        {{-- <img src="LOGO_ATENAS.jpg" alt="sjjj"> --}}
        <div id="navegation" class="sticky-top">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#img">
                        <img id="logo-atenas" style="cursor:-webkit-grabbing;"  width="120px" src="LOGO_ATENAS_high_quality_transparent.png" alt="logo_atenas">
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
                                <a class="nav-link" href="#container-resenias-index">Reseñas</a>
                            </li>

                                
                            </li>
                            
                            <li class="nav-item" style="display: flex; margin-right:70px">
                                <a class="nav-link" href="{{route('menu')}}">
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
                </div>
            </nav>
        </div>
        
        <div style="text-align:center;" class="hero">
            <h1 style="color: rgb(255, 255, 255); font-family: Oleo Script, system-ui; font-size:4em; font-weight: 700; font-size:4.5em;">¡Prueba la Felicidad en Cada Mordida!</h1>
            <h3 style="color: rgb(255, 255, 255); font-family: Oleo Script, system-ui; font-size:2em; font-weight: 700; font-size:2em;">Elige calidad, elige sabor, elige disfrutar</h3>
        </div>
    </div>
            

    <section id="container-conocenos-index">
        <div id="interno-conocenos-index">                
            <div class="card" style="height: 40em; background-color: transparent; border:none;">
                <div class="card-header" style="background: transparent; border:none;">
                    <div style="display:flex; justify-content:center; align-items:center;height:100px; font-family: 'Monda', sans-serif;"><h2 class="subtitulos acerca-de-nosotros" style="cursor:context-menu;">Acerca de nosotros</h2></div>                        
                </div>
                <div class="card-body contenedor-about" style="display:flex;flex-wrap:nowrap;">

                    <div class="card-body" style="width:20%; background-image:url('series-images-from-series-images-from-series.jpg'); box-shadow: 0px 2px 15px rgb(0, 0, 0); width:50em; background-size: cover; margin:10px;"></div>

                    <div>
                        <h2 style="color: #fff;  ">Atenas Food</h2>
                        <p style="color: #ccc; line-height: 1.6; font-size: 1.1em;">
                            En Atenas Food, nos especializamos en ofrecer comida rápida de alta calidad, con una experiencia que combina sabor, frescura y un servicio excepcional. Ubicados estratégicamente en Matamoros, Coahuila, somos el lugar ideal para disfrutar de una deliciosa comida en un ambiente acogedor y moderno.
                        </p>
                        <p style="color: #ccc; line-height: 1.6; font-size: 1.1em; margin-top: 1em;">
                            Además de la comida, nos enorgullece brindar un servicio que te hará sentir como en casa. Nuestro equipo está dedicado a superar tus expectativas, asegurándose de que cada visita sea una experiencia memorable.
                        </p>

                    </div>


                    <div class="card-body" style="background-image:url('front-view-man-putting-hand-burger.jpg'); box-shadow: 0px 2px 15px rgb(0, 0, 0); width:50em; background-size: cover; margin:10px;"></div>

                </div>
            </div>
        </div>
    </section>
    
    <section id="container-galeria-index">
        <div id="interno-galeria-index">                
            <div class="card" style="height: auto; background-color: transparent; border:none;">
                <div class="card-header">
                    <div style="display:flex; justify-content:center; align-items:center; height:100px; font-family: 'Monda', sans-serif;">
                        <h2 class="subtitulos" style="cursor:context-menu;">Galeria</h2>
                    </div>                        
                </div>
                <div class="card-body contenedor-about" style="display:flex;width:100%; flex-wrap:wrap; justify-content:space-around; background-color: #131718; box-shadow: 0px 2px 15px rgb(0, 0, 0); margin:10px; width:100%;">
                    
                    <img class="card-galery" src="atenas_hotdog.png" alt="hot dog" style="height:160px; box-shadow: 0px 2px 15px rgb(0, 0, 0); width:240px; background-size: cover; margin:10px;">
                    <img class="card-galery" src="boneless_with_potatoes.png" alt="boneless with potatoes" style="height:160px; box-shadow: 0px 2px 15px rgb(0, 0, 0); width:240px; background-size: cover; margin:10px;">
                    <img class="card-galery" src="atenas_gringas.png" alt="gringas" style="height:160px; box-shadow: 0px 2px 15px rgb(0, 0, 0); width:240px; background-size: cover; margin:10px;">
                    <img class="card-galery" src="boneles_potatoes_ketchup.png" alt="boneless potatoes ketchup" style="height:160px; box-shadow: 0px 2px 15px rgb(0, 0, 0); width:240px; background-size: cover; margin:10px;">
                    <img class="card-galery" src="gringa_cr.png" alt="gringa" style="height:160px; box-shadow: 0px 2px 15px rgb(0, 0, 0); width:240px; background-size: cover; margin:10px;">
                    <img class="card-galery"src="atenas_burger.png" alt="atenas burger" style="height:160px; box-shadow: 0px 2px 15px rgb(0, 0, 0); width:240px; background-size: cover; margin:10px;">
                    <img class="card-galery"src="meaty-hamburger-restaurant.png" alt="atenas burger" style="height:160px; box-shadow: 0px 2px 15px rgb(0, 0, 0); width:240px; background-size: cover; margin:10px;">

                </div>
            </div>
        </div>
    </section>

      

    <section id="container-menu-index">
        <div id="interno-menu-index">                
            <div class="card" style="height: auto; background-color: transparent; border:none;">
                {{-- <div class="card-header">
                    <div style="display:flex; justify-content:center; align-items:center; height:100px; font-family: 'Monda', sans-serif;">
                        <h2 class="subtitulos" style="cursor:context-menu;">Menú</h2>
                    </div>                        
                </div> --}}
                <div  style="display:flex; flex-wrap:nowrap; background-color: transparent;">
                    <div class="card-body content-about" style=" display:flex; background-color: transparent;   width:80vw;">
                            {{-- <img src="delicious-fried-chicken-fries.jpg" id="picture-menu" style="heigt:auto; max-width:40%;" alt="food"> --}}
                        <div class="contenido-menu">
                            <h2 class="subtitulos" style="cursor:context-menu; color:#e0a91e" >Contenido del menú</h2>
                            <br>
                            <br>
                            <div style="width: 100%; display:flex; flex-wrap:wrap; overflow-y:auto;">
                                @foreach ($menu as $food)
                                <div class="contenedor-platillos">
                                    <p class="platillos">{{$food->name}}</p>
                                     <p style="font-size: 17px; color:#e0a91e; width:100%;"><span style="color: white;">............................</span> ${{$food->price}}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="img-menu">
        <div style="height: 70vh; padding:30px;">
            <div style="background-color:transparent; border:1px solid white; height:100%; display:flex;flex-direction:column; align-items:center; padding-top:90px;">
                <h2 class="subtitulos" style="color: white;">¿Listo para ordenar?</h2>
                <p style="color: white;">Haz click en el siguiente botón para elegir algo del menu.</p>
                <a href="{{route('menu')}}" style="text-decoration: none; margin-top:30px">
                    <button class="btn-ordenar-menu">
                        Ver Menú y Ordenar
                    </button>
                </a>
            </div>
        </div>
    </div>
    </section>

<section id="container-resenias-index">
    <div id="interno-resenias-index">                
        <div class="card" style="height: 35em; background:transparent; border:none; ">
            <div class="card-header" style="background:transparent; border:none">
                <div style="display: flex; justify-content: space-between; align-items: center; height: 100px; font-family: 'Monda', sans-serif;">
                    <p></p>
                    <h2 class="subtitulos" style="cursor: context-menu; color:#e0a91e;">Reseñas</h2>
                    <button type="button" class="btn btn-outline-success" style="border-radius: 100%;" data-bs-toggle="modal" data-bs-target="#addReviewModal">
                        <i class="bi bi-chat-dots" title="Comentar"></i> 
                    </button>
                </div>                        
            </div>
            <div class="card-body" style="overflow-y: auto; padding: 50px; border-radius:20px; background:#131718; box-shadow: 0px 10px 15px rgb(0, 0, 0)">
                @forelse ($reseñas as $reseña)
                    <div class="wrapper" style="margin-bottom: 20px; background-color: #131313da; padding: 15px; border-radius: 8px;">
                        <div class="title" style="margin-bottom: 10px;">
                            {{-- <p class="heading" style="color: #fff; font-size: 1.2em;">{{ $reseña->folio }}</p> --}}
                            <p class="desc" style="color: #aaa;">{{ $reseña->contenido }}</p>
                        </div>
                        <div class="color chinese-black" style="background-color: #141414; color: #e1e1e1; padding: 10px; border-radius: 5px;">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="star-rating">
                                    <i class="bi bi-star{{ $i <= $reseña->rating ? '-fill' : '' }}"></i>
                                </span>
                            @endfor
                        </div>
                    </div>
                @empty
                    <h2 class="text-muted"><strong><i class="bi bi-exclamation-circle"></i> No hay reseñas disponibles.</strong></h2>
                @endforelse
            </div>
        </div>
    </div>
</section>


<!-- Modal de agregar reseña -->
<div class="modal fade" id="addReviewModal" tabindex="-1" aria-labelledby="addReviewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addReviewModalLabel">Agregar una reseña</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('review.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="folio" class="form-label">Folio</label>
                        <input type="text" class="form-control" id="folio" name="folio" required>
                        @error('folio')
                            <p style="color: red">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="contenido" class="form-label">Contenido</label>
                        <textarea class="form-control" id="contenido" name="contenido" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="rating" class="form-label">Calificación</label>
                        <div class="star-rating">
                            <input type="radio" id="star5" name="rating" value="5" />
                            <label for="star5" title="5 estrellas">&#9733;</label>

                            <input type="radio" id="star4" name="rating" value="4" />
                            <label for="star4" title="4 estrellas">&#9733;</label>

                            <input type="radio" id="star3" name="rating" value="3" />
                            <label for="star3" title="3 estrellas">&#9733;</label>

                            <input type="radio" id="star2" name="rating" value="2" />
                            <label for="star2" title="2 estrellas">&#9733;</label>

                            <input type="radio" id="star1" name="rating" value="1" />
                            <label for="star1" title="1 estrella">&#9733;</label>

                            <input type="hidden" id="ratingValue" name="rating" value="" />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Confirmar reseña</button>
                </form>
            </div>
        </div>
    </div>
</div>



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

    <section style=" margin-top:300px; width:100%;">
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
                
                navbar.style.top = "-200px"; 
            } else {
                // Si se desliza hacia arriba, mostrar la barra de navegación
                navbar.style.top = "0";

            }

            // Actualizamos la posición previa del scroll
            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // Evita números negativos
        });
        document.querySelectorAll('.star-rating input').forEach((input) => {
            input.addEventListener('change', function() {
                document.getElementById('ratingValue').value = this.value;
            });
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
</body>
</html>