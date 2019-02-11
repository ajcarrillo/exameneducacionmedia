var Credencial = Credencial || {};
$(document).ready(function () {
    "use strict";
    var $inputFile = $("#pdf");
    $inputFile.on("change", function () {
        var sizeByte = this.files[0].size;
        var fileName = this.files[0].name;
        var siezekiloByte = parseInt(sizeByte / 10240);
        if(siezekiloByte > $(this).attr('size')){
            alert('El tamaño supera al límite permitido de 1MB');
            $(this).val('');
            return false;
        }else{
            var ext = fileName.split('.').pop();

            switch (ext) {
                case 'pdf':
                    break;
                case 'xlsx':
                    break;
                case 'xlsb':
                    break;
                case 'xltx':
                    break;
                case 'xls':
                    break;
                case 'xlt':
                    break;
                case 'xlr':
                    break;
                case 'pptx':
                    break;
                case 'pptm':
                    break;
                case 'potx':
                    break;
                case 'ppsx':
                    break;
                default:
                    alert('Los documentos válidas debe ser archivos pdf,Power Point y Microsoft Excel)');
                    this.value = ''; // reset del valor
                    this.files[0].name = '';
            }
        }
        Credencial.upload.previewFile();
    });

});
Credencial.upload = {
    previewFile: function () {
        "use strict";
        var thumbnail = document.querySelector("#pdf_thumbnail"),
            photo = document.querySelector("#pdf").files[0],
            reader = new FileReader();
        reader.onloadend = function (){
            thumbnail.src = "data:image/png;base64,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";
        };
        if (photo) {
            reader.readAsDataURL(photo);
        } else {
            thumbnail.src = "";
        }
        return true;
    },
};

$(document).ready(function() {
    $('#limpiar' ).on( "click", function() {
        var controlInput = $("#pdf");
        controlInput.replaceWith(controlInput = controlInput.val('').clone(true));
        $('#pdf_thumbnail').attr('src', ''); // Clear the src

    });
});