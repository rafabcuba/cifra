<div class="d-flex justify-content-center h-100 mt-3">
  <div class="card">
    <div class="card-header text-center">
      <h4><?= $title; ?></h4>
    </div>
    <div class="card-body">
      <form action="<?= base_url($action) ?>" method="post">
        <div class="form-group mb-2">
          <label>Municipio</label>
          <select name="municipio_id" id="municipio_id" class="form-control" required autofocus>
            <option value="">Seleccionar municipio</option>
            <?php foreach($municipios as $municipio): ?>
              <option value="<?php echo $municipio['id']; ?>"><?php echo $municipio['nombre']; ?></option>
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
