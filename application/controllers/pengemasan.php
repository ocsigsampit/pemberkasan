<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Pengemasan extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('model_pengemasan');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('file');
		$this->load->helper('fungsi_budi');
		$this->load->library('pdf');

	}

	public function index(){
		if($this->session->userdata('status_login')=="ON"){
			$data['menunye']          = $this->model_pengemasan->m_daftar_menu();
			$data['jml_pengemasan']   = $this->model_pengemasan->m_jumlah_pengemasan();
			$data['jml_register']     = $this->model_pengemasan->m_jumlah_register();
			$data['jml_pengembalian'] = $this->model_pengemasan->m_jumlah_pengembalian();
			$data['jml_no_lpad']      = $this->model_pengemasan->m_jumlah_no_lpad();
			$data['daftar_spt']       = $this->model_pengemasan->m_daftar_spt();
			$data['grafik_semua']     = $this->model_pengemasan->m_jml_spt_by_month_all();
			$this->load->library('template');
			$this->template->view('pengemasan/v_semua',$data);
		}else{
			redirect('auth');
		}
	}
	
	public function tampilkan_data(){
		$jenis = $this->input->get("jenis_data");
		
		if($jenis == "pengemasan"){
			$datanya = $this->model_pengemasan->m_daftar_pengemasan();
		}elseif($jenis == "register"){
			$datanya = $this->model_pengemasan->m_daftar_register();
		}elseif($jenis == "pengembalian"){
			$datanya = $this->model_pengemasan->m_daftar_pengembalian();
		}
		
		print json_encode($datanya);
	}
		
	public function tambah_pengemasan(){
		if($this->session->userdata('status_login')=="ON"){
			$data['menunye']    = $this->model_pengemasan->m_daftar_menu();
			$data['daftar_spt'] = $this->model_pengemasan->m_daftar_spt();
			$data['jenis_data'] = "pengemasan";
			$this->load->library('template');
			$this->template->view('pengemasan/v_tambah_pengemasan',$data);
		}else{
			redirect('auth');
		}
	}
	
	public function simpan_pengemasan(){
		date_default_timezone_set("Asia/Jakarta");

		$x = $this->model_pengemasan->m_id_kemas();
				
		$data = array(
			"id_pengemasan" => $x,	
			"id_spt" 		=> $this->input->post("id_spt"),	
			"bc_kemasan" 	=> strtoupper($this->input->post("bc_kemasan")),	
			"segel_kemasan" => $this->input->post("segel_kemasan"),	
			"tgl_kemas" 	=> $this->input->post("tgl_kemas"),	
			"jml_spt" 		=> $this->input->post("jml_spt"),	
			"tgl_rekam" 	=> date("Y-m-d H:i:s")
		);
		
		$this->model_pengemasan->m_simpan_pengemasan($data);
	}
	
	public function daftar_pengemasan(){
		if($this->session->userdata('status_login')=="ON"){
			$data['menunye'] = $this->model_pengemasan->m_daftar_menu();
			$data['semua']   = $this->model_pengemasan->m_daftar_pengemasan();
			$this->load->library('template');
			$this->template->view('pengemasan/v_daftar_pengemasan',$data);
		}else{
			redirect('auth');
		}
	}
	
	public function tambah_register(){		
		if($this->session->userdata('status_login')=="ON"){
			$this->load->helper('url');
			$this->load->library('pagination');
		
			$data['menunye']        = $this->model_pengemasan->m_daftar_menu();
			$data['daftar_spt']     = $this->model_pengemasan->m_daftar_spt();
			$data['daftar_pegawai'] = $this->model_pengemasan->m_daftar_pegawai();
			$data['jenis_data']     = "register";
			$this->load->library('template');
			$this->template->view('pengemasan/v_tambah_register',$data);
		}else{
			redirect('auth');
		}
	}
	
	public function tambah_register_ang(){
		if($this->session->userdata('status_login')=="ON"){
			$data['menunye']        = $this->model_pengemasan->m_daftar_menu();
			$data['daftar_spt']     = $this->model_pengemasan->m_daftar_spt();
			$data['daftar_pegawai'] = $this->model_pengemasan->m_daftar_pegawai();
			$this->load->library('template');
			$this->template->view('pengemasan/v_tambah_register_ang',$data);
		}else{
			redirect('auth');
		}
	}
	
	public function simpan_register(){
		date_default_timezone_set("Asia/Jakarta");
		
		//Jika tanggal manual
		if($this->input->post("tgl_manual")){
			$tanggalnya       = $this->input->post("tgl_manual");
			$masukan          = $this->input->post("no_reg");
			
			if (preg_match("/^[0-9][0-9]{1,8}/", $masukan,$match)){
				$tanggal_register = substr($masukan,4,4)."-".substr($masukan,2,2)."-".substr($masukan,0,2);
				//echo "SESUAI POLA";
			}else{
				$tanggal_register = date("Y-m-d H:i:s");
				//echo "TIDAK SESUAI POLA !";
			}
		}else{
			$tanggalnya 	  = date("Y-m-d H:i:s");
			$masukan          = $this->input->post("no_reg");
			
			if (preg_match("/^[0-9][0-9]{1,8}/", $masukan,$match)){
				$tanggal_register = substr($masukan,4,4)."-".substr($masukan,2,2)."-".substr($masukan,0,2);
				//echo "SESUAI POLA";
			}else{
				$tanggal_register = date("Y-m-d H:i:s");
				//echo "TIDAK SESUAI POLA !";
			}
		}
				
		$data = array(
			"id_pegawai" 	=> $this->input->post("id_pegawai"),	
			"id_spt" 		=> $this->input->post("id_spt"),	
			"no_reg" 		=> $this->input->post("no_reg"),	
			"jml_spt" 		=> $this->input->post("jml_spt"),
			"tgl_terima" 	=> $tanggalnya,
			"tgl_reg" 	    => $tanggal_register,
			"espt"          => "0"
		);
		
		//echo "no_reg : ".$this->input->post("no_reg")." - tanggal_register : ".$tanggal_register."-----------";
		$this->model_pengemasan->m_simpan_register($data);
	}
	
	public function simpan_edit_register(){
		//print_r($_POST);
		$id    = $this->input->post("id");
		$kolom = $this->input->post("kolom");
		$nilai = $this->input->post("nilai");
	
		$this->model_pengemasan->m_simpan_edit_register($id,$kolom,$nilai);
	}
	
	public function ubahKesSPT(){
		$id    = $this->input->post("id_register");
		$this->model_pengemasan->m_ubahKesSPT($id);
	}
	
	public function simpan_register_ang(){
		date_default_timezone_set("Asia/Jakarta");
		
		$req = json_decode(file_get_contents('php://input'),TRUE);
		
		if($this->input->post("tgl_manual")){
			$tanggalnya = $this->input->post("tgl_manual");
		}else{
			$tanggalnya = date("Y-m-d H:i:s");
		}
				
		//print_r($req);
		
		$data = array(
			"id_pegawai" 	=> $req['id_pegawai'],	
			"id_spt" 		=> $req['id_spt'],	
			"no_reg" 		=> $req['no_reg'],	
			"jml_spt" 		=> $req['jml_spt'],
			"tgl_terima" 	=> $tanggalnya,
			"espt"          => "0"
		);
		
		//print_r($data);
		$this->model_pengemasan->m_simpan_register($data);
		
	}

	public function daftar_register(){
		if($this->session->userdata('status_login')=="ON"){
			$data['menunye'] = $this->model_pengemasan->m_daftar_menu();
			$data['semua']   = $this->model_pengemasan->m_daftar_register();
			$data['datanya'] = $this->model_pengemasan->m_reg_bulan_ini();
			$this->load->library('template');
			$this->template->view('pengemasan/v_daftar_register',$data);
		}else{
			redirect('auth');
		}
	}
	
	public function gra_banding_spt(){
		$JMLSPT  = array();
		
		$kode_spt = $this->input->post("kode_spt");
		$x        = $this->model_pengemasan->m_bandingkan_dua_tahun($kode_spt);
		
		foreach($x as $key=>$value){
			$JMLSPT['NOW'][]  = (int)$value->JSPTNOW;
			$JMLSPT['PAST'][] = (int)$value->JSPTPAST;
		}
		
		print json_encode($JMLSPT);
	}
	
	public function masaTahunanDi2Tahun(){
		$JMLSPT  = array();
		
		$x        = $this->model_pengemasan->m_masaTahunanDi2Tahun();
		
		foreach($x as $key=>$value){
			/*
			$JMLSPT['MASA'][]  = (int)$value->SPTMASA;
			$JMLSPT['TAHUNAN'][] = (int)$value->SPTTAHUNAN; */
			$JMLSPT['TAHUNAN'][]  = (int)$value->S2019;
			$JMLSPT['MASA'][] = (int)$value->S2018;
		}
		
		print json_encode($JMLSPT);
	}
	
	public function gra_jenis_spt(){
		$ere      = array();
		$ere2     = array();
		$kode_spt = $this->input->post("kode_spt");
		$x        = $this->model_pengemasan->m_jml_spt_by_month($kode_spt);
		
		foreach($x as $key=>$value){
			$ere2[] = (int)$value->JAN;
			$ere2[] = (int)$value->FEB;
			$ere2[] = (int)$value->MAR;
			$ere2[] = (int)$value->APR;
			$ere2[] = (int)$value->MEI;
			$ere2[] = (int)$value->JUN;
			$ere2[] = (int)$value->JUL;
			$ere2[] = (int)$value->AGT;
			$ere2[] = (int)$value->SEP;
			$ere2[] = (int)$value->OKT;
			$ere2[] = (int)$value->NOV;
			$ere2[] = (int)$value->DES;
		}
		print json_encode($ere2);
	}
	
	public function daftar_register_ang(){
		if($this->session->userdata('status_login')=="ON"){
			$semua = $this->model_pengemasan->m_daftar_register();
			print json_encode($semua);
		}else{
			redirect('auth');
		}
	}
	
	public function rekap_register(){
		if($this->session->userdata('status_login')=="ON"){
			$data['menunye'] = $this->model_pengemasan->m_daftar_menu();
			$data['semua']   = $this->model_pengemasan->m_rekap_register();
			$this->load->library('template');
			$this->template->view('pengemasan/v_register',$data);
		}else{
			redirect('auth');
		}
	}
	
	public function daftar_register_by_id($id_pegawai){
		if($this->session->userdata('status_login')=="ON"){
			$data['menunye'] = $this->model_pengemasan->m_daftar_menu();
			$data['semua']   = $this->model_pengemasan->m_reg_by_idpeg($id_pegawai);
			$this->load->library('template');
			$this->template->view('pengemasan/v_daftar_register_by_id',$data);
		}else{
			redirect('auth');
		}
	}
	
	public function daftar_register_hari_ini(){
		if($this->session->userdata('status_login')=="ON"){
			$data['menunye']      = $this->model_pengemasan->m_daftar_menu();
			$data['reg_hari_ini'] = $this->model_pengemasan->m_reg_hari_ini();
			$data['waktu']        = "HARI INI";
			$this->load->library('template');
			$this->template->view('pengemasan/v_reg_hari_ini',$data);
		}else{
			redirect('auth');
		}
	}
	
	public function tambah_pengembalian(){
		if($this->session->userdata('status_login')=="ON"){
			$data['menunye']    = $this->model_pengemasan->m_daftar_menu();
			$data['jenis_data'] = "pengembalian";
			$this->load->library('template');
			$this->template->view('pengemasan/v_tambah_pengembalian',$data);
		}else{
			redirect('auth');
		}
	}
	
	public function daftar_pengembalian(){
		if($this->session->userdata('status_login')=="ON"){
			$data['menunye']    = $this->model_pengemasan->m_daftar_menu();
			$data['jenis_data'] = "pengembalian";
			$this->load->library('template');
			$this->template->view('pengemasan/v_daftar_pengembalian',$data);
		}else{
			redirect('auth');
		}
	}
	
	public function daftar_detail_pengembalian(){
		if($this->session->userdata('status_login')=="ON"){
			$data['menunye'] = $this->model_pengemasan->m_daftar_menu();
			$data['semua']   = $this->model_pengemasan->m_daftar_detail_pengembalian();
			$this->load->library('template');
			$this->template->view('pengemasan/v_daftar_detail_pengembalian',$data);
		}else{
			redirect('auth');
		}
	}
	
	public function simpan_induk_pengembalian(){
		$x = $this->model_pengemasan->m_id_pengembalian();
		//print_r($_POST);
		$data = array(
			"id"         => $x,
			"no_surat"   => $_POST['no_surat'],
			"tgl_terima" => $_POST['tgl_terima'],
			"jml_spt"    => $_POST['jml_spt']
			);
		
		echo $x."|";
		$this->model_pengemasan->m_simpan_induk_pengembalian($data);
	}
	
	public function simpan_detail_penerimaan(){
		//print_r($_POST);
		$id = $_POST['id_induk'];
		
		foreach($_POST['no_lpad'] as $key => $val){
			//echo "NO LPAD : ".$_POST['no_lpad'][$key]." NPWP : ".$_POST['npwp'][$key]."\n";
			$this->model_pengemasan->m_simpan_detail_pengembalian
			($id,$_POST['no_lpad'][$key],$_POST['npwp'][$key],$_POST['alasan'][$key]);
		}
	}
	
	public function akuintasi(){
		if($this->session->userdata('status_login')=="ON"){
			$data['menunye']        = $this->model_pengemasan->m_daftar_menu();
			$data['daf_pengemasan'] = $this->model_pengemasan->m_daftar_pengemasan_akuintasi();
			$this->load->library('template');
			$this->template->view('pengemasan/v_akuintasi',$data);
		}else{
			redirect('auth');
		}
	}
	
	public function cari_register(){
		$x = $this->input->post("id_spt");

		$data['datanya'] = $this->model_pengemasan->m_cari_reg_by_id_spt($x);
		print json_encode($data['datanya']);
	}
	
	public function pencarian_register(){
		if($this->session->userdata('status_login')=="ON"){
			$data['menunye']    = $this->model_pengemasan->m_daftar_menu();
			$data['pegawai']    = $this->model_pengemasan->m_daftar_pegawai();
			$data['daftar_spt'] = $this->model_pengemasan->m_daftar_spt();
			$this->load->library('template');
			$this->template->view('pengemasan/v_pencarian_register',$data);
		}else{
			redirect('auth');
		}
	}
	
	public function simpan_akuintasi(){
		$data = array(
			"id_reg" 		=> $this->input->post("id_reg"),	
			"id_pengemasan" => $this->input->post("id_pengemasan")
		);
		
		$this->model_pengemasan->m_simpan_akuintasi($data);
	}
	
	public function mencari(){
		if($this->session->userdata('status_login')=="ON"){
			$data['menunye'] = $this->model_pengemasan->m_daftar_menu();
			$this->load->library('template');
			$this->template->view('pengemasan/v_cari_lpad',$data);
		}else{
			redirect('auth');
		}
	}
	
	public function cari_lpad(){
		$x = $this->input->post("no_lpad");
		//echo "Nilai x : " . $x;

		$data['datanya'] = $this->model_pengemasan->m_cari_lpad($x);
		$this->load->view('pengemasan/data_ajax',$data);
		//print_r($data);
	}
	
	public function mencari_nama_wp(){
		if($this->session->userdata('status_login')=="ON"){
			$data['menunye'] = $this->model_pengemasan->m_daftar_menu();
			$this->load->library('template');
			$this->template->view('pengemasan/v_cari_nama_wp',$data);
		}else{
			redirect('auth');
		}
	}
	
	public function cari_nama_wp(){
		$x = $this->input->post("nama_wp");
		$data['datanya'] = $this->model_pengemasan->m_cari_nama_wp($x);
		$this->load->view('pengemasan/data_ajax',$data);
	}
	
	public function cari_register2(){
		$x = $this->input->post("id_pegawai");
		$y = $this->input->post("jns_spt");
		
		//$data['datanya'] = $this->model_pengemasan->m_reg_by_idpeg($x);
		$data['datanya'] = $this->model_pengemasan->m_reg_by_idpeg_jnsspt($x,$y);
		print json_encode($data['datanya']);
	}
	
	public function detail_register(){
		$x = $this->input->get("id_register");
		
		$data['datanya'] = $this->model_pengemasan->m_detail_reg_by_id($x);
		print json_encode($data['datanya']);
	}
	
	public function detail_pengembalian($x){
		if($this->session->userdata('status_login')=="ON"){
			$data['menunye']           = $this->model_pengemasan->m_daftar_menu();
			$data['semua']             = $this->model_pengemasan->m_pengembalian_by_id($x);
			$data['no_sp']             = $data['semua'][0]->no_surat;
			$this->load->library('template');
			//$this->template->view('pengemasan/v_detail_pengembalian',$data);
			$this->template->view('pengemasan/v_daftar_detail_pengembalian',$data);
		}else{
			redirect('auth');
		}
	}
	
	public function manage_data_pengembalian($x){
		if($this->session->userdata('status_login')=="ON"){
			$data['menunye']           = $this->model_pengemasan->m_daftar_menu();
			$data['data_pengembalian'] = $this->model_pengemasan->m_pengembalian_by_id($x);
			$data['no_sp']             = $data['data_pengembalian'][0]->no_surat;
			$data['tgl_terima']        = $data['data_pengembalian'][0]->tgl_terima;
			$this->load->library('template');
			$this->template->view('pengemasan/v_detail_pengembalian',$data);
		}else{
			redirect('auth');
		}
	}
	
	public function simpan_on_blur(){
		$a = $this->input->post("id");
		$b = $this->input->post("kolom");
		$c = $this->input->post("nilai");
		
		$this->model_pengemasan->m_simpan_on_blur($a, $b, $c);
	}
	
	public function simpan_pengambilan(){
		$id_pengemasan = $this->input->post("id_pengemasan");
		$tgl_diambil   = $this->input->post("tgl_diambil");
		
		$this->model_pengemasan->m_simpan_pengambilan($id_pengemasan,$tgl_diambil);
	}
	
	public function tutup_kemasan_akuintasi(){
		$id_pengemasan = $this->input->post("id_pengemasan");
		
		$this->model_pengemasan->m_tutup_kemasan_akuintasi($id_pengemasan);
	}
	
	public function backup_table(){
		if($this->session->userdata('status_login')=="ON"){
			$data['menunye'] = $this->model_pengemasan->m_daftar_menu();
			$data['tabel']   = $this->model_pengemasan->m_show_tables();
			$this->load->library('template');
			$this->template->view('pengemasan/v_backuprestore',$data);
		}else{
			redirect('auth');
		} 
    }
	
	public function backup_database(){
		date_default_timezone_set("Asia/Jakarta");
		
		$this->load->dbutil();
		//$prefs  = array("format" => "zip", "filename" => "my_db_backup.sql");
		$prefs  = array("format" => "zip", "filename" => "pengemasan.sql");
		$backup =& $this->dbutil->backup($prefs);
		//$db_name = "DB_pengemasan_".date('dmY-His').".zip";
		$db_name = date('dmY-His')."_DB_pengemasan.zip";
		$save    = base_url()."backup/".$db_name;
		$this->load->helper('file');
		//write_file($save, $backup);
		write_file(FCPATH.'/backup/'.$db_name,$backup);
		$this->load->helper('download');
		force_download($db_name, $backup);
	}
	
	public function act_backup_table(){
		date_default_timezone_set("Asia/Jakarta");
		
		$tabel = $this->input->post('tabel');
		echo $tabel;
		
		/*
		$this->load->dbutil();
		$prefs = array(    
			'tables'      => array($tabel),
			'format'      => 'zip',
			'filename'    => $tabel.'.sql'
			);
		$backup  =& $this->dbutil->backup($prefs);
		//$db_name = $tabel.'_'.date("dmY-His").'.zip';
		$db_name = date('dmY-His')."_".$tabel.".zip";
		$save    = base_url()."backup/".$db_name;
		$this->load->helper('file');
		//write_file($save, $backup);
		write_file(FCPATH.'/backup/'.$db_name,$backup);
		$this->load->helper('download');
		force_download($db_name, $backup);
		*/
    }
	
	public function multi_backup_table(){
		$tabel = $_POST['tabel'];
		
		foreach($_POST['tabel'] as $key => $val){

			// $this->load->dbutil();
			// $prefs = array(    
				// 'tables'      => array($val),
				// 'format'      => 'zip',
				// 'filename'    => $val.'.sql'
				// );
			// $backup  =& $this->dbutil->backup($prefs);
			// $db_name = date('dmY-His')."_".$val.".zip";
			// $save    = base_url()."backup/".$db_name;
			// $this->load->helper('file');
			// write_file(FCPATH.'/backup/'.$db_name,$backup);
			// $this->load->helper('download');
			// force_download($db_name, $backup);
			$this->act_backup_table($val);
			
		}
    }
	
	public function restore(){
		$this->load->helper('file');
		$this->load->model('sismas_m');
		$config['upload_path']= site_url()."/upload";
		$config['allowed_types']="jpg|png|gif|jpeg|bmp|sql|x-sql";
		$this->load->library('upload',$config);
		$this->upload->initialize($config);

		if(!$this->upload->do_upload("datafile")){
			$error = array('error' => $this->upload->display_errors());
			echo "GAGAL UPLOAD";
			var_dump($error);
			exit();
		}
	}
	
	public function eksporDetailKemasan(){
		$this->load->dbutil();
		$this->load->helper('file');
		$this->load->helper('download');
		$delimiter = ";";
		$newline   = "\r\n";
		$filename  = 'DetailKemasan_'.date('dmY').'.csv';

		$sql = "SELECT 
			TRIM(b.no_lpad) as nolpad,
			a.bc_kemasan,
			a.segel_kemasan,
			DATE_FORMAT(a.tgl_kemas,'%e %M %Y') AS TGLKEMAS
			FROM tb_pengemasan a LEFT JOIN tb_detail_kemasan b 
			ON (a.id_pengemasan = b.id_pengemasan) WHERE YEAR(a.tgl_kemas) = YEAR(CURDATE()) 
			ORDER BY b.no_lpad";
		$hasil = $this->db->query($sql);
		$data  = $this->dbutil->csv_from_result($hasil,$delimiter,$newline);
		force_download($filename,$data);
	}
	
	public function high(){
		$ere   = array();
		
		$x     = $this->model_pengemasan->m_gra_enam_spt();
		
		$ere[] = array_values(array_map('intval', array_slice($x[0],0)));
		$ere[] = array_values(array_map('intval', array_slice($x[1],0)));
		$ere[] = array_values(array_map('intval', array_slice($x[2],0)));
		$ere[] = array_values(array_map('intval', array_slice($x[3],0)));
		$ere[] = array_values(array_map('intval', array_slice($x[4],0)));
		$ere[] = array_values(array_map('intval', array_slice($x[5],0)));
		
		// echo "<textarea>";
		// print_r($x);
		// echo "</textarea>";
		
		$data['nilai'] = json_encode($ere);
		//$xxx = array_map('intval', array_slice($ere,1));
		//print_r($xxx);
		
		$this->load->view('pengemasan/v_high',$data);
	}
	
	public function isiKemasan($barcode){
		if($this->session->userdata('status_login')=="ON"){
			$data['menunye']   = $this->model_pengemasan->m_daftar_menu();
			$data['isi']       = $this->model_pengemasan->m_isi_kemasan($barcode);
			$data['segel']     = $this->model_pengemasan->m_segel_dari_kemasan($barcode);
			$data['tgl_kemas'] = $this->model_pengemasan->m_tglkemas_dari_kemasan($barcode);
			$data['barcode']   = $barcode;
			$this->load->library('template');
			$this->template->view('pengemasan/v_isi_kemasan',$data);
		}else{
			redirect('auth');
		}
	}
	/*
	public function register_belum_rekam(){
		if($this->session->userdata('status_login')=="ON"){
			$data['menunye']   = $this->model_pengemasan->m_daftar_menu();
			$data['datanya']   = $this->model_pengemasan->m_register_belum_kemas();
			$this->load->library('template');
			$this->template->view('pengemasan/v_register_belum_kemas',$data);
		}else{
			redirect('auth');
		}
	}
	*/
	public function register_belum_akuintasi(){
		if($this->session->userdata('status_login')=="ON"){
			$data['menunye']   = $this->model_pengemasan->m_daftar_menu();
			$data['datanya']   = $this->model_pengemasan->m_res_reg_blm_akuin();
			$data['datanya1']  = $this->model_pengemasan->m_res_reg_blm_akuin_by_spt();
			$this->load->library('template');
			$this->template->view('pengemasan/v_register_belum_akuintasi',$data);
		}else{
			redirect('auth');
		}
	}
	/*
	// public function detailRegBlmKms($kode_spt){
		// if($this->session->userdata('status_login')=="ON"){
			// $data['menunye']   = $this->model_pengemasan->m_daftar_menu();
			// $data['datanya']   = $this->model_pengemasan->m_reg_spt_blm($kode_spt);
			// $this->load->library('template');
			// $this->template->view('pengemasan/v_detail_reg_blm_kms',$data);
		// }else{
			// redirect('auth');
		// }
	// }
	*/
	public function detail_reg_blm_akuintasi(){
		if($this->session->userdata('status_login')=="ON"){
			$kode_spt      = $this->uri->segment(3);
			$bulan_terima  = $this->uri->segment(4);
			
			$data['menunye']   = $this->model_pengemasan->m_daftar_menu();
			$data['datanya']   = $this->model_pengemasan->m_det_reg_blm_akuin($kode_spt,$bulan_terima);
			$this->load->library('template');
			$this->template->view('pengemasan/v_detail_reg_blm_akuintasi',$data);
		}else{
			redirect('auth');
		}
	}
	
	public function simpanUbahanStatusRegister(){
		if($this->session->userdata('status_login')=="ON"){
			$id_register = $this->input->post("id_register");
			$alasan      = $this->input->post("alasan");
			
			$this->model_pengemasan->m_simpanUbahanStatusRegister($id_register,$alasan);
		}else{
			redirect('auth');
		}
	}

	public function kemasan_belum_diambil(){
		if($this->session->userdata('status_login')=="ON"){
			$data['menunye']   = $this->model_pengemasan->m_daftar_menu();
			$data['kemasan']   = $this->model_pengemasan->m_res_kemasan_blm_diambil();
			$this->load->library('template');
			$this->template->view('pengemasan/v_kemasan_belum_diambil',$data);
		}else{
			redirect('auth');
		}
	}
	
	public function detail_kemasan_belum_diambil($id_spt){
		if($this->session->userdata('status_login')=="ON"){
			$data['menunye']   = $this->model_pengemasan->m_daftar_menu();
			$data['kemasan']   = $this->model_pengemasan->m_det_kemasan_blm_diambil($id_spt);
			$data['nama_spt']  = namaSPT($id_spt);
			$this->load->library('template');
			$this->template->view('pengemasan/v_detail_kemasan_belum_diambil',$data);
		}else{
			redirect('auth');
		}
	}
	/*
	public function checklist_kemasan(){
		if($this->session->userdata('status_login')=="ON"){
			$data['menunye']   = $this->model_pengemasan->m_daftar_menu();
			$data['kemasan']   = $this->model_pengemasan->m_cetak_checklist();
			$this->load->library('template');
			$this->template->view('pengemasan/v_checklist_kemasan',$data);
		}else{
			redirect('auth');
		}
	}
	*/
	public function cetak_checklist_kemasan(){
		$tgl_hari_ini   = date("d-m-Y");
		$tgl_buat_judul = date("dmY");
		
		
		$pdf = new FPDF('P','mm','A4');
		
		$pdf->SetAuthor("Pengemasan 1.1");
        // membuat halaman baru
		$pdf->AliasNbPages();
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string
        $pdf->Cell(190,7,'DAFTAR KEMASAN BELUM DIAMBIL PPDDP',0,1,'C');
        $pdf->SetFont('Arial','B',12);
		$pdf->Cell(190,7,'diurutkan berdasarkan tanggal pengemasan',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(10,6,'NO',1,0,'C');
        $pdf->Cell(60,6,'JENIS SPT',1,0,'C');
        $pdf->Cell(40,6,'BARCODE',1,0,'C');
        $pdf->Cell(20,6,'SEGEL',1,0,'C');
        $pdf->Cell(25,6,'TGL KMS',1,0,'C');
        $pdf->Cell(20,6,'JML SPT',1,0,'C');
        $pdf->Cell(15,6,'ADA ?',1,1,'C');
        $pdf->SetFont('Arial','',11);
		$no = 1;
        $kemasan = $this->model_pengemasan->m_cetak_checklist();
		
        foreach ($kemasan as $row){
            $pdf->Cell(10,6,$no,1,0,'C');
            $pdf->Cell(60,6,$row->JNSSPT,1,0);
            $pdf->Cell(40,6,$row->bc_kemasan,1,0,'C');
            $pdf->Cell(20,6,$row->segel_kemasan,1,0,'C');
            $pdf->Cell(25,6,$row->dtglkemas,1,0,'C');
            $pdf->Cell(20,6,$row->jml_spt,1,0,'R');
			$pdf->Cell(15,6,'',1,1);
			$no++;
        }
		
		$pdf->Cell(10,7,'',0,1);
		$pdf->SetFont('Arial','',11);
		$pdf->Cell(190,7,'Surakarta,'.date("d").'-'.date("m").'-'.date("Y"),0,1);
		$pdf->Cell(10,25,'',0,1);
		$pdf->Cell(190,7,'Petugas Pengemasan',0,1);
		
        $pdf->Output('I','ChecklistKemasan_'.$tgl_buat_judul.'.pdf');
	}
	
	public function cetak_checklist_register(){
		$tgl_hari_ini   = date("d-m-Y");
		$tgl_buat_judul = date("dmY");
		
		
		$pdf = new FPDF('P','mm','A4');
		
		$pdf->SetAuthor("Pengemasan 1.1");
		$pdf->AliasNbPages();
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string
        $pdf->Cell(190,7,'DAFTAR REGISTER BELUM KEMAS',0,1,'C');
        $pdf->SetFont('Arial','B',12);
		$pdf->Cell(190,7,'per '.$tgl_hari_ini,0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(10,6,'NO',1,0,'C');
        $pdf->Cell(85,6,'JENIS SPT',1,0,'C');
        $pdf->Cell(20,6,'JML REG',1,0,'C');
        $pdf->Cell(20,6,'JML SPT',1,0,'C');
        $pdf->Cell(15,6,'ADA ?',1,1,'C');
        $pdf->SetFont('Arial','',11);
		
		$no = 1;
        $register = $this->model_pengemasan->m_res_reg_blm_akuin_by_spt();
		$TOT_REG = 0;
		$TOT_SPT = 0;
		
        foreach ($register as $row){
            $pdf->Cell(10,6,$no,1,0,'C');
            $pdf->Cell(85,6,$row->JNSSPT,1,0);
            $pdf->Cell(20,6,$row->JMLREG,1,0,'R');
            $pdf->Cell(20,6,$row->JMLSPT,1,0,'R');
			$pdf->Cell(15,6,'',1,1);
			$no++;
			$TOT_REG += $row->JMLREG;
			$TOT_SPT += $row->JMLSPT;
        }
		
		$pdf->SetFont('Arial','B',11);
		$pdf->Cell(10,6,'',1,0,'C');
		$pdf->Cell(85,6,'TOTAL',1,0);
		$pdf->Cell(20,6,$TOT_REG,1,0,'R');
		$pdf->Cell(20,6,$TOT_SPT,1,0,'R');
		$pdf->Cell(15,6,'',1,1);
		
		//================DETAIL========================//
		
		$pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(10,6,'NO',1,0,'C');
        $pdf->Cell(50,6,'JENIS SPT',1,0,'C');
        $pdf->Cell(90,6,'NO REGISTER',1,0,'C');
        $pdf->Cell(10,6,'JSPT',1,0,'C');
        $pdf->Cell(15,6,'ADA ?',1,1,'C');
		
		$pdf->SetFont('Arial','',11);
		
		$no2 = 1;
		$TOT_SPT2 = 0;
        $register2 = $this->model_pengemasan->m_res_reg_blm_akuin_by_spt2();
		
        foreach ($register2 as $row2){
            $pdf->Cell(10,6,$no2,1,0,'C');
            $pdf->Cell(50,6,$row2->JNSSPT2,1,0);
            $pdf->Cell(90,6,batasiTeks($row2->NOREG2,35),1,0,'L');
            $pdf->Cell(10,6,$row2->JMLSPT2,1,0,'R');
			$pdf->Cell(15,6,'',1,1);
			$no2++;
			$TOT_SPT2 += $row2->JMLSPT2;
        }
		
		$pdf->SetFont('Arial','B',11);
		$pdf->Cell(10,6,'',1,0,'C');
		$pdf->Cell(50,6,'TOTAL SPT',1,0);
		$pdf->Cell(90,6,'',1,0,'R');
		$pdf->Cell(10,6,$TOT_SPT2,1,0,'R');
		$pdf->Cell(15,6,'',1,1);

		$pdf->Cell(10,7,'',0,1);
		$pdf->SetFont('Arial','',11);
		$pdf->Cell(190,7,'Surakarta, '.date("d").'-'.date("m").'-'.date("Y"),0,1);
		$pdf->Cell(10,25,'',0,1);
		$pdf->Cell(190,7,'Petugas Pengemasan',0,1);
		
        $pdf->Output('I','ChecklistRegister_'.$tgl_buat_judul.'.pdf');
	}
	
	public function cetak_checklist_lpad_baru(){
		$tgl_buat_judul = date("dmY");
		
		$pdf = new FPDF('L','mm','A4');
		
		$pdf->SetAuthor("Pengemasan 1.1");
		$pdf->AliasNbPages();
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string
        $pdf->Cell(190,7,'DAFTAR LPAD BARU SPT KEMBALI',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
		
        $pdf->SetFont('Arial','B',11);
		
        $pdf->Cell(10,6,'NO',1,0,'C');
        $pdf->Cell(45,6,'N P W P',1,0,'C');
        $pdf->Cell(85,6,'LPAD LAMA',1,0,'C');
        $pdf->Cell(85,6,'LPAD BARU',1,0,'C');
        $pdf->Cell(50,6,'ALASAN',1,1,'C');
        $pdf->SetFont('Arial','',11);
		
		$no = 1;
        $lpad = $this->model_pengemasan->m_cetak_lpad_baru();
		
        foreach ($lpad as $row){
            $pdf->Cell(10,6,$no,1,0,'C');
            $pdf->Cell(45,6,kasih_titik($row->npwp),1,0,'C');
            $pdf->Cell(85,6,$row->no_lpad,1,0,'L');
            $pdf->Cell(85,6,$row->no_lpad_baru,1,0,'L');
            //$pdf->Cell(50,6,$row->alasan,1,1,'L');
            $pdf->MultiCell(0,0,$row->alasan,1,1,'L');
			$no++;
        }

		$pdf->Cell(10,7,'',0,1);
		$pdf->SetFont('Arial','',11);
		$pdf->Cell(190,7,'Surakarta, ..........-........-2018',0,1);
		$pdf->Cell(10,25,'',0,1);
		$pdf->Cell(190,7,'Petugas Pengemasan',0,1);
		
        $pdf->Output('I','ChecklistLPADBaru_'.$tgl_buat_judul.'.pdf');
	}
	
	public function cetak_pengembalian_blm_terima(){
		$tgl_buat_judul = date("dmY");
		
		$pdf = new FPDF('L','mm','A4');
		
		$pdf->SetAuthor("Pengemasan 1.1");
        // membuat halaman baru
        $pdf->AddPage();
		$pdf->AliasNbPages();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string
        $pdf->Cell(190,7,'DAFTAR PENGEMBALIAN SPT BELUM BISA DITINDAKLANJUTI',0,1,'L');
        $pdf->SetFont('Arial','B',12);
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
		
        $pdf->SetFont('Arial','B',11);
		
        $pdf->Cell(10,6,'NO',1,0,'C');
        $pdf->Cell(45,6,'NO SP',1,0,'C');
        $pdf->Cell(85,6,'NO BPS AWAL',1,0,'C');
        $pdf->Cell(45,6,'N P W P',1,0,'C');
        $pdf->Cell(60,6,'ALASAN',1,1,'C');
        $pdf->SetFont('Arial','',11);
		
		$no = 1;
        $lpad = $this->model_pengemasan->m_pengembalian_blm_terima();
		
        foreach ($lpad as $row){
            $pdf->Cell(10,6,$no,1,0,'C');
            $pdf->Cell(45,6,$row->no_surat,1,0,'L');
            $pdf->Cell(85,6,$row->no_lpad,1,0,'L');
            $pdf->Cell(45,6,kasih_titik($row->npwp),1,0,'C');
            $pdf->Cell(60,6,$row->alasan,1,1,'L');
			$no++;
        }

		$pdf->Cell(10,7,'',0,1);
		$pdf->SetFont('Arial','',11);
		$pdf->Cell(190,7,'Surakarta, ..........-........-2018',0,1);
		$pdf->Cell(10,25,'',0,1);
		$pdf->Cell(190,7,'Petugas Pengemasan',0,1);
		
        $pdf->Output('I','ChecklistLPADBaru_'.$tgl_buat_judul.'.pdf');
	}
	
	public function pengembalian_belum_kemas(){
		if($this->session->userdata('status_login')=="ON"){
			$data['menunye']   = $this->model_pengemasan->m_daftar_menu();
			$data['datanya']   = $this->model_pengemasan->m_cetak_pengembalian_blm_kemas();
			$this->load->library('template');
			$this->template->view('pengemasan/v_spt_kembali_blm_dikemas',$data);
		}else{
			redirect('auth');
		}
	}
	
	public function cetak_pengembalian_blm_kemas(){
		$tgl_buat_judul = date("dmY");
		
		$pdf = new FPDF('L','mm','A4');
		
		$pdf->SetAuthor("Pengemasan 1.1");
        // membuat halaman baru
        $pdf->AddPage();
		$pdf->AliasNbPages();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string
        $pdf->Cell(190,7,'DAFTAR PENGEMBALIAN SPT BELUM DIKEMAS',0,1,'L');
        $pdf->SetFont('Arial','B',12);
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
		
        $pdf->SetFont('Arial','B',11);
		
        $pdf->Cell(10,6,'NO',1,0,'C');
        $pdf->Cell(50,6,'NO SP',1,0,'C');
        $pdf->Cell(25,6,'TGL SP',1,0,'C');
        $pdf->Cell(90,6,'NO BPS AWAL',1,0,'C');
        $pdf->Cell(45,6,'N P W P',1,0,'C');
        $pdf->Cell(60,6,'ALASAN',1,1,'C');
        $pdf->SetFont('Arial','',11);
		
		$no = 1;
        $lpad = $this->model_pengemasan->m_cetak_pengembalian_blm_kemas();
		
        foreach ($lpad as $row){
            $pdf->Cell(10,6,$no,1,0,'C');
            $pdf->Cell(50,6,$row->no_surat,1,0,'L');
            $pdf->Cell(25,6,$row->tgl_terima_sp,1,0,'C');
            $pdf->Cell(90,6,$row->no_lpad,1,0,'L');
            $pdf->Cell(45,6,kasih_titik($row->npwp),1,0,'C');
            $pdf->Cell(60,6,batasiTeks($row->alasan,30),1,1,'L');
			$no++;
        }
		
        $pdf->Output('I','ChecklistLPADBaru_'.$tgl_buat_judul.'.pdf');
	}
	
	public function buat_excel_bps(){
		$tgl_tinjut     = $this->input->post("tgl_tinjut");
		$data['daftar'] = $this->model_pengemasan->m_daftar_tgl($tgl_tinjut);
		
		//print_r($data['daftar']);
		$this->load->view('pengemasan/v_email',$data);
	}
	
	public function daftar_bps_pengganti(){
		if($this->session->userdata('status_login')=="ON"){
			$data['menunye']           = $this->model_pengemasan->m_daftar_menu();
			$data['daftar_tgl_tinjut'] = $this->model_pengemasan->m_daftar_tgl_tinjut();
			$this->load->library('template');
			$this->template->view('pengemasan/v_daftar_bps_pengganti',$data);
		}else{
			redirect('auth');
		}
	}
	
	public function load_daftar_bps_pengganti(){
		$tgl_tinjut  = $this->input->post("tgl_tinjut");
		
		$daftar     = $this->model_pengemasan->m_daftar_tgl($tgl_tinjut);
		print json_encode($daftar);
		//print_r($daftar);
	}
	
	public function ubah_selesai(){
		$id_berkas = $this->input->post("id_berkas");
		
		$this->model_pengemasan->m_ubah_selesai($id_berkas);
	}
	
	public function cetak_tcpdf(){
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetTitle('Contoh');
		$pdf->SetTopMargin(20);
		$pdf->setFooterMargin(20);
		$pdf->SetAutoPageBreak(true);
		$pdf->SetAuthor('Pengemasan 1.1');
		$pdf->SetDisplayMode('real', 'default');
		$pdf->AddPage();
		$pdf->Write(5, 'DAFTAR REGISTER BELUM KEMAS');
		
		function kumpulkanData(){
			$htmlnya = '';
			$no2     = 1;
			
			$register2 = $this->model_pengemasan->m_res_reg_blm_akuin_by_spt2();
			foreach ($register2 as $row2){
				$htmlnya .= '<tr>';
				$htmlnya .= '<td>'.$no2.'</td>';
				$htmlnya .= '<td>'.$row2->JNSSPT2.'</td>';
				$htmlnya .= '<td>'.batasiTeks($row2->NOREG2).'</td>';
				$htmlnya .= '<td>'.$row2->JMLSPT2.'</td></tr>';
				$no2++;
			}
			
			return $htmlnya;
			
		}
		
		$isi .= kumpulkanData();
		
		$pdf->writeHTML($isi, true, true, true, true, '');
		
		$pdf->Output('contoh1.pdf', 'I');
	}
	
	public function grafik_register_bulanan(){
		if($this->session->userdata('status_login')=="ON"){
			$data['menunye']   = $this->model_pengemasan->m_daftar_menu();
			$this->load->library('template');
			$this->template->view('pengemasan/v_grafik_register',$data);
		}else{
			redirect('auth');
		}
	}
	
	public function ajax_grafik_register_bulanan(){
		if($this->session->userdata('status_login')=="ON"){
			$kode_bulan = $this->input->post("kode_bulan");

			$datanya = $this->model_pengemasan->m_grafik_register($kode_bulan);
			
			foreach($datanya as $key=>$val){
				$ere['jumlah'][]   = (int)$val->JML_REG;
				$ere['tanggal'][]  = $val->TGL;
			}
			
			print json_encode($ere);
		}else{
			redirect('auth');
		}
	}
	
	public function grafik_register_bulanan2(){
		if($this->session->userdata('status_login')=="ON"){
			$data['menunye']   = $this->model_pengemasan->m_daftar_menu();
			$this->load->library('template');
			$this->template->view('pengemasan/v_grafik_register2',$data);
		}else{
			redirect('auth');
		}
	}
	
	public function ajax_grafik_register_bulanan2(){
		if($this->session->userdata('status_login')=="ON"){
			$kode_bulan = $this->input->post("kode_bulan");

			$datanya = $this->model_pengemasan->m_grafik_register2($kode_bulan);
			
			foreach($datanya as $key=>$val){
				$ere['tanggal'][]  = $val->TGL;
				$ere['jumlah']['SPT1'][] = (int)$val->JMLSPT1;
				$ere['jumlah']['SPT2'][] = (int)$val->JMLSPT2;
				$ere['jumlah']['SPT3'][] = (int)$val->JMLSPT3;
				$ere['jumlah']['SPT4'][] = (int)$val->JMLSPT4;
				$ere['jumlah']['SPT5'][] = (int)$val->JMLSPT5;
				$ere['jumlah']['SPT6'][] = (int)$val->JMLSPT6;
				$ere['jumlah']['SPT7'][] = (int)$val->JMLSPT7;
			}
			
			print json_encode($ere);
		}else{
			redirect('auth');
		}
	}
	
	public function grafik_register_bulanan3(){
		if($this->session->userdata('status_login')=="ON"){
			$datanya = $this->model_pengemasan->m_grafik_register_per_bulan();
			
			foreach($datanya as $key=>$val){
				$ere['bulan'][]  = $val->BULAN;
				$ere['jumlah']['SPT1'][] = (int)$val->JML_SPT1;
				$ere['jumlah']['SPT2'][] = (int)$val->JML_SPT2;
				$ere['jumlah']['SPT3'][] = (int)$val->JML_SPT3;
				$ere['jumlah']['SPT4'][] = (int)$val->JML_SPT4;
				$ere['jumlah']['SPT5'][] = (int)$val->JML_SPT5;
				$ere['jumlah']['SPT6'][] = (int)$val->JML_SPT6;
				$ere['jumlah']['SPT7'][] = (int)$val->JML_SPT7;
			}
			
			print json_encode($ere);
		}else{
			redirect('auth');
		}
	}
	
	public function load_spt_kembali(){
		$kode_spt = $this->input->post("kode_spt");
		
		$datanya = $this->model_pengemasan->m_load_spt_kembali($kode_spt);
		print json_encode($datanya);
	}
	
	public function cari_namawp(){
		if($this->session->userdata('status_login')=="ON"){
			$data['menunye'] = $this->model_pengemasan->m_daftar_menu();
			$data['semua']   = $this->model_pengemasan->m_cari_namawp();
			$this->load->library('template');
			$this->template->view('pengemasan/v_cari_namawp',$data);
		}else{
			redirect('auth');
		}
	}

}