<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <title>SIEM - Cambiar contraseña</title>

        <style>
            body {
                background-color: #F3F6F9;
            }

            .page-title {
                color: rgba(0, 0, 0, 0.5);
            }
        </style>
    </head>
    <body>
        <div class="page-title bg-white border-bottom">
            <div class="container-fluid">
                <div class="row">
                    <div class="col p-3 d-flex">
                        <p class="mb-0">SIEM - Actualizar contraseña</p>
                        <p class="mb-0 ml-3">
                            <a href="/login">Regresar</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid mt-5">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                Actualizar contraseña
                            </h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('update.password') }}" method="post">
                                @method('PATCH')
                                @csrf
                                <div class="form-group">
                                    <label>Nueva contraseña</label>
                                    <input type="password" name="password" class="form-control" required autofocus>
                                </div>
                                <div class="form-group mb-0">
                                    <button class="btn btn-success">Actualizar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
