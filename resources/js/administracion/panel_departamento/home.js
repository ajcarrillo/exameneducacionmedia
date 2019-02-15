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
});