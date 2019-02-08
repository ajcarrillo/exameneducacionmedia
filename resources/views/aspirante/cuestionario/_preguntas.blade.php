<?php
/**
 * Created by PhpStorm.
 * User: igna
 */
?>
<div id="pagina-{{ $page }}">
	<p class="text-center text-info">
		{{ $page == $lastPage ? 'Última página' : 'Página'}} <span class="badge badge-light">{{ $page }}</span>
	</p>
	@foreach($preguntas as $pregunta)
		<div class="card card-info">
			<div class="card-header">
				{{ $page }} {{ $pregunta->nombre }}
			</div>
			<div class="card-body">
				<ul class="list-group">
					@foreach($pregunta->hijos as $hijo)
						<li class="list-group-item list-group-item-action">
							<b>{{ $hijo->nombre }}</b>
							<select name="preguntas[{{ $hijo->id }}]" class="form-control col-sm-6" >
								<option value="">Seleccione...</option>
								@foreach($hijo->diccionario->respuestas  as $respuesta)
									<option value="{{ $respuesta->id }}">{{ $respuesta->etiqueta }}</option>
								@endforeach
							</select>
						</li>
					@endforeach
				</ul>
			</div>
		</div>
	@endforeach
</div>