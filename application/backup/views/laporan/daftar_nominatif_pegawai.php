<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="content-wrapper">               

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            Daftar Nominatif Pegawai
        </h1>
    </section>


    <section class="content">

        <div class="row" id="riwayat">
            <div class="col-md-12">
                <div class="box">
                    
                    <div class="box-body ">
                        
                        <form role="form" action="<?= site_url('laporan/DaftarNominatifPegawai/excel/') ?>" target="_blank"   method="post" enctype="multipart/form-data">
                            <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <b> FILTER</b>
                                    </div>
                                    <div class="panel-body">
                            <div class="form-group">
                                <label>Unit Kerja</label>
                                <select class="form-control select2"  id="pegawai_unit_id" name="pegawai_unit_id">
                                    <option value="">-- PILIH --</option>
                                    <?php foreach ($unit->result() as $value) { ?>   
                                    <option value="<?= $value->unit_id ?>" <?php if(isset($where['pegawai_unit_id'])) echo selected($value->unit_id, $where['pegawai_unit_id'])?>><?= $value->unit_nama ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                                    
                            <input type="hidden" id="pegawai_pangkat_terakhir_id" name="pegawai_pangkat_terakhir_id" >
                            <?php /*
                            <div class="form-group">
                                <label>Pangkat/Golongan</label>
                                <select class="form-control"  id="pegawai_pangkat_terakhir_id" name="pegawai_pangkat_terakhir_id">
                                    <option value="">-- PILIH --</option>
                                    <?php foreach ($pangkat_golongan->result() as $value) { ?>   
                                        <option value="<?= $value->pangkat_golongan_id ?>" <?php if(isset($where['pegawai_pangkat_terakhir_id'])) echo selected($value->pangkat_golongan_id, $where['pegawai_pangkat_terakhir_id'])?> ><?= $value->pangkat_golongan_nama ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            */ ?>
                            <div class="form-group">
                                <label>Jenis Jabatan</label>
                                <select class="form-control"  id="pegawai_jenisjabatan_kode" name="pegawai_jenisjabatan_kode">
                                    <option value="">-- PILIH --</option>
                                    <?php foreach ($jabatan_kedudukan->result() as $value) { ?>   
                                        <option value="<?= $value->jeniskedudukan_kode ?>" <?php if(isset($where['pegawai_jenisjabatan_kode'])) echo selected($value->jeniskedudukan_kode, $where['pegawai_jenisjabatan_kode'])?> ><?= $value->jeniskedudukan_nama ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Eselon</label>
                                <select class="form-control"  id="pegawai_eselon_id" name="pegawai_eselon_id">
                                    <option value="">-- PILIH --</option>
                                    <?php foreach ($eselon->result() as $value) { ?>   
                                        <option value="<?= $value->eselon_kode ?>" <?php if(isset($where['pegawai_eselon_id'])) echo selected($value->eselon_kode, $where['pegawai_eselon_id'])?> ><?= $value->eselon_nama ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tingkat Pendidikan</label>
                                <select class="form-control"  id="pegawai_pendidikan_terakhir_tingkat" name="pegawai_pendidikan_terakhir_tingkat">
                                    <option value="">-- PILIH --</option>
                                    <?php foreach ($pendidikan_tingkat->result() as $value) { ?>   
                                        <option value="<?= $value->pendidikan_tingkat_nama ?>" <?php if(isset($where['pegawai_pendidikan_terakhir_tingkat'])) echo selected($value->pendidikan_tingkat_nama, $where['pegawai_pendidikan_terakhir_tingkat'])?> ><?= $value->pendidikan_tingkat_nama ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <input type="hidden"  id="pegawai_jenkel_id" name="pegawai_jenkel_id" >
                            <?php /*
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="form-control"  id="pegawai_jenkel_id" name="pegawai_jenkel_id">
                                    <option value="">-- PILIH --</option>
                                    <?php foreach ($jenis_kelamin->result() as $value) { ?>   
                                        <option value="<?= $value->jenkel_id ?>" <?php if(isset($where['pegawai_jenkel_id'])) echo selected($value->jenkel_id, $where['pegawai_jenkel_id'])?> ><?= $value->jenkel_nama ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            */ ?>
                            <div class="form-group">
                                <label>Kolom Excel</label>
                                <select required class="form-control select2" multiple id="kolom" name="kolom[]">
                                    <!-- <option value="">-- PILIH --</option> -->
                                    <?php foreach($kolom as $key) : ?>
                                        <option value="<?= $key->id ?>"><?= $key->nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="checkbox" id="checkbox" >Pilih Semua
                            </div>
                            <div class="input-group-addon">                                        
                                <button type="submit" class="btn btn-success" id="tampil"><i class="fa fa-file-excel-o"></i> Unduh Excel</button>
                            </div>
                                        </div>
                                    <!-- /.panel-body -->
                                </div>

                            </div>
                            </div>
                        </form>
                                        

                    </div>
                </div>
            </div>
            
        </div>
        <?php /*
        <div class="row" id="riwayat">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div style="float: right;padding-top: 3px;padding-right: 13px">
                        <form action="<?= site_url('laporan/DaftarNominatifPegawai/excel/') ?>" target="_blank" method="post" enctype="multipart/form-data">
                            <?php
                            foreach ($where as $key => $value) {
                                echo '<input type="hidden" value="'.$value.'" name="'.$key.'"/>';
                            }
                            
                            // if(!empty($where_kolom)) :
                            //     foreach ($where_kolom as $key => $value) {
                            //         echo '<input type="hidden" value="'.$value.'" name="'.$key.'"/>';
                            //     }
                            // endif;
                            ?>
                                                        
                            <button type="submit" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Excel</button>
                        </form>
                        
                    </div> 
                    <div class="panel-heading">
                        <i class="fa fa-users fa-fw"></i> Daftar Nominatif Pegawai
                    </div>
                    <div class="panel-body">
                        <p align="center"><span style="font-size:22pt;"><font color="black" size="4" face="Times New Roman, Times, serif"><strong><font face="Arial, Helvetica, sans-serif">
                                NOMINATIF PEGAWAI</font></strong></font></span><font color="black" face="Arial, Helvetica, sans-serif"><br>
                        <strong><font color="black" size="2" id="targetopdnama"></font><font color="black" size="2">
                            Keadaan : <?= tgl_indo(date('Y-m-d')) ?>&nbsp;</font></strong></font></p>
                    <p>  
                    <table width="100%" border="1" cellpadding="0" cellspacing="0" class="table">
                        <thead>
                            <tr bgcolor="white">
                                <td bgcolor="white"><b><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">No</font></div></b></td>
                                <td width="200" bgcolor="white"><b><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Nama 
                                            Pegawai<br>
                                            NIP / No.KARPEG<br>
                                            Tgl. Lahir/Sta.Kawin</font></div></b></td>
                                <td width="100" bgcolor="white"><b><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Pangkat<br>
                                            TMT<br>
                                            Masa Kerja</font></div></b></td>
                                <td width="300" bgcolor="white"><b><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Jabatan<br>
                                            Eselon/TMT</font></div></b></td>
                                <td width="150" bgcolor="white"><b><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Pendidikan<br>
                                            Terakhir</font></div></b></td>
                                <td width="200" bgcolor="white"><b><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Diklat 
                                            Struktural<br>
                                            Diklat Teknis Fungs.<br>
                                            Tahun</font></div></b></td>
                                <td width="200" bgcolor="white"><b><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Alamat</font></div></b></td>
                                <td bgcolor="white"><b><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Keterangan</font></div></b></td>
                            </tr>
                        </thead>
                        <tbody id="content">
                            <?php
                            $no = 0;
                            if(!empty($result)){
                            foreach ($result->result() as $value) {
                                $no++;
                                ?>
                                <tr bgcolor="white">
                                    <td><div align="left"><font color="black" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?= $no ?></font></div></td>
                                    <td><div align="left"><font color="black" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?= $value->pegawai_nama ?><br><?= $value->pegawai_nip ?><br><?= $value->pegawai_nip_lama ?> / <?= $value->pegawai_no_karpeg ?><br><?= $value->pegawai_tempat_lahir ?>, <?= tgl($value->pegawai_tgl_lahir) ?><br><?= $value->pegawai_statusperkawinan_nama ?><br><?= $value->pegawai_agama_nama ?></font></div></td>
                                    <td><div align="center"><font color="black" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?= $value->pegawai_pangkat_terakhir_golru ?><br><?= tgl($value->pegawai_pangkat_terakhir_tmt) ?><br><?= $value->pegawai_pangkat_terakhir_tahun . ' th ' . $value->pegawai_pangkat_terakhir_bulan . ' bln' ?></font></div></td>
                                    <td><div align="left"><font color="black" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?= $value->pegawai_jabatan_nama ?><br><?= $value->pegawai_unit_nama ?><br><?= $value->pegawai_eselon_nama . ' ' ?></font></div></td>
                                    <td><div align="left"><font color="black" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?= $value->pegawai_pendidikan_terakhir_tingkat ?><br><?= $value->pegawai_pendidikan_terakhir_nama ?> <br><?= $value->pegawai_pendidikan_terakhir_rumpun ?><br><?= tgl($value->pegawai_pendidikan_terakhir_tgl_ijazah) ?></font></div></td>
                                    <td><div align="left"><font color="black" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?= $value->pegawai_diklat_struktural_terakhir ?><br><?= $value->pegawai_diklat_struktural_terakhir_tahun ?></font></div></td>
                                    <td><div align="left"><font color="black" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?= $value->pegawai_alamat ?><br>RT : <?= $value->pegawai_rt ?>/RW : <?= $value->pegawai_rw ?><br><?= $value->pegawai_kelurahan_nama ?><br><?= $value->pegawai_kecamatan_nama ?><br><?= $value->pegawai_kabupaten_nama ?><br><?= $value->pegawai_propinsi_nama ?><br>Telp. : <?= $value->pegawai_hp ?></font></div></td>
                                    <td><div align="left"><font color="black" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?= $value->pegawai_keterangan ?></font></div></td>
                                </tr>
                            <?php }
                            }?>
                        </tbody>
                    </table>

                    </div>
                    <!-- /.panel-body -->
                </div>

            </div>
        </div>
         */ ?>
    </section>
</div>

<script>
    $("#checkbox").click(function(){
        if($("#checkbox").is(':checked') ){
            $("#kolom > option").prop("selected","selected");
            $("#kolom").trigger("change");
        }else{
            // $("#kolom > option").removeAttr("selected");
            $("#kolom").val(null).trigger("change"); 
        }
    });
</script>
