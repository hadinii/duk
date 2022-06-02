<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Kirim Email Kenaikan Gaji
        </h1>
        <ol class="breadcrumb">

        </ol>
    </section>

    <!-- Main content -->
    <section class="content" style="margin-top: 10px;">
        <div class="row">
            <div class="col-xs-12">
                <!-- <?php if ($this->session->flashdata('notification')) : ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        Pesan <strong>berhasil</strong> <?= $this->session->flashdata('notification'); ?>
                    </div>
                <?php endif; ?> -->
                <div class="box box-success">
                    <div class="box-header">
                        <!-- <h3 class="box-title"><i class="fa fa-credit-card"></i> Kenaikan Gaji Pegawai</h3> -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <?php if (validation_errors()) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= validation_errors(); ?>
                            </div>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-md-10">
                                <form class="form-horizontal" method="post" action="">
                                    <input type="hidden" name="id" value="">

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Nama</label>
                                        <div class="col-md-9">
                                            <input type="text" name="nama" value="<?= $duk['nama']; ?>" class="form-control" readonly required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Email</label>
                                        <div class="col-md-9">
                                            <input type="email" name="email" value="<?= $pegawai['email']; ?>" class="form-control" readonly required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Subject</label>
                                        <div class="col-md-9">
                                            <input type="text" name="subject" value="Kenaikan Gaji" class="form-control" readonly required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Pesan</label>
                                        <div class="col-md-9">
                                            <!-- <input type="text" value=" " name="pesan" class="form-control" required> -->
                                            <textarea name="pesan" rows="10" class="form-control" required>
Segera Urus Kenaikan Gaji!

Syarat-syarat Kenaikan Gaji:
1. SK Kenaikan Pangkat terakhir.
2. SK Kenaikan Kenaikan Gaji Berkala terakhir.

*Upload file di sistem DUK

                                            </textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <!-- <div class="col-md-2"></div> -->
                                        <div class="col-md-12">
                                            <!-- <a onclick="return confirm('Pastikan data sudah benar sebelum dicetak.\nKlik Ok jika data sudah benar')" class="btn btn-success" href="<?= base_url(); ?>laporan/print/<?= $duk['id_duk'] ?>" style="float: right;"> <i class="fa fa-print"></i> Cetak</a> -->
                                            <button type="submit" name="submitemail" class="btn btn-success" style="float: right; margin-right: 7px;"> <i class="fa fa-paper-plane"></i> Kirim</button>
                                            <!-- <button type="submit" class="btn btn-primary" style="float: right; margin-right: 7px;"> <i class="fa fa-save"></i> Perbarui Data</button> -->
                                        </div>
                                    </div>
                                </form>
                            </div>
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
