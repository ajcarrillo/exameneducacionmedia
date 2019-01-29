$(document).ready(function () {
    "use strict";
    let $btn_motivo_rechazo = $('a#btn_motivo_rechazo');
    $btn_motivo_rechazo.on("click", function () {
        let id     = $(this).data("id"),
            motivo = $("#motivo_rechazo" + id),
            body   = $("#modal-rechazo-body");


        body.html("");
        body.html(motivo.val());
    });
});