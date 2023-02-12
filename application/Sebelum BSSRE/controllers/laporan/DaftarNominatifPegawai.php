<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DaftarNominatifPegawai
 *
 * @author Zanuar
 */
class DaftarNominatifPegawai extends MY_Controller
{

    //put your code here


    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('ref_eselon', 'm_laporan', 'ref_jabatan_kedudukan', 'ref_pendidikan_tingkat', 'ref_status_kepegawaian', 'm_pegawai', 'ref_unit', 'ref_jenis_kelamin', 'ref_pangkat_golongan'));
    }

    function index()
    {
        $where['pegawai_status_kepegawaian_nama'] = 'PNS';

        //REFERENSI
        $data['status_kepegawaian'] = $this->ref_status_kepegawaian->get_all();
        $data['unit'] = $this->ref_unit->get_where(array('unit_parent_id' => NULL, 'unit_kode <> ' => '0100000'));
        $data['jenis_kelamin'] = $this->ref_jenis_kelamin->get_all();
        $data['pangkat_golongan'] = $this->ref_pangkat_golongan->get_all();
        $data['pendidikan_tingkat'] = $this->ref_pendidikan_tingkat->get_all();
        $data['jabatan_kedudukan'] = $this->ref_jabatan_kedudukan->get_all();
        $data['eselon'] = $this->ref_eselon->get_all();
        $data['kolom'] = $this->m_laporan->get_kolom_pegawai();

        //POST
        if (!empty($this->input->post('pegawai_unit_id'))) {
            $where['pegawai_unit_id'] = $this->input->post('pegawai_unit_id');
        }
        if (!empty($this->input->post('pegawai_jenkel_id'))) {
            $where['pegawai_jenkel_id'] = $this->input->post('pegawai_jenkel_id');
        }
        if (!empty($this->input->post('pegawai_pangkat_terakhir_id'))) {
            $where['pegawai_pangkat_terakhir_id'] = $this->input->post('pegawai_pangkat_terakhir_id');
        }
        if (!empty($this->input->post('pegawai_pendidikan_terakhir_tingkat'))) {
            $where['pegawai_pendidikan_terakhir_tingkat'] = $this->input->post('pegawai_pendidikan_terakhir_tingkat');
        }
        if (!empty($this->input->post('pegawai_jenisjabatan_kode'))) {
            $where['pegawai_jenisjabatan_kode'] = $this->input->post('pegawai_jenisjabatan_kode');
        }
        if (!empty($this->input->post('pegawai_eselon_id'))) {
            $where['pegawai_eselon_id'] = $this->input->post('pegawai_eselon_id');
        }

        $where['pegawai_status'] = '1';

        $data['result'] = null;
        if (!empty($this->input->post())) {
            $data['result'] = $this->m_pegawai->get_where($where);
        }

        $data['where'] = $where;
        $data['where_kolom'] = $this->input->post('kolom');

        $this->loadView('laporan/daftar_nominatif_pegawai', $data);
    }

    function excel()
    {

        $data['kolom'] = $this->m_laporan->get_kolom_pegawai();
        foreach ($this->input->post('kolom') as $item) {
            foreach ($data['kolom'] as $key) {
                if ($key->id == $item) {
                    $kolom[] = array('id' => $item, 'value' => $key->kolom, 'nama' => $key->nama);
                }
            }
        }

        // die(json_encode($kolom));

        $data['result'] = $this->m_laporan->get_daftar_nominatif_pegawai_excel($kolom);

        $jumlah_field = count($kolom);

        $alphabet = array();
        for ($na = 0; $na < $jumlah_field; $na++) {
            $alphabet[] = $this->generateAlphabet($na);
        }
        $last_alpabet = $alphabet[$jumlah_field - 1];


        $this->load->library("Excel/PHPExcel");

        // Create Objek phpExcel
        $objPHPExcel = new PHPExcel();

        $header = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ),
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => '000000'),
                'name' => 'Verdana'
            )
        );
        $table_header = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ),
            'font' => array(
                'bold' => true,
            )

        );


        $link_style_array = array(
            'font' => array(
                'color' => array('rgb' => '0000FF'),
                'underline' => 'single',
            ),
        );

        $borderStyleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );


        $counter = 2;
        $objPHPExcel->getActiveSheet()->mergeCells('A' . $counter . ':' . $last_alpabet . $counter);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $counter . ':' . $last_alpabet . $counter)
            ->applyFromArray($header)
            ->getFont()->setSize(9);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A' . $counter, 'DAFTAR NOMINATIF PEGAWAI');

        $counter = $counter+1; 
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A' . $counter, 'Keadaan '.tgl_indo(date('Y-m-d')));
        $objPHPExcel->getActiveSheet()->mergeCells('A' . $counter . ':' . $last_alpabet . $counter);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $counter . ':' . $last_alpabet . $counter)
            ->applyFromArray($header)
            ->getFont()->setSize(8);


        $counter = 6;
        $first_row_header = $counter;

        foreach($alphabet as $key1 => $value1){
            foreach($kolom as $key2 => $value2){
                if($key1 == $key2){
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($value1 . $counter, $value2['nama']);
                    
                }
            }
        }
        // if (in_array('instansi', $data['field_name']) )
        //   $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$counter, 'Unit Kerja');

        // $objPHPExcel->getActiveSheet()->mergeCells('A' . $counter . ':C' . $counter);

        $last_row_header = $counter;

        $objPHPExcel->getActiveSheet()->getStyle("A" . $first_row_header . ":".$last_alpabet . $last_row_header)
            ->applyFromArray($table_header)
            ->getFont()->setSize(12);
        $objPHPExcel->getActiveSheet()->getStyle("A6:". $last_alpabet.$counter)
            ->getAlignment()->setWrapText(true);
        //end header

        // ===============================

        $ex = $objPHPExcel->setActiveSheetIndex(0);
        $counter = $counter + 1;

        // $mutasi = $this->mutasi_model->get_all($data);


        // foreach($alphabet as $key1 => $value1){
        //     $objPHPExcel->getActiveSheet()->getColumnDimension($value1)->setWidth(30);
        // }
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
        foreach ($alphabet as $columnID) {
          $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
            ->setAutoSize(true);
        }

        // die(json_encode($data['mutasi']));
        $counter_lokasi = 0;
        $urut = 1;
        foreach ($data['result'] as $key => $value) :
            foreach($alphabet as $key1 => $value1){
                foreach($kolom as $key2 => $value2){
                    if($key1 == $key2){

                        if($value1 == 'A'){
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $counter, $urut++);
                        }
                        elseif($value2['value'] == 'pegawai_nip'){
                            
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($value1 . $counter, ' ' . $value['pegawai_nip']. ' ');
                            $objPHPExcel->getActiveSheet()
                            ->getStyle($value1 . $counter)->setQuotePrefix(true);
                        }
                        elseif($value2['value'] == 'pegawai_no_ktp'){
                            
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($value1 . $counter, ' ' . $value['pegawai_no_ktp']. ' ');
                            $objPHPExcel->getActiveSheet()
                            ->getStyle($value1 . $counter)->setQuotePrefix(true);
                        }
                        elseif($value2['value'] == 'pegawai_no_npwp'){
                            
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($value1 . $counter, ' ' . $value['pegawai_no_npwp']. ' ');
                            $objPHPExcel->getActiveSheet()
                            ->getStyle($value1 . $counter)->setQuotePrefix(true);
                        }
                        elseif($value2['value'] == 'pegawai_nama'){
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($value1 . $counter, $value['pegawai_gelar_depan']. ' ' . $value['pegawai_nama'] . ' ' . $value['pegawai_gelar_belakang']);
                        }
                        elseif($value2['value'] == 'pegawai_alamat'){
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($value1 . $counter, $value['pegawai_alamat'] . ' RT. ' . $value['pegawai_rt'] . '/RW. ' . $value['pegawai_rw'] . ' ' . $value['pegawai_kecamatan_nama']);
                        }else{
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($value1 . $counter, $value[$value2['value']]);
                        }
                    }
                }
            }
            $counter++;
        endforeach;


        $objPHPExcel->getActiveSheet()->getStyle($alphabet[0] . "6:" . $alphabet[$jumlah_field - 1] . $counter)
            ->applyFromArray($borderStyleArray);

            PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
        $objPHPExcel->getProperties()->setCreator("Nominatif Pegawai")
            ->setLastModifiedBy("Nominatif Pegawai")
            ->setTitle("Export Data Nominatif Pegawai")
            ->setSubject("Export Nominatif Pegawai To Excel")
            ->setDescription("Doc for Office 2007 XLSX, generated by PHPExcel.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("PHPExcel");
        $objPHPExcel->getActiveSheet()->setTitle('Data Nominatif Pegawai');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        ob_end_clean(); // MENGHILANGKAN ERROR CANNOT OPEN
        header('Last-Modified:' . gmdate("D, d M Y H:i:s") . 'GMT');
        header('Chace-Control: no-store, no-cache, must-revalation');
        header('Chace-Control: post-check=0, pre-check=0', FALSE);
        header('Pragma: no-cache');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Export Data Nominatif Pegawai ' . date('Y-m-d') . '.xlsx"');

        $objWriter->save('php://output');
        die();
    }

    function generateAlphabet($na)
    {
        $sa = "";
        while ($na >= 0) {
            $sa = chr($na % 26 + 65) . $sa;
            $na = floor($na / 26) - 1;
        }
        return $sa;
    }
}
