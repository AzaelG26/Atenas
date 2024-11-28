@extends('layout.g_base')

@section('title', 'Confirmación del Carrito')

@section('content')
<div class="container my-5">
    <h1 class="text-center text-light">Confirmación del Carrito</h1>

    @if (!empty($selectedAddress))
        <div class="card bg-light mb-3">
            <div class="card-header">Dirección de Envío</div>
            <div class="card-body">
                <p><strong>Calle:</strong> {{ $selectedAddress->street }}</p>
                <p><strong>Número Exterior:</strong> {{ $selectedAddress->outer_number }}</p>
                @if (!empty($selectedAddress->interior_number))
                    <p><strong>Número Interior:</strong> {{ $selectedAddress->interior_number }}</p>
                @endif
                <p><strong>Colonia:</strong> {{ $selectedAddress->neighborhood->name }}</p>
                <p><strong>Código Postal:</strong> {{ $selectedAddress->neighborhood->postalCode->postal_code }}</p>
                <p><strong>Referencia:</strong> {{ $selectedAddress->reference }}</p>
            </div>
        </div>
    @else
        <p class="text-warning">No se ha seleccionado una dirección.</p>
    @endif
   
    @if (!empty($carrito))
    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
        <table class="table table-dark table-hover mt-4">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php 
                    $grandTotal = 0; 
                    $counter = 1; // Contador para numerar los productos
                @endphp
                @foreach ($carrito as $item)
                    @php 
                        $subtotal = $item['price'] * $item['quantity']; 
                        $grandTotal += $subtotal;
                    @endphp
                    @for ($i = 1; $i <= $item['quantity']; $i++)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>MX${{ number_format($item['price'], 2) }}</td>
                            <td>MX${{ number_format($item['price'], 2) }}</td>
                        </tr>
                    @endfor
                @endforeach
            </tbody>
        </table>
    </div>


        <h3 class="text-end text-light mt-4">Total: MX${{ number_format($grandTotal, 2) }}</h3>
        <div class="text-center mt-4">
            <a href="{{ route('addresses.form') }}" class="btn btn-success btn-lg">Seleccionar direccion</a>
            <a href="{{ route('menu') }}" class="btn btn-primary btn-lg">Regresar al Menú</a>
            <a href="{{ route('vista.pago', ['selectedAddress' => $selectedAddress->id_address ?? null]) }}" class="btn btn-warning btn-lg">
                Proceder al Pago
            </a>

        </div>
    @else
        <p class="text-center text-light mt-4">El carrito está vacío.</p>
        <div class="text-center mt-4">
            <a href="{{ route('menu') }}" class="btn btn-primary btn-lg">Regresar al Menú</a>
        </div>
    @endif
</div>
@endsection