<?= $this->extend('layout/templateAuth'); ?>

<?= $this->section('content'); ?>
<div class="login-box">
  <div class="login-logo">
    <a href="/"><b><?= $title; ?></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <!-- <p class="login-box-msg">Sign in to start your session</p> -->
      <?php
      $inputs = session()->getFlashdata('inputs');
      if (isset($inputs)) $iuser = $inputs;
      $username = session()->getFlashdata('username');
      $password = session()->getFlashdata('password');
      $message = session()->getFlashdata('message');
      session()->destroy();
      ?>

      <?php
      if (isset($message) && !$username && !$password) {
        echo $message;
      }
      ?>
      <form action="/auth" method="post">
        <?= csrf_field(); ?>
        <?= (isset($username)) ? $username : '' ?>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username" value="<?= ($inputs) ? $iuser : '' ?>" <?= (!$inputs) ? 'autofocus' : '' ?>>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <?= (isset($password)) ? $password : '' ?>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" <?= ($inputs) ? 'autofocus' : '' ?>>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <!-- <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div> -->
          </div>
          <div class="col-4">
            <button type="submit" name="signin" class="btn btn-primary btn-block">Sign In</button>
          </div>
        </div>
      </form>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<?= $this->endSection(); ?>