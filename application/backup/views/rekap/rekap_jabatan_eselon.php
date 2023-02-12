<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-wrapper">               

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            Rekap Jabatan Eselon
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
                                                foreach ($list_bulan->result() as $value) {
                                                    ?>
                                                    <option value="<?= $value->bulan ?>" <?= selected($value->bulan, $bulan, TRUE) ?>><?= bulan($value->bulan) ?></option>
                                                <?php } ?>    
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
                        <i class="fa fa-users fa-fw"></i> Rekap Jabatan Eselon                        
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
                                    <p align="center"><b>JUMLAH PEGAWAI NEGERI SIPIL DIRINCI MENURUT ESELON DAN JENIS KELAMIN
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
                                    <th rowspan="2" scope="col"><strong>JUMLAH <br/>ESELON <br/>YANG ADA</strong></th>
                                    <th colspan="6" scope="col"><strong>JENIS KELAMIN</strong></th>
                                    <th rowspan="2" scope="col"><strong>JUMLAH <br/>ESELON <br/>YANG <br/>LOWONG</strong></th>
                                </tr>
                                <tr>
                                    <td><strong>LAKI-LAKI</strong></td>
                                    <td><strong>%</strong></td>
                                    <td><strong>PEREMPUAN</strong></td>
                                    <td><strong>%</strong></td>
                                    <td><strong>JUMLAH</strong></td>
                                    <td><strong>%</strong></td>
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
                                    <th><strong>9</strong></th>
                                    <th><strong>10</strong></th>
                                </tr>
                                <?php
                                $total['bezeting'] = 0;
                                $total['l'] = 0;
                                $total['p'] = 0;
                                $no = 1;
                                foreach ($result->result() as $value) {
                                    $total['bezeting'] += $value->bezeting;
                                    $total['l'] += $value->laki_eselon;
                                    $total['p'] += $value->perempuan_eselon;
                                }
                                foreach ($result->result() as $value) {
                                	$bezeting = !empty($value->bezeting) ? $value->bezeting : 1;
                                    $jumlah = $value->laki_eselon + $value->perempuan_eselon;
                                    ?>
                                    <tr>
                                        <th><?= $no++ ?></th>
                                        <th><?= $value->pegawai_eselon_nama ?></th>
                                        <td><?= $bezeting ?></td>
                                        <td><?= $value->laki_eselon ?></td>
                                        <td><?= number_format($value->laki_eselon / $bezeting * 100,1).' %' ?></td>
                                        <td><?= $value->perempuan_eselon ?></td>
                                        <td><?= number_format($value->perempuan_eselon / $bezeting * 100,1).' %' ?></td>
                                        <td><?= $jumlah ?></td>
                                        <td><?= number_format($jumlah / $total['bezeting'] * 100 ,1).' %' ?></td>
                                        <td><?= $bezeting - $jumlah ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                    <tr>
                                        <th><?= $no++ ?></th>
                                        <th>TOTAL</th>
                                        <td><?= $total['bezeting'] ?></td>
                                        <td><?= $total['l'] ?></td>
                                        <td><?= number_format($total['l'] / $total['bezeting'] * 100,1).' %' ?></td>
                                        <td><?= $total['p'] ?></td>
                                        <td><?= number_format($total['p'] / $total['bezeting'] * 100,1).' %' ?></td>
                                        <td><?= $total['l'] + $total['p'] ?></td>
                                        <td><?= number_format(($total['l'] + $total['p']) / $total['bezeting'] * 100 ,1).' %' ?></td>
                                        <td><?= $total['bezeting'] - $total['l'] - $total['p']?></td>
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
        a.download = 'Rekap_Jabatan_Eselon_' + postfix + '.xls';
        //triggering the function
        a.click();
        //just in case, prevent default behaviour
        e.preventDefault();
    e.preventDefault();   
});  
</script>