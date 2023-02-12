<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pengajuan extends MY_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model(array('m_home', 'ref_jenis_cuti', 'ref_berkas_cuti', 'm_pegawai_cuti_online', 'm_pegawai'));
    }


    function index()
    {
        $this->load->helper('text');
        date_default_timezone_set('Asia/Jakarta');
        $data['result'] = $this->m_pegawai_cuti_online->get_cuti_by_nip(array('pegawai_nip' => $this->session->userdata('login')['nip'], 'pegawaicuti_tahap' => '1'));
        $data['no_permohonan'] = "";
        $data['berkas'] = $this->ref_berkas_cuti->get_all();

        if(!empty($this->session->userdata('no_permohonan'))){
            $data['no_permohonan'] = $this->session->userdata('no_permohonan');
        }

        $this->session->unset_userdata('no_permohonan');
        $data["content"] = $this->load->view('cuti/home', $data, TRUE);
        $this->load->view('publik/template', $data);
    }
    
    function create()
    {
        $this->load->helper('text');
        date_default_timezone_set('Asia/Jakarta');
        
        $data['jenis_cuti'] = $this->ref_jenis_cuti->get_all();
        
        $session = $this->session->userdata('login');
        $pegawai = $this->m_pegawai->get_row($session['nip']);
        $data['jenkel_id'] = $pegawai->pegawai_jenkel_id;
        $data['action'] = site_url('cuti/Pengajuan/create_action');
        $data['nama'] = $session['fullname'];
        $data['nip']  = $session['nip'];
        $data['pegawaicuti_id']  = set_value('pegawaicuti_id');
        $data['jeniscuti_id']  = set_value('jeniscuti_id');
        $data['bertahap']  = set_value('bertahap');
        $data['cuti_mulai']  = set_value('cuti_mulai');
        $data['cuti_selesai']  = set_value('cuti_selesai');
        $data['jumlah_hari']  = set_value('jumlah_hari');
        // $data['keterangan']  = set_value('keterangan');
        $data['cuti_mulai_2']  = set_value('cuti_mulai');
        $data['cuti_selesai_2']  = set_value('cuti_selesai');
        $data['jumlah_hari_2']  = set_value('jumlah_hari');
        // $data['keterangan_2']  = set_value('keterangan');
        $data['tahun'][0]  = set_value('tahun');
        $data['tahun'][1]  = set_value('tahun');
        $data['tahun'][2]  = set_value('tahun', date('Y'));
        $data['berkas'] = $this->ref_berkas_cuti->get_all();

        $data["content"] = $this->load->view('cuti/form', $data, TRUE);
        $this->load->view('publik/template', $data);
    }
    
    function create_action()
    {
        date_default_timezone_set('Asia/Jakarta');
        $data['pegawaicuti_pegawai_nip'] = $this->session->userdata('login')['nip'];
        $data['pegawaicuti_jeniscuti_id'] = $this->input->post('jeniscuti_id');
        $data['pegawaicuti_lama_cuti_mulai'] = y_m_d($this->input->post('cuti_mulai'));
        $data['pegawaicuti_lama_cuti_selesai'] = y_m_d($this->input->post('cuti_selesai'));
        $data['pegawaicuti_jumlah_hari'] = $this->input->post('jumlah_hari');
        $data['pegawaicuti_status_permohonan'] = '1';
        $data['pegawaicuti_bertahap'] = $this->input->post('bertahap'); // 1= ya, 0 =tidak
        $data['pegawaicuti_tahap'] = '1'; // 1,2,3 dst
        $data['pegawaicuti_parent'] = '0'; // 0 karena yg pertama adlh parent
        // $data['pegawaicuti_keterangan'] = $this->input->post('keterangan');
        $data['insert_user_id'] = $this->session->userdata('login')['user_id'];
        $data['pegawaicuti_no_permohonan'] = $this->m_pegawai_cuti_online->get_no_permohonan();
        $data['pegawaicuti_tahun'] = '';
        $tahuns = $this->input->post('tahun');

        foreach($tahuns as $tahun) {
            $data['pegawaicuti_tahun'] .= $tahun.', ';
        }
        
        if($data['pegawaicuti_bertahap'] <> '0' && !empty($this->input->post('jumlah_hari_1'))){
            $data['pegawaicuti_lama_cuti_mulai'] = y_m_d($this->input->post('cuti_mulai_1'));
            $data['pegawaicuti_lama_cuti_selesai'] = y_m_d($this->input->post('cuti_selesai_1'));
            $data['pegawaicuti_jumlah_hari'] = $this->input->post('jumlah_hari_1');
        }

        $this->session->set_userdata('no_permohonan', $data['pegawaicuti_no_permohonan']);
        
        $insert_id = $this->m_pegawai_cuti_online->insert_row($data);

        if($data['pegawaicuti_bertahap'] <> '0' && !empty($this->input->post('jumlah_hari_2'))){ // insert untuk tahap 2 jika bertahap
            $data['pegawaicuti_lama_cuti_mulai'] = y_m_d($this->input->post('cuti_mulai_2'));
            $data['pegawaicuti_lama_cuti_selesai'] = y_m_d($this->input->post('cuti_selesai_2'));
            $data['pegawaicuti_jumlah_hari'] = $this->input->post('jumlah_hari_2');
            $data['pegawaicuti_tahap'] = '2'; // 1,2,3 dst
            $data['pegawaicuti_parent'] = $insert_id; // 0 karena yg pertama adlh parent
            // $data['pegawaicuti_keterangan'] = $this->input->post('keterangan_2');
            $this->m_pegawai_cuti_online->insert($data);
        }
        
        if (!empty($insert_id)) {

            $berkas = $this->ref_berkas_cuti->get_all();

                // $fileExt = pathinfo($_FILES["berkas"]["name"], PATHINFO_EXTENSION);
                // die($fileExt);

                $dir = "assets/files/cuti";
                $config['upload_path']    = $dir;
                $config['allowed_types']  = 'jpg|jpeg|png|pdf';
                $config['overwrite']      = TRUE;
                $config['file_ext_tolower'] = TRUE;
                $config['max_size']     = 2084;
                // $config['encrypt_name'] = TRUE;
                // die($config['file_name']);

                foreach ($berkas->result_array() as $item) {

                    $id = $item['berkas_id'];
                    // print_r($_FILES["berkas_" . $id]["name"]); die;
                    $config['file_name'] = md5($id) . '_' . date('H_i_s');

                    if ($_FILES["berkas_" . $id]["name"] != NULL) {
                        $this->load->library('upload');

                        $this->upload->initialize($config);

                        $fieldname = "berkas_" . $id;

                        if ($this->upload->do_upload($fieldname)) {

                            $upload = array();
                            $upload = $this->upload->data();

                            $data_file = array(
                                'cuti_id' => $insert_id,
                                'url_file' => $upload['file_name'],
                                'berkas_id' => $id
                            );
                            $this->m_pegawai_cuti_online->save_file($data_file);
                        } else {
                            $this->session->set_flashdata('message', alert_show('danger', "Upload File Gagal"));
                            redirect('cuti/Pengajuan/create');
                        }
                    }else{
                        $this->session->set_flashdata('message', alert_show('danger', "Berkas Tidak Lengkap"));
                        redirect('cuti/Pengajuan/create');
                    }
                }

            $this->session->set_flashdata('message', "success");
        } else {
            $this->session->set_flashdata('message', "fail");
        }
        redirect('cuti/Pengajuan');
    }
    
    function update($id)
    {
        $this->load->helper('text');
        date_default_timezone_set('Asia/Jakarta');
        
        $data['jenis_cuti'] = $this->ref_jenis_cuti->get_all();
        $row = $this->m_pegawai_cuti_online->get_by_no($id);
        
        $session = $this->session->userdata('login');
        if($row[0]['pegawaicuti_pegawai_nip'] == $session['nip']) {
            
            $data['pegawai'] = $this->m_pegawai->get_row($session['nip']);
            $data['action'] = site_url('cuti/Pengajuan/update_action/'.$id);
            $data['nama'] = $session['fullname'];
            $data['nip']  = $session['nip'];
            $data['pegawaicuti_id']  = set_value('pegawaicuti_id', $row[0]['pegawaicuti_id']);
            $data['jeniscuti_id']  = set_value('jeniscuti_id', $row[0]['pegawaicuti_jeniscuti_id']);
            $data['bertahap']  = set_value('bertahap', $row[0]['pegawaicuti_bertahap']);
            $data['cuti_mulai']  = set_value('cuti_mulai', $row[0]['pegawaicuti_lama_cuti_mulai']);
            $data['cuti_selesai']  = set_value('cuti_selesai', $row[0]['pegawaicuti_lama_cuti_selesai']);
            // $data['keterangan']  = set_value('keterangan', $row[0]['pegawaicuti_keterangan']);
            $data['jumlah_hari']  = set_value('jumlah_hari', $row[0]['pegawaicuti_jumlah_hari']);
            $data['cuti_mulai_2']  = set_value('cuti_mulai');
            $data['cuti_selesai_2']  = set_value('cuti_selesai');
            $data['jumlah_hari_2']  = set_value('jumlah_hari');
            // $data['keterangan_2']  = set_value('keterangan');

            if($data['bertahap'] <> '0') {
                $row2 = $this->m_pegawai_cuti_online->get_by_parent($row[0]['pegawaicuti_id']);
                $data['cuti_mulai_2']  = set_value('cuti_mulai', $row2->pegawaicuti_lama_cuti_mulai);
                $data['cuti_selesai_2']  = set_value('cuti_selesai', $row2->pegawaicuti_lama_cuti_selesai);
                // $data['keterangan_2']  = set_value('keterangan', $row2->pegawaicuti_keterangan);
                $data['jumlah_hari_2']  = set_value('jumlah_hari', $row2->pegawaicuti_jumlah_hari);
            }
            $data['berkas'] = $this->ref_berkas_cuti->get_all();
            $data['berkas_cuti'] = $this->m_pegawai_cuti_online->getBerkasByPermohonan($row[0]['pegawaicuti_id']);

            $tahuns = explode(',',$row[0]['pegawaicuti_tahun']);
            for($i=0; $i<=2; $i++){
                $data['tahun'][$i]  = set_value('tahun', isset($tahuns[$i]) ? $tahuns[$i] : '');
            }

            $data["content"] = $this->load->view('cuti/form', $data, TRUE);
            $this->load->view('publik/template', $data);
        }else{
            redirect('cuti/Pengajuan');
        }
    }
    
    function update_action()
    {
        date_default_timezone_set('Asia/Jakarta');
        $id = $this->input->post('pegawaicuti_id');
        $session = $this->session->userdata('login');
        $row = $this->m_pegawai_cuti_online->get_by_id($id);
        if ($row) {

        $data['pegawaicuti_bertahap'] = $this->input->post('bertahap'); // 1= ya, 0 =tidak
        $data['pegawaicuti_jeniscuti_id'] = $this->input->post('jeniscuti_id');
        $data['pegawaicuti_lama_cuti_mulai'] = y_m_d($this->input->post('cuti_mulai'));
        $data['pegawaicuti_lama_cuti_selesai'] = y_m_d($this->input->post('cuti_selesai'));
        $data['pegawaicuti_jumlah_hari'] = $this->input->post('jumlah_hari');
        $data['pegawaicuti_status_permohonan'] = '1';
        // $data['pegawaicuti_keterangan'] = $this->input->post('keterangan');
        $data['pegawaicuti_tahun'] = '';
        $tahuns = $this->input->post('tahun');

        foreach($tahuns as $tahun) {
            $data['pegawaicuti_tahun'] .= $tahun.', ';
        }
        
        $update = $this->m_pegawai_cuti_online->update($data, $id);
        
        if (!empty($update)) {
            
            if($data['pegawaicuti_bertahap'] <> '0'){ // insert untuk tahap 2 jika bertahap
                
                $row2 = $this->m_pegawai_cuti_online->get_by_parent($id);
                
                if(!empty($row2)){
                    $id2 = $row2->pegawaicuti_id;
                    $data['pegawaicuti_lama_cuti_mulai'] = y_m_d($this->input->post('cuti_mulai_2'));
                    $data['pegawaicuti_lama_cuti_selesai'] = y_m_d($this->input->post('cuti_selesai_2'));
                    $data['pegawaicuti_jumlah_hari'] = $this->input->post('jumlah_hari_2');
                    // $data['pegawaicuti_keterangan'] = $this->input->post('keterangan_2');
                    $this->m_pegawai_cuti_online->update($data, $id2);
                }else if(!empty($this->input->post('jumlah_hari_2'))){
                    $data['pegawaicuti_pegawai_nip'] = $row->pegawaicuti_pegawai_nip;
                    $data['pegawaicuti_jeniscuti_id'] = $row->pegawaicuti_jeniscuti_id;
                    $data['pegawaicuti_no_permohonan'] = $row->pegawaicuti_no_permohonan;
                    $data['pegawaicuti_lama_cuti_mulai'] = y_m_d($this->input->post('cuti_mulai_2'));
                    $data['pegawaicuti_lama_cuti_selesai'] = y_m_d($this->input->post('cuti_selesai_2'));
                    $data['pegawaicuti_jumlah_hari'] = $this->input->post('jumlah_hari_2');
                    $data['pegawaicuti_tahap'] = '2'; // 1,2,3 dst
                    $data['pegawaicuti_parent'] = $id; // 0 karena yg pertama adlh parent
                    // $data['pegawaicuti_keterangan'] = $this->input->post('keterangan_2');
                    $this->m_pegawai_cuti_online->insert($data);
                }
            }

            $berkas = $this->ref_berkas_cuti->get_all();

                // $fileExt = pathinfo($_FILES["berkas"]["name"], PATHINFO_EXTENSION);
                // die($fileExt);

                $dir = "assets/files/cuti";
                $config['upload_path']    = $dir;
                $config['allowed_types']  = 'jpg|jpeg|png|pdf';
                $config['overwrite']      = TRUE;
                $config['file_ext_tolower'] = TRUE;
                $config['max_size']     = 2084;
                // $config['encrypt_name'] = TRUE;
                // die($config['file_name']);

                foreach ($berkas->result_array() as $item) {

                    $id_berkas = $item['berkas_id'];
                    // print_r($_FILES["berkas_" . $id]["name"]); die;
                    $config['file_name'] = md5($id) . '_' . date('H_i_s');

                    if ($_FILES["berkas_" . $id]["name"] != NULL) {
                        $this->load->library('upload');

                        $this->upload->initialize($config);

                        $fieldname = "berkas_" . $id;

                        if ($this->upload->do_upload($fieldname)) {
                            
                            $this->m_pegawai_cuti_online->delete_file($id_berkas,$id); //delete file yg sdh ada

                            $upload = array();
                            $upload = $this->upload->data();

                            $data_file = array(
                                'cuti_id' => $id,
                                'url_file' => $upload['file_name'],
                                'berkas_id' => $id
                            );
                            $this->m_pegawai_cuti_online->save_file($data_file);
                        } else {
                            $this->session->set_flashdata('message', alert_show('danger', "Upload File Gagal"));
                            redirect('cuti/Pengajuan/update/'.$row->pegawaicuti_no_permohonan);
                        }
                    }
                }

            $this->session->set_flashdata('message', "success");
        } else {
            $this->session->set_flashdata('message', "fail");
        }
        redirect('cuti/Pengajuan');
    }
        else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect('cuti/Pengajuan');
        }
    }
    
    public function delete($id)
    {
        $row = $this->m_pegawai_cuti_online->get_by_no($id);
        
        $session = $this->session->userdata('login');
        if($row[0]['pegawaicuti_pegawai_nip'] == $session['nip']) {
            $simpan = $this->m_pegawai_cuti_online->delete_by_no($id);
            if (!empty($simpan)) {
                    $this->session->set_flashdata('message', alert_show('success', "Berhasil Terhapus"));
            } else {
                    $this->session->set_flashdata('message', alert_show('danger', "Gagal Terhapus"));
            }
            redirect('cuti/Pengajuan');
        }else{
            redirect('cuti/Pengajuan');
        }
    }
}