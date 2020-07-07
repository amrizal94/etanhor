<script>
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
            buttons: false
          });
          setTimeout(function() {
            document.location.href = "<?= '/logout'; ?>";
          }, 1000)
        }
      });
  });
</script>