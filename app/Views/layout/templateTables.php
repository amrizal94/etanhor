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
  <!-- DataTables -->
  <script src="/template/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="/template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="/template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="/template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <!-- <script src="/template/dist/js/demo.js"></script> -->
  <!-- Sweet Alert -->
  <script src="/node_modules/sweetalert/dist/sweetalert.min.js"></script>
  <?= $this->include('layout/logout_js'); ?>
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
</body>

</html>