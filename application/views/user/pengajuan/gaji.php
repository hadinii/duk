<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Kenaikan Gaji
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
						<!-- <h3 class="box-title"><i class="fa fa-file"></i> Form Pengajuan Kenaikan Gaji</h3> -->
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<?php if (validation_errors()) : ?>
							<div class="alert alert-danger" role="alert">
								<?= validation_errors(); ?>
							</div>
						<?php endif; ?>
						<?php echo form_open_multipart('User/insert_gaji', ['class' => 'form-horizontal']); ?>
						<div class="form-group">
							<label class="col-md-3 control-label">NIK</label>
							<div class="col-md-8">
								<input type="text" name="nik" value="<?= $pegawai['nik']; ?>" class="form-control" readonly required=" ">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label">Nama</label>
							<div class="col-md-8">
								<input type="text" name="nama" value="<?= $pegawai['nama']; ?>" class="form-control" readonly required=" ">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label">Tanggal</label>
							<div class="col-md-8">
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<?php $date = date('Y-m-d'); ?>
									<input type="text" value="<?= $date; ?>" name="tanggal" class="form-control pull-right" id="" required="" readonly>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label">Surat Pernyataan Tanggung Jawab Mutlak</label>
							<div class="col-md-8">
								<input type="file" name="spjtm" class="form-control" required=" ">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label">Surat Perintah Mulai Kerja</label>
							<div class="col-md-8">
								<input type="file" name="spmk" class="form-control" required=" ">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label">Surat Perintah Kerja</label>
							<div class="col-md-8">
								<input type="file" name="spk" class="form-control" required=" ">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label">Surat Penunjukan Penyedia Jasa Lainnya</label>
							<div class="col-md-8">
								<input type="file" name="sppjl" class="form-control" required=" ">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label">Berita Acara Hasil Pengadaan Langsung</label>
							<div class="col-md-8">
								<input type="file" name="bahpl" class="form-control" required=" ">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label">Berita Acara Klarifikasi Teknis Dan Negosiasi Biaya</label>
							<div class="col-md-8">
								<input type="file" name="baktnb" class="form-control" required=" ">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label">Lampiran Berita Acara</label>
							<div class="col-md-8">
								<input type="file" name="lampiran_ba" class="form-control" required=" ">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label">Berita Acara Evaluasi Dokumen Penawaran</label>
							<div class="col-md-8">
								<input type="file" name="baedp" class="form-control" required=" ">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label">Staff Development Program (SDP)</label>
							<div class="col-md-8">
								<input type="file" name="sdp" class="form-control" required=" ">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label">Undangan</label>
							<div class="col-md-8">
								<input type="file" name="undangan" class="form-control" required=" ">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label">Ijazah</label>
							<div class="col-md-8">
								<input type="file" name="ijazah" class="form-control" required=" ">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label">CV</label>
							<div class="col-md-8">
								<input type="file" name="cv" class="form-control" required=" ">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label">Transkrip</label>
							<div class="col-md-8">
								<input type="file" name="transkrip" class="form-control" required=" ">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label">Sertifikat Keahlian</label>
							<div class="col-md-8">
								<input type="file" name="sertifikat_keahlian" class="form-control" required=" ">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-3"></div>
							<div class="col-md-8">
								<button type="submit" name="submit" class="btn btn-success" style="float: right;"> <i class="fa fa-send"></i> Kirim</button>
							</div>
						</div>
						<?php echo form_close(); ?>
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
