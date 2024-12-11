@extends('layout.g_base')

@section('title', 'Buscar Direcciones')

<style>
 /* Estilo general */
 body {
        background-color: #121212;
        color: #ffffff;
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
    }

    h2 {
        color: #fbc02d;
        text-align: center;
        margin-bottom: 30px;
        font-size: 2.5rem;
        font-weight: bold;
    }

    a {
        text-decoration: none;
        color: #ffb300;
        transition: color 0.3s ease;
    }

    a:hover {
        color: #ffca28;
    }

    /* Contenedor principal */
    .container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Tarjetas de dirección */
    .card {
        background-color: #1e1e1e;
        border: 1px solid #333;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        width: 400px; /* Reducir el ancho de las tarjetas */
        margin: 10 auto;
    }

    .card-body {
        padding: 15px;
        color: #000000; /* Cambiar el color de las letras */
    }

    .card:hover, .card.selected {
        box-shadow: 0 0 15px 5px gold; /* Efecto de luz dorada */
    }

    .card-title {
        font-size: 1.5rem;
        margin-bottom: 15px;
    }

    .card-text {
        margin-bottom: 10px;
    }

    /* Botones */
    .btn-primary {
        background-color: #fbc02d;
        color: #121212;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 1rem;
        font-weight: bold;
        transition: background-color 0.3s ease, transform 0.2s ease;
        width: 100%;
        max-width: 300px;
        margin: 20px auto;
        display: block;
        text-align: center;
    }

    .btn-primary:hover {
        background-color: #ffca28;
        transform: translateY(-2px);
    }

    /* Responsividad */
    @media (max-width: 768px) {
        h2 {
            font-size: 2rem;
        }

        .card {
            margin-bottom: 20px;
        }

        .btn-primary {
            max-width: 100%;
        }
    }
</style>

@section('content')

@if(session('success'))
    <div class="alert alert-success mt-4 alert-dismissible fade show" id="successMessage">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger mt-4 alert-dismissible fade show" id="errorMessage">
        {{ session('error') }}
    </div>
@endif

<div class="container mt-4" style="color:#ffca28">
    <h2>Busca tu Dirección</h2>

    <div class="form-check">
        <input class="form-check-input" type="radio" name="direccionOption" id="opcionAgregar" value="agregar">
        <label class="form-check-label" for="opcionAgregar">
            Agregar una nueva dirección
        </label>
    </div>
    <div class="form-check mt-2">
        <input class="form-check-input" type="radio" name="direccionOption" id="opcionSeleccionar" value="seleccionar" checked>
        <label class="form-check-label" for="opcionSeleccionar">
            Seleccionar una dirección existente
        </label>
    </div>

    <div id="agregarDireccionSection" style="display: none;">
        <div class="form-group mt-3">
            <label for="busqueda">Buscar:</label>
            <input type="text" id="busqueda" class="form-control" placeholder="Ingresa el código postal o vecindario">
        </div>

        <ul id="resultados" class="list-group mt-3"></ul>

        <form id="direccionForm" method="POST" action="{{ route('register.address') }}" style="display: none;">
            @csrf
            <h3>Detalles de tu Dirección</h3>
            <input type="hidden" name="id_neighborhood" id="direccion_id">

            <div class="form-group">
                <label for="calle">Calle(s):</label>
                <input type="text" id="calle" class="form-control" name="street" placeholder="Escribe el nombre de las calles de donde quieres que se entregue tu pedido (Campo Obligatorio)">
                @error('street')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="numeroExterior">Número Exterior:</label>
                <input type="text" id="numeroExterior" class="form-control" name="outer_number"placeholder="Escribe el número exterior de donde te encuentras (Campo Obligatorio)"maxlength="6" pattern="^\d{1,6}$"oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 6);">
                @error('outer_number')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="numeroInterior">Número Interior:</label>
                <input type="text" id="numeroInterior" class="form-control" name="interior_number"placeholder="Escribe el número interior de donde te encuentras (Campo Opcional)"maxlength="6" pattern="^\d{1,6}$"oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 6);">
                @error('interior_number')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-group">
                <label for="referencia">Referencia:</label>
                <input type="text" id="referencia" class="form-control" name="reference" placeholder="Escribe una referencia sobre el lugar donde quieres que realicen tu entrega (Campo Obligatorio)">
                @error('reference')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-center mt-3">
                <button type="submit" id="guardarDireccionBtn" class="btn btn-primary mt-3">Guardar Dirección</button>
            </div>
        </form>
    </div>
</div>

<form action="{{ route('post_carro') }}" method="POST">
    @csrf
    <div id="direccionesExistentes" class="container">
        @if($addresses->isEmpty())
            <p>No tienes direcciones registradas.</p>
        @else
            <div class="row mt-4">
                @foreach ($addresses as $address)
                    <div class="col-md-4 card-address">
                        <label>
                            <input type="radio" name="selectedAddress" value="{{ $address->id_address }}" required style="display: none;">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Dirección:</h5>
                                    <p class="card-text">Calle: {{ $address->street }}</p>
                                    <p class="card-text">Número exterior: {{ $address->outer_number }}</p>
                                    <p class="card-text">Número interior: {{ $address->interior_number ?? 'No especificado' }}</p>
                                    <p class="card-text">Referencia: {{ $address->reference ?? 'Sin referencia' }}</p>
                                    <p class="card-text">Colonia: {{ $address->neighborhood->name ?? 'Sin colonia' }}</p>
                                    <p class="card-text">Código Postal: {{ $address->neighborhood->postalCode->postal_code ?? 'Sin código postal' }}</p>
                                </div>
                            </div>
                        </label>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-3">
                <button type="submit" class="btn btn-primary">Confirmar</button>
            </div>
            
        @endif
    </div>
    
    <input type="hidden" name="cart" value="{{ json_encode($carrito) }}">
</form>

<div class="d-flex justify-content-center mt-3">
    <a href="{{ route('menu') }}" class="btn btn-secondary">Regresar al Menú</a>
</div>

<div id="addressesData" data-empty="{{ $addresses->isEmpty() ? 'true' : 'false' }}"></div>
<div id="postalCodesData" data-postalcodes='@json($postalCodes)'></div>

<script>
    const postalCodesData = document.getElementById('postalCodesData').getAttribute('data-postalcodes');
    const neighborhoods = JSON.parse(postalCodesData);

    // Buscador 
    document.getElementById('busqueda').addEventListener('keyup', function() {
        const query = this.value.toLowerCase();
        const resultados = document.getElementById('resultados');
        resultados.innerHTML = '';

        if (query.length >= 2) {
            const filtered = neighborhoods.filter(item => 
                item.postal_code.includes(query) || 
                item.neighborhoods.some(neigh => neigh.name.toLowerCase().includes(query))
            );

            if (filtered.length === 0) {
                resultados.innerHTML = '<li class="list-group-item">No se encontraron resultados.</li>';
            } else {
                filtered.forEach(item => {
                    item.neighborhoods.forEach(neigh => {
                        if (neigh.name.toLowerCase().includes(query) || item.postal_code.includes(query)) {
                            resultados.innerHTML += `
                                <li class="list-group-item seleccionable" data-id="${neigh.id}" data-postalcode="${item.postal_code}" data-name="${neigh.name}">
                                    <strong>${item.postal_code}</strong> - ${neigh.name}
                                </li>
                            `;
                        }
                    });
                });

                document.querySelectorAll('.seleccionable').forEach(element => {
                    element.addEventListener('click', function() {
                        const id = this.getAttribute('data-id');
                        const postalCode = this.getAttribute('data-postalcode');
                        const neighborhoodName = this.getAttribute('data-name');
                        
                        document.getElementById('direccion_id').value = id;
                        document.getElementById('direccionForm').style.display = 'block';
                        resultados.innerHTML = '';
                        document.getElementById('busqueda').value = `${postalCode} - ${neighborhoodName}`;
                    });
                });
            }
        }
    });

    const cards = document.querySelectorAll('.card-address');

    cards.forEach(card => {
        card.addEventListener('click', () => {
            cards.forEach(c => c.querySelector('.card').classList.remove('selected'));
            card.querySelector('.card').classList.add('selected');
        });
    });

     
     document.querySelectorAll('input[name="selectedAddress"]').forEach(radio => {
        radio.addEventListener('change', function () {
            document.getElementById('selectedAddressInput').value = this.value;
        });

    });

    
    document.querySelectorAll('input[name="direccionOption"]').forEach(option => {
        option.addEventListener('change', function() {
            const agregarDireccionSection = document.getElementById('agregarDireccionSection');
            const direccionesExistentes = document.getElementById('direccionesExistentes');

            if (this.value === 'agregar') {
                agregarDireccionSection.style.display = 'block';
                direccionesExistentes.style.display = 'none';
            } else {
                agregarDireccionSection.style.display = 'none';
                direccionesExistentes.style.display = 'flex';
            }
        });
    });

     
     document.getElementById('confirmButton').addEventListener('click', function(event) {
        const selectedAddress = document.querySelector('input[name="selectedAddress"]:checked');

        if (!selectedAddress) {
            event.preventDefault(); 
            alert('Por favor selecciona una dirección antes de continuar.');
        } else {
            const hiddenField = document.getElementById('selectedAddressInput');
            hiddenField.value = selectedAddress.value;

            console.log("Dirección seleccionada:", hiddenField.value);
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        const agregarDireccionSection = document.getElementById('agregarDireccionSection');
        const direccionesExistentes = document.getElementById('direccionesExistentes');
        const isEmpty = document.getElementById('addressesData').getAttribute('data-empty') === 'true';

        if (isEmpty) {
            agregarDireccionSection.style.display = 'block';
            direccionesExistentes.style.display = 'none';
            document.getElementById('opcionAgregar').checked = true;
        }
    });

    document.getElementById('guardarDireccionBtn').addEventListener('click', function(event) {
    // Obtener los valores de los campos obligatorios
    const calle = document.getElementById('calle').value.trim();
    const numeroExterior = document.getElementById('numeroExterior').value.trim();
    const referencia = document.getElementById('referencia').value.trim();

    let errores = [];

    if (!calle) {
        errores.push('El campo "Calle(s)" es obligatorio.');
    }

    if (!numeroExterior) {
        errores.push('El campo "Número Exterior" es obligatorio.');
    }

    if (!referencia) {
        errores.push('El campo "Referencia" es obligatorio.');
    }

    if (errores.length > 0) {
        alert(errores.join('\n')); 
    } else {
        document.getElementById('direccionForm').submit();
    }
});



</script>

@endsection
