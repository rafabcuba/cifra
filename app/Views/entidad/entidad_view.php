<div class="container mt-2">
    <div class="d-flex justify-content-end">
      <a href="<?= site_url('/entidad-form'); ?>" class="btn btn-success mb-2">Crear entidad</a>
    </div>
    <table class="table table-bordered table-stripped" id="entidades-list">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Municipio</th>
          <th>Tipo</th>
          <th>Acción</th>
        </tr>
      </thead>
      <tbody>
        <?php if($entidades): ?>
          <?php foreach($entidades as $entidad): ?>
            <tr>
              <td><?php echo($entidad['nombre']); ?></td>
              <td><?php echo get_municipio($entidad['municipio_id'])['nombre']; ?></td>
              <td><?php echo get_tipo($entidad['tipo_id'])['nombre']; ?></td>
              <td>
                <a href="<?= site_url('entidad-edit/'.$entidad['id']); ?>" class="btn btn-primary btn-sm">Editar</a>
                <a href="<?= site_url('entidad-delete/'.$entidad['id']); ?>" class="btn btn-danger btn-sm">Borrar</a>
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
    $('#entidades-list').DataTable({
      "language": {
        "url": "/datatables/es-MX.json"
      }
    });
  } );
</script>