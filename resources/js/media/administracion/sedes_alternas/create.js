
$(document).ready(function () {
    let $body = $("body");

    $("#cve_mun").select2({
        theme: 'bootstrap4',
        placeholder: "Seleccione el municipio",
        allowClear: true
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
//                console.log(response);
                $.each(response, function (key, value) {
                    $selectLocalidad.append("<option value='"+key+"'>"+value+"</option>");
                });
            })
            .fail(function (xhr) {
                console.log(xhr);
            });
    });
});