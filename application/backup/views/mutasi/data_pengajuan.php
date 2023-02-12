<div class="content-wrapper">               

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            Pengajuan Usulan Mutasi
        </h1>
    </section>


    <section class="content">
        <!-- <a href="<?= site_url('mutasi/Pengajuan/add') ?>" class="btn btn-primary" ><i class="fa fa-plus"></i> Pengajuan Baru</a>
        <br />
        <br /> -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                    </div>
                    <div class="box-body table-responsive">
                        <table id="mytable" class="table table-bordered table-striped" width="100%">
                            <thead>
                                <tr>
                                    <th width="45px">No</th>
                                    <th>Status</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Jenis Mutasi</th>
                                    <th>Keterangan</th>
                                    <th>File SK</th>
                                    <th>Aksi</th>
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
				<h4 class="modal-title">Upload File SK</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<form action="" id="form_permohonan" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-6 form-group">
							<label for="">File SK</label>
							<input type="file" name="file" id="file" class="form-control">
				      <input type="hidden" name="id_mutasi" id="id_mutasi" value="">
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
				<button id="btn-upload" type="button" class="btn btn-success" data-dismiss="modal">Upload</button>
			</div>

		</div>
	</div>
</div>

<!-- /.modal -->

<div class="modal fade" id="modal-update">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" action="<?= site_url('referensi/agama/update') ?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Agama</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="" name="id" id="edit_id">
                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control" value="" name="nama" id="edit_nama" autocomplete="off">
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<link rel="stylesheet" href="<?= base_url() ?>assets/sweetalert/sweetalert.css">
<script src="<?= base_url() ?>assets/sweetalert/sweetalert.min.js"></script>

<script>
  
  function upload_sk(v) {
			$('#id_mutasi').val(v);
			$('#myModal2').modal('show');
				
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

    var t = $("#mytable").dataTable({
      initComplete: function() {
        var api = this.api();
        $('#mytable_filter input')
          .off('.DT')
          .on('keyup.DT', function(e) {
            if (e.keyCode == 13) {
              api.search(this.value).draw();
            }
          });
        },
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
        //   data.id_pemilik = $('#pemilik').val();
        //   data.id_pengguna = $('#id_pengguna').val();
        //   data.id_kuasa_pengguna = $('#id_kuasa_pengguna').val();
        }
      },
      columns: [{
          "data": "usulan_id",
          "orderable": false,
        },
        {
          "data": "usulan_status"
        },
        {
          "data": "usulan_nip"
        },
        {
          "data": "pegawai_nama"
        },
        {
          "data": "usulan_jenis",
          "searchable": false
        },
        {
          "data": "keterangan"
        },
        {
          "data": "file_sk",
          "searchable": false
        },
        {
          "data": "action",
          "orderable": false,
          "className" : "text-center",
          'width': '15%'
        },
      ],
      order: [
        [0, 'desc']
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

    
		$('#btn-upload').click(function(){
			
			var frm = $('#form_permohonan');
        	var formData = new FormData(frm[0]);

							$.ajax({
								type: "POST", // Method pengiriman data bisa dengan GET atau POST
								url: "<?= site_url('mutasi/DataPengajuan/update/sk/') ?>",
								dataType: "JSON",
								data: formData,
								processData: false,
								contentType: false,
								success: function(response) {
                  location.reload();
								},
								error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
									swal(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
								}
							});
		})

});
</script>