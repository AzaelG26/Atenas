@extends('layout.g_base')

@section('title', 'Buscar Direcciones')

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

<div class="container mt-4">
    <h2>Buscar Código Postal o Vecindario</h2>
    <div class="form-group">
        <label for="busqueda">Buscar:</label>
        <input type="text" id="busqueda" class="form-control" placeholder="Ingresa el código postal o vecindario">
    </div>

    <ul id="resultados" class="list-group mt-3"></ul>

    <!-- Formulario de detalles de la dirección -->
    <form id="direccionForm" method="POST" action="{{ route('register.address') }}" style="display: none;">
        @csrf
        <h3>Detalles de la Dirección</h3>
        <input type="hidden" name="id_neighborhood" id="direccion_id">

        <div class="form-group">
            <label for="calle">Calle:</label>
            <input type="text" id="calle" class="form-control" name="street" required>
        </div>

        <div class="form-group">
            <label for="numeroExterior">Número Exterior:</label>
            <input type="text" id="numeroExterior" class="form-control" name="outer_number" required>
        </div>

        <div class="form-group">
            <label for="numeroInterior">Número Interior:</label>
            <input type="text" id="numeroInterior" class="form-control" name="interior_number">
        </div>

        <div class="form-group">
            <label for="referencia">Referencia:</label>
            <input type="text" id="referencia" class="form-control" name="reference">
        </div>

        <input type="hidden" name="id_client" value="1"> <!-- Ajusta el valor según corresponda -->

        <button type="submit" class="btn btn-primary mt-3">Guardar Dirección</button>
    </form>
</div>

<a href="{{ route('menu') }}" class="btn btn-secondary mt-3">Regresar al Menú</a>

<div id="postalCodesData" data-postalcodes='@json($postalCodes)'></div>

<script>
    const postalCodesData = document.getElementById('postalCodesData').getAttribute('data-postalcodes');
    const neighborhoods = JSON.parse(postalCodesData);

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
</script>

<script>
    setTimeout(function() {
        const successMessage = document.getElementById('successMessage');
        const errorMessage = document.getElementById('errorMessage');
        
        if (successMessage) {
            successMessage.style.transition = 'opacity 0.5s ease';
            successMessage.style.opacity = '0';
            setTimeout(() => successMessage.style.display = 'none', 500);
        }

        if (errorMessage) {
            errorMessage.style.transition = 'opacity 0.5s ease';
            errorMessage.style.opacity = '0';
            setTimeout(() => errorMessage.style.display = 'none', 500);
        }
    }, 3500); 
</script>
@endsection
