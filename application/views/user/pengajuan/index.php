<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pengajuan Naik Gaji
        </h1>
        <ol class="breadcrumb">
            <!-- <a href="<?= base_url(); ?>pengajuan_reguler" class="btn btn-success"><i class="fa fa-file"></i> Pangkat Reguler</a>
            <a href="<?= base_url(); ?>pengajuan_fungsional" class="btn btn-success"><i class="fa fa-file"></i> Pangkat Fungsional</a>
            <a href="<?= base_url(); ?>pengajuan_structural" class="btn btn-success"><i class="fa fa-file"></i> Pangkat Structural</a> -->
            <!-- <a href="<?= base_url(); ?>user/pengajuan_gaji" class="btn btn-success"><i class="fa fa-plus"></i>  Ajukan Kenaikan Gaji</a> -->
        </ol>
    </section>
    <!-- Main content -->
    <section class="content" style="margin-top: 10px;">
        <div class="row mt-3">
            <div class="col-xs-12">
				<?php if ($this->session->flashdata('notification')) : ?>
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Berkas <strong><?= $this->session->flashdata('notification'); ?></strong> Diajukan
					</div>
				<?php unset($_SESSION['notification']); endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <!-- /.box-header -->
                    <div class="box-body" style="overflow: auto;">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="10">#</th>
                                    <th style="text-align: center;">NIK</th>
                                    <th style="text-align: center;">Nama</th>
                                    <th style="text-align: center;">Tanggal</th>
                                    <th style="text-align: center;">Status</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($pengajuan as $p) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $p['nik']; ?></td>
                                        <td><?= $p['nama']; ?></td>
                                        <td><?= $p['created_at']; ?></td>
                                        <td>
											<?php if($p['is_accepted'] == 0) :?>
												<span class="label label-warning"><?= $p['is_accepted'] = 'Belum Diterima'; ?></span>
											<?php else :?>
												<span class="label label-success"><?= $p['is_accepted'] = 'Diterima'; ?></span>
											<?php endif;?>
										</td>
										<td style="text-align: center;">
											<?php if(!$p['is_accepted']) : ?>
												<a href="<?= base_url('user/pengajuan_gaji/'.$p['id_pengajuan']); ?>" class="btn btn-success"><i class="fa fa-save"></i>  Lengkapi Berkas</a>
											<?php endif; ?>
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
    <!-- <section class="content" style="min-height: 600px;">
    </section> -->
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
