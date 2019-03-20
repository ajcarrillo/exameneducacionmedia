<label for="" class="d-block">Campos disponibles del usuario:</label>
@foreach($userFields as $field)
    <div class="form-check form-check-inline">
        <input name="usrfields[]"
               type="checkbox"
               class="form-check-input"
               id="user_{{ $field }}"
               value="{{ $field }}"
            {{ $checkedUserFields->contains($field) ? 'checked' : '' }}>
        <label class="form-check-label" for="user_{{ $field }}">{{ $field }}</label>
    </div>
@endforeach
