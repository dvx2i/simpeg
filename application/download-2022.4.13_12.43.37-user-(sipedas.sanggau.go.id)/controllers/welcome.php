<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller {

    function __construct(){
        parent::__construct();

        $this->load->model('m_pegawai');
    }


    function index()
    {
        $this->load->helper('text');
        date_default_timezone_set('Asia/Jakarta');
        $data['jml_struktural'] = $this->m_pegawai->get_count(array('pegawai_jenisjabatan_kode' => '1','pegawai_status' => '1'));
        $data['jml_jft'] = $this->m_pegawai->get_count(array('pegawai_jenisjabatan_kode' => '2','pegawai_status' => '1'));
        $data['jml_jfu'] = $this->m_pegawai->get_count(array('pegawai_jenisjabatan_kode' => '4','pegawai_status' => '1'));
        $data['jml_naban'] = $this->m_pegawai->get_count("pegawai_jenisjabatan_kode not in (1,2,4) and pegawai_status = '1'");
        $this->loadView('home',$data);
    }

    

    function statistik(){
       

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
            $popular             = $this->db->query('SELECT artikel.* , artikelkategori.kategorislug as slugkategori, artikelkategori.name AS kategori, rsslist.name as sumber, rsslist.domain as domain FROM artikel JOIN artikelkategori ON artikel.id_artikelkategori = artikelkategori.id_artikelkategori LEFT JOIN rsslist ON artikel.id_rsslist = rsslist.id_rsslist WHERE artikel.status="1" order by artikel.hitcounter desc, pubdate desc limit 0,'.$popularcount)->result_array();
            $newest             = $this->db->query('SELECT artikel.* , artikelkategori.kategorislug as slugkategori, artikelkategori.name AS kategori, rsslist.name as sumber, rsslist.domain as domain FROM artikel JOIN artikelkategori ON artikel.id_artikelkategori = artikelkategori.id_artikelkategori JOIN rsslist ON artikel.id_rsslist = rsslist.id_rsslist WHERE artikel.status="1" order by artikel.pinned desc, artikel.pubdate desc limit 0,3')->result_array();
            $mostcomment             = $this->db->query('SELECT artikel.* , artikelkategori.kategorislug as slugkategori, artikelkategori.name AS kategori, rsslist.name as sumber, rsslist.domain as domain FROM artikel JOIN artikelkategori ON artikel.id_artikelkategori = artikelkategori.id_artikelkategori LEFT JOIN rsslist ON artikel.id_rsslist = rsslist.id_rsslist WHERE artikel.status="1" order by artikel.commentcounter desc, artikel.pubdate desc limit 0,'.$popularcount)->result_array();
    
    
            $category 			= $this->db->query('select * from artikelkategori where status = 1')->result_array();
            $tagging            = $this->db->query('select * from tagging')->result_array();
            $berita_baru		= $this->db->query('select a.*, k.name as category from artikel a, artikelkategori k where a.id_artikelkategori=k.id_artikelkategori and k.id_artikelkategori= "1" order by rand() limit 4')->result_array();
            $widget             = $this->db->query('select * from widgets WHERE active = "1" order by ordering asc')->result();
    
            $sum_kategori    = $this->db->query('select k.name, count(a.id) as jumlah from artikel a, artikelkategori k where a.id_artikelkategori=k.id_artikelkategori and a.status = 1 group by a.id_artikelkategori order by k.name')->result_array();

            $sum_opd    = $this->db->query('select k.name, count(a.id) as jumlah from artikel a, rsslist r, rsslistkategori k where a.id_rsslist=r.id_rsslist and r.id_rsslistkategori=k.id_rsslistkategori and a.status = 1 group by a.id_rsslist order by k.name')->result_array();

            $sum_subdomain    = $this->db->query('select r.name, count(a.id) as jumlah from artikel a, rsslist r where a.id_rsslist=r.id_rsslist and a.status = 1 group by a.id_rsslist order by r.name')->result_array();

            $sum_kontenwarga    = $this->db->query('select k.name, count(p.id_citizen_post) as jumlah from citizen_post p, citizen_postkategori k where p.id_citizen_postkategori=k.id_citizen_postkategori and p.status = 1 group by p.id_citizen_postkategori order by k.name')->result_array();

            $sum_iklanwarga    = $this->db->query('select k.name, count(i.id_citizen_iklan) as jumlah from citizen_iklan i, citizen_iklankategori k where i.id_citizen_iklankategori=k.id_citizen_iklankategori and i.status = 1 group by i.id_citizen_iklankategori order by k.name')->result_array();

            $sum_forumwarga    = $this->db->query('select k.name, count(f.id_citizen_forum) as jumlah from citizen_forum f, citizen_forumtopik k where f.id_citizen_forumtopik=k.id_citizen_forumtopik and f.status = 1 group by f.id_citizen_forumtopik order by k.name')->result_array();

            $data	= 	array(
                'title'			=> 'Statistik Web',
                'description'	=> $description,
                'keyword'		=> $keyword,
                'about'         => $about,
                'map'           => $map,
                'footer'		=> $footer,
                'menu'			=> $this->m_site->GetParentMenu()->result(),
                'uri1'			=> $this->uri->segment(2),
                'uri2'			=> $this->uri->segment(3),
                'newest'		=> $newest,
                'popular'       => $popular,
                'mostcomment'        => $mostcomment,
    
                'menu2'			=> $this->m_site->GetParentMenu2()->result(),
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

        function mostcommented($offset = 0){

            $this->load->helper('text');
    
            $logoheader         = $this->m_site->getConfig('WHERE title = "Header"')->result_array()[0]['content'];
            $description          = $this->m_site->getConfig('WHERE title = "Description"')->result_array()[0]['content'];
            $keyword            = $this->m_site->getConfig('WHERE title = "Keyword"')->result_array()[0]['content'];
            $footer             = $this->m_site->getConfig('WHERE title = "Footer"')->result_array()[0]['content'];
            $about             = $this->m_site->getConfig('WHERE title = "About"')->result_array()[0]['content'];
            $map             = $this->m_site->getConfig('WHERE title = "Map"')->result_array()[0]['content'];
            $popularcount            = $this->m_site->getConfig('WHERE title = "Popular"')->result_array()[0]['content'];
            $popular             = $this->db->query('SELECT artikel.* , artikelkategori.kategorislug as slugkategori, artikelkategori.name AS kategori, rsslist.name as sumber, rsslist.domain as domain FROM artikel JOIN artikelkategori ON artikel.id_artikelkategori = artikelkategori.id_artikelkategori LEFT JOIN rsslist ON artikel.id_rsslist = rsslist.id_rsslist WHERE artikel.status="1" order by artikel.hitcounter desc, pubdate desc limit 0,'.$popularcount)->result_array();
            $newest             = $this->db->query('SELECT artikel.* , artikelkategori.kategorislug as slugkategori, artikelkategori.name AS kategori, rsslist.name as sumber, rsslist.domain as domain FROM artikel JOIN artikelkategori ON artikel.id_artikelkategori = artikelkategori.id_artikelkategori JOIN rsslist ON artikel.id_rsslist = rsslist.id_rsslist WHERE artikel.status="1" order by artikel.pinned desc, artikel.pubdate desc limit 0,3')->result_array();
            $mostcomment             = $this->db->query('SELECT artikel.* , artikelkategori.kategorislug as slugkategori, artikelkategori.name AS kategori, rsslist.name as sumber, rsslist.domain as domain FROM artikel JOIN artikelkategori ON artikel.id_artikelkategori = artikelkategori.id_artikelkategori LEFT JOIN rsslist ON artikel.id_rsslist = rsslist.id_rsslist WHERE artikel.status="1" order by artikel.commentcounter desc, artikel.pubdate desc limit 0,'.$popularcount)->result_array();
    
    
            $category 			= $this->db->query('select * from artikelkategori where status = 1')->result_array();
            $tagging            = $this->db->query('select * from tagging')->result_array();
            $widget             = $this->db->query('select * from widgets WHERE active = "1" order by ordering asc')->result();
            $kategoripostwarga 	= $this->db->query('select * from citizen_postkategori where status = 1')->result_array();
    
            $data['base'] 			= $this->config->item('base_url');
            $data['title'] 			= 'Paling Banyak Di Komentari';
    
            $this->load->model('m_site');
            $total 					= $this->m_site->artikel_count();
            $per_pg = 20;
            $offset = $this->uri->segment(3);
            $this->load->library('pagination');
    
            $config['base_url']			= $data['base'].'pages/mostcommented/';
            $config['total_rows']		= $total;
            $config['per_page']			= $per_pg;
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
                'title'			=> "Paling Dikomentari",
                'logoheader'    => $logoheader,
                'description'	=> $description,
                'keyword'		=> $keyword,
                'footer'		=> $footer,
                'about'         => $about,
                'map'           => $map,
                'newest'        => $newest,
                'popular'       => $popular,
                'mostcomment'        => $mostcomment,
    
                'menu'			=> $this->m_site->GetParentMenu()->result(),
                'menu2'			=> $this->m_site->GetParentMenu2()->result(),
                'uri1'			=> $this->uri->segment(2),
                'uri2'			=> $this->uri->segment(3),
                'listcategory'		=> $category,
                'kat_postwarga' => $kategoripostwarga,
                'tag'       => $tagging,
                'widget'    => $widget,
                'pagination' =>$this->pagination->create_links(),
                'kueri'     => $this->m_site->get_popular($per_pg, $offset),
    
            );
    
    
            $this->load->view('home/head', $data);
            $this->load->view('home/mostcommented');
            $this->load->view('home/footer');
        }
        
    

}



