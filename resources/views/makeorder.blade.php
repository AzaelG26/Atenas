@extends('layout.sidebar')    
@section('title', 'Realizar una orden')
    <script src="/docs/5.3/assets/js/color-modes.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@push('styles')
    <style>
        .title-register-orden{
            border-bottom: 1px solid #ce9d22;
        }
        .subtitle-register-orden{
            color: white;
        }
        .subtitle-register-orden:hover{
            color: #ce9d22;
            filter: drop-shadow(0px 0px 5px #ce9d22);
        }

        .btn-sections{
            transition: all 0.1s ease;
            color: white;
            background-color: #131718;
            
        }
        .btn-sections:hover{
            color:#be952c;
            background-color: #212529;
            border:1px solid #212529 !important;

        }
        .nav-link.active{
            background-color: #212529 !important;
            color: #be952c !important;
            border:1px solid #212529 !important;

        }
       

        /* estilos Checkbox para seleccionar platillos*/
        .material-checkbox {
        display: flex;
        align-items: center;
        font-size: 16px;
        color: #000000;
        cursor: pointer;
        }

        .material-checkbox input[type="checkbox"] {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
        }

        .checkmark {
        position: relative;
        display: inline-block;
        width: 20px;
        height: 20px;
        margin-right: 12px;
        border: 2px solid #004b47;
        border-radius: 4px;
        transition: all 0.3s;
        }

        .material-checkbox input[type="checkbox"]:checked ~ .checkmark {
        background-color: #001433;
        border-color: #002f4b;
        }

        .material-checkbox input[type="checkbox"]:checked ~ .checkmark:after {
        content: "";
        position: absolute;
        top: 2px;
        left: 6px;
        width: 4px;
        height: 10px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
        }

        .material-checkbox input[type="checkbox"]:focus ~ .checkmark {
        box-shadow: 0 0 0 2px #dfec5065;
        }

        .material-checkbox:hover input[type="checkbox"] ~ .checkmark {
        border-color: #00657e;
        }

        .material-checkbox input[type="checkbox"]:disabled ~ .checkmark {
        opacity: 0.5;
        cursor: not-allowed;
        }

        .material-checkbox input[type="checkbox"]:disabled ~ .checkmark:hover {
        border-color: #4d4d4d;
        }

        .menu-items{
            transition: all 0.4s ease;
            color: black !important;
            background-color:#ffffff !important; 
            box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.705);
        }
        .menu-items:hover{
            transform: scale(1.02);
        }
        .form-control, .list-group-item{
            background-color:#ffffff !important; 
            color: rgb(0, 0, 0) !important;
        }

    </style>
@endpush

@section('content')
    <div class=" py-4" style="width: 100vw; display:flex; flex-direction:column; align-items:center;">
        <div class="pb-3 mb-4 title-register-orden" style="display: flex; justify-content:space-between; width:90vw">
            <span class="fs-4 subtitle-register-orden">&nbsp; &nbsp;Registrar nuevas ordenes</span>             
        </div>

        <div>
            <form method="POST" action="{{route('makeOrders')}}">
                @csrf                
                <div style="display: flex; flex-wrap:wrap; justify-content:center;">
                    <div class="card text-center" style="width: 95vw; border:none">
                        

                            <div class="card-header" style="background-color: #131718;">
                                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist" style="display:flex; justify-content:space-between; flex-wrap:nowrap">
                                    {{-- El " data-bs-toggle="tab" " es para cambiar de vistas --}}
                                    <section style="display: flex">
                                        <li>
                                            <a class="nav-link active order btn-sections"  id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" onclick="ocultarSeleccionPlatillo()">Orden</a>
                                        </li>
                                        <li>
                                            <a class="nav-link btn-sections" id="menu-tab" data-bs-toggle="tab" href="#menu" role="tab" aria-controls="menu" aria-selected="false" onclick="ocultarSeleccionPlatillo()">Seleccionar platillos</a>
                                        </li>     
                                    </section>
                                    <section>
                                        <li>
                                            <button id="btn-enviar" type="submit" class="btn btn-primary">Registrar</button>                                
                                        </li> 
                                    </section>                                   
                                </ul>
                            </div>
                            <div class="card-body" style="background-color: #212529;">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <h5 class="card-title">Ingresa los datos para levantar la orden</h5>
                                        <br>
                                        <div class="mb-3">
                                            <label for="diner_name" style="width:100%; text-align: start; color:rgb(255, 255, 255);" class="form-label">Nombre del cliente</label>
                                            <input type="text" style="background: #212121; color:black !important;" id="diner_name" name="diner_name" class="form-control" required>
                                            @error('diner_name')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>                        
                                        <button type="button" id="btn-siguiente"  class="btn btn-primary"> siguiente<i class="bi bi-arrow-right"></i></button>
                                    </div>
                                    
                                    <div class="tab-pane fade" id="menu" role="tabpanel" aria-labelledby="menu-tab" style="display: flex; flex-wrap:wrap; justify-content:center">
                                        @foreach ($menuItems as $menu)                                        
                                        <div class="card menu-items" style="width: 18rem; margin:20px;">
                                            {{-- <img src="..." class="card-img-top" alt="..."> --}}
                                            <div class="card-body"> 
                                            
                                                <h5 class="card-title">{{$menu->name}}</h5>
                                                <p class="card-text">Categoria: {{$menu->category->name}}</p>
                                                <p class="card-text">{{$menu->description}}.</p>
                                                <p class="card-text">${{$menu->price}}.</p>
                                                @if ($menu->status == true)
                                                    <p>Disponible</p>
                                                @else
                                                    <p>No Disponible</p>
                                                @endif
                                            </div>
                                            <ul class="list-group list-group-flush">                                    
                                                <input type="text" hidden class="editable-field" name="menu_items[{{ $loop->index }}][id_menu]" value="{{$menu->id_menu}}" disabled>

                                                <li class="list-group-item">
                                                    <input class="form-control editable-field" type="number" name="menu_items[{{ $loop->index }}][quantity]" placeholder="Cantidad" required disabled>                
                                                    @error('menu_items.' . $loop->index . '.quantity')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="mb-3">
                                                        <input class="form-control editable-field" type="text" name="menu_items[{{ $loop->index }}][notes]" placeholder="Notas" disabled>
                                                        @error('menu_items.' . $loop->index . '.notes')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror

                                                        <br>
                                                        <textarea class="form-control editable-field" id="exampleFormControlTextarea1" rows="2" name="menu_items[{{ $loop->index }}][specifications]" placeholder="Especificaciones" disabled></textarea>
                                                        @error('menu_items.' . $loop->index . '.specifications')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror

                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="card-body">
                                                <label class="material-checkbox">
                                                    <input type="checkbox" class="enable-edit">
                                                    <span class="checkmark"></span>
                                                    Seleccionar
                                                </label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                    </div>        
                </div> 
            </form>                    
        </div>
    </div>
    

    <script>
        let menuElement = document.getElementById('menu');
        let btnEnviar = document.getElementById('btn-enviar')

        menu.style.display = 'none'
        btnEnviar.style.display = 'none'
        function ocultarSeleccionPlatillo() {
            if (menuElement.style.display === 'none') {
                menuElement.style.display = 'flex';
                btnEnviar.style.display = 'block'

            } else if(menuElement.style.display === 'flex') {
                menuElement.style.display = 'none';
                btnEnviar.style.display = 'none'

            }
        }




        const checkboxes = document.querySelectorAll('.enable-edit');

        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', (event) => {
                const card = event.target.closest('.card'); // Encuentra la tarjeta contenedora
                const fields = card.querySelectorAll('.editable-field'); // Busca los campos editables
                
                if (checkbox.checked) {
                    fields.forEach(field => field.removeAttribute('disabled')); // Habilita campos
                } else {
                    fields.forEach(field => field.setAttribute('disabled', true)); // Deshabilita campos
                }
            });
        });



        // Seleccionar el botón "Siguiente" y las pestañas
    const btnSiguiente = document.getElementById('btn-siguiente');
    const homeTab = document.querySelector('#home-tab');
    const menuTab = document.querySelector('#menu-tab');

    // Evento para cambiar a la siguiente pestaña
    btnSiguiente.addEventListener('click', () => {
        // Desactivar la pestaña actual y activar la siguiente
        homeTab.classList.remove('active');
        homeTab.setAttribute('aria-selected', 'false');
        document.querySelector('#home').classList.remove('show', 'active');

        menuTab.classList.add('active');
        menuTab.setAttribute('aria-selected', 'true');
        document.querySelector('#menu').classList.add('show', 'active');


        menuElement.style.display = 'flex';
        btnEnviar.style.display = 'block'
    })
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