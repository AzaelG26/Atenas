@extends('layout.sidebar')    
@section('title', 'Ordenes completadas')
    {{-- ICONO DEL NEGOCIO --}}
<link rel="icon" href="LOGO_ATENAS_high_quality_transparent.png">

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

            <div class="pb-3 mb-4 title-orders" style="display: flex; justify-content:space-between;">
                <span class="fs-4 subtitle-orders"> &nbsp; &nbsp;Ordenes completadas</span>      

                <a href="{{route('orders')}}" style="text-decoration:none;">
                    <button type="button" title="Regresar a ordenes" class="btn btn-warning" >
                        <i class="bi bi-box-arrow-left"></i> Regresar
                    </button>  
                </a>

            </div>
            <div style="background-color: #131718; display:flex; justify-content:space-between; flex-wrap:wrap; height:auto" class="p-5 mb-4 rounded-3">                


                @foreach ($onlineCompleted as $ordenes)
                <div class="card" style="width: 18rem; height:22em; margin-bottom:10px;">
                    <h5 class="card-header" style="display: flex; justify-content:space-between;align-items:center">
                        De: {{ $ordenes->people->name }} 
                        <button type="button" style="width: 58px" title="Ver dirección" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <i class="bi bi-three-dots-vertical"></i><i class="bi bi-signpost-2"></i>
                        </button>                       
                    </h5>
                    <div class="card-body" style="overflow-y: auto;">                    
                        <h5 class="card-title">
                        
                            @if($ordenes->folio)
                                <p>Folio: {{ $ordenes->folio->identifier }}</p>
                            @else
                                <p>No tiene folio asignado</p>
                            @endif
                                <p>Fecha: {{ $ordenes->created_at }}</p>
                                <p>Estado: {{$ordenes->status}}</p>
                                <hr>
                        </h5>        
                        @foreach($ordenes->onlineOrderDetails as $detail)                    
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
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Direccion</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Colonia: {{$ordenes->address->street}}
                                        <br>
                                        Calle: {{$ordenes->address->neighborhood->name}}
                                        <br>
                                        Referencia: {{$ordenes->address->reference}}
                                        <br>
                                        Número interior: {{$ordenes->address->interior_number}}
                                        <br>
                                        Número Exterior: {{$ordenes->address->outer_numbe}} 
                                        <br>                              
                                    </div>                             
                                </div>
                            </div>
                        </div>                   
                    </div>
                </div>
                @endforeach


                @foreach ($localCompleted as $orden)
                <div class="card" style="width: 18rem; height:22em; margin-bottom:10px;">
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
                </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection