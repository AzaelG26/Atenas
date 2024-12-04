@extends('layout.sidebar')

@section('title', 'Historial de Pedidos') 

@push('styles')
    <style>
        .title-style {
            font-size: 2rem;
            font-weight: bold;
            color: #fff;
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #131718;
            border-left: 5px solid #ce9d22;
            border-radius: 5px;
        }

        .table .head {
            color: white;
            background-color: rgb(22, 22, 22);
        }

        .table tbody tr:hover {
            background-color: #1a1e21;
        }

        .badge {
            font-size: 0.9rem;
            padding: 5px 10px;
            border-radius: 15px;
        }

        .badge-success {
            background-color: #28a745;
        }

        .badge-warning {
            background-color: #ffc107;
        }

        .badge-secondary {
            background-color: #6c757d;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid py-3">
        <h1 class="title-style">Historial de Pedidos</h1>

        @if ($pedidos->isEmpty())
            <div class="alert alert-warning" role="alert">
                No hay pedidos para mostrar.
            </div>
        @else
            <table class="table table-bordered border-dark">
                <thead>
                    <tr>
                        <th class="head">Cliente</th>
                        <th class="head">Folio</th> 
                        <th class="head">Platillos</th>                       
                        <th class="head">Estado</th>
                        <th class="head">Fecha</th>
                        <th class="head">Total</th>
                    </tr>
                </thead>
                <tbody class="table-dark">
                    @foreach ($pedidos as $pedido)
                        <tr>
                            <td>{{ $pedido->people->fullname ?? 'Cliente no disponible' }}</td>
                            <td>{{$pedido->folio->identifier}}</td>
                            <td>{{$pedido->product_names}}</td>
                            <td>
                                <span class="badge 
                                    @if ($pedido->status == 'Pendiente') badge-warning 
                                    @elseif ($pedido->status == 'Completado') badge-success 
                                    @else badge-secondary 
                                    @endif">
                                    {{ $pedido->status }}
                                </span>
                            </td>
                            <td>{{ $pedido->created_at ?? 'Fecha no disponible' }}</td>
                            <td>{{ $pedido->total_price ? '$' . number_format($pedido->total_price, 2) : 'Total no disponible' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
