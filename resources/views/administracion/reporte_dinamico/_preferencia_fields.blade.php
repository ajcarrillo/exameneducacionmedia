<label for="" class="d-block">Seleccion de oferta educativa:</label>
@foreach($preferencias as $field)
    <div class="form-check form-check-inline">
        <input name="preferencias[]"
               type="checkbox"
               class="form-check-input"
               id="preferencias_{{ $field }}"
               value="{{ $field }}"
            {{ $checkedPreferencias->contains($field) ? 'checked' : '' }}>
        <label class="form-check-label" for="preferencias_{{ $field }}">{{ "Preferencia $field" }}</label>
    </div>
@endforeach
