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
            background-color: rgba(14, 14, 14, 0.342);
            color: white;            
            /* box-shadow: 0px 0px 4px rgb(29, 29, 29); */
            border-radius: 20px;
            border: 1px solid rgb(41, 41, 41);
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

        #cont{
            display:flex; 
            width:100vw; 
            height: auto; 
            justify-content:center;
            position: relative; 
            z-index: 1; 
        }     

        #btn-sesion {
        cursor: pointer;
        border: none;
        width: 13.5em;
        margin-top: 20px;
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
        background:  rgb(13, 118, 136);
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
            height: 60%;
            filter: blur(1px);
            object-fit: cover; 
            background-size: cover;            
            background-attachment: fixed;
            z-index: -1;
        }
    </style>
</head>
<body id="body-login">
    <video autoplay muted loop playsinline id="video" >
        <source src="6899103_Dream_Scene_3840x2160.mp4" type="video/mp4">
    </video>
    
    <section id="cont">
        <div class="card mb-3" style="height:auto; width:20em; margin-top:40px;">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="col-md-12">
                        <div id="container-inputs" class="card-body">
                            <img id="logo-atenas" style="cursor:-webkit-grabbing;" width="120px" src="LOGO_ATENAS_high_quality_transparent.png" alt="logo_atenas">

                            <h2 class="card-title">Sign in</h2>
                            <br>
                            <br>
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
                                    <p  class="text-danger" style="display:flex;justify-content:center;height: 30px; width:100%;flex-wrap:nowrap;">
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
                                <div style="display: flex; flex-direction:column; align-items:center">
                                    <button  type="submit" id="btn-sesion" class="btn" style="border-radius: 15px;"><span>Enter</span></button>  
                                    <a href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a> 
                                </div>
                            </div>
                            @if (Route::has('register'))
                            <div >
                                Don´t have an account? &nbsp;<a href="{{ route('register') }}" >Register</a>
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
    </section>
    
    <section style="border-top:1px solid yellow; margin-top:100px; width:100%;">
        @include('layout.base')
    </section>
    @if (session('status'))
    <script>
            alert('{{ session('status') }}');
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
