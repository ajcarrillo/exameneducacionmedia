
$(document).ready(function () {
    let $body = $("body");

    $("#cve_mun").select2({
        theme: 'bootstrap4',
        placeholder: "Seleccione el municipio",
        allowClear: true
    });

    $body.on("change", "#cve_mun",function (e) {
        $('#cve_loc').val('');
        $("#cve_loc").empty();
    });

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

    //});
});