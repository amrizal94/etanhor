<?= $this->include('layout/header') ?>

<body class="hold-transition <?= $body; ?>">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->

    <?= $this->include('layout/sidebar') ?>
    <?= $this->renderSection('content'); ?>

    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.0.5
      </div>
      <strong>Copyright &copy; <?= date("Y", now()); ?> <a href="https://lasbontech.co.id/id/"><?= $group; ?></a>.</strong> All rights
      reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <?= $this->include('layout/default'); ?>
  <!-- AdminLTE for demo purposes -->
  <script src="/template/dist/js/demo.js"></script>
  <script src="/node_modules/sweetalert/dist/sweetalert.min.js"></script>
  <script>
    $(document).ready(function() {
      // console.log("ready!");

    });
    $('#logout').click(function() {

      swal({
          title: "Logout",
          text: "Are you sure?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            swal("You have been logged out.", {
              icon: "success",
            });
            setTimeout(function() {
              document.location.href = "<?= '/logout'; ?>";
            }, 1000)
          }
        });
    });
  </script>
</body>

</html>