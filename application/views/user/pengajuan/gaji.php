<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Kenaikan Gaji
		</h1>
		<p class="help-block">Upload berkas untuk pengajuan kenaikan gaji. Silahkan upload ulang berkas apabila terjadi kesalahan upload. Kemudian tunggu admin untuk menerima permohonan.</p>
	</section>

	<!-- Main content -->
	<section class="content" style="margin-top: 10px;">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-success">
					<div class="box-header">
						<!-- <h3 class="box-title"><i class="fa fa-file"></i> Berkas Kenaikan Gaji</h3> -->
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<?php if (validation_errors()) : ?>
							<div class="alert alert-danger" role="alert">
								<?= validation_errors(); ?>
							</div>
						<?php endif; ?>
						<?php echo form_open_multipart('User/insert_gaji/'.$pengajuan['id_pengajuan'], ['class' => 'form-horizontal']); ?>
						<!-- <?php var_dump($pengajuan) ?> -->
						<input type="hidden" name="id_pengajuan" value="<?= $pengajuan['id_pengajuan'] ?>">
						<div class="form-group">
							<label class="col-md-3 control-label">NIK</label>
							<div class="col-md-8">
								<input type="text" value="<?= $pegawai['nik']; ?>" class="form-control" readonly>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label">Nama</label>
							<div class="col-md-8">
								<input type="text" value="<?= $pegawai['nama']; ?>" class="form-control" readonly>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label">Tanggal</label>
							<div class="col-md-8">
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" value="<?= $pengajuan['created_at']; ?>" class="form-control pull-right" readonly>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Surat Pernyataan Tanggung Jawab Mutlak</label>
							<div class="col-md-8">
								<div class="input-group">
									<input type="file" name="spjtm" class="form-control" <?= empty($pengajuan['spjtm']) ? 'required' : '' ?>>
									<div class="input-group-btn">
										<?php if (!empty($pengajuan['spjtm'])) : ?>
											<a href="<?= site_url("./assets/pengajuan/{$pengajuan['id_pengajuan']}/{$pengajuan['spjtm']}") ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label">Surat Perintah Mulai Kerja</label>
							<div class="col-md-8">
							<div class="input-group">
									<input type="file" name="spmk" class="form-control" <?= empty($pengajuan['spmk']) ? 'required' : '' ?>>
									<div class="input-group-btn">
										<?php if (!empty($pengajuan['spmk'])) : ?>
											<a href="<?= site_url("./assets/pengajuan/{$pengajuan['id_pengajuan']}/{$pengajuan['spmk']}") ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label">Surat Perintah Kerja</label>
							<div class="col-md-8">
								<div class="input-group">
									<input type="file" name="spk" class="form-control" <?= empty($pengajuan['spk']) ? 'required' : '' ?>>
									<div class="input-group-btn">
										<?php if (!empty($pengajuan['spk'])) : ?>
											<a href="<?= site_url("./assets/pengajuan/{$pengajuan['id_pengajuan']}/{$pengajuan['spk']}") ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label">Surat Penunjukan Penyedia Jasa Lainnya</label>
							<div class="col-md-8">
							<div class="input-group">
									<input type="file" name="sppjl" class="form-control" <?= empty($pengajuan['sppjl']) ? 'required' : '' ?>>
									<div class="input-group-btn">
										<?php if (!empty($pengajuan['sppjl'])) : ?>
											<a href="<?= site_url("./assets/pengajuan/{$pengajuan['id_pengajuan']}/{$pengajuan['sppjl']}") ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label">Berita Acara Hasil Pengadaan Langsung</label>
							<div class="col-md-8">
								<div class="input-group">
									<input type="file" name="bahpl" class="form-control" <?= empty($pengajuan['bahpl']) ? 'required' : '' ?>>
									<div class="input-group-btn">
										<?php if (!empty($pengajuan['bahpl'])) : ?>
											<a href="<?= site_url("./assets/pengajuan/{$pengajuan['id_pengajuan']}/{$pengajuan['bahpl']}") ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label">Berita Acara Klarifikasi Teknis Dan Negosiasi Biaya</label>
							<div class="col-md-8">
								<div class="input-group">
									<input type="file" name="baktnb" class="form-control" <?= empty($pengajuan['baktnb']) ? 'required' : '' ?>>
									<div class="input-group-btn">
										<?php if (!empty($pengajuan['baktnb'])) : ?>
											<a href="<?= site_url("./assets/pengajuan/{$pengajuan['id_pengajuan']}/{$pengajuan['baktnb']}") ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label">Lampiran Berita Acara</label>
							<div class="col-md-8">
								<div class="input-group">
									<input type="file" name="lampiran_ba" class="form-control" <?= empty($pengajuan['lampiran_ba']) ? 'required' : '' ?>>
									<div class="input-group-btn">
										<?php if (!empty($pengajuan['lampiran_ba'])) : ?>
											<a href="<?= site_url("./assets/pengajuan/{$pengajuan['id_pengajuan']}/{$pengajuan['lampiran_ba']}") ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label">Berita Acara Evaluasi Dokumen Penawaran</label>
							<div class="col-md-8">
								<div class="input-group">
									<input type="file" name="baedp" class="form-control" <?= empty($pengajuan['baedp']) ? 'required' : '' ?>>
									<div class="input-group-btn">
										<?php if (!empty($pengajuan['baedp'])) : ?>
											<a href="<?= site_url("./assets/pengajuan/{$pengajuan['id_pengajuan']}/{$pengajuan['baedp']}") ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label">Staff Development Program (SDP)</label>
							<div class="col-md-8">
								<div class="input-group">
									<input type="file" name="sdp" class="form-control" <?= empty($pengajuan['sdp']) ? 'required' : '' ?>>
									<div class="input-group-btn">
										<?php if (!empty($pengajuan['sdp'])) : ?>
											<a href="<?= site_url("./assets/pengajuan/{$pengajuan['id_pengajuan']}/{$pengajuan['sdp']}") ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label">Undangan</label>
							<div class="col-md-8">
								<div class="input-group">
									<input type="file" name="undangan" class="form-control" <?= empty($pengajuan['undangan']) ? 'required' : '' ?>>
									<div class="input-group-btn">
										<?php if (!empty($pengajuan['undangan'])) : ?>
											<a href="<?= site_url("./assets/pengajuan/{$pengajuan['id_pengajuan']}/{$pengajuan['undangan']}") ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label">Ijazah</label>
							<div class="col-md-8">
								<div class="input-group">
									<input type="file" name="ijazah" class="form-control" <?= empty($pengajuan['ijazah']) ? 'required' : '' ?>>
									<div class="input-group-btn">
										<?php if (!empty($pengajuan['ijazah'])) : ?>
											<a href="<?= site_url("./assets/pengajuan/{$pengajuan['id_pengajuan']}/{$pengajuan['ijazah']}") ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label">CV</label>
							<div class="col-md-8">
								<div class="input-group">
									<input type="file" name="cv" class="form-control" <?= empty($pengajuan['cv']) ? 'required' : '' ?>>
									<div class="input-group-btn">
										<?php if (!empty($pengajuan['cv'])) : ?>
											<a href="<?= site_url("./assets/pengajuan/{$pengajuan['id_pengajuan']}/{$pengajuan['cv']}") ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label">Transkrip</label>
							<div class="col-md-8">
								<div class="input-group">
									<input type="file" name="transkrip" class="form-control" <?= empty($pengajuan['transkrip']) ? 'required' : '' ?>>
									<div class="input-group-btn">
										<?php if (!empty($pengajuan['transkrip'])) : ?>
											<a href="<?= site_url("./assets/pengajuan/{$pengajuan['id_pengajuan']}/{$pengajuan['transkrip']}") ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label">Sertifikat Keahlian</label>
							<div class="col-md-8">
								<div class="input-group">
									<input type="file" name="sertifikat_keahlian" class="form-control" <?= empty($pengajuan['sertifikat_keahlian']) ? 'required' : '' ?>>
									<div class="input-group-btn">
										<?php if (!empty($pengajuan['sertifikat_keahlian'])) : ?>
											<a href="<?= site_url("./assets/pengajuan/{$pengajuan['id_pengajuan']}/{$pengajuan['sertifikat_keahlian']}") ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-3"></div>
							<div class="col-md-8">
								<button type="submit" class="btn btn-success" style="float: right;"> <i class="fa fa-send"></i> Kirim</button>
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
