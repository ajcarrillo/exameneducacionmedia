@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2">
                <a href="{{ route('aviso.privacidad') }}">Ver aviso de privacidad.</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <form @submit.prevent="buscarMatricula">
                            <div class="form-group mb-0">
                                <div class="input-group input-group-lg">
                                    <input type="text" class="form-control" placeholder="Escribe tu matrícula" v-model="matricula" autofocus>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" :disabled="isSearching">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                                <small class="text-muted">La matrícula la puedes encontrar en tu boleta de calificaciones</small>
                                <span class="d-block mt-3" v-if="isSearching">Buscando...</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" v-if="!isEstudianteEmpty">
            <div class="col-12 col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <form @submit.prevent="register">
                            <div class="row mb-3">
                                <div class="col col-md-3">
                                    <label for="">Nombre:</label>
                                </div>
                                <div class="col">
                                    <span v-text="nombreCompleto"></span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col col-md-3"><label for="">Escuela procedencia:</label></div>
                                <div class="col">
                                    <span v-text="centroTrabajo"></span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col col-md-3"><label for="">Fecha nacimiento</label></div>
                                <div class="col" v-if="hasFechaNacimiento">
                                    <span v-text="estudiante.fecha_nacimiento"></span>
                                </div>
                                <div class="col" v-else>
                                    <input type="date" class="form-control" :class="{'is-invalid': formErrors.fecha_nacimiento}" name="fecha_nacimiento" v-model="form.fecha_nacimiento" required>
                                    <form-errors v-if="formErrors.fecha_nacimiento" :errors="formErrors">
                                        <strong>@{{ formErrors.fecha_nacimiento[0] }}</strong>
                                    </form-errors>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Correo electrónico</label>
                                <input type="text" class="form-control" :class="{'is-invalid': formErrors.email}" name="email" v-model="form.email" required>
                                <form-errors v-if="formErrors.email" :errors="formErrors">
                                    <strong>@{{ formErrors.email[0] }}</strong>
                                </form-errors>
                            </div>
                            <div class="form-group">
                                <label for="">Contraseña</label>
                                <input type="password" class="form-control" name="password" v-model="form.password" required>
                            </div>
                            <div class="form-group" v-if="formErrors.alumno_id || formErrors.fecha_nacimiento">
                                <div class="alert alert-danger pb-0" role="alert">
                                    <p v-if="formErrors.alumno_id">@{{ formErrors.alumno_id[0] }}</p>
                                    <p v-if="formErrors.fecha_nacimiento">@{{ formErrors.fecha_nacimiento[0] }}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-block btn-success">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
    @routes
    <script src="{{ mix('js/aspirante/registro_matricula.js') }}"></script>
@endsection
