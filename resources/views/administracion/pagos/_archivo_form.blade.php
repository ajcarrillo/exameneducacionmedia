<form action="{{ route('media.pagos.index') }}" enctype="multipart/form-data" method="post">
    @csrf
    <div class="form-group">
        <label for="banco">Banco</label>
        <select name="banco" id="banco" class="form-control" required>
            <option value="">Seleccione...</option>
            <option value="3">HSBC</option>
            <option value="2">SANTANDER</option>
        </select>
    </div>
    <div class="form-group">
        <label for="">Subir archivo</label>
        <input type="file" class="form-control-file" name="archivo" id="archivo">
    </div>
    <div class="form-group mb-0">
        <button class="btn btn-success">Subir</button>
    </div>
</form>
