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
    <h1 class="text-center text-light">Completa tu Pago</h1>

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
    



        <h3 class="text-end text-light mt-4">Total: MX${{ number_format($total, 2) }}</h3>
        
        
        <div class="card bg-light mt-4">
    <div class="card-header">Información de Pago</div>
    <div class="card-body">
    <form method="POST" action="{{ route('procesar.pago') }}" id="paymentForm">
    @csrf
    <input type="hidden" name="selectedAddress" value="{{ $selectedAddress->id_address ?? '' }}">

    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
        <table class="table table-dark table-hover mt-4">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                    <th>Detalle</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carrito as $index => $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>MX${{ number_format($item['price'], 2) }}</td>
                    <td>MX${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                    <td>
                        <div class="detail-input mt-2">
                            <input type="text" name="specifications[{{ $index }}]" class="form-control mb-2" placeholder="Escriba un detalle (opcional)">
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mb-3">
        <label for="receiverName" class="form-label">Nombre del Receptor</label>
        <input type="text" id="receiverName" name="receiver_name" class="form-control" placeholder="Nombre de quien recibirá el pedido" required>
        @error('receiver_name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="notes" class="form-label">Notas</label>
        <input type="text" id="notes" name="notes" class="form-control" placeholder="¿Quieres agregar una nota de cómo quieres que te entreguen tu pedido?" maxlength="1000">
        @error('notes')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
    <label for="cardNumber" class="form-label">Número de Tarjeta</label>
    <input type="text" id="cardNumber" name="card_number" class="form-control" placeholder="1234 5678 9012 3456" required maxlength="16" pattern="^\d{16}$" oninput="this.value = this.value.replace(/\D/g, '')" >
    @error('card_number')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="expiryDate" class="form-label">Fecha de Expiración (MM/YY)</label>
        <input type="text" id="expiryDate" name="expiry_date" class="form-control" placeholder="MM/YY" required pattern="^(0[1-9]|1[0-2])\/\d{2}$" maxlength="5" oninput="this.value = this.value.replace(/[^0-9\/]/g, '').substring(0, 5)">
        @error('expiry_date')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="cvv" class="form-label">CVV</label>
        <input type="text" id="cvv" name="cvv" class="form-control" placeholder="123" required maxlength="3" pattern="^\d{3}$" oninput="this.value = this.value.replace(/\D/g, '').substring(0, 3)">
        @error('cvv')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>


    <button type="submit" onclick="clearCart()" class="btn btn-success btn-lg w-100">Simular Pago</button>
</form>


    </div>
</div>
@else
@endif
        <div class="text-center mt-4">
            <a href="{{ route('menu') }}" class="btn btn-primary btn-lg">Regresar al Menú</a>
        </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('paymentForm').addEventListener('submit', function (e) {
        const cardNumber = document.getElementById('cardNumber').value.trim();
        const expiryDate = document.getElementById('expiryDate').value.trim();
        const cvv = document.getElementById('cvv').value.trim();

        const cardNumberRegex = /^\d{16}$/;
        const expiryDateRegex = /^(0[1-9]|1[0-2])\/\d{2}$/;
        const cvvRegex = /^\d{3}$/;

        let valid = true;
        const currentYear = new Date().getFullYear() % 100; 
        const currentMonth = new Date().getMonth() + 1; 

        if (!cardNumberRegex.test(cardNumber)) {
            alert('El número de tarjeta debe tener exactamente 16 dígitos.');
            valid = false;
        }

        if (expiryDateRegex.test(expiryDate)) {
            const [month, year] = expiryDate.split('/').map(Number);
            if (year < currentYear || (year === currentYear && month < currentMonth)) {
                alert('La fecha de expiración debe ser mayor o igual al mes y año actuales.');
                valid = false;
            }
        } else {
            alert('La fecha de expiración debe tener el formato MM/YY.');
            valid = false;
        }

        if (!cvvRegex.test(cvv)) {
            alert('El CVV debe tener exactamente 3 dígitos.');
            valid = false;
        }

        if (!valid) {
            e.preventDefault();
        } else {
            localStorage.removeItem('cart');
            updateCartCount();
        }
    });
});

</script>
@endsection
