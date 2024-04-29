<div class="container mt-2">
    <div class="d-flex justify-content-end">
      <a href="<?= site_url('/user-form'); ?>" class="btn btn-success mb-2">Crear usuario</a>
    </div>
    <table class="table table-bordered table-stripped" id="users-list">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Correo</th>
          <th>Administrador</th>
          <th>Acción</th>
        </tr>
      </thead>
      <tbody>
        <?php if($users): ?>
          <?php foreach($users as $user): ?>
            <tr>
              <td><?php echo($user['name']); ?></td>
              <td><?php echo($user['email']); ?></td>
              <td>
                <?php if($user['admin']): ?>
                  <i class="fas fa-check-square"></i>
                <?php else: ?>
                  <i class="far fa-square">
                <?php endif; ?>
              </td>
              <td>
                <a href="<?= site_url('user-edit/'.$user['id']); ?>" class="btn btn-primary btn-sm">Editar</a>
                <a href="<?= site_url('user-delete/'.$user['id']); ?>" class="btn btn-danger btn-sm">Borrar</a>
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
    $('#users-list').DataTable({
      "language": {
        "url": "/datatables/es-MX.json"
      }
    });
  } );
</script>
