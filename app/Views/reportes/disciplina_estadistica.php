<div class="container-fluid mt-2">
  <div class="card">
    <div class="card-header">
      <?= $title; ?>
    </div>
    <div class="card-body">

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
                    <td class="<?php if($municipio['indisciplinas'] > 0 ){echo 'table-danger';}?>"><?php echo($municipio['indisciplinas']); ?></td>
                    <td><?php echo(round(($municipio['total'] - $municipio['indisciplinas'])*100/$municipio['total'],1)); ?></td>
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
    var table = $('#disciplina-report').DataTable( {
      layout: {
        topStart: 'buttons'
      },
      buttons: true,
      language: {
        url: "/datatables/es-MX.json"
      },  
      buttons: ['copy', 'excel', 'pdf']
    } 
  
  );
  
  } );
</script>