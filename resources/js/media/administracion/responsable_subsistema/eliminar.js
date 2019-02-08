$(document).ready(function() {

	$('#btn-actualizarResponsable' ).on( "click", function() {
		$('#capaAsignarResponsable' ).fadeToggle();
	});

	$('#filtro').DataTable();

	let $body = $("body");
	$body.on("click", "#eliminar",function (e) {
		let r = confirm("¿Desea eliminar este elemento?");
		if (!r) {
			e.preventDefault();
		}
	});
} );
