@extends('layout.sidebar')

@section('title', 'Historial de Auditoría') 

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

        .card {
            background-color: #1c1f22;
            border: 1px solid #343a40;
            color: #fff;
        }

        .card-header {
            background-color: #343a40;
            border-bottom: 1px solid #ce9d22;
        }

        .card-header h4 {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .table .thead-dark th {
            background-color: #343a40;
            color: #fff;
        }

        .table tbody tr:hover {
            background-color: #1a1e21;
        }

        .badge-info {
            background-color: #17a2b8;
            font-size: 0.9rem;
            padding: 5px 10px;
            border-radius: 15px;
        }
    </style>
@endpush

@section('content')
<div class="container-fluid py-3">
    <h1 class="title-style">Historial de Auditoría</h1>

    <div class="card shadow-lg">
        <div class="card-header text-center">
            <h4 class="mb-0">Registros de Auditoría</h4>
        </div>
        <div class="card-body">
            @if ($auditoria->isEmpty())
                <div class="alert alert-warning" role="alert">
                    No hay registros de auditoría disponibles.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Datos Anteriores</th>
                                <th>Datos Nuevos</th>
                                <th>Usuario</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($auditoria as $registro)
                                <tr>
                                    <td>
                                        @php
                                            $oldData = json_decode($registro->old_data);
                                        @endphp
                                        @if ($oldData)
                                            @foreach ($oldData as $key => $value)
                                                <strong>{{ ucfirst($key) }}:</strong> {{ $value }} <br>
                                            @endforeach
                                        @else
                                            <span class="text-muted">Sin datos</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $newData = json_decode($registro->new_data);
                                        @endphp
                                        @if ($newData)
                                            @foreach ($newData as $key => $value)
                                                <strong>{{ ucfirst($key) }}:</strong> {{ $value }} <br>
                                            @endforeach
                                        @else
                                            <span class="text-muted">Sin datos</span>
                                        @endif
                                    </td>
                                    <td class="font-weight-bold">{{ $registro->user_id }}</td>
                                    <td>
                                        @if ($registro->created_at)
                                            <span class="badge badge-info">{{ $registro->created_at->format('d-m-Y H:i') }}</span>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
