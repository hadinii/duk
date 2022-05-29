  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Detail Data Pegawai
        <small>

        </small>
        <!-- </h1>
      <ol class="breadcrumb">
        <button class="btn btn-success"> <i class="fa fa-user"></i> NIP. <?= $pegawai['nip']; ?></button>
        <a href="<?= base_url(); ?>pegawai" class="btn bg-navy"> <i class="fa fa-angle-double-left"></i> Kembali</a>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content" style="margin-top: 10px;">
      <?php if (validation_errors()) : ?>
        <div class="alert alert-danger" role="alert">
          <?= validation_errors(); ?>
        </div>
      <?php endif; ?>
      <div class="row">
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#detail" data-toggle="tab"><i class="fa fa-eye"></i> Detail</a></li>
              <li><a href="#edit" data-toggle="tab"><i class="fa fa-edit"></i> Edit</a></li>
              <li><a href="#pengaturan" data-toggle="tab"><i class="fa fa-gears"></i> Pengaturan</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="detail">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                      <td width="140">NIK</td>
                      <td width="7">:</td>
                      <td><?= $pegawai['nik']; ?></td>
                    </tr>

                    <tr>
                      <td>Nama</td>
                      <td>:</td>
                      <td><?= $pegawai['nama']; ?></td>
                    </tr>
                    </tr>

                    <tr>
                      <td>Jabatan</td>
                      <td>:</td>
                      <td><?= $pegawai['jabatan']; ?></td>
                    </tr>

                    <tr>
                      <td>Jenis Kelamin</td>
                      <td>:</td>
                      <td><?= $pegawai['jenis_kelamin']; ?></td>
                    </tr>

                    <tr>
                      <td>Tempat Lahir</td>
                      <td>:</td>
                      <td><?= $pegawai['tempat_lahir']; ?></td>
                    </tr>

                    <tr>
                      <td>Tanggal Lahir</td>
                      <td>:</td>
                      <td><?= date_indo($pegawai['tgl_lahir']); ?></td>
                    </tr>
                    <tr>
                      <td>Masa Kerja</td>
                      <td>:</td>
                      <td><?= getMasaKerja($pegawai['mulai_kerja']) ?></td>
                    </tr>

                    <!-- <tr>
                      <td>Golongan Darah</td>
                      <td>:</td>
                      <td><?= $pegawai['golongan_darah']; ?></td>
                    </tr> -->

                    <tr>
                      <td>Agama</td>
                      <td>:</td>
                      <td><?= $pegawai['agama']; ?></td>
                    </tr>

                    <tr>
                      <td>No Telp</td>
                      <td>:</td>
                      <td><?= $pegawai['no_telp']; ?></td>
                    </tr>

                    <tr>
                      <td>Email</td>
                      <td>:</td>
                      <td><?= $pegawai['email']; ?></td>
                    </tr>

                    <tr>
                      <td>Alamat</td>
                      <td>:</td>
                      <td><?= $pegawai['alamat']; ?></td>
                    </tr>

                  </tbody>
                </table>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="edit">
                <form class="form-horizontal" method="post" action="">
                  <input type="hidden" value="<?= $pegawai['id_pegawai']; ?>" name="id">
                  <div class="form-group">
                    <label class="col-md-2 control-label">NIK</label>
                    <div class="col-md-8">
                      <input type="text" name="nik" value="<?= $pegawai['nik']; ?>" class="form-control" required readonly>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-2 control-label">Nama</label>
                    <div class="col-md-8">
                      <input type="text" name="nama" value="<?= $pegawai['nama']; ?>" class="form-control" required>
                    </div>
                  </div>

									<div class="form-group">
										<label class="col-md-2 control-label">Jabatan</label>
										<div class="col-md-8">
											<select class="form-control" name="jabatan_id" required>
												<?php foreach($jabatan as $row) : ?>
													<option value="<?= $row['id_jabatan'] ?>" <?= $row['id_jabatan'] == $pegawai['jabatan_id'] ? 'selected' : '' ?>><?= $row['nama'] ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>

                  <div class="form-group">
                    <label class="col-md-2 control-label">Jenis Kelamin</label>
                    <div class="col-md-8">
                      <select class="form-control" name="jenis_kelamin" required>
                        <?php foreach ($jk as $j) : ?>
                          <?php if ($j == $pegawai['jenis_kelamin']) : ?>
                            <option value="<?= $j; ?>" selected><?= $j; ?></option>
                          <?php else : ?>
                            <option value="<?= $j; ?>"><?= $j; ?></option>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-2 control-label">Tempat Lahir</label>
                    <div class="col-md-8">
                      <input type="text" value="<?= $pegawai['tempat_lahir']; ?>" name="tempat_lahir" class="form-control" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-2 control-label">Tanggal Lahir</label>
                    <div class="col-md-8">
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" value="<?= $pegawai['tgl_lahir']; ?>" name="tgl_lahir" class="form-control pull-right" id="datepicker" required="">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-2 control-label">Agama</label>
                    <div class="col-md-8">
                      <select class="form-control" name="agama" required>
                        <?php foreach ($agama as $a) : ?>
                          <?php if ($a == $pegawai['agama']) : ?>
                            <option value="<?= $a; ?>" selected><?= $a; ?></option>
                          <?php else : ?>
                            <option value="<?= $a; ?>"><?= $a; ?></option>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-2 control-label">No. Telepon</label>
                    <div class="col-md-8">
                      <input type="text" name="no_telp" value="<?= $pegawai['no_telp']; ?>" class="form-control" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-2 control-label">Email</label>
                    <div class="col-md-8">
                      <input type="email" name="email" value="<?= $pegawai['email']; ?>" class="form-control" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-2 control-label">Alamat</label>
                    <div class="col-md-8">
                      <input type="text" name="alamat" value="<?= $pegawai['alamat']; ?>" class="form-control" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                      <button type="submit" class="btn btn-success" style="float: right;"> <i class="fa fa-save"></i> Simpan Perubahan</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="pengaturan">
                <form method="post" action="<?= base_url(); ?>pegawai/resetPassword">
                  <div class="form-group">
                    <label>Reset Password</label>
                    <input type="hidden" value="<?= $pegawai['nik'] ?>" name="nik">
                    <br>
                    <button class="btn btn-success" type="submit"><i class="fa fa-key"></i> Reset</button>
                    <span class="help-block">Reset Password menjadi NIP pegawai</span>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->

            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
