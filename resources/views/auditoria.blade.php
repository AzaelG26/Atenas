@extends('layout.sidebar')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4 text-primary">Historial de Auditoría</h2>

    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Registros de Auditoría</h4>
        </div>
        <div class="card-body">
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
                        @foreach($auditoria as $registro)
                            <tr>
                                <td>
                                    @php
                                        $oldData = json_decode($registro->old_data);
                                    @endphp
                                    @foreach($oldData as $key => $value)
                                        <strong>{{ ucfirst($key) }}:</strong> {{ $value }} <br>
                                    @endforeach
                                </td>
                                <td>
                                    @php
                                        $newData = json_decode($registro->new_data);
                                    @endphp
                                    @foreach($newData as $key => $value)
                                        <strong>{{ ucfirst($key) }}:</strong> {{ $value }} <br>
                                    @endforeach
                                </td>
                                <td class="font-weight-bold">{{ $registro->user_id }}</td>
                                <td>
                                    @if($registro->created_at)
                                        <span class="badge badge-info">{{ $registro->created_at->format('d-m-Y H:i') }}</span>
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
