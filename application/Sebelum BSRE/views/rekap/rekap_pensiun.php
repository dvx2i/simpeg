<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-wrapper">               

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            Rekap Pensiun / Berhenti
        </h1>
    </section>

    <section class="content">
        <div class="row hide" id="filter">
            <div class="col-lg-12">
                <div class="panel panel-default">                    
                    <div class="panel-heading">
                        <i class="fa fa-search fa-fw"></i> Filter 
                    </div>
                    <div class="panel-body">
                        <form role="form" action="" method="post" >
                            <div class="form-group">
                                <div class="input-group-addon">
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <div class="btn btn-default">Tahun</div>
                                            </span>
                                            <select class="form-control " name="tahun" id="tahun" required="true">

                                                <?php
                                                foreach ($list_tahun->result() as $value) {
                                                    ?>
                                                    <option value="<?= $value->tahun ?>" <?= selected($value->tahun, $tahun, TRUE) ?> ><?= $value->tahun ?></option>
                                                <?php } ?>    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <div class="btn btn-default">Bulan</div>
                                            </span>
                                            <select class="form-control " name="bulan" id="bulan" required="true" >

                                                <?php
                                                $no=1;
                                                foreach (bulan_indo() as $value) {
                                                // if($no <= date('m')) {
                                                    ?>
                                                    <option value="<?= $no ?>" <?= selected($no, $bulan, TRUE)?>><?= ($value) ?></option>
                                                <?php $no++; } 
                                            	// } ?>     
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search fa-fw"></i> Tampilkan</button>
                                    </div>
                                </div>

                            </div>

                        </form>
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
        </div>


        <div class="row" id="golru">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div style="float: right;padding-top: 3px;padding-right: 13px">
                        <button onclick="cetak()" class="btn btn-default"><i class="fa fa-print"></i> Cetak</button>
                    	<button type="button" id="btn_excel" class="btn btn-default"><i class="fa fa-print"></i> Excel</button>
                    </div>
                    <div class="panel-heading">
                        <i class="fa fa-users fa-fw"></i> Rekap Pensiun / Berhenti Berdasarkan Jenis Pensiun / Tahun                        
                    </div>
                    <div class="panel-body" id="target_print">
                        <style>
                            th{
                                text-align: center;
                            }
                            td{
                                padding-left: 10px;
                                padding-right: 10px;
                                text-align: right;
                            }
                        </style>
                        <table border="0" width="100%">
                            <tr>
                            	<td></td>
                                <td><img src="<?= base_url('assets/images/logo_header_75.png') ?>" style="float:left;height: 75px"/></td>
                                <td>
                                    <p align="center"><b>JUMLAH PNS YANG TELAH PENSIUN / BERHENTI DIRINCI MENURUT JENIS PENSIUN / TAHUN
                                            <br/>DI LINGKUNGAN PEMERINTAH KABUPATEN SANGGAU
                                            <br/>KEADAAN : <?= strtoupper(bulan($bulan)) . ' ' . $tahun ?></b></p>
                                </td>
                            </tr>
                        </table>

                        <div class="table-responsive">
                            <table width="100%" border="1" cellspacing="0">
                                <tr>
                                    <th rowspan="2" scope="col">NO</th>
                                    <th rowspan="2" scope="col">JENIS PENSIUN / BERHENTI</th>
                                    <th rowspan="2" scope="col">JUMLAH</th>
                                    <th colspan="5" scope="col">TAHUN</th>
                                </tr>

                                <tr>
                                    <th><?= ($tahun - 4) ?></th>
                                    <th><?= ($tahun - 3) ?></th>
                                    <th><?= ($tahun - 2) ?></th>
                                    <th><?= ($tahun - 1) ?></th>
                                    <th><?= ($tahun) ?></th>
                                </tr>
                                <?php
                                $no = 1;
                                $total['jumlah'] = 0;
                                $total['a'] = 0;
                                $total['b'] = 0;
                                $total['c'] = 0;
                                $total['d'] = 0;
                                $total['e'] = 0;
                                foreach ($result->result_array() as $value) {
                                    $total['jumlah'] += $value['jumlah'];
                                    $total['a'] += $value['th_' . ($tahun - 4)];
                                    $total['b'] += $value['th_' . ($tahun - 3)];
                                    $total['c'] += $value['th_' . ($tahun - 2)];
                                    $total['d'] += $value['th_' . ($tahun - 1)];
                                    $total['e'] += $value['th_' . ($tahun)];
                                    ?>
                                    <tr>
                                        <td style="text-align: center"><?= $no++; ?></td>
                                        <td style="text-align: left"><?= $value['jenis_pensiun_nama'] ?></td>
                                        <td><?= $value['jumlah'] ?></td>
                                        <td><?= $value['th_' . ($tahun - 4)] ?></td>
                                        <td><?= $value['th_' . ($tahun - 3)] ?></td>
                                        <td><?= $value['th_' . ($tahun - 2)] ?></td>
                                        <td><?= $value['th_' . ($tahun - 1)] ?></td>
                                        <td><?= $value['th_' . $tahun] ?></td>

                                    </tr>
                                    <?php
                                }
                                ?>
                                    <tr>
                                        <td style="text-align: center"></td>
                                        <td style="text-align: left">TOTAL</td>
                                        <td><?= $total['jumlah'] ?></td>
                                        <td><?= $total['a']?></td>
                                        <td><?= $total['b'] ?></td>
                                        <td><?= $total['c'] ?></td>
                                        <td><?= $total['d'] ?></td>
                                        <td><?= $total['e'] ?></td>

                                    </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
        </div>



    </section>
</div>

<script>
    function cetak() {
        var content = document.getElementById("target_print").innerHTML;
        var mywindow = window.open('', 'Print', 'height=600,width=800');

        mywindow.document.write('<html><head><title>Print</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write(content);
        mywindow.document.write('</body></html>');

        mywindow.document.close();
        mywindow.focus()
        mywindow.print();
        //mywindow.close();
        //return true;
    }

	$("#btn_excel").click(function(e) {   
   // window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#target_print').html())); // content is the id of the DIV element  
   //getting values of current time for generating the file name
        var dt = new Date();
        var day = dt.getDate();
        var month = dt.getMonth() + 1;
        var year = dt.getFullYear();
        var hour = dt.getHours();
        var mins = dt.getMinutes();
        var postfix = day + "." + month + "." + year + "_" + hour + "." + mins;
        //creating a temporary HTML link element (they support setting file names)
        var a = document.createElement('a');
        //getting data from our div that contains the HTML table
        var data_type = 'data:application/vnd.ms-excel';
        // var table_div = document.getElementById('target_print');
        var table_html = encodeURIComponent($('#target_print').html());
        a.href = data_type + ', ' + table_html;
        //setting the file name
        a.download = 'Rekap_Pensiun_' + postfix + '.xls';
        //triggering the function
        a.click();
        //just in case, prevent default behaviour
        e.preventDefault();
    e.preventDefault();   
});  
</script>