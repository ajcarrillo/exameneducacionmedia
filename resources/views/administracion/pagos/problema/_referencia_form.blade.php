<form @submit.prevent="submit">
    <div class="form-group">
        <input type="text"
               name="referencia"
               class="form-control text-right"
               placeholder="Referencia"
               v-model="form.referencia"
               autofocus>
        <small class="text-muted" v-if="searching">Buscando...</small>
    </div>
</form>
