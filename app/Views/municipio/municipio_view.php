<div class="container-fluid mt-2">
  <div class="card">
    <div class="card-header">
      <?= $title; ?>
    </div>
    <div class="card-body">

      <div class="container mt-2">
          <div class="d-flex justify-content-end">
            <a href="<?= site_url('/municipio-form'); ?>" class="btn btn-success mb-2">Crear municipio</a>
          </div>
          <table class="table table-bordered table-stripped" id="municipios-list">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody>
              <?php if($municipios): ?>
                <?php foreach($municipios as $municipio): ?>
                  <tr>
                    <td><?php echo($municipio['nombre']); ?></td>
                    <td>
                      <a href="<?= site_url('municipio-edit/'.$municipio['id']); ?>" class="btn btn-primary btn-sm">Editar</a>
                      <a href="<?= site_url('municipio-delete/'.$municipio['id']); ?>" class="btn btn-danger btn-sm">Borrar</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
                

              <?php endif; ?>
            </tbody>
          </table>
      </div>

    </div>
  </div>
</div>

<script src="<?= site_url('js/jquery-3.6.1.min.js'); ?>"></script>
<link rel="stylesheet" href="<?= site_url('datatables/datatables.min.css'); ?>" type="text/css">
<script src="<?= site_url('datatables/datatables.min.js'); ?>"></script>

<script>
  $(document).ready( function () {
    $('#municipios-list').DataTable({
      "language": {
        "url": "/datatables/es-MX.json"
      }
    });
  } );
</script>