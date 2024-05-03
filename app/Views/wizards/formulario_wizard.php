<div class="d-flex justify-content-center h-100 mt-3">
  <div class="card">
    <div class="card-header text-center">
      <h4><?= $title; ?></h4>
    </div>
    <div class="card-body">
      <form action="<?= base_url($action) ?>" method="post">
        <div class="form-group mb-2">
          <label>Formulario</label>
          <select name="formulario_id" id="formulario_id" class="form-control" required>
            <option value="">Seleccionar formulario</option>
            <?php foreach($formularios as $formulario): ?>
              <option value="<?php echo $formulario['id']; ?>"><?php echo $formulario['nombre']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group text-center mt-2">
          <button type="submit" class="btn btn-primary btn-block">Ok</button>
        </div>
      </form>
    </div>
  </div>
</div>
