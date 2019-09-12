<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Model_pemberkasan extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}
	
	public function daftarMenu(){
		$q = $this->db->query("SELECT * FROM tb_menu WHERE id_parent = '0' AND aktif='1' ORDER BY CAST(id_menu AS UNSIGNED)");
		
		return $q->result();
	}
	
	public function cari($katakunci, $kolom){
		$kriteria = ($kolom == "npwp") ? " npwp = '".$katakunci."' " : " nama_wp LIKE '%".$katakunci."%' ";
		
		$qry = $this->db->query("SELECT 
			a.id_berkas,
			a.npwp, 
			a.nama_wp, 
			b.jenis_berkas, 
			concat(a.masa_pajak|a.tahun_pajak) as msthn, 
			a. pembetulan 
			FROM tb_berkas a LEFT JOIN tb_jenis_berkas b ON (a.id_jns_berkas = b.id_jns_berkas) 
			WHERE ".$kriteria." AND status ='0' ORDER BY a.id_berkas");
		
		return $qry->result();
	}
	
	public function getIdPeminjaman($id_user){
		//format : P20190819U002001 --> ['P'][TAHUN][BULAN][TGL][ID USER][incremental]
		
		$waktu   = date("Ymd");
		$qry     = $this->db->query("SELECT MAX(SUBSTR(id_peminjaman,14,3)) AS X FROM tb_peminjaman");
		
		$hasil       = $qry->row();
		$no_terakhir = $hasil->X;
		$no_baru     = ((int)$no_terakhir) + 1;
		$nomor       = "P".$waktu.$id_user.sprintf("%03d",$no_baru);
		
		return $nomor;
	}
	
	public function simpanInduk($id_peminjaman, $id_user, $no_nd, $tgl_nd, $saatIni){
		$this->db->query("INSERT INTO tb_peminjaman (id_peminjaman, id_user, no_nd, tgl_nd, tgl_pinjam) VALUES ('".$id_peminjaman."', '".$id_user."', '".$no_nd."', '".$tgl_nd."', '".$saatIni."')");
	}
	
	public function simpanDetail($id_peminjaman, $id_berkas){
		$this->db->query("INSERT INTO tb_detail_peminjaman VALUES ('".$id_peminjaman."', ".$id_berkas.")");
	}
	
	public function daftarPeminjaman(){
		$q = $this->db->query("SELECT 
			a.id_peminjaman,
			a.no_nd,
			a.tgl_nd,
			a.tgl_pinjam,
			a.tgl_selesai,
			a.id_user,
			b.nama 
			FROM tb_peminjaman a LEFT JOIN tb_user b ON (a.id_user = b.id_user) 
			ORDER BY tgl_pinjam");
		
		return $q->result();
	}
	
	public function detail($id_peminjaman){
		$q = $this->db->query("		
			SELECT 
			a.id_peminjaman,
			a.id_berkas,
			b.npwp,
			b.nama_wp,
			c.jenis_berkas,
			concat(b.masa_pajak|b.tahun_pajak) as msthn, 
			b. pembetulan,
			b.id_box,
			d.ruangan 
			FROM tb_detail_peminjaman a LEFT JOIN tb_berkas b ON (a.id_berkas = b.id_berkas) 
			LEFT JOIN tb_jenis_berkas c ON (b.id_jns_berkas = c.id_jns_berkas) 
			LEFT JOIN tb_box d ON (b.id_box = d.id_box) 
			WHERE a.id_peminjaman = '".$id_peminjaman."'");
		
		return $q->result();
	}
	
	public function daftarPeminjamanById($id_user){
		$q = $this->db->query("
			SELECT 
			a.id_peminjaman,
			a.no_nd,
			a.tgl_nd,
			a.tgl_pinjam,
			a.tgl_selesai,
			a.id_user,
			b.nama 
			FROM tb_peminjaman a LEFT JOIN tb_user b ON (a.id_user = b.id_user) 
			WHERE a.id_user = '".$id_user."' ORDER BY tgl_pinjam");
			
		return $q->result();			
	}
	
	public function selesai($id_peminjaman){
		$hari_ini = date("Y-m-d H:i:s");
		
		echo $this->db->query("UPDATE tb_peminjaman SET tgl_selesai = '".$hari_ini."' WHERE id_peminjaman = '".$id_peminjaman."'");	
		echo $this->db->query("UPDATE tb_berkas SET status = '0' WHERE id_berkas IN (SELECT id_berkas FROM tb_peminjaman WHERE id_peminjaman = '".$id_peminjaman."')");	
	}
	
	public function isiNDById($id_peminjaman){
		$q = $this->db->query("SELECT 
			a.id_peminjaman,
			a.no_nd,
			a.tgl_nd,
			a.id_user,
			d.nama,
			b.id_berkas,
			e.jenis_berkas,
			c.npwp,
			c.nama_wp,
			CONCAT(c.masa_pajak,'-',c.tahun_pajak,'(',c.pembetulan,')') AS msthnpbt 
			FROM tb_peminjaman a LEFT JOIN tb_detail_peminjaman b ON (a.id_peminjaman = b.id_peminjaman)
			LEFT JOIN tb_berkas c ON (b.id_berkas = c.id_berkas) 
			LEFT JOIN tb_user d ON (a.id_user = d.id_user) 
			LEFT JOIN tb_jenis_berkas e ON (c.id_jns_berkas = e.id_jns_berkas) 
			WHERE a.id_peminjaman = '".$id_peminjaman."'");
			
		return $q->result();			
	}
	
	public function cariSeksi($id_user){
		$q = $this->db->query("SELECT 
			a.id_user,
			a.nama,
			b.nama_seksi,
			b.nama_kasi 
			FROM tb_user a LEFT JOIN tb_seksi b ON (a.id_seksi = b.id_seksi) 
			WHERE a.id_user = '".$id_user."'");
			
		return $q->result();			
	}
	
	public function simpanStatusDipinjam($id_berkas){
		$query = $this->db->query("UPDATE tb_berkas SET status ='1' WHERE id_berkas = ".$id_berkas);
		
	}
	
}