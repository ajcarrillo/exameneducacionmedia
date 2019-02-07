<?php
/**
 * Created by PhpStorm.
 * User: igna
 */
?>
<div id="pagina-{{ $page }}">
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
							<select name="preguntas[{{ $hijo->id }}]" class="form-control col-md-6" >
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

{{ "-" . $page }}
<input type="hidden" id="lastPage" value="{{ $lastPage }}">
<input type="hidden" id="page" value="{{ $page }}">
