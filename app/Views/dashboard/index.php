<div class="container-fluid mt-2">
  <div class="card" style="height: 30rem;">
    <div class="card-header">
      <?= $title; ?>
    </div>
    <div class="card-body">
      <script>
          var municipios = <?php echo $municipios; ?>;
          var entiempo = <?php echo $entiempo; ?>;
          var indisciplina = <?php echo $indisciplinas; ?>;
          var totalci = <?php echo $totalci; ?>;
          var porcentajes = <?php echo $porcentajes; ?>;
          var entiempoc = <?php echo $entiempoc; ?>;
          var indisciplinasc = <?php echo $indisciplinasc; ?>;
          var meses = <?php echo $meses; ?>;
          var indisciplinasm = <?php echo $indisciplinasm; ?>;
      </script>

      <div class="row">
        <div class="col col-md-6">
          <?= $this->include('dashboard/detalle-disciplina') ?>
        </div>
        <div class="col col-md-6">
          <?= $this->include('dashboard/total-ci') ?>
        </div>
      </div>

      <div class="row">
        <div class="col col col-md-6">
        <?= $this->include('dashboard/porcentajes') ?>
        </div>
        <div class="col col col-md-6">
        <?= $this->include('dashboard/calidad') ?>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <?= $this->include('dashboard/indisciplinas-x-mes') ?>
        </div>
      </div>

    </div>
  </div>
</div>