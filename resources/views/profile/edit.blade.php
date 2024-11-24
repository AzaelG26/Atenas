@extends('layout.sidebar')    
@section('title', 'Datos de usuario')

@push('styles')
<style>    
    body{
        background-color:#0C1011;
    }
    .input {
    background-color: #212121;
    max-width: 400px;
    width: 100%;
    height: 40px;
    padding: 10px;
    /* text-align: center; */
    border: 2px solid white;
    color: white;
    border-radius: 5px;
    /* box-shadow: 3px 3px 2px rgb(249, 255, 85); */
    }

    .input:focus {
    background-color: #363535;
    outline-color: rgb(53, 53, 53);
    box-shadow: 2px 3px 15px #fcc12d;
    transition: .1s;
    transition-property: box-shadow;
    }
    .title-user-form{
        border-bottom: 1px solid #ce9d22;
    }
    .subtitle-user{
        color: white;
    }
    .subtitle-user:hover{
        color: #ce9d22;
        filter: drop-shadow(0px 0px 5px #ce9d22);
    }
    /* Style boton */
    .btn-accept {
        --hover-shadows: 1px 3px 3px #121212, 0px 0px 13px #303030b6;
        --accent: rgb(13, 118, 136);
        font-size: 14px;
        font-weight: bold;
        letter-spacing: 0.1em;
        border: none;
        height: 45px;
        width: 10em;
        border-radius: 1.1em;
        background-color: #212121;
        cursor: pointer;
        color: white;
        transition: box-shadow ease-in-out 0.3s, background-color ease-in-out 0.1s,
            letter-spacing ease-in-out 0.1s, transform ease-in-out 0.1s;
    }
    .btn-accept:hover {
        box-shadow: var(--hover-shadows);
    }
    .btn-accept:active {
        box-shadow: var(--hover-shadows), var(--accent) 0px 0px 10px 5px;
        background-color: var(--accent);
        transform: scale(0.9);
    }   
</style>  
@endpush

@section('content') 
<main id="content-all">
    <div class="container py-4">
        <div class="pb-3 mb-4 title-user-form">
            &nbsp; &nbsp;<span class="fs-4 subtitle-user">Datos de usuario</span>
        </div>

        <!-- Formulario para editar datos del perfil -->
        <div style="background-color: #131718; display:flex" class="p-5 mb-4 rounded-3">
            <div class="container-fluid py-5">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PATCH')
                    <p style="color: darkgray;">*Puedes editar tus datos</p>
                    <div class="col-md-8 input-icon">
                        <input placeholder="Nombre" class="input" name="name" type="text" value="{{old('name', $user->name)}}">            
                        <p class="text-danger" style="display:flex; justify-content:center;height: 30px; width:100%; flex-wrap:nowrap;">
                            @error('name') 
                                <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                            @enderror
                        </p>
                    </div>

                    <div class="col-md-8 input-icon">
                        <input placeholder="Email" class="input" name="email" type="email" value="{{old('email', $user->email)}}">            
                        <p class="text-danger" style="display:flex;justify-content:center;height: 30px; width:100%; flex-wrap:nowrap;">
                            @error('email')
                                <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                            @enderror
                        </p>
                    </div>

                    <button  type="submit" class="btn-accept">Aceptar</button>  
                </form>
            </div>    
        </div>

        <!-- Formulario para editar la contraseña -->
        <div style="background-color: #131718; display:flex" class="p-5 mb-4 rounded-3">
            <div class="container-fluid py-5">
                <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('put')
                    <p style="color: darkgray;">*Puedes editar tu contraseña</p>
                    <div class="col-md-8 input-icon">
                        <input placeholder="Contraseña actual" class="input" name="current_password" type="password" >            
                        <p class="text-danger" style="display:flex;justify-content:center;height: 30px; width:100%; flex-wrap:nowrap;">
                            @error('current_password') 
                                <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                            @enderror
                        </p>
                    </div>

                    <div class="col-md-8 input-icon">
                        <input placeholder="Nueva contraseña" class="input" name="password" type="password" >            
                        <p class="text-danger" style="display:flex;justify-content:center;height: 30px; width:100%; flex-wrap:nowrap;">
                            @error('password') 
                                <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                            @enderror
                        </p>
                    </div>

                    <div class="col-md-8 input-icon mt-3">
                        <input placeholder="Confirma nueva contraseña" class="input" name="password_confirmation" type="password" required>
                    </div>

                    <button  type="submit" class="btn-accept" style="margin-top: 50px"><span>Aceptar</span></button>  
                </form>
            </div>
        </div>

        <!-- Formulario para eliminar cuenta -->
        <div style="background-color: #131718; display:flex" class="p-5 mb-4 rounded-3">
            <div class="container-fluid py-5">
                <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.')">
                    @csrf
                    @method('DELETE')
                    <p style="color: darkgray;">*Esta acción eliminará permanentemente tu cuenta</p>
                    
                    <!-- Campo para confirmar la contraseña antes de eliminar la cuenta -->
                    <div class="col-md-8 input-icon">
                        <input placeholder="Confirma tu contraseña" class="input" name="password" type="password" required>            
                        <p class="text-danger" style="display:flex;justify-content:center;height: 30px; width:100%; flex-wrap:nowrap;">
                            @error('password') 
                                <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                            @enderror
                        </p>
                    </div>

                    <button type="submit" class="btn-accept" style="background-color: red; margin-top: 20px;">
                        Eliminar Cuenta
                    </button>
                </form>
            </div>
        </div>

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

    </div>
</main>
<script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
@endsection
