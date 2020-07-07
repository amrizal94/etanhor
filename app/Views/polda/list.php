<?= $this->extend('layout/templatePolda'); ?>
<?= $this->section('content'); ?>
<?php
$message = session()->getFlashdata('message');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?= $title; ?></h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#poldaAdd">
            <i class="far fa-plus-square"></i> Add
          </button>
          <!-- /.card -->

          <div class="card">
            <!-- /.card-header -->
            <?= $message; ?>
            <div class="card-body">

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Nomer</th>
                    <th><?= $title; ?></th>
                    <th>#</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  foreach ($data as $d) :
                  ?>
                    <tr>
                      <td><?= $i++; ?></td>
                      <td><?= $d['nama_polda']; ?></td>
                      <td>
                        <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#poldaEdit<?= $d['id_polda']; ?>">Edit</button>
                        <form action="/polda/<?= $d['id_polda']; ?>" method="POST" class="d-inline">
                          <input type="hidden" name="_method" value="DELETE">
                          <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure to delete?')">Hapus</button>
                        </form>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Nomer</th>
                    <th><?= $title; ?></th>
                    <th>#</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- Modal -->
<div class="modal fade" id="poldaAdd" tabindex="-1" role="dialog" aria-labelledby="poldaAddLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="poldaAddLabel"><?= $mtitleAdd; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- form start -->
      <form role="form" method="POST" action="/Polda/save">
        <?= csrf_field(); ?>

        <div class="modal-body">

          <div class="card-body">

            <div class="form-group">
              <label for="<?= $title; ?>"><?= $title; ?></label>
              <input type="text" class="form-control" name="<?= strtolower($title); ?>" id="<?= strtolower($title); ?>" placeholder="<?= $title; ?>">
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="addpolda" class="btn btn-primary">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
$i = 1;
foreach ($data as $d) :
?>
  <div class="modal fade" id="poldaEdit<?= $d['id_polda']; ?>" tabindex="-1" role="dialog" aria-labelledby="poldaEditLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="poldaEditLabel"><?= $mtitleEdit; ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- form start -->
        <form role="form" method="POST" action="/Polda/save">
          <?= csrf_field(); ?>
          <input type="hidden" name="id_polda" value="<?= $d['id_polda']; ?>">
          <div class="modal-body">

            <div class="card-body">

              <div class="form-group">
                <label for="<?= $title; ?>"><?= $title; ?></label>
                <input type="text" class="form-control" value="<?= $d['nama_polda']; ?>" name="<?= strtolower($title); ?>" id="<?= strtolower($title); ?>" placeholder="<?= $title; ?>">
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="editpolda" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>
<?= $this->endSection(); ?>