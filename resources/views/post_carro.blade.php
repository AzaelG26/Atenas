@extends('layout.g_base')

@section('title', 'Confirmación del Carrito')

@section('content')
<div class="container my-5">
    <h1 class="text-center text-light">Confirmación del Carrito</h1>
    @if(empty($carrito))
        <p class="text-center text-light mt-4">El carrito está vacío.</p>
    @else
        <div class="table-responsive">
            <table class="table table-dark table-hover mt-4">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carrito as $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>MX${{ number_format($item['price'], 2) }}</td>
                            <td>MX${{ number_format($item['price'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <h3 class="text-end text-light mt-4">Total: MX${{ number_format($total, 2) }}</h3>
        <div class="text-center mt-4">
            <button class="btn btn-success btn-lg">Confirmar Compra</button>
        </div>
    @endif
</div>
@endsection
