<div class="container-fluid mt-2">
  <div class="card">
    <div class="card-header">
      <?= $title; ?>
    </div>
    <div class="card-body">

      <div class="container mt-2">
          <div class="d-flex justify-content-end">
            <a href="<?= site_url('/disciplina-form'); ?>" class="btn btn-success mb-2">Nueva entrada</a>
          </div>
          <table class="table table-bordered table-stripped" id="disciplina-list">
            <thead>
              <tr>
                <th>Fecha</th>
                <th>Entidad</th>
                <th>Formulario</th>
                <th>Indisciplina</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody>
              <?php if($disciplinas): ?>
                <?php foreach($disciplinas as $disciplina): ?>
                  <tr>
                    <td><?php echo($disciplina['fecha']); ?></td>
                    <td><?php echo get_entidad($disciplina['entidad_id'])['nombre']; ?></td>
                    <td><?php echo get_formulario($disciplina['formulario_id'])['nombre']; ?></td>
                    <td>
                      <?php if($disciplina['indisciplina']): ?>
                        <i class="fas fa-check-square text-danger"></i>
                      <?php else: ?>
                        <i class="far fa-square">
                      <?php endif; ?>
                    </td>
                    <td>
                      <?php if($userInfo['admin']):?>
                        <a href="<?= site_url('disciplina-edit/'.$disciplina['id']); ?>" class="btn btn-primary btn-sm">Editar</a>
                        <a href="<?= site_url('disciplina-delete/'.$disciplina['id']); ?>" class="btn btn-danger btn-sm" disabled>Borrar</a>
                      <?php else:?>
                        <a class="btn btn-primary btn-sm disabled" role="button" aria-disabled="true">Editar</a>
                        <a class="btn btn-danger btn-sm disabled" role="button" aria-disabled="true">Borrar</a>
                      <?php endif; ?>
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
    $('#disciplina-list').DataTable({
      "language": {
        "url": "/datatables/es-MX.json"
      }
    });
  } );
</script>

