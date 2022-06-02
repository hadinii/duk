<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Pengajuan Pengawai
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
						<h3 class="box-title">Pegawai</h3>
                    </div>
					<form action="<?= site_url('pengajuan/accept/'.$pengajuan['id_pengajuan']) ?>" method="post" class="form-horizontal">
						<div class="box-body">
							<input type="hidden" name="id_pegawai" value="<?= $pengajuan['id_pegawai'] ?>">
							<input type="hidden" name="id_gaji" value="<?= $pengajuan['gaji_id'] ?>">
							<div class="form-group">
								<label class="col-md-2 control-label">NIK</label>
								<div class="col-md-8">
									<input type="text" name="nik" class="form-control" value="<?= $pengajuan['nik'] ?>" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Nama</label>
								<div class="col-md-8">
									<input type="text" name="nama" class="form-control" value="<?= $pengajuan['nama'] ?>" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Jabatan</label>
								<div class="col-md-8">
									<input type="text" name="jabatan" class="form-control" value="<?= $pengajuan['jabatan'] ?>" readonly>
								</div>
							</div>
							<?php if(!$pengajuan['is_accepted']) : ?>
							<div class="form-group">
								<div class="col-md-10">
									<button type="submit" class="btn btn-success" style="float: right;"> <i class="fa fa-save"></i> Terima Pengajuan</button>
								</div>
							</div>
							<?php endif; ?>
						</div>
					</form>
				</div>
				<div class="box box-success">
                    <div class="box-header">
						<h3 class="box-title">Dokumen Pengajuan</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-hover">
                            <tbody>
                                
                                <tr>
                                    <td>SPJTM</td>
                                    <td>:</td>
                                    <td><?= $pengajuan['spjtm']; ?></td>
                                    <td>
                                        <?php if (!empty($pengajuan['spjtm'])) { ?>
                                            <a href="<?= site_url("./assets/pengajuan/{$pengajuan['id_pengajuan']}/{$pengajuan['spjtm']}") ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
                                        <?php } else { ?>
                                            <p style="color: red;"> <b>Tidak ada</b> </p>
                                        <?php } ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Surat Perintah Mulai Kerja (SPMK)</td>
                                    <td>:</td>
                                    <td><?= $pengajuan['spmk']; ?></td>
                                    <td>
                                        <?php if (!empty($pengajuan['spmk'])) { ?>
                                            <a href="<?= site_url("./assets/pengajuan/{$pengajuan['id_pengajuan']}/{$pengajuan['spmk']}") ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
                                        <?php } else { ?>
                                            <p style="color: red;"> <b>Tidak ada</b> </p>
                                        <?php } ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>SPK</td>
                                    <td>:</td>
                                    <td><?= $pengajuan['spk']; ?></td>
                                    <td>
                                        <?php if (!empty($pengajuan['spk'])) { ?>
                                            <a href="<?= site_url("./assets/pengajuan/{$pengajuan['id_pengajuan']}/{$pengajuan['spk']}") ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
                                        <?php } else { ?>
                                            <p style="color: red;"> <b>Tidak ada</b> </p>
                                        <?php } ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Surat Penunjukan Penyedia Jasa Lainnya</td>
                                    <td>:</td>
                                    <td><?= $pengajuan['sppjl']; ?></td>
                                    <td><?php if (!empty($pengajuan['sppjl'])) { ?>
                                            <a href="<?= site_url("./assets/pengajuan/{$pengajuan['id_pengajuan']}/{$pengajuan['sppjl']}") ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
                                        <?php } else { ?>
                                            <p style="color: red;"> <b>Tidak ada</b> </p>
                                        <?php } ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Berita Acara Hasil Pengadaan Langsung</td>
                                    <td>:</td>
                                    <td><?= $pengajuan['bahpl']; ?></td>
                                    <td><?php if (!empty($pengajuan['bahpl'])) { ?>
                                            <a href="<?= site_url("./assets/pengajuan/{$pengajuan['id_pengajuan']}/{$pengajuan['bahpl']}") ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
                                        <?php } else { ?>
                                            <p style="color: red;"> <b>Tidak ada</b> </p>
                                        <?php } ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Berita Acara Klarifikasi Teknis dan Negosiasi Biaya</td>
                                    <td>:</td>
                                    <td><?= $pengajuan['baktnb']; ?></td>
                                    <td><?php if (!empty($pengajuan['baktnb'])) { ?>
                                            <a href="<?= site_url("./assets/pengajuan/{$pengajuan['id_pengajuan']}/{$pengajuan['baktnb']}") ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
                                        <?php } else { ?>
                                            <p style="color: red;"> <b>Tidak ada</b> </p>
                                        <?php } ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Lampiran Berita Acara</td>
                                    <td>:</td>
                                    <td><?= $pengajuan['lampiran_ba']; ?></td>
                                    <td>
                                        <?php if (!empty($pengajuan['lampiran_ba'])) { ?>
                                            <a href="<?= site_url("./assets/pengajuan/{$pengajuan['id_pengajuan']}/{$pengajuan['lampiran_ba']}") ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
                                        <?php } else { ?>
                                            <p style="color: red;"> <b>Tidak ada</b> </p>
                                        <?php } ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Berita Acara Evaluasi Dokumen Penawaran</td>
                                    <td>:</td>
                                    <td><?= $pengajuan['baedp']; ?></td>
                                    <td>
                                        <?php if (!empty($pengajuan['baedp'])) { ?>
                                            <a href="<?= site_url("./assets/pengajuan/{$pengajuan['id_pengajuan']}/{$pengajuan['baedp']}") ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
                                        <?php } else { ?>
                                            <p style="color: red;"> <b>Tidak ada</b> </p>
                                        <?php } ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>SDP</td>
                                    <td>:</td>
                                    <td><?= $pengajuan['sdp']; ?></td>
                                    <td>
                                        <?php if (!empty($pengajuan['sdp'])) { ?>
                                            <a href="<?= site_url("./assets/pengajuan/{$pengajuan['id_pengajuan']}/{$pengajuan['sdp']}") ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
                                        <?php } else { ?>
                                            <p style="color: red;"> <b>Tidak ada</b> </p>
                                        <?php } ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Undangan</td>
                                    <td>:</td>
                                    <td><?= $pengajuan['undangan']; ?></td>
                                    <td>
                                        <?php if (!empty($pengajuan['undangan'])) { ?>
                                            <a href="<?= site_url("./assets/pengajuan/{$pengajuan['id_pengajuan']}/{$pengajuan['undangan']}") ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
                                        <?php } else { ?>
                                            <p style="color: red;"> <b>Tidak ada</b> </p>
                                        <?php } ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Ijazah</td>
                                    <td>:</td>
                                    <td><?= $pengajuan['ijazah']; ?></td>
                                    <td><?php if (!empty($pengajuan['ijazah'])) { ?>
                                            <a href="<?= site_url("./assets/pengajuan/{$pengajuan['id_pengajuan']}/{$pengajuan['ijazah']}") ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
                                        <?php } else { ?>
                                            <p style="color: red;"> <b>Tidak ada</b> </p>
                                        <?php } ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>CV</td>
                                    <td>:</td>
                                    <td><?= $pengajuan['cv']; ?></td>
                                    <td><?php if (!empty($pengajuan['cv'])) { ?>
                                            <a href="<?= site_url("./assets/pengajuan/{$pengajuan['id_pengajuan']}/{$pengajuan['cv']}") ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
                                        <?php } else { ?>
                                            <p style="color: red;"> <b>Tidak ada</b> </p>
                                        <?php } ?>
                                    </td>
                                </tr>
                                
								<tr>
                                    <td>Transkrip</td>
                                    <td>:</td>
                                    <td><?= $pengajuan['transkrip']; ?></td>
                                    <td><?php if (!empty($pengajuan['transkrip'])) { ?>
                                            <a href="<?= site_url("./assets/pengajuan/{$pengajuan['id_pengajuan']}/{$pengajuan['transkrip']}") ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
                                        <?php } else { ?>
                                            <p style="color: red;"> <b>Tidak ada</b> </p>
                                        <?php } ?>
                                    </td>
                                </tr>
                                
								<tr>
                                    <td>Sertifikat Keahlian</td>
                                    <td>:</td>
                                    <td><?= $pengajuan['sertifikat_keahlian']; ?></td>
                                    <td><?php if (!empty($pengajuan['sertifikat_keahlian'])) { ?>
                                            <a href="<?= site_url("./assets/pengajuan/{$pengajuan['id_pengajuan']}/{$pengajuan['sertifikat_keahlian']}") ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
                                        <?php } else { ?>
                                            <p style="color: red;"> <b>Tidak ada</b> </p>
                                        <?php } ?>
                                    </td>
                                </tr>

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
