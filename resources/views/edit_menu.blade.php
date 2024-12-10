@extends('layout.g_base')

@section('title', 'edicion menu')
    <script nomodule src="https://cdn.jsdelivr.net/npm/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

@section('styles')
<style>
        .subtitle-edit-menu{
            color: white;
            margin-left: 20px;
        }
        .subtitle-edit-menu:hover{
            color: #ce9d22;
            filter: drop-shadow(0px 0px 5px #ce9d22);
        }
        .table .head{
            color: white;
            background-color: rgb(22, 22, 22);
        }
        .table tbody tr td:hover{
            background-color: #131718;
        }
        .title-user-form{
            border-bottom: 1px solid #ce9d22;
        }
        .categoria{
            border-bottom: 1px solid #ce9d22;
        }
        .container-fluid {
            max-width: 100%;
            width: auto;
            height: auto;
        }

        .table-container {
            overflow-y: auto;
        }
        
        @media ( max-width: 576px ){
            .btn span{
                display: none;
            }
        }
        @media(max-width:384px){
            .subtitle-edit-menu{
                margin-left: 0px;
            }
        }
        
</style>
@push('styles')

@endsection

@section('content')
    <main id="content-all">
        <div class="container-fluid py-3">
            <div class="pb-3 mb-4 title-user-form" style="color: white; display: flex; justify-content:space-between; width:100%;">
                <span class="fs-4 subtitle-edit-menu">Edición de datos de menú</span>
             
                <div style="display: flex; flex-wrap:nowrap;">
                    <a href="{{route('menu')}}" style="text-decoration: none; color:black">
                        <button type="button" class="btn btn-warning" title="Regresar">
                                <i class="bi bi-arrow-return-left"></i> <span>Atrás </span>
                        </button>
                    </a>
                    <button type="button" class="btn btn-warning" title="Agregar nuevo producto" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <i class="bi bi-plus-circle-dotted"></i> <span>Nuevo</span>
                    </button>
                </div>
            </div>

            <!-- Modal-->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                  
                    <div class="modal-dialog">
                        <form action="{{route('menu.create')}}" method="POST">
                        @csrf  
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Registro nuevo platillo</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label for="categoria">Categoría:</label>
                                <select class="mb-3 form-select" name="id_category" id="categoria" aria-label="Default select example" required>                           
                                    <option disabled selected>Selecciona una categoria</option>
                                    @foreach ($showCategories as $categoria)
                                    <option value="{{$categoria->id_category}}">{{$categoria->name}}  </option>                           
                                    @endforeach
                                </select>
                                @error('id_category')
                                    <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                                @enderror

                                <div class="mb-3">
                                    <label for="name" class="form-label">Nombre del platillo</label>
                                    <input type="text" name="name" id="name" class="form-control input-text" onkeypress="return evitarNumeros(event)" placeholder="Ingresa el nombre del platillo" required>
                                    @error('name')
                                        <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Descripción</label>
                                    <input type="text" name="description" id="description" class="form-control input-text" onkeypress="return evitarNumeros(event)" placeholder="Descripción" required>
                                    @error('description')
                                        <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="price" class="form-label">Precio</label>
                                    <input type="number" name="price" id="price" class="form-control input-price" onkeypress="return soloNumeros(event)" placeholder="Precio unitario" required>
                                    @error('price')
                                        <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="stock" class="form-label">Stock</label>
                                    <input type="number" name="stock" id="stock" class="form-control input-stock" onkeypress="return soloNumeros(event)" placeholder="Stock" required>
                                    @error('stock')
                                        <div class="text-red-500 text-sm" style="color:rgba(255, 0, 0, 0.788)">{{ $message }}</div>
                                    @enderror
                                </div>
                                                            
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-outline-success">Guardar</button>
                            </div>
                        </div>
                        </form>
                    </div>                
            </div>

            <!-- Formulario para editar datos del perfil -->
            <div style="background-color: #131718; display:flex; justify-content:center" class="p-10 mb-4 rounded-3">
                <div class="container py-3">
                    @foreach ($categorias as $category)
                    
                    <div class="pb-3 mb-4 categoria">
                        &nbsp; &nbsp;<span class="fs-4 subtitle-edit-menu">{{$category->name}}</span>
                    </div>
                    <div class="table-container">                    
                        <table class="table table-bordered border-dark">
                            <thead style="border: 1px solid gray;">
                                <tr>
                                    <th class="head">Platillo</th>
                                    <th class="head">Descripción</th>
                                    <th class="head">Precio</th>
                                    <th class="head">Stock</th>
                                    <th class="head">Activo</th>
                                    <th class="head">Fijár</th>
                                </tr>
                            </thead>
                            <tbody class="table-dark">
                                @foreach ($category->menu as $menuDetalles)
                                
                                <form action="{{route('menu.update', $menuDetalles->id_menu)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <tr>
                                        <td>
                                            <textarea type="text" name="name" class="form-control input-text" required onkeypress="return evitarNumeros(event)"> {{ $menuDetalles->name }}</textarea>
                                        </td>
                                        <td>
                                            <textarea name="description" class="form-control input-text" required onkeypress="return evitarNumeros(event)">{{ $menuDetalles->description }}</textarea>
                                        </td>
                                        <td>
                                            <textarea type="number" name="price" class="form-control input-price" required onkeypress="return soloNumeros(event)">{{ $menuDetalles->price }}</textarea>
                                        </td>
                                        <td>
                                            <textarea type="number" name="stock" class="form-control input-stock" required onkeypress="return soloNumeros(event)">{{ $menuDetalles->stock->stock }}</textarea>
                                        </td>
                                        <td>
                                            <input type="checkbox" name="status" value="1"  {{ $menuDetalles->status ? 'checked' : '' }}>
                                        </td>
                                        <td style="text-align: center;">
                                            <button type="submit" title="Actualizar datos" class="btn btn-warning"><i class="bi bi-check2-square"></i></button>
                                        </td>                           
                                    </tr>
                                </form>
                                @endforeach
                            </tbody>
                        </table>
                    </div>                        
                    @endforeach
                </div>
            </div>
        </div>
    </main>
    
    <script>
        function evitarNumeros(event){
            const charCode = event.charCode || event.keyCode;
            const charStr = String.fromCharCode(charCode);

            if(/[0-9]/.test(charStr)){
                return false;
            }
            return true;
        }

        function soloNumeros(event){
            const charCode = event.charCode || event.keyCode;
            const charStr = String.fromCharCode(charCode);

            if(!/[0-9]/.test(charStr)){
                return false;
            }
            return true;
        }
    </script>

    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Añadido!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            });
        </script>
    @endif
    
@endsection