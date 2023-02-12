<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>


<link href="https://sipedas.sanggau.go.id/assets/plugins/uploader/dist/css/jquery.dm-uploader.min.css" rel="stylesheet">

<style>
    /* 
	A couple styles to make the demo page look good
 */
.row {
	margin-bottom: 1rem;
}
[class*="col-"] {
	padding-top: 1rem;
	padding-bottom: 1rem;
}
hr {
	margin-top: 2rem;
	margin-bottom: 2rem;
}
#files {
    overflow-y: scroll !important;
    min-height: 320px;
}
@media (min-width: 768px) {
	#files {
		min-height: 0;
	}
}
#debug {
	overflow-y: scroll !important;
	height: 180px;	
}

.dm-uploader {
	border: 0.25rem dashed #A5A5C7;
	text-align: center;
    min-height: 155px;
}
.dm-uploader.active {
	border-color: red;

	border-style: solid;
}
</style>

<div class="content-wrapper">

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            Tambah Data Pegawai Pensiun
        </h1>
    </section>


    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                    <div class="alert alert-info alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<h4><i class="icon fa fa-info"></i> Petunjuk!</h4>
1. Siapkan berkas DPCP / SK Pensiun<br>
2. Ganti nama berkas DPCP menjadi <b>NIP PEGAWAI_dpcp.pdf</b> <br>
3. Ganti nama berkas SK Pensiun menjadi <b>NIP PEGAWAI_sk.pdf</b> <br>
</div>
                    </div>
                    <div class="box-body ">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">

                                <!-- Our markup, the important part here! -->
                                <div id="drag-and-drop-zone" class="dm-uploader p-5">
                                    <h3 class="mb-5 mt-5 text-muted">Drag &amp; drop files here</h3>

                                    <div class="btn btn-primary btn-block mb-5">
                                        <span>Open the file Browser</span>
                                        <input type="file" title='Click to add Files' />
                                        <input type="hidden" id="time" value="<?= time() ?>">
                                    </div>
                                </div><!-- /uploader -->

                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="card h-100">
                                    <div class="card-header">
                                        File List
                                    </div>

                                    <ul class="list-unstyled p-2 d-flex flex-column col" id="files">
                                        <li class="text-muted text-center empty">No files uploaded.</li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- /file list -->
                        
                    </div>
                </div>
                <a href="<?= site_url('pensiun/PegawaiPensiun') ?>" class="btn btn-primary pull-right">Kembali</a>
            </div>
        </div>



    </section>
</div>
<script src="<?= base_url() ?>assets/sweetalert/sweetalert.min.js"></script>
    <script src="https://sipedas.sanggau.go.id/assets/uploader/dist/js/jquery.dm-uploader.min.js"></script>
    <script src="https://sipedas.sanggau.go.id/assets/uploader/demo-ui.js"></script>
    <script src="https://sipedas.sanggau.go.id/assets/uploader/demo-config.js"></script>
<!-- File item template -->
<script type="text/html" id="files-template">
      <li class="media">
        <div class="media-body mb-1">
          <p class="mb-2">
            <strong>%%filename%%</strong> - Status: <span class="text-muted">Waiting</span>
          </p>
          <div class="progress mb-2">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" 
              role="progressbar"
              style="width: 0%" 
              aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            </div>
          </div>
          <hr class="mt-1 mb-1" />
        </div>
      </li>
    </script>

    <!-- Debug item template -->
    <script type="text/html" id="debug-template">
      <li class="list-group-item text-%%color%%"><strong>%%date%%</strong>: %%message%%</li>
    </script>
<script>
    function refresh() {
        $('#formadd').attr('action', '<?= site_url('pegawai/PegawaiBahasa/add') ?>');
        document.getElementById('formadd').reset();
    }
</script>