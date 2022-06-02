<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Beranda
    </h1>
  </section>

  <!-- Main content -->
  <section class="content" style="min-height: 600px;">
    <!-- Small boxes (Stat box) -->
    <div class="row">

      <?php
      $i = 0;
      $i1 = 0;
      $thn = date('Y');
      $bln = date('m');
      ?>

      <!-- <?php foreach ($duk as $d) : ?>

        <?php
        $tanggal1 = explode('-', $d['naik_pangkat_yad']);
        $tanggal2 = explode('-', $d['naik_gaji_yad']);
        $y = $thn - $tanggal1[0];
        $m = $bln - $tanggal1[1];
        $y1 = $thn - $tanggal2[0];
        $m1 = $bln - $tanggal2[1];
        ?>

        <?php if ($y == 0 && $m <= 0) : ?>
          <?php $i++; ?>
        <?php endif; ?>

        <?php if ($y1 == 0 && $m1 <= 0) : ?>
          <?php $i1++; ?>
        <?php endif; ?>

      <?php endforeach; ?> -->

      <div class="col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?= count($naik_gaji) ?></h3>
            <p>Pegawai Naik Gaji</p>
          </div>
          <div class="icon">
            <i class="fa fa-calendar-check-o"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->

      <div class="col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?= count($pengajuan); ?></h3>
            <p>Pengajuan Kenaikan</p>
          </div>
          <div class="icon">
            <i class="fa fa-file"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <div class="col-xs-12">
        <div class="box box-succes">
          <div class="box-header">
            <h3 class="box-title">Pegawai Yang Akan Naik Gaji</h3>
          </div>
          <div class="box-body" style="overflow: auto;">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th width="10">#</th>
                  <th style="text-align: center;">NIK</th>
                  <th style="text-align: center;">Nama</th>
                  <th style="text-align: center;">Jabatan</th>
                  <th style="text-align: center;">Tanggal Naik</th>
                  <th class="text-center" width="90">Menu</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($naik_gaji as $row) : ?>
									<?php if(is_null($row['pengajuan']) || !$row['pengajuan']['is_accepted']) : ?>
                    <tr>
                      <td><?= $i; ?></td>
                      <td><?= $row['nik']; ?></td>
                      <td><?= $row['nama']; ?></td>
                      <td><?= $row['jabatan']; ?></td>
                      <td><?= getTanggalNaikGaji($row['mulai_kerja'], $row['jenjang']['masa_kerja']); ?></td>
                      <td style="text-align: center;">
                        <a href="<?= base_url("/pengajuan/{$row['id_pegawai']}/{$row['jenjang']['id_gaji']}"); ?>" class="btn btn-info"><i class="fa fa-eye"></i></a>
                        <a href="<?= base_url(); ?>email/mail/<?= $row['id_pegawai'] ?>/<?= $row['nik'] ?>" class="btn btn-warning"><i class="fa fa-paper-plane"></i></a>
                      </td>
                    </tr>
									<?php endif; ?>
                <?php endforeach; ?>
              </tbody>
            </table>
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
