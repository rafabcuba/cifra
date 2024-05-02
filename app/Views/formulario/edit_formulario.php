<div class="container-fluid mt-2">
  <div class="card">
    <div class="card-header">
      <?= $title; ?>
    </div>
    <div class="card-body">

      <div class="container mt-2">
        <div class="row">
          <div class="col-2"></div>
          <div class="col-8">
            <form method="post" id="update_formulario" name="update_formulario" action="<?= base_url('/formulario-update') ?>">
                <input type="hidden" name="id" id="id" value="<?php echo $formulario_obj['id']; ?>">
                <div class="form-group">
                  <label>Nombre</label>
                  <input type="text" name="name" class="form-control" required autofocus value="<?php echo $formulario_obj['nombre']; ?>" >
                </div>
                <div class="form-group">
                  <label>Descripción</label>
                  <input type="text" name="descripcion" class="form-control" required value="<?php echo $formulario_obj['descripcion']; ?>" >
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-block">Salvar</button>
                </div>
            </form>
          </div>
          <div class="col-2"></div>
        </div>
      </div>

    </div>
  </div>
</div>
