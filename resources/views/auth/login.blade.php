{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}





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
            overflow-x: auto;
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

        .card-body{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            /* height: 100%; */
        }
        
        #container-inputs div,#btn-sesion{
            margin-top: 20px;
        }

        .img-fluid{
            height: 99.7%;
        }
        
        #btn-sesion{
            width: 17em;
            background-color: rgb(13, 118, 136);
            color: white;
            border: none;
            transition: transform 0.3s ease; 
        }

        #btn-sesion:hover{
            transform: translateY(2px); 
            background: rgb(25, 131, 150);
            box-shadow: 0px 10px 20px 0px rgba(0, 0, 0, 0.473);
        }

        #btn-sesion:active{
            background-color: rgb(62, 139, 153);
            
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
            justify-content:center
        }     
   
   
    </style>
</head>
<body id="body-login">
    <section id="cont">
        <div class="card mb-3" style="height:auto; width:25em;margin-top:40px;">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="col-md-12">
                        <div id="container-inputs" class="card-body">
                            <img id="logo-atenas" style="cursor:-webkit-grabbing;" width="120px" src="LOGO_ATENAS_high_quality_transparent.png" alt="logo_atenas">

                            <h2 class="card-title">Sign in</h2>

                            <div class="col-md-9">                            
                                {{-- <label for="email" class="form-label">Email</label> --}}
                                <div class="col-md-8 input-icon">
                                    <i class="bi bi-person-fill"></i>  <!-- Icono de usuario -->
                                    <input type="email" placeholder="Email" class="form-control" id="email" name="email" autofocus autocomplete="username">
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
                            
                            <div class="mt-4" style="display:flex; flex-direction:column;">
                                <div style="display: flex; flex-direction:column; align-items:center">
                                    <button  type="submit" id="btn-sesion" class="btn" style="border-radius: 15px;">Enter</button>  
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
                            
                </form>
            </div>            
        </div>          
    </section>
    
    <section style="border-top:1px solid yellow; margin-top:100px; width:100%;">
        @include('layout.base')
    </section>
    
</body>
</html>
