  <?= $this->include('layout/header') ?>
  <?= $this->renderSection('content'); ?>
  <?= $this->include('layout/default'); ?>
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