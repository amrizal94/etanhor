<?= $this->include('layout/headerTables') ?>

<body class="hold-transition <?= $body; ?>">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <?= $this->include('layout/navbar') ?>
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
  <?= $this->include('layout/tables_js'); ?>
  <!-- AdminLTE for demo purposes -->
  <!-- <script src="/template/dist/js/demo.js"></script> -->
  <!-- Sweet Alert -->
  <script src="/node_modules/sweetalert/dist/sweetalert.min.js"></script>
  <?= $this->include('layout/sweetAlert/logout_js'); ?>
  <script>
    $(document).ready(function() {
      // console.log("ready!");

    });
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      // console.log("ready!");
      $('.alert').hide();
      $('.alert').fadeIn(1000);
      $('.alert').delay(1000).fadeOut(1000);
    });
  </script>
</body>

</html>