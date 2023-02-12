<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-wrapper">               

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            Rekap Pendidikan Umum - Jenis Kelamin
        </h1>
    </section>

    <section class="content">
        <div class="row" id="filter">
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
                        <i class="fa fa-users fa-fw"></i> Rekap Pendidikan Umum - Jenis Kelamin                        
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
                                    <p align="center"><b>JUMLAH PEGAWAI NEGERI SIPIL DIRINCI MENURUT PENDIDIKAN UMUM DAN JENIS KELAMIN
                                <br/>DI LINGKUNGAN PEMERINTAH KABUPATEN SANGGAU
                                <br/>KEADAAN : <?= strtoupper(bulan($bulan)) . ' ' . $tahun ?></b></p>
                                </td>
                            </tr>
                        </table>
                        
                        <div class="table-responsive">
                            <table width="100%" border="1" cellspacing="0">
                                <tr>
                                    <th rowspan="2" scope="col"><strong>NO</strong></th>
                                    <th rowspan="2" scope="col"><strong>TINGKAT PENDIDIKAN</strong></th>
                                    <th rowspan="2" scope="col"><strong>JUMLAH</strong></th>
                                    <th colspan="4" scope="col"><strong>JENIS KELAMIN</strong></th>
                                    <th rowspan="2" scope="col"><strong>%</strong></th>
                                </tr>
                                <tr>
                                    <th><strong>LAKI-LAKI</strong></th>
                                    <th><strong>%</strong></th>
                                    <th><strong>PEREMPUAN</strong></th>
                                    <th><strong>%</strong></th>
                                </tr>
                                <tr>
                                    <th><strong>1</strong></th>
                                    <th><strong>2</strong></th>
                                    <th><strong>3</strong></th>
                                    <th><strong>4</strong></th>
                                    <th><strong>5</strong></th>
                                    <th><strong>6</strong></th>
                                    <th><strong>7</strong></th>
                                    <th><strong>8</strong></th>
                                </tr>
                                <?php
                                $no = 1;
                                $total['jumlah'] = 0;
                                $total['l'] = 0;
                                $total['p'] = 0;
                                foreach ($result->result() as $value) {
                                    $total['jumlah'] += $value->jumlah;
                                    $total['l'] += $value->laki;
                                    $total['p'] += $value->perempuan;
                                }
                                foreach ($result->result() as $value) {
                                    if($value->jumlah<=0){
                                        $persen_laki = '0.0 %';
                                        $persen_perenpuan = '0.0 %';
                                    }else{
                                        $persen_laki = number_format($value->laki / $value->jumlah *100,1). ' %';
                                        $persen_perenpuan = number_format($value->perempuan / $value->jumlah *100,1). ' %';
                                    }
                                    
                                    ?>
                                    <tr>
                                        <th><?= $no++; ?></th>
                                        <th style="text-align: left">&nbsp;<?= $value->pendidikan ?></th>
                                        <td><?= $value->jumlah ?></td>
                                        <td><?= $value->laki ?></td>
                                        <td><?= $persen_laki ?></td>
                                        <td><?= $value->perempuan ?></td>
                                        <td><?= $persen_perenpuan ?></td>
                                        <td><?= number_format(($value->laki + $value->perempuan) / $total['jumlah'] * 100,1).' %' ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                    <tr>
                                        <th></th>
                                        <th style="text-align: right">TOTAL</th>
                                        <td><?= $total['jumlah'] ?></td>
                                        <td><?= $total['l'] ?></td>
                                        <td><?= number_format($total['l'] / $total['jumlah'] * 100,1).' %' ?></td>
                                        <td><?= $total['p'] ?></td>
                                        <td><?= number_format($total['p'] / $total['jumlah'] * 100,1).' %'  ?></td>
                                        <td><?= number_format(($total['l'] + $total['p']) / $total['jumlah'] * 100,1).' %' ?></td>
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
        a.download = 'Rekap_Pendidikan_' + postfix + '.xls';
        //triggering the function
        a.click();
        //just in case, prevent default behaviour
        e.preventDefault();
    e.preventDefault();   
});  
</script>