$(document).ready(function () {
    let $body = $("body");
    $body.on("click", "#eliminar",function (e) {
        let r = confirm("¿Desea eliminar este elemento?");
        if (!r) {
            e.preventDefault();
        }
    });
});