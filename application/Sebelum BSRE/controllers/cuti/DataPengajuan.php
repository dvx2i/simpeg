<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Group
 *
 * @author Zanuar
 */
class DataPengajuan extends MY_Controller
{

    var $page = "cuti/data_pengajuan";

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_home', 'ref_jenis_cuti', 'ref_berkas_cuti', 'm_pegawai_cuti_online', 'm_pegawai_cuti', 'ref_unit', 'ref_status_permohonan_cuti'));
        $this->load->library('datatables');
    }

    //put your code here

    public function index()
    {
        $data['unit'] = $this->ref_unit->get_unit();
        $data['berkas'] = $this->ref_berkas_cuti->get_all();
        $data['status_permohonan'] = $this->ref_status_permohonan_cuti->get_all();
        $this->loadView($this->page, $data);
    }

    public function json()
    {

        $filter = array(
            'opd'   => $this->input->post('opd'),
            'proses' => $this->input->post('proses'),
        );

        $this->session->set_userdata('filter', $filter);

        header('Content-Type: application/json');
        echo $this->m_pegawai_cuti_online->json();
    }

    public function update($jenis = null)
    {
        if ($jenis != 'sk') {
            $id = $this->input->post('pegawaicuti_id');
            $data['pegawaicuti_status_permohonan'] = '2';

            if ($jenis == 'reject') {
                $data['pegawaicuti_status_permohonan'] = '3';
                $data['pegawaicuti_keterangan_tolak'] = $this->input->post('keterangan');

                $text = "Surat Izin Cuti anda tidak dapat diproses, silakan lakukan pengecekan pada Aplikasi SIPEDAS untuk keterangan lainnya.";
                $nomor  = '6282258611297';
                $curl = curl_init();
                $this->send_wa($curl, $nomor, $text);  
                curl_close($curl);
            } 

            $update = $this->m_pegawai_cuti_online->update_by_no($data, $id);
            if (!empty($update)) {
                $this->session->set_flashdata('message', alert_show('success', "Berhasil Disimpan"));
            } else {
                alert_set('danger', "Gagal Disimpan");
            }
            redirect('cuti/DataPengajuan');
        } else {
            $id = $this->input->post('pegawaicuti_id');

            $row = $this->m_pegawai_cuti_online->get_by_id($id);

            if (empty($this->input->post('nomor'))) { // upload sk

                $cuti = $this->m_pegawai_cuti_online->get_by_no($row->pegawaicuti_no_permohonan);

                foreach ($cuti as $key) {
                    $data['pegawaicuti_pegawai_nip'] = $key['pegawaicuti_pegawai_nip'];
                    $data['pegawaicuti_jeniscuti_id'] = $key['pegawaicuti_jeniscuti_id'];
                    $data['pegawaicuti_lama_cuti_mulai'] = $key['pegawaicuti_lama_cuti_mulai'];
                    $data['pegawaicuti_lama_cuti_selesai'] = $key['pegawaicuti_lama_cuti_selesai'];
                    $data['pegawaicuti_sk_no'] = $key['pegawaicuti_sk_no'];
                    $data['pegawaicuti_sk_tanggal'] = $key['pegawaicuti_sk_tanggal'];
                    $data['pegawaicuti_diambil'] = 0;
                    $data['pegawaicuti_sisa'] = 0;
                    $data['update_user_id'] = $this->session->userdata('login')['user_id'];
                    $insert = $this->m_pegawai_cuti->insert($data);
                }

                // $kode_surat = $this->getKodeSurat();
                $id = $this->input->post('pegawaicuti_id');
                $dir = "assets/files/";
                $config['upload_path']    = $dir;
                $config['allowed_types']  = 'jpg|jpeg|png|pdf';
                $config['overwrite']      = TRUE;
                $config['file_ext_tolower'] = TRUE;
                $config['max_size']     = 2048;
                if ($_FILES["file"]["error"] == 0) {
                    //stands for any kind of errors happen during the uploading

                    $config['file_name'] = "SURAT-IZIN-CUTI-" . $row->pegawaicuti_pegawai_nip . "-" . $row->pegawaicuti_no_permohonan;

                    $this->load->library('upload');

                    $this->upload->initialize($config);

                    $fieldname = "file";

                    if ($this->upload->do_upload($fieldname)) {

                        $upload = array();
                        $upload = $this->upload->data();

                        $data_update['pegawaicuti_status_permohonan'] = '4';
                        $data_update['file_sk'] = $upload['file_name'];
                        $update = $this->m_pegawai_cuti_online->update_by_no($data_update, $row->pegawaicuti_no_permohonan);

                        $text = "Selamat Surat Izin Cuti anda sudah terbit. Terima kasih.";
                        $nomor  = '6282258611297';
                    	$file = $upload['file_name'];
                        
            			if(substr(trim($nomor), 0, 2)=='62' || substr(trim($nomor), 0, 2)=='08') {
            			$curl = curl_init();
                		$this->send_wa($curl, $nomor, $text); 
            			$this->send_media($curl, no_hp($nomor), $text, $file);  
            			curl_close($curl);
            			}
                      
                        
                        $this->session->set_flashdata('message', alert_show('success', "Berhasil Disimpan"));
                        redirect('cuti/DataPengajuan');
                    } else {
                        $this->session->set_flashdata('message', alert_show('danger', "Gagal Disimpan"));
                        redirect('cuti/DataPengajuan');
                    }
                } else {
                    echo '{"success":false}';
                }
            } else { // unduh template

                $data_update['pegawaicuti_sk_no'] = $this->input->post('nomor');
                $data_update['pegawaicuti_sk_tanggal'] = y_m_d($this->input->post('tanggal'));
                // $data_update['file_sk'] = 'SURAT-IZIN-CUTI-'. $row->pegawaicuti_pegawai_nip .'-'. $row->pegawaicuti_no_permohonan .'.docx';
                $update = $this->m_pegawai_cuti_online->update_by_no($data_update, $row->pegawaicuti_no_permohonan);
                $this->cetak($id, $data_update['pegawaicuti_sk_no'], $data_update['pegawaicuti_sk_tanggal']);
            }

            if (!empty($update)) {
                $this->session->set_flashdata('message', alert_show('success', "Berhasil Disimpan"));
            } else {
                $this->session->set_flashdata('message', alert_show('danger', "Gagal Disimpan"));
            }
            redirect('cuti/DataPengajuan');
        }
    }

    public function detail($id)
    {
        $row = $this->m_pegawai_cuti_online->get_by_id($id);
        if ($row) {
            $data = array(
                'usulan_id' => $row->usulan_id,
                'pegawai_nama' => $row->pegawai_nama,
                'pegawai_unit_nama' => $row->pegawai_unit_nama,
                'pegawai_nip' => $row->pegawai_nip,
                'pegawai_nip_lama' => $row->pegawai_nip_lama,
                'usulan_jenis' => $row->usulan_jenis,
                'usulan_propinsi' => $row->usulan_propinsi,
                'usulan_kabupaten' => $row->usulan_kabupaten,
                'usulan_unit_tujuan_id' => $row->usulan_unit_tujuan_id,
                'usulan_status' => $row->usulan_status
            );

            $data['berkas_mutasi'] = $this->m_pegawai_cuti_online->getBerkasByPermohonan($id);
            $data['berkas'] = $this->ref_berkas_mutasi->get_where(array('berkas_jenis_mutasi_id' => $data['usulan_jenis']));

            $datetime1 = date_create($row->pegawai_pns_tmt);
            $datetime2 = date_create(date('Y-m-d'));

            $interval = date_diff($datetime1, $datetime2);
            $data['masa_kerja'] = $interval->format('%y Tahun');
            // print_r($data['berkas']);
            // die;
            $data['provinsi'] = $this->ref_propinsi->get_all(); //get provinsi indo
            $data['kabupaten'] = $this->ref_kabupaten->get_all(); //get provinsi indo
            $data['unit'] = $this->ref_unit->get_unit_parent();

            $this->loadView('cuti/data_pengajuan_detail', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect('cuti/DataPengajuan');
        }
    }

    public function delete($id)
    {
        $simpan = $this->m_pegawai_cuti_online->delete($id);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Berhasil Terhapus"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Gagal Terhapus"));
        }
        redirect('cuti/DataPengajuan');
    }


    public function send_wa($curl, $number, $message)
    {
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://sipedas.sanggau.go.id/lib/send-message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
    				"number" : ' . $number . ',
    				"message": "' . $message . '"
			}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
    }
    

    public function send_media($curl, $number, $message, $file)
    {
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://sipedas.sanggau.go.id/lib/send-media',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "number" : '.$number.',
            "caption": "'.$message.'",
            "file": "'.$file.'"
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

    }


    public function cetak($id, $sk_no, $sk_tgl)
    {

        $this->load->library('Word');

        $PHPWord = new PHPWord();
        $cuti = $this->m_pegawai_cuti_online->get_data_cetak($id);

        $data['no_permohonan'] = $cuti->pegawaicuti_no_permohonan;
        $data['no_sk'] = $sk_no;
        $data['tgl_sk'] = tgl_indo($sk_tgl);
        $data['nip'] = $cuti->pegawai_nip;
        $data['unit'] = $cuti->pegawai_unit_nama;
        $data['pangkat'] = ucwords(strtolower($cuti->pegawai_pangkat_terakhir_nama));
        $data['golongan'] = $cuti->pegawai_pangkat_terakhir_golru;
        $data['pegawaicuti_jeniscuti_id'] = $cuti->pegawaicuti_jeniscuti_id;
        $data['eselon_kode'] = $cuti->pegawai_eselon_id;
        $data['eselon_nama'] = $cuti->pegawai_eselon_nama;
        $data['jabatan_id'] = $cuti->pegawai_jabatan_id;
        $data['jabatan'] = ucwords(strtolower($cuti->pegawai_jabatan_nama));
        $data['tanggal_mulai_1'] = tgl_indo($cuti->pegawaicuti_lama_cuti_mulai);
        $data['tanggal_selesai_1'] = tgl_indo($cuti->pegawaicuti_lama_cuti_selesai);
        $data['lama_hari_1'] = $cuti->pegawaicuti_jumlah_hari;
        $data['terbilang_1'] = terbilang($cuti->pegawaicuti_jumlah_hari);
        $data['tanggal_mulai_2'] = tgl_indo($cuti->th2_mulai);
        $data['tanggal_selesai_2'] = tgl_indo($cuti->th2_selesai);
        $data['lama_hari_2'] = $cuti->th2_jumlah_hari;
        $data['terbilang_2'] = !empty($cuti->th2_jumlah_hari) ? terbilang($cuti->th2_jumlah_hari) : '';
        $data['lama_hari_total'] = $data['lama_hari_1'] + $data['lama_hari_2'];
        $data['terbilang_total'] = terbilang($data['lama_hari_total']);
        $data['pegawaicuti_bertahap'] = $cuti->pegawaicuti_bertahap;

        $tahun = explode(", ", $cuti->pegawaicuti_tahun);
        $total = count($tahun);
        $data['tahun'] = '';
        if ($total > 3) {
            for ($i = 0; $i < $total; $i++) {
                if ($total - 2 == $i) {
                    $data['tahun'] .= 'dan ' . $tahun[$i];
                } elseif ($total - 1 == $i) {
                    $data['tahun'] .= $tahun[$i];
                } else {
                    $data['tahun'] .= $tahun[$i] . ', ';
                }
            }
        } elseif ($total == 3) { // total array 3 tp  terakhir adalah "," 
            for ($i = 0; $i < $total; $i++) {

                if ($i == 0) {
                    $data['tahun'] .= $tahun[$i] . ' dan ';
                } else {
                    $data['tahun'] .= $tahun[$i];
                }
            }
        } else {
            $data['tahun'] = str_replace(',', '', $cuti->pegawaicuti_tahun);
        }


        $data['nama'] = '';
        if (!empty($cuti->pegawai_gelar_depan)) {
            $data['nama'] .= $cuti->pegawai_gelar_depan . '. ';
        }
        $data['nama'] .= ucwords(strtoupper($cuti->pegawai_nama));
        if (!empty($cuti->pegawai_gelar_belakang)) {
            $data['nama'] .= ', ' . $cuti->pegawai_gelar_belakang;
        }
        // die(json_encode($data));

        if ($data['pegawaicuti_jeniscuti_id'] == '4') { // cuti bersalin

            if (substr($data['golongan'], 0, 3) == 'II/' || substr($data['golongan'], 1, 2) == 'I/') { // jika bersalin gol 1 & 2
                $document = $PHPWord->loadTemplate('assets/docs/cuti/bersalin_gol_1&2.docx');
            }
            if (substr($data['golongan'], 0, 3) == 'III' || substr($data['eselon_kode'], 0, 1) == '4') { // jika bersalin gol 3 dan eselon 4
                $document = $PHPWord->loadTemplate('assets/docs/cuti/bersalin_gol_3.docx');
            }
            if (substr($data['golongan'], 0, 2) == 'IV' || substr($data['eselon_kode'], 0, 1) == '3') { // jika bersalin gol 4 dan eselon 3
                $document = $PHPWord->loadTemplate('assets/docs/cuti/bersalin_gol_4.docx');
            }
        } elseif ($data['pegawaicuti_jeniscuti_id'] == '2') { // cuti besar

            if (substr($data['golongan'], 0, 3) == 'II/' || substr($data['golongan'], 1, 2) == 'I/') { // jika besar gol 1 & 2
                $document = $PHPWord->loadTemplate('assets/docs/cuti/besar_gol_1&2.docx');
            }
            if (substr($data['golongan'], 0, 3) == 'III' || substr($data['eselon_kode'], 0, 1) == '4') { // jika besar gol 3 dan eselon 4
                $document = $PHPWord->loadTemplate('assets/docs/cuti/besar_gol_3.docx');
            }
            if (substr($data['golongan'], 0, 2) == 'IV' || substr($data['eselon_kode'], 0, 1) == '3') { // jika besar gol 4 dan eselon 3
                $document = $PHPWord->loadTemplate('assets/docs/cuti/besar_gol_4.docx');
            }
        } elseif ($data['pegawaicuti_jeniscuti_id'] == '3') { // cuti sakit

            if (substr($data['golongan'], 0, 3) == 'II/' || substr($data['golongan'], 1, 2) == 'I/') { // jika sakit gol 1 & 2
                $document = $PHPWord->loadTemplate('assets/docs/cuti/sakit_gol_1&2.docx');
            }
            if (substr($data['golongan'], 0, 3) == 'III' || substr($data['eselon_kode'], 0, 1) == '4') { // jika sakit gol 3 dan eselon 4
                $document = $PHPWord->loadTemplate('assets/docs/cuti/sakit_gol_3.docx');
            }
            if (substr($data['golongan'], 0, 2) == 'IV' || substr($data['eselon_kode'], 0, 1) == '3') { // jika sakit gol 4 dan eselon 3
                $document = $PHPWord->loadTemplate('assets/docs/cuti/sakit_gol_4.docx');
            }
        } elseif ($data['pegawaicuti_jeniscuti_id'] == '5') { // cuti penting

            if (substr($data['golongan'], 0, 3) == 'II/' || substr($data['golongan'], 1, 2) == 'I/') { // jika penting gol 1 & 2
                $document = $PHPWord->loadTemplate('assets/docs/cuti/penting_gol_1&2.docx');
            }
            if (substr($data['golongan'], 0, 3) == 'III' || substr($data['eselon_kode'], 0, 1) == '4') { // jika penting gol 3 dan eselon 4
                $document = $PHPWord->loadTemplate('assets/docs/cuti/penting_gol_3.docx');
            }
            if (substr($data['golongan'], 0, 2) == 'IV' || substr($data['eselon_kode'], 0, 1) == '3') { // jika penting gol 4 dan eselon 3
                $document = $PHPWord->loadTemplate('assets/docs/cuti/penting_gol_4.docx');
            }
            if ($data['jabatan_id'] == '1') {
                $document = $PHPWord->loadTemplate('assets/docs/cuti/penting_sekda.docx');
            }
        } elseif ($data['pegawaicuti_jeniscuti_id'] == '1') { // cuti tahunan

            if (substr($data['golongan'], 0, 3) == 'II/' || substr($data['golongan'], 1, 2) == 'I/') { // jika tahunan gol 1 & 2

                if ($data['pegawaicuti_bertahap'] == '1' && $data['lama_hari_2'] == null) { // total tahun line 214 // satu tahap only template
                    $document = $PHPWord->loadTemplate('assets/docs/cuti/tahunan_1tahap_gol_1&2.docx');
                }
                if ($data['pegawaicuti_bertahap'] == '1' && $data['lama_hari_2'] != null) { // total tahun line 214 // 2 tahap template
                    $document = $PHPWord->loadTemplate('assets/docs/cuti/tahunan_2tahap_gol_1&2.docx');
                }
                if ($data['pegawaicuti_bertahap'] != '1') {
                    $document = $PHPWord->loadTemplate('assets/docs/cuti/tahunan_gol_1&2.docx');
                }
            }
            if (substr($data['golongan'], 0, 3) == 'III' || substr($data['eselon_kode'], 0, 1) == '4') { // jika tahunan gol 3 dan eselon 4

                if ($data['pegawaicuti_bertahap'] == '1' && $data['lama_hari_2'] == null) { // total tahun line 214 // satu tahap only template
                    $document = $PHPWord->loadTemplate('assets/docs/cuti/tahunan_1tahap_gol_3.docx');
                }
                if ($data['pegawaicuti_bertahap'] == '1' && $data['lama_hari_2'] != null) { // total tahun line 214 // 2 tahap template
                    $document = $PHPWord->loadTemplate('assets/docs/cuti/tahunan_2tahap_gol_3.docx');
                }
                if ($data['pegawaicuti_bertahap'] != '1') {
                    $document = $PHPWord->loadTemplate('assets/docs/cuti/tahunan_gol_3.docx');
                }
            }
            if (substr($data['golongan'], 0, 2) == 'IV' || substr($data['eselon_kode'], 0, 1) == '3') { // jika tahunan gol 4 dan eselon 3

                if ($data['pegawaicuti_bertahap'] == '1' && $data['lama_hari_2'] == null) { // total tahun line 214 // satu tahap only template

                    if ($data['jabatan_id'] == '1') {
                        $document = $PHPWord->loadTemplate('assets/docs/cuti/tahunan_1tahap_sekda.docx');
                    } else {
                        $document = $PHPWord->loadTemplate('assets/docs/cuti/tahunan_1tahap_gol_4.docx');
                    }
                }
                if ($data['pegawaicuti_bertahap'] == '1' && $data['lama_hari_2'] != null) { // total tahun line 214 // 2 tahap template

                    if ($data['jabatan_id'] == '1') {
                        $document = $PHPWord->loadTemplate('assets/docs/cuti/tahunan_2tahap_sekda.docx');
                    } else {
                        $document = $PHPWord->loadTemplate('assets/docs/cuti/tahunan_2tahap_gol_4.docx');
                    }
                }
                if ($data['pegawaicuti_bertahap'] != '1') {
                    if ($data['jabatan_id'] == '1') {
                        $document = $PHPWord->loadTemplate('assets/docs/cuti/tahunan_sekda.docx');
                    } else {
                        $document = $PHPWord->loadTemplate('assets/docs/cuti/tahunan_gol_4.docx');
                    }
                }
            }
        }

        $document->setValue('no_sk', '' . $data['no_sk'] . '');
        $document->setValue('tahun', '' . $data['tahun'] . '');
        $document->setValue('nama', '' . $data['nama']  . '');
        $document->setValue('nip', '' . $data['nip']  . '');
        $document->setValue('pangkat', '' . $data['pangkat']  . '');
        $document->setValue('golongan', '' . $data['golongan']  . '');
        $document->setValue('jabatan', '' . $data['jabatan']  . '');
        $document->setValue('unit', '' . $data['unit']  . '');
        $document->setValue('lama_hari_1', '' . $data['lama_hari_1']  . '');
        $document->setValue('terbilang_1', '' . $data['terbilang_1']  . '');
        $document->setValue('tanggal_mulai_1', '' . $data['tanggal_mulai_1']  . '');
        $document->setValue('tanggal_selesai_1', '' . $data['tanggal_selesai_1']  . '');
        $document->setValue('lama_hari_2', '' . $data['lama_hari_2']  . '');
        $document->setValue('terbilang_2', '' . $data['terbilang_2']  . '');
        $document->setValue('tanggal_mulai_2', '' . $data['tanggal_mulai_2']  . '');
        $document->setValue('tanggal_selesai_2', '' . $data['tanggal_selesai_2']  . '');
        $document->setValue('lama_hari_total', '' . $data['lama_hari_total']  . '');
        $document->setValue('terbilang_total', '' . $data['terbilang_total']  . '');
        $document->setValue('tgl_sk', '' . $data['tgl_sk']  . '');
        $file = 'assets/docs/cuti/SURAT-IZIN-CUTI-' . $data['nip'] . '-' . $data['no_permohonan'] . '.docx';

        $document->save($file);

        redirect(base_url($file));

        // $filename='PENETAPAN KENAIKAN GAJI BERKALA - '.$nip.'.docx'; //save our document as this file name

        // header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document'); //mime type
        // header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        // header('Cache-Control: max-age=0'); //no cache

        // $objWriter = PHPWord_IOFactory::createWriter($this->word, 'Word2003');
        // $objWriter->save('php://output');

    }
}
