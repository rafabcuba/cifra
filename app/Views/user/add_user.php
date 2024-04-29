<div class="container mt-2">
  <div class="row">
    <div class="col-2"></div>
    <div class="col-8">
      <form method="post" id="add_create" name="add_create" action="<?= base_url('/user-submit-form') ?>">
          <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="name" class="form-control" required autofocus>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="admin" id="admin" name="admin">
              <label class="form-check-label" for="flexCheckDefault">
                Administrador
              </label>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Salvar</button>
          </div>
      </form>
    </div>
    <div class="col-2"></div>
  </div>
</div>

