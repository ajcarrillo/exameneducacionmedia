import swal from 'sweetalert2';

//window.swal = require('sweetalert2');
$(document).ready(function () {
   /* swal("Hello world!");*/
    $('#btn_desactivar_planteles').click(function() {
    swal({
            title: "¿Seguro que deseas continuar?",
            text: "Este momento se realizará la deactivacion de todos los planteles...",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Aceptar",
            },

        function(isConfirm){
            if (isConfirm) {
                swal("¡Hecho!",
                    "Ahora eres uno de los nuestros",
                    "success");
            } else {
                swal("¡Gallina!",
                    "Tu te lo pierdes...",
                    "error");
            }
            /*function(isConfirm){

            if (isConfirm){
                $.ajax(
                    {
                        'url': '/administracion/panelAdministracion/desactivar_planteles',
                        'type': 'post',
                        'dataType': 'json',
                    }
                )
                    .done(function (response) {
                        console.log(response);
                    })
                    .fail(function (xhr) {
                        console.log(xhr);
                    });
                swal("Shortlisted!", "Candidates are successfully shortlisted!", "success");

            } else {
                swal("Cancelled", "Your imaginary file is safe :)", "error");
            }*/
        });
    });
    /*$('#btn_desactivar_planteles').click(function() {
        let r = confirm("¿Desea desactivar planteles?");
        if (r) {
            $.ajax(
                {
                    'url': '/administracion/panelAdministracion/desactivar_planteles',
                    'type': 'post',
                    'dataType': 'json',
                }
            )
                .done(function (response) {
                    console.log(response);
                })
                .fail(function (xhr) {
                    console.log(xhr);
                });
     }
    });*/

});