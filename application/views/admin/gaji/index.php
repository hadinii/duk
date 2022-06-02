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
        <?php if ($this->session->flashdata('notification')) : ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            Data gaji <strong>berhasil</strong> <?= $this->session->flashdata('notification'); ?>
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
                  <th style="text-align: center;">Jabatan</th>
                  <th style="text-align: center;">Gaji Pokok</th>
                  <th class="text-center" width="90">Menu</th>
                </tr>
              </thead>
              <tbody>
								<?php $i = 1; ?>
                <?php foreach ($jabatan as $row) : ?>
										<?php $numbers = array_column($row['gaji'], 'gaji_pokok'); array_push($numbers, $row['gaji_default']) ?>
										<tr>
											<td><?= $i++; ?></td>
											<td><?= $row['nama']; ?></td>
											<td>Rp <?= count($numbers) > 1 ? nominal(min($numbers))." - ".nominal(max($numbers)) : nominal(min($numbers)) ?></td>
											<td style="text-align: center;">
												<a href="<?= base_url('gaji/'.$row['id_jabatan']); ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
												<a href="<?= base_url('destroy/'.$row['id_jabatan']); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
