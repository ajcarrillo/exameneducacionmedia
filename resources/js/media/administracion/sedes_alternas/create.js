
$(document).ready(function () {
    let $body = $("body");

    $.fn.select2.defaults.set('language', 'es');

    $("#cve_mun").select2({
        theme: 'bootstrap4',
        placeholder: "Seleccione el municipio",
        allowClear: true
        });


    $body.on("change", "#cve_mun",function (e) {
        $( "#cve_loc" ).select2({
            theme: 'bootstrap4',
            placeholder: "Seleccione la localidad",
            allowClear: true,
            //InputTooShort:"Ingrese mínimo 4 caracteres",
            //formatSearching: "Búscando..",
            ajax: {
                url: "localidades",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        cve_mun : $("#cve_mun").val(),
                        q: params.term // search term
                    };
                },
                processResults: function (data) {
                    // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data
                    // console.log(data);
                    return {
                        //results: data

                        results: $.map(data, function(obj)    {
                       //     console.log('clave:',obj.id,'valor','obj.id');
                            return { id: obj.CVE_LOC, text: obj.NOM_LOC };
                        })
                    };
                },
                cache: true
            },
            minimumInputLength: 4,
            language: {
                formatSearching: function () {
                    return "Búscando ..";
                },
                inputTooShort: function () {
                    return "Por favor,ingrese 4 ó más caracteres";
                },
                formatNoMatches: function () {
                    return "No se encontraron resultados";
                },
            }
        });



       /* $cve_mun = $("#cve_mun").val();
        $selectLocalidad = $("#cve_loc");
        $selectLocalidad.empty();
        $selectLocalidad.append("<option selected='selected' value=''>Seleccione...</option>");*/

/*        $.ajax(
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
            });*/
    });
});