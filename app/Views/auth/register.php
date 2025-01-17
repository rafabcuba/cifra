<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <link rel="stylesheet" href="/css/bootstrap.min.css" type="text/css">
</head>
<body>
  <div class="container">
    <div class="row mt-3">
      <div class="col-md-4 offset-4">
        <h4>
          Registrarse
        </h4>
        <hr>
        <?php
          if (!empty(session()->getFlashdata('success')))
          {
           ?>
              <div class="alert alert-success">
                  <?=
                    session()->getFlashdata('success');
                  ?>
              </div>
            <?php
          }
          else if (!empty(session()->getFlashdata('fail')))
          {
           ?>
              <div class="alert alert-danger">
                  <?=
                    session()->getFlashdata('fail');
                  ?>
              </div>
            <?php
          }
        ?>
        
        <form action="<?= base_url('auth/registerUser') ?>" method="post" class="form">
          <?= csrf_field(); ?>

          <div class="form-group mb-3">
            <label for="">Name</label>
            <input type="text" 
                   class="form-controller"
                   name="name"
                   value="<?= set_value('name');?>"
                   placeholder="Name">
                   <br>
                   <span class="text-danger text-sm">
                    <?= isset($validation) ? display_form_errors($validation, 'name') : ''?>
                   </span>
          </div>

          <div class="form-group mb-3">
            <label for="">E-Mail</label>
            <input type="text" 
                   class="form-controller"
                   name="email"
                   value="<?= set_value('email');?>"
                   placeholder="Email">
                   <br>
                   <span class="text-danger text-sm">
                    <?= isset($validation) ? display_form_errors($validation, 'email') : ''?>
                   </span>
          </div>

          <div class="form-group mb-3">
            <label for="">Password</label>
            <input type="password" 
                   class="form-controller"
                   name="password"
                   value="<?= set_value('password');?>"
                   placeholder="Password">
                   <br>
                   <span class="text-danger text-sm">
                    <?= isset($validation) ? display_form_errors($validation, 'password') : ''?>
                   </span>
          </div>

          <div class="form-group mb-3">
            <label for="">Confirm Password</label>
            <input type="password" 
                   class="form-controller"
                   name="passwordConf"
                   value="<?= set_value('passwordConf');?>"
                   placeholder="Confirm Password">
                   <br>
                   <span class="text-danger text-sm">
                    <?= isset($validation) ? display_form_errors($validation, 'passwordConf') : ''?>
                   </span>
          </div>

          <div class="form-group mb-3">
            <input type="submit" 
                   class="btn btn-info"
                   value="Registrarse">
          </div>
        </form>
        <br>
        <a href="<?= site_url('auth/login'); ?>">
          Autenticarse
        </a>
      </div>
    </div>
  </div>

  <script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>