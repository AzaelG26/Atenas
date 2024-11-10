@extends('layout.sidebar')    
@section('title', 'Datos personales')
<script src="/docs/5.3/assets/js/color-modes.js"></script>
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
    .btn-add-data{
        transition: transform 0.2s ease;        
    }

    .btn-add-data:hover{
        transform: translateY(2px);
    }
    

    /* inputs */    
    .input {
    background-color: #212121;
    max-width: 400px;
    width: 100%;
    height: 40px;
    padding: 10px;
    /* text-align: center; */
    border: 2px solid rgb(39, 39, 39);
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
</style>
@endpush

@section('content')
<main id="content-all">
    <div class="container py-4">

        <div class="pb-3 mb-4 title-person-form" style="display: flex; justify-content:space-between;">
            <span class="fs-4 subtitle-persons"> &nbsp; &nbsp;Datos personales</span>
                <a href="{{route('formPersonalData')}}">
                    <button type="button" class="btn btn-dark btn-add-data" title="Add Data">                
                            <i style="color:#8CD2F0;" class="bi bi-plus"></i>
                            <i style="color:#8CD2F0;" class="bi bi-person-lines-fill"></i>                    
                    </button>
                </a>        
        </div>

        <div style="background-color: #131718; display:flex" class="p-5 mb-4 rounded-3">
            <div class="container-fluid py-5">  
                <div class="col-md-8 input-icon">
                    <div class="col-sm-6">                                           
                        <label for="name" style="color: white" class="form-label">Nombre(s):</label> <br>
                        <input class="input" id="name" type="text" value="{{old('name', $people->name)}}" disabled>                        
                    </div>

                    <div class="col-sm-6">                                           
                        <label for="paternal_lastname" style="color: white" class="form-label">Apellido paterno:</label> <br>
                        <input class="input" id="paternal_lastname" type="text" value="{{old('name', $people->paternal_lastname)}}" disabled>                    
                    </div>

                    <div class="col-sm-6">                                           
                        <label for="maternal_lastname" style="color: white" class="form-label">Apellido materno:</label> <br>
                        <input class="input" id="maternal_lastname" type="text" value="{{old('name', $people->maternal_lastname)}}" disabled>                    
                    </div>

                    <div class="col-sm-6">                                           
                        <label for="gender" style="color: white" class="form-label">Genero:</label> <br>
                        <input class="input" id="gender" type="text" value="{{old('name', $people->gender)}}" disabled>                  
                    </div>

                    <div class="col-sm-6">                                           
                        <label for="cellphone_number" style="color: white" class="form-label">Teléfono:</label> <br>
                        <input class="input" id="cellphone_number" type="text" value="{{old('name', $people->cellphone_number)}}" disabled>                    
                    </div>

                    <div class="col-sm-6">                                           
                        <label for="birthdate" style="color: white" class="form-label">Fecha de nacimiento:</label> <br>
                        <input class="input" id="birthdate" type="text" value="{{old('name', $people->birthdate)}}" disabled>                    
                    </div>
                </div>
                
                <button onclick="showEdit()" class="btn-accept" style="margin-top: 40px">Editar</button>

            </div>
        </div>
    </div>

    <div class="container py-4" id="edition-container" style="display: none;">
        <div class="pb-3 mb-4 title-person-form" style="display: flex; justify-content:space-between;">
            <span class="fs-4 subtitle-persons">&nbsp; &nbsp;Editar</span>
            <button type="button" onclick="hideEdition()" class="btn btn-dark btn-add-data" title="close section">               
                    <i style="color:#8CD2F0;" class="bi bi-x-lg"></i>
            </button>
        </div>
        <div style="background-color: #131718; display:flex" class="p-5 mb-4 rounded-3">
            <div class="container-fluid py-5">  
                <form action="{{route('personas.update', $people->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                        <div class="col-md-8 input-icon">
                            <input placeholder="Nombre" class="input" name="name" type="text" value="{{ old('name', $people->name) }}" >
                            <p  style="display:flex;justify-content:center;height: 30px; width:100%; flex-wrap:nowrap;">
                                @error('name') 
                                    <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                                @enderror
                            </p>
                        </div>  
                        
                        <div class="col-md-8 input-icon">
                            <input placeholder="Apellido paterno" class="input" name="paternal_lastname" type="text" value="{{ old('name', $people->paternal_lastname) }}">            
                            <p  style="display:flex;justify-content:center;height: 30px; width:100%; flex-wrap:nowrap; ">
                                @error('paternal_lastname') 
                                    <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                                @enderror
                            </p>
                        </div>  
                        
                        <div class="col-md-8 input-icon">
                            <input placeholder="Apellido materno" class="input" name="maternal_lastname" type="text" value="{{ old('name', $people->maternal_lastname) }}">            
                            <p  style="display:flex;justify-content:center;height: 30px; width:100%; flex-wrap:nowrap; ">
                                @error('maternal_lastname') 
                                    <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)red">{{ $message }}</div>
                                @enderror
                            </p>
                        </div>  
                        <div class="col-md-8 input-icon">
                            <div class="radio-container">
                                <div class="radio-wrapper">
                                    <label class="radio-button">
                                    <input id="male" name="gender" type="radio" value="Male" {{ old('gender', $people->gender) == 'Male' ? 'checked' : '' }}>
                                    <span class="radio-checkmark"></span>
                                    <span class="radio-label">Male</span>
                                    </label>
                                </div>

                                <div class="radio-wrapper">
                                    <label class="radio-button">
                                    <input id="female" name="gender" type="radio" value="Female" {{ old('gender', $people->gender) == 'Female' ? 'checked' : '' }}>
                                    <span class="radio-checkmark"></span>
                                    <span class="radio-label">Female</span>
                                    </label>
                                </div>

                                <div class="radio-wrapper">
                                    <label class="radio-button">
                                    <input id="other" name="gender" type="radio" value="Other" {{ old('gender', $people->gender) == 'Other' ? 'checked' : '' }}>
                                    <span class="radio-checkmark"></span>
                                    <span class="radio-label">Other</span>
                                    </label>
                                </div>
                            </div>                    
                        </div>

                        <div class="col-md-8 input-icon">
                            <input placeholder="Número de teléfono" class="input" name="cellphone_number" type="text" value="{{ old('cellphone_number', $people->cellphone_number) }}">            
                            <p  style="display:flex;justify-content:center;height: 30px; width:100%; flex-wrap:nowrap; ">
                                @error('cellphone_number') 
                                    <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                                @enderror
                            </p>
                        </div> 

                        <div class="col-md-8 input-icon">
                            <label for="birthdate" style="color: white;">Fecha de nacimiento</label>
                            <br>
                            <input type="date" id="birthdate" name="birthdate" class="input" value="{{ old('birthdate', $people->birthdate) }}">
                            <p  style="display:flex;justify-content:center;height: 30px; width:100%; flex-wrap:nowrap; ">
                                @error('birthdate') 
                                    <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                                @enderror
                            </p>
                        </div>

                        <button class="btn-accept">Update</button>
                    </form>
            </div>
        </div>
    </div>
</main>
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

    <script>
        function showEdit(){
            document.getElementById('edition-container').style.display = 'block';
        }

        function hideEdition(){
            document.getElementById('edition-container').style.display = 'none';
        }
    </script>
    
@endsection