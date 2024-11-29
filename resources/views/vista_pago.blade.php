@extends('layout.g_base')

@section('title', 'Simulación de Pago')

@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container my-5">
    <h1 class="text-center text-light">Simulación de Pago</h1>

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
    @endif

    @if (!empty($carrito))
        <div class="table-responsive">
            <table class="table table-dark table-hover mt-4">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio Unitario</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @php $grandTotal = 0; @endphp
                    @foreach ($carrito as $item)
                        @php 
                            $subtotal = $item['price']; 
                            $grandTotal += $subtotal;
                        @endphp
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>MX${{ number_format($item['price'], 2) }}</td>
                            <td>1</td>
                            <td>MX${{ number_format($subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <h3 class="text-end text-light mt-4">Total: MX${{ number_format($total, 2) }}</h3>
        
        
        <div class="card bg-light mt-4">
    <div class="card-header">Información de Pago</div>
    <div class="card-body">
        <form method="POST" action="{{ route('procesar.pago') }}" id="paymentForm">
            @csrf
            <div class="mb-3">
                <label for="cardNumber" class="form-label">Número de Tarjeta</label>
                <input type="text" id="cardNumber" name="card_number" class="form-control" placeholder="1234 5678 9012 3456" required maxlength="16" minlength="16">
                @error('card_number')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="expiryDate" class="form-label">Fecha de Expiración (MM/YY)</label>
                    <input type="text" id="expiryDate" name="expiry_date" class="form-control" placeholder="MM/YY" required pattern="^(0[1-9]|1[0-2])\/\d{2}$">
                    @error('expiry_date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="cvv" class="form-label">CVV</label>
                    <input type="text" id="cvv" name="cvv" class="form-control" placeholder="123" required maxlength="3" minlength="3">
                    @error('cvv')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-success btn-lg w-100">Simular Pago</button>
        </form>
    </div>
</div>
    @else
        <p class="text-center text-light mt-4">El carrito está vacío.</p>
        <div class="text-center mt-4">
            <a href="{{ route('menu') }}" class="btn btn-primary btn-lg">Regresar al Menú</a>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('paymentForm').addEventListener('submit', function (e) {
    const cardNumber = document.getElementById('cardNumber').value.trim();
    const expiryDate = document.getElementById('expiryDate').value.trim();
    const cvv = document.getElementById('cvv').value.trim();

    const cardNumberRegex = /^\d{16}$/;
    const expiryDateRegex = /^(0[1-9]|1[0-2])\/\d{2}$/;
    const cvvRegex = /^\d{3}$/;

    let valid = true;

    if (!cardNumberRegex.test(cardNumber)) {
        alert('El número de tarjeta debe tener 16 dígitos.');
        valid = false;
    }

    if (!expiryDateRegex.test(expiryDate)) {
        alert('La fecha de expiración debe tener el formato MM/YY.');
        valid = false;
    }

    if (!cvvRegex.test(cvv)) {
        alert('El CVV debe tener 3 dígitos.');
        valid = false;
    }

    if (!valid) {
        e.preventDefault(); 
    } else {
       
        localStorage.removeItem('cart');
        updateCartCount();
    }
});

</script>

@endsection
