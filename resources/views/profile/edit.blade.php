@extends('layout.sidebar')    

@section('title', 'Datos de usuario')

@push('styles')
<style>    
    .alert-success {
        background-color: #4BB543;
        color: white;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 15px;
        position: fixed; 
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        width: 80%;
        text-align: center;
        z-index: 9999; 
        opacity: 1;
        transition: opacity 1s ease-in-out;
    }

    body {
        background-color: #0C1011;
    }
    .input {
        background-color: #212121;
        max-width: 400px;
        width: 100%;
        height: 40px;
        padding: 10px;
        border: 2px solid white;
        color: white;
        border-radius: 5px;
    }
    .input:focus {
        background-color: #363535;
        box-shadow: 2px 3px 15px #fcc12d;
        transition: box-shadow 0.1s;
    }
    .title-user-form {
        border-bottom: 1px solid #ce9d22;
    }
    .subtitle-user {
        color: white;
    }
    .subtitle-user:hover {
        color: #ce9d22;
        filter: drop-shadow(0px 0px 5px #ce9d22);
    }
    .btn-accept {
        font-size: 14px;
        font-weight: bold;
        border: none;
        height: 45px;
        width: 10em;
        border-radius: 1.1em;
        background-color: #212121;
        cursor: pointer;
        color: white;
        transition: box-shadow 0.3s ease-in-out, background-color 0.1s ease-in-out, transform 0.1s ease-in-out;
    }
    .btn-accept:hover {
        box-shadow: 1px 3px 3px #121212, 0px 0px 13px #303030b6;
    }
    .btn-accept:active {
        box-shadow: 1px 3px 3px #121212, 0px 0px 13px #303030b6, 0px 0px 10px 5px rgb(13, 118, 136);
        background-color: rgb(13, 118, 136);
        transform: scale(0.9);
    }
</style>  
@endpush

@section('content') 
<main id="content-all">
    <div class="container py-4">
        
        @if (session('success'))
        <div class="alert alert-success" id="success-message">
            {{ session('success') }}
        </div>
        @endif

        @push('scripts')
        <script>
            @if (session('status'))
                window.onload = function() {
                    setTimeout(function() {
                        document.getElementById('success-message').style.display = 'none';
                    }, 5000); 
                }
            @endif
        </script>
        @endpush

        <div class="pb-3 mb-4 title-user-form">
            &nbsp; &nbsp;<span class="fs-4 subtitle-user">Datos de usuario</span>
        </div>

        <div style="background-color: #131718; display:flex" class="p-5 mb-4 rounded-3">
            <div class="container-fluid py-5">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PATCH')
                    <p style="color: darkgray;">*Puedes editar tus datos</p>
                    <div class="col-md-8 input-icon">
                        <input 
                            placeholder="Nombre" 
                            class="input" 
                            name="name" 
                            type="text" 
                            value="{{ old('name', $user->name) }}" 
                            minlength="4" 
                            required
                        >            
                        <p class="text-danger" style="display:flex;justify-content:center;height: 30px; width:100%; flex-wrap:nowrap;">
                            @error('name') 
                                <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                            @enderror
                        </p>
                        @if ($errors->has('name') && strlen(old('name', $user->name)) < 4)
                            <div class="text-red-500 text-sm">El nombre debe tener al menos 4 caracteres.</div>
                        @endif
                    </div>

                    <div class="col-md-8 input-icon">
                        <input placeholder="Email" class="input" name="email" type="text" value="{{old('email', $user->email)}}">            
                        <p class="text-danger" style="display:flex;justify-content:center;height: 30px; width:100%; flex-wrap:nowrap;">
                            @error('email')
                                <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                            @enderror
                        </p>
                    </div>

                    <button type="submit" class="btn-accept">Aceptar</button>  
                </form>
            </div>    
        </div>

        <div style="background-color: #131718; display:flex" class="p-5 mb-4 rounded-3">
            <div class="container-fluid py-5">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('PUT')
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

                    <button type="submit" class="btn-accept" style="margin-top: 50px"><span>Aceptar</span></button>  
                </form>
            </div>
        </div>

        <div style="background-color: #131718; display:flex" class="p-5 mb-4 rounded-3">
            <div class="container-fluid py-5">
                <form method="POST" action="{{ route('profile.deactivate') }}" onsubmit="return confirm('¿Estás seguro de que deseas desactivar tu cuenta? Esta acción no eliminará tu cuenta permanentemente.')">
                    @csrf
                    @method('PATCH')
                    <p style="color: darkgray;">*Puedes desactivar tu cuenta temporalmente</p>

                    <div class="col-md-8 input-icon">
                        <input placeholder="Confirma tu contraseña" class="input" name="password" type="password" required>            
                        <p class="text-danger" style="display:flex;justify-content:center;height: 30px; width:100%; flex-wrap:nowrap;">
                            @error('password') 
                                <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                            @enderror
                        </p>
                    </div>

                    <button type="submit" class="btn-accept" style="background-color: orange; margin-top: 20px;">
                        Desactivar Cuenta
                    </button>
                </form>
            </div>
        </div>

      
        <div style="background-color: #131718; display:flex" class="p-5 mb-4 rounded-3">
            <div class="container-fluid py-5">
                <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('¿Estás seguro de que deseas eliminar tu cuenta? Esta acción es permanente y no se puede deshacer.')">
                    @csrf
                    @method('DELETE')
                    <p style="color: darkgray;">*Eliminar cuenta permanentemente</p>

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
    </div>
</main>
@endsection
