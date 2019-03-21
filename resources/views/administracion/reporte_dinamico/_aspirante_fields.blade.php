<label for="" class="d-block">Campos disponibles del aspirante:</label>
@foreach($aspiranteFields as $field)
    <div class="form-check form-check-inline">
        <input name="aspfields[]"
               type="checkbox"
               class="form-check-input"
               id="aspirante_{{ $field }}"
               value="{{ $field }}"
            {{ $checkedAspiranteFields->contains($field) ? 'checked' : '' }}>
        <label class="form-check-label" for="aspirante_{{ $field }}">{{ $field }}</label>
    </div>
@endforeach
