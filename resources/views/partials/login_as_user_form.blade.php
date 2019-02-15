<form action="{{ route('login.as.user', ['userId'=>$user->id]) }}" method="post">
    @csrf
    <button class="btn btn-success" type="submit">
        Iniciar sesión
    </button>
</form>
