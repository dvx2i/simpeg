<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('m_pegawai_rekap_pendidikan');
        $this->load->model('m_pegawai_rekap_golru');
        $this->load->model('m_pegawai_rekap_jk');
        $this->load->model('m_bagan_struktur');
        $this->load->model('ref_unit');
        $this->load->model('m_home');
    }


    function index()
    {
        $this->load->helper('text');
        date_default_timezone_set('Asia/Jakarta');

        $tahun = $this->m_pegawai_rekap_jk->get_tahun()->result_array();
        $data['tahun'] = $tahun[0]['tahun'];
        $bulan = $this->m_pegawai_rekap_jk->get_bulan($data['tahun'])->result_array();
        $data['bulan'] = $bulan[0]['bulan'];
        $data['unit']  = '';
        $data['jenis']  = '1'; //perbandingan as default
        $data['periode']  = 'bulan';
        $data['tahun2']  = '';
        $data['bulan2']  = '';
        $data['pendidikan']  = '';
        $data['golru']  = '';
        $data['rekap_pendidikan'] = $this->m_pegawai_rekap_pendidikan->get_rekap_pendidikan_perbandingan($data['tahun'], $data['bulan'], $data['unit'], $data['periode']);
        $data['rekap_golru'] = $this->m_pegawai_rekap_golru->get_rekap_golru_perbandingan($data['tahun'], $data['bulan'], $data['unit'], $data['periode']);
        $data['rekap_jk'] = $this->m_pegawai_rekap_jk->get_rekap_jk_perbandingan($data['tahun'], $data['bulan'], $data['unit'], $data['periode']);

        $data['unit_bagan'] = $this->ref_unit->get_unit_bagan();
        $where['pegawai_unit_id'] = ($this->input->post('pegawai_unit_id')) ? $this->input->post('pegawai_unit_id') : '2';
        $data['where'] = $where;
        $data['unit_select'] = $this->ref_unit->get_row($where['pegawai_unit_id']);
        $data['bagan'] = $this->m_bagan_struktur->get_bagan_pegawai_by_unit($where['pegawai_unit_id']);
        // $data['result'] = $this->m_laporan->get_daftar_urut_kepangkatan($where['pegawai_unit_id']);
        $data['level'] = $this->m_bagan_struktur->get_level_by_unit($where['pegawai_unit_id']);

        $visitor = $this->visitor();
        $data['pengunjunghariini'] = $visitor['pengunjunghariini'];
        $data['totalpengunjung'] = $visitor['totalpengunjung'];
        $data['pengunjungonline'] = $visitor['pengunjungonline'];
        
        $ip    = $this->input->ip_address(); // Mendapatkan IP user
        $data['sudah_polling'] = $this->m_home->cek_sudah_polling($ip);
        
        $data['polling'] = $this->m_home->polling();

        $data["content"] = $this->load->view('publik/home', $data, TRUE);
        $this->load->view('publik/template', $data);
    }

    function polling()
    {
        $datapolling['index_kepuasan'] = $this->input->post('polling');
        $datapolling['time'] = date('Y-m-d h:i:s');
        $datapolling['ip']      = $this->input->ip_address();

        $datakritik['nama']    = $this->input->post('nama');
        $datakritik['isi']  = preg_replace('/[^\p{L}\p{N}\s]/u', '', $this->input->post('kritik'));
    
        $datakritik['ip']      = $this->input->ip_address();
        $datakritik['time'] = date('Y-m-d h:i:s');

        if($datakritik['isi'] != ''){
            $this->m_home->insert_kritik($datakritik);
        }else{
            $this->m_home->insert_polling($datapolling);
        }
        
        $this->session->set_flashdata('message', 'Polling / Kritik & Saran Berhasil Disimpan');
        redirect(site_url('Home'));
    }


    function statistik()
    {


        $this->load->helper('text');
        $this->load->helper('url');
        date_default_timezone_set('Asia/Jakarta');

        $logoheader         = $this->m_site->getConfig('WHERE title = "Header"')->result_array()[0]['content'];
        $description          = $this->m_site->getConfig('WHERE title = "Description"')->result_array()[0]['content'];
        $keyword            = $this->m_site->getConfig('WHERE title = "Keyword"')->result_array()[0]['content'];
        $footer             = $this->m_site->getConfig('WHERE title = "Footer"')->result_array()[0]['content'];
        $about             = $this->m_site->getConfig('WHERE title = "About"')->result_array()[0]['content'];
        $map             = $this->m_site->getConfig('WHERE title = "Map"')->result_array()[0]['content'];
        $map             = $this->m_site->getConfig('WHERE title = "Map"')->result_array()[0]['content'];


        $popularcount            = $this->m_site->getConfig('WHERE title = "Popular"')->result_array()[0]['content'];
        $popular             = $this->db->query('SELECT artikel.* , artikelkategori.kategorislug as slugkategori, artikelkategori.name AS kategori, rsslist.name as sumber, rsslist.domain as domain FROM artikel JOIN artikelkategori ON artikel.id_artikelkategori = artikelkategori.id_artikelkategori LEFT JOIN rsslist ON artikel.id_rsslist = rsslist.id_rsslist WHERE artikel.status="1" order by artikel.hitcounter desc, pubdate desc limit 0,' . $popularcount)->result_array();
        $newest             = $this->db->query('SELECT artikel.* , artikelkategori.kategorislug as slugkategori, artikelkategori.name AS kategori, rsslist.name as sumber, rsslist.domain as domain FROM artikel JOIN artikelkategori ON artikel.id_artikelkategori = artikelkategori.id_artikelkategori JOIN rsslist ON artikel.id_rsslist = rsslist.id_rsslist WHERE artikel.status="1" order by artikel.pinned desc, artikel.pubdate desc limit 0,3')->result_array();
        $mostcomment             = $this->db->query('SELECT artikel.* , artikelkategori.kategorislug as slugkategori, artikelkategori.name AS kategori, rsslist.name as sumber, rsslist.domain as domain FROM artikel JOIN artikelkategori ON artikel.id_artikelkategori = artikelkategori.id_artikelkategori LEFT JOIN rsslist ON artikel.id_rsslist = rsslist.id_rsslist WHERE artikel.status="1" order by artikel.commentcounter desc, artikel.pubdate desc limit 0,' . $popularcount)->result_array();


        $category             = $this->db->query('select * from artikelkategori where status = 1')->result_array();
        $tagging            = $this->db->query('select * from tagging')->result_array();
        $berita_baru        = $this->db->query('select a.*, k.name as category from artikel a, artikelkategori k where a.id_artikelkategori=k.id_artikelkategori and k.id_artikelkategori= "1" order by rand() limit 4')->result_array();
        $widget             = $this->db->query('select * from widgets WHERE active = "1" order by ordering asc')->result();

        $sum_kategori    = $this->db->query('select k.name, count(a.id) as jumlah from artikel a, artikelkategori k where a.id_artikelkategori=k.id_artikelkategori and a.status = 1 group by a.id_artikelkategori order by k.name')->result_array();

        $sum_opd    = $this->db->query('select k.name, count(a.id) as jumlah from artikel a, rsslist r, rsslistkategori k where a.id_rsslist=r.id_rsslist and r.id_rsslistkategori=k.id_rsslistkategori and a.status = 1 group by a.id_rsslist order by k.name')->result_array();

        $sum_subdomain    = $this->db->query('select r.name, count(a.id) as jumlah from artikel a, rsslist r where a.id_rsslist=r.id_rsslist and a.status = 1 group by a.id_rsslist order by r.name')->result_array();

        $sum_kontenwarga    = $this->db->query('select k.name, count(p.id_citizen_post) as jumlah from citizen_post p, citizen_postkategori k where p.id_citizen_postkategori=k.id_citizen_postkategori and p.status = 1 group by p.id_citizen_postkategori order by k.name')->result_array();

        $sum_iklanwarga    = $this->db->query('select k.name, count(i.id_citizen_iklan) as jumlah from citizen_iklan i, citizen_iklankategori k where i.id_citizen_iklankategori=k.id_citizen_iklankategori and i.status = 1 group by i.id_citizen_iklankategori order by k.name')->result_array();

        $sum_forumwarga    = $this->db->query('select k.name, count(f.id_citizen_forum) as jumlah from citizen_forum f, citizen_forumtopik k where f.id_citizen_forumtopik=k.id_citizen_forumtopik and f.status = 1 group by f.id_citizen_forumtopik order by k.name')->result_array();

        $data    =     array(
            'title'            => 'Statistik Web',
            'description'    => $description,
            'keyword'        => $keyword,
            'about'         => $about,
            'map'           => $map,
            'footer'        => $footer,
            'menu'            => $this->m_site->GetParentMenu()->result(),
            'uri1'            => $this->uri->segment(2),
            'uri2'            => $this->uri->segment(3),
            'newest'        => $newest,
            'popular'       => $popular,
            'mostcomment'        => $mostcomment,

            'menu2'            => $this->m_site->GetParentMenu2()->result(),
            'tag'            => $tagging,
            'listcategory'   => $category,
            'widget'        => $widget,

            'sum_kategori'  => $sum_kategori,
            'sum_opd'  => $sum_opd,
            'sum_subdomain'  => $sum_subdomain,

            'sum_kontenwarga'   => $sum_kontenwarga,
            'sum_iklanwarga'    => $sum_iklanwarga,
            'sum_forumwarga'    => $sum_forumwarga

        );
        $this->load->view('home/head', $data);
        $this->load->view('home/statistik');
        $this->load->view('home/footer');
    }

    function mostcommented($offset = 0)
    {

        $this->load->helper('text');

        $logoheader         = $this->m_site->getConfig('WHERE title = "Header"')->result_array()[0]['content'];
        $description          = $this->m_site->getConfig('WHERE title = "Description"')->result_array()[0]['content'];
        $keyword            = $this->m_site->getConfig('WHERE title = "Keyword"')->result_array()[0]['content'];
        $footer             = $this->m_site->getConfig('WHERE title = "Footer"')->result_array()[0]['content'];
        $about             = $this->m_site->getConfig('WHERE title = "About"')->result_array()[0]['content'];
        $map             = $this->m_site->getConfig('WHERE title = "Map"')->result_array()[0]['content'];
        $popularcount            = $this->m_site->getConfig('WHERE title = "Popular"')->result_array()[0]['content'];
        $popular             = $this->db->query('SELECT artikel.* , artikelkategori.kategorislug as slugkategori, artikelkategori.name AS kategori, rsslist.name as sumber, rsslist.domain as domain FROM artikel JOIN artikelkategori ON artikel.id_artikelkategori = artikelkategori.id_artikelkategori LEFT JOIN rsslist ON artikel.id_rsslist = rsslist.id_rsslist WHERE artikel.status="1" order by artikel.hitcounter desc, pubdate desc limit 0,' . $popularcount)->result_array();
        $newest             = $this->db->query('SELECT artikel.* , artikelkategori.kategorislug as slugkategori, artikelkategori.name AS kategori, rsslist.name as sumber, rsslist.domain as domain FROM artikel JOIN artikelkategori ON artikel.id_artikelkategori = artikelkategori.id_artikelkategori JOIN rsslist ON artikel.id_rsslist = rsslist.id_rsslist WHERE artikel.status="1" order by artikel.pinned desc, artikel.pubdate desc limit 0,3')->result_array();
        $mostcomment             = $this->db->query('SELECT artikel.* , artikelkategori.kategorislug as slugkategori, artikelkategori.name AS kategori, rsslist.name as sumber, rsslist.domain as domain FROM artikel JOIN artikelkategori ON artikel.id_artikelkategori = artikelkategori.id_artikelkategori LEFT JOIN rsslist ON artikel.id_rsslist = rsslist.id_rsslist WHERE artikel.status="1" order by artikel.commentcounter desc, artikel.pubdate desc limit 0,' . $popularcount)->result_array();


        $category             = $this->db->query('select * from artikelkategori where status = 1')->result_array();
        $tagging            = $this->db->query('select * from tagging')->result_array();
        $widget             = $this->db->query('select * from widgets WHERE active = "1" order by ordering asc')->result();
        $kategoripostwarga     = $this->db->query('select * from citizen_postkategori where status = 1')->result_array();

        $data['base']             = $this->config->item('base_url');
        $data['title']             = 'Paling Banyak Di Komentari';

        $this->load->model('m_site');
        $total                     = $this->m_site->artikel_count();
        $per_pg = 20;
        $offset = $this->uri->segment(3);
        $this->load->library('pagination');

        $config['base_url']            = $data['base'] . 'pages/mostcommented/';
        $config['total_rows']        = $total;
        $config['per_page']            = $per_pg;
        $config['full_tag_open'] = '<div><ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul></div>';

        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="next page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li class="prev page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><a class="page-link" href="">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $data = array(
            'title'            => "Paling Dikomentari",
            'logoheader'    => $logoheader,
            'description'    => $description,
            'keyword'        => $keyword,
            'footer'        => $footer,
            'about'         => $about,
            'map'           => $map,
            'newest'        => $newest,
            'popular'       => $popular,
            'mostcomment'        => $mostcomment,

            'menu'            => $this->m_site->GetParentMenu()->result(),
            'menu2'            => $this->m_site->GetParentMenu2()->result(),
            'uri1'            => $this->uri->segment(2),
            'uri2'            => $this->uri->segment(3),
            'listcategory'        => $category,
            'kat_postwarga' => $kategoripostwarga,
            'tag'       => $tagging,
            'widget'    => $widget,
            'pagination' => $this->pagination->create_links(),
            'kueri'     => $this->m_site->get_popular($per_pg, $offset),

        );


        $this->load->view('home/head', $data);
        $this->load->view('home/mostcommented');
        $this->load->view('home/footer');
    }


    function pegawai_detail()
    {
        $this->load->model(array('ref_jabatan_fungsional', 'ref_agama', 'ref_eselon', 'ref_jabatan_struktural', 'ref_pendidikan_tingkat', 'ref_pangkat_golongan', 'ref_jabatan_kedudukan', 'ref_status_kepegawaian', 'm_pegawai', 'ref_unit', 'ref_jenis_kelamin', 'ref_golongan_darah', 'ref_agama', 'ref_status_perkawinan'));

        $key = explode("-", $this->input->post('nip'));
        if (!isset($key[1])) {
            $key[1] = '';
        }
        $nip = $key[0];
        $data['pilihan_tampil'] = 'detail';
        $data['pegawai'] = $this->m_home->get_pegawai_detail($key[0], $key[1]);
        if (blank($data['pegawai'])) {
            echo '
            <div class="col-lg-12 error-page">
              <h2 class="headline text-yellow"> </h2>
      
              <div class="error-content">
                <h3><i class="fa fa-warning text-yellow"></i> Oops! Pegawai tidak ditemukan.</h3>
      
      
                
              </div>
              <!-- /.error-content -->
            </div>';
        } else {
            $this->load->model(array('m_pegawai_pangkat', 'm_pegawai_jabatan', 'm_pegawai_kgb', 'm_pegawai_pendidikan', 'm_pegawai_diklat', 'm_pegawai_tanda_jasa', 'm_pegawai_kunjungan', 'm_pegawai_organisasi', 'm_pegawai_pengalaman_kerja', 'm_pegawai_bahasa', 'm_pegawai_tugas_belajar', 'm_pegawai_disiplin', 'm_pegawai_karya_tulis', 'm_pegawai_keluarga', 'm_pegawai_kunjungan'));
            $data['pegawai_pangkat'] = $this->m_pegawai_pangkat->get_where(array('pegawaipangkat_pegawai_nip' => $nip));
            $data['pegawai_jabatan'] = $this->m_pegawai_jabatan->get_where(array('pegawaijabatan_pegawai_nip' => $nip));
            $data['pegawai_pendidikan'] = $this->m_pegawai_pendidikan->get_where(array('pegawaipendidikan_pegawai_nip' => $nip));
            $data['pegawai_diklat_penjenjangan'] = $this->m_pegawai_diklat->get_where(array('diklat_jenis' => 'STRUKTURAL', 'diklat_pegawai_nip' => $nip));
            $data['pegawai_diklat_fungsional'] = $this->m_pegawai_diklat->get_where(array('diklat_jenis' => 'FUNGSIONAL', 'diklat_pegawai_nip' => $nip));
            $data['riwayat_diklat_teknis'] = $this->m_pegawai_diklat->get_where(array('diklat_jenis' => 'TEKNIS', 'diklat_pegawai_nip' => $nip));
            $data['riwayat_diklat_penataran'] = $this->m_pegawai_diklat->get_where(array('diklat_jenis' => 'PENATARAN', 'diklat_pegawai_nip' => $nip));
            $data['riwayat_diklat_seminar'] = $this->m_pegawai_diklat->get_where(array('diklat_jenis' => 'SEMINAR', 'diklat_pegawai_nip' => $nip));
            $data['riwayat_diklat_kursus'] = $this->m_pegawai_diklat->get_where(array('diklat_jenis' => 'KURSUS', 'diklat_pegawai_nip' => $nip));
            $data['riwayat_penghargaan'] = $this->m_pegawai_tanda_jasa->get_where(array('pegawaijasa_pegawai_nip' => $nip));
            $data['riwayat_penugasan'] = $this->m_pegawai_kunjungan->get_where(array('pegawaitugas_pegawai_nip' => $nip));
            $data['riwayat_organisasi'] = $this->m_pegawai_organisasi->get_where(array('pegawaiorg_pegawai_nip' => $nip));
            $data['riwayat_pengalaman_kerja'] = $this->m_pegawai_pengalaman_kerja->get_where(array('pegawaikerja_pegawai_nip' => $nip));
            $data['riwayat_penguasaan_bahasa'] = $this->m_pegawai_bahasa->get_where(array('pegawaibahasa_pegawai_nip' => $nip));
            $data['riwayat_tugas_belajar'] = $this->m_pegawai_tugas_belajar->get_where(array('tugasbelajar_pegawai_nip' => $nip));
            $data['riwayat_hukuman'] = $this->m_pegawai_disiplin->get_where(array('pegawaidisiplin_pegawai_nip' => $nip));
            $data['keluarga'] = $this->m_pegawai_keluarga->get_where(array('pegawaikeluarga_pegawai_nip' => $nip));
            $data['kgb_terakhir'] = $this->m_pegawai_kgb->get_kgb_terakhir($nip)->row();
            $data['jabatan_terakhir'] = $this->m_pegawai_jabatan->get_jabatan_terakhir($nip);
            $data['pendidikan_terakhir'] = $this->m_pegawai_pendidikan->get_pendidikan_terakhir($nip);
            $data['diklat_terakhir'] = $this->m_pegawai_diklat->get_diklat_struktural_terakhir($nip)->row();
            $this->load->view('publik/pegawai_detail', $data);
        }
    }

    function visitor()
    {
        $ip    = $this->input->ip_address(); // Mendapatkan IP user
        $date  = date("Y-m-d"); // Mendapatkan tanggal sekarang
        $waktu = time(); //
        $timeinsert = date("Y-m-d H:i:s");

        // Cek berdasarkan IP, apakah user sudah pernah mengakses hari ini
        $s = $this->db->query("SELECT * FROM sys_visitor WHERE ip='" . $ip . "' AND date='" . $date . "'")->num_rows();
        $ss = isset($s) ? ($s) : 0;


        // Kalau belum ada, simpan data user tersebut ke database
        if ($ss == 0) {
            $this->db->query("INSERT INTO sys_visitor (ip, date, hits, online, time) VALUES('" . $ip . "','" . $date . "','1','" . $waktu . "','" . $timeinsert . "')");
        }

        // Jika sudah ada, update
        else {
            $this->db->query("UPDATE sys_visitor SET hits=hits+1, online='" . $waktu . "' WHERE ip='" . $ip . "' AND date='" . $date . "'");
        }


        $pengunjunghariini  = $this->db->query("SELECT * FROM sys_visitor WHERE date='" . $date . "' GROUP BY ip")->num_rows(); // Hitung jumlah pengunjung

        $dbpengunjung = $this->db->query("SELECT COUNT(hits) as hits FROM sys_visitor")->row();

        $totalpengunjung = isset($dbpengunjung->hits) ? ($dbpengunjung->hits) : 0; // hitung total pengunjung

        $bataswaktu = time() - 300;

        $pengunjungonline  = $this->db->query("SELECT * FROM sys_visitor WHERE online > '" . $bataswaktu . "'")->num_rows(); // hitung pengunjung online


        $data['pengunjunghariini'] = $pengunjunghariini;
        $data['totalpengunjung'] = $totalpengunjung;
        $data['pengunjungonline'] = $pengunjungonline;

        return $data;
    }

	function test__()
    {
    $nomor = '6282258611297';
            $message= 'Selamat Kenaikan Gaji Berkala anda sudah diproses aplikasi SIPEDAS, berikut adalah Surat Keterangan Kenaikan Gaji Berkala Anda. Terimakasih.'; 
            $filename = "SURAT-IZIN-CUTI-198510012009022008-20220726001.pdf";
    	$curl = curl_init();
                $this->send_wa($curl, no_hp($nomor), $message); 
            	$this->send_media($curl, no_hp($nomor), $message, $filename);  
            	curl_close($curl);
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
  			CURLOPT_POSTFIELDS =>'{
    				"number" : '.$number.',
    				"message": "'.$message.'"
			}',
  			CURLOPT_HTTPHEADER => array(
    			'Content-Type: application/json'
  			),
		));

		$response = curl_exec($curl);

    }

    private function send_media($curl, $number, $message, $file)
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
}
