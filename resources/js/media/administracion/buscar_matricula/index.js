$(document).ready(function () {
    "use strict";

    $("#btnBuscar").on("click", function () {
        var nombre = $("#nombreCompleto").val(),
            curp = $("#curp").val(),
            mensaje = "",
            avisoUsuario = $("#avisoUsuario"),
            loading = $("#barLoading"),
            tableEstudiantes = $("#tableEstudiantes"),
            form = $("#form-buscar");

        if ($.trim(nombre).length === 0 && $.trim(curp).length === 0) {
            mensaje = "Escriba algún campo de búsqueda.";
        }

        avisoUsuario.text(mensaje);
        avisoUsuario.css("display", "block");

        if (mensaje.length === 0) {
            avisoUsuario.css("display", "none");
            loading.css("display", "block");
            tableEstudiantes.css("display", "none");
            $(this).prop('disabled', true);
            form.submit();
        }
    });
});