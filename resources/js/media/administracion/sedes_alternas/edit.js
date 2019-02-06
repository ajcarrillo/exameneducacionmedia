require('select2-bootstrap4-theme/dist/select2-bootstrap4.css');
require('select2/dist/css/select2.css');
window.select2 = require('select2');


$(document).ready(function () {
    let $body = $("body");

    $("#cve_mun").select2({
        theme: "bootstrap4",
        width: "100%",
        placeholder: "Búsque en municipio",
        minimumResultsForSearch:5,
        tags:false,
        minimumInputLength: 5,
        InputTooShort:"Ingrese mínimo 3 caracteres",
        allowClear:true,
        formatSearching: "Búscando..",
        language: {
            inputTooShort: function () {
                return "Por favor,ingrese 5 ó más caracteres";
            },
            formatNoMatches: function () {
                return "No se encontraron resultados";
            },
        }

    });


    $body.on("change", "#cve_mun",function (e) {

        $cve_mun = $("#cve_mun").val();
        $selectLocalidad = $("#cve_loc");
        $selectLocalidad.empty();
        $selectLocalidad.append("<option selected='selected' value=''>Seleccione...</option>");

        $.ajax(
            {
                'url': 'localidades',
                'type': 'get',
                'dataType': 'json',
                'data': {'cve_mun': $cve_mun}
            }
        )
            .done(function (response) {
                console.log(response);
                $.each(response, function (key, value) {
                    $selectLocalidad.append("<option value='"+key+"'>"+value+"</option>");
                });
            })
            .fail(function (xhr) {
                console.log(xhr);
            });
    });
});