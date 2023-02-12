<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
*  edit_column callback function in Codeigniter (Ignited Datatables)
*
* Grabs a value from the edit_column field for the specified field so you can
* return the desired value.
*
* @access   public
* @return   mixed
*/

if ( ! function_exists('check_kelamin'))
{
    function check_kelamin($status = '')
    {
        return ($status == 'L') ? 'Laki - laki' : 'Perempuan';
    }
}

if ( ! function_exists('bagan_action'))
{
    function bagan_action($bagan_id,$bagan_parent_id,$bagan_pegawai_nip,$bagan_unit_id,$bagan_jabatan_id,$bagan_level,$bagan_is_bupati,$bagan_bupati_nama,$bagan_wabupati_nama)
    {
    	if($bagan_is_bupati != '1'){
        	return '<a href="#" class="btn btn-warning btn-sm" type="button" onclick="edit(\''.$bagan_id.'\',\''.$bagan_parent_id.'\',\''.$bagan_pegawai_nip.'\',\''.$bagan_unit_id.'\',\''.$bagan_jabatan_id.'\',\''.$bagan_level.'\')" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-edit"></i></a>
                <a href="#" class="btn btn-danger btn-sm" onclick="delete_bagan(\''.$bagan_id.'\')"><i class="fa fa-trash-o fa-fw"></i></a>';
    	}else{
        	return '<a href="#" class="btn btn-warning btn-sm" type="button" onclick="edit_bupati(\''.$bagan_id.'\',\''.$bagan_bupati_nama.'\',\''.$bagan_wabupati_nama.'\')" data-toggle="modal" data-target="#modal-edit-bupati"><i class="fa fa-edit"></i></a>
                ';
        }
    }

}

if ( ! function_exists('abk_action'))
{
    function abk_action($abkjabatan_id,$abkjabatan_parent_id,$abkjabatan_unit_id,$abkjabatan_jabatan_id,$abkjabatan_level,$abkjabatan_kebutuhan,$abkjabatan_bezzeting,$abkjabatan_jenis_jabatan_id,$abkjabatan_sub_unit_id)
    {
      return '<a href="#" class="btn btn-warning btn-sm" type="button" onclick="edit(\''.$abkjabatan_id.'\',\''.$abkjabatan_parent_id.'\',\''.$abkjabatan_unit_id.'\',\''.$abkjabatan_jabatan_id.'\',\''.$abkjabatan_level.'\',\''.$abkjabatan_kebutuhan.'\',\''.$abkjabatan_bezzeting.'\',\''.$abkjabatan_jenis_jabatan_id.'\',\''.$abkjabatan_sub_unit_id.'\')" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-edit"></i></a>
                <a href="#" class="btn btn-danger btn-sm" onclick="delete_bagan(\''.$abkjabatan_id.'\')"><i class="fa fa-trash-o fa-fw"></i></a>';
    	
    }

}

if ( ! function_exists('aksi_kgb'))
{
    function aksi_kgb($kgb_id, $status, $nip, $nama, $proses_bkpad, $kgbsk_file)
    {

      if($status <> '1'){
        return '<a href="#" class="btn btn-primary btn-sm" type="button" onclick="edit(\''.$nip.'\',\''.$nama.'\')" data-toggle="modal" data-target="#modal-update">Verifikasi</a>';
      }else{
        
        $class = 'btn-default';
        $unduh = '';
        $edit  = '';
        if($proses_bkpad <> 0){
          $class = 'btn-success';
          $unduh = '<li class="divider"></li><li><a href="'.base_url('assets/files/'.$kgbsk_file).'" ><i class="fa fa-download"></i> <b>Unduh SK</b></a></li>';
        }

        return '
        <div class="btn-group">
          <button type="button" class="btn '.$class.'" btn-xl dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Aksi</button>
          <button type="button" class="btn '.$class.' dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <span class="caret"></span>
          <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu" style="left: -87px;" role="menu">
          <li><a href="'.site_url('pegawai/PegawaiKgb/cetak/'.$kgb_id).'" ><i class="fa fa-print"></i> <b>Cetak Template</b></a></li>
          <li class="divider"></li>
          <li><a href="#" onclick="upload_sk('.$kgb_id.');"><i class="fa fa-upload"></i> <b>Upload SK</b></a></li>
          '.$unduh.'
          </ul>
        </div>';
      }

    }
    


}

if(!function_exists('aksi_kenaikan_gaji'))
{
  function aksi_kenaikan_gaji($id)
  {
    return '<button type="button" class="btn  btn-sm btn-primary btn-sk" data-toggle="modal" data-target="#berkasModal" data-id="'.$id.'" type="button"><i class="fa fa-copy"></i> <small> File SK</small></button>';
  }
}

if ( ! function_exists('get_usulan_status'))
{
    function get_usulan_status($status= null)
    {
      if($status == '1') {
      return '<span class="btn btn-default">Menunggu Verifikasi</span>'; }
       if($status == '2') {
         return '<span class="btn btn-warning">Diproses</span>'; }
         if($status == '4') {
           return '<span class="btn btn-success">Pengajuan Selesai</span>'; }
         else{
          return '<span class="btn btn-danger">Dikembalikan</span>';
        }
    }
}


if ( ! function_exists('get_action_mutasi'))
{
    function get_action_mutasi($usulan_id=null, $usulan_status=null, $menu=null, $insert_time=null)
    {
      if($menu == 'publik'){
        if($usulan_status == '3'){
          return '<a href="'.site_url('mutasi/Pengajuan/update/'.$usulan_id).'" data-toggle="tooltip" title="Ubah" class="btn btn-warning btn-sm edit"><i class="fa fa-edit"></i></a>
          <a href="'.site_url('mutasi/Pengajuan/delete/'.$usulan_id).'" onclick="javascript: return confirm(\'Yakin Ingin Dihapus ?\')"  data-toggle="tooltip" title="Hapus" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
          
        }else if($usulan_status == '1'){
          return '<a href="'.site_url('mutasi/Pengajuan/detail/'.$usulan_id).'" data-toggle="tooltip" title="Detail" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
          <a href="'.site_url('mutasi/Pengajuan/delete/'.$usulan_id).'" onclick="javascript: return confirm(\'Yakin Ingin Dihapus ?\')" data-toggle="tooltip" title="Hapus" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
          // <a href="'.site_url('mutasi/DataPengajuan/update/reject/'.$usulan_id).'" data-toggle="tooltip" title="Tolak" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i></a>
        
        }  else {
          return '<a href="'.site_url('mutasi/Pengajuan/detail/'.$usulan_id).'" data-toggle="tooltip" title="Detail" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>';
          // <a href="'.site_url('mutasi/DataPengajuan/update/reject/'.$usulan_id).'" data-toggle="tooltip" title="Tolak" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i></a>
        
        }  
      }else if($menu == 'admin'){
        if($usulan_status == '1'){
          return 
          '<a href="'.site_url('mutasi/DataPengajuan/detail/'.$usulan_id).'" data-toggle="tooltip" title="Detail" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
          <a href="'.site_url('mutasi/DataPengajuan/delete/'.$usulan_id).'" onclick="javascript: return confirm(\'Yakin Ingin Dihapus ?\')"  data-toggle="tooltip" title="Hapus" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
          ';
          // <a href="'.site_url('mutasi/DataPengajuan/update/verify/'.$usulan_id).'" data-toggle="tooltip" title="Verifikasi" class="btn btn-warning btn-sm edit"><i class="fa fa-check"></i></a>
          // <a href="'.site_url('mutasi/DataPengajuan/update/reject/'.$usulan_id).'" data-toggle="tooltip" title="Tolak" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i></a>';
        }
        else{
          return 
          '<a href="'.site_url('mutasi/DataPengajuan/detail/'.$usulan_id).'" data-toggle="tooltip" title="Detail" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
          <a href="'.site_url('mutasi/DataPengajuan/delete/'.$usulan_id).'" onclick="javascript: return confirm(\'Yakin Ingin Dihapus ?\')"  data-toggle="tooltip" title="Hapus" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
          // <a href="'.site_url('mutasi/DataPengajuan/update/reject/'.$usulan_id).'" data-toggle="tooltip" title="Tolak" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i></a>
        }
      }
    }
}


if ( ! function_exists('get_sk_mutasi'))
{
    function get_sk_mutasi($file_sk=null, $usulan_status=null, $menu=null, $usulan_id=null, $insert_time=null)
    {
      if($menu == 'publik'){
        if($usulan_status == '4'){
          return '<a href="'.base_url('assets/files/'.$file_sk).'" data-toggle="tooltip" title="File SK" class="btn btn-success btn-sm edit"><i class="fa fa-download"></i> SK MUTASI</a>';
        }elseif($usulan_status == '2'){
          return '
          <a href="'.base_url().'/assets/docs/Bukti-Usulan-Mutasi-'.date('Y', strtotime($insert_time)).'-'.str_pad($usulan_id, 7, '0', STR_PAD_LEFT).'.pdf" target="_blank" class="btn btn-primary btn-sm btn-bukti-usulan"><i class="fa fa-download"></i> BUKTI USULAN MUTASI</a>';
        }  else{
        	return '';
        }
      }else if($menu == 'admin'){
        // die($usulan_status);
        if($usulan_status == '2'){
          return 
          '<a href="'.base_url().'/assets/docs/Bukti-Usulan-Mutasi-'.date('Y', strtotime($insert_time)).'-'.str_pad($usulan_id, 7, '0', STR_PAD_LEFT).'.pdf" target="_blank" class="btn btn-primary btn-sm btn-bukti-usulan"><i class="fa fa-download"></i> BUKTI USULAN MUTASI</a>
          <button onclick="upload_sk('.$usulan_id.');" class="btn btn-default buttons-html5 btn-sm btn-sk" type="button"><span><i class="fa fa-upload"></i> UPLOAD SK</span></button>';
          // <a href="'.site_url('mutasi/DataPengajuan/update/reject/'.$usulan_id).'" data-toggle="tooltip" title="Tolak" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i></a>
        }
        elseif($usulan_status == '4'){
          return 
          '<a href="'.base_url('assets/files/'.$file_sk).'" data-toggle="tooltip" title="File SK" class="btn btn-success btn-sm edit"><i class="fa fa-download"></i> SK MUTASI</a>
          <button onclick="upload_sk('.$usulan_id.');" class="btn btn-default buttons-html5 btn-sm btn-sk" type="button"><span><i class="fa fa-upload"></i> UBAH SK</span></button>';
          // <a href="'.site_url('mutasi/DataPengajuan/update/reject/'.$usulan_id).'" data-toggle="tooltip" title="Tolak" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i></a>
        }
      }
    }
}

if ( ! function_exists('sk_cuti'))
{
    function sk_cuti($file_sk=null, $usulan_status=null)
    {
        if($usulan_status == '4'){
          return '<a href="'.base_url('assets/files/'.$file_sk).'" data-toggle="tooltip" title="File SK" class="btn btn-success btn-sm edit"><i class="fa fa-download"></i> Surat Izin Cuti</a>';
        }else{
        	return '';
        }
    }
}



if ( ! function_exists('get_action_cuti'))
{
    function get_action_cuti($usulan_id, $usulan_status, $no_sk)
    {
        if($usulan_status == '1'){
          return 
          '<div class="pull-right"><a href="#verif" onclick="verif('.$usulan_id.')" data-toggle="tooltip" title="Verifikasi" class="btn btn-success btn-sm"><i class="fa fa-check fa-fw"></i></a>
          <a href="#detail" onclick="detail('.$usulan_id.')" data-toggle="tooltip" title="Detail" class="btn btn-info btn-sm"><i class="fa fa-info-circle fa-fw"></i></a>
          <a href="'.site_url('cuti/DataPengajuan/delete/'.$usulan_id).'" onclick="javascript: return confirm(\'Yakin Ingin Dihapus ?\')"  data-toggle="tooltip" title="Hapus" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></div>
          ';
          // <a href="'.site_url('cuti/DataPengajuan/update/verify/'.$usulan_id).'" data-toggle="tooltip" title="Verifikasi" class="btn btn-warning btn-sm file"><i class="fa fa-check"></i></a>
          // <a href="'.site_url('cuti/DataPengajuan/update/reject/'.$usulan_id).'" data-toggle="tooltip" title="Tolak" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i></a>';
        }elseif($usulan_status == '3'){
          return 
          '<div class="pull-right"><a href="#detail" onclick="detail('.$usulan_id.')" data-toggle="tooltip" title="Detail" class="btn btn-info btn-sm"><i class="fa fa-info-circle fa-fw"></i></a>
          <a href="'.site_url('cuti/DataPengajuan/delete/'.$usulan_id).'" onclick="javascript: return confirm(\'Yakin Ingin Dihapus ?\')"  data-toggle="tooltip" title="Hapus" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></div>
          ';
          // <a href="'.site_url('cuti/DataPengajuan/update/verify/'.$usulan_id).'" data-toggle="tooltip" title="Verifikasi" class="btn btn-warning btn-sm file"><i class="fa fa-check"></i></a>
          // <a href="'.site_url('cuti/DataPengajuan/update/reject/'.$usulan_id).'" data-toggle="tooltip" title="Tolak" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i></a>';
        }
        else{
          if(empty($no_sk)){
            return 
            '<div class="pull-right"><a href="#sk" onclick="sk('.$usulan_id.')" data-toggle="tooltip" title="SK" class="btn btn-warning btn-sm"><i class="fa  fa-file fa-fw"></i></a>
            <a href="#detail" onclick="detail('.$usulan_id.')" data-toggle="tooltip" title="Detail" class="btn btn-info btn-sm"><i class="fa fa-info-circle fa-fw"></i></a>
            <a href="'.site_url('cuti/DataPengajuan/delete/'.$usulan_id).'" onclick="javascript: return confirm(\'Yakin Ingin Dihapus ?\')"  data-toggle="tooltip" title="Hapus" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></div>';
            // <a href="'.site_url('mutasi/DataPengajuan/update/reject/'.$usulan_id).'" data-toggle="tooltip" title="Tolak" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i></a>
          }else{
            return 
            '<div class="pull-right"><a href="#upload_sk" onclick="upload_sk('.$usulan_id.')" data-toggle="tooltip" title="Upload SK" class="btn btn-primary btn-sm"><i class="fa  fa-upload fa-fw"></i></a>
            <a href="#sk" onclick="sk('.$usulan_id.')" data-toggle="tooltip" title="SK" class="btn btn-warning btn-sm"><i class="fa  fa-file fa-fw"></i></a>
            <a href="#detail" onclick="detail('.$usulan_id.')" data-toggle="tooltip" title="Detail" class="btn btn-info btn-sm"><i class="fa fa-info-circle fa-fw"></i></a>
            <a href="'.site_url('cuti/DataPengajuan/delete/'.$usulan_id).'" onclick="javascript: return confirm(\'Yakin Ingin Dihapus ?\')"  data-toggle="tooltip" title="Hapus" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></div>';
            // <a href="'.site_url('mutasi/DataPengajuan/update/reject/'.$usulan_id).'" data-toggle="tooltip" title="Tolak" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i></a>
          }
        }
      
    }
}

if ( ! function_exists('ucwords_strtolower'))
{
    function ucwords_strtolower($text)
    {
        return ucwords(strtolower($text));
    }
}

if ( ! function_exists('date_time'))
{
    function date_time($date = '')
    {
        return date('d/M/Y', strtotime($date));
    }
}

if ( ! function_exists('tanggalujian'))
{
    function tanggalujian($tanggal = '')
    {
        return date('d/M/Y h:i', strtotime($tanggal));
    }
}

if ( ! function_exists('tanggalgangguan'))
{
    function tanggalgangguan($tanggal='')
    {
        return date('d/M/Y', strtotime($tanggal));
    }
}

if ( ! function_exists('format_jam'))
{
    function format_jam($jam='',$presensi='')
    {
      return ($presensi == 'tidakmasuk') ? '-' : date('h:i', strtotime($jam));
    }
}

if ( ! function_exists('penerima_kps'))
{
    function penerima_kps($status = '')
    {
      return ($status == 'y') ? 'Ya' : 'Tidak';
    }
}

//wali
if ( ! function_exists('penghasilan'))
{
    function penghasilan($penghasilan_min=null,$penghasilan_max=null)
    {
      // return ($status == 'y') ? 'Ya' : 'Tidak';
      $penghasilan=null;
      if (($penghasilan_min) AND ($penghasilan_max)) {
        $penghasilan="Rp. ".$penghasilan_min." - Rp. ".$penghasilan_max;
      }
      else if ($penghasilan_min) {
        $penghasilan="Rp. ".$penghasilan_min." - Rp. 0";
      }
      else if ($penghasilan_max) {
        $penghasilan="Rp. 0 - Rp. ".$penghasilan_max;
      }
      return $penghasilan;
    }
}

if ( ! function_exists('absen'))
{
    function absen($presensi = '')
    {
       if($presensi == 'tidakmasuk') {
       return 'Tidak Masuk'; }
        if($presensi == 'telat') {
          return 'Terlambat'; }
          else{
           return 'Pulang Mendahului';
         }
    }
}

if ( ! function_exists('tidakmasuk'))
{
    function tidakmasuk($nama_status=null,$id_status_tidak_masuk2 = null)
    {
      return ($id_status_tidak_masuk2 == '0') ? '-' : $id_status_tidak_masuk2;
    }
}
if ( ! function_exists('getortu'))
{
    function getortu($nama='')
    {
      if($nama == null){
        return '-';
      }
      else{
        return $nama;
      }
    }
}

if ( ! function_exists('getIbu'))
{
    function getIbu($nama_ortu='',$status_ortu='')
    {
      if($status_ortu == 'ibu'){
        return $nama_ortu;
      }

      else{
        return '-';
      }
    }
}

if ( ! function_exists('get_action'))
{
  function get_action($id = null,$role = null)
  {
    if($role == '1'){
      return '<a href="'.site_url('operator/update/$1').'" data-toggle="tooltip" title="Ubah" class="btn btn-warning btn-sm edit"><i class="fa fa-edit"></i></a>
                    <form method="post" action="'.site_url('operator/delete/$1').'"> 
                    <input type="hidden" name="hapus" value="Y"> 
                    <button class="btn btn-danger btn-sm" data-toggle="tooltip" title="Hapus" onclick="javasciprt: return confirm(\'Apakah Anda Yakin ?\')" type="submit"><i class="fa fa-trash" </i></button></form>';
    }
    else if ($role=='3') {
      return '<form method="post" action="'.site_url('operator/delete/'.$id).'"> 
                <input type="hidden" name="hapus" value="Y"> 
                  <button class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Apakah Anda Yakin ?\')" type="submit"><i class="fa fa-trash" </i></button></form>';
    }else if ($role=='2'){
      return '';
    }
  }
}

if ( ! function_exists('action'))
{
  function action($controller = null,$id = null)
  {
    return 
    '<a href="'.site_url(''.lcfirst($controller).'/read/'.encrypt_url($id)).'" data-toggle="tooltip" title="Detail" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
    <a href="'.site_url(''.lcfirst($controller).'/update/'.encrypt_url($id)).'" data-toggle="tooltip" title="Ubah" class="btn btn-warning btn-sm edit"><i class="fa fa-edit"></i></a>
    <a href="'.site_url(''.lcfirst($controller).'/delete/'.encrypt_url($id)).'" data-toggle="tooltip" title="Hapus" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Apakah Anda Yakin ?\')" ><i class="fa fa-trash" </i></a>';
  }
}

if ( ! function_exists('status_admin'))
{
  function status_admin($role = null)
  {
    if ($role=='3') {
      return '<center><span class="badge bg-aqua">Operator</span></center>';
    }else if ($role=='2'){
      return '<center><span class="badge bg-green">Admin Sekolah</span></center>';
    }else if ($role=='1'){
      return '<center><span class="badge bg-blue">Super Admin</span></center>';
    }
  }
}

if ( ! function_exists('status_bc'))
{
  function status_bc($aktif = null)
  {
    if ($aktif=='Y') {
      return '<center><span class="badge bg-green">Aktif</span></center>';
    }else if ($aktif=='N'){
      return '<center><span class="badge bg-red">Nonaktif</span></center>';
    }
  }
}

if ( ! function_exists('penerima'))
{
  function penerima($broadcast_to = null)
  {
    if ($broadcast_to== '4') {
      return 'Orang Tua / Wali';
    }elseif($broadcast_to == '5'){
      return 'Siswa';
    }else{
      return 'Semua';
    }
  }
}

if ( ! function_exists('rombel_nama'))
{
  function rombel_nama($rombel = null, $receiver = NULL)
  {
    if($receiver == '3'){
      return '';
    }
    if ($rombel== '') {
      return '<center>Semua</center>';
    }else{
      return $rombel;
    }
  }
}

if ( ! function_exists('kelas'))
{
  function kelas($tingkat = null, $receiver = NULL)
  {
    if($receiver == '3')
    {
      return '';
    }
    if ($tingkat== '0') {
      return 'Semua';
    }else{
      return $tingkat;
    }
  }
}



if ( ! function_exists('checkbox'))
{
  function checkbox($id = null)
  {
      return '<input type="checkbox" value="'.$id.'" class="checkbox" data-toggle="toggle" data-size="mini">';
  }
}
         

/* End of file MY_datatable_helper.php */
/* Location: ./application/helpers/MY_datatable_helper.php */
