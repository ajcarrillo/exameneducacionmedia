$(document).ready(function () {
    "use strict";

    $("#btnGuardar").on("click", function () {
        var ofertaApertura = $("#OFERTA-apertura").val(),
            ofertaCierre = $("#OFERTA-cierre").val(),
            aforoApertura = $("#AFORO-apertura").val(),
            aforoCierre = $("#AFORO-cierre").val(),
            registroApertura = $("#REGISTRO-apertura").val(),
            registroCierre = $("#REGISTRO-cierre").val(),
            mensaje = "",
            avisoUsuario = $("#avisoUsuario"),
            form = $("#form-etapas");

        ofertaApertura = new Date(ofertaApertura);
        ofertaCierre = new Date(ofertaCierre);
        aforoApertura = new Date(aforoApertura);
        aforoCierre = new Date(aforoCierre);
        registroApertura = new Date(registroApertura);
        registroCierre = new Date(registroCierre);

        if (ofertaCierre >= ofertaApertura) {
        } else {
            mensaje = "Etapa OFERTA: El cierre debe ser mayor o igual a la apertura.";
        }
        if (aforoApertura > ofertaCierre) {
        } else {
            mensaje = "El AFORO debe comenzar después de la OFERTA y antes del REGISTRO.";
        }
        if (aforoCierre >= aforoApertura) {
        } else {
            mensaje = "Etapa AFORO: El cierre debe ser mayor o igual a la apertura.";
        }
        if (registroApertura > aforoCierre) {
        } else {
            mensaje = "El REGISTRO Debe comenzar después de la OFERTA y del AFORO.";
        }
        if (registroCierre >= registroApertura) {
        } else {
            mensaje = "Etapa REGISTRO: El cierre debe ser mayor o igual a la apertura.";
        }

        avisoUsuario.text(mensaje);


        if (mensaje.length === 0) {
            avisoUsuario.css("display", "none");
            form.submit();
        }
    });
});