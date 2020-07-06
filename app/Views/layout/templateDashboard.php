<?= $this->include('layout/header') ?>

<body class="hold-transition <?= $body; ?>">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <?= $this->include('layout/navbar') ?>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->

    <?= $this->include('layout/sidebar') ?>
    <?= $this->renderSection('content'); ?>

    <?= $this->include('layout/footer') ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <?= $this->include('layout/default'); ?>
  <!-- AdminLTE for demo purposes -->
  <!-- <script src="/template/dist/js/demo.js"></script> -->
  <!-- Sweet Alert -->
  <script src="/node_modules/sweetalert/dist/sweetalert.min.js"></script>
  <?= $this->include('layout/logout_js'); ?>
  <script>
    $(document).ready(function() {
      // console.log("ready!");
    });
  </script>
</body>

</html>