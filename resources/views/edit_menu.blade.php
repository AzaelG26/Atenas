@extends('layout.g_base')

@section('title', 'edicion menu')
    <script nomodule src="https://cdn.jsdelivr.net/npm/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

@section('styles')
<style>
        .subtitle-edit-menu{
            color: white;
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
    
</style>
@push('styles')

@endsection

@section('content')
    <main id="content-all">
        <div class="container-fluid py-3">
            <div class="pb-3 mb-4 title-user-form" style="color: white; display: flex; justify-content:space-between;">
                <span class="fs-4 subtitle-edit-menu">&nbsp;&nbsp; Edición de datos de menú</span>
             
                <a href="{{route('menu')}}" style="text-decoration: none; color:black">
                    <button type="button" class="btn btn-warning" title="Regresar" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="bi bi-arrow-return-left"></i> Atrás    
                    </button>
                </a>
            </div>

            <!-- Formulario para editar datos del perfil -->
            <div style="background-color: #131718; display:flex" class="p-5 mb-4 rounded-3">
                <div class="container-fluid py-3">
                    @foreach ($categorias as $category)
                    
                    <div class="pb-3 mb-4 categoria">
                        &nbsp; &nbsp;<span class="fs-4 subtitle-edit-menu">{{$category->name}}</span>
                    </div>
                    <table class="table table-bordered border-dark">
                        <thead style="border: 1px solid gray;">
                            <tr>
                                <th class="head">Platillo</th>
                                <th class="head">Descripción</th>
                                <th class="head">Precio</th>
                                <th class="head">Stock</th>
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
                                        <textarea type="text" name="name" class="form-control" required> {{ $menuDetalles->name }}</textarea>
                                    </td>
                                    <td>
                                        <textarea name="description" class="form-control" required>{{ $menuDetalles->description }}</textarea>
                                    </td>
                                    <td>
                                        <textarea type="number" name="price" class="form-control" required>{{ $menuDetalles->price }}</textarea>
                                    </td>
                                    <td>
                                        <textarea type="number" name="stock" class="form-control" required>{{ $menuDetalles->stock->stock }}</textarea>
                                    </td>
                                    <td style="text-align: center">
                                        <button type="submit" title="Actualizar datos" class="btn btn-warning"><i class="bi bi-upload"></i></button>
                                    </td>                           
                                </tr>
                            </form>
                            @endforeach
                        </tbody>


                    </table>
                        
                    @endforeach
                </div>
            </div>
        </div>
    </main>
   
@endsection