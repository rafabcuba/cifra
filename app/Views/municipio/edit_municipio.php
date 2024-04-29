<div class="container mt-2">
  <div class="row">
    <div class="col-2"></div>
    <div class="col-8">
      <form method="post" id="update_municipio" name="update_municipio" action="<?= base_url('/municipio-update') ?>">
          <input type="hidden" name="id" id="id" value="<?php echo $municipio_obj['id']; ?>">
          <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="name" class="form-control" required autofocus value="<?php echo $municipio_obj['nombre']; ?>" >
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Salvar</button>
          </div>
      </form>
    </div>
    <div class="col-2"></div>
  </div>
</div>

