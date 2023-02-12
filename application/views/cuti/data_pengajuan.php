<?php

    header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1
	header('Pragma: no-cache'); // HTTP 1.0
	header('Expires: 0'); // Proxies


$filter['cpns'] = '';
$filter = $this->session->userdata('filtercuti');
$newitem = $newitem_cuti->new_item;
?>

<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/tracker/tracker.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/date-text/jquery.datetextentry.css">

<style>
  .modal-xl {
    width: 100%;
    height: 100%;
    margin: 0;
    top: 0;
    left: 0;
  }

  .form-control-plaintext {
    display: block;
    width: 100%;
    padding-top: 0.375rem;
    padding-bottom: 0.375rem;
    margin-bottom: 0;
    line-height: 1.5;
    color: #333;
    background-color: transparent;
    border: solid transparent;
    border-width: 2px 0;
    font-weight: bold;
  }

  #loadMe {
    text-align: center;
    padding: 0 !important;
  }

  #loadMe:before {
    content: '';
    display: inline-block;
    height: 100%;
    vertical-align: middle;
    margin-right: -4px;
  }

  #loadMe .modal-dialog {
    display: inline-block;
    text-align: left;
    vertical-align: middle;
  }
</style>
<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Pengajuan Cuti Online
    </h1>
  </section>

  <section class="content-header">
    <?php echo $this->session->flashdata('message'); ?>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-lg-12">

        <div class="panel panel-default">

          <div class="panel-body">

            <div class="box-footer">
              <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-tag"></i> Cari</h3>
              </div>
              <div class="box-body">
                <div class="row">

                  <!-- /.col -->
                  <div class="col-sm-4 col-md-4">
                    <div class="color-palette-set">
                      <div class="color-palette">
                        <label for="">Unit Kerja</label>
                      </div>
                      <div class="color-palette">
                        <select name="opd" class="form-control select2" id="opd">
                          <option value="all">Semua</option>
                          <?php foreach ($unit->result() as $key) : ?>
                            <option <?= $filter['opd'] == $key->unit_id ? 'selected' : ''; ?> value="<?= $key->unit_id ?>"><?= $key->unit_nama ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-4">
                    <div class="color-palette-set">
                      <div class="color-palette">
                        <label for="">Status Permohonan</label>
                      </div>
                      <div class="color-palette">
                        <select name="proses" class="form-control select2" id="proses">
                          <option value="all">Semua</option>
                          <?php foreach ($status_permohonan->result() as $key) : ?>
                            <option <?= $filter['proses'] == $key->status_id ? 'selected' : ''; ?> value="<?= $key->status_id ?>"><?= $key->status_nama ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-2">
                    <div class="color-palette-set">
                      <div class="color-palette">
                        <label for="">&nbsp;</label>
                      </div>
<!--                       <div class="color-palette">
                        <button class="btn btn-primary btn-sm" id="btn-filter">Filter</button>
                      </div> -->
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.box-body -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
          </div>
          <div class="box-body table-responsive">
            <table id="mytable" class="table table-bordered table-striped" width="100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>No Permohonan</th>
                  <th>Status</th>
                  <th>NIP</th>
                  <th>Nama</th>
                  <th>Pangkat / Golru</th>
                  <th>Jenis Cuti</th>
                  <th>Tanggal Mulai</th>
                  <th>Tanggal Selesai</th>
                  <th>SI Cuti</th>
                  <th style="min-width: 200px;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php /*
                                $no = 1;
                                foreach ($result->result() as $value) {
                                    ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $value->agama_nama ?></td>
                                        
                                        <td>
                                            <a href="#" class="btn btn-warning btn-sm" type="button" onclick="edit('<?= $value->agama_id ?>','<?= $value->agama_nama ?>')" data-toggle="modal" data-target="#modal-update"><i class="fa fa-edit"></i></a>
                                                <a href="<?= site_url('referensi/agama/delete/' . $value->agama_id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data.?')"><i class="fa fa-trash-o fa-fw"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                    $no++;
                                }
                                */ ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>


<!-- The Modal -->
<div class="modal" id="myModal2">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Input Nomor Ijin Cuti</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <form action="<?= site_url('cuti/DataPengajuan/update/sk/') ?>" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6 form-group">
              <label for="">Nomor</label>
              <input type="text" name="nomor" id="nomor_sk" class="form-control">
              <input type="hidden" name="pegawaicuti_id" id="pegawaicutisk_id" value="">
            </div>
            <div class="col-md-6 form-group">
              <label for="">Tanggal</label>
              <input type="text" name="tanggal" id="tanggal_sk" class="form-control dateEntry">
            </div>
            <!-- <div class="col-md-12 form-group">
							<label for="">Catatan</label>
							<textarea name="catatan" id="siswa_catatan" class="form-control" rows="5"></textarea>
						</div> -->
          </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
          <button type="submit" id="unduh-template" class="btn btn-success">Simpan & Unduh Template </button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- The Modal -->
<div class="modal" id="myModal3">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Upload File SK</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="<?= site_url('cuti/DataPengajuan/update/sk/') ?>" id="form-upload" method="POST" enctype="multipart/form-data">
          <div class="row">
            <div class="col-md-6 form-group">
              <label for="">File SK (PDF/JPG/JPEG/PNG max 2MB)</label>
              <input type="file" name="file" id="file" class="form-control">
              <input type="hidden" name="pegawaicuti_id" id="pegawaicutiskupload_id" value="">
            </div>
            <!-- <div class="col-md-12 form-group">
							<label for="">Catatan</label>
							<textarea name="catatan" id="siswa_catatan" class="form-control" rows="5"></textarea>
						</div> -->
          </div>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
        <button id="btn-upload" type="button" class="btn btn-success" data-dismiss="modal">Upload</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="verifModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" id="formVerif" action="<?= site_url('cuti/DataPengajuan/update/verif') ?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Nomor SK Cuti</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" id="nama" readonly autocomplete="off" />


                    </div>
                    <!-- <div class="form-group">
                        <label>Pejabat Yang Menetapkan</label> <br>
                        <select class="form-control select2" style="width: 100%;" name="pegawaicuti_pejabat" id="pegawaicuti_pejabat">
                            <option value="">--Pilih--</option>
                            <?php /*
                            foreach ($pejabat->result() as $value) {
                            ?>
                                <option <?= $value->pejabat_nama == 'BUPATI SANGGAU' ? 'seleceted' : ''; ?> value="<?= $value->pejabat_nama ?>"><?= $value->pejabat_nama ?></option>
                            <?php } */ ?>
                        </select>
                    </div> -->
                    <div class="form-group">
                        <label>No SK</label>
                        <input type="text" class="form-control" name="pegawaicuti_sk_no" id="pegawaicuti_sk_no" autocomplete="off" />


                    </div>
                    <div class="form-group">
                        <label>Tanggal SK</label>
                        <input type="text" class="form-control dateEntry" placeholder="dd/mm/yyyy" name="pegawaicuti_sk_tanggal" id="pegawaicuti_sk_tanggal" value="<?= date('Y-m-d') ?>" autocomplete="off" />


                    </div>
                    <input type="hidden" name="pegawaicuti_no_permohonan" id="pegawaicuti_no_permohonan" value="">
                    <input type="hidden" name="pegawaicuti_id" id="pegawaicuti_id" value="">

                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                <button data-toggle="modal" data-target="#myModal" class="btn btn-danger" type="button"><span><i class="fa fa-undo"></i> Tolak</span></button>
                <button type="button" id="btn-terima" class="btn btn-primary">Verifikasi</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- The Modal -->

<!-- Modal -->
<?php /*
<div class="modal fade bd-example-modal-lg" id="verifModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable  modal-lg">
    <div class="modal-content">
      <div class="modal-body tracking" style="min-height: 99px;">

      </div>
      <div class="modal-body">
        <form class="form form-horizontal">
          <div class="form-group">
            <label for="message-text" class="col-sm-4 col-form-label">Status Permohonan:</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext " id="vstatus_permohonan" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-sm-4 col-form-label">No Permohonan:</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" id="vno_permohonan" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-sm-4 col-form-label">NIP:</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" id="vnip" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-sm-4 col-form-label">Nama:</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" id="vnama" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-sm-4 col-form-label">Unit Kerja:</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" id="vunit" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-sm-4 col-form-label">Pangkat / Golongan:</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" id="vpangkat" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-sm-4 col-form-label">Jabatan:</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" id="vjabatan" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-sm-4 col-form-label">Jenis Cuti:</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" id="vjenis_cuti" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-sm-4 col-form-label">Tahun:</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" id="vtahun" value="">
            </div>
          </div>
          <div id="vnormal">
            <div class="form-group row">
              <label for="message-text" class="col-sm-4 col-form-label">Tanggal Mulai:</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" id="vtanggal_mulai" value="">
              </div>
            </div>
            <div class="form-group row">
              <label for="message-text" class="col-sm-4 col-form-label">Tanggal Selesai:</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" id="vtanggal_selesai" value="">
              </div>
            </div>
            <!-- <div class="form-group row">
              <label for="message-text" class="col-sm-4 col-form-label">Keterangan:</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" id="vketerangan" value="">
              </div>
            </div> -->
          </div>
          <div id="vtahap1" style="display: none;">
            <div class="form-group row">
              <label for="message-text" class="col-sm-4 col-form-label">Tahap 1:</label>
              <div class="col-sm-8">
              </div>
            </div>
            <div class="form-group row">
              <label for="message-text" class="col-sm-4 col-form-label">Tanggal Mulai:</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" id="vtanggal_mulai_1" value="">
              </div>
            </div>
            <div class="form-group row">
              <label for="message-text" class="col-sm-4 col-form-label">Tanggal Selesai:</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" id="vtanggal_selesai_1" value="">
              </div>
            </div>
            <!-- <div class="form-group row">
              <label for="message-text" class="col-sm-4 col-form-label">Keterangan:</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" id="vketerangan_1" value="">
              </div>
            </div> -->
          </div>
          <div id="vtahap2" style="display: none;">
            <div class="form-group row">
              <label for="message-text" class="col-sm-4 col-form-label">Tahap 2:</label>
              <div class="col-sm-8">
              </div>
            </div>
            <div class="form-group row">
              <label for="message-text" class="col-sm-4 col-form-label">Tanggal Mulai:</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" id="vtanggal_mulai_2" value="">
              </div>
            </div>
            <div class="form-group row">
              <label for="message-text" class="col-sm-4 col-form-label">Tanggal Selesai:</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" id="vtanggal_selesai_2" value="">
              </div>
            </div>
            <!-- <div class="form-group row">
              <label for="message-text" class="col-sm-4 col-form-label">Keterangan:</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" id="vketerangan_2" value="">
              </div>
            </div> -->
          </div>
          <?php
          $berkass = $berkas->result_array();
          for ($i = 0; $i < count($berkass); $i++) : ?>
            <div class="form-group row">
              <label for="message-text" class="col-sm-4 col-form-label"><?= $berkass[$i]['berkas_nama'] ?></label>
              <div class="col-sm-8" id="formv<?= $i ?>">
              </div>
            </div>
          <?php endfor; ?>
        </form>
      </div>
      <div class="modal-footer">
        <input type="hidden" id="pegawaicuti_id" value="">
        <input type="hidden" id="no_permohonan" value="">
        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
        <button data-toggle="modal" data-target="#myModal" class="btn btn-danger buttons-html5 btn-sm" type="button"><span><i class="fa fa-undo"></i> Tolak</span></button>
        <button type="button" id="btn-terima" class="btn btn-primary">Verifikasi</button>
      </div>
    </div>
  </div>
</div>
*/ ?>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="detailModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable  modal-lg">
    <div class="modal-content">
      <div class="modal-body tracking" style="min-height: 99px;">

      </div>
      <div class="modal-body">
        <form class="form form-horizontal">
          <div class="form-group">
            <label for="message-text" class="col-sm-4 col-form-label">Status Permohonan:</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext " id="status_permohonan_detail" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-sm-4 col-form-label">No Permohonan:</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" id="no_permohonan_detail" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-sm-4 col-form-label">NIP:</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" id="nip_detail" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-sm-4 col-form-label">Nama:</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" id="nama_detail" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-sm-4 col-form-label">Unit Kerja:</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" id="unit_detail" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-sm-4 col-form-label">Pangkat / Golongan:</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" id="pangkat_detail" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-sm-4 col-form-label">Jabatan:</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" id="jabatan_detail" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-sm-4 col-form-label">Jenis Cuti:</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" id="jenis_cuti_detail" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-sm-4 col-form-label">Tahun:</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" id="tahun_detail" value="">
            </div>
          </div>
          <div id="normal">
            <div class="form-group row">
              <label for="message-text" class="col-sm-4 col-form-label">Tanggal Mulai:</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" id="tanggal_mulai_detail" value="">
              </div>
            </div>
            <div class="form-group row">
              <label for="message-text" class="col-sm-4 col-form-label">Tanggal Selesai:</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" id="tanggal_selesai_detail" value="">
              </div>
            </div>
            <!-- <div class="form-group row">
              <label for="message-text" class="col-sm-4 col-form-label">Keterangan:</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" id="keterangan_detail" value="">
              </div>
            </div> -->
          </div>
          <div id="tahap1" style="display: none;">
            <div class="form-group row">
              <label for="message-text" class="col-sm-4 col-form-label">Tahap 1:</label>
              <div class="col-sm-8">
              </div>
            </div>
            <div class="form-group row">
              <label for="message-text" class="col-sm-4 col-form-label">Tanggal Mulai:</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" id="tanggal_mulai_1" value="">
              </div>
            </div>
            <div class="form-group row">
              <label for="message-text" class="col-sm-4 col-form-label">Tanggal Selesai:</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" id="tanggal_selesai_1" value="">
              </div>
            </div>
            <!-- <div class="form-group row">
              <label for="message-text" class="col-sm-4 col-form-label">Keterangan:</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" id="keterangan_1" value="">
              </div>
            </div> -->
          </div>
          <div id="tahap2" style="display: none;">
            <div class="form-group row">
              <label for="message-text" class="col-sm-4 col-form-label">Tahap 2:</label>
              <div class="col-sm-8">
              </div>
            </div>
            <div class="form-group row">
              <label for="message-text" class="col-sm-4 col-form-label">Tanggal Mulai:</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" id="tanggal_mulai_2" value="">
              </div>
            </div>
            <div class="form-group row">
              <label for="message-text" class="col-sm-4 col-form-label">Tanggal Selesai:</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" id="tanggal_selesai_2" value="">
              </div>
            </div>
            <!-- <div class="form-group row">
              <label for="message-text" class="col-sm-4 col-form-label">Keterangan:</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" id="keterangan_2" value="">
              </div>
            </div> -->
          </div>
          <?php
          $berkass = $berkas->result_array();
          for ($i = 0; $i < count($berkass); $i++) : ?>
            <div class="form-group row">
              <label for="message-text" class="col-sm-4 col-form-label"><?= $berkass[$i]['berkas_nama'] ?></label>
              <div class="col-sm-8" id="form<?= $i ?>">
              </div>
            </div>
          <?php endfor; ?>
        </form>
      </div>
      <div class="modal-footer">

        <a href="#" id="btn-riwayat" class="btn btn-info">Riwayat Cuti</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="skModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Surat Ijin Cuti</h4>
      </div>
      <div class="modal-body ">
        <div class="row">
          <div class="sk"></div>
        </div>
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>

<?php
$berkass = $berkas->result_array();
for ($i = 0; $i < count($berkass); $i++) : ?>
  <!-- Modal -->
  <div class="modal fade" id="berkasModal<?= $i ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><?= $berkass[$i]['berkas_nama'] ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body berkasModal">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Kembali</button>
        </div>
      </div>
    </div>
  </div>
<?php endfor; ?>


<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Tolak Permohonan</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="">
          <div class="row">
            <div class="col-md-12">
              <label for="">Keterangan</label>
              <textarea name="keterangan" id="keterangan_tolak" class="form-control" rows="5"></textarea>
            </div>
          </div>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button id="btn-tolak" type="button" class="btn btn-danger" data-dismiss="modal">Tolak</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="loadMe" tabindex="-1" role="dialog" aria-labelledby="loadMeLabel">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <div class="loader"></div>
        <div clas="loader-txt">
          <p>Sedang memuat.. </p>
          <i class="fa fa-refresh fa-spin"></i>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- jQuery 3 -->

<link rel="stylesheet" href="<?= base_url() ?>assets/sweetalert/sweetalert.css">
<script src="<?= base_url() ?>assets/sweetalert/sweetalert.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/date-text/jquery.datetextentry.js"></script>

<script>
  var t;

  $('.dateEntry').datetextentry({
    show_tooltips: false,
    errorbox_x: -135,
    errorbox_y: 28
  });

  function view(kgb_id, proses, file) {
    if (file.length > 0) {
      url_file = '<?= base_url("assets/docs/cuti") ?>/' + file + '?<?=time();?>'
    } else {
      url_file = '#'
    }

    if (proses == '1') {
      var status_proses = 'Pengecekan Berkas';
      // var btn_update = '<a href="'+ url + '/' + kgb_id + '" class="btn btn-default buttons-html5 " ><span><i class="fa fa-edit"></i> Ubah</span></a> '
    } else if (proses == '2') {
      var status_proses = 'Proses Penandatanganan';
      var btn_update = ''
    } else if (proses == '3') {
      var status_proses = 'Dikembalikan';
      // var btn_update = '<a href="'+ url + '/' + kgb_id + '" class="btn btn-default buttons-html5 " ><span><i class="fa fa-edit"></i> Ubah</span></a> '
    } else {
      var status_proses = 'Ditandatangani';
      var btn_update = ''
    }

    $("#skModal").find(".modal-footer").html('');
    $("#skModal").find(".sk").html('');
    $("#skModal").find("#status_proses").html('');
    var skModal = '<object data="' + url_file + '" type="application/pdf" width="100%" height="720px"></object>';
    $("#skModal").find(".sk").append(skModal);
    $("#skModal").find("#status_proses").append(status_proses);
    var url = '<?= site_url('pegawai/PegawaiKgb/update/sk') ?>'
    btn_update = '<a href="' + url_file + '" class="btn btn-success" target="_blank">Unduh</a>';
    btn_update += '<button type="button" class="btn btn-primary" data-dismiss="modal">Kembali</button>';

    $("#skModal").find(".modal-footer").append(btn_update);
    $('#skModal').modal('toggle');
    $('#skModal').modal('show');
  }
  
  function verif(cuti_id,no_permohonan,nama,sk,tgl_sk) {
        $('#pegawaicuti_id').val(cuti_id)
        $('#pegawaicuti_no_permohonan').val(no_permohonan);
        $('#nama').val(nama);
        $('#pegawaicuti_sk_no').val(sk);
        // $('#pegawaicuti_sk_tanggal').datetextentry('set_date', tgl_sk);
        $('#verifModal').modal('toggle');
        $('#verifModal').modal('show');
    }

<?php /*
  function verif(v) {

    $("#verifModal").find(".tracking").html('');

    $.ajax({
      url: '<?= site_url('pegawai/PegawaiAjax/getPegawaiCutiOnlineById') ?>',
      type: "POST",
      data: {
        ajax: '1',
        id: v
      },
      dataType: "json",
      // async: true,
      success: function(data) {
        $('#vno_permohonan').val(data.pegawaicuti_no_permohonan);
        $('#vnip').val(data.pegawaicuti_pegawai_nip);
        $('#vnama').val(data.pegawai_nama);
        $('#vunit').val(data.pegawai_unit_nama);
        $('#vpangkat').val(data.pegawai_pangkat_terakhir_nama + ' (' + data.pegawai_pangkat_terakhir_golru + ')');
        $('#vjabatan').val(data.pegawai_jabatan_nama);
        $('#vjenis_cuti').val(data.jenis_cuti_nama);
        $('#vtahun').val(data.pegawaicuti_tahun);
        $('#vtanggal_mulai').val(tgl_indo(data.pegawaicuti_lama_cuti_mulai));
        $('#vtanggal_selesai').val(tgl_indo(data.pegawaicuti_lama_cuti_selesai));
        // $('#vketerangan').val(data.pegawaicuti_keterangan);
        $('#vstatus_permohonan').val(data.status_nama);
        $('#pegawaicuti_id').val(data.pegawaicuti_id);
        $('#no_permohonan').val(data.pegawaicuti_no_permohonan);

        if (data.pegawaicuti_bertahap != '0') {
          $('#vnormal').hide();
          $('#vtahap1').show();
          $('#vtahap2').show();
          $('#vtanggal_mulai_1').val(tgl_indo(data.pegawaicuti_lama_cuti_mulai));
          $('#vtanggal_selesai_1').val(tgl_indo(data.pegawaicuti_lama_cuti_selesai));
          $('#vjumlah_hari_1').val(data.pegawaicuti_jumlah_hari);
          // $('#vketerangan_1').val(data.pegawaicuti_keterangan);
          $('#vtanggal_mulai_2').val(tgl_indo(data.th2_mulai));
          $('#vtanggal_selesai_2').val(tgl_indo(data.th2_selesai));
          $('#vjumlah_hari_2').val(data.th2_jumlah_hari);
          // $('#vketerangan_2').val(data.th2_keterangan);
        } else {

          $('#vnormal').show();
          $('#vtahap1').hide();
          $('#vtahap2').hide();
        }


        var status_permohonan = data.pegawaicuti_status_permohonan;
        var class1 = "todo";
        var class2 = "todo";
        var class3 = "todo";
        var class4 = "todo";

        if (status_permohonan == '3') {
          var class1 = "done";
        }
        if (status_permohonan == '1') {
          var class1 = "done";
          var class2 = "done";
        }
        if (status_permohonan == '2') {
          var class1 = "done";
          var class2 = "done";
          var class3 = "done";
        }
        if (status_permohonan == '4') {
          var class1 = "done";
          var class2 = "done";
          var class3 = "done";
          var class4 = "done";
        }


        var progres = '<ol class="track-progress"> ' +
          '<li class="' + class1 + '"> ' +
          '<em>1</em> ' +
          '<span>Pengajuan</span> ' +
          '</li> ' +
          '<li class="' + class2 + '"> ' +
          '<em>2</em> ' +
          '<span>Verifikasi</span> ' +
          '</li> ' +
          '<li class="' + class3 + '"> ' +
          ' <em>3</em> ' +
          '<span>Diproses</span> ' +
          '</li> ' +
          '<li class="' + class4 + '"> ' +
          '<em>4</em> ' +
          '<span>Disetujui</span> ' +
          '</li> ' +
          '</ol>';


        $("#verifModal").find(".tracking").append(progres);
      }
    });


    $.ajax({
      url: '<?= site_url('pegawai/PegawaiAjax/getPegawaiCutiOnlineBerkasById') ?>',
      type: "POST",
      data: {
        ajax: '1',
        id: v
      },
      dataType: "json",
      // async: true,
      success: function(data) {
        $.each(data, function(i, item) {
          $("#berkasModal" + i).find(".berkasModal").html('');
          var html = ' <a href="<?= base_url("assets/files/cuti/") ?>/' + item.url_file + '" class="btn btn-sm btn-default" target="_blank"><i class="fa fa-download"></i> <small>Unduh</small></a>';
          html += '&nbsp; <button type="button" class="btn  btn-sm btn-primary" data-toggle="modal" data-target="#berkasModal' + i + '"><i class="fa fa-eye"></i> <small>Lihat</small></button>';
          $('#formv' + i).html(html);

          var berkasModal = '<object data="<?= base_url("assets/files/cuti/") ?>/' + item.url_file + '" type="application/pdf" width="100%" height="480px"></object>';
          $("#berkasModal" + i).find(".berkasModal").append(berkasModal);
        });
      }
    });

    $('#verifModal').modal('show')

  } */ ?>

  function detail(v) {

    $("#detailModal").find(".tracking").html('');

    $.ajax({
      url: '<?= site_url('pegawai/PegawaiAjax/getPegawaiCutiOnlineById') ?>',
      type: "POST",
      data: {
        ajax: '1',
        id: v
      },
      dataType: "json",
      async: true,
      success: function(data) {
        $('#no_permohonan_detail').val(data.pegawaicuti_no_permohonan);
        $('#nip_detail').val(data.pegawaicuti_pegawai_nip);
        $('#nama_detail').val(data.pegawai_nama);
        $('#unit_detail').val(data.pegawai_unit_nama);
        $('#pangkat_detail').val(data.pegawai_pangkat_terakhir_nama + ' (' + data.pegawai_pangkat_terakhir_golru + ')');
        $('#jabatan_detail').val(data.pegawai_jabatan_nama);
        $('#jenis_cuti_detail').val(data.jenis_cuti_nama);
        $('#tahun_detail').val(data.pegawaicuti_tahun);
        $('#tanggal_mulai_detail').val(tgl_indo(data.pegawaicuti_lama_cuti_mulai));
        $('#tanggal_selesai_detail').val(tgl_indo(data.pegawaicuti_lama_cuti_selesai));
        // $('#keterangan_detail').val(data.pegawaicuti_keterangan);
        $('#status_permohonan_detail').val(data.status_nama);

        if (data.pegawaicuti_bertahap != '0') {
          $('#normal').hide();
          $('#tahap1').show();
          $('#tahap2').show();
          $('#tanggal_mulai_1').val(tgl_indo(data.pegawaicuti_lama_cuti_mulai));
          $('#tanggal_selesai_1').val(tgl_indo(data.pegawaicuti_lama_cuti_selesai));
          $('#jumlah_hari_1').val(data.pegawaicuti_jumlah_hari);
          // $('#keterangan_1').val(data.pegawaicuti_keterangan);
          $('#tanggal_mulai_2').val(tgl_indo(data.th2_mulai));
          $('#tanggal_selesai_2').val(tgl_indo(data.th2_selesai));
          $('#jumlah_hari_2').val(data.th2_jumlah_hari);
          // $('#keterangan_2').val(data.th2_keterangan);
        } else {

          $('#normal').show();
          $('#tahap1').hide();
          $('#tahap2').hide();
        }

        $("#btn-riwayat").attr("href", "<?= site_url('pegawai/PegawaiCuti/view') ?>" + "/" + data.pegawaicuti_pegawai_nip);

        var status_permohonan = data.pegawaicuti_status_permohonan;
        var class1 = "todo";
        var class2 = "todo";
        var class3 = "todo";
        var class4 = "todo";

        if (status_permohonan == '3') {
          var class1 = "done";
        }
        if (status_permohonan == '1') {
          var class1 = "done";
          var class2 = "done";
        }
        if (status_permohonan == '2') {
          var class1 = "done";
          var class2 = "done";
          var class3 = "done";
        }
        if (status_permohonan == '4') {
          var class1 = "done";
          var class2 = "done";
          var class3 = "done";
          var class4 = "done";
        }


        var progres = '<ol class="track-progress"> ' +
          '<li class="' + class1 + '"> ' +
          '<em>1</em> ' +
          '<span>Pengajuan</span> ' +
          '</li> ' +
          '<li class="' + class2 + '"> ' +
          '<em>2</em> ' +
          '<span>Verifikasi</span> ' +
          '</li> ' +
          '<li class="' + class3 + '"> ' +
          ' <em>3</em> ' +
          '<span>Diproses</span> ' +
          '</li> ' +
          '<li class="' + class4 + '"> ' +
          '<em>4</em> ' +
          '<span>Disetujui</span> ' +
          '</li> ' +
          '</ol>';


        $("#detailModal").find(".tracking").append(progres);
      }
    });

    $.ajax({
      url: '<?= site_url('pegawai/PegawaiAjax/getPegawaiCutiOnlineBerkasById') ?>',
      type: "POST",
      data: {
        ajax: '1',
        id: v
      },
      dataType: "json",
      async: true,
      success: function(data) {
        $.each(data, function(i, item) {
          $("#berkasModal" + i).find(".berkasModal").html('');
          var html = ' <a href="<?= base_url("assets/files/cuti/") ?>' + item.url_file + '" class="btn btn-sm btn-default" target="_blank"><i class="fa fa-download"></i> <small>Unduh</small></a>';
          html += '&nbsp; <button type="button" class="btn  btn-sm btn-primary" data-toggle="modal" data-target="#berkasModal' + i + '"><i class="fa fa-eye"></i> <small>Lihat</small></button>';
          $('#form' + i).html(html);

          var berkasModal = '<object data="<?= base_url("assets/files/cuti/") ?>/' + item.url_file + '" type="application/pdf" width="100%" height="480px"></object>';
          $("#berkasModal" + i).find(".berkasModal").append(berkasModal);
        });
      }
    });

    $('#detailModal').modal('show')

  }

  function sk(v) {

    $.ajax({
      url: '<?= site_url('pegawai/PegawaiAjax/getPegawaiCutiOnlineById') ?>',
      type: "POST",
      data: {
        ajax: '1',
        id: v
      },
      dataType: "json",
      async: true,
      success: function(data) {

        $('#pegawaicutisk_id').val(v);
        $('#nomor_sk').val(data.pegawaicuti_sk_no);
        $('#tanggal_sk').datetextentry('set_date', data.pegawaicuti_sk_tanggal);
        $('#myModal2').modal('show');

      }
    })

  }

  function upload_sk(v) {
    $('#pegawaicutiskupload_id').val(v);
    $('#myModal3').modal('show');

  }

  $(document).ready(function() {

    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
      return {
        "iStart": oSettings._iDisplayStart,
        "iEnd": oSettings.fnDisplayEnd(),
        "iLength": oSettings._iDisplayLength,
        "iTotal": oSettings.fnRecordsTotal(),
        "iFilteredTotal": oSettings.fnRecordsDisplay(),
        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
      };
    };

    var t = $("#mytable").DataTable({
      // initComplete: function() {
      //   var api = this.api();
      //   $('#mytable_filter input')
      //     .off('.DT')
      //     .on('keyup.DT', function(e) {
      //       if (e.keyCode == 13) {
      //         api.search(this.value).draw();
      //       }
      //     });
      // },
      scrollX: true,
      oLanguage: {
        sEmptyTable: "Tidak ada data yang tersedia pada tabel ini",
        sProcessing: "Sedang memproses...",
        sLengthMenu: "Tampilkan _MENU_ entri",
        sZeroRecords: "Tidak ditemukan data yang sesuai",
        sInfo: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
        sInfoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
        sInfoFiltered: "(disaring dari _MAX_ entri keseluruhan)",
        sInfoPostFix: "",
        sSearch: "Cari:",
        sUrl: "",
        oPaginate: {
          sFirst: "Pertama",
          sPrevious: "Sebelumnya",
          sNext: "Selanjutnya",
          sLast: "Terakhir"
        }
      },
      processing: true,
      serverSide: true,
      ajax: {
        "url": "DataPengajuan/json",
        "type": "POST",
        "data": function(data) {
          data.opd = $('#opd').val();
          data.proses = $('#proses').val();
          //   data.id_kuasa_pengguna = $('#id_kuasa_pengguna').val();
        }
      },
      columns: [{
          "data": "pegawaicuti_id",
          // "orderable": false,
        }, {
          "data": "pegawaicuti_no_permohonan",
          // "orderable": false,
        },
        {
          "data": "pegawaicuti_status_permohonan"
        },
        {
          "data": "pegawaicuti_pegawai_nip"
        },
        {
          "data": "nama",
          "searchable": false,
        },
        {
          "data": "pangkat"
        },
        {
          "data": "jenis_cuti_nama",
          "searchable": false
        },
        {
          "data": "pegawaicuti_lama_cuti_mulai",
          "searchable": false
        },
        {
          "data": "pegawaicuti_lama_cuti_selesai",
          "searchable": false
        },
        {
          "data": "file_sk",
          "searchable": false
        },
        {
          "data": "action",
          "searchable": false,
          "orderable": false,
          "className": "text-center",
          'width': '15%'
        },
        {
          "data": "pegawai_nama",
          "visible": false
        },
      ],
      order: [
        [0, 'desc']
      ],
      dom: '<"dataTables_wrapper dt-bootstrap"<"row flex"<"col-md-2 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex mr-0 mr-sm-3"l>><"col-md-4 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex"B>><"col-md-6 d-flex d-xl-block"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>>',
      buttons: [
        <?php if ($newitem != 0) : ?> {
            text: '<i class="fa fa-send"></i> Beri Tahu Atasan',
            attr: {
              id: 'notif',
              class: 'btn btn-danger',
              style: 'border-radius: 6px;'
            }
          },
        <?php endif; ?>
        // {
        //     extend: 'pdf',
        //     className: 'btn btn-primary',
        //     orientation: 'landscape',
        //     pageSize: 'LEGAL',
        //     exportOptions: {
        //         columns: [0, 1, 2, 3, 4, 5, 6,7,8,9,10]
        //     }
        // },
        // {
        //     extend: 'print',
        //     className: 'btn btn-primary',
        //     exportOptions: {
        //         columns: [0, 1, 2, 3, 4, 5, 6,7,8,9,10]
        //     }
        // },
      ],
      rowCallback: function(row, data, iDisplayIndex) {
        var info = this.fnPagingInfo();
        var page = info.iPage;
        var length = info.iLength;
        var index = page * length + (iDisplayIndex + 1);
        $('td:eq(0)', row).html(index);
        // if (data['status_validasi'] == '1') $('td', row).css('background-color', 'white');
        // else if (data['status_validasi'] == '2') $('td', row).css('background-color', 'ghostwhite');
        // else if (data['status_validasi'] == '3') $('td', row).css('background-color', '#F5B7B1  ');
      }
    });

    $('#btn-filter').on('click', function() {
      t.ajax.reload();
    });
  
    $('#proses').change(function() {
        t.ajax.reload();
    });
    $('#opd').change(function() {
        t.ajax.reload();
    });



    $('#notif').on('click', function() {
      swal({
        title: "",
        text: "Beri Tahu Atasan Untuk Menandatangani Surat Izin Cuti?",
        type: 'info',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal',
      }, function(isConfirm) {
        if (isConfirm) {

          $.ajax({
            url: '<?= site_url('pegawai/PegawaiAjax/notifTte') ?>',
            type: "POST",
            data: {
              ajax: '1',
              menu: 'cuti'
            },
            success: function(data) {
              console.log(data);
              $('#myModal').modal('hide');
              swal({
                type: 'success',
                title: '',
                text: 'Berhasil',
              })
              window.location.reload();
            },
            error: function(xhr, textStatus, errorThrown) {
              console.log(textStatus);
              if (xhr.responseText == 'session timeout') {
                alert('Sesi anda telah habis. Silahkan LOGIN kembali');
                window.location = "<?= site_url('Akun') ?>";
              } else {
                swal({
                  type: 'error',
                  title: '',
                  text: xhr.responseText,
                })
                window.location.reload();
              }
            }
          });

        } else {
          swal("Dibatalkan", "", "error");
        }
      })
    });


    $('#btn-terima').on('click', function(){
    
      swal({
        title: "",
        text: "Verifikasi Permohonan?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal',
      }, function(isConfirm) {
        if (isConfirm) {
            $('#formVerif').submit();
        } else {
          swal("Dibatalkan", "", "error");
        }
      })

    });


    $('#btn-tolak').on('click', function(){
      swal({
        title: "",
        text: "Tolak permohonan cuti",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal',
      }, function(isConfirm) {
        if (isConfirm) {

          var keterangan = $('#keterangan_tolak').val();
          var pegawaicuti_id = $('#pegawaicuti_id').val();
          var pegawaicuti_no_permohonan = $('#pegawaicuti_no_permohonan').val();

          var form = "<form id='hidden-form' action='<?= site_url('cuti/DataPengajuan/update/reject') ?>' method='post' >";

          form += "<input type='hidden' name='keterangan' value='" + keterangan + "'/>";
          form += "<input type='hidden' name='pegawaicuti_id' value='" + pegawaicuti_id + "'/>";
          form += "<input type='hidden' name='pegawaicuti_no_permohonan' value='" + pegawaicuti_no_permohonan + "'/>";

          $(form + "</form>").appendTo($(document.body)).submit();
        } else {
          swal("Dibatalkan", "", "error");
        }
      })

    });

    $('#btn-upload').on('click', function() {

      $("#loadMe").modal({
        backdrop: "static", //remove ability to close modal with click
        keyboard: false, //remove option to close with keyboard
        show: true //Display loader!
      });

      $('#form-upload').submit();
    })


    $('#unduh-template').on('click', function() {
      setInterval('window.location.reload()', 2000);
    })

  });
</script>
<script>
  function tgl_indo(string) {
    bulanIndo = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    date = string.split(" ")[0];
    time = string.split(" ")[1];

    tanggal = date.split("-")[2];
    bulan = date.split("-")[1];
    tahun = date.split("-")[0];

    return tanggal + " " + bulanIndo[Math.abs(bulan)] + " " + tahun;
  }
</script>