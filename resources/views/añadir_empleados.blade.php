@extends('layout.sidebar')

@section('title', 'Añadir Empleado')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

@section('styles')
    <style>    
      
        
    </style>
@endsection


@section('content')
<main id="content-all">
    <div class="container py-4">
        <div class="pb-3 mb-4 title-user-form">
            &nbsp; &nbsp;<span class="fs-4 subtitle-user">Registro de empleado</span>
        </div>
        <div>
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="bi bi-search"></i>
            Buscar usuario
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title fs-5 input-group" style="margin-left: 10px" id="exampleModalLabel">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <div class="form-floating">                    
                                <input type="text" class="form-control" id="busqueda" placeholder="Buscar usuario">
                                <label for="floatingInputGroup1">Buscar usuario</label>
                            </div>
                        </div>    

                    <button type="button" class="btn btn-secondary" style="margin-left: 10px; background-color:#212529" data-bs-dismiss="modal">Cerrar</button>
                </div>
                <div class="modal-body">
                    <p style="color:black; margin-left:15px;">Selecciona un usuario</p>

                    <ul id="resultados" class="list-group" style="display: block;">
                            {{-- Aqui estaran los resultados de la busqueda, apareceran debajo de la barra de busqueda --}}
                    </ul>
                </div>
                <div class="modal-footer">
                </div>
                </div>
            </div>
            </div>
                                        
            
        </div>
        <br>

        <div style="background-color: #131718; display:flex" class="p-5 mb-4 rounded-3">
            <div class="container-fluid py-5">  
                    

                <br>
                <br>  

                <div class="col-md-8 input-icon">
                    <input placeholder="Nombre(s)" class="input" name="personal_name" type="text" disabled>            
                    <p class="text-danger" style="display:flex;justify-content:center;height: 30px; width:100%; flex-wrap:nowrap;">
                        @error('personal_name') 
                            <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                        @enderror
                    </p>
                </div>
                <div style="display: flex">

                </div>
                <div class="col-md-8 input-icon">
                    <input placeholder="Apellido paterno" class="input" name="lastname1" type="text" disabled>            
                    <p class="text-danger" style="display:flex;justify-content:center;height: 30px; width:100%; flex-wrap:nowrap;">
                        @error('lastname1') 
                            <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                        @enderror
                    </p>
                </div>

                <div class="col-md-8 input-icon">
                    <input placeholder="Apellido materno" class="input" name="lastname2" type="text" disabled>            
                    <p class="text-danger" style="display:flex;justify-content:center;height: 30px; width:100%; flex-wrap:nowrap;">
                        @error('lastname2') 
                            <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                        @enderror
                    </p>
                </div>

                <div class="col-md-8 input-icon">
                    <p style="color: rgb(255, 255, 255);">Sexo</p>
                    <div class="radio-container">
                        <div class="radio-wrapper">
                            <label class="radio-button">
                            <input id="male" name="gender" type="radio" value="male" disabled>
                            <span class="radio-checkmark"></span>
                            <span class="radio-label">Masculino</span>
                            </label>
                        </div>

                        <div class="radio-wrapper">
                            <label class="radio-button">
                            <input id="female" name="gender" type="radio" value="female" disabled>
                            <span class="radio-checkmark"></span>
                            <span class="radio-label">Femenino</span>
                            </label>
                        </div>

                        <div class="radio-wrapper">
                            <label class="radio-button">
                            <input id="other" name="gender" type="radio" value="other" disabled>
                            <span class="radio-checkmark"></span>
                            <span class="radio-label">Otro</span>
                            </label>
                        </div>
                    </div>                    
                </div>
                <br>

                <div class="col-md-8 input-icon">
                    <input placeholder="Número de teléfono" class="input" name="cellphone_number" type="text" disabled>            
                    <p  style="display:flex;justify-content:center;height: 30px; width:100%; flex-wrap:nowrap; ">
                        @error('cellphone_number') 
                            <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                        @enderror
                    </p>
                </div>

                <div class="col-md-8 input-icon">
                    <label for="birthdate" style="color: white;">Fecha de nacimiento</label>
                    <br>
                    <input style="color: rgb(255, 255, 255);" type="date" id="birthdate" name="birthdate" class="input" disabled>
                    <p  style="display:flex;justify-content:center;height: 30px; width:100%; flex-wrap:nowrap; ">
                        @error('birthdate') 
                            <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                        @enderror
                    </p>
                </div>
            </div>
        </div>
    </div>        
    <form id="employeeForm" action="{{ route('employee.store') }}" method="POST">
        @csrf
        
        <div class="container py-4">
                <div class="pb-3 mb-4 title-user-form">
                    &nbsp; &nbsp;<span class="fs-4 subtitle-user">Datos unicos de empleado</span>
                </div>                  
            <div style="background-color: #131718; display:flex" class="p-5 mb-4 rounded-3">
                <div class="container-fluid py-5">                

                    {{-- Datos para empleado --}}

                    <input type="hidden" name="people_id" value="{{ old('people_id') }}">

                    <div class="col-md-8 input-icon">
                        <input placeholder="CURP" class="input" name="curp" type="text" value="{{old('curp')}}">            
                        <p class="text-danger" style="display:flex;justify-content:center;height: 30px; width:100%; flex-wrap:nowrap;">
                            @error('curp') 
                                <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                            @enderror
                        </p>
                    </div>
                
                    <div class="col-md-8 input-icon">
                        <input placeholder="NSS" class="input" name="nss" type="text" value="{{old('nss')}}">            
                        <p class="text-danger" style="display:flex;justify-content:center;height: 30px; width:100%; flex-wrap:nowrap;">
                            @error('nss') 
                                <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                            @enderror
                        </p>
                    </div>

                    <div class="col-md-8 input-icon">
                        <input placeholder="RFC" class="input" name="rfc" type="text" value="{{old('rfc')}}">            
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
        // #busqueda es el elemento con esa id
    $('#busqueda').on('keyup', function() {
      
    const query = $(this).val();

        if(query.length >2) { 
        $.ajax({
          url: "{{ route('buscar.personas') }}",
          type: 'GET',
          data: { query: query },
          success: function(data) {
            $('#resultados').empty(); // empty resultados anteriores                    
                    if (data.usuarios.length === 0) {
                        $('#resultados').append('<p style="color:black;">No se encontraron usuarios.</p>');
                    } else {
                        data.usuarios.forEach(function(usuario){
                            // console.log(usuario); 

                            const personaId = usuario.people ? usuario.people.id : 'No disponible'; 
                            const persona = usuario.people; // Acceder a los datos de la persona

                            $('#resultados').append(`
                                <li style="cursor: pointer;" class="list-group-item seleccionable" data-id="${personaId}" data-name="${usuario.name}" data-email="${usuario.email}"
                                data-nombre="${persona.name}" 
                                data-paterno="${persona.paternal_lastname}"
                                data-materno="${persona.maternal_lastname}"
                                data-gender="${persona.gender}"
                                data-cell="${persona.cellphone_number}"
                                data-birth="${persona.birthdate}"   data-bs-dismiss="modal" title="Seleccionar usuario"  
                                >                            
                                <strong>${usuario.name}</strong> &nbsp; <em>${usuario.email}</em> 

                                </li>
                            `);
                        })
                    }

            // A cada dato seleccionado de la busqueda aqui se le asignara al input hidden
            $('.seleccionable').on('click', function(){
                const personaId = $(this).data('id');

                const nombre = $(this).data('nombre');
                const paternalLastname = $(this).data('paterno');
                const maternalLastname = $(this).data('materno');
                const gender = $(this).data('gender');
                const cell = $(this).data('cell');
                const birth = $(this).data('birth');


                $('input[name="people_id"]').val(personaId);
                $('input[name="personal_name"]').val(nombre);

                 $('input[name="personal_name"]').val(nombre);
                $('input[name="lastname1"]').val(paternalLastname);
                $('input[name="lastname2"]').val(maternalLastname);
                if (gender) {
                $(`input[name="gender"][value="${gender}"]`).prop('checked', true); // Marcar el género que el usuario tiene en personas
                }
                $('input[name="cellphone_number"]').val(cell);
                $('input[name="birthdate"]').val(birth);


                $('#resultados').empty();

            });

            
          },
          error: function() {
            $('#resultados').empty();
            $('#resultados').append('<p>Hubo un error en la búsqueda.</p>');
          }
        });
      } else {
        $('#resultados').empty(); // Limpiar cuando no haya caracteres necesarios
      }
    });
  });
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