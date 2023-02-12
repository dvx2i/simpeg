<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ReferensiJson
 *
 * @author Zanuar 
 */
class ReferensiJson extends CI_Controller
{

    public function listKabupatenByIdPropinsi($id = NULL)
    {
        $this->load->model('ref_kabupaten');
        $kabupaten = $this->ref_kabupaten->get_where(array('kabupaten_propinsi_id' => $id));
        $string = '<option value="">-- Pilih --</option>';
        if (!empty($kabupaten)) {
            foreach ($kabupaten->result() as $pok) {
                $string .= '<option value="' . $pok->kabupaten_id . '">' . $pok->kabupaten_nama . '</option>';
            }
        }
        echo $string;
        exit;
    }

    public function listKecamatanByIdKabupaten($id = NULL)
    {
        $this->load->model('ref_kecamatan');
        $kecamatan = $this->ref_kecamatan->get_where(array('kecamatan_kabupaten_id' => $id));
        $string = '<option value="">-- Pilih --</option>';
        if (!empty($kecamatan)) {
            foreach ($kecamatan->result() as $pok) {
                $string .= '<option value="' . $pok->kecamatan_id . '">' . $pok->kecamatan_nama . '</option>';
            }
        }
        echo $string;
        exit;
    }

    public function tableKecamatanByIdKabupaten($id = NULL)
    {
        $data['kecamatan'] = $this->m_referensi->getKecamatanByIdKabupaten($id);
        $get = $this->load->view('referensi/kecamatan_table', $data);
        return $get;
    }

    function tableKelurahanByIdKecamatan($id = NULL)
    {
        $data['kelurahan'] = $this->m_referensi->getKelurahanByIdKecamatan($id);
        $get = $this->load->view('referensi/kelurahan_table', $data);
        return $get;
    }

    public function listKelurahanByIdKecamatan($id = NULL)
    {
        $this->load->model('ref_kelurahan');
        $kecamatan = $this->ref_kelurahan->get_where(array('kelurahan_kecamatan_id' => $id));
        $string = '<option value="">-- Pilih --</option>';
        if (!empty($kecamatan)) {
            foreach ($kecamatan->result() as $pok) {
                $string .= '<option value="' . $pok->kelurahan_id . '">' . $pok->kelurahan_nama . '</option>';
            }
        }
        echo $string;
        exit;
    }



    public function listSubUnitByIdUnit($id)
    {
        $aktif = $this->input->post('aktif');
        $sub_unit = $this->m_system->getSubUnitByIdUnit($id, $aktif);
        $string = '<option value="">-- Pilih --</option>';
        if (!empty($sub_unit)) {
            foreach ($sub_unit->result() as $value) {
                if ($value->pokja_status == '1') {
                    if (blank($aktif)) {
                        $string .= '<option value="' . $value->pokja_id . '|' . $value->hirarki_baru . '">[' . $value->pokja_hirarki . '] ' . $value->pokja_name . '</option>';
                    } else {
                        $string .= '<option value="' . $value->pokja_id . '"> ' . $value->pokja_name . '</option>';
                    }
                } else {
                    $string .= '<option class="text-danger" value="' . $value->pokja_id . '|' . $value->hirarki_baru . '">[TIDAK AKTIF] ' . $value->pokja_name . '</option>';
                }
            }
        }
        echo $string;
        exit;
    }

    public function getJumlahGajiByPangkatMasaKerja()
    {
        $this->load->model('ref_gaji');
        $pangkat = $this->input->post('pangkat');
        $masa = $this->input->post('masa') != '' ? $this->input->post('masa') : 0;
        $output = $this->ref_gaji->getGajiByPangkatMasaKerja($pangkat, $masa);
        // jsonResponse($output['gaji_jumlah']);
        echo $output['gaji_jumlah'];
    }

    public function getJenisKedudukanByJabatan($id)
    {
        $get = $this->db->query("SELECT 	jeniskedudukan_id AS id, 
	jeniskedudukan_nama AS nama
	FROM ref_jenis_kedudukan
	WHERE jeniskedudukan_kode = LEFT((SELECT k.kedudukanjabatan_kode FROM ref_jenis_kedudukan_jabatan k WHERE k.kedudukanjabatan_id = '$id'),2)");
        $this->output->set_content_type('application/json')
            ->set_output(json_encode($get->row()));
    }

    public function getMasaKerja($nip)
    {
        $get = $this->db->query("SELECT TIMESTAMPDIFF(YEAR, DATE(a.`pegawai_cpns_tmt`),DATE(CURRENT_DATE())) AS masa_kerja
	FROM pegawai a
	WHERE pegawai_nip = '$nip'")->row();
    
    echo $get->masa_kerja;
    }

    public function getPegawai($nip)
    {
        $get = $this->db->query("SELECT *
                FROM pegawai a
                WHERE pegawai_nip = '$nip'")->row();
    
    echo json_encode(array(
            'success' => true,
            'message'   => 'Data Pegawai',
            'pegawai' => $get,
        ));
    }

    function listJabatanByKedudukanId()
    {
        $id = $this->input->post('id');
        $unit_id = $this->input->post('unit_id');
        $jabatan = NULL;
        if ($id == '1') {
            $this->load->model('ref_jabatan_struktural');
            $jabatan = $this->ref_jabatan_struktural->get_where(array('jabatan_unit_kode' => $unit_id));
        }
        if ($id == '2') {
            $this->load->model('ref_jabatan_fungsional');
            $jabatan = $this->ref_jabatan_fungsional->get_all();
        }
        if ($id == '4') {
            $this->load->model('ref_jabatan_baru');
            $jabatan = $this->ref_jabatan_baru->get_all();
        }
        $string = '<option value="">-- Pilih --</option>';
        if (!empty($jabatan)) {
            foreach ($jabatan->result() as $value) {
                $eselon = '';
                if ($id == '1') {
                    $eselon = ' (Eselon: ' . $value->jabatan_eselon_nama . ')';
                }
                $string .= '<option value="' . $value->jabatan_id . '">' . $value->jabatan_nama . $eselon . '</option>';
            }
        }
        echo $string;
        exit;
    }

    function listPendidikanByTingkat()
    {
        $this->load->model('ref_pendidikan');
        $id = $this->input->post('id');
        $pendidikan = $this->ref_pendidikan->get_where(array('pendidikan_tingkat_id' => $id));
        $string = '<option value="">-- Pilih --</option>';
        if (!empty($pendidikan)) {
            foreach ($pendidikan->result() as $pok) {
                $string .= '<option value="' . $pok->pendidikan_id . '">' . $pok->pendidikan_nama . '</option>';
            }
        }
        echo $string;
        exit;
    }

    function listSubUnitByUnit()
    {
        $this->load->model('ref_unit');
        $id = $this->input->post('id');
        $select = $this->input->post('select');
        $pendidikan = $this->ref_unit->get_sub_unit(array('unit_parent_id' => $id));
        $string = '<option value="">-- Pilih --</option>';
        if (!empty($pendidikan)) {
            foreach ($pendidikan->result() as $pok) {
                $selected = $select == $pok->unit_id ? 'selected' : '';
                $string .= '<option ' . $selected . ' value="' . $pok->unit_id . '">' . $pok->unit_nama . '</option>';
            }
        }
        echo $string;
        exit;
    }


    public function listPegawaiByJabatan($id = NULL)
    {
        $this->load->model('m_pegawai');
        $pegawai = $this->m_pegawai->get_where(array('pegawai_jabatan_id' => $id, 'pegawai_status' => '1'));
        $string = '<option value="">-- Pilih --</option>';
        if (!empty($pegawai)) {
            foreach ($pegawai->result() as $pok) {
                $string .= '<option value="' . $pok->pegawai_nip . '">' . $pok->pegawai_nama . '</option>';
            }
        }
        echo $string;
        exit;
    }
}
