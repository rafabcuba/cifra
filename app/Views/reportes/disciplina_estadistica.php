<div class="container mt-2">
    <table class="table table-bordered table-stripped" id="disciplina-report">
      <thead>
        <tr>
          <th>Municipio</th>
          <th>Total de CI</th>
          <th>Indisciplinas</th>
          <th>% en fecha</th>
        </tr>
      </thead>
      <tbody>
        <?php if($municipios): ?>
          <?php foreach($municipios as $municipio): ?>
            <tr>
              <td><?php echo($municipio['nombre']); ?></td>
              <td><?php echo($municipio['total']); ?></td>
              <td><?php echo($municipio['indisciplinas']); ?></td>
              <td><?php echo(round(($municipio['total'] - $municipio['indisciplinas'])*100/$municipio['total'],1)); ?></td>
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
    $('#disciplina-report').DataTable({
      "language": {
        "url": "/datatables/es-MX.json"
      }
    });
  } );
</script>