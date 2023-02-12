<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ImportCpns extends MY_Controller {

    //variable
    var $view = 'pegawai/import_cpns';     // file view
    var $redirect = 'pegawai/ImportCpns';     // redirect to here
    var $modul = 'Koncersi TP CPNS';        // this modul or class name

    public function __construct() {
        parent::__construct();
        $this->load->model(array('m_pegawai','m_konversi','ref_agama','ref_pangkat_golongan','ref_status_perkawinan'));
    }

    public function index() {
        $data['konversi'] = '';
        $this->loadView($this->view,$data);
    }

    public function detail($id) {
        $data['result'] = $this->m_konversi->get_row($id);
        $this->loadView($this->view, $data);
    }

    private function set_data() {
        $data['kolom'] = $this->input->post('post_name');
        return $data;
    }

    public function add() {
        //extrac post here    
        $this->load->library('PHPExcel');
        $this->load->model('m_konversi');
        $this->load->model('m_pegawai');
        $file_data = $_FILES['userfile'];
        $file_path = $file_data['tmp_name'];
        $inputFileName = $file_path;
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
        $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
        $arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet

        $row = 0;
        $summary = '';

        foreach ($allDataInSheet as $value) {
            $error = '';
            $success = '';
            if ($row > 0 && $value['A'] != null) {

                $data['pegawai_nip'] = $value['A'];
                $data['pegawai_gelar_depan'] = $value['B'];
                $data['pegawai_nama'] = $value['C'];
                $data['pegawai_gelar_belakang'] = $value['D'];
                $data['pegawai_tempat_lahir'] = $value['E'];
                $data['pegawai_tgl_lahir'] = tanggal_mysql($value['G'],'-');

                if(trim(strtoupper($value['H'])) == 'PEREMPUAN'){
                    $jk_id = '2';
                    $jk_nama = 'PEREMPUAN';
                }else{
                    $jk_id = '1';
                    $jk_nama = 'LAKI-LAKI';
                }

                $data['pegawai_jenkel_id'] = $jk_id;
                $data['pegawai_jenkel_nama'] = $jk_nama;

                $agama = $this->ref_agama->get_where(array('agama_nama' => ucfirst($value['I'])))->row();
                $data['pegawai_agama_id'] = $agama->agama_id;
                $data['pegawai_agama_nama'] = $agama->agama_nama;

                $data['pegawai_status_kepegawaian_id'] = $value['J'];
                $data['pegawai_status_kepegawaian_nama'] = $value['J'] == '1' ? 'CPNS' : 'PNS';
                $data['pegawai_no_ktp'] = $value['J'];
                
                $kawin = $this->ref_status_perkawinan->get_where(array('status_perkawinan_nama' => ucfirst($value['M'])))->row();
                $data['pegawai_statusperkawinan_id'] = $kawin->status_perkawinan_id;
                $data['pegawai_statusperkawinan_nama'] = ucfirst($value['M']);

                $data['pegawai_golongandarah_nama'] = $value['O'];
                $data['pegawai_alamat'] = $value['P'];
                $data['pegawai_rt'] = $value['Q'];
                $data['pegawai_rw'] = $value['R'];
                $data['pegawai_kodepos'] = $value['S'];
                $data['pegawai_telpon'] = $value['T'];
                $data['pegawai_hp'] = $value['T'];
                $data['pegawai_email'] = $value['U'];
                // $data['pegawai_propinsi_id'] = $value['V'];
                // $data['pegawai_kabupaten_id'] = $value['W'];
                // $data['pegawai_kecamatan_id'] = $value['X'];
                // $data['pegawai_kelurahan_id'] = $value['Y'];
                $data['pegawai_no_karpeg'] = $value['Z'];
                $data['pegawai_no_askes'] = $value['AA'];
                $data['pegawai_no_taspen'] = $value['AB'];
                $data['pegawai_no_karis'] = $value['AC'];
                $data['pegawai_no_npwp'] = $value['AD'];

                $data['pegawai_cpns_sk_no'] = $value['AE'];
                $data['pegawai_cpns_sk_date'] = tanggal_mysql($value['AF'],'-');
                $data['pegawai_cpns_tmt'] = tanggal_mysql($value['AG'],'-');
                $pangkat = $this->ref_pangkat_golongan->get_where(array('pangkat_golongan_nama' => $value['AH']))->row();
                $data['pegawai_cpns_pangkat_id'] = $pangkat->pangkat_golongan_id;
                $data['pegawai_cpns_masa_kerja_tahun'] = $value['AK'];
                $data['pegawai_cpns_masa_kerja_bulan'] = $value['AL'];
                
                $pangkat = $this->ref_pangkat_golongan->get_where(array('pangkat_golongan_nama' => $value['AI']))->row();
                $data['pegawai_pangkat_terakhir_id'] = $pangkat->pangkat_golongan_id;
                $data['pegawai_pangkat_terakhir_nama'] = $pangkat->pangkat_golongan_pangkat;
                $data['pegawai_pangkat_terakhir_golru'] = $pangkat->pangkat_golongan_nama;
                $data['pegawai_pangkat_terakhir_tmt'] = tanggal_mysql($value['AJ'],'-');

                
                $data['pegawai_jenisjabatan_kode'] = $value['AM'];
                $data['pegawai_jenisjabatan_nama'] = $value['AN'];
                $data['pegawai_jabatan_nama'] = $value['AO'];
                $data['pegawai_jabatan_tmt'] = tanggal_mysql($value['AP'],'-');
                $data['pegawai_pendidikan_terakhir_nama'] = $value['AQ'];
                $data['pegawai_pendidikan_terakhir_jurusan'] = $value['AR'];
                $data['pegawai_pendidikan_terakhir_tingkat'] = $value['AQ'];
                // print_r($data); die;
                $exist = $this->m_pegawai->get_where(array('pegawai_nip' => $data['pegawai_nip']));
                if($exist->num_rows() > 0){
                    $insert = $this->m_pegawai->update($data, $data['pegawai_nip']);
                }
                else{
                    $insert = $this->m_pegawai->insert($data);
                }
                if ($insert) {
                    $summary .= "NIP. " . $data['pegawai_nip'] . " IMPORT DATA CPNS BERHASIL" . "<br/>";
                } else {
                    $summary .= "NIP. " . $data['pegawai_nip'] . " IMPORT DATA CPNS GAGAL" . "<br/>";
                }
            }
            $row++;
        }
        $hasil['konversi'] = $summary;
       $this->session->set_flashdata('konversi', $summary);
        $this->loadView($this->view, $hasil);
    }


    public function excel() {
        $data['result'] = $this->m_konversi->get_all();
        $data['nama_file'] = date('Ymdhis') . '_' . $this->modul;
        $this->load->view('export/excel', $data);
    }

}
