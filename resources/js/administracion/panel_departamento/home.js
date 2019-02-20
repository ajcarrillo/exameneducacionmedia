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
            $cancelar_ofertas.addClass('disabled');
            $cancelar_ofertas.prepend('<i class="fa fa-refresh fa-spin"></i> ');
            Ofertas.index.desactivar(function (response) {
                if (response.meta.code === 200) {
                    Swal.fire({
                        title: 'Se desactivaron las ofertas educativas exitosamente!',
                        type: 'success',
                        //confirmButtonColor: '#3085d6',
                        //confirmButtonText: 'Aceptar',
                        showConfirmButton: false,
                        timer: 2000
                    })
                    $cancelar_ofertas.removeClass('disabled');
                    $cancelar_ofertas.find('i.fa').remove();
                } else {
                    Swal.fire({
                        title: 'No se desactivaron las ofertas educativas!',
                        type: 'warning',
                        //confirmButtonColor: '#3085d6',
                        //confirmButtonText: 'Aceptar',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    $cancelar_ofertas.removeClass('disabled');
                    $cancelar_ofertas.find('i.fa').remove();
                }
            }, function (response) {
                console.log(response);
            });
        }
    });

        event.preventDefault();
    });

    $('#btn_desactivar_planteles').click(function () {

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
                $('#btn_desactivar_planteles').addClass('disabled');
                $('#btn_desactivar_planteles').prepend('<i class="fa fa-refresh fa-spin"></i> ');

                $.ajax(
                    {
                        'url': '/administracion/panelAdministracion/desactivar-planteles',
                        'type': 'post',
                        'dataType': 'json',
                    }
                )
                    .done(function (response) {
                        console.log(response.meta);
                        if (response.meta.code == 200) {
                            Swal.fire(
                                {
                                    position: 'top-end',
                                    type: 'success',
                                    title: 'Los planteles se desactivaron satisfactoriamente',
                                    showConfirmButton: false,
                                    timer: 3000
                                }
                            )

                        } else {
                            Swal.fire(
                                {
                                    position: 'top-end',
                                    type: 'error',
                                    title: 'Los planteles no fueron desactivados',
                                    showConfirmButton: false,
                                    timer: 3000
                                }
                            )

                        }
                    })
                    .fail(function (xhr) {
                        Swal.fire(
                            {
                                position: 'top-end',
                                type: 'error',
                                title: 'Los planteles no fueron desactivados',
                                showConfirmButton: false,
                                timer: 3000
                            }
                        )

                        console.log(xhr);
                    });
                $('#btn_desactivar_planteles').removeClass('disabled');
                $('#btn_desactivar_planteles').find('i.fa').remove();
            }
        });

        event.preventDefault();

    });
});
