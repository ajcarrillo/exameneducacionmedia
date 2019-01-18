@extends('layouts.app')

@section('content')
    <div id="app" class="container">
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
                                    <span v-text="persona.nombre_completo"></span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col col-md-3"><label for="">Escuela procedencia:</label></div>
                                <div class="col">
                                    <span v-text="centroTrabajo"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Correo electrónico</label>
                                <input type="text" class="form-control" name="email" v-model="form.email" required>
                            </div>
                            <div class="form-group">
                                <label for="">Contraseña</label>
                                <input type="text" class="form-control" name="password" v-model="form.password" required>
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
