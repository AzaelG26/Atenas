<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log in</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Para íconos de redes sociales --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        #body-login{
            margin: 0;
            background-color: #0C1011; /* Cambia a un color opaco para comprobar */
            min-height: 100vh; 
            max-width: 100vw;
            overflow-x: auto;
            position: relative; /* Necesario para posicionar contenido sobre el video */

        }

        .nav-link {
            color: #6c757d;
            text-decoration: none;
        }

        .nav-link:hover {
            color: #8CD2F0;
            text-decoration: underline;
        }

        .card{
            color: white;            
            border-radius: 0px; 
        }
            /* box-shadow: 0px 0px 4px rgb(29, 29, 29); */

        .container-forms{
            display:flex;
            flex-direction:row; 
            justify-content: center;
            width:100%; 
            padding: 50px;
            height:auto;
        }
        .contenedor-interno-forms{
            background-color: rgba(14, 14, 14, 0.342);
            /* margin-top:30px; */
            border-radius: 20px;
            width: auto; 
        }

        .first-card{
            display: block;
            background-color: transparent;
            height:auto; 
            width:22em;            
        }
        .second-card{
            display: block;
            border-top-right-radius: 15px; 
            border-radius: 15px;
            height:100%; 
            width:25em; 
            background-color:rgba(255, 255, 255);
        }

        .card-body{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            /* height: 100%; */
        }       
     
        .input-icon {
            position: relative;
            width: 100%;
        }
        

        .input-icon i {
            position: absolute;
            left: 10px;
            top: 29%;
            transform: translateY(-50%);
            color: #888;
        }
        
        .input-icon input {
            padding-left: 35px; /* Espacio para el ícono */
        }

 

        #btn-sesion {
        cursor: pointer;
        border: none;
        width: 15em;        
        padding: 0.5rem 2rem;
        font-family: inherit;
        height: 40px;
        font-size: inherit;
        position: relative;
        display: flex;
        justify-content: center;
        font-weight: 700;       
        border-radius:20px;
        overflow: hidden;
        background: #feffff;
        color: white;
        }

        #btn-sesion span {
        position: relative;
        z-index: 10;
        transition: color 0.4s;        
        
        }

        #btn-sesion:hover span {
        color: #006c8d;
        }

        #btn-sesion::before,
        #btn-sesion::after {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 0;
        }

        #btn-sesion::before {
        content: "";
        background:  rgb(12, 86, 99);
        width: 120%;
        left: -10%;
        transform: skew(30deg);
        transition: transform 0.4s cubic-bezier(0.3, 1, 0.8, 1);
        }

        #btn-sesion:hover::before {
        transform: translate3d(100%, 0, 0);
        }
        #video{
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            filter: blur(1px);
            object-fit: cover; 
            background-size: cover;            
            background-attachment: fixed;
            z-index: -1;
        }


        /* Boton register */
        .btn-register{
        cursor: pointer;
        border: none;
        width: 17em;
        margin-top: 60px;
        padding: 0.5rem 2rem;
        font-family: inherit;
        height: 45px;
        font-size: inherit;
        position: relative;
        display: flex;
        justify-content: center;
        font-weight: 700;       
        border-radius: 20px;
        overflow: hidden;
        background: #feffff;
        border: 0.5px solid gray;
        color: white;
        }
        .btn-register span{
        position: relative;
        z-index: 10;
        transition: color 0.4s;
        }
        
        .btn-register:hover span {
        color: #006c8d;
        
        }

        .btn-register::before,
        .btn-register::after {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 0;
        
        }

        .btn-register::before {
        content: "";
        background:  rgb(12, 86, 99);
        width: 120%;
        left: -10%;
        transform: skew(30deg);
        transition: transform 0.4s cubic-bezier(0.3, 1, 0.8, 1);        
        }

        .btn-register:hover::before {
        transform: translate3d(100%, 0, 0);        
        }

        /* boton google */
        .btn-google{
            transition: all 0.4s ease;
            border: 0.1px solid rgb(219, 219, 219);
        }
        .btn-google:hover{
            box-shadow: 0px 5px 10px rgb(0, 0, 0);
            transform: translateY(2px);
            
        }
        #link-register{
            display: block;
        }

        
        .enter-forgot-password{
            margin-bottom: 0px;
        }
        .card-title{
            margin-bottom:40px;
        }
        @media (max-width: 1030px){
            /* #link-register{
                display: block;
            } */
            .card-title{
                margin-bottom: 20px;
            }
            .second-card{
                display: none;
                width: 22em;
                border-radius: 15px;
            }            
            .enter-forgot-password{
                margin-top: 0px;
            }

        }

            
        #cont {
            display: flex;
            transition: all 0.5s ease; /* Transición para cambio de estilos*/
            width:100vw; 
            height: auto; 
            justify-content:center;
            position: relative; 
            z-index: 1; 
        }        

    </style>    
</head>
<body id="body-login">
    <video autoplay muted loop playsinline id="video" >
        <source src="6899103_Dream_Scene_3840x2160.mp4" type="video/mp4">
    </video>

    
    
    <section id="cont">
        <div class="container-forms">
            <div class="contenedor-interno-forms" style="display: flex;">
                {{-- Con border-0 le quitamos el border de la card que tiene por defecto --}}
                <div class="card border-0  first-card mb-3 " id="first-card" >
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="col-md-12">
                            <div class="card-body">
                                <img id="logo-atenas" style="cursor:-webkit-grabbing;" width="120px" src="LOGO_ATENAS_high_quality_transparent.png" alt="logo_atenas">

                                <h2 class="card-title">¡Bienvenido!</h2>
                                <p>Inicia sesión</p>
                                <div class="col-md-9">                            
                                    {{-- <label for="email" class="form-label">Email</label> --}}
                                    <div class="col-md-8 input-icon">
                                        <i class="bi bi-person-fill"></i>  <!-- Icono de usuario -->
                                        <input type="email" placeholder="Email" class="form-control" id="email" style="font-size: 15px" name="email" autofocus autocomplete="username">
                                        <p class="text-danger" style="display:flex;justify-content:center;height: 30px; width:100%; flex-wrap:nowrap;">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                    </div>
                                
                                    {{-- <label for="password" class="form-label">Password</label> --}}
                                    <div class="col-md-8 input-icon">
                                        <i class="bi bi-lock-fill"> </i> <!-- Icono de candado -->
                                        <input type="password" placeholder="Password" class="form-control" id="password" name="password" autocomplete="current-password">
                                        <p class="text-danger" style="display:flex;justify-content:center;height: 30px; width:100%;flex-wrap:nowrap;">
                                            @error('password')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                    </div>
                                </div>                    
                                {{-- <div class="col-md-7">
                                    <label for="remember_me" class="inline-flex items-center">
                                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                    </label>
                                </div> --}}
                            
                                <div class="mt-4" style="display:flex; flex-direction:column; ">
                                    <div class="enter-forgot-password" style="display: flex; flex-direction:column; align-items:center">
                                        <button  type="submit" id="btn-sesion" class="btn" style="border-radius: 15px;"><span>Enter</span></button>  
                                        <p style="text-align: center; margin-top:10px;">O</p>
                                        <a href="{{ url('/login-google') }}" class="btn btn-google" style="background-color: white; color: black; border-radius:17px; width:100% ">
                                            <img width="25" height="25" src="https://img.icons8.com/color/48/google-logo.png" alt="google-logo"/>
                                            Iniciar sesión con Google
                                        </a>
                                        <a href="{{ route('password.mostrar') }}">
                                            {{ __('¿Olvidaste tu contraseña?') }}
                                        </a> 
                                    </div>
                                </div>
                                @if (Route::has('register'))
                                <div id="link-register">
                                    {{-- href="{{ route('register') }}"  --}}
                                    {{-- onclick="mostrarFormularioRegister()" --}}
                                    <p style="margin-top:20px">¿No tienes una cuenta? &nbsp;<a  href="{{route('register')}}" style="text-decoration:underline; color:#0A58CA; cursor: pointer;">Registrate</a></p>
                                </div>
                                @endif  
                                {{-- <div class="flex items-center justify-end mt-4" >                                
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                                    @endif                
                                </div> --}}
                            </div> 
                        </div>   
                        
                    </form>
                </div>                  
            </div>
        </div>        
    </section>

    {{-- <section style="border-top:1px solid yellow; margin-top:100px; width:100%;">
        @include('layout.base')
    </section> --}}

    <script>
            
            const formReg = document.getElementById('second-card');
            const formSesion = document.getElementById('first-card');
            const errorMessages = document.querySelectorAll('.text-danger');
            formReg.style.display = 'none';
            formSesion.style.display = 'block';

            function mostrarFormularioRegister() {
                if (formReg.style.display === 'none' && formSesion.style.display === 'block') {
                    formReg.style.display = 'block';
                    formSesion.style.display = 'none';
                    
                }
                else if(formReg.style.display === 'block' && formSesion.style.display === 'none'){
                    formReg.style.display = 'none';
                    formSesion.style.display = 'block';
                    
                }                

                errorMessages.forEach(function(errorMessage) { 
                    errorMessage.innerText = ''; 

                });
            }

    // No modificar estilos al redimensionar para no resetear las animaciones
    window.addEventListener('resize', () => {
        if (formReg && formSesion) {
            formReg.style.borderRadius='15px';
            // Aquí no removemos los estilos de display ni visibilidad
        }
    });

    window.addEventListener('load', function() {
        document.getElementById('loader').style.display = 'none';
    });

    </script>

    @if (session('status'))
    <script>
            alert('{{ session('status') }}');
    </script>        
    @endif 
    
     @if (session('success'))
    <script>
            alert('{{ session('success') }}');
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
