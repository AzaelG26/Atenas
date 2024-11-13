@extends('layout.g_base')

@section('title', 'Buscar Direcciones')

@section('content')
<div class="container mt-4">
    <h2>Buscar Direcciones</h2>

    <!-- Formulario de búsqueda -->
    <form id="searchForm">
        <div class="form-group">
            <label for="search">Buscar por código postal, vecindario o tipo de asentamiento</label>
            <input type="text" id="search" name="search" class="form-control" placeholder="Ingresa el término de búsqueda...">
        </div>
    </form>

    <!-- Resultados de la búsqueda en tiempo real -->
    <div id="results" class="mt-3"></div>
</div>

<script>
document.getElementById('search').addEventListener('input', function() {
    let term = this.value;

    if (term.length >= 2) {
        fetch(`/addresses/search?term=${encodeURIComponent(term)}`)
            .then(response => response.json())
            .then(data => {
                let resultsDiv = document.getElementById('results');
                resultsDiv.innerHTML = '';

                if (data.length === 0) {
                    resultsDiv.innerHTML = '<p>No se encontraron resultados.</p>';
                } else {
                    data.forEach(address => {
                        resultsDiv.innerHTML += `
                            <div class="card mb-2">
                                <div class="card-body">
                                    <h5 class="card-title">${address.street}</h5>
                                    <p class="card-text">
                                        <strong>Número Exterior:</strong> ${address.outer_number || 'N/A'}<br>
                                        <strong>Número Interior:</strong> ${address.interior_number || 'N/A'}<br>
                                        <strong>Colonia:</strong> ${address.neighborhood?.name || 'N/A'}<br>
                                        <strong>Código Postal:</strong> ${address.neighborhood?.postalCode?.postal_code || 'N/A'}
                                    </p>
                                </div>
                            </div>
                        `;
                    });
                }
            })
            .catch(error => console.error('Error:', error));
    }
});
</script>
@endsection
