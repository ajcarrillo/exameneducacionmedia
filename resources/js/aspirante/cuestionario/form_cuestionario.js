$(document).ready(function () {
    "use strict";

    $("#btnSiguiente").on("click", function () {
        var idPage     = $('[data-id="page"]'),
            page       = idPage.attr("data-page"),
            siguiente  = parseInt(page) + 1,
            lastPage   = idPage.attr("data-last"),
            boton      = $("#btnGuardar"),
            contenedor = $("#contenedor"),
            form       = $("#form-cuestionario");

        if (!form[0].checkValidity()) {
            $("#avisoUsuario").html('<div class="alert alert-primary" role="alert"> Para continuar debe responder todas las preguntas.</div>');
            return false;
        } else {
            $("#avisoUsuario").html('');
        }

        if (siguiente > lastPage) {
            return false;
        }

        $.ajax({
            url: "/aspirantes/captura-cuestionario",
            type: 'GET',
            dataType: "json",
            data: {'page': siguiente}
        })
            .done(function (response) {
                $("[id*='pagina-']").css("display", "none");
                idPage.attr("data-page", siguiente);
                contenedor.append(response);

                if (siguiente == lastPage) {
                    boton.css("display", "block");
                    $("#btnSiguiente").css("display", "none");
                }
            })
            .fail(function (xhr) {
                console.error("Error durante petición ajax.");
                console.error(xhr);
            });
    });
});