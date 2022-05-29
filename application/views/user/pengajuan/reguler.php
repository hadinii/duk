<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Kenaikan Pangkat Reguler
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
                        <!-- <h3 class="box-title"><i class="fa fa-file"></i> Form Pengajuan Kenaikan Pangakat Reguler</h3> -->
                    </div>
                    <div class="col-md-12">
                        <?php if ($this->session->flashdata('reguler')) : ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                Berkas <strong>berhasil</strong> <?= $this->session->flashdata('reguler'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <?php if (validation_errors()) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= validation_errors(); ?>
                            </div>
                        <?php endif; ?>
                        <?php echo form_open_multipart('User/insert_reguler', ['class' => 'form-horizontal']); ?>
                        <div class="form-group">
                            <label class="col-md-2 control-label">NIP</label>
                            <div class="col-md-8">
                                <input type="text" name="nip" value="<?= $pegawai['nip']; ?>" class="form-control" readonly required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Nama</label>
                            <div class="col-md-8">
                                <input type="text" name="nama" value="<?= $pegawai['nama']; ?>" class="form-control" readonly required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Tanggal</label>
                            <div class="col-md-8">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <?php $date = date('Y-m-d'); ?>
                                    <input type="text" value="<?= $date; ?>" name="tanggal" class="form-control pull-right" id="datepicker3" required="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Jenis Pengajuan</label>
                            <div class="col-md-8">
                                <input type="text" name="jenis_pengajuan" value="Kenaikan Pangkat Reguler" class="form-control" readonly required=" ">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">SK CPNS</label>
                            <div class="col-md-8">
                                <input type="file" name="sk_cpns" class="form-control" required=" ">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">SK PNS</label>
                            <div class="col-md-8">
                                <input type="file" name="sk_pns" class="form-control" required=" ">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">SK Pangkat Terakhir</label>
                            <div class="col-md-8">
                                <input type="file" name="sk_terakhir" class="form-control" required=" ">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Sasaran Kinerja Pegawai (SKP1)</label>
                            <div class="col-md-8">
                                <input type="file" name="skp" class="form-control" required=" ">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Sasaran Kinerja Pegawai (SKP2)</label>
                            <div class="col-md-8">
                                <input type="file" name="skp2" class="form-control" required=" ">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Ijazah Terakhir dan Transkip Nilai</label>
                            <div class="col-md-8">
                                <input type="file" name="ijazah_terakhir" class="form-control" required=" ">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">SK Jabatan</label>
                            <div class="col-md-8">
                                <input type="file" name="sk_jterakhir" class="form-control" required=" ">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <button type="submit" name="submit" class="btn btn-success" style="float: right;"> <i class="fa fa-send"></i> Kirim</button>
                                <br>
                                <span style="color: #ff4a3f">Jika Minimal Sudah 4 Tahun di Pangkat/Golongan Terakhir</span>
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