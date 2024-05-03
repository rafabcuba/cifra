<div class="d-flex justify-content-center h-100 mt-3">
  <div class="card">
    <div class="card-header text-center">
      <h4><?= $title; ?></h4>
    </div>
    <div class="card-body">
      <form action="<?= base_url($action) ?>" method="post">
        <div class="form-group mb-2">
          <label>Fecha inicial</label>
          <input type="date" name="fecha_inicial" class="form-control" required autofocus>
        </div>
        <div class="form-group mb-2">
          <label>Fecha final</label>
          <input type="date" name="fecha_final" class="form-control" required>
        </div>
        <div class="form-group text-center mt-2">
          <button type="submit" class="btn btn-primary btn-block">Ok</button>
        </div>
      </form>
    </div>
  </div>
</div>
