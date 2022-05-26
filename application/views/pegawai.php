<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Pegawai
    </h1>
    <ol class="breadcrumb">
      <a href="<?= base_url(); ?>tambah_pegawai" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Data</a>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" style="margin-top: 10px;">
    <div class="row mt-3">
      <div class="col-xs-12">

        <?php if ($this->session->flashdata('pegawai')) : ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            Data pegawai <strong>berhasil</strong> <?= $this->session->flashdata('pegawai'); ?>
          </div>
        <?php endif; ?>

      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-body" style="overflow: auto;">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th width="10">#</th>
                  <th style="text-align: center;">NIP</th>
                  <th style="text-align: center;">Nama</th>
                  <th style="text-align: center;">Jenis Kelamin</th>
                  <th style="text-align: center;">Tempat Lahir</th>
                  <th style="text-align: center;">Tanggal Lahir</th>
                  <th style="text-align: center;">Email</th>
                  <th class="text-center" width="90">Menu</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($pegawai as $pgw) : ?>
                  <tr>
                    <td><?= $i; ?></td>
                    <td><?= $pgw['nip']; ?></td>
                    <td><?= $pgw['nama']; ?></td>
                    <td><?= $pgw['jenis_kelamin']; ?></td>
                    <td><?= $pgw['tempat_lahir']; ?></td>
                    <td><?= mediumdate_indo($pgw['tgl_lahir']); ?></td>
                    <td><?= $pgw['email']; ?></td>
                    <td style="text-align: center;">
                      <a href="<?= base_url(); ?>detailPegawai/<?= $pgw['id_pegawai']; ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                      <a href="<?= base_url(); ?>hapusPegawai/<?= $pgw['nip']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                  <?php $i++; ?>
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