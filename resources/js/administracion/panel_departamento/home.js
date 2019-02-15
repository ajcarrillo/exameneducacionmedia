let Ofertas = require('./Home.NameSpace');
window.Swal = require('sweetalert2');

$(document).ready(function () {
    let $cancelar_ofertas = $("a#btn_desactivar");

    $cancelar_ofertas.on("click", function (event) {

        Swal.fire({
            title: '¿Desea desactivar las ofertas educativas?',
            text: "",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
            Ofertas.index.desactivar(function (response) {
                if (response.code === 200) {
                    Swal.fire({
                        title: 'Se desactivaron las ofertas educativas!',
                        type: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar',
                    }).then((result) => {
                        if (result.value) {
                        location.reload();
                    }
                });
                } else {
                    Swal.fire({
                        title: 'No se desactivaron las ofertas educativas!',
                        type: 'warning',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar',
                    }).then((result) => {
                        //
                    });
                }
            });
        }
    });

        event.preventDefault();

    });

    $('#btn_desactivar_planteles').click(function () {
        //$('#btn_desactivar_planteles').html('<a class="btn" style="background:#00a65a;color: white;font-size: 13pt" href="#" id="btn_desactivar_planteles"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></a>');
        $("#btn_desactivar_planteles").prop('disabled', true);
        Swal.fire({
            title: '¿Esta seguro de continuar?',
            text: "Este proceso realizara la desactivación de los planteles",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                $.ajax(
                    {
                        'url': '/administracion/panelAdministracion/desactivar-planteles',
                        'type': 'get',
                        'dataType': 'json',
                    }
                )
                    .done(function (response) {
                        if (response.code == 200)
                            Swal.fire(
                                {
                                    position: 'top-end',
                                    type: 'success',
                                    title: 'Los planteles se desactivaron satisfactoriamente',
                                    showConfirmButton: false,
                                    timer: 3000
                                }
                            )
                        else
                            Swal.fire(
                                {
                                    position: 'top-end',
                                    type: 'success',
                                    title: 'Los planteles se no fueron desactivados',
                                    showConfirmButton: false,
                                    timer: 3000
                                }
                            )
                    })
                    .fail(function (xhr) {
                        Swal.fire(
                            {
                                position: 'top-end',
                                type: 'success',
                                title: 'Los planteles se no fueron desactivados',
                                showConfirmButton: false,
                                timer: 3000
                            }
                        )
                        console.log(xhr);
                    });
            }
        });

        event.preventDefault();

        $("#btn_desactivar_planteles").prop('disabled', false);

    });
});