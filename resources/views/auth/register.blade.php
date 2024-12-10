{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

 --}}

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">


    <style>
         #body-register{
            margin: 0;
            background-color: #0C1011; /* Cambia a un color opaco para comprobar */
            min-height: 100vh; 
            max-width: 100vw;
            overflow-x: auto;
            position: relative; /* Necesario para posicionar contenido sobre el video */

        }
        .second-card{
            display: block;
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
            top: 32%;
            transform: translateY(-50%);
            color: #888;
        }
        .input-icon input {
            padding-left: 40px; /* Espacio para el ícono */
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
            /* box-shadow: 0px 0px 20px rgb(29, 29, 29); */
            border-radius: 20px;
            border: 1px solid rgb(8, 5, 39);
        }
        #reg-cont{
            display:flex; 
            width:100vw; 
            height: auto; 
            justify-content:center;
            position: relative; 
            z-index: 1; 
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
                   
            .enter-forgot-password{
                margin-top: 0px;
            }

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
            z-index: -1;
        }
        #reg-cont{
            transition: all 0.5s ease; /* Transición para cambio de estilos*/
        }
    </style>
 </head>
 <body id="body-register">

    <video autoplay muted loop playsinline id="video" >
        <source src="6899103_Dream_Scene_3840x2160.mp4" type="video/mp4">
    </video>
    
    <section id="reg-cont">            
        <div class="card border-0 second-card mb-3" id="second-card">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="col-md-12">
                            <div class="card-body">

                                <h2 class="card-title" style="color:rgb(71, 71, 71); margin-top:60px; ">Crear una cuenta</h2>
                                
                                <div class="col-md-10">                            
                                    {{-- <label for="email" class="form-label">Email</label> --}}
                                    <div class="col-md-8 input-icon">
                                        <i class="bi bi-person-fill" style="top:50%"></i>  <!-- Icono de usuario -->
                                        <input type="text" placeholder="Name" class="form-control" id="name" name="name" autocomplete="name">
                                        <p class="text-danger" style="display:flex;justify-content:center;height: 4px; ; width:100%; flex-wrap:nowrap;">
                                            @error('name')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                    </div>
                                
                                    {{-- <label for="password" class="form-label">Password</label> --}}
                                    <div class="col-md-8 input-icon" style="margin-top:40px;">
                                        <i class="bi bi-envelope-fill" style="top:50%"></i>  <!-- Icono de Correo Electrónico -->
                                        <input type="email" placeholder="Email" class="form-control" id="email" name="email" autofocus autocomplete="username">
                                        <p class="text-danger" style="display:flex;justify-content:center;height: 4px; width:100%; flex-wrap:nowrap;">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                    </div>

                                    <div class="col-md-8 input-icon" style="margin-top:40px;">
                                        <i class="bi bi-lock-fill" style="top:50%"> </i> <!-- Icono de candado -->
                                        <input type="password" placeholder="Password" class="form-control" id="password" name="password" autocomplete="current-password">
                                        <p class="text-danger" style="display:flex;justify-content:center;height: 4px; width:100%; flex-wrap:nowrap;">
                                            @error('password')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                    </div>

                                    <div class="col-md-8 input-icon" style="margin-top:40px;">
                                        <i class="bi bi-lock-fill" style="top:50%"> </i> <!-- Icono de candado -->
                                        <input type="password" placeholder="Confirm Password" class="form-control" id="password_confirmation" name="password_confirmation"  autocomplete="new-password">
                                        <p class="text-danger" style="display:flex;justify-content:center;height: 4px; width:100%; flex-wrap:nowrap;">
                                            @error('password_confirmation')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                    </div>

                                    <div style="display:flex; justify-content:center; width: 100%;">
                                        <button style="width: 100%" type="submit" class="btn-register"><span>Registrarse</span></button>
                                    </div>

                                    <p style="text-align: center; margin-top:10px; color:rgb(71, 71, 71);">O</p>

                                    <div>
                                        <a href="{{ url('/login-google') }}" class="btn btn-google" style="background-color: white; color: black; border-radius:17px; width:100% ">
                                            <img width="25" height="25" src="https://img.icons8.com/color/48/google-logo.png" alt="google-logo"/>
                                            Unirse con Google
                                        </a>
                                        @if (Route::has('register'))
                                            <div id="link-register">
                                                {{-- href="{{ route('register') }}"  --}}
                                                <p style="color:rgb(71, 71, 71); text-align:center; margin-top:10px;">¿Ya estás registrado? &nbsp;<a href="{{route('login')}}" style="text-decoration:underline; color:#0A58CA; cursor: pointer;">Volver</a></p>
                                            </div>
                                        @endif  
                                    </div>


                                </div>                    
                                
                            </div> 
                        </div>   
                        <div class="mt-4">                                            
                        </div>
                    </form>
                </div>                         
    </section>


 </body>
 </html>