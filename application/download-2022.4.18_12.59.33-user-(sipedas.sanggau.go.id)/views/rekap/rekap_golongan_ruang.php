<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-wrapper">               

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            Rekap Golongan dan Ruang Gaji
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
                        <i class="fa fa-users fa-fw"></i> Rekap Golongan dan Ruang Gaji                        
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
                                <td><img src="<?= base_url('assets/images/logo_header_75.png') ?>" style="float:left;height: 75px"/></td>
                                <td>
                                    <p align="center"><b>JUMLAH PEGAWAI NEGERI SIPIL DIRINCI MENURUT GOLONGAN RUANG DAN GAJI
                                <br/>DI LINGKUNGAN PEMERINTAH KABUPATEN SANGGAU
                                <br/>KEADAAN : <?= strtoupper(bulan($bulan)) . ' ' . $tahun ?></b></p>
                                </td>
                            </tr>
                        </table>
                        
                        <div class="table-responsive">
                            <table width="100%" border="1" cellspacing="0">
                                <tr>
                                    <th rowspan="2" align="center" scope="col">NO</th>
                                    <th rowspan="2" align="center" scope="col">GOLONGAN</th>
                                    <th rowspan="2" align="center" scope="col">JUMLAH</th>
                                    <th colspan="5" align="center" scope="col"><strong>RUANG GAJI</strong></th>
                                    <th rowspan="2" align="center" scope="col"><strong>%</strong></th>
                                </tr>
                                <tr>
                                    <th align="center"><strong>e</strong></th>
                                    <th align="center"><strong>d</strong></th>
                                    <th align="center"><strong>c</strong></th>
                                    <th align="center"><strong>b</strong></th>
                                    <th align="center"><strong>a</strong></th>
                                </tr>
                                <tr>
                                    <th align="center"><strong>1</strong></th>
                                    <th align="center"><strong>2</strong></th>
                                    <th align="center"><strong>3</strong></th>
                                    <th align="center"><strong>4</strong></th>
                                    <th align="center"><strong>5</strong></th>
                                    <th align="center"><strong>6</strong></th>
                                    <th align="center"><strong>7</strong></th>
                                    <th align="center"><strong>8</strong></th>
                                    <th align="center"><strong>9</strong></th>
                                </tr>
                                <?php
                                $total['jumlah'] = 0;
                                $total['a'] = 0;
                                $total['b'] = 0;
                                $total['c'] = 0;
                                $total['d'] = 0;
                                $total['e'] = 0;
                                foreach ($result->result() as $value) {
                                    $total['jumlah'] += $value->jumlah;
                                    $total['a'] += $value->a;
                                    $total['b'] += $value->b;
                                    $total['c'] += $value->c;
                                    $total['d'] += $value->d;
                                    $total['e'] += $value->e;
                                }
                                $no = 1;
                                foreach ($result->result() as $value) {
                                    ?>
                                    <tr>
                                        <th><?= $no++ ?></th>
                                        <th><?= $value->golongan ?></th>
                                        <td><?= $value->jumlah ?></td>
                                        <td><?= $value->e ?></td>
                                        <td><?= $value->d ?></td>
                                        <td><?= $value->c ?></td>
                                        <td><?= $value->b ?></td>
                                        <td><?= $value->a ?></td>
                                        <td><?= number_format($value->jumlah / $total['jumlah'] * 100, 1) . ' %' ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                <tr>
                                    <td colspan="2"><b>JUMLAH</b></td>
                                    <td><?= $total['jumlah'] ?></td>
                                    <td><?= $total['a'] ?></td>
                                    <td><?= $total['b'] ?></td>
                                    <td><?= $total['c'] ?></td>
                                    <td><?= $total['d'] ?></td>
                                    <td><?= $total['e'] ?></td>
                                    <td><?= number_format($total['jumlah'] / $total['jumlah'] * 100, 1) . ' %' ?></td>
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
        a.download = 'Rekap_Golongan_' + postfix + '.xls';
        //triggering the function
        a.click();
        //just in case, prevent default behaviour
        e.preventDefault();
    e.preventDefault();   
});   
</script>