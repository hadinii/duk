<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      DUK Pegawai
    </h1>
    <ol class="breadcrumb">

    </ol>
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
          </ul>
          <div class="tab-content">
            <div class="active tab-pane" id="detail">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <td width="140">NIP</td>
                    <td width="7">:</td>
                    <td><?= $duk['nip']; ?></td>
                  </tr>

                  <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><?= $duk['nama']; ?></td>
                  </tr>

                  <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td><?= $duk['jabatan']; ?></td>
                  </tr>

                  <tr>
                    <td>TMT (Jabatan)</td>
                    <td>:</td>
                    <td><?= $duk['tmt_jabatan']; ?></td>
                  </tr>

                  <?php
                  // Masa Jabatan
                  $tanggal = new DateTime($duk['tmt_jabatan']);
                  // tanggal hari ini
                  $today = new DateTime('today');
                  // tahun
                  $y1 = $today->diff($tanggal)->y;
                  // bulan
                  $m1 = $today->diff($tanggal)->m;
                  // hari
                  $d1 = $today->diff($tanggal)->d;
                  ?>

                  <tr>
                    <td>Masa (Jabatan)</td>
                    <td>:</td>
                    <td><?= $y1 . " tahun " . $m1 . " bulan " . $d1 . " hari"; ?></td>
                  </tr>

                  <tr>
                    <td>Pendidikan</td>
                    <td>:</td>
                    <td><?= $duk['pendidikan']; ?></td>
                  </tr>

                  <tr>
                    <td>Golongan</td>
                    <td>:</td>
                    <td><?= $duk['golongan']; ?></td>
                  </tr>

                  <tr>
                    <td>Pangkat Golongan</td>
                    <td>:</td>
                    <td><?= $duk['pangkat']; ?></td>
                  </tr>

                  <tr>
                    <td>TMT (Pangkat/Golongan)</td>
                    <td>:</td>
                    <td><?= $duk['tmt_pangkat']; ?></td>
                  </tr>

                  <tr>
                    <td>Kenaikan Pangkat/Golongan Selanjutnya</td>
                    <td>:</td>
                    <td><?= $duk['naik_pangkat_yad']; ?></td>
                  </tr>

                  <?php
                  // tanggal lahir
                  $tanggal = new DateTime($duk['tmt_pangkat']);
                  // tanggal hari ini
                  $today = new DateTime('today');
                  // tahun
                  $y2 = $today->diff($tanggal)->y;
                  // bulan
                  $m2 = $today->diff($tanggal)->m;
                  // hari
                  $d2 = $today->diff($tanggal)->d;
                  ?>

                  <tr>
                    <td>Masa (Pangkat/Golongan)</td>
                    <td>:</td>
                    <td><?= $y2 . " tahun " . $m2 . " bulan " . $d2 . " hari"; ?></td>
                  </tr>

                  <tr>
                    <td>Kenainakan Gaji Berkala Selanjutnya</td>
                    <td>:</td>
                    <td><?= $duk['naik_gaji_yad']; ?></td>
                  </tr>

                  <tr>
                    <td>Masa Kerja Golongan (Tahun)</td>
                    <td>:</td>
                    <td><?= $duk['masa_kerja_golongan']; ?></td>
                  </tr>

                  <tr>
                    <td>Keterangan</td>
                    <td>:</td>
                    <td><?= $duk['keterangan']; ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="edit">
              <form class="form-horizontal" method="post" action="">
                <input type="hidden" value="<?= $pegawai['id_pegawai']; ?>" name="id">
                <input type="hidden" value="<?= $pegawai['nip']; ?>" name="nip1">
                <div class="form-group">
                  <label class="col-md-2 control-label">NIP</label>
                  <div class="col-md-9">
                    <input type="text" name="nip" value="<?= $duk['nip']; ?>" class="form-control" required="" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-2 control-label">Nama</label>
                  <div class="col-md-9">
                    <input type="text" name="nama" value="<?= $duk['nama']; ?>" class="form-control" required readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-2 control-label">Jabatan</label>
                  <div class="col-md-9">
                    <input type="text" name="jabatan" value="<?= $duk['jabatan']; ?>" class="form-control" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-2 control-label">TMT (Jabatan)</label>
                  <div class="col-md-9">
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" value="<?= $duk['tmt_jabatan']; ?>" name="tmt_jabatan" class="form-control pull-right" id="datepicker1" required="">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-2 control-label">Pendidikan</label>
                  <div class="col-md-9">
                    <select class="form-control" name="pendidikan" required>
                      <?php foreach ($pendidikan as $pd) : ?>
                        <?php if ($pd == $duk['pendidikan']) : ?>
                          <option value="<?= $pd; ?>" selected><?= $pd; ?></option>
                        <?php else : ?>
                          <option value="<?= $pd; ?>"><?= $pd; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-2 control-label">Golongan</label>
                  <div class="col-md-9">
                    <select class="form-control" name="golongan" required>
                      <?php foreach ($gol as $g) : ?>
                        <?php if ($g == $duk['golongan']) : ?>
                          <option value="<?= $g; ?>" selected><?= $g; ?></option>
                        <?php else : ?>
                          <option value="<?= $g; ?>"><?= $g; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-2 control-label">Pangkat</label>
                  <div class="col-md-9">
                    <select class="form-control" name="pangkat" required>
                      <?php foreach ($pangkat as $p) : ?>
                        <?php if ($p == $duk['pangkat']) : ?>
                          <option value="<?= $p; ?>" selected><?= $p; ?></option>
                        <?php else : ?>
                          <option value="<?= $p; ?>"><?= $p; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-2 control-label">TMT (Pangkat/Golongan)</label>
                  <div class="col-md-9">
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" value="<?= $duk['tmt_pangkat']; ?>" name="tmt_pangkat" class="form-control pull-right" id="datepicker" required="">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-2 control-label">Kenaikan Pangkat/Golongan Selanjutnya</label>
                  <div class="col-md-9">
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" value="<?= $duk['naik_pangkat_yad']; ?>" name="naik_pangkat" class="form-control pull-right" id="datepicker2" required="">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-2 control-label">Kenaikan Gaji Berkala Selanjutnya</label>
                  <div class="col-md-9">
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" value="<?= $duk['naik_gaji_yad']; ?>" name="naik_gaji" class="form-control pull-right" id="datepicker3" required="">
                    </div>
                  </div>
                </div>

                <!-- Masa Kerja Golongan (Tahun) -->
                <div class="form-group">
                  <label class="col-md-2 control-label">Masa Kerja Golongan (Tahun)</label>
                  <div class="col-md-9">
                    <input type="text" name="mkgt" class="form-control" value="<?= $duk['masa_kerja_golongan'] ?>" required>
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-md-2 control-label">Keterangan</label>
                  <div class="col-md-9">
                    <input type="text" name="ket" value="<?= $duk['keterangan']; ?>" class="form-control">
                  </div>
                </div>

                <div class="form-group">
                  <!-- <div class="col-md-2"></div> -->
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" style="float: right;"> <i class="fa fa-save"></i> Perbarui Data</button>
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
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->