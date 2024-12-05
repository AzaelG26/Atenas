@extends('layout.sidebar')    
@section('title', 'Añadir datos personales')
@push('styles')
<style>
    body{
        background-color:#0C1011;
    }
    .title-person-form{
        border-bottom: 1px solid #ce9d22;
    }
    .subtitle-persons{
        color: white;
    }
    .subtitle-persons:hover{
        color: #ce9d22;
        filter: drop-shadow(0px 0px 5px #ce9d22);
    }
    /* Inputs */
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

    /* Radios */
    .radio-container {    
    color: white;
    }

    .radio-wrapper {
    margin-bottom: 10px;
    }

    .radio-button {
    cursor: pointer;
    transition: all 0.2s ease-in-out;
    }

    .radio-button:hover {
    transform: translateY(-2px);
    }

    .radio-button input[type="radio"] {
    display: none;
    }

    .radio-checkmark {
    display: inline-block;
    position: relative;
    width: 16px;
    height: 16px;
    margin-right: 10px;
    border: 2px solid #ffffff;
    border-radius: 50%;
    }

    .radio-checkmark:before {
    content: "";
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0);
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background-color: rgb(13, 118, 136);
    transition: all 0.2s ease-in-out;
    }

    .radio-button input[type="radio"]:checked ~ .radio-checkmark:before {
    transform: translate(-50%, -50%) scale(1);
    }

    .radio-label {
    font-size: 16px;
    font-weight: 600;
    }

</style>
@endpush
@section('content')
<main id="content-all">
    <div class="container py-4">
        <div class="pb-3 mb-4 title-person-form" style="display: flex; justify-content:space-between;">
            <span class="fs-4 subtitle-persons">&nbsp; &nbsp;Datos personales</span>             
        </div>
        <div style="background-color: #131718; display:flex" class="p-5 mb-4 rounded-3">
            <div class="container-fluid py-5">                    

                <form action="{{ route('personas.create') }}" method="POST">
                    @csrf
                        <div class="col-md-8 input-icon">
                            <input placeholder="Nombre" class="input" name="name" type="text" onkeypress="return evitarNumeros(event)" required>
                            <p  style="display:flex;justify-content:center;height: 30px; width:100%; flex-wrap:nowrap;">
                                @error('name') 
                                    <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                                @enderror
                            </p>
                        </div> 
                                                
                        <div class="col-md-8 input-icon">
                            <input placeholder="Apellido paterno" class="input" name="paternal_lastname" type="text" onkeypress="return evitarNumeros(event)" required>            
                            <p  style="display:flex;justify-content:center;height: 30px; width:100%; flex-wrap:nowrap; ">
                                @error('paternal_lastname') 
                                    <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                                @enderror
                            </p>
                        </div>  

                        <div class="col-md-8 input-icon">
                            <input placeholder="Apellido materno" class="input" name="maternal_lastname" type="text" required>            
                            <p  style="display:flex;justify-content:center;height: 30px; width:100%; flex-wrap:nowrap; ">
                                @error('maternal_lastname') 
                                    <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                                @enderror
                            </p>
                        </div>                          

                        <div class="col-md-8 input-icon">
                            <div class="radio-container">
                                <div class="radio-wrapper">
                                    <label class="radio-button">
                                    <input id="male" name="gender" type="radio" value="male">
                                    <span class="radio-checkmark"></span>
                                    <span class="radio-label">Masculino</span>
                                    </label>
                                </div>

                                <div class="radio-wrapper">
                                    <label class="radio-button">
                                    <input id="female" name="gender" type="radio" value="memale">
                                    <span class="radio-checkmark"></span>
                                    <span class="radio-label">Femenino</span>
                                    </label>
                                </div>

                                <div class="radio-wrapper">
                                    <label class="radio-button">
                                    <input id="other" name="gender" type="radio" value="other">
                                    <span class="radio-checkmark"></span>
                                    <span class="radio-label">Otro</span>
                                    </label>
                                </div>
                            </div>                    
                        </div>

                        <div class="col-md-8 input-icon">
                            <input placeholder="Número de teléfono" class="input" name="cellphone_number" type="text" onkeypress="return soloNumeros(event)" required>            
                            <p  style="display:flex;justify-content:center;height: 30px; width:100%; flex-wrap:nowrap; ">
                                @error('cellphone_number') 
                                    <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                                @enderror
                            </p>
                        </div> 

                        <div class="col-md-8 input-icon">
                            <label for="birthdate" style="color: white;">Fecha de nacimiento</label>
                            <br>
                            <input type="date" id="birthdate" name="birthdate" class="input">
                            <p  style="display:flex;justify-content:center;height: 30px; width:100%; flex-wrap:nowrap; ">
                                @error('birthdate') 
                                    <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                                @enderror
                            </p>
                        </div>

                        <button class="btn-accept " type="submit">Aceptar</button>
                </form>
            </div>                     
        </div>
    </div>
</main>

<script>
    function evitarNumeros(event){
        const charCode = event.charCode || event.keyCode;
        const charStr = String.fromCharCode(charCode);

        if(/[0-9]/.test(charStr)){
            return false
        }
        return true;
    }

    function soloNumeros(event){
        const charCode = event.charCode || event.keyCode;
        const charStr = String.fromCharCode(charCode);

        if(!/[0-9]/.test(charStr)){
            return false
        }
        return true
    }

    const inputFecha = document.getElementById('birthdate');
    const fechaActual = new Date();

    const fechaMaxima = new Date();
    fechaMaxima.setFullYear(fechaActual.getFullYear() - 18);

    const fechaMinima = new Date();
    fechaMinima.setFullYear(fechaActual.getFullYear() -90);

    inputFecha.min = fechaMinima.toISOString().split('T')[0]; // Formato YYYY-MM-DD
    inputFecha.max = fechaMaxima.toISOString().split('T')[0]; // Formato YYYY-MM-DD



    
</script>

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

@endsection