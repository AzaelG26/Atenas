@extends('layout.g_base')

@section('title', 'Añadir Empleado')

@section('styles')
<!-- Aquí puedes incluir CSS adicional si es necesario -->
@endsection

@section('content')
<div class="container mt-5">
    <h2 class="text-center text-white">Añadir Empleado</h2>
    <div class="card bg-dark text-white p-4">
        <form id="employeeForm" action="{{ route('employee.store') }}" method="POST">
            

            <!-- Modal 1: Datos de Usuario -->
            <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content bg-dark text-white">
                        <div class="modal-header">
                            <h5 class="modal-title" id="userModalLabel">Datos de Usuario</h5>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="user_name">Nombre de Usuario</label>
                                <input type="text" id="user_name" name="user_name" class="form-control" required maxlength="50">
                            </div>
                            <div class="form-group mb-3">
                                <label for="user_email">Email</label>
                                <input type="email" id="user_email" name="user_email" class="form-control" required maxlength="50">
                            </div>
                            <div class="form-group mb-3">
                                <label for="user_password">Contraseña</label>
                                <input type="password" id="user_password" name="user_password" class="form-control" required minlength="8">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="validateModal('userModal', 'personaModal')">Siguiente</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal 2: Datos Personales -->
            <div class="modal fade" id="personaModal" tabindex="-1" aria-labelledby="personaModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content bg-dark text-white">
                        <div class="modal-header">
                            <h5 class="modal-title" id="personaModalLabel">Datos Personales</h5>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="personal_name">Nombre Personal</label>
                                <input type="text" id="personal_name" name="personal_name" class="form-control" required maxlength="50">
                            </div>
                            <!-- Otros campos de datos personales aquí -->
                            <div class="form-group mb-3">
                                <label for="birthdate">Fecha de Nacimiento</label>
                                <input type="date" id="birthdate" name="birthdate" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anterior</button>
                            <button type="button" class="btn btn-primary" onclick="validateModal('personaModal', 'empleadoModal')">Siguiente</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal 3: Datos de Empleado -->
            <div class="modal fade" id="empleadoModal" tabindex="-1" aria-labelledby="empleadoModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content bg-dark text-white">
                        <div class="modal-header">
                            <h5 class="modal-title" id="empleadoModalLabel">Datos de Empleado</h5>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="curp">CURP</label>
                                <input type="text" id="curp" name="curp" class="form-control" required maxlength="18">
                            </div>
                            <!-- Otros campos de datos de empleado aquí -->
                            <div class="form-group mb-3">
                                <label for="rfc">RFC</label>
                                <input type="text" id="rfc" name="rfc" class="form-control" required maxlength="13">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anterior</button>
                            <button type="submit" class="btn btn-success">Añadir Empleado</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function validateModal(currentModalId, nextModalId) {
        let isValid = true;
        const modal = document.getElementById(currentModalId);
        const inputs = modal.querySelectorAll("input, select");
        inputs.forEach(input => {
            if (!input.checkValidity()) {
                isValid = false;
                input.classList.add("is-invalid");
            } else {
                input.classList.remove("is-invalid");
            }
        });
        if (isValid) {
            new bootstrap.Modal(document.getElementById(nextModalId)).show();
            new bootstrap.Modal(document.getElementById(currentModalId)).hide();
        }
    }
</script>
@endsection
