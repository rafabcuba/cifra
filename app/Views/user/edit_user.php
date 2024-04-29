<div class="container mt-2">
  <div class="row">
    <div class="col-2"></div>
    <div class="col-8">
      <form method="post" id="update_user" name="update_user" action="<?= base_url('/user-update') ?>">
          <input type="hidden" name="id" id="id" value="<?php echo $user_obj['id']; ?>">
          <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="name" class="form-control" required autofocus value=<?php echo $user_obj['name']; ?> >
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" class="form-control" required value="<?php echo $user_obj['email']; ?>">
          </div>
          <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <div class="form-group">
            <div class="form-check">
              <?php if($user_obj['admin']): ?>
                <input class="form-check-input" type="checkbox" value="admin" id="admin" name="admin" checked>
              <?php else: ?>  
                <input class="form-check-input" type="checkbox" value="admin" id="admin" name="admin">
              <?php endif; ?>
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

