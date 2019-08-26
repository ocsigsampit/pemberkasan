<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Pemberkasan extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model("model_pemberkasan");
		$this->load->library('pdf');
        $this->load->library(array('form_validation', 'email'));
		$this->load->helper(array('form','url'));
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index(){
		if($this->session->userdata('status_login') == "ON"){
			if($this->session->userdata('role') == "3"){
				$id_user             = $this->session->userdata('id_user');
				
				$data['pageTitle']   = 'Home';
				$data['menunye']     = $this->model_pemberkasan->daftarMenu();
				$data['semua']       = $this->model_pemberkasan->daftarPeminjamanById($id_user);
				$data['pageContent'] = $this->load->view('pemberkasan/user/daftarPeminjaman', $data, TRUE);
				
				$this->load->view('template/layout', $data);
				
			}elseif($this->session->userdata('role') == "1" || $this->session->userdata('role') == "2"){
				$data['pageTitle']   = 'Home';
				$data['menunye']     = $this->model_pemberkasan->daftarMenu();
				$data['semua']       = $this->model_pemberkasan->daftarPeminjaman();
				$data['pageContent'] = $this->load->view('pemberkasan/daftarPeminjaman', $data, TRUE);
				
				$this->load->view('template/layout', $data);
			}
		}else{
			redirect('auth');
		}
	}
	
	public function peminjaman(){
		if($this->session->userdata('status_login')=="ON"){
			$data['pageTitle']   = 'Peminjaman';
			$data['menunye']     = $this->model_pemberkasan->daftarMenu();
			$data['pageContent'] = $this->load->view('pemberkasan/peminjaman', $data, TRUE);
			
			$this->load->view('template/layout', $data);
		}else{
			redirect('auth');
		}
	}
	
	public function cari(){
		$katakunci = $this->input->post("katakunci");
		$kolom     = ($this->input->post("kolom") == "kk_npwp") ? "npwp" : "namawp";
		
		$hasil = $this->model_pemberkasan->cari($katakunci, $kolom);
		echo json_encode($hasil);
	}
	
	public function simpan_formulir(){
		
		$this->form_validation->set_rules("no_nd", "No Nota Dinas", "required");
		$this->form_validation->set_rules("tgl_nd", "Tanggal Nota Dinas", "required");
		
		if($this->form_validation->run()){
			
			$no_nd      = $this->input->post("no_nd");
			$tgl_nd     = $this->input->post("tgl_nd");
			$id_user    = $this->session->userdata("id_user");
			$saatIni    = date("Y-m-d H:i:s");
			
			$id_peminjaman = $this->model_pemberkasan->getIdPeminjaman($id_user);
			$this->model_pemberkasan->simpanInduk($id_peminjaman, $id_user, $no_nd, $tgl_nd, $saatIni);
			
			$ids_berkas = $this->input->post("ids_berkas");
			
			if(strpos($ids_berkas,",") > 0){
				$xpl_berkas = explode(",",$ids_berkas);
				
				foreach($xpl_berkas as $i){
					$this->model_pemberkasan->simpanDetail($id_peminjaman, $i);
				}
			}elseif(strpos($ids_berkas,",") == 0){
				$this->model_pemberkasan->simpanDetail($id_peminjaman, $ids_berkas);
			}
			
			$array = array("success" => "<div class='alert alert-success'>Berhasil</div>");
			
		}else{
			$array = array(
			"error" => true,
			"no_nd_error"  => form_error("no_nd"),
			"tgl_nd_error" => form_error("tgl_nd")
			);
		}
		
		echo json_encode($array);
		
	}
	/*
	public function simpan_formulir(){
		
		$no_nd      = $this->input->post("no_nd");
		$tgl_nd     = $this->input->post("tgl_nd");
		$id_user    = $this->session->userdata("id_user");
		$saatIni    = date("Y-m-d H:i:s");
		
		$ids_berkas = $this->input->post("ids_berkas");
		$xpl_berkas = explode(",",$ids_berkas);
		
		$id_peminjaman = $this->model_pemberkasan->getIdPeminjaman($id_user);
		
		$this->model_pemberkasan->simpanInduk($id_peminjaman, $id_user, $no_nd, $tgl_nd, $saatIni);
		
		$query = "";
		
		foreach($xpl_berkas as $i){
			$this->model_pemberkasan->simpanDetail($id_peminjaman, $i);
		} 
		
		echo $query;
	}
	*/
	
	public function detail($id_peminjaman){
		if($this->session->userdata('status_login') == "ON"){
			if($this->session->userdata('role') == "1" || $this->session->userdata('role') == "2"){
				
				$data['pageTitle']   = 'Detail Peminjaman';
				$data['menunye']     = $this->model_pemberkasan->daftarMenu();
				$data['semua']       = $hasil = $this->model_pemberkasan->detail($id_peminjaman);
				$data['pageContent'] = $this->load->view('pemberkasan/detailPeminjaman', $data, TRUE);
				
				$this->load->view('template/layout', $data);
			}else{
				redirect('pemberkasan/index/');
			}
		}else{
			redirect('auth');
		}
		
	}
	
	public function selesai(){
		$id_peminjaman = $this->input->post("id_peminjaman");
		
		$this->model_pemberkasan->selesai($id_peminjaman);
	}
	
	public function cetakND($id_peminjaman){
		
		$dataND    = $this->model_pemberkasan->isiNDById($id_peminjaman);
		$dataSeksi = $this->model_pemberkasan->cariSeksi($this->session->userdata('id_user'));
		
		foreach($dataND as $r){
			$no_nd    = $r->no_nd;
			$tgl_nd   = $r->tgl_nd;
			$peminjam = $r->nama;
		}
		
		foreach($dataSeksi as $t){
			$nama_seksi  = $t->nama_seksi;
			$nama_kasi   = $t->nama_kasi;
		}
		
		//Logo Kemenkeu
		$logo = base_url('images/kemenkeu.jpg');
		
		$pdf = new FPDF('P','mm','A4');
		
		$pdf->SetAuthor("Aplikasi Pemberkasan");

        $pdf->AddPage();
		$pdf->AliasNbPages();

		$pdf->Image($logo,10,10,-200);
		
        $pdf->SetFont('Arial','B',13);
        $pdf->Cell(190,7,'KEMENTERIAN KEUANGAN REPUBLIK INDONESIA',0,1,'C');
		
		$pdf->SetFont('Arial','',11);
        $pdf->Cell(190,5,'DIREKTORAT JENDERAL PAJAK',0,1,'C');
        $pdf->Cell(190,5,'KANTOR WILAYAH DJP JAWA TENGAH II',0,1,'C');
		
		$pdf->SetFont('Arial','B',13);
        $pdf->Cell(190,5,'KANTOR PELAYANAN PAJAK PRATAMA SURAKARTA',0,1,'C');
		
		$pdf->SetFont('Arial','B',7);
        $pdf->Cell(190,3,'JALAN K.H. AGUS SALIM NO. 1 SURAKARTA 57147',0,1,'C');
        $pdf->Cell(190,3,'TELEPON (0271) 718246, FAKSIMILE (0271) 728436, SITUS www.pajak.go.id',0,1,'C');
        $pdf->Cell(190,3,'EMAIL pengaduan@pajak.go.id',0,1,'C');
		
		$pdf -> Line(10, 45, 200, 45);

        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',13);
        $pdf->Cell(190,7,'NOTA DINAS',0,1,'C');
		
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(190,4,'Nomor : '.$no_nd,0,1,'C');
		
		$pdf->Ln(8);
		
        $pdf->Cell(30,6,'Kepada',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(50,6,'Kepala Seksi Pelayanan',0,1,'L');
		
        $pdf->Cell(30,6,'Dari',0,0,'L');
		$pdf->Cell(5,6,':',0,0,'C');
		$pdf->Cell(50,6,'Kepala '.$nama_seksi,0,1,'L');
		
        $pdf->Cell(30,6,'Perihal',0,0,'L');
		$pdf->Cell(5,6,':',0,0,'C');
		$pdf->Cell(50,6,'Peminjaman Berkas ',0,1,'L');
		
		
        $pdf->Cell(30,6,'Tanggal',0,0,'L');
		$pdf->Cell(5,6,':',0,0,'C');
		$pdf->Cell(50,6,litMysql2Ina($tgl_nd),0,1,'L');
		
		$pdf ->Line(10, 93, 200, 93);
		
		$pdf->Ln(5);
       
        $pdf->Cell(30,7,'Daftar berkas yang dipinjam :',0,0,'L');
		
		$pdf->Ln(3);
		
		$pdf->Cell(10,7,'',0,1);
		
        $pdf->SetFont('Arial','B',10);
		
        $pdf->Cell(8,6,'No',1,0,'C');
        $pdf->Cell(38,6,'N P W P',1,0,'C');
        $pdf->Cell(80,6,'Nama Wajib Pajak',1,0,'C');
        $pdf->Cell(30,6,'Jenis Berkas',1,0,'C');
        $pdf->Cell(30,6,'Ms/ThnPjk/Pbt',1,1,'C');
      
        $pdf->SetFont('Arial','',10);
		
		$no = 1;
		
		foreach($dataND as $s){
			$pdf->Cell(8,6,$no,1,0,'C');
			$pdf->Cell(38,6,kasih_titik($s->npwp),1,0,'C');
			$pdf->Cell(80,6,$s->nama_wp,1,0,'L');
			$pdf->Cell(30,6,$s->jenis_berkas,1,0,'L');
			$pdf->Cell(30,6,$s->msthnpbt ,1,1,'L');
			$no++;
		}
		
		$pdf->Ln(10);
		
		$pdf->Cell(120,5,'',0,0,'L');
        $pdf->Cell(20,5,'Mengetahui,',0,1,'L');
		
		$pdf->Cell(120,5,'Peminjam,',0,0,'L');
        $pdf->Cell(20,5,'Kepala Seksi,',0,1,'L');
		
		$pdf->Ln(12);

		$pdf->Cell(120,5,ucwords(strtolower($peminjam)),0,0,'L');
		$pdf->Cell(20,5,ucwords(strtolower($nama_kasi)),0,1,'L');
		
        $pdf->Output('I','ND_.pdf');
	}
}