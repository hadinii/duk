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
				<!-- <?php var_dump($gaji) ?> -->
				<div class="col-md-<?= $gaji['is_increment'] ? '6' : '12'?>">
					<div class="box box-success">
						<div class="box-header with-border">
							<h3 class="box-title">Jabatan</h3>
						</div>
						<div class="box-body">
							<input type="hidden" name="id_jabatan" value="<?= $gaji['id_jabatan']; ?>">
	
							<div class="form-group">
									<label class="col-md-3 control-label">Jabatan</label>
									<div class="col-md-8">
										<input type="text" name="jabatan" class="form-control" value="<?= $gaji['nama']; ?>" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Keterangan</label>
									<div class="col-md-8">
										<textarea type="text" name="keterangan" class="form-control"><?= $gaji['keterangan']; ?></textarea>
									</div>
								</div>
	
								<div class="form-group" id="gaji-pokok">
									<label class="col-md-3 control-label">Gaji Default</label>
									<div class="col-md-8">
										<input type="number" name="gaji_default" class="form-control" value="<?= $gaji['gaji_default']; ?>">
									</div>
								</div>
	
								<div class="form-group">
									<label class="col-md-3 control-label">Berjenjang</label>
									<div class="col-md-8 checkbox">
										<label>
											<input type="checkbox" name="is_increment" id="is_increment"  <?= $gaji['is_increment'] ? 'checked' : '' ?> <?= $gaji['gaji'] ? 'disabled' : '' ?>>
										</label>
									</div>
								</div>
	
								<div class="form-group">
									<div class="col-md-3"></div>
									<div class="col-md-8">
										<button type="submit" class="btn btn-success" style="float: right;"> <i class="fa fa-save"></i> Simpan Data</button>
									</div>
								</div>
						</div>
							<!-- /.box-body -->
					</div>
				</div>
	
				<?php if( $gaji['is_increment']) : ?>
					<div class="col-md-6">
						<div class="box box-success" id="box-jenjang">
							<div class="box-header with-border">
								<h3 class="box-title">Jenjang Jabatan</h3>
								<div class="box-tools pull-right">
									<button type="button" id="btn-tambah-jenjang" class="btn btn-box-tool btn-success text-white" title="Tambah Jenjang" data-toggle="modal" data-target="#modal-create-edit"><i class="fa fa-plus "></i></button>
								</div>
							</div>
							<div class="box-body">
								<table id="example1" class="table table-bordered table-hover">
									<thead>
										<tr>
										<th width="10">#</th>
										<th style="text-align: center;">Masa Kerja</th>
										<th style="text-align: center;">Gaji Pokok</th>
										<th class="text-center" width="90">Menu</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1; ?>
										<?php foreach ($gaji['gaji'] as $row) : ?>
										<tr>
											<td><?= $i; ?></td>
											<td><?= "{$row['condition']} {$row['masa_kerja']} Tahun" ?></td>
											<td>Rp.<?= nominal($row['gaji_pokok']); ?></td>
											<td style="text-align: center;">
												<a href="javascript:void(0)" class="btn btn-warning btn-edit" data-id='<?= json_encode($row) ?>'><i class="fa fa-edit"></i></a>
												<a href="<?= base_url('gaji/destroy/'.$row['id_gaji']); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="btn btn-danger"><i class="fa fa-trash"></i></a>
											</td>
										</tr>
										<?php $i++; ?>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
							<!-- <div class="row" id="container-jenjang">
								<?php foreach($gaji['gaji'] as $i => $row_gaji) :?>
								<div class="box-body">
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
							</div> -->
						</div>
					</div>
				<?php endif; ?>
			</form>
		</div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<div class="modal fade in" id="modal-create-edit" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Jenjang Jabatan</h4>
			</div>
			<form id="form-create-edit" action="<?= base_url('gaji/store/'.$gaji['id_jabatan']); ?>" method="post" class="form-horizontal">
				<div class="modal-body">
					<input type="hidden" name="id_gaji" value="">
					<div class="form-group">
						<label class="col-md-3 control-label">Kondisi</label>
						<div class="col-md-8">
							<select name="condition" id="condition" class="form-control" required>
								<option value=">">Lebih dari (>)</option>
								<option value="<">Kurang dari (<)</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Masa Kerja</label>
						<div class="col-md-8">
							<input type="number" name="masa_kerja" class="form-control" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Gaji Pokok</label>
						<div class="col-md-8">
							<input type="number" name="gaji_pokok" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-success" style="float: right;"> <i class="fa fa-save"></i> Simpan Data</button>
				</div>
			</form>
		</div>
	</div>
</div>
