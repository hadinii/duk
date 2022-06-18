<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Tambah Data Pegawai
    </h1>
    <ol class="breadcrumb">

    </ol>
  </section>

  <!-- Main content -->
  <section class="content" style="margin-top: 10px;">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header">
            <!-- <h3 class="box-title"><i class="fa fa-plus"></i> Form Tambah Data Pegawai</h3> -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <?php if (validation_errors()) : ?>
              <div class="alert alert-danger" role="alert">
                <?= validation_errors(); ?>
              </div>
            <?php endif; ?>
            <form class="form-horizontal" method="post" action="">

              <div class="form-group">
                <label class="col-md-2 control-label">NIK</label>
                <div class="col-md-8">
                  <input type="text" name="nik" class="form-control" required autocomplete="off">
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-2 control-label">Nama</label>
                <div class="col-md-8">
                  <input type="text" name="nama" class="form-control" required autocomplete="off">
                </div>
              </div>

							<div class="form-group">
								<label class="col-md-2 control-label">Tanggal Masuk</label>
								<div class="col-md-8">
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input type="text" name="mulai_kerja" class="form-control pull-right" id="datepicker" required autocomplete="off">
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-2 control-label">Jabatan</label>
								<div class="col-md-8">
									<select class="form-control" name="jabatan_id" required autocomplete="off">
										<?php foreach($jabatan as $row) : ?>
											<option value="<?= $row['id_jabatan'] ?>"><?= $row['nama'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>

              <div class="form-group">
                <label class="col-md-2 control-label">Jenis Kelamin</label>
                <div class="col-md-8">
                  <select class="form-control" name="jenis_kelamin" required autocomplete="off">
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-2 control-label">Tempat Lahir</label>
                <div class="col-md-8">
                  <input type="text" name="tempat_lahir" class="form-control" required autocomplete="off">
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-2 control-label">Tanggal Lahir</label>
                <div class="col-md-8">
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="tgl_lahir" class="form-control pull-right" id="datepicker" required autocomplete="off">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-2 control-label">Agama</label>
                <div class="col-md-8">
                  <select class="form-control" name="agama" required autocomplete="off">
                    <option value="Islam">Islam</option>
                    <option value="Protestan">Protestan</option>
                    <option value="Katholik">Katholik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Budha">Budha</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-2 control-label">No. Telepon</label>
                <div class="col-md-8">
                  <input type="text" name="no_telp" class="form-control" required autocomplete="off">
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-2 control-label">Email</label>
                <div class="col-md-8">
                  <input type="email" name="email" class="form-control" required autocomplete="off">
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-2 control-label">Alamat</label>
                <div class="col-md-8">
                  <textarea name="alamat" class="form-control" required autocomplete="off"></textarea>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                  <button type="submit" class="btn btn-success" style="float: right;"> <i class="fa fa-save"></i> Tambah Data</button>
                </div>
              </div>
            </form>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
