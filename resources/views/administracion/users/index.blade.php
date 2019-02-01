@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-outline card-primary">
                    <div class="card-header border-bottom-0">
                        <h1 class="card-title">Usuarios</h1>
                    </div>
                    <div class="card-body">
                        <form action="" method="get" class="d-flex flex-row justify-content-between justify-content-md-start align-items-center">
                            <div class="pr-3">
                                <input type="text"
                                       class="form-control"
                                       placeholder="Buscar..."
                                       name="search"
                                       value="{{ request('search') }}">
                            </div>
                            <div class="pr-3">
                                <select name="role" class="form-control">
                                    <option value="">Roles</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role }}"{{ request('role') == $role ? ' selected' : '' }}>{{ $role }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <button class="btn btn-primary">Buscar</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-body p-0">
                        @table
                        @slot('thead')
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Opciones</th>
                            </tr>
                        @endslot
                        @slot('tbody')
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ get_full_name_from_user($user) }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ collect($user->getRoleNames())->implode(', ') }}</td>
                                    <td>
                                        <form action="{{ route('login.as.user', ['userId'=>$user->id]) }}" method="post">
                                            @csrf
                                            <button class="btn btn-success" type="submit">
                                                Iniciar sesión
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>Sin resultados</td>
                                </tr>
                            @endforelse
                        @endslot
                        @endtable
                    </div>
                    <div class="card-body">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
