<div class="container mt-2">
    <div class="d-flex justify-content-end">
      <a href="<?= site_url('/formulario-form'); ?>" class="btn btn-success mb-2">Crear formulario</a>
    </div>
    <table class="table table-bordered table-stripped" id="formularios-list">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Descripcion</th>
          <th>Acción</th>
        </tr>
      </thead>
      <tbody>
        <?php if($formularios): ?>
          <?php foreach($formularios as $formulario): ?>
            <tr>
              <td><?php echo($formulario['nombre']); ?></td>
              <td><?php echo($formulario['descripcion']); ?></td>
              <td>
                <a href="<?= site_url('formulario-edit/'.$formulario['id']); ?>" class="btn btn-primary btn-sm">Editar</a>
                <a href="<?= site_url('formulario-delete/'.$formulario['id']); ?>" class="btn btn-danger btn-sm">Borrar</a>
              </td>
            </tr>
          <?php endforeach; ?>
          

        <?php endif; ?>
      </tbody>
    </table>
</div>

<script src="<?= site_url('js/jquery-3.6.1.min.js'); ?>"></script>
<link rel="stylesheet" href="<?= site_url('datatables/datatables.min.css'); ?>" type="text/css">
<script src="<?= site_url('datatables/datatables.min.js'); ?>"></script>

<script>
  $(document).ready( function () {
    $('#formularios-list').DataTable({
      "language": {
        "url": "/datatables/es-MX.json"
      }
    });
  } );
</script>