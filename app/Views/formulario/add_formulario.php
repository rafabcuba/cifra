<div class="container mt-2">
  <div class="row">
    <div class="col-2"></div>
    <div class="col-8">
      <form method="post" id="add_create" name="add_create" action="<?= base_url('/formulario-submit-form') ?>">
          <div class="form-group">
            <label>Formulario</label>
            <input type="text" name="name" class="form-control" required autofocus>
          </div>
          <div class="form-group">
            <label>Descripción</label>
            <input type="text" name="descripcion" class="form-control" required>
          </div>
          <div class="form-group mt-2">
            <button type="submit" class="btn btn-primary btn-block">Salvar</button>
          </div>
      </form>
    </div>
    <div class="col-2"></div>
  </div>
</div>

