<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Pengajuan Kenaikan Pangkat/Gaji
        </h1>
        <!-- <ol class="breadcrumb">
            <a href=" " class="btn btn-success"><i class="fa fa-file"></i> Tambah Dokumen</a>
        </ol> -->
    </section>

    <!-- Main content -->
    <section class="content" style="margin-top: 10px;">
        <div class="row mt-3">
            <div class="col-xs-12">

            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <?php if ($this->session->flashdata('pengajuan')) : ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        Data Pengajuan <strong>berhasil</strong> <?= $this->session->flashdata('pengajuan'); ?>
                    </div>
                <?php endif; ?>
                <div class="box box-success">
                    <div class="box-body" style="overflow: auto;">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="10">#</th>
                                    <th style="text-align: center;">NIP</th>
                                    <th style="text-align: center;">Nama</th>
                                    <th style="text-align: center;">Tanggal</th>
                                    <th style="text-align: center;">Jenis Pengajuan</th>
                                    <th class="text-center" width="auto">Dokumen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($pengajuan as $p) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $p['nip']; ?></td>
                                        <td><?= $p['nama']; ?></td>
                                        <td><?= $p['tanggal']; ?></td>
                                        <td><?= $p['jenis_pengajuan']; ?></td>
                                        <td style="text-align: center;">
                                            <a href="<?= base_url(); ?>detailpengajuan/<?= $p['id_pengajuan']; ?> " class="btn btn-warning"><i class="fa fa-file"></i></a>
                                            <a href="<?= base_url(); ?>hapusPengajuan/<?= $p['id_pengajuan']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
    <!-- /.content -->
</div>