$(document).ready(function() {

    $('#username').val('');
    $('#password').val('');
    $('#nombre').val('');
    $('#primer_apellido').val('');
    $('#segundo_apellido').val('');
    $('#username').val('');
    $('#email').val('');
    $('#btn-actualizarResponsable' ).on( "click", function() {
        $('#capaAsignarResponsable' ).fadeToggle();
    });

    $('#filtro').DataTable( {
        initComplete: function () {
            this.api().columns([4]).every( function () {
                var column = this;
                var select = $('<select class="form-control border-primary" style="width:180px;height:33px"><option  style="height:30px" value="">Todos</option></select>')
                    .appendTo( $(column.header()))
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );

                column.cells('', column[0]).render('display').sort().unique().each( function ( d, j ) {
                    select.append( '<option  class="form-control" style="width:180px;height:20px" value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
    $('#filtro').DataTable();
    let $body = $("body");
    $body.on("click", "#eliminar",function (e) {
        let r = confirm("¿Desea eliminar este elemento?");
        if (!r) {
            e.preventDefault();
        }
    });
});
