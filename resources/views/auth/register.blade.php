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

        }
        .input-icon {
            position: relative;
            width: 100%;
        }
        .input-icon i {
            position: absolute;
            left: 10px;
            top: 45%;
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
            background-color: rgba(49, 49, 49, 0.651);   
            color: white;
            box-shadow: 0px 0px 20px rgb(29, 29, 29);
            border-radius: 20px;
            border: none;
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
            border-radius: 15px;
            background-color: rgb(13, 118, 136);
            color: white;
            border: none;
            height: 40px;
            transition: transform 0.3s ease; 
            margin-top: 28px;
        }
        .btn-register:hover{
            transform: translateY(2px); 
            background: rgb(25, 131, 150);
            box-shadow: 0px -1px 20px rgb(24, 29, 53);
        }
        
        .btn-register:active{
            background-color: rgb(62, 139, 153);
        }

    </style>
 </head>
 <body id="body-register">
    <section id="reg-cont">            
        <div class="card mb-3" style="height:auto; width:25em;margin-top:40px;">
            <div class="row g-0" style="height: auto;">
                <div  class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <h2 class="card-title" style="text-align: center;">Sign in</h2>
                        <hr>

                        <div class="col-md-12">
                            
                            <div class="col-md-8 input-icon">
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

                            
                            <div>
                                <button style="width: 100%" type="submit" class="btn-register">Register</button>
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