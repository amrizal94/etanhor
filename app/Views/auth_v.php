<?= $this->extend('layout/templateAuth'); ?>

<?= $this->section('content'); ?>
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b><?= $title; ?></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <!-- <p class="login-box-msg">Sign in to start your session</p> -->
      <?php
      $inputs = session()->getFlashdata('inputs');
      if (isset($inputs)) {


        $iuser = $inputs;
      }
      // dd($inputs);
      $username = session()->getFlashdata('username');
      $password = session()->getFlashdata('password');
      $message = session()->getFlashdata('message');

      ?>

      <?php
      if (isset($message)) {
        echo $message;
      }
      ?>
      <form action="auth" method="post">
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
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="signin" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
      <!-- /.social-auth-links -->

      <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<?= $this->endSection(); ?>