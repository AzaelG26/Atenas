@extends('layout.sidebar')

@section('title', 'Añadir Empleado')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

@section('styles')
    <style>
        
    </style>
@endsection


@section('content')
<main id="content-all">

    <form id="employeeForm" action="{{ route('employee.store') }}" method="POST">
        @csrf
    <div class="container py-4">
        <div class="pb-3 mb-4 title-user-form">
            &nbsp; &nbsp;<span class="fs-4 subtitle-user">Registro de empleado</span>
        </div>

        <div style="background-color: #131718; display:flex" class="p-5 mb-4 rounded-3">
            <div class="container-fluid py-5">  
                <h3>Buscar Persona</h3>  
                    <input class="form-control me-2" id="busqueda" type="search" placeholder="Buscar" aria-label="Search">
                    <ul id="resultados" class="list-group">

                    </ul>

                <br>
                <br>                    

                <div class="col-md-8 input-icon">
                    <input placeholder="Nombre(s)" class="input" name="personal_name" type="text">            
                    <p class="text-danger" style="display:flex;justify-content:center;height: 30px; width:100%; flex-wrap:nowrap;">
                        @error('personal_name') 
                            <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                        @enderror
                    </p>
                </div>

                <div class="col-md-8 input-icon">
                    <input placeholder="Apellido paterno" class="input" name="lastname1" type="text">            
                    <p class="text-danger" style="display:flex;justify-content:center;height: 30px; width:100%; flex-wrap:nowrap;">
                        @error('lastname1') 
                            <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                        @enderror
                    </p>
                </div>

                <div class="col-md-8 input-icon">
                    <input placeholder="Apellido materno" class="input" name="lastname2" type="text">            
                    <p class="text-danger" style="display:flex;justify-content:center;height: 30px; width:100%; flex-wrap:nowrap;">
                        @error('lastname2') 
                            <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                        @enderror
                    </p>
                </div>

                <div class="col-md-8 input-icon">
                    <p style="color: rgb(107, 107, 107);">sexo</p>
                    <div class="radio-container">
                        <div class="radio-wrapper">
                            <label class="radio-button">
                            <input id="male" name="gender" type="radio" value="Male">
                            <span class="radio-checkmark"></span>
                            <span class="radio-label">Masculino</span>
                            </label>
                        </div>

                        <div class="radio-wrapper">
                            <label class="radio-button">
                            <input id="female" name="gender" type="radio" value="Female">
                            <span class="radio-checkmark"></span>
                            <span class="radio-label">Femenino</span>
                            </label>
                        </div>

                        <div class="radio-wrapper">
                            <label class="radio-button">
                            <input id="other" name="gender" type="radio" value="Other">
                            <span class="radio-checkmark"></span>
                            <span class="radio-label">Otro</span>
                            </label>
                        </div>
                    </div>                    
                </div>
                <br>

                <div class="col-md-8 input-icon">
                    <input placeholder="Número de teléfono" class="input" name="cellphone_number" type="text">            
                    <p  style="display:flex;justify-content:center;height: 30px; width:100%; flex-wrap:nowrap; ">
                        @error('cellphone_number') 
                            <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                        @enderror
                    </p>
                </div>

                <div class="col-md-8 input-icon">
                    <label for="birthdate" style="color: white;">Fecha de nacimiento</label>
                    <br>
                    <input style="color: rgb(107, 107, 107);" type="date" id="birthdate" name="birthdate" class="input">
                    <p  style="display:flex;justify-content:center;height: 30px; width:100%; flex-wrap:nowrap; ">
                        @error('birthdate') 
                            <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                        @enderror
                    </p>
                </div>
            </div>
        </div>
    </div>        

    <div class="container py-4">
        <div style="background-color: #131718; display:flex" class="p-5 mb-4 rounded-3">
            <div class="container-fluid py-5">                

                {{-- Datos para empleado --}}
                <div class="col-md-8 input-icon">
                    <input placeholder="CURP" class="input" name="curp" type="text">            
                    <p class="text-danger" style="display:flex;justify-content:center;height: 30px; width:100%; flex-wrap:nowrap;">
                        @error('curp') 
                            <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                        @enderror
                    </p>
                </div>
            
                <div class="col-md-8 input-icon">
                    <input placeholder="NSS" class="input" name="nss" type="text">            
                    <p class="text-danger" style="display:flex;justify-content:center;height: 30px; width:100%; flex-wrap:nowrap;">
                        @error('nss') 
                            <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                        @enderror
                    </p>
                </div>

                <div class="col-md-8 input-icon">
                    <input placeholder="RFC" class="input" name="rfc" type="text">            
                    <p class="text-danger" style="display:flex;justify-content:center;height: 30px; width:100%; flex-wrap:nowrap;">
                        @error('rfc') 
                            <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                        @enderror
                    </p>
                </div>
                <div class="col-md-8 input-icon">
                    <label for="admin" style="color: white">¿Es administrador?</label> <br>
                    <select class="input" id="admin" name="admin" required>
                        <option value="" selected disabled></option>
                        <option value="1">Sí</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <br>

                <button  type="submit" class="btn-accept">Aceptar</button>  
            </div>
        </div>
    </div>
    </form>
  
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
    $('#busqueda').on('keyup', function() {
      
        const query = $(this).val();
      // Hacer la solicitud AJAX
      if(query.length >=1) { // Inicia la búsqueda después de 3 caracteres
        $.ajax({
          url: "{{ route('buscar.personas') }}",
          type: 'GET',
          data: { query: query },
          success: function(data) {
            $('#resultados').empty(); // Limpiar resultados anteriores

            if (data.length === 0) {
              $('#resultados').append('<p>No se encontraron personas.</p>');
            } else {
              data.forEach(persona => {
                $('#resultados').append(`
                  <li class="list-group-item">
                    ${persona.name} ${persona.paternal_lastname} ${persona.maternal_lastname}
                  </li>
                `);
              });
            }
          },
          error: function() {
            $('#resultados').empty();
            $('#resultados').append('<p>Hubo un error en la búsqueda.</p>');
          }
        });
      } else {
        $('#resultados').empty(); // Limpiar cuando hay menos de 3 caracteres
      }
    });
  });


</script>



@endsection