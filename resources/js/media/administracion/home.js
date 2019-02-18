window.swal = require('sweetalert2');
$(document).ready(function () {
       $('#btn_desactivar_planteles').click(function () {
            swal.fire({
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
                            if (response.isValid)
                                swal.fire(
                                    {
                                        position: 'top-end',
                                        type: 'success',
                                        title: 'Los planteles se desactivaron satisfactoriamente',
                                        showConfirmButton: false,
                                        timer: 3000
                                    }
                                )
                            else
                                swal.fire(
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
                            swal.fire(
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
            })
        });
    });
