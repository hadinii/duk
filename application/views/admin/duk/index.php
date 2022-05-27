<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data DUK Pegawai
    </h1>
  </section>

  <!-- Main content -->
  <section class="content" style="margin-top: 10px;">
    <div class="row mt-3">
      <div class="col-xs-12">
        <?php if ($this->session->flashdata('duk')) : ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            Data duk pegawai <strong>berhasil</strong> <?= $this->session->flashdata('duk'); ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-body" style="overflow: auto;">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th width="10">#</th>
                  <th style="text-align: center;">NIP</th>
                  <th style="text-align: center;">Nama</th>
                  <th style="text-align: center;">Pangkat</th>
                  <th style="text-align: center;">Golongan</th>
                  <th style="text-align: center;">Jabatan</th>
                  <th style="text-align: center;">Naik Pangkat</th>
                  <th style="text-align: center;">Naik Gaji</th>
                  <th class="text-center" width="auto">Menu</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($duk as $d) : ?>
                  <tr>
                    <td><?= $i; ?></td>
                    <td><?= $d['nip']; ?></td>
                    <td><?= $d['nama']; ?></td>
                    <td><?= $d['pangkat']; ?></td>
                    <td><?= $d['golongan']; ?></td>
                    <td><?= $d['jabatan']; ?></td>
                    <td><?= mediumdate_indo($d['naik_pangkat_yad']); ?></td>
                    <td><?= mediumdate_indo($d['naik_gaji_yad']); ?></td>
                    <td>
                      <a href="<?= base_url(); ?>data_duk/<?= $d['id_duk'] ?>" class="btn btn-info"><i class="fa fa-eye"></i></a>
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