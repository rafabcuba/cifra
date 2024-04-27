<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" sizes="32x32" href="<?= site_url('images/icon.png'); ?>" />
    <title>Autenticarse</title>
    <link rel="stylesheet" href="<?= site_url('css/bootstrap.min.css'); ?>" type="text/css">
    <link rel="stylesheet" href="<?= site_url('fontawesome/css/all.min.css'); ?>" type="text/css">
    <link rel="stylesheet" href="<?= site_url('fontawesome/css/svg-with-js.min.css'); ?>" type="text/css">
    <link rel="stylesheet" href="<?= site_url('css/login.css'); ?>" type="text/css">
  </head>

  <body style="background-image: url('<?= site_url('images/login_background.jpg'); ?>')">
    <div class="container">
      <div class="d-flex justify-content-center h-100">
        <div class="card">
          <div class="card-header text-center">
            <img src="<?= site_url('images/icon.png'); ?>" alt="Indicadores" width="120" height="auto">
            <h3>Ingrese sus credenciales</h3>
          </div>
          <div class="card-body">
            <form action="<?= base_url('auth/loginUser') ?>" method="post">
              <div class="input-group form-group">
                <div class="input-group-prepend mx-2">
                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                    <input type="text" 
                      class="form-control"
                      name="email"
                      value="<?= set_value('email');?>"
                      placeholder="Email"
                      required 
                      autofocus>
              </div>
              
              <div class="input-group form-group">
                <div class="input-group-prepend mx-2">
                  <span class="input-group-text"><i class="fas fa-key"></i></span>
                </div>
                <input type="password" 
                      class="form-control"
                      name="password"
                      value="<?= set_value('password');?>"
                      placeholder="Password"
                      required>
              </div>

              <?= csrf_field(); ?>

              <div class="form-group text-center mt-3">
                  <input type="submit" value="Entrar!" class="btn login_btn">
              </div>

              <!-- <div class="text-white mt-2">
                <label class="text-right">
                  <a href="{{ path('app_forgot_password_request')}}">Olvidé mi contraseña</a>
                </label>
              </div> -->
                        
            </form>
          </div>

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
                  <i class="fas fa-exclamation-triangle"></i>
                  <?=
                    session()->getFlashdata('fail');
                  ?>
              </div>
            <?php
          }
          ?>

          <!-- {% if error %}
              <div class="alert alert-danger"><i class="fas fa-exclamation-triangle"></i> {{ error.messageKey|trans(error.messageData, 'security') }}</div>
          {% endif %} -->
        </div>
      </div>
    </div>

    <script src="<?= site_url('js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= site_url('fontawesome/js/all.min.js'); ?>"></script>
  </body>
</html>