$(document).ready(function () {
    "use strict";
    let btn_motivo_rechazo = $('a#btn_motivo_rechazo');
    let btnAceptaConfirmacion = $('[data-button="btnAceptaConfirmacion"]');
    let btnImprimirCsv = $('a#btn_imprimir');

    btn_motivo_rechazo.on("click", function () {
        let id     = $(this).data("id"),
            body   = $("#modal-rechazo-body"),
            mensajeUsuario = $("#mensajeUsuario");

        mensajeUsuario.css('display','none');
    });

    btnAceptaConfirmacion.on("click", function (event) {
        let id = btn_motivo_rechazo.data("id");
        let comentario = $("#comentario").val();
        let mensajeUsuario = $("#mensajeUsuario");
        let mensaje = '';
        let error = 'NO';

        if ((comentario.trim()).length === 0) {
            error = 'SI';
            mensaje = 'Escriba algun motivo de rechazo de la oferta educativa.';
        }

        if (error === 'SI') {
            mensajeUsuario.css("display", "block");
            mensajeUsuario.html('<div class="alert alert-warning" role="alert">' + mensaje + '</div>');
            return false;
        }

        this.href = this.href + '?comentario=' + comentario + '&id=' + id;

    });
});