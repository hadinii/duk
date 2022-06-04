<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Pengaturan
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-success">
          <?php if (validation_errors()) : ?>
            <div class="alert alert-danger" role="alert">
              <?= validation_errors(); ?>
            </div>
          <?php endif; ?>
					<?php if ($this->session->flashdata('notification')) : ?>	
						<div class="alert alert-<?= $this->session->flashdata('notification')['status'] ?> alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<?= $this->session->flashdata('notification')['message']; ?>
						</div>
					<?php endif; ?>
          <div class="nav-tabs-custom">
            <div class="tab-content">
              <div class="active tab-pane" id="settings">
                <form class="form-horizontal" method="post" action="">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Password Baru</label>
                    <div class="col-sm-8">
                      <input type="password" id="password1" class="form-control" name="pb" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Konfirmasi Password Baru</label>
                    <div class="col-sm-8">
                      <input type="password" id="password2" class="form-control" name="kpb" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-8">
                      <input type="checkbox" onclick="myFunction()"> Tampilkan Password
                    </div>
                  </div>

                  <div class="form-group text-right">
                    <div class="col-sm-offset-2 col-sm-8">
                      <input type="submit" class="btn btn-success" name="pass" value="Ganti Password">
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->

            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
      </div>
      <!-- /.col -->
  </section>
  <!-- <section class="content" style="min-height: 600px;">
      
    </section> -->
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
