<?php
/**
 * Created by PhpStorm.
 * User: igna
 */
?>

<div class="card-body">
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

							<select name="respuesta" id="" class="form-control col-md-6" required>
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
<div class="card-footer">
	{{ $preguntas->links() }}
</div>