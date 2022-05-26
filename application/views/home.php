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

      <?php foreach ($duk as $d) : ?>

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

      <?php endforeach; ?>

      <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?= $i; ?></h3>
            <p>Naik Pangkat Tahun <?= date("Y"); ?></p>
          </div>
          <div class="icon">
            <i class="fa fa-calendar-check-o"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->

      <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?= $i1; ?></h3>
            <p>Naik Gaji Tahun <?= date("Y"); ?></p>
          </div>
          <div class="icon">
            <i class="fa fa-calendar-check-o"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->

      <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?= $tot_p; ?></h3>
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
        <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title">Pegawai Yang Akan Naik Pangkat Tahun <?= date("Y"); ?></h3>
          </div>
          <div class="box-body" style="overflow: auto;">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th width="10">#</th>
                  <th style="text-align: center;">NIP</th>
                  <th style="text-align: center;">Nama</th>
                  <th style="text-align: center;">Pangkat/Golongan</th>
                  <th style="text-align: center;">Tanggal Naik</th>
                  <th class="text-center" width="90">Menu</th>
                </tr>
              </thead>
              <tbody>

                <?php $i = 1; ?>
                <?php foreach ($duk as $d) : ?>
                  <?php
                  $tanggal4 = explode('-', $d['naik_pangkat_yad']);
                  $y4 = $thn - $tanggal4[0];
                  $m4 = $bln - $tanggal4[1];
                  ?>
                  <?php if ($y4 == 0 && $m4 <= 0) : ?>

                    <tr>
                      <td><?= $i; ?></td>
                      <td><?= $d['nip']; ?></td>
                      <td><?= $d['nama']; ?></td>
                      <td><?= $d['pangkat']; ?> (<?= $d['golongan']; ?>)</td>
                      <td><?= mediumdate_indo($d['naik_pangkat_yad']); ?></td>
                      <td style="text-align: center;">
                        <a href="<?= base_url(); ?>data_duk/<?= $d['id_duk']; ?>" class="btn btn-info"><i class="fa fa-eye"></i></a>
                        <a href="<?= base_url(); ?>email/mail1/<?= $d['id_duk']; ?>/<?= $d['nip'] ?>" class="btn btn-warning"><i class="fa fa-paper-plane"></i></a>
                      </td>
                    </tr>
                    <?php $i++; ?>
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

    <div class="row">
      <div class="col-xs-12">
        <div class="box box-succes">
          <div class="box-header">
            <h3 class="box-title">Pegawai Yang Akan Naik Gaji Tahun <?= date("Y"); ?></h3>
          </div>
          <div class="box-body" style="overflow: auto;">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th width="10">#</th>
                  <th style="text-align: center;">NIP</th>
                  <th style="text-align: center;">Nama</th>
                  <th style="text-align: center;">Pangkat/Golongan</th>
                  <th style="text-align: center;">Tanggal Naik</th>
                  <th class="text-center" width="90">Menu</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($duk as $d) : ?>
                  <?php
                  $tanggal5 = explode('-', $d['naik_gaji_yad']);
                  $y5 = $thn - $tanggal5[0];
                  $m5 = $bln - $tanggal5[1];
                  ?>
                  <?php
                  if ($y5 == 0 && $m5 <= 0) : ?>
                    <tr>
                      <td><?= $i; ?></td>
                      <td><?= $d['nip']; ?></td>
                      <td><?= $d['nama']; ?></td>
                      <td><?= $d['pangkat']; ?> (<?= $d['golongan']; ?>)</td>
                      <td><?= mediumdate_indo($d['naik_gaji_yad']); ?></td>
                      <td style="text-align: center;">
                        <a href="<?= base_url(); ?>duk/data_duk/<?= $d['id_duk']; ?>" class="btn btn-info"><i class="fa fa-eye"></i></a>
                        <a href="<?= base_url(); ?>email/mail/<?= $d['id_duk'] ?>/<?= $d['nip'] ?>" class="btn btn-warning"><i class="fa fa-paper-plane"></i></a>
                      </td>
                    </tr>
                    <?php $i++; ?>
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