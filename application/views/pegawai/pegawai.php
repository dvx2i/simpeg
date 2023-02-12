<div class="content-wrapper">

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            List Pegawai
        </h1>
    </section>


    <section class="content">
    <?php if($this->session->userdata('login')['group_id'] == '1') : ?>
        <a href="<?= site_url('pegawai/PegawaiBaru') ?>" class="btn btn-primary">Tambah Pegawai</a>
        <br />
        <br />
        <div class="box box-default color-palette-box">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-tag"></i> Filter</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-4 col-md-2">
                        <div class="color-palette-set">
                            <div class="color-palette">
                                <label for="">Jenis Jabatan</label>
                            </div>
                            <div class="color-palette">
                                <select name="jenis_jabatan" class="form-control select2" id="jenis_jabatan">
                                    <option value="all">Semua</option>
                                    <?php foreach ($jenis_jabatan->result() as $key) : ?>
                                        <option value="<?= $key->jeniskedudukan_kode ?>"><?= $key->jeniskedudukan_nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 col-md-2">
                        <div class="color-palette-set">
                            <div class="color-palette">
                                <label for="">Pangkat</label>
                            </div>
                            <div class="color-palette">
                                <select name="pangkat" class="form-control select2" id="pangkat">
                                    <option value="all">Semua</option>
                                    <?php foreach ($pangkat_golongan->result() as $key) : ?>
                                        <option value="<?= $key->pangkat_golongan_id ?>"><?= $key->pangkat_golongan_text ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 col-md-2">
                        <div class="color-palette-set">
                            <div class="color-palette">
                                <label for="">Unit Kerja</label>
                            </div>
                            <div class="color-palette">
                                <select name="opd" class="form-control select2" id="opd">
                                    <option value="all">Semua</option>
                                    <?php foreach ($unit->result() as $key) : ?>
                                        <option value="<?= $key->unit_id ?>"><?= $key->unit_nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 col-md-2">
                        <div class="color-palette-set">
                            <div class="color-palette">
                                <label for="">Pendidikan</label>
                            </div>
                            <div class="color-palette">
                                <select name="pendidikan" class="form-control select2" id="pendidikan">
                                    <option value="all">Semua</option>
                                    <?php foreach ($pendidikan_tingkat->result() as $key) : ?>
                                        <option value="<?= $key->pendidikan_tingkat_kode ?>"><?= $key->pendidikan_tingkat_nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 col-md-2">
                        <div class="color-palette-set">
                            <div class="color-palette">
                                <label for="">Agama</label>
                            </div>
                            <div class="color-palette">
                                <select name="agama" class="form-control select2" id="agama">
                                    <option value="all">Semua</option>
                                    <?php foreach ($agama->result() as $key) : ?>
                                        <option value="<?= $key->agama_id ?>"><?= $key->agama_nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 col-md-2">
                        <div class="color-palette-set">
                            <div class="color-palette">
                                <label for="">Eselon</label>
                            </div>
                            <div class="color-palette">
                                <select name="eselon" class="form-control select2" id="eselon">
                                    <option value="all">Semua</option>
                                    <?php foreach ($eselon->result() as $key) : ?>
                                        <option value="<?= $key->eselon_kode ?>"><?= $key->eselon_nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-2">
                        <div class="color-palette-set">
                            <div class="color-palette">
                                <label for="">Jenis Kelamin</label>
                            </div>
                            <div class="color-palette">
                                <select name="jk" class="form-control select2" id="jk">
                                    <option value="all">Semua</option>
                                        <option value="1">Laki-laki</option>
                                        <option value="2">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 col-md-2">
                        <div class="color-palette-set">
                            <div class="color-palette">
                                <label for="">Status Pegawai</label>
                            </div>
                            <div class="color-palette">
                				<select class="form-control select2" name="status_pegawai" id="status_pegawai" required="true">
                                    <option value="all">Semua</option>
                                  <option value="1">CPNS</option>
                                  <option value="2">PNS</option>
                                  <option value="3">Tenaga Bantuan</option>
                                  <option value="5">Pegawai Titipan</option>
                                  <option value="6">Kepala Daerah</option>
                                 <option value="7">Wakil Kepala Daerah</option>
                                  <option value="8">PPPK</option>
                      			</select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-2">
                        <div class="color-palette-set">
                            <div class="color-palette">
                                <label for="">Pegawai Masuk Sanggau</label>
                            </div>
                            <div class="color-palette">
                				<select class="form-control select2" name="pegawai_masuk_sanggau" id="pegawai_masuk_sanggau" required="true">
                                    <option value="all">Semua</option>
                                  <option value="0">Tidak</option>
                                  <option value="1">Ya</option>
                      			</select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-2">
                        <div class="color-palette-set">
                            <div class="color-palette">
                                <label for="">Jenis Pengadaan</label>
                            </div>
                            <div class="color-palette">
                                            <select class="form-control select2" id="pegawai_cpns_jenis_pengadaan">
                                    <option value="all">Semua</option>
                                            	<option value="1">UMUM</option>
                                            	<option value="2">DISABILITAS</option>
                                            	<option value="3">HONORER</option>
                                            	<option value="4">P3K</option>
                                            	<option value="5">PTT KEMENKES</option>
                                            	<option value="6">GURU GARIS DEPAN</option>
                                           		<option value="7">TENAGA  HARIAN LEPAS-TENAGA BANTU PENYULUH PERTANIAN (THL-TBPP)</option>       
                                        	</select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-2">
                        <div class="color-palette-set">
                            <div class="color-palette">
                                <label for="">&nbsp;</label>
                            </div>
                            <div class="color-palette">
                                <button class="btn btn-primary btn-sm" id="btn-filter">Filter</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    <?php endif; ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                    </div>
                    <div class="box-body table-responsive">
                        <table id="tabelss" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Pangkat / Golru</th>
                                    <th>Jabatan</th>
                                    <th>Eselon</th>
                                    <th>OPD/Unit Kerja</th>
                                    <th>Pendidikan</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    <th>Email</th>
                                    <th width="20%">Administrator</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    var tableData;
    $(document).ready(function() {

        tableData = $('#tabelss').DataTable({
            "pageLength": 10,
            "order": [
                [0, "asc"]
            ],
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: '<?= site_url('pegawai/Pegawai/table') ?>',
                type: 'POST',
                data: function(data) {
                    data.jenis_jabatan = $('#jenis_jabatan').val();
                    data.pangkat = $('#pangkat').val();
                    data.opd = $('#opd').val();
                    data.pendidikan = $('#pendidikan').val();
                    data.agama = $('#agama').val();
                    data.eselon = $('#eselon').val();
                    data.jk = $('#jk').val();
                    data.status_pegawai = $('#status_pegawai').val();
                    data.pegawai_masuk_sanggau = $('#pegawai_masuk_sanggau').val();
                	data.pegawai_cpns_jenis_pengadaan = $('#pegawai_cpns_jenis_pengadaan').val();
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(xhr);
                    if (xhr.responseText == 'session timeout') {
                        alert('Sesi anda telah habis. Silahkan LOGIN kembali');
                        window.location = "<?= site_url('Akun') ?>";
                    } else {
                        alert('Terjadi kesalahan sistem');
                    }
                }
            },
            dom: '<"dataTables_wrapper dt-bootstrap"<"row flex"<"col-md-2 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex mr-0 mr-sm-3"l>><"col-md-4 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex"B>><"col-md-6 d-flex d-xl-block"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>>',
            buttons: [
                {
				text: 'Excel',
				attr: {
					id: 'excelBtn',
					class: 'btn btn-primary',
					// style: 'border-radius: 6px;'
				    }
			    }, 
                {
                    extend: 'pdf',
                    className: 'btn btn-primary',
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6,7,8,9,10]
                    }
                },
                {
                    extend: 'print',
                    className: 'btn btn-primary',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6,7,8,9,10]
                    }
                },
            ],
        });


    });


    $('#btn-filter').on('click', function() {
        tableData.ajax.reload();
    });
    
		$(document).on('click', '#excelBtn', function() { //Cetak BY name
			// var table = $("#my-table").DataTable();
			// var oData = table.rows().data();

			// if (oData.length > 0) {

            var jenis_jabatan = $('#jenis_jabatan').val();
            var pangkat = $('#pangkat').val();
            var opd = $('#opd').val();
            var pendidikan = $('#pendidikan').val();
            var agama = $('#agama').val();
            var eselon = $('#eselon').val();
            var jk = $('#jk').val();
            var status_pegawai = $('#status_pegawai').val();

            var form = "<form id='hidden-form' action='<?= site_url('pegawai/Pegawai/cetak/excel') ?>' method='post' target='_blank'>";

            form += "<input type='hidden' name='jenis_jabatan' value='" + jenis_jabatan + "'/>";
            form += "<input type='hidden' name='pangkat' value='" + pangkat + "'/>";
            form += "<input type='hidden' name='opd' value='" + opd + "'/>";
            form += "<input type='hidden' name='pendidikan' value='" + pendidikan + "'/>";
            form += "<input type='hidden' name='agama' value='" + agama + "'/>";
            form += "<input type='hidden' name='eselon' value='" + eselon + "'/>";
            form += "<input type='hidden' name='jk' value='" + jk + "'/>";
            form += "<input type='hidden' name='status_pegawai' value='" + status_pegawai + "'/>";

            $(form + "</form>").appendTo($(document.body)).submit();


		});
</script>