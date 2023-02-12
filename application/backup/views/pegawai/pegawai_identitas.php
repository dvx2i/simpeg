<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="content-wrapper">

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            <?= pegawai_nama_lengkap($pegawai) ?>
        </h1>
    </section>


    <section class="content">

        <div class="row hide" id="form-edit">
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header">
                    </div>
                    <div class="box-body table-responsive">
                        <form id="formidentitas" role="form" enctype="multipart/form-data" action="<?= site_url('pegawai/Pegawai/update') ?>" method="post" onsubmit="return validasiInput()">


                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <b> IDENTITAS PEGAWAI</b>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label>Masuk Sanggau <br>
                                            <input type="checkbox" name="pegawai_masuk_sanggau" id="pegawai_masuk_sanggau" value="1" <?= $pegawai->pegawai_masuk_sanggau == '1' ? 'checked' : ''; ?> />
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label>OPD</label>
                                            <select class="form-control" disabled>
                                                <option><?= $pegawai->pegawai_unit_nama ?></option>
                                                <?php
                                                foreach ($unit->result() as $value) {
                                                ?>
<!--                                                     <option value="<?= $value->unit_id ?>" <?= selected($value->unit_id, $pegawai->pegawai_unit_id) ?>><?= $value->unit_nama ?></option> -->
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group" id="divnip">
                                            <label>NIP</label>
                                            <input type="text" class="form-control" name="nip_update" id="nip_update" value="<?= $pegawai->pegawai_nip ?>" required="true" <?= $this->session->userdata('login')['group_id'] == '1' ? '' : 'readonly="true"' ?> />
                                            <input type="hidden" class="form-control" name="nip" id="nip" value="<?= $pegawai->pegawai_nip ?>" required="true" <?= $this->session->userdata('login')['group_id'] == '1' ? '' : 'readonly="true"' ?> />

                                            <p class="help-block text-danger" id="msgnip"></p>
                                        </div>
                                        <div class="form-group">
                                            <label>NIP Lama</label>
                                            <input type="text" maxlength="9" class="form-control" name="nip_lama" value="<?= $pegawai->pegawai_nip_lama ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Pegawai</label>
                                            <input type="text" class="form-control" name="nama" value="<?= $pegawai->pegawai_nama ?>" required="true" <?= $this->session->userdata('login')['group_id'] == '1' ? '' : 'readonly="true"' ?> />
                                        </div>
                                        <div class="form-group">
                                            <label>Gelar</label>
                                            <div class="input-group-addon">
                                                <div class="col-lg-4">

                                                    <input type="text" class="form-control" placeholder="depan" name="gelar_depan" value="<?= $pegawai->pegawai_gelar_depan ?>" />
                                                </div>
                                                <div class="col-lg-4">

                                                    <input type="text" class="form-control" name="gelar_belakang" placeholder="belakang" value="<?= $pegawai->pegawai_gelar_belakang ?>" />

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="ttl">
                                            <label>Tempat dan Tgl Lahir</label>
                                            <div class="input-group-addon">
                                                <div class="col-lg-4">
                                                    <input type="text" class="form-control col-lg-4" placeholder="tempat lahir" name="tempat_lahir" value="<?= $pegawai->pegawai_tempat_lahir ?>" required="true" />
                                                </div>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control dateEntry2" placeholder="dd/mm/yyyy" name="tgl_lahir" placeholder="tgl lahir" value="<?= $pegawai->pegawai_tgl_lahir ?>" required="true" />
                                                </div>
                                            </div>

                                        </div>


                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($jenis_kelamin->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->jenkel_id ?>" <?= selected($value->jenkel_id, $pegawai->pegawai_jenkel_id) ?>><?= $value->jenkel_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Golongan Darah</label>
                                            <select class="form-control" name="golongan_darah" id="golongan_darah">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($golongan_darah->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->golongandarah_id ?>" <?= selected($value->golongandarah_id, $pegawai->pegawai_golongandarah_id) ?>><?= $value->golongandarah_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Agama</label>
                                            <select class="form-control" name="agama" id="agama">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($agama->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->agama_id ?>" <?= selected($value->agama_id, $pegawai->pegawai_agama_id) ?>><?= $value->agama_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Status Perkawinan</label>
                                            <select class="form-control" name="kawin" id="kawin">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($status_perkawinan->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->status_perkawinan_id ?>" <?= selected($value->status_perkawinan_id, $pegawai->pegawai_statusperkawinan_id) ?>><?= $value->status_perkawinan_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label>Propinsi</label>
                                                    <select class="form-control" name="propinsi" id="propinsi" required="true">
                                                        <option value="0">--Pilih Propinsi--</option>
                                                        <?php
                                                        if (!blank($propinsi)) {
                                                            foreach ($propinsi->result() as $value) {
                                                        ?>
                                                                <option value="<?= $value->propinsi_id ?>" <?php
                                                                                                            if (!blank($pegawai)) {
                                                                                                                selected($value->propinsi_id, $pegawai->pegawai_propinsi_id);
                                                                                                            }
                                                                                                            ?>><?= $value->propinsi_nama ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Kabupaten</label>
                                                    <select class="form-control" name="kabupaten" id="kabupaten">
                                                        <option value="0">--Pilih Kabupaten--</option>
                                                        <?php
                                                        if (!blank($kabupaten)) {
                                                            foreach ($kabupaten->result() as $value) {
                                                        ?>
                                                                <option value="<?= $value->kabupaten_id ?>" <?= selected($value->kabupaten_id, $pegawai->pegawai_kabupaten_id) ?>><?= $value->kabupaten_nama ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Kecamatan</label>
                                                    <select class="form-control" name="kecamatan" id="kecamatan">
                                                        <option value="0">--Pilih Kecamatan--</option>
                                                        <?php
                                                        if (!blank($kecamatan)) {
                                                            foreach ($kecamatan->result() as $value) {
                                                        ?>
                                                                <option value="<?= $value->kecamatan_id ?>" <?= selected($value->kecamatan_id, $pegawai->pegawai_kecamatan_id) ?>><?= $value->kecamatan_nama ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Kelurahan</label>
                                                    <select class="form-control" name="kelurahan" id="kelurahan">
                                                        <option value="0">--Pilih Kelurahan--</option>
                                                        <?php
                                                        if (!blank($kelurahan)) {
                                                            foreach ($kelurahan->result() as $value) {
                                                        ?>
                                                                <option value="<?= $value->kelurahan_id ?>" <?= selected($value->kelurahan_id, $pegawai->pegawai_kelurahan_id) ?>><?= $value->kelurahan_nama ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Jalan</label>
                                                    <input type="text" class="form-control" name="jalan" value="<?= $pegawai->pegawai_alamat ?>" />
                                                </div>

                                                <div class="form-group col-lg-4">
                                                    <label>RT</label>
                                                    <input type="text" class="form-control" name="rt" value="<?= $pegawai->pegawai_rt ?>" />
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label>RW</label>
                                                    <input type="text" class="form-control" name="rw" value="<?= $pegawai->pegawai_rw ?>" />
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label>Kode Pos</label>
                                                    <input type="text" class="form-control" name="kode_pos" value="<?= $pegawai->pegawai_kodepos ?>" />
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>No Telp</label>
                                            <input type="text" class="form-control" name="telp" value="<?= $pegawai->pegawai_telpon ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>No HP</label>
                                            <input type="text" class="form-control" name="hp" value="<?= $pegawai->pegawai_hp ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Status Pegawai</label>
                                            <select class="form-control" name="status_pegawai" id="status_pegawai">
                                                <option value="">--Pilih Status Pegawai--</option>
                                                <?php
                                                foreach ($status_kepegawaian->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->statuskepegawaian_id ?>" <?= selected($value->statuskepegawaian_id, $pegawai->pegawai_status_kepegawaian_id) ?>><?= $value->statuskepegawaian_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>


                                        <div class="panel-body " id="aktif">

                                            <div class="form-group ">
                                                <label>Jenis Kedudukan</label>
                                                <select class="form-control" name="jenis_jabatan" id="kedudukan_jabatan">
                                                    <option value="">--Pilih Jenis Kedudukan--</option>
                                                    <?php
                                                    foreach ($kedudukan_jabatan->result() as $value) {
                                                    ?>
                                                        <option value="<?= $value->jeniskedudukan_kode ?>" <?= selected($value->jeniskedudukan_kode, $pegawai->pegawai_jenisjabatan_kode) ?>><?= $value->jeniskedudukan_nama ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>


                                        </div>
                                        <div class="form-group hide" id="meninggal">
                                            <label>Jika Meninggal</label>
                                            <input type="text" class="form-control" name="keterangan_kematian" />
                                        </div>

                                        <div class="form-group">
                                            <label>No Karpeg</label>
                                            <input type="text" class="form-control" name="karpeg" value="<?= $pegawai->pegawai_no_karpeg ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>No Askes / BPJS</label>
                                            <input type="text" class="form-control" name="askes" value="<?= $pegawai->pegawai_no_askes ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>No Taspen</label>
                                            <input type="text" class="form-control" name="taspen" value="<?= $pegawai->pegawai_no_taspen ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>No Karis / Karsu</label>
                                            <input type="text" class="form-control" name="karis_karsu" value="<?= $pegawai->pegawai_no_karis ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>No NPWP</label>
                                            <input type="text" class="form-control" name="npwp" value="<?= $pegawai->pegawai_no_npwp ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>No KK</label>
                                            <input type="text" class="form-control" name="kk" value="<?= $pegawai->pegawai_no_kk ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>No KTP</label>
                                            <input type="text" class="form-control" name="ktp" value="<?= $pegawai->pegawai_no_ktp ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" name="email" value="<?= $pegawai->pegawai_email ?>" />
                                        </div>
                                        <div class="form-group">

                                            <div class="panel-body">
                                                <div class="col-lg-4">
                                                    <label>Foto</label>
                                                    <div class="form-group">
                                                        <?php
                                                        if (!blank($pegawai->pegawai_foto_kpe)) {
                                                            if (file_exists(('assets/images/' . $pegawai->pegawai_foto_kpe))) {
                                                            	$foto = $pegawai->pegawai_foto_kpe;
                                                                $fotokpe = 'assets/images/' . $pegawai->pegawai_foto_kpe;
                                                            } else {
                                                                $foto = str_replace(".jpg", ".jpeg", $pegawai->pegawai_foto_kpe);
                                                                if (file_exists(('assets/images/' . $foto))) {
                                                                    $fotokpe = 'assets/images/' . $foto;
                                                                } else {
                                                                    $fotokpe = 'assets/images/' . 'user.jpg';
                                                                }
                                                            }
                                                        } else {
                                                            $fotokpe = 'default.jpg';
                                                        	$foto = '';
                                                        }
                                                        ?>
                                                        <img class="img-responsive img-rounded img-thumbnail " width="50" height="75" alt="<?= $fotokpe ?>" src="<?= base_url($fotokpe) . '?image=' . time() ?>" />
                                                        <input type="file" id="userfile" name="userfile" class="form-control" accept="image/*" />
                                                        <input type="hidden" id="userfile_old" name="userfile_old" value="<?= $foto ?>" class="form-control" />
                                                   <input type="hidden" id="userfile_webcam" name="userfile_webcam" value="" class="form-control" />
                                                    </div>
                                                </div>

                                            </div>
                                            
                                            
                                            <div class="panel-body">
                                                <div class="col-lg-4">
                                                    <label>Ambil Foto</label>
                                                    <div class="form-group">
                                                        <!-- CSS -->
                                                        <style>
                                                        #my_camera{
                                                            width: 380px;
                                                            height: 480px;
                                                            border: 1px solid black;
                                                        }
                                                        </style>

                                                        <!-- -->
                                                        <div id="my_camera"></div>
                                                        <input type=button value="Mulai" onClick="configure()"> <br>
                                                        <input type=button value="Foto" onClick="take_snapshot()">
                                                        <!-- <input type=button value="Simpan" onClick="saveSnap()"> -->
                                                        <div id="results"  ></div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            
	
                                        </div>

                                        <div class="input-group-addon">
                                            <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#modalSimpan">Simpan</button>
                                            <button type="reset" class="btn btn-default">Reset</button>
                                        </div>

                                    </div>
                                    <!-- /.panel-body -->
                                </div>

                            </div>




                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4 hide" id="menu-edit">
                <div class="box">

                    <div class="box-body">
                        <?= $menu_pegawai ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="form-read">
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header">

                    </div>
                    <div class="box-body table-responsive">
                        <form>


                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <b> IDENTITAS PEGAWAI</b>
                                        <!--                                     	<div class="pull-right"> -->
                                        <button class="btn btn-primary btn-sm pull-right" type="button" id="ubahtod">Ubah</button>
                                        <!--           								</div> -->
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label>Masuk Sanggau <br>
                                            <input type="checkbox" disabled  value="1" <?= $pegawai->pegawai_masuk_sanggau == '1' ? 'checked' : ''; ?>/>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label>OPD</label>
                                            <select class="form-control" disabled>
                                                <option><?= $pegawai->pegawai_unit_nama ?></option>
                                                <?php
                                                foreach ($unit->result() as $value) {
                                                ?>
<!--                                                     <option value="<?= $value->unit_id ?>" <?= selected($value->unit_id, $pegawai->pegawai_unit_id) ?>><?= $value->unit_nama ?></option> -->
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>NIP</label>
                                            <input type="text" class="form-control" readonly value="<?= $pegawai->pegawai_nip ?>" />

                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="form-group">
                                            <label>NIP Lama</label>
                                            <input type="text" maxlength="9" class="form-control" readonly value="<?= $pegawai->pegawai_nip_lama ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Pegawai</label>
                                            <input type="text" class="form-control" readonly value="<?= $pegawai->pegawai_nama ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Gelar</label>
                                            <div class="input-group-addon">
                                                <div class="col-lg-4">

                                                    <input type="text" class="form-control" readonly placeholder="depan" value="<?= $pegawai->pegawai_gelar_depan ?>" />
                                                </div>
                                                <div class="col-lg-4">

                                                    <input type="text" class="form-control" readonly placeholder="belakang" value="<?= $pegawai->pegawai_gelar_belakang ?>" />

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Tempat dan Tgl Lahir</label>
                                            <div class="input-group-addon">
                                                <div class="col-lg-4">
                                                    <input type="text" class="form-control col-lg-4" readonly placeholder="tempat lahir" value="<?= $pegawai->pegawai_tempat_lahir ?>" />
                                                </div>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" readonly placeholder="dd/mm/yyyy" placeholder="tgl lahir" value="<?= $pegawai->pegawai_tgl_lahir ?>" />
                                                </div>
                                            </div>

                                        </div>


                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <select class="form-control" disabled>
                                                <option value=""></option>
                                                <?php
                                                foreach ($jenis_kelamin->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->jenkel_id ?>" <?= selected($value->jenkel_id, $pegawai->pegawai_jenkel_id) ?>><?= $value->jenkel_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Golongan Darah</label>
                                            <select class="form-control" disabled>
                                                <option value=""></option>
                                                <?php
                                                foreach ($golongan_darah->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->golongandarah_id ?>" <?= selected($value->golongandarah_id, $pegawai->pegawai_golongandarah_id) ?>><?= $value->golongandarah_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Agama</label>
                                            <select class="form-control" disabled>
                                                <option value=""></option>
                                                <?php
                                                foreach ($agama->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->agama_id ?>" <?= selected($value->agama_id, $pegawai->pegawai_agama_id) ?>><?= $value->agama_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Status Perkawinan</label>
                                            <select class="form-control" disabled>
                                                <option value=""></option>
                                                <?php
                                                foreach ($status_perkawinan->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->status_perkawinan_id ?>" <?= selected($value->status_perkawinan_id, $pegawai->pegawai_statusperkawinan_id) ?>><?= $value->status_perkawinan_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label>Propinsi</label>
                                                    <select class="form-control" disabled>
                                                        <option value="0"></option>
                                                        <?php
                                                        if (!blank($propinsi)) {
                                                            foreach ($propinsi->result() as $value) {
                                                        ?>
                                                                <option value="<?= $value->propinsi_id ?>" <?php
                                                                                                            if (!blank($pegawai)) {
                                                                                                                selected($value->propinsi_id, $pegawai->pegawai_propinsi_id);
                                                                                                            }
                                                                                                            ?>><?= $value->propinsi_nama ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Kabupaten</label>
                                                    <select class="form-control" disabled>
                                                        <option value="0"></option>
                                                        <?php
                                                        if (!blank($kabupaten)) {
                                                            foreach ($kabupaten->result() as $value) {
                                                        ?>
                                                                <option value="<?= $value->kabupaten_id ?>" <?= selected($value->kabupaten_id, $pegawai->pegawai_kabupaten_id) ?>><?= $value->kabupaten_nama ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Kecamatan</label>
                                                    <select class="form-control" disabled>
                                                        <option value="0"></option>
                                                        <?php
                                                        if (!blank($kecamatan)) {
                                                            foreach ($kecamatan->result() as $value) {
                                                        ?>
                                                                <option value="<?= $value->kecamatan_id ?>" <?= selected($value->kecamatan_id, $pegawai->pegawai_kecamatan_id) ?>><?= $value->kecamatan_nama ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Kelurahan</label>
                                                    <select class="form-control" disabled>
                                                        <option value="0"></option>
                                                        <?php
                                                        if (!blank($kelurahan)) {
                                                            foreach ($kelurahan->result() as $value) {
                                                        ?>
                                                                <option value="<?= $value->kelurahan_id ?>" <?= selected($value->kelurahan_id, $pegawai->pegawai_kelurahan_id) ?>><?= $value->kelurahan_nama ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Jalan</label>
                                                    <input type="text" class="form-control" readonly value="<?= $pegawai->pegawai_alamat ?>" />
                                                </div>

                                                <div class="form-group col-lg-4">
                                                    <label>RT</label>
                                                    <input type="text" class="form-control" readonly value="<?= $pegawai->pegawai_rt ?>" />
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label>RW</label>
                                                    <input type="text" class="form-control" readonly value="<?= $pegawai->pegawai_rw ?>" />
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label>Kode Pos</label>
                                                    <input type="text" class="form-control" readonly value="<?= $pegawai->pegawai_kodepos ?>" />
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>No Telp</label>
                                            <input type="text" class="form-control" readonly value="<?= $pegawai->pegawai_telpon ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>No HP</label>
                                            <input type="text" class="form-control" readonly value="<?= $pegawai->pegawai_hp ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Status Pegawai</label>
                                            <select class="form-control" disabled>
                                                <option value=""></option>
                                                <?php
                                                foreach ($status_kepegawaian->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->statuskepegawaian_id ?>" <?= selected($value->statuskepegawaian_id, $pegawai->pegawai_status_kepegawaian_id) ?>><?= $value->statuskepegawaian_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>


                                        <div class="panel-body ">

                                            <div class="form-group ">
                                                <label>Jenis Kedudukan</label>
                                                <select class="form-control" disabled>
                                                    <option value=""></option>
                                                    <?php
                                                    foreach ($kedudukan_jabatan->result() as $value) {
                                                    ?>
                                                        <option value="<?= $value->jeniskedudukan_kode ?>" <?= selected($value->jeniskedudukan_kode, $pegawai->pegawai_jenisjabatan_kode) ?>><?= $value->jeniskedudukan_nama ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>


                                        </div>

                                        <div class="form-group">
                                            <label>No Karpeg</label>
                                            <input type="text" class="form-control" readonly value="<?= $pegawai->pegawai_no_karpeg ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>No Askes / BPJS</label>
                                            <input type="text" class="form-control" readonly value="<?= $pegawai->pegawai_no_askes ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>No Taspen</label>
                                            <input type="text" class="form-control" readonly value="<?= $pegawai->pegawai_no_taspen ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>No Karis / Karsu</label>
                                            <input type="text" class="form-control" readonly value="<?= $pegawai->pegawai_no_karis ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>No NPWP</label>
                                            <input type="text" class="form-control" readonly value="<?= $pegawai->pegawai_no_npwp ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>No KK</label>
                                            <input type="text" class="form-control" readonly value="<?= $pegawai->pegawai_no_kk ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>No KTP</label>
                                            <input type="text" class="form-control" readonly value="<?= $pegawai->pegawai_no_ktp ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" readonly value="<?= $pegawai->pegawai_email ?>" />
                                        </div>
                                        <div class="form-group">

                                            <div class="panel-body">
                                                <div class="col-lg-4">
                                                    <label>Foto</label>
                                                    <div class="form-group">
                                                        <?php
                                                        if (!blank($pegawai->pegawai_foto_kpe)) {
                                                            if (file_exists(('assets/images/' . $pegawai->pegawai_foto_kpe))) {
                                                                $fotokpe = 'assets/images/' . $pegawai->pegawai_foto_kpe;
                                                            } else {
                                                                $foto = str_replace(".jpg", ".jpeg", $pegawai->pegawai_foto_kpe);
                                                                if (file_exists(('assets/images/' . $foto))) {
                                                                    $fotokpe = 'assets/images/' . $foto;
                                                                } else {
                                                                    $fotokpe = 'assets/images/' . 'user.jpg';
                                                                }
                                                            }
                                                        } else {
                                                            $fotokpe = 'default.jpg';
                                                        }
                                                        ?>
                                                        <img class="img-responsive img-rounded img-thumbnail " width="50" height="75" alt="<?= $fotokpe ?>" src="<?= base_url($fotokpe) . '?image=' . time() ?>" />
                                                        <!--                                                         <input type="file" id="userfile" name="userfile" class="form-control" accept="image/*" /> -->
                                                    </div>
                                                </div>

                                            </div>



                                        </div>

                                        <!--                                         <div class="input-group-addon">
                                            <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#modalSimpan">Simpan</button>
                                            <button type="reset" class="btn btn-default">Reset</button>
                                        </div> -->

                                    </div>
                                    <!-- /.panel-body -->
                                </div>

                            </div>




                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4" id="menu-read">
                <div class="box">

                    <div class="box-body">
                        <?= $menu_pegawai ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Script -->
<script type="text/javascript" src="<?= base_url('assets/plugins/webcamjs/webcam.min.js') ?>"></script>

<script language="JavaScript">
		
    // Configure a few settings and attach camera
    function configure(){
        Webcam.set({
            width: 640,
            height: 480,
            crop_width: 380,
            crop_height: 480,
            image_format: 'jpeg',
            jpeg_quality: 100
        });
        Webcam.attach( '#my_camera' );
    }
    // A button for taking snaps
    

    // preload shutter audio clip
    var shutter = new Audio();
    shutter.autoplay = false;
    shutter.src = navigator.userAgent.match(/Firefox/) ? 'shutter.ogg' : 'shutter.mp3';

    function take_snapshot() {
        // play sound effect
        shutter.play();

        // take snapshot and get image data
        Webcam.snap( function(data_uri) {
            // display results in page
            document.getElementById('results').innerHTML = 
                '<img id="imageprev" src="'+data_uri+'"/>';
        } );

        
        var base64image =  document.getElementById("imageprev").src;
        $('#userfile_webcam').val(base64image);

        Webcam.reset();
    }

    function saveSnap(){
        // Get base64 value from <img id='imageprev'> source
        var base64image =  document.getElementById("imageprev").src;

            Webcam.upload( base64image, 'upload.php', function(code, text) {
                console.log('Save successfully');
                //console.log(text);
        });

    }
</script>

<script>
    $(document).ready(
        function() {
            //Date picker
            $('.date').datepicker({
                autoclose: true,
                format: 'dd-mm-yyyy'
            });

            $('#opd').change(
                function() {
                    if ($(this).val() != '') {

                        // load sub unit
                        $.ajax({
                            url: '<?= site_url('referensi/ReferensiJson/listSubUnitByIdUnit') ?>' + '/' + $(this).val(),
                            type: "POST",
                            data: {
                                ajax: '1'
                            },
                            dataType: "html",
                            success: function(data) {
                                $('#parent').html(data);
                                $('#parent').removeAttr('disabled');
                            }
                        });

                    }
                }
            );

            $('#propinsi').change(
                function() {
                    $.ajax({
                        url: '<?= site_url('referensi/ReferensiJson/listKabupatenByIdPropinsi') ?>' + '/' + $('#propinsi').val(),
                        type: "POST",
                        data: {
                            ajax: '1'
                        },
                        dataType: "html",
                        success: function(data) {
                            $('#kabupaten').html(data);
                        }
                    });
                }
            );

            $('#kabupaten').change(
                function() {
                    $.ajax({
                        url: '<?= site_url('referensi/ReferensiJson/listKecamatanByIdKabupaten') ?>' + '/' + $('#kabupaten').val(),
                        type: "POST",
                        data: {
                            ajax: '1'
                        },
                        dataType: "html",
                        success: function(data) {
                            $('#kecamatan').html(data);
                        }
                    });
                }
            );

            $('#kecamatan').change(
                function() {
                    $.ajax({
                        url: '<?= site_url('referensi/ReferensiJson/listKelurahanByIdKecamatan') ?>' + '/' + $('#kecamatan').val(),
                        type: "POST",
                        data: {
                            ajax: '1'
                        },
                        dataType: "html",
                        success: function(data) {
                            $('#kelurahan').html(data);
                        }
                    });
                }
            );

            $('#status_pegawai').change(
                function() {
                    var status = $('#status_pegawai').val();
                    if (status === "1" || status === "2") {
                        $('#panelpns').removeClass('hide');
                        $('#panelcpns').removeClass('hide');
                    } else {}
                }
            );
            $('#kedudukan_pegawai').change(
                function() {
                    var status = $('#kedudukan_pegawai').val();
                    if (status === "1") {
                        $('#aktif').removeClass('hide');
                        $('#meninggal').addClass('hide');
                    } else if (status === "10") {
                        $('#aktif').addClass('hide');
                        $('#meninggal').removeClass('hide');
                    } else {
                        $('#aktif').addClass('hide');
                        $('#meninggal').addClass('hide');
                    }
                }
            );
            $('#kedudukan_jabatan').change(
                function() {
                    if ($(this).val() != '') {

                        if ($('#status_pegawai').val() <= 2) {

                            // load kedudukan jabatan
                            $.ajax({
                                url: '<?= site_url('referensi/ReferensiJson/getJenisKedudukanByJabatan') ?>' + '/' + $(this).val(),
                                type: "POST",
                                data: {
                                    ajax: '1'
                                },
                                dataType: "json",
                                success: function(data) {
                                    //                                        alert(data.id);
                                    $('#jenis_kedudukan').val(data.id);
                                    //$('#jenis_kedudukan_nama').val(data.nama);
                                }
                            });
                        }
                    }
                }
            );
            $('#status_pegawai').change(
                function() {
                    if ($(this).val() != '') {

                        if ($(this).val() > 2) {

                            // show 
                            $('#panelpns').addClass('hide');
                            $('#panelcpns').addClass('hide');
                        } else {
                            $('#panelpns').removeClass('hide');
                            $('#panelcpns').removeClass('hide');
                        }
                    }
                }
            );


            $('#ubahtod').on('click', function() {
                $('#form-edit').removeClass('hide');
                $('#menu-edit').removeClass('hide');
                $('#form-read').addClass('hide');
                $('#menu-read').addClass('hide');
                $('.dateEntry2').datetextentry({
                    show_tooltips: false,
                    errorbox_x: -135,
                    errorbox_y: 28
                });
            })
        }

    );
</script>