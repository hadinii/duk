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
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <td width="140">NIP</td>
                                    <td width="7">:</td>
                                    <td><?= $pengajuan['nip']; ?></td>
                                </tr>

                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td><?= $pengajuan['nama']; ?></td>
                                </tr>

                                <tr>
                                    <td>Tanggal</td>
                                    <td>:</td>
                                    <td><?= $pengajuan['tanggal']; ?></td>
                                </tr>

                                <tr>
                                    <td>Jenis Pengajuan</td>
                                    <td>:</td>
                                    <td>
                                        <?= $pengajuan['jenis_pengajuan'] ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>SK CPNS</td>
                                    <td>:</td>
                                    <td><?= $pengajuan['sk_cpns']; ?></td>
                                    <td>
                                        <?php if (!empty($pengajuan['sk_cpns'])) { ?>
                                            <a href="<?= site_url('./assets/berkas/sk_cpns/' . $pengajuan['sk_cpns']) ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
                                        <?php } else { ?>
                                            <p style="color: red;"> <b>Tidak ada</b> </p>
                                        <?php } ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>SK PNS</td>
                                    <td>:</td>
                                    <td><?= $pengajuan['sk_pns']; ?></td>
                                    <td>
                                        <?php if (!empty($pengajuan['sk_pns'])) { ?>
                                            <a href="<?= site_url('./assets/berkas/sk_pns/' . $pengajuan['sk_pns']) ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
                                        <?php } else { ?>
                                            <p style="color: red;"> <b>Tidak ada</b> </p>
                                        <?php } ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>SK Pangkat Terakhir</td>
                                    <td>:</td>
                                    <td><?= $pengajuan['sk_terakhir']; ?></td>
                                    <td>
                                        <?php if (!empty($pengajuan['sk_terakhir'])) { ?>
                                            <a href="<?= site_url('./assets/berkas/sk_terakhir/' . $pengajuan['sk_terakhir']) ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
                                        <?php } else { ?>
                                            <p style="color: red;"> <b>Tidak ada</b> </p>
                                        <?php } ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>SKP 1</td>
                                    <td>:</td>
                                    <td><?= $pengajuan['skp']; ?></td>
                                    <td><?php if (!empty($pengajuan['skp'])) { ?>
                                            <a href="<?= site_url('./assets/berkas/skp/' . $pengajuan['skp']) ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
                                        <?php } else { ?>
                                            <p style="color: red;"> <b>Tidak ada</b> </p>
                                        <?php } ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>SKP 2</td>
                                    <td>:</td>
                                    <td><?= $pengajuan['skp2']; ?></td>
                                    <td><?php if (!empty($pengajuan['skp2'])) { ?>
                                            <a href="<?= site_url('./assets/berkas/skp2/' . $pengajuan['skp2']) ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
                                        <?php } else { ?>
                                            <p style="color: red;"> <b>Tidak ada</b> </p>
                                        <?php } ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Ijazah Terakhir dan Transkip Nilai</td>
                                    <td>:</td>
                                    <td><?= $pengajuan['ijazah_terakhir']; ?></td>
                                    <td><?php if (!empty($pengajuan['ijazah_terakhir'])) { ?>
                                            <a href="<?= site_url('./assets/berkas/ijazah/' . $pengajuan['ijazah_terakhir']) ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
                                        <?php } else { ?>
                                            <p style="color: red;"> <b>Tidak ada</b> </p>
                                        <?php } ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>SK Jabatan Terakhir</td>
                                    <td>:</td>
                                    <td><?= $pengajuan['sk_jterakhir']; ?></td>
                                    <td>
                                        <?php if (!empty($pengajuan['sk_jterakhir'])) { ?>
                                            <a href="<?= site_url('./assets/berkas/sk_jabatan/' . $pengajuan['sk_jterakhir']) ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
                                        <?php } else { ?>
                                            <p style="color: red;"> <b>Tidak ada</b> </p>
                                        <?php } ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>SK Pelantikan</td>
                                    <td>:</td>
                                    <td><?= $pengajuan['sk_p']; ?></td>
                                    <td>
                                        <?php if (!empty($pengajuan['sk_p'])) { ?>
                                            <a href="<?= site_url('./assets/berkas/sk_pelantikan/' . $pengajuan['sk_p']) ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
                                        <?php } else { ?>
                                            <p style="color: red;"> <b>Tidak ada</b> </p>
                                        <?php } ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>SK Jabatan Structural</td>
                                    <td>:</td>
                                    <td><?= $pengajuan['sk_js']; ?></td>
                                    <td>
                                        <?php if (!empty($pengajuan['sk_js'])) { ?>
                                            <a href="<?= site_url('./assets/berkas/sk_jabatan_structural/' . $pengajuan['sk_js']) ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
                                        <?php } else { ?>
                                            <p style="color: red;"> <b>Tidak ada</b> </p>
                                        <?php } ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>SK Jabatan Fungsional</td>
                                    <td>:</td>
                                    <td><?= $pengajuan['sk_jf']; ?></td>
                                    <td>
                                        <?php if (!empty($pengajuan['sk_jf'])) { ?>
                                            <a href="<?= site_url('./assets/berkas/sk_jabatan_fungsional/' . $pengajuan['sk_jf']) ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
                                        <?php } else { ?>
                                            <p style="color: red;"> <b>Tidak ada</b> </p>
                                        <?php } ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Penetapan Angka Kredit</td>
                                    <td>:</td>
                                    <td><?= $pengajuan['pak']; ?></td>
                                    <td>
                                        <?php if (!empty($pengajuan['pak'])) { ?>
                                            <a href="<?= site_url('./assets/berkas/pak/' . $pengajuan['pak']) ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
                                        <?php } else { ?>
                                            <p style="color: red;"> <b>Tidak ada</b> </p>
                                        <?php } ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>SK Kenaikan Gaji Berkala</td>
                                    <td>:</td>
                                    <td><?= $pengajuan['sk_kgb']; ?></td>
                                    <td><?php if (!empty($pengajuan['sk_kgb'])) { ?>
                                            <a href="<?= site_url('./assets/berkas/sk_kgb/' . $pengajuan['sk_kgb']) ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></a>
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