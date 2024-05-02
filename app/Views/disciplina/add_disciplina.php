<div class="container mt-2">
  <div class="row">
    <div class="col-2"></div>
    <div class="col-8">
      <form method="post" id="add_create" name="add_create" action="<?= base_url('/disciplina-submit-form') ?>">
          <div class="form-group mb-2">
            <label>Fecha</label>
            <input type="date" name="fecha" class="form-control" required autofocus>
          </div>
          <div class="form-group mb-2">
            <label>Entidad</label>
            <select name="entidad_id" id="entidad_id" class="form-control" required>
              <option value="">Seleccionar entidad</option>
              <?php foreach($entidades as $entidad): ?>
                <option value="<?php echo $entidad['id']; ?>"><?php echo $entidad['nombre']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group mb-2">
            <label>Formulario</label>
            <select name="formulario_id" id="formulario_id" class="form-control" required>
              <option value="">Seleccionar formulario</option>
              <?php foreach($formularios as $formulario): ?>
                <option value="<?php echo $formulario['id']; ?>"><?php echo $formulario['nombre']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="indisciplina" id="indisciplina" name="indisciplina">
              <label class="form-check-label" for="flexCheckDefault">
                Indisciplina
              </label>
            </div>
          </div>
          <div class="form-group mt-2">
            <button type="submit" class="btn btn-primary btn-block">Salvar</button>
          </div>
      </form>
    </div>
    <div class="col-2"></div>
  </div>
</div>

