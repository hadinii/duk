<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Data Gaji Pegawai
    </h1>
    <ol class="breadcrumb">
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" style="margin-top: 10px;">
    <div class="row">
      <div class="col-xs-12">
				<form class="form-horizontal" method="post" action="">
        	<div class="box box-success">
						<div class="box-header with-border">
							<h3 class="box-title">Jabatan</h3>
						</div>
          	<div class="box-body">
              <input type="hidden" name="id_jabatan" value="<?= $gaji['id_jabatan']; ?>">
              
							<div class="form-group">
									<label class="col-md-2 control-label">Jabatan</label>
									<div class="col-md-8">
										<input type="text" name="nama" class="form-control" value="<?= $gaji['nama']; ?>" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-2 control-label">Keterangan</label>
									<div class="col-md-8">
										<textarea type="text" name="keterangan" class="form-control"><?= $gaji['keterangan']; ?></textarea>
									</div>
								</div>

								<div class="form-group" id="gaji-pokok">
									<label class="col-md-2 control-label">Gaji Default</label>
									<div class="col-md-8">
										<input type="number" name="gaji_default" class="form-control" value="<?= $gaji['gaji_default']; ?>">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-2 control-label">Berjenjang</label>
									<div class="col-md-8 checkbox">
										<label>
											<input type="checkbox" name="is_increment" id="is_increment"  <?= $gaji['is_increment'] ? 'checked' : '' ?>>
										</label>
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-2"></div>
									<div class="col-md-8">
										<button type="submit" class="btn btn-success" style="float: right;"> <i class="fa fa-save"></i> Simpan Data</button>
									</div>
								</div>
						</div>
						<!-- /.box-body -->
					</div>

					<?php if($gaji['gaji']) : ?>
						<div class="box box-success" id="box-jenjang">
							<div class="box-header with-border">
								<h3 class="box-title">Jenjang Jabatan</h3>
								<div class="box-tools pull-right">
									<button type="button" id="btn-tambah-jenjang" class="btn btn-box-tool btn-success text-white" title="Tambah Jenjang"><i class="fa fa-plus "></i></button>
								</div>
							</div>
							<div class="row" id="container-jenjang">
								<?php foreach($gaji['gaji'] as $i => $row_gaji) :?>
								<div class="box-body">
										<!-- <?= var_dump($row_gaji['condition'] == '<') ?> -->
										<input type="hidden" name="id_gaji[]" value="<?= $row_gaji['id_gaji'] ?>">
										<div class="form-group">
											<label class="col-md-2 control-label">Kondisi</label>
											<div class="col-md-8">
												<select name="condition[<?=$i?>]" id="condition[<?=$i?>]" class="form-control" required>
													<option value=">" <?= $row_gaji['condition'] == '>' ? 'selected' : '' ?>>Lebih dari (>)</option>
													<option value="<" <?= $row_gaji['condition'] == '<' ? 'selected' : '' ?>>Kurang dari (<)</option>
													<option value="=" <?= $row_gaji['condition'] == '=' ? 'selected' : '' ?>>Sama dengan (=)</option>
													<option value="Range" <?= $row_gaji['condition'] == 'Range' ? 'selected' : '' ?>>Range</option>
												</select>
											</div>
											<div class="col-md-2">
												<button type="button" id="btn-hapus-jenjang" class="btn btn-box-tool btn-danger text-white" title="Hapus Jenjang"><i class="fa fa-minus"></i></button>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Masa Kerja</label>
											<div class="col-md-8">
												<input type="number" name="masa_kerja[<?=$i?>]" class="form-control" value="<?= $row_gaji['masa_kerja'] ?>" required>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Gaji Pokok</label>
											<div class="col-md-8">
												<input type="number" name="gaji_pokok[<?=$i?>]" class="form-control" value="<?= $row_gaji['gaji_pokok'] ?>" required>
											</div>
										</div>
								</div>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>
				</form>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
