<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Gaji
    </h1>
    <ol class="breadcrumb">
      <a href="<?= base_url() ?>tambah_gaji" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Data</a>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" style="margin-top: 10px;">
    <div class="row mt-3">
      <div class="col-xs-12">
        <?php if ($this->session->flashdata('gaji')) : ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            Data gaji <strong>berhasil</strong> <?= $this->session->flashdata('gaji'); ?>
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
                  <th style="text-align: center;">Golongan</th>
                  <th style="text-align: center;">Masa Kerja</th>
                  <th style="text-align: center;">Gaji Pokok</th>
                  <th class="text-center" width="90">Menu</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($gaji as $g) : ?>
                  <tr>
                    <td><?= $g['golongan']; ?><?= $g['masa_kerja']; ?></td>
                    <td><?= $g['masa_kerja']; ?></td>
                    <td>Rp <?= nominal($g['gaji_pokok']); ?></td>
                    <td style="text-align: center;">
                      <a href="<?= base_url(); ?>detailGaji/<?= $g['id_gaji']; ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                      <a href="<?= base_url(); ?>hapusGaji/<?= $g['id_gaji']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
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
<!-- /.content-wrapper -->