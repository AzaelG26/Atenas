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
            background-color: #0e1327; /* Cambia a un color opaco para comprobar */
            min-height: 100vh; /* Asegúrate de que el body ocupe al menos el 100% de la altura de la ventana */
            position: relative; /* Necesario para posicionar contenido sobre el video */

        }
        .input-icon {
            position: relative;
            width: 80%;
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
            background-color: rgba(14, 14, 14, 0.342);
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
            align-items: center;
        }
        .input-icon {
            margin-top: 28px;
        }
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
        background:  rgb(13, 118, 136);
        width: 120%;
        left: -10%;
        transform: skew(30deg);
        transition: transform 0.4s cubic-bezier(0.3, 1, 0.8, 1);
        }

        .btn-register:hover::before {
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
    </style>
 </head>
 <body id="body-register">

    <video autoplay muted loop playsinline id="video" >
        <source src="6899103_Dream_Scene_3840x2160.mp4" type="video/mp4">
    </video>
    
    <section id="reg-cont">            
        <div class="card mb-3" style="height:auto; width:25em;margin-top:40px;">
            <div class="row g-0" style="height: auto;">
                <div  class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <h2 class="card-title" style="text-align: center;">Register</h2>
                        <hr>

                        <div class="col-md-12" style="display: flex; flex-direction:column; align-items:center;">
                            
                            <div class="col-md-12 input-icon">
                                <i class="bi bi-person-fill"></i>  <!-- Icono de usuario -->
                                <input type="text" placeholder="Name" class="form-control" id="name" name="name" autocomplete="name">
                                <p class="text-danger" style="display:flex;justify-content:center;height: 4px; width:100%; flex-wrap:nowrap;">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>


                            

                            <div class="col-md-8 input-icon">
                                <i class="bi bi-envelope-fill"></i>  <!-- Icono de Correo Electrónico -->
                                <input type="email" placeholder="Email" class="form-control" id="email" name="email" autofocus autocomplete="username">
                                <p class="text-danger" style="display:flex;justify-content:center;height: 4px; width:100%; flex-wrap:nowrap;">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>

                        
                            <div class="col-md-8 input-icon">
                                <i class="bi bi-lock-fill"> </i> <!-- Icono de candado -->
                                <input type="password" placeholder="Password" class="form-control" id="password" name="password" autocomplete="current-password">
                                <p class="text-danger" style="display:flex;justify-content:center;height: 4px; width:100%; flex-wrap:nowrap;">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>

                            
                            <div class="col-md-8 input-icon">
                                <i class="bi bi-lock-fill"> </i> <!-- Icono de candado -->
                                <input type="password" placeholder="Confirm Password" class="form-control" id="password_confirmation" name="password_confirmation"  autocomplete="new-password">
                                <p class="text-danger" style="display:flex;justify-content:center;height: 4px; width:100%; flex-wrap:nowrap;">
                                    @error('password_confirmation')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                            
                            <div style=" display:flex; justify-content:center; width: 100%;">
                                <button style="width: 80%" type="submit" class="btn-register"><span>Accept</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section style="border-top:1px solid yellow; margin-top:220px; width:100%;">
        @include('layout.base')
    </section>

 </body>
 </html>