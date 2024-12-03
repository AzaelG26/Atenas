@extends('layout.sidebar')    
@section('title', 'Historial de ventas')
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
    .table .head{
        color: white;
        background-color: rgb(22, 22, 22);
    }
    .table tbody tr td:hover{
        background-color: #131718;
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

    </style>
@endpush

@section('content')
    <main id="content-all">
        <div class="container py-4">

            <div class="pb-3 mb-4 title-orders" style="display: flex; justify-content:space-between;">
                <span class="fs-4 subtitle-orders"> &nbsp; &nbsp;<i class="bi bi-clock-history"></i> Historial de ventas</span>      
            </div>
            <div>
                <div style="display: flex; flex-wrap:wrap; justify-content:center;">
                    <div class="card text-center" style="width: 95vw; border:none">                        

                            <div class="card-header" style="background-color: #131718;">
                                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist" style="display:flex; justify-content:space-between; flex-wrap:nowrap">
                                    {{-- El " data-bs-toggle="tab" " es para cambiar de vistas --}}
                                    <section style="display: flex">
                                        <li>
                                            <a class="nav-link active order btn-sections"  id="home-tab" data-bs-toggle="tab" href="#line" role="tab" aria-controls="home" aria-selected="true" onclick="ocultarSeleccionPlatillo()">Ordenes en línea</a>
                                        </li>
                                        <li>
                                            <a class="nav-link btn-sections" id="menu-tab" data-bs-toggle="tab" href="#fisico" role="tab" aria-controls="menu" aria-selected="false" onclick="ocultarSeleccionPlatillo()">Ordenes en físico</a>
                                        </li>     
                                    </section>                                                                    
                                </ul>
                            </div>
                            <div class="card-body" style="background-color: #212529;">
                                <div class="tab-content" id="myTabContent">

                                    <div class="tab-pane fade show active" id="line" role="tabpanel" aria-labelledby="home-tab">
                                        <table class="table table-bordered border-dark">
                                            <thead style="border: 1px solid gray;">
                                                <tr>
                                                    <th class="head">
                                                        Cliente
                                                    </th>
                                                    <th class="head">
                                                        Platillos consumidos
                                                    </th>
                                                    <th class="head">
                                                        Precio Total
                                                    </th>
                                                    <th class="head">
                                                        Estado de la compra
                                                    </th>
                                                    <th class="head">
                                                        Fecha de orden
                                                    </th>
                                                </tr>
                                            </thead>
                                            @foreach($lineHistorialOrders as $line)                                                        
                                            <tbody class="table-dark">
                                                <tr>
                                                    <td>
                                                        {{$line->people->fullname}}
                                                    </td>
                                                    <td>
                                                        {{$line->product_names}}
                                                    </td>
                                                    <td>
                                                        {{$line->total_price}}
                                                    </td>
                                                    <td>
                                                        {{$line->status}}
                                                    </td>
                                                    <td>
                                                        {{$line->created_at}}
                                                    </td>
                                                </tr>
                                            </tbody>
                                            @endforeach

                                        </table>
                                    </div>

                                    <div class="tab-pane fade" id="fisico" role="tabpanel" aria-labelledby="menu-tab" style="display: flex; flex-wrap:wrap; justify-content:center">

                                        <table class="table table-bordered border-dark">
                                            
                                            <thead style="border: 1px solid gray;">
                                                <tr>
                                                    <th class="head">
                                                        Cliente
                                                    </th>
                                                    <th class="head">
                                                        Platillos consumidos
                                                    </th>
                                                    <th class="head">
                                                        Precio total
                                                    </th>
                                                </tr>
                                            </thead>
                                            @foreach ($localHistorialOrders as $local)

                                            <tbody class="table-dark">
                                                <tr>
                                                        
                                                    <td>
                                                        {{$local->diner_name}}
                                                    </td>
                                                    <td>
                                                        {{$local->product_names}}
                                                    </td>
                                                    <td>
                                                        {{$local->total_price}}
                                                    </td>
                                                </tr>
                                            </tbody>
                                            @endforeach

                                        </table>
                                    </div>

                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        let tablaFisico = document.getElementById('fisico');
        tablaFisico.style.display = 'none';
        function ocultarSeleccionPlatillo() {
            if (tablaFisico.style.display === 'none') {
                tablaFisico.style.display = 'flex';

            } else if(tablaFisico.style.display === 'flex') {
                tablaFisico.style.display = 'none';

            }
        }

    </script>
@endsection
