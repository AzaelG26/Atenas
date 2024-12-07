@extends('layout.sidebar')    
@section('title', 'Ordenes')
<script src="/docs/5.3/assets/js/color-modes.js"></script>

@push('styles')
    <style>
    .title-orders{
        border-bottom: 1px solid #ce9d22;
    }
    .subtitle-orders{
        color: white;
    }
    .subtitle-orders:hover{
        color: #ce9d22;
        filter: drop-shadow(0px 0px 5px #ce9d22);
    }
    </style>
@endpush

@section('content')
    <main id="content-all">
        <div class="container py-4">

            <div class="container pb-3 mb-4 title-orders" style="display: flex; justify-content:space-between;flex-wrap:nowrap">
                <span class="fs-4 subtitle-orders"> &nbsp; &nbsp;Todas las ordenes</span>      

                <section style="display: flex; align-items:center;">
                <a href="{{route('orders.completed')}}" class="botones-rutas" style="text-decoration:none;">
                    <button type="button" title="Ver ordenes completadas" class="btn btn-warning">
                        Completadas 
                    </button>
                </a>
                &nbsp;
                <a href="{{route('orders.historial')}}" class="botones-rutas" style="text-decoration:none;" >
                    <button type="button" title="Ver ordenes completadas" class="btn btn-warning" style="display: flex;height:38px; flex-wrap:nowrap; align-items:center;">
                        <i class="bi bi-clock-history"></i> Historial
                    </button>
                </a>
                </section>

                <div class="alert alert-success alert-dismissible fade show" id="alert" role="alert" style="display: none; position: absolute; z-index:1;">
                    <strong id="alert-strong"></strong> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>                                
            </div>

            <div style="background-color: #131718; display:flex; justify-content:space-between; flex-wrap:wrap; height:auto" class="p-5 mb-4 rounded-3">                

                {{-- On line --}}
                @foreach($onlineOrder as $order)
                <div class="card" style="width: 18rem; height:22em; margin-bottom:10px;">
                    <h5 class="card-header" style="display: flex; justify-content:space-between;align-items:center">
                        De: {{ $order->people->name }}
                        <button type="button" style="width: 58px" title="Ver dirección" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $order->id_online_order }}">
                            <i class="bi bi-three-dots-vertical"></i><i class="bi bi-signpost-2"></i>
                        </button>
                    </h5>
                    <div class="card-body" style="overflow-y: auto;">
                       
                            <h5 class="card-title">
                            @if ($order->folio)                           
                                    <p>Folio: {{ $order->folio->identifier }}</p>
                            @else
                                    <p>No tiene folio asignado</p>
                            @endif
                                    <p>Fecha: {{ $order->created_at }}</p>
                                    <p>Estado: {{$order->status}}</p>
                            </h5>


                        @foreach($order->onlineOrderDetails as $detail)                    
                            @if($detail->menu)
                            <p class="card-text">
                                Producto: {{ $detail->menu->name }} <br>
                                Cantidad: {{ $detail->quantity }}.</p>
                                <hr>
                            @else
                                <p>No se encontró el producto para este detalle.</p>
                                <hr>
                            @endif
                        @endforeach
                        
                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop{{ $order->id_online_order }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel{{ $order->id_online_order }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel{{ $order->id_online_order }}">Direccion</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Colonia: {{$order->address->street}}
                                <br>
                                Calle: {{$order->address->neighborhood->name}}
                                <br>
                                Referencia: {{$order->address->reference}}
                                <br>
                                Número interior: {{$order->address->interior_number}}
                                <br>
                                Número Exterior: {{$order->address->outer_number}}                               
                            </div>
                            {{-- <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                            </div> --}}
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="card-footer" style="display: flex; justify-content:space-around;">                    
                        <form action="{{ route('orders.updateLine', $order->id_online_order) }}" method="POST" style="width: 30%">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status"  value="Canceled">
                            <button onclick="return confirm('¿Estás seguro de que deseas eliminar esta orden?')" class="btn btn-danger" style="display:flex; justify-content:center; align-items:center; width: 100%; height:40px; background-color:red; color:white;border:1px solid red;" title="Cancelar orden">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                        <form action="{{route('orders.updateLine', $order->id_online_order)}}" method="POST" style="width: 30%">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="In Process">
                            <button onclick="return confirm('Confirma para atender esta orden')" class="btn btn-success" style="display:flex; justify-content:center; align-items:center; width: 100%; height:40px;" title="Atender esta orden">
                                <i class="bi bi-check2-circle"></i>
                            </button>
                        </form>

                        <form action="{{route('orders.updateLine', $order->id_online_order)}}" method="POST" style="width: 30%">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="Completed">
                            <button onclick="return confirm('Confirma para completar esta orden')" class="btn btn-dark" style="display:flex; justify-content:center; align-items:center; width: 100%; height:40px" title="Marcar como completada">
                                <i class="bi bi-check2-square"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach


                {{-- Físicas --}}
                @foreach($orders as $orden)
                    <div class="card" style="width: 18rem; height:22em;margin-bottom:10px">
                        <h5 class="card-header" style="display: flex; justify-content:space-between;align-items:center">
                            De: {{ $orden->diner_name }}
                        </h5>
                        <div class="card-body" style="overflow-y: auto;">                    
                                <h5 class="card-title">                                
                                    @if($orden->folio)
                                        <p>Folio: {{ $orden->folio->identifier }}</p>
                                    @else
                                        <p>No tiene folio asignado</p>
                                    @endif
                                        <p>Fecha: {{ $orden->created_at }}</p>
                                        <p>Estado: {{$orden->status}}</p>
                                        <hr>
                                </h5>
                        

                            @foreach($orden->OrderDetail as $detail)                    
                                @if($detail->menu)
                                <p class="card-text">
                                    Producto: {{ $detail->menu->name }} <br>
                                    Cantidad: {{ $detail->quantity }}.</p>
                                    <hr>
                                @else
                                    <p>No se encontró el producto para este detalle.</p>
                                    <hr>
                                @endif
                            @endforeach                    
                        </div>
                        <div class="card-footer" style="display: flex; justify-content:space-around;">                                                                    
                            
                            <form action="{{ route('orders.updateFisicas', $orden->id_order) }}" method="POST" style="width: 30%">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status"  value="Canceled">
                                <button onclick="return confirm('¿Estás seguro de que deseas eliminar esta orden?')" class="btn btn-danger" style="display:flex; justify-content:center; align-items:center; width: 100%; height:40px; background-color:red; color:white;border:1px solid red;" title="Cancelar orden">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                            <form action="{{route('orders.updateFisicas', $orden->id_order)}}" method="POST" style="width: 30%">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="In Process">
                                <button onclick="return confirm('Confirma para atender esta orden')" class="btn btn-success" style="display:flex; justify-content:center; align-items:center; width: 100%; height:40px;" title="Atender esta orden">
                                    <i class="bi bi-check2-circle"></i>
                                </button>
                            </form>

                            <form action="{{route('orders.updateFisicas', $orden->id_order)}}" method="POST" style="width: 30%">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="Completed">
                                <button onclick="return confirm('Confirma para completar esta orden')" class="btn btn-dark" style="display:flex; justify-content:center; align-items:center; width: 100%; height:40px" title="Marcar como completada">
                                    <i class="bi bi-check2-square"></i>
                                </button>
                            </form>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>    
            

        @if (session('success')) 
            <script>
                // Mostrar la alerta
                const alert = document.getElementById('alert');
                const alertStrong = document.getElementById('alert-strong');
                const successMessage = '{{ session('success') }}';

                // const btnesRutas = document.getElementByClassName('botones-rutas');

                if (successMessage) {
                    alertStrong.innerText = 'Alerta! ' + successMessage ;  // Muestra el mensaje de éxito
                    alert.style.display = 'block';  // Muestra la alerta en la página
                    
                    // Si el navegador soporta notificaciones
                    if ("Notification" in window) {
                        // Pedir permiso para mostrar notificaciones si no se ha concedido aún
                        if (Notification.permission !== "granted") {
                            Notification.requestPermission();
                        }

                        // Crear y mostrar la notificación si el permiso es concedido
                        if (Notification.permission === "granted") {
                            const notification = new Notification("Alerta", {
                                body: successMessage,  // El contenido del mensaje
                                icon: "/path/to/icon.png",  // Una imagen opcional para la notificación
                            });

                            // Reproducir un sonido cuando se haga clic en la notificación
                            const audio = new Audio('/path/to/success-sound.mp3');
                            notification.onclick = function() {
                                audio.play();  // Reproduce el sonido cuando el usuario haga clic
                            };
                        }
                    }
                }
            </script>
        @endif

        
@endsection

