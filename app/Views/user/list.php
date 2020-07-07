<?= $this->extend('layout/templateTables'); ?>
<?= $this->section('content'); ?>
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
          <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
            <i class="nav-icon fas fa-user-plus"></i> Add
          </button>
          <!-- /.card -->

          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Nomer</th>
                    <th>Polres</th>
                    <th>Polsek</th>
                    <th>Direktorat</th>
                    <th>Name</th>
                    <th>Last Login</th>
                    <th>IP Address</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Trident</td>
                    <td>Trident</td>
                    <td>Internet
                      Explorer 4.0
                    </td>
                    <td>Win 95+</td>
                    <td> 4</td>
                    <td>X</td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Nomer</th>
                    <th>Polres</th>
                    <th>Polsek</th>
                    <th>Direktorat</th>
                    <th>Name</th>
                    <th>Last Login</th>
                    <th>IP Address</th>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?= $mtitle; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- form start -->
      <form role="form">
        <div class="modal-body">

          <div class="card-body">
            <div class="form-group">
              <label>Polda</label>
              <select class="form-control select2" style="width: 100%;">
                <option selected="selected">Select</option>
                <option>Alaska</option>
                <option>California</option>
                <option>Delaware</option>
                <option>Tennessee</option>
                <option>Texas</option>
                <option>Washington</option>
              </select>
            </div>

            <div class="form-group">
              <label>Polres</label>
              <select class="form-control select2" style="width: 100%;">
                <option selected="selected">Select</option>
                <option>Alaska</option>
                <option>California</option>
                <option>Delaware</option>
                <option>Tennessee</option>
                <option>Texas</option>
                <option>Washington</option>
              </select>
            </div>

            <div class="form-group">
              <label>Polsek</label>
              <select class="form-control select2" style="width: 100%;">
                <option selected="selected">Select</option>
                <option>Alaska</option>
                <option>California</option>
                <option>Delaware</option>
                <option>Tennessee</option>
                <option>Texas</option>
                <option>Washington</option>
              </select>
            </div>

            <div class="form-group">
              <label for="exampleInputPassword1">Direktorat</label>
              <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Direktorat">
            </div>
            <div class="form-group">
              <label>Level</label>
              <select class="form-control select2" style="width: 100%;">
                <option selected="selected" value="0">Select</option>
                <?php
                foreach ($level as $l) :
                ?>
                  <option value="<?= $l['id']; ?>"><?= $l['level']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword2">Confirm Password</label>
              <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
            </div>


          </div>
          <!-- /.card-body -->

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>