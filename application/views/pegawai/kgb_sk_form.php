<div class="content-wrapper">

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            Ubah Surat Keterangan Kenaikan Gaji Berkala
        </h1>
    </section>


    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                    </div>
                    <div class="box-body table-responsive">
                        <form role="form" action="<?= site_url('pegawai/PegawaiKgb/update/sk') ?>" method="post" >


                            <div class=" col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <b> FORM SURAT KETERANGAN</b>
                                </div>
                                <div class="panel-body">


                                    <div class="form-group">
                                        <label>NIP</label>
                                        <div class="form-group">

                                            <input type="text" class="form-control" name="nip" id="nip"value="<?= $nip ?>" maxlength="255" disabled />

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Pegawai</label>
                                        <input type="text" class="form-control" name="nama" id="nama" value="<?= $nama ?>" maxlength="255" disabled />
                                    </div>

                                    <div class="form-group ">
                                        <label>Jabatan</label>
                                        <input type="text" class="form-control" name="jabatan" value="<?= $jabatan ?>" id="jabatan" maxlength="255"  />

                                    </div>
                                    <div class="form-group">
                                        <label>Pangkat</label>
                                        <div class="form-group">

                                            <input type="text" class="form-control" name="pangkat" id="pangkat" value="<?= $pangkat ?>" maxlength="255"  />

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Golongan Sekarang</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="golru" id="golru" value="<?= $golongan ?>" maxlength="255"  />

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Unit Kerja</label>
                                        <div class="form-group">

<!--                                             <input type="text" class="form-control" name="unit" id="unit" value="<?= $unit_kerja ?>" maxlength="255"  /> -->
                                        	
                                            <select class="form-control select2" name="unit" id="unit">
                                                <?php
                                                foreach ($unit->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->unit_nama ?>" <?php
                                                                                            selected($value->unit_nama, $unit_kerja);
                                                                                            ?>><?= $value->unit_nama ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>No SK Sebelumnya</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="nosk_lama" id="nosk_lama" value="<?= $no_sk_old ?>" maxlength="255"  />

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal SK Sebelumnya</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control dateEntry" name="tgl_sk_old" id="tgl_sk_old" value="<?= $tgl_sk_old ?>" maxlength="255"  />

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Masa Kerja Tahun Sebelumnya</label>
                                        <div class="form-group">
                                            <input type="text" onkeyup="angka(this);"  class="form-control" name="tahun_lama" id="tahun_lama" value="<?= $masa_kerja_tahun_old ?>" maxlength="255"  />

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Masa Kerja Bulan Sebelumnya</label>
                                        <div class="form-group">
                                            <input type="text" onkeyup="angka(this);"  class="form-control" name="bulan_lama" id="bulan_lama" value="<?= $masa_kerja_bulan_old ?>" maxlength="255"  />

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Gaji Pokok Sebelumnya</label>
                                        <div class="form-group">
                                            <input type="text" onkeyup="angka(this);"  class="form-control" name="gaji_lama" id="gaji_lama" value="<?= $gaji_old ?>" maxlength="255"  />

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>TMT Kenaikan Gaji Sebelumnya</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control  dateEntry" name="tmt_lama" id="tmt_lama" value="<?= $tmt_old ?>" maxlength="255"  />

                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Masa Kerja Tahun Sekarang</label>
                                        <div class="form-group">
                                            <input type="text" onkeyup="angka(this);"  class="form-control" name="tahun_baru" id="tahun_baru" value="<?= $masa_kerja_tahun ?>" maxlength="255"  />

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Masa Kerja Bulan Sekarang</label>
                                        <div class="form-group">
                                            <input type="text" onkeyup="angka(this);"  class="form-control" name="bulan_baru" id="bulan_baru" value="<?= $masa_kerja_bulan ?>" maxlength="255"  />

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Gaji Pokok Baru</label>
                                        <div class="form-group">
                                            <input type="text" onkeyup="angka(this);"  class="form-control" name="gaji_baru" id="gaji_baru" value="<?= $gaji_baru ?>" maxlength="255"  />

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>TMT Kenaikan Gaji </label>
                                        <div class="form-group">
                                            <input type="text" class="form-control dateEntry" name="tmt_baru" id="tmt_baru" value="<?= $tmt ?>" maxlength="255"  />

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Tembusan</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="tembusan" id="tembusan" value="<?= $kgbsk_tembusan ?>" maxlength="255"  />

                                        </div>
                                    </div>
                                    <input type="hidden" name="kgb_id" value="<?= $kgb_id ?>">

                                </div>
                                <!-- /.panel-body -->
                            </div>

                    </div>



                    <div class="input-group-addon">
                        <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#modalSimpan">Simpan</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                    </div>

                    </form>
                </div>
            </div>
        </div>
</div>
</section>
</div>


<script>
    $(document).ready(
        function() {
        
        
        var tahun_lama = $('#tahun_lama').val();
        var pangkat = $('#golru').val();
        // load kedudukan jabatan
        $.ajax({
            url: '<?= site_url('referensi/ReferensiJson/getJumlahGajiByGolruMasaKerja/') ?>',
            type: "POST",
            data: {
                ajax: '1',
                pangkat: pangkat,
                masa: tahun_lama,
            },
            dataType: "html",
            success: function(data) {
                $('#gaji_lama').val(data);
            }
        });
        
        var tahun_baru = $('#tahun_baru').val();
        var pangkat = $('#golru').val();
        // load kedudukan jabatan
        $.ajax({
            url: '<?= site_url('referensi/ReferensiJson/getJumlahGajiByGolruMasaKerja/') ?>',
            type: "POST",
            data: {
                ajax: '1',
                pangkat: pangkat,
                masa: tahun_baru,
            },
            dataType: "html",
            success: function(data) {
                $('#gaji_baru').val(data);
            }
        });


    $('#tahun_lama').keyup(function(e) {
        var target = e.srcElement || e.target;
        var maxLength = parseInt(target.attributes["maxlength"].value, 10);
        var myLength = target.value.length;
        // alert(myLength);
        // return false;
        var masa = $(this).val();
        var pangkat = $('#golru').val();
        // load kedudukan jabatan
        $.ajax({
            url: '<?= site_url('referensi/ReferensiJson/getJumlahGajiByGolruMasaKerja/') ?>',
            type: "POST",
            data: {
                ajax: '1',
                pangkat: pangkat,
                masa: masa,
            },
            dataType: "html",
            success: function(data) {
                $('#gaji_lama').val(data);
            }
        });
    
        if (myLength >= maxLength) {
            var next = $('#bulan_lama');
            next.focus();
        }
    });


    $('#tahun_baru').keyup(function(e) {
        var target = e.srcElement || e.target;
        var maxLength = parseInt(target.attributes["maxlength"].value, 10);
        var myLength = target.value.length;
        // alert(myLength);
        // return false;
        var masa = $(this).val();
        var pangkat = $('#golru').val();
        // load kedudukan jabatan
        $.ajax({
            url: '<?= site_url('referensi/ReferensiJson/getJumlahGajiByGolruMasaKerja/') ?>',
            type: "POST",
            data: {
                ajax: '1',
                pangkat: pangkat,
                masa: masa,
            },
            dataType: "html",
            success: function(data) {
                $('#gaji_baru').val(data);
            }
        });
    
        if (myLength >= maxLength) {
            var next = $('#bulan_baru');
            next.focus();
        }
    });

        }

    );
</script>