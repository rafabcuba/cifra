<div class="container mt-2">
  <div class="row">
    <div class="col-2"></div>
    <div class="col-8">
      <form method="post" id="add_create" name="add_create" action="<?= base_url('/entidad-submit-form') ?>">
          <div class="form-group mb-2">
            <label>Nombre</label>
            <input type="text" name="name" class="form-control" required autofocus>
          </div>
          <div class="form-group mb-2">
            <label>Municipio</label>
            <select name="municipio_id" id="municipio_id" class="form-control" required>
              <option value="">Seleccionar municipio</option>
              <?php foreach($municipios as $municipio): ?>
                <option value="<?php echo $municipio['id']; ?>"><?php echo $municipio['nombre']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group mb-2">
            <label>Tipo</label>
            <select name="tipo_id" id="tipo_id" class="form-control" required>
              <option value="">Seleccionar tipo</option>
              <?php foreach($tipos as $tipo): ?>
                <option value="<?php echo $tipo['id']; ?>"><?php echo $tipo['nombre']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group mt-2">
            <button type="submit" class="btn btn-primary btn-block">Salvar</button>
          </div>
      </form>
    </div>
    <div class="col-2"></div>
  </div>
</div>

