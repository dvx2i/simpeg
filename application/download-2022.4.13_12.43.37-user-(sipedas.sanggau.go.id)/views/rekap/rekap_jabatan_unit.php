<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-wrapper">               

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            Rekap Jabatan Unit Kerja, jenis kelamin dan Eselon
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
                        <i class="fa fa-users fa-fw"></i> Rekap Jabatan Unit Kerja, Jenis Kelamin dan Eselon                        
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
                                    <p align="center"><b>JUMLAH PEGAWAI NEGERI SIPIL DIRINCI MENURUT UNIT KERJA / JENIS KELAMIN DAN ESELON
                                            <br/>DI LINGKUNGAN PEMERINTAH KABUPATEN SANGGAU
                                            <br/>KEADAAN : <?= strtoupper(bulan($bulan)) . ' ' . $tahun ?></b></p>
                                </td>
                            </tr>
                        </table>

                        <div class="table-responsive">
                            <table width="100%" border="1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th rowspan="3" scope="col">NO</th>
                                        <th rowspan="3" scope="col">SATUAN KERJA</th>
                                        <th rowspan="3" scope="col">JUMLAH</th>
                                        <th colspan="18" scope="col">ESELON / JENIS KELAMIN</th>
                                    </tr>
                                    <tr>
                                        <th colspan="9">LAKI-LAKI</th>
                                        <th colspan="9">PEREMPUAN</th>
                                    </tr>
                                    <tr>
                                        <th>II.A</th>
                                        <th>II.B</th>
                                        <th>III.A</th>
                                        <th>III.B</th>
                                        <th>IV.A</th>
                                        <th>IV.B</th>
                                        <th>V.A</th>
                                        <th>V.B</th>
                                        <th>JML</th>
                                        <th>II.A</th>
                                        <th>II.B</th>
                                        <th>III.A</th>
                                        <th>III.B</th>
                                        <th>IV.A</th>
                                        <th>IV.B</th>
                                        <th>V.A</th>
                                        <th>V.B</th>
                                        <th>JML</th>
                                    </tr>
                                    <tr>
                                        <th>1</th>
                                        <th>2</th>
                                        <th>3</th>
                                        <th>4</th>
                                        <th>5</th>
                                        <th>6</th>
                                        <th>7</th>
                                        <th>8</th>
                                        <th>9</th>
                                        <th>10</th>
                                        <th>11</th>
                                        <th>12</th>
                                        <th>13</th>
                                        <th>14</th>
                                        <th>15</th>
                                        <th>16</th>
                                        <th>17</th>
                                        <th>18</th>
                                        <th>19</th>
                                        <th>20</th>
                                        <th>21</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $total['jumlah'] = 0;
                                    $total['laki_eselon_2a'] = 0;
                                    $total['laki_eselon_2b'] = 0;
                                    $total['laki_eselon_3a'] = 0;
                                    $total['laki_eselon_3b'] = 0;
                                    $total['laki_eselon_4a'] = 0;
                                    $total['laki_eselon_4b'] = 0;
                                    $total['laki_eselon_5a'] = 0;
                                    $total['laki_eselon_5b'] = 0;
                                    $total['laki'] = 0;
                                    $total['perempuan_eselon_2a'] = 0;
                                    $total['perempuan_eselon_2b'] = 0;
                                    $total['perempuan_eselon_3a'] = 0;
                                    $total['perempuan_eselon_3b'] = 0;
                                    $total['perempuan_eselon_4a'] = 0;
                                    $total['perempuan_eselon_4b'] = 0;
                                    $total['perempuan_eselon_5a'] = 0;
                                    $total['perempuan_eselon_5b'] = 0;
                                    $total['perempuan'] = 0;
                                    foreach ($result->result() as $value) {
                                        $total['jumlah'] += ($value->laki_eselon_2a+$value->laki_eselon_2b+$value->laki_eselon_3a+$value->laki_eselon_3b+$value->laki_eselon_4a+$value->laki_eselon_4b+$value->laki_eselon_5a+$value->laki_eselon_5b)+($value->perempuan_eselon_2a+$value->perempuan_eselon_2b+ $value->perempuan_eselon_3a+$value->perempuan_eselon_3b+ $value->perempuan_eselon_4a+$value->perempuan_eselon_4b+$value->perempuan_eselon_5a+$value->perempuan_eselon_5b);
                                        $total['laki_eselon_2a'] += $value->laki_eselon_2a;
                                        $total['laki_eselon_2b'] += $value->laki_eselon_2b;
                                        $total['laki_eselon_3a'] += $value->laki_eselon_3a;
                                        $total['laki_eselon_3b'] += $value->laki_eselon_3b;
                                        $total['laki_eselon_4a'] += $value->laki_eselon_4a;
                                        $total['laki_eselon_4b'] += $value->laki_eselon_4b;
                                        $total['laki_eselon_5a'] += $value->laki_eselon_5a;
                                        $total['laki_eselon_5b'] += $value->laki_eselon_5b;
                                        $total['laki'] += $value->laki_eselon_2a+$value->laki_eselon_2b+$value->laki_eselon_3a+$value->laki_eselon_3b+$value->laki_eselon_4a+$value->laki_eselon_4b+$value->laki_eselon_5a+$value->laki_eselon_5b;
                                        $total['perempuan_eselon_2a'] += $value->perempuan_eselon_2a;
                                        $total['perempuan_eselon_2b'] += $value->perempuan_eselon_2b;
                                        $total['perempuan_eselon_3a'] += $value->perempuan_eselon_3a;
                                        $total['perempuan_eselon_3b'] += $value->perempuan_eselon_3b;
                                        $total['perempuan_eselon_4a'] += $value->perempuan_eselon_4a;
                                        $total['perempuan_eselon_4b'] += $value->perempuan_eselon_4b;
                                        $total['perempuan_eselon_5a'] += $value->perempuan_eselon_5a;
                                        $total['perempuan_eselon_5b'] += $value->perempuan_eselon_5b;
                                        $total['perempuan'] += $value->perempuan_eselon_2a+$value->perempuan_eselon_2b+ $value->perempuan_eselon_3a+$value->perempuan_eselon_3b+ $value->perempuan_eselon_4a+$value->perempuan_eselon_4b+$value->perempuan_eselon_5a+$value->perempuan_eselon_5b;
                                        ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td style="text-align: left"><?= $value->unit_nama ?></td>
                                            <td><?= ($value->laki_eselon_2a+$value->laki_eselon_2b+$value->laki_eselon_3a+$value->laki_eselon_3b+$value->laki_eselon_4a+$value->laki_eselon_4b+$value->laki_eselon_5a+$value->laki_eselon_5b)+($value->perempuan_eselon_2a+$value->perempuan_eselon_2b+ $value->perempuan_eselon_3a+$value->perempuan_eselon_3b+ $value->perempuan_eselon_4a+$value->perempuan_eselon_4b+$value->perempuan_eselon_5a+$value->perempuan_eselon_5b) ?></td>
                                            <td><?= $value->laki_eselon_2a ?></td>
                                            <td><?= $value->laki_eselon_2b ?></td>
                                            <td><?= $value->laki_eselon_3a ?></td>
                                            <td><?= $value->laki_eselon_3b ?></td>
                                            <td><?= $value->laki_eselon_4a ?></td>
                                            <td><?= $value->laki_eselon_4b ?></td>
                                            <td><?= $value->laki_eselon_5a ?></td>
                                            <td><?= $value->laki_eselon_5b ?></td>
                                            <td><?= $value->laki_eselon_2a+$value->laki_eselon_2b+$value->laki_eselon_3a+$value->laki_eselon_3b+$value->laki_eselon_4a+$value->laki_eselon_4b+$value->laki_eselon_5a+$value->laki_eselon_5b ?></td>
                                            <td><?= $value->perempuan_eselon_2a ?></td>
                                            <td><?= $value->perempuan_eselon_2b ?></td>
                                            <td><?= $value->perempuan_eselon_3a ?></td>
                                            <td><?= $value->perempuan_eselon_3b ?></td>
                                            <td><?= $value->perempuan_eselon_4a ?></td>
                                            <td><?= $value->perempuan_eselon_4b ?></td>
                                            <td><?= $value->perempuan_eselon_5a ?></td>
                                            <td><?= $value->perempuan_eselon_5b ?></td>
                                            <td><?= $value->perempuan_eselon_2a+$value->perempuan_eselon_2b+ $value->perempuan_eselon_3a+$value->perempuan_eselon_3b+ $value->perempuan_eselon_4a+$value->perempuan_eselon_4b+$value->perempuan_eselon_5a+$value->perempuan_eselon_5b?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                        <tr>
                                            <td></td>
                                            <td style="text-align: right">TOTAL</td>
                                            <td><?= $total['jumlah'] ?></td>
                                            <td><?= $total['laki_eselon_2a'] ?></td>
                                            <td><?= $total['laki_eselon_2b'] ?></td>
                                            <td><?= $total['laki_eselon_3a'] ?></td>
                                            <td><?= $total['laki_eselon_3b'] ?></td>
                                            <td><?= $total['laki_eselon_4a'] ?></td>
                                            <td><?= $total['laki_eselon_4b'] ?></td>
                                            <td><?= $total['laki_eselon_5a'] ?></td>
                                            <td><?= $total['laki_eselon_5b'] ?></td>
                                            <td><?= $total['laki'] ?></td>
                                            <td><?= $total['perempuan_eselon_2a'] ?></td>
                                            <td><?= $total['perempuan_eselon_2b'] ?></td>
                                            <td><?= $total['perempuan_eselon_3a'] ?></td>
                                            <td><?= $total['perempuan_eselon_3b'] ?></td>
                                            <td><?= $total['perempuan_eselon_4a'] ?></td>
                                            <td><?= $total['perempuan_eselon_4b'] ?></td>
                                            <td><?= $total['perempuan_eselon_5a'] ?></td>
                                            <td><?= $total['perempuan_eselon_5b'] ?></td>
                                            <td><?= $total['perempuan'] ?></td>
                                        </tr>
                                </tbody>
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
        a.download = 'Rekap_Jabatan_Unit_Kerja_' + postfix + '.xls';
        //triggering the function
        a.click();
        //just in case, prevent default behaviour
        e.preventDefault();
    e.preventDefault();   
});  
</script>