<?php

function blank($object) {
    if (isset($object)) {
        return empty($object);
    } else {
        return true;
    }
}

function angka($angka) {
    $rupiah = number_format($angka, 0, ',', '.');
    return $rupiah;
}

function tanggal_mysql($tanggal, $separate) {
    if (empty($tanggal)) {
        return '0000-00-00';
    }
    if (empty($separate)) {
        return '0000-00-00';
    }
    $tgljam = explode(' ', $tanggal);
    $tgl = $tgljam[0];
    $tgls = explode($separate, $tgl);
    if (count($tgls) != 3) {
        if (strlen($tgl) == 8) {
            $tgls[0] = substr($tgl, 0, 2);
            $tgls[1] = substr($tgl, 2, 2);
            $tgls[2] = substr($tgl, 4, 4);
        } else if (strlen($tgl) == 6) {
            $tgls[0] = '00';
            $tgls[1] = substr($tgl, 2, 2);
            $tgls[2] = substr($tgl, 4, 4);
        } else if (strlen($tgl) == 4) {
            $tgls[0] = '00';
            $tgls[1] = '00';
            $tgls[2] = substr($tgl, 4, 4);
        } else {
            return $tanggal;
        }
    }
    $tgldb = $tgls[2] . '-' . $tgls[1] . '-' . $tgls[0];
//    $tgldb = substr($tgls, -4).'-'. substr($tgls, 3,2).'-'. substr($tgls, 0,2);
    return $tgldb;
}

function alert_show($name, $pesan) {
    $icon = "";
    if ($name == 'success') {
        $icon = '<h4><i class="icon fa fa-check"></i> Success!</h4>';
    } else if ($name == 'warning') {
        $icon = '<h4><i class="icon fa fa-warning"></i> Warning!</h4>';
    } else if ($name == 'danger') {
        $icon = '<h4><i class="icon fa fa-ban"></i> Warning!</h4>';
    }

    return '<div class="alert alert-' . $name . ' alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                ' . $icon . $pesan . '.
              </div>';
}

function alert_set($name, $pesan) {
    $_SESSION['alert_name'] = $name;
    $_SESSION['alert_pesan'] = $pesan;
}

function tgljam() {
    return date('Y-m-d H:i:s');
}

function jsonResponse($output, $ajax = NULL) {
    $ajax_request = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ? TRUE : FALSE;
    if ($ajax != NULL) {
        (!$ajax_request) ? exit('No direct script access allowed') : '';
    }

    if (defined('JSON_PRETTY_PRINT')) {
        $output = json_encode($output);
    } else {
        $output = json_encode($output);
    }
    header('content-type: application/json; charset: UTF-8');
    header('cache-control: must-revalidate');
    header('expires: ' . gmdate('D, d M Y H:i:s', time() + 31536000) . ' GMT');

    echo $output;
    exit();
}

function selected($var1, $var2, $ignorecase = TRUE) {
    if ($ignorecase) {
        if (strtoupper($var1) == strtoupper($var2)) {
            echo 'selected="selected"';
        }
    } else if ($var1 == $var2) {
        echo 'selected="selected"';
    }
}

function editPegawai($pegawai) {
    $e = '<div class="panel-heading">
                    <div class="form-group">
                        <label class="text-muted">NIP : </label>
                        <label>' . $pegawai->pegawai_nip . '</label>
                    </div>
                    <div class="form-group">
                        <label class="text-muted">Nama : </label>
                        <label><a href="' . site_url('pegawai/Pegawai/detail/') . $pegawai->pegawai_id . '" target="_blank" title="klik disini untuk melihat detail.">' . $pegawai->pegawai_nama_lengkap . '</a></label>
                    </div>
                </div>';
    return $e;
}

function tgl_indo($tanggal) {
    $bulan = array(0 =>'', 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $split = explode('-', $tanggal);
    if (count($split) < 3) {
        return $tanggal;
    }
    if ($tanggal == '0000-00-00') {
        return '';
    }
    if((trim($split[2]))=='00'){
        $split[2] = '';
    }
    return $split[2] . ' ' . $bulan[(int) $split[1]] . ' ' . $split[0];
}

function bulan($intbulan) {
    $bulan = array(1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    return $bulan[intval($intbulan)];
}

function bulan_indo() {
    $bulan = array(1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    );
    return $bulan;
}

function tgl($tanggal) {
    if ($tanggal == '0000-00-00') {
        return '';
    }if ($tanggal == '1000-01-01') {
        return '';
    }
    $split = explode('-', $tanggal);
    if (count($split) < 3) {
        return $tanggal;
    }
    return $split[2] . '-' . $split[1] . '-' . $split[0];
}

function desimal($number) {
    return number_format($number, 2, ",", ".");
}

function ribuan($number) {
    return number_format($number, 0, ",", ".");
}

function rupiah($number) {
    return 'Rp. ' . number_format($number, 0, ",", ".");
}

function zan_paging($count, $halaman, $perhal = 10, $link, $class = NULL, $link_extra = NULL) {

    $totalpage = ceil($count / $perhal);
    $echo = 'Total data ' . ribuan($count) . '<br/>';
    $echo .= '<ul class="' . $class[0] . '">';
    $echo .= '<li ';
    if ($halaman == 1) {
        $echo .= 'class="' . $class[2] . '"';
    }
    $echo .= '><a href="' . $link . '/' . 1 . $link_extra . '"><span><i class="uk-icon-angle-double-left"></i><<</span></a></li>';
    for ($i = 1; $i <= $totalpage; $i++) {
        if (abs($i - $halaman) <= 5 || $i == $totalpage) {
            $echo .= '<li ';
            if ($halaman == $i) {
                $echo .= 'class="' . $class[1] . '"';
            }
            $echo .= '><span><a href="' . $link . '/' . $i . $link_extra . '">' . $i . '</a></span></li>';
        } else {
            $echo = str_replace("...", "..", $echo);
            //$echo .= ".";
        }
    }

    $echo .= '<li ';
    if ($halaman == $totalpage) {
        $echo .= 'class="' . $class[2] . '"';
    }
    $echo .= '><a href="' . $link . '/' . $totalpage . $link_extra . '"><i class="uk-icon-angle-double-right"></i>>></a></li>';
    $echo .= '</ul>';
    return $echo;
}

function selisihTanggal($tglAwal, $tglAkhir) {
    $awal = explode('-', $tglAwal);
    $akhir = explode('-', $tglAkhir);
    $echo = '';
    $tahun = 0;
    $bulan = 0;
    $hari = 0;
    if ($awal[0] != $akhir[0]) {
        $tahun = $akhir[0] - $awal[0];
    }
    if ($awal[1] != $akhir[1]) {
        if ($awal[1] > $akhir[1]) {
            $tahun = $tahun - 1;
            $bulan = 12 - $awal[1] + $akhir[1];
        } else {
            $bulan = $akhir[1] - $awal[1];
        }
    }
    if ($awal[2] != $akhir[2]) {
        if ($awal[2] > $akhir[2]) {
            if ($bulan > 0) {
                $bulan = $bulan - 1;
            } else {
                $tahun = $tahun - 1;
                $bulan = 11;
            }
            $hari = (cal_days_in_month(CAL_GREGORIAN, $awal[1], $awal[0])) - $awal[2] + $akhir[2];
        } else {
            $hari = $akhir[2] - $awal[2];
        }
    }
    if (!empty($tahun)) {
        $echo .= $tahun . " tahun ";
    }
    if (!empty($bulan)) {
        $echo .= $bulan . " bulan ";
    }
    if (!empty($hari)) {
        $echo .= $hari . " hari";
    }
}

function diffMasa($tglAwal, $tglAkhir) {
    $awal = explode('-', $tglAwal);
    $akhir = explode('-', $tglAkhir);
    $echo = array();
    $tahun = 0;
    $bulan = 0;
    $hari = 0;
    if (sizeof($awal) < 3 || sizeof($akhir) < 3) {
        $echo['tahun'] = 0;
        $echo['bulan'] = 0;
        $echo['hari'] = 0;
        return $echo;
    }
    if ($awal[0] != $akhir[0]) {
        $tahun = $akhir[0] - $awal[0];
    }
    if ($awal[1] != $akhir[1]) {
        if ($awal[1] > $akhir[1]) {
            $tahun = $tahun - 1;
            $bulan = 12 - $awal[1] + $akhir[1];
        } else {
            $bulan = $akhir[1] - $awal[1];
        }
    }
    if ($awal[2] != $akhir[2]) {
        if ($awal[2] > $akhir[2]) {
            if ($bulan > 0) {
                $bulan = $bulan - 1;
            } else {
                $tahun = $tahun - 1;
                $bulan = 11;
            }
            $hari = (cal_days_in_month(CAL_GREGORIAN, $awal[1], $awal[0])) - $awal[2] + $akhir[2];
        } else {
            $hari = $akhir[2] - $awal[2];
        }
    }
    $echo['tahun'] = $tahun;
    $echo['bulan'] = $bulan;
    $echo['hari'] = $hari;
    return $echo;
}

function tableBuilder($laporan, $header = NULL, $format = 'excel', $id_table = NULL) {
    if ($laporan->num_rows() > 0) {
        $table = $laporan->result_array();
        $no = 1;
        $th = array_keys($table[0]);

        if (!empty($id_table)) {
            $echo = '<table id="' . $id_table . '" class="table table-bordered table-striped">';
        } else {
            $echo = '<table width="100%" border="1" cellspacing="0">';
        }

        //header start
        if (!blank($header)) {
            $echo .= $header;
        } else {
            $echo .= '<thead>
            <tr >
                <th style="text-align: center !important">No</th>';

            foreach ($th as $value) {
                $echo .= '<th style="text-align: center !important">';
                $echo .= str_replace('_', ' ', $value);
                $echo .= '</th>';
            }

            $echo .= '</tr>';

            if (empty($id_table)) {
                $echo .= '<tr >';
                $c = 0;
                foreach ($th as $value) {
                    $echo .= '<th style="text-align: center !important; padding:0px">';
                    $echo .= ++$c;
                    $echo .= '</th>';
                }
                $echo .= '</tr>';
            }
            $echo .= '</thead>';
        }
        //end header
        $echo .= '<tbody>';
        foreach ($laporan->result() as $value) {
            $echo .= '<tr>';
            $echo .= '<td style="text-align: center !important">' . $no++ . '</td>';
            foreach ($th as $v) {
//                $echo .= '<td>';
//                $echo .= "'".$value->$v;
                $a = $value->$v;
                if ($format == 'excel') {
                    $echo .= "<td>=\"$a\"</td>";
                } else {
                    $echo .= "<td>" . $a . "</td>";
                }

//                $echo .= '</td>';
            }
            $echo .= '</tr>';
        }

        $echo .= '</tbody>
</table>';
        return $echo;
    } else {
        return "Tidak ada data ditampilkan";
    }
}

function tableBuilderTanpaNo($laporan) {
    if ($laporan->num_rows() > 0) {

        $table = $laporan->result_array();
        $no = 1;
        $th = array_keys($table[0]);

        $echo = '<table width="100%" class="table table-striped table-bordered table-hover table-responsive" id="noSimpleTable">
        <thead>
            <tr >
                ';

        foreach ($th as $value) {
            $echo .= '<th style="text-align: center !important">';
            $echo .= $value;
            $echo .= '</th>';
        }

        $echo .= '</tr>
            <tr >
                ';

        $c = 1;
        foreach ($th as $value) {
            $echo .= '<th style="text-align: center !important; padding:0px">';
            $echo .= $c++;
            $echo .= '</th>';
        }

        $echo .= '</tr>
        </thead>
        <tbody>
            ';
        foreach ($laporan->result() as $value) {
            $echo .= '<tr>';

            foreach ($th as $v) {
                $echo .= '<td>';
                $echo .= $value->$v;
                $echo .= '</td>';
            }
            $echo .= '</tr>';
        }

        $echo .= '</tbody>
</table>';
        return $echo;
    } else {
        return "Tidak ada data ditampilkan";
    }
}

function modalSimpan() {
    echo '<div class="modal" id="modalSimpan" tabindex="-5" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
                                    </div>
                                    <div class="modal-body">
                                        Anda yakin data yang di masukkan sudah benar.
                                        <br/>
                                        klik TIDAK untuk memeriksa kembali data
                                        <br/>
                                        klik YA untuk menyimpan
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">TIDAK</button>
                                        <button type="submit" id="modalHide" class="btn btn-primary">YA</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>';
}

function modalLogout() {
    echo '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
                                    </div>
                                    <div class="modal-body">
                                        Anda yakin keluar dari Sistem.?
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">TIDAK</button>
                                        <button type="submit" class="btn btn-primary" >YA</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>';
}

function ignoreCase($string) {
    return trim(strtolower($string));
}

function pengajuan_status($perubahan_status) {
    $status[0] = 'Dibatalkan';
    $status[1] = 'Masuk Antrian BKPP';
    $status[2] = 'Diproses';
    $status[3] = 'Selesai';
    $status[4] = 'Dikembalikan';
    return $status[$perubahan_status];
}

function pegawai_nama_lengkap($pegawai) {
    $nama = '';
    if (!empty($pegawai->pegawai_gelar_depan)) {
        $nama .= $pegawai->pegawai_gelar_depan . '. ';
    }
    $nama .= $pegawai->pegawai_nama;
    if (!empty($pegawai->pegawai_gelar_belakang)) {
        $nama .= ', ' . $pegawai->pegawai_gelar_belakang;
    }
    return $nama.'<br>'.$pegawai->pegawai_nip;
}


function pegawai_gelar($pegawai) {
    $nama = '';
    if (!empty($pegawai->pegawai_gelar_depan)) {
        $nama .= $pegawai->pegawai_gelar_depan . '. ';
    }
    $nama .= $pegawai->pegawai_nama;
    if (!empty($pegawai->pegawai_gelar_belakang)) {
        $nama .= ', ' . $pegawai->pegawai_gelar_belakang;
    }
    return $nama;
}


if (!function_exists('terbilang')) {
    function terbilang($number)
    {
        $words = "";

        $arr_number = array(

            "",

            "satu",

            "dua",

            "tiga",

            "empat",

            "lima",

            "enam",

            "tujuh",

            "delapan",

            "sembilan",

            "sepuluh",

            "sebelas"
        );

        if ($number < 12) {

            $words = " " . $arr_number[$number];
        } else if ($number < 20) {

            $words = terbilang($number - 10) . " belas";
        } else if ($number < 100) {

            $words = terbilang($number / 10) . " puluh " . terbilang($number % 10);
        } else if ($number < 200) {

            $words = "seratus " . terbilang($number - 100);
        } else if ($number < 1000) {

            $words = terbilang($number / 100) . " ratus " . terbilang($number % 100);
        } else if ($number < 2000) {

            $words = "seribu " . terbilang($number - 1000);
        } else if ($number < 1000000) {

            $words = terbilang($number / 1000) . " ribu " . terbilang($number % 1000);
        } else if ($number < 1000000000) {

            $words = terbilang($number / 1000000) . " juta " . terbilang($number % 1000000);
        } else if ($number < 1000000000000) {
            $words = terbilang($number / 1000000000) . " milyar" . terbilang(fmod($number, 1000000000));
        } else if ($number < 1000000000000000) {
            $words = terbilang($number / 1000000000000) . " trilyun" . terbilang(fmod($number, 1000000000000));
        } else {

            $words = "";
        }

        return ucwords($words);
    }

    function encode_img_base64( $img_path = false, $img_type = 'png' ){
        if( $img_path ){
            //convert image into Binary data
            $img_data = fopen ( $img_path, 'rb' );
            $img_size = filesize ( $img_path );
            $binary_image = fread ( $img_data, $img_size );
            fclose ( $img_data );
    
            //Build the src string to place inside your img tag
            $img_src = "data:image/".$img_type.";base64,".str_replace ("\n", "", base64_encode($binary_image));
    
            return $img_src;
        }
    
        return false;
    }
}

