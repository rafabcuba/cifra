<div class="container-fluid mt-2">
  <div class="card">
    <div class="card-header">
      <?= $title; ?>
    </div>
    <div class="card-body">
      <div class="container mt-2">
          <div class="d-flex justify-content-end">
            <a href="<?= site_url('/tipo-form'); ?>" class="btn btn-success mb-2">Crear tipo</a>
          </div>
          <table class="table table-bordered table-stripped" id="tipos-list">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody>
              <?php if($tipos): ?>
                <?php foreach($tipos as $tipo): ?>
                  <tr>
                    <td><?php echo($tipo['nombre']); ?></td>
                    <td>
                      <a href="<?= site_url('tipo-edit/'.$tipo['id']); ?>" class="btn btn-primary btn-sm">Editar</a>
                      <a href="<?= site_url('tipo-delete/'.$tipo['id']); ?>" class="btn btn-danger btn-sm">Borrar</a>
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
    $('#tipos-list').DataTable({
      "language": {
        "url": "/datatables/es-MX.json"
      }
    });
  } );
</script>