<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Model_pengemasan extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	public function m_daftar_menu(){
		$q = $this->db->query("SELECT * FROM tbl_menu WHERE id_parent = '0' AND aktif='1' ORDER BY CAST(id_menu AS UNSIGNED)");
		return $q->result();
	}
	
	public function m_jumlah_pengemasan(){
		$sql         = $this->db->query("SELECT COUNT(id_pengemasan) AS JML FROM tb_pengemasan WHERE YEAR(tgl_kemas) = YEAR(CURDATE())");
		$hasil_query = $sql->result();
		$hasil       = $hasil_query[0];
		return $hasil->JML;	
	}
	
	public function m_jumlah_register(){
		$sql         = $this->db->query("SELECT COUNT(id) AS JML FROM tb_register WHERE espt='0' AND YEAR(tgl_terima) = YEAR(CURDATE())");
		$hasil_query = $sql->result();
		$hasil       = $hasil_query[0];
		return $hasil->JML;	
	}
	
	public function m_jumlah_pengembalian(){
		$sql         = $this->db->query("SELECT COUNT(id_pengembalian) AS JML FROM tb_pengembalian WHERE YEAR(tgl_terima) = YEAR(CURDATE())");
		$hasil_query = $sql->result();
		$hasil       = $hasil_query[0];
		return $hasil->JML;	
	}
	
	public function m_jumlah_no_lpad(){
		$sql         = $this->db->query("SELECT SUM(jml_spt) AS jumlah FROM tb_pengemasan WHERE YEAR(tgl_kemas) = YEAR(CURDATE())");
		$hasil_query = $sql->result();
		$hasil       = $hasil_query[0];
		return $hasil->jumlah;	
	}
	
	public function m_rekapitulasi(){
		$q = $this->db->query("SELECT tgl_kemas,SUM(CASE WHEN id_spt = 'SPT01' THEN jml_spt ELSE 0 END) AS SPT1771,
			SUM(CASE WHEN id_spt = 'SPT02' THEN jml_spt ELSE 0 END) AS SPT1770,
			SUM(CASE WHEN id_spt = 'SPT03' THEN jml_spt ELSE 0 END) AS SPT1770S,
			SUM(CASE WHEN id_spt = 'SPT04' THEN jml_spt ELSE 0 END) AS SPT1770SS,
			SUM(CASE WHEN id_spt = 'SPT05' THEN jml_spt ELSE 0 END) AS PPH21,
			SUM(CASE WHEN id_spt = 'SPT06' THEN jml_spt ELSE 0 END) AS PPNDM,
			SUM(CASE WHEN id_spt = 'SPT07' THEN jml_spt ELSE 0 END) AS S1771CPT, 
			SUM(CASE WHEN id_spt = 'SPT08' THEN jml_spt ELSE 0 END) AS S1770CPT, 
			SUM(CASE WHEN id_spt = 'SPT09' THEN jml_spt ELSE 0 END) AS S1770SCPT, 
			SUM(CASE WHEN id_spt = 'SPT10' THEN jml_spt ELSE 0 END) AS S1770SSCPT  
			FROM tb_pengemasan 
			GROUP BY tgl_kemas
			ORDER BY tgl_kemas DESC");
		return $q->result();
	}
	
	public function m_daftar_spt(){
		//$q = $this->db->query("SELECT * FROM tb_jns_spt WHERE id_spt NOT IN ('SPT07','SPT08','SPT09','SPT10')");
		$q = $this->db->query("SELECT * FROM tb_jns_spt");
		return $q->result();
	}
	
	public function m_id_kemas(){
		$q = $this->db->query("SELECT MAX(SUBSTR(id_pengemasan,2,4)) AS X FROM tb_pengemasan");
		$hasil_query 	= $q->result();
		$hasil			= $hasil_query[0];
		$hasil1  		= $hasil->X + 1;
		$hasil2			= "K" . sprintf("%04d",$hasil1);
		return $hasil2;
	}
	
	public function m_id_berkas_kembali(){
		$q = $this->db->query("SELECT MAX(SUBSTR(id_berkas,4,7)) AS X FROM tb_detail_pengembalian");
		$hasil_query 	= $q->result();
		$hasil			= $hasil_query[0];
		$hasil1  		= $hasil->X + 1;
		$hasil2			= "SPT" . sprintf("%07d",$hasil1);
		return $hasil2;
	}
	
	public function m_id_pengembalian(){
		$q = $this->db->query("SELECT MAX(SUBSTR(id_pengembalian,4,4)) AS X FROM tb_pengembalian");
		$hasil_query 	= $q->result();
		$hasil			= $hasil_query[0];
		$hasil1  		= $hasil->X + 1;
		$hasil2			= "BLK" . sprintf("%04d",$hasil1);
		return $hasil2;
	}
	
	public function m_simpan_pengemasan($data){
		echo $this->db->insert("tb_pengemasan",$data);
	}
	
	public function m_daftar_pengemasan(){
		/*
		$q = $this->db->query("select a.id_pengemasan,a.id_spt,b.nm_spt,a.bc_kemasan,a.segel_kemasan,DATE_FORMAT(a.tgl_kemas,'%d-%m-%Y') AS ftgl_kemas,a.jml_spt,DATE_FORMAT(a.tgl_diambil,'%d-%m-%Y') AS ftgl_diambil,a.tutup from tb_pengemasan a left join tb_jns_spt b on (a.id_spt = b.id_spt)	order by a.id_pengemasan DESC");
		*/	
		$q = $this->db->query("SELECT 
			a.id_pengemasan,
			a.id_spt,
			b.nm_spt,
			a.bc_kemasan,
			a.segel_kemasan,
			DATE_FORMAT(a.tgl_kemas,'%d-%m-%Y') AS ftgl_kemas,
			a.jml_spt,
			COUNT(c.no_lpad) AS JML_LPAD, 
			DATE_FORMAT(a.tgl_diambil,'%d-%m-%Y') AS ftgl_diambil,
			a.tutup  
			FROM tb_pengemasan a LEFT JOIN tb_jns_spt b ON (a.id_spt = b.id_spt) LEFT JOIN tb_detail_kemasan c ON (a.id_pengemasan = c.id_pengemasan)  
			GROUP BY a.id_pengemasan 
			ORDER BY a.id_pengemasan DESC");
		return $q->result();
	}
	
	public function m_daftar_pengemasan_akuintasi(){
		$q = $this->db->query("select a.id_pengemasan,a.id_spt,b.nm_spt,a.bc_kemasan,a.segel_kemasan,a.tgl_kemas,a.jml_spt,a.tgl_diambil 
			from tb_pengemasan a left join tb_jns_spt b on (a.id_spt = b.id_spt) where a.tutup = '0' 
			order by a.id_pengemasan DESC");
		return $q->result();
	}
	
	public function m_daftar_pegawai(){
		$q = $this->db->query("SELECT id_pegawai,nm_pegawai FROM tb_pegawai where jabatan = 'Pelaksana' ORDER BY nm_pegawai");
		return $q->result();
	}
	
	public function m_daftar_register(){
		$q = $this->db->query("SELECT a.id,b.nm_pegawai,c.nm_spt,a.no_reg,a.jml_spt,DATE_FORMAT(a.tgl_terima,'%d-%m-%Y') AS tglterima, a.id_pengemasan    
			FROM tb_register a LEFT JOIN tb_pegawai b ON (a.id_pegawai = b.id_pegawai) LEFT JOIN tb_jns_spt c ON 
			(a.jns_spt = c.id_spt) WHERE a.espt = '0' ORDER BY DATE(a.tgl_terima) DESC");
		return $q->result();
	}
	
	public function m_reg_hari_ini(){
		$q = $this->db->query("SELECT A.nm_pegawai,
			SUM(CASE WHEN B.jns_spt ='SPT01' THEN B.jml_spt ELSE 0 END) AS S1771,
			SUM(CASE WHEN B.jns_spt ='SPT02' THEN B.jml_spt ELSE 0 END) AS S1770,
			SUM(CASE WHEN B.jns_spt ='SPT03' THEN B.jml_spt ELSE 0 END) AS S1770S,
			SUM(CASE WHEN B.jns_spt ='SPT04' THEN B.jml_spt ELSE 0 END) AS S1770SS,
			SUM(CASE WHEN B.jns_spt ='SPT05' THEN B.jml_spt ELSE 0 END) AS S21,
			SUM(CASE WHEN B.jns_spt ='SPT06' THEN B.jml_spt ELSE 0 END) AS SPPN,
			SUM(CASE WHEN B.jns_spt ='SPT11' THEN B.jml_spt ELSE 0 END) AS S23,
			SUM(CASE WHEN B.jns_spt ='SPT07' THEN B.jml_spt ELSE 0 END) AS S1771CPT,
			SUM(CASE WHEN B.jns_spt ='SPT08' THEN B.jml_spt ELSE 0 END) AS S1770CPT,
			SUM(CASE WHEN B.jns_spt ='SPT09' THEN B.jml_spt ELSE 0 END) AS S1770SCPT,
			SUM(CASE WHEN B.jns_spt ='SPT10' THEN B.jml_spt ELSE 0 END) AS S1770SSCPT,
			SUM(B.jml_spt) AS JML,
			COUNT(no_reg) AS JML_REG 
			FROM tb_pegawai A RIGHT JOIN tb_register B ON (A.id_pegawai = B. id_pegawai)
			WHERE A.jabatan = 'Pelaksana' AND SUBSTR(B.tgl_terima,1,10) = CURDATE() AND b.espt = '0' 
			GROUP BY A.nm_pegawai 
			ORDER BY B.tgl_terima");
		return $q->result();
	}
		
	public function m_reg_by_noreg($noreg){
		$q = $this->db->query("SELECT b.nm_pegawai,c.nm_spt,a.no_reg,a.jml_spt,a.tgl_terima 
			FROM tb_register a LEFT JOIN tb_pegawai b ON (a.id_pegawai = b.id_pegawai) LEFT JOIN tb_jns_spt c ON 
			(a.jns_spt = c.id_spt) WHERE a.no_reg LIKE '%".$noreg."' ORDER BY a.tgl_terima");
		return $q->result();
	}
	
	public function m_reg_by_idpeg($idpeg){
		$q = $this->db->query("SELECT a.id,b.id_pegawai,b.nm_pegawai,c.nm_spt,a.no_reg,a.jml_spt,DATE(a.tgl_terima) AS tgl_terima2  
			FROM tb_register a LEFT JOIN tb_pegawai b ON (a.id_pegawai = b.id_pegawai) LEFT JOIN tb_jns_spt c ON 
			(a.jns_spt = c.id_spt) WHERE b.id_pegawai = '".$idpeg."' AND espt ='0' ORDER BY a.tgl_terima DESC");
		return $q->result();
	}
	
	public function m_reg_by_idpeg_jnsspt($idpeg,$jnsspt){
		$q = $this->db->query("
		SELECT 
		a.id,
		b.id_pegawai,
		b.nm_pegawai,
		c.nm_spt,
		a.no_reg,
		a.jml_spt,
		DATE(a.tgl_terima) AS tgl_terima2,
		CONCAT(d.bc_kemasan,' | ',d.segel_kemasan) AS KMS  
		FROM tb_register a LEFT JOIN tb_pegawai b ON (a.id_pegawai = b.id_pegawai) LEFT JOIN tb_jns_spt c ON (a.jns_spt = c.id_spt) LEFT JOIN tb_pengemasan d ON (a.id_pengemasan = d.id_pengemasan) 
		WHERE b.id_pegawai = '".$idpeg."' AND a.jns_spt = '".$jnsspt."' AND espt ='0' ORDER BY a.tgl_terima DESC");
		return $q->result();
	}
	
	public function m_detail_reg_by_id($id){
		$q = $this->db->query("SELECT 
		a.id,
		b.id_pegawai,
		b.nm_pegawai,
		c.nm_spt,
		a.no_reg,
		a.jml_spt,
		a.tgl_terima 
		FROM tb_register a LEFT JOIN tb_pegawai b ON (a.id_pegawai = b.id_pegawai) 
		LEFT JOIN tb_jns_spt c ON (a.jns_spt = c.id_spt) 
		WHERE a.id = '".$id."' AND espt='0'");
		return $q->result();
	}
	
	public function m_simpan_edit_register($id,$kolom,$nilai){
		$sql = "UPDATE tb_register SET ".$kolom." = '".$nilai."' WHERE id =".$id;
		echo $this->db->query($sql);
	}
	
	public function m_ubahKesSPT($id){
		$sql = "UPDATE tb_register SET espt = '1' WHERE id =".$id;
		echo $this->db->query($sql);
	}
	
	public function m_simpan_induk_pengembalian($data){
		$sql = "INSERT INTO tb_pengembalian (id_pengembalian,no_surat,tgl_terima,jml_spt) 
		VALUES ('".$data['id']."','".$data['no_surat']."','".$data['tgl_terima']."',
		".$data['jml_spt'].")";
		echo $this->db->query($sql);
	}
	
	public function m_simpan_detail_pengembalian($id, $no_lpad, $npwp, $alasan){
		$id_berkas = $this->m_id_berkas_kembali();
		
		$sql = "INSERT INTO tb_detail_pengembalian (id_berkas,id_pengembalian,no_lpad,npwp,alasan,selesai,reg) 
		VALUES ('".$id_berkas."','".$id."','".$no_lpad."','".$npwp."','".$alasan."','0','0')";
		echo $this->db->query($sql);
	}
	
	public function m_rekap_register(){
		$q = $this->db->query("SELECT A.nm_pegawai,
			SUM(CASE WHEN B.jns_spt ='SPT01' THEN B.jml_spt ELSE 0 END) AS S1771,
			SUM(CASE WHEN B.jns_spt ='SPT02' THEN B.jml_spt ELSE 0 END) AS S1770,
			SUM(CASE WHEN B.jns_spt ='SPT03' THEN B.jml_spt ELSE 0 END) AS S1770S,
			SUM(CASE WHEN B.jns_spt ='SPT04' THEN B.jml_spt ELSE 0 END) AS S1770SS,
			SUM(CASE WHEN B.jns_spt ='SPT05' THEN B.jml_spt ELSE 0 END) AS S21,
			SUM(CASE WHEN B.jns_spt ='SPT06' THEN B.jml_spt ELSE 0 END) AS SPPN,
			SUM(CASE WHEN B.jns_spt ='SPT07' THEN B.jml_spt ELSE 0 END) AS S1771CPT,
			SUM(CASE WHEN B.jns_spt ='SPT08' THEN B.jml_spt ELSE 0 END) AS S1770CPT,
			SUM(CASE WHEN B.jns_spt ='SPT09' THEN B.jml_spt ELSE 0 END) AS S1770SCPT,
			SUM(CASE WHEN B.jns_spt ='SPT10' THEN B.jml_spt ELSE 0 END) AS S1770SSCPT,
			SUM(B.jml_spt) AS JML 
			FROM tb_pegawai A RIGHT JOIN tb_register B ON (A.id_pegawai = B. id_pegawai)
			WHERE A.jabatan = 'Pelaksana' AND B.espt = '0' AND YEAR(tgl_terima) = YEAR(CURDATE())   
			GROUP BY A.nm_pegawai");
		return $q->result();
	}
	
	public function m_register_by_kriteria($kriteria, $data){
		if($kriteria = 'id_pengawai'){
			$strKriteria = " WHERE id_pegawai = '".$data."'";
		}elseif($kriteria = 'tgl_terima'){
			$strKriteria = " WHERE tgl_terima = '".$data."'";
		}else{
			$strKriteria = " WHERE jns_spt = '".$data."'";
		}
		
		$q = $this->db->query("SELECT a.id,b.id_pegawai,b.nm_pegawai,c.nm_spt,a.no_reg,a.jml_spt,a.tgl_terima 
			FROM tb_register a LEFT JOIN tb_pegawai b ON (a.id_pegawai = b.id_pegawai) LEFT JOIN tb_jns_spt c ON 
			(a.jns_spt = c.id_spt)".strKriteria." ORDER BY a.tgl_terima");
		return $q->result();
	}
	
	public function m_simpan_register($data){
		$a = $data['id_pegawai'];
		$b = $data['id_spt'];
		// $e = "REG-".strval($data['no_reg']);
		$e = (substr($data['no_reg'],0,2) == "ND" || substr($data['no_reg'],0,2) == "S-" || substr($data['no_reg'],0,2) == "SP") ? $data['no_reg'] : "REG-".strval($data['no_reg']);
		$c = $data['jml_spt'];
		$d = $data['tgl_terima'];
		$f = $data['espt'];
		$g = $data['tgl_reg'];
		
		$sql = "INSERT INTO tb_register (id_pegawai,jns_spt,no_reg,jml_spt,tgl_terima,espt,tgl_reg) VALUES ('".$a."','".$b."','".$e."',".$c.",'".$d."','".$f."','".$g."')";
		echo $this->db->query($sql);
	}
	
	public function m_cari_lpad($x){
		$q = $this->db->query("SELECT a.id_pengemasan,b.no_lpad,a.bc_kemasan,a.segel_kemasan,DATE_FORMAT(a.tgl_kemas,'%d-%m-%Y') AS ftgl_kemas,DATE_FORMAT(a.tgl_diambil,'%d-%m-%Y') AS ftgl_diambil  
				FROM tb_pengemasan a INNER JOIN tb_detail_kemasan b ON (a.id_pengemasan = b.id_pengemasan)
				WHERE b.no_lpad LIKE '" .$x. "%'");
		return $q->result();
	}
	
	public function m_daf_reg_by_pegawai(){
		$q = $this->db->query("select a.id_pegawai,a.nm_pegawai,b.no_reg,b.jml_spt,c.id_spt,c.nm_spt  
			from tb_pegawai a right join tb_register b on (a.id_pegawai = b.id_pegawai) left join tb_jns_spt c on (b.jns_spt = c.id_spt) 
			order by a.nm_pegawai,b.no_reg");
		return $q->result();
	}

	public function m_cari_pengemasan($x){
		$q = $this->db->query("select a.id_pengemasan,a.id_spt,b.nm_spt,a.bc_kemasan,a.segel_kemasan,a.tgl_kemas 
			from tb_pengemasan a left join tb_jns_spt b on (a.id_spt = b.id_spt) where a.id_pengemasan = '".$x."'  
			order by a.id_pengemasan");
		return $q->result();
	}
	
	public function m_cari_reg_by_id_spt($x){
		$q = $this->db->query("select a.id_pegawai,a.nm_pegawai,b.id,b.no_reg,b.jml_spt,DATE_FORMAT(b.tgl_terima,'%d-%m-%Y') AS ftgl_terima,c.id_spt,c.nm_spt,b.id_pengemasan   
			from tb_pegawai a right join tb_register b on (a.id_pegawai = b.id_pegawai) left join tb_jns_spt c on (b.jns_spt = c.id_spt) 
			where b.espt='0' and c.id_spt = '".$x."' and b.id_pengemasan = ''  
			order by a.nm_pegawai,b.no_reg");
		return $q->result();
	}
	
	public function m_simpan_akuintasi($data){
		$a = $data['id_reg'];
		$b = $data['id_pengemasan'];
		
		$sql = "UPDATE tb_register SET id_pengemasan = '".$b."' WHERE id = ".$a;
		echo $this->db->query($sql);
	}
	
	public function m_lengkapi_akuintasi($data){
		$a = $data['id_pengemasan'];
		
		$sql = "UPDATE tb_pengemasan SET tutup = 1 WHERE id_pengemasan = '".$a."'";
		echo $this->db->query($sql);
	}
	
	public function m_daftar_pengembalian(){
		/*
		$q = $this->db->query("SELECT id_pengembalian, no_surat, DATE_FORMAT(tgl_terima,'%d-%m-%Y') AS dtgl_terima, jml_spt FROM tb_pengembalian ORDER BY tgl_terima DESC");
		*/
		$q = $this->db->query("SELECT 
			a.id_pengembalian,
			a.no_surat,
			DATE_FORMAT(a.tgl_terima,'%d-%m-%Y') AS ftgl_terima,
			COUNT(b.id_berkas) AS JML_SPT_KEMBALI,
			SUM(CASE WHEN (b.tgl_terima_tinjut IS NOT NULL && b.tgl_terima_tinjut <> '') THEN 1 ELSE 0 END) AS SDH_TINJUT,
			SUM(CASE WHEN (b.barcode_kemasan IS NOT NULL && b.barcode_kemasan <> '') THEN 1 ELSE 0 END) AS SDH_KEMAS 
			FROM tb_pengembalian a LEFT JOIN tb_detail_pengembalian b ON (a.id_pengembalian = b.id_pengembalian) 
			GROUP BY a.id_pengembalian
			ORDER BY a.id_pengembalian DESC");
		return $q->result();
	}
	
	public function m_daftar_detail_pengembalian(){
		$q = $this->db->query("SELECT  
			a.no_lpad,
			a.npwp,
			a.no_lpad_baru,
			b.id_pengembalian,
			b.no_surat,
			DATE_FORMAT(b.tgl_terima,'%d-%m-%Y') as tglterima, 
			a.barcode_kemasan,
			DATE_FORMAT(c.tgl_kemas,'%d-%m-%Y') as tglkemas,
			a.alasan,
			a.catatan 
			FROM tb_detail_pengembalian a LEFT JOIN tb_pengembalian b on (a.id_pengembalian = b.id_pengembalian) 
			LEFT JOIN tb_pengemasan c on (a.barcode_kemasan = c.bc_kemasan) 
			ORDER by a.id_pengembalian");
		return $q->result();
	}
	
	public function m_pengembalian_by_id($x){
		$q = $this->db->query("SELECT
			b.id_berkas,
			a.id_pengembalian,
			a.no_surat,
			a.tgl_terima,
			b.no_lpad,
			SUBSTRING_INDEX(SUBSTRING_INDEX(b.no_lpad,'/',-4),'/',1) AS jns_spt,
			b.npwp,
			b.alasan,
			b.tgl_kirim_tinjut, 
			b.tgl_terima_tinjut, 
			b.no_lpad_baru,
			b.barcode_kemasan,
			b.catatan,
			b.tgl_email,
			b.selesai 
			FROM tb_pengembalian a LEFT JOIN tb_detail_pengembalian b ON 
			(a.id_pengembalian = b.id_pengembalian) 
			WHERE a.id_pengembalian ='".$x."' 
			ORDER BY a.id_pengembalian,a.no_surat");
		return $q->result();
	}
	
	public function m_simpan_on_blur($a, $b, $c){
		/*
		if($b == "selesai"){
			$sql_cari = $this->db->query("SELECT selesai FROM tb_detail_pengembalian WHERE id_berkas = '".$a."'");
			$nilai    = $sql_cari->result();
			$nilai1   = $nilai[0];
			$nilai_akhir = $nilai1->selesai;
			
			if($nilai_akhir == "0"){
				$sql = "UPDATE tb_detail_pengembalian SET ".$b." = '1' WHERE no_lpad = '".$a."'";
			}else{
				$sql = "UPDATE tb_detail_pengembalian SET ".$b." = '0' WHERE no_lpad = '".$a."'";
			}
		}else{
			//$sql = "UPDATE tb_detail_pengembalian SET ".$b." = '".$c."' WHERE no_lpad = '".$a."'";
			$sql = "UPDATE tb_detail_pengembalian SET ".$b." = '".$c."' WHERE id_berkas = '".$a."'";
		}
		echo $this->db->query($sql);
		*/
		$sql = "UPDATE tb_detail_pengembalian SET ".$b." = '".$c."' WHERE id_berkas = '".$a."'";
		echo $this->db->query($sql);
	}
	
	public function m_simpan_pengambilan($id_pengemasan,$tgl_diambil){
		$sql = "UPDATE tb_pengemasan SET tgl_diambil = '".$tgl_diambil."' WHERE id_pengemasan = '".$id_pengemasan."'";
		echo $this->db->query($sql);
	}
	
	public function m_jml_spt_tb_register(){
		$q = $this->db->query("SELECT id_pengemasan, SUM(jml_spt) FROM tb_register WHERE espt='0' GROUP BY id_pengemasan ORDER BY id_pengemasan");
		return $q->result();
	}
	
	public function m_jml_spt_tb_detail_kemasan(){
		$q = $this->db->query("SELECT id_pengemasan, COUNT(no_lpad) FROM tb_detail_kemasan GROUP BY id_pengemasan ORDER BY id_pengemasan");
		return $q->result();
	}
	
	public function m_jml_spt_by_no_reg(){
		$q = $this->db->query("SELECT 
			SUBSTRING(no_reg,5,8) AS TGL, 
			SUBSTRING(no_reg,5,2) AS XTGL, 
			SUBSTRING(no_reg,7,2) AS XBLN, 
			SUBSTRING(no_reg,9,4) AS XTHN, 
			CONCAT(SUBSTRING(no_reg,7,2),",",SUBSTRING(no_reg,5,2),",",SUBSTRING(no_reg,9,4)) AS LENGKAP,
			STR_TO_DATE(CONCAT(SUBSTRING(no_reg,7,2),",",SUBSTRING(no_reg,5,2),",",SUBSTRING(no_reg,9,4)),'%m,%d,%Y') AS THEDATE,
			SUM(jml_spt) 
			FROM tb_register 
			WHERE SUBSTRING(no_reg,1,3) = 'REG' 
			GROUP BY TGL 
			ORDER BY THEDATE");
		return $q->result();
	}
	
	public function m_jml_spt_by_tgl_terima(){
		$q = $this->db->query("SELECT date(tgl_terima), sum(jml_spt) FROM tb_register GROUP BY date(tgl_terima) ORDER BY tgl_terima");
		return $q->result();
	}
	
	public function m_jml_spt_by_month_all(){
		$q = $this->db->query("SELECT MONTH(tgl_terima) AS BULAN, SUM(jml_spt) AS JML FROM tb_register WHERE espt='0' AND YEAR(tgl_terima) = YEAR(CURDATE()) GROUP BY MONTH(tgl_terima) ORDER BY MONTH(tgl_terima)");
		return $q->result();
	}
	
	public function m_isi_kemasan($barcode){
		$q = $this->db->query("SELECT
			b.bc_kemasan,
			a.id_pengemasan,
			a.no_lpad,
			a.npwp,
			a.nama_wp,
			a.bc_berkas,
			a.jml_lembar 
			FROM tb_detail_kemasan a LEFT JOIN tb_pengemasan b 
			ON (a.id_pengemasan = b.id_pengemasan) 
			WHERE b.bc_kemasan = '" .$barcode."' ORDER BY a.no_lpad");
		return $q->result();
	}
	
	public function m_jml_spt_by_month($kode_spt){
		//$q = $this->db->query("SELECT jns_spt,MONTH(tgl_terima) AS BULAN, SUM(jml_spt) AS JML FROM tb_register WHERE espt='0' AND jns_spt = '".$kode_spt."' GROUP BY MONTH(tgl_terima) ORDER BY MONTH(tgl_terima)");
		
		$q = $this->db->query("SELECT 
			SUM(CASE WHEN MONTH(tgl_terima)='01' THEN jml_spt ELSE 0 END) AS JAN, 
			SUM(CASE WHEN MONTH(tgl_terima)='02' THEN jml_spt ELSE 0 END) AS FEB, 
			SUM(CASE WHEN MONTH(tgl_terima)='03' THEN jml_spt ELSE 0 END) AS MAR, 
			SUM(CASE WHEN MONTH(tgl_terima)='04' THEN jml_spt ELSE 0 END) AS APR, 
			SUM(CASE WHEN MONTH(tgl_terima)='05' THEN jml_spt ELSE 0 END) AS MEI, 
			SUM(CASE WHEN MONTH(tgl_terima)='06' THEN jml_spt ELSE 0 END) AS JUN, 
			SUM(CASE WHEN MONTH(tgl_terima)='07' THEN jml_spt ELSE 0 END) AS JUL, 
			SUM(CASE WHEN MONTH(tgl_terima)='08' THEN jml_spt ELSE 0 END) AS AGT, 
			SUM(CASE WHEN MONTH(tgl_terima)='09' THEN jml_spt ELSE 0 END) AS SEP, 
			SUM(CASE WHEN MONTH(tgl_terima)='10' THEN jml_spt ELSE 0 END) AS OKT, 
			SUM(CASE WHEN MONTH(tgl_terima)='11' THEN jml_spt ELSE 0 END) AS NOV, 
			SUM(CASE WHEN MONTH(tgl_terima)='12' THEN jml_spt ELSE 0 END) AS DES 
			FROM tb_register WHERE espt='0' AND jns_spt = '".$kode_spt."' AND YEAR(tgl_terima) = YEAR(CURDATE())");
		return $q->result();
	}
		
	public function m_tutup_kemasan_akuintasi($id_pengemasan){
		$sql = "UPDATE tb_pengemasan SET tutup = '1' WHERE id_pengemasan = '".$id_pengemasan."'";
		echo $this->db->query($sql);
	}
	
	public function m_show_tables(){
		$q = $this->db->query("SHOW TABLES");
		return $q->result();
	}
	
	public function m_detail_isi_kemasan($segel){
		$q = $this->db->query("SELECT 
			a.id_pengemasan,
			a.bc_kemasan,
			a.segel_kemasan,
			b.no_lpad 
			FROM tb_pengemasan a LEFT JOIN tb_detail_kemasan b 
			ON (a.id_pengemasan = b.id_pengemasan) 
			WHERE a.segel_kemasan = '".$segel."' 
			ORDER BY b.no_lpad");
		return $q->result();
	}
	
	public function m_segel_dari_kemasan($barcode){
		$sql         = $this->db->query("SELECT segel_kemasan FROM tb_pengemasan WHERE bc_kemasan = '".$barcode."'");
		$hasil_query = $sql->result();
		$hasil       = $hasil_query[0];
		return $hasil->segel_kemasan;	
	}
	
	public function m_tglkemas_dari_kemasan($barcode){
		$sql         = $this->db->query("SELECT DATE_FORMAT(tgl_kemas,'%d %M %Y') AS tgl_kemas2 FROM tb_pengemasan WHERE bc_kemasan = '".$barcode."'");
		$hasil_query = $sql->result();
		$hasil       = $hasil_query[0];
		return $hasil->tgl_kemas2;	
	}
	/*
	public function m_register_belum_kemas(){
		$kueri = $this->db->query("SELECT a.jns_spt,b.nm_spt,COUNT(a.no_reg) AS JML_REG,SUM(a.jml_spt) AS JML_SPT  
			FROM tb_register a LEFT JOIN tb_jns_spt b 
			ON (a.jns_spt = b.id_spt) 
			WHERE a.espt = '0' AND a.id_pengemasan =''  
			GROUP BY b.nm_spt 
			ORDER BY a.jns_spt");
		return $kueri->result();
	}
	
	public function m_reg_spt_blm($kode_spt){
		$kueri = $this->db->query("SELECT a.id_pegawai,b.nm_pegawai,a.no_reg,a.jml_spt,DATE_FORMAT(a.tgl_terima,'%d %M %Y') AS TGLTERIMA   
			FROM tb_register a LEFT JOIN tb_pegawai b 
			ON (a.id_pegawai = b.id_pegawai)  
			WHERE espt = '0' AND id_pengemasan ='' 
			AND jns_spt='".$kode_spt."'");
		return $kueri->result();
	}
	*/
	public function m_res_reg_blm_akuin(){
		$kueri = $this->db->query("SELECT 
			MONTH(a.tgl_terima) AS BLNTERIMA,
			c.nm_bulan,
			a.jns_spt AS KDSPT,
			b.nm_spt AS JNSSPT,
			COUNT(a.no_reg) AS JMLREG,
			SUM(a.jml_spt) AS JMLSPT 
			FROM tb_register a LEFT JOIN tb_jns_spt b ON (a.jns_spt = b.id_spt) 
			LEFT JOIN tb_bulan c ON (MONTH(a.tgl_terima) = c.id_bulan) 
			WHERE a.id_pengemasan = '' AND a.espt='0' 
			GROUP BY MONTH(a.tgl_terima),b.nm_spt");
		return $kueri->result();
	}
	
	public function m_res_reg_blm_akuin_by_spt(){
		$kueri = $this->db->query("SELECT 
			a.jns_spt AS KDSPT,
			b.nm_spt AS JNSSPT,
			DATE_FORMAT(MIN(a.tgl_reg),'%d-%m-%Y') AS TGLTERTUA,
			DATE_FORMAT(DATE_ADD(MIN(a.tgl_reg), INTERVAL 30 DAY),'%d-%m-%Y') AS TIGAPLHHARI,
			DATEDIFF(CURDATE(),MIN(a.tgl_reg)) AS SELISIH_HARI,
			COUNT(a.no_reg) AS JMLREG,
			SUM(a.jml_spt) AS JMLSPT 
			FROM tb_register a LEFT JOIN tb_jns_spt b ON (a.jns_spt = b.id_spt) 
			WHERE a.id_pengemasan = '' AND a.espt='0'  
			GROUP BY b.nm_spt 
			ORDER BY a.jns_spt");
		return $kueri->result();
	}
	
	public function m_res_reg_blm_akuin_by_spt2(){
		$kueri = $this->db->query("SELECT 
			a.jns_spt AS KDSPT2,
			b.nm_spt AS JNSSPT2,
			a.no_reg AS NOREG2,
			a.jml_spt AS JMLSPT2 
			FROM tb_register a LEFT JOIN tb_jns_spt b ON (a.jns_spt = b.id_spt) 
			WHERE a.id_pengemasan = '' AND a.espt='0'  
			ORDER BY a.jns_spt");
		return $kueri->result();
	}
	
	public function m_det_reg_blm_akuin($kode_spt,$bulan_terima){
		$kueri = $this->db->query("SELECT 
			a.id,
			b.nm_pegawai,
			a.no_reg,
			a.jml_spt,
			DATE_FORMAT(a.tgl_reg,'%d %M %Y') AS TGLREG,
			DATEDIFF(CURDATE(),a.tgl_terima) AS UMUR,
			DATEDIFF(CURDATE(),a.tgl_reg) AS UMUREG 
			FROM tb_register a LEFT JOIN tb_pegawai b 
			ON (a.id_pegawai = b.id_pegawai)  
			WHERE espt = '0' AND id_pengemasan ='' 
			AND jns_spt='".$kode_spt."' AND MONTH(tgl_terima) ='".$bulan_terima."'");
		return $kueri->result();
	}
	/*
	public function m_daftar_isi_kemasan(){
		$q = $this->db->query("SET lc_time_names = id_ID; SELECT 
			TRIM(b.no_lpad) as nolpad,
			a.bc_kemasan,
			a.segel_kemasan,
			DATE_FORMAT(a.tgl_kemas,'%e %M %Y') 
			FROM tb_pengemasan a LEFT JOIN tb_detail_kemasan b 
			ON (a.id_pengemasan = b.id_pengemasan)
			ORDER BY b.no_lpad");
		return $q->result();
	}
	*/
	public function m_gra_enam_spt(){
		$q = $this->db->query("SELECT SUM(CASE WHEN MONTH(tgl_terima)='01' THEN jml_spt ELSE 0 END) AS JAN, 
			SUM(CASE WHEN MONTH(tgl_terima)='02' THEN jml_spt ELSE 0 END) AS FEB, 
			SUM(CASE WHEN MONTH(tgl_terima)='03' THEN jml_spt ELSE 0 END) AS MAR, 
			SUM(CASE WHEN MONTH(tgl_terima)='04' THEN jml_spt ELSE 0 END) AS APR, 
			SUM(CASE WHEN MONTH(tgl_terima)='05' THEN jml_spt ELSE 0 END) AS MEI, 
			SUM(CASE WHEN MONTH(tgl_terima)='06' THEN jml_spt ELSE 0 END) AS JUN, 
			SUM(CASE WHEN MONTH(tgl_terima)='07' THEN jml_spt ELSE 0 END) AS JUL, 
			SUM(CASE WHEN MONTH(tgl_terima)='08' THEN jml_spt ELSE 0 END) AS AGT, 
			SUM(CASE WHEN MONTH(tgl_terima)='09' THEN jml_spt ELSE 0 END) AS SEP, 
			SUM(CASE WHEN MONTH(tgl_terima)='10' THEN jml_spt ELSE 0 END) AS OKT, 
			SUM(CASE WHEN MONTH(tgl_terima)='11' THEN jml_spt ELSE 0 END) AS NOV, 
			SUM(CASE WHEN MONTH(tgl_terima)='12' THEN jml_spt ELSE 0 END) AS DES 
			FROM tb_register WHERE espt='0' AND jns_spt NOT IN ('SPT07','SPT08','SPT09','SPT10') GROUP BY jns_spt ");
		return $q->result_array();
	}
	/*
	public function m_sks_ditempuh(){
		$q = $this->db->query("SELECT SUM(A.JML_SKS) AS JMLSKS FROM tb_makul A LEFT JOIN tb_nilai B ON (A.KD_MAKUL = B.KD_MAKUL) WHERE B.NILAI NOT IN ('D','E')");
		$hasil_query = $q->result();
		$hasil = $hasil_query[0];
		return $hasil->JMLSKS;	
	}
	
	public function m_cek_duplikasi($kdmakul,$ujianke){
		$x = $this->db->query("SELECT * FROM tb_nilai WHERE KD_MAKUL='$kdmakul' AND UJIAN_KE='$ujianke'");
		return $x->num_rows();
	}
	*/
	public function m_simpanUbahanStatusRegister($id_register,$alasan){
		$sql = "UPDATE tb_register SET catatan = '".$alasan."', espt = '1' WHERE id = ".$id_register."";
		echo $this->db->query($sql);
	}

	public function m_res_kemasan_blm_diambil(){
		$qry = $this->db->query("SELECT a.id_spt,b.nm_spt AS JNSSPT,COUNT(a.id_pengemasan) AS JMLKEMASAN 
		FROM tb_pengemasan a LEFT JOIN tb_jns_spt b ON (a.id_spt = b.id_spt) 
		WHERE a.tgl_diambil is null 
		GROUP BY b.nm_spt
		ORDER BY a.id_spt");
		return $qry->result();
	}

	public function m_det_kemasan_blm_diambil($id_spt){
		$qry = $this->db->query("SELECT * FROM tb_pengemasan WHERE tgl_diambil IS NULL AND id_spt = '".$id_spt."' ORDER BY tgl_kemas");
		return $qry->result();
	}
	
	public function m_cetak_checklist(){
		$qry = $this->db->query("SELECT 
			b.nm_spt AS JNSSPT,
			a.bc_kemasan,
			a.segel_kemasan,
			date(a.tgl_kemas) as dtglkemas,
			a.jml_spt 
			FROM tb_pengemasan a LEFT JOIN tb_jns_spt b ON (a.id_spt = b.id_spt) 
			WHERE a.tgl_diambil IS NULL
			ORDER BY a.id_pengemasan");
		return $qry->result();
	}
	
	public function m_cetak_lpad_baru(){
		$qry = $this->db->query("SELECT 
			id_berkas,
			npwp,
			no_lpad,
			no_lpad_baru,
			alasan 
			FROM tb_detail_pengembalian 
			WHERE no_lpad_baru IS NOT NULL AND no_lpad_baru <> '' 
			AND tgl_terima_tinjut > '2018-08-01'
			ORDER BY id_pengembalian, id_berkas");
		return $qry->result();
	}
	
	public function m_cetak_pengembalian_blm_kemas(){
		$qry = $this->db->query("select 
			a.id_berkas,
			b.no_surat,
			date(b.tgl_terima) as tgl_terima_sp,
			a.no_lpad,
			a.npwp,
			a.alasan 
			from tb_detail_pengembalian a left join tb_pengembalian b on (a.id_pengembalian = b.id_pengembalian) 
			where barcode_kemasan ='' and selesai ='0' 
			order by a.id_berkas desc");
		return $qry->result();
	}
	
	public function m_buat_email(){
		$qry = $this->db->query("SELECT 
			no_lpad AS NO_LPAD_LAMA,
			no_lpad_baru AS NO_LPAD_BARU,
			'526' AS KODE_KPP,
			alasan AS KETERANGAN 
			FROM tb_detail_pengembalian
			WHERE tgl_terima_tinjut > '2018-08-01' AND
			no_lpad_baru <> '' ORDER BY id_berkas");
		return $qry->result();
	}
	
	public function m_daftar_tgl_tinjut(){
		$qry = $this->db->query("SELECT DISTINCT(tgl_terima_tinjut) AS DAF_TGL_TINJUT FROM tb_detail_pengembalian 
		WHERE tgl_terima_tinjut IS NOT NULL AND tgl_terima_tinjut <> '' AND tgl_terima_tinjut <> '0000-00-00' AND tgl_terima_tinjut <> '-' ORDER BY tgl_terima_tinjut");
		return $qry->result();
	}
	
	public function m_daftar_tgl($tgl){
		$qry = $this->db->query("SELECT 
			no_lpad AS NO_LPAD_LAMA,
			no_lpad_baru AS NO_LPAD_BARU,
			'526' AS KODE_KPP,
			alasan AS KETERANGAN 
			FROM tb_detail_pengembalian
			WHERE tgl_terima_tinjut IN (".$tgl.") AND
			no_lpad_baru <> '' AND
			no_lpad_baru <> '-' ORDER BY id_berkas");
		return $qry->result();
	}
	
	public function m_pengembalian_blm_terima(){
		$qry = $this->db->query("SELECT 
			b.no_surat,
			a.no_lpad,
			a.no_lpad_baru,
			a.npwp,
			a.alasan,
			a.tgl_terima_tinjut 
			FROM tb_detail_pengembalian a LEFT JOIN tb_pengembalian b ON (a.id_pengembalian = b.id_pengembalian)
			WHERE a.tgl_terima_tinjut IS NULL AND a.selesai = '0' AND b.tgl_terima BETWEEN '2018-06-01' AND CURDATE()
			ORDER BY b.no_surat");
		return $qry->result();
	}
	
	public function m_ubah_selesai($id_berkas){
		$qry = "UPDATE tb_detail_pengembalian SET selesai = '1' WHERE id_berkas = '".$id_berkas."'";
		echo $this->db->query($qry);
	}
	
	public function m_reg_bulan_ini(){
		$qry = $this->db->query("SELECT	
			CONCAT(DATE_FORMAT(tgl_terima,'%d/%m'),'-',SUBSTR(DAYNAME(tgl_terima),1,2)) AS TGL,
			SUM(CASE WHEN (jns_spt = 'SPT01' OR jns_spt = 'SPT02') THEN jml_spt ELSE 0 END) AS JMLSPTTHN,
			SUM(CASE WHEN (jns_spt = 'SPT03' OR jns_spt = 'SPT04' OR jns_spt = 'SPT05' OR jns_spt = 'SPT06' OR jns_spt = 'SPT11') 
			THEN jml_spt ELSE 0 END) AS JMLSPTMASA 
			FROM tb_register 
			WHERE espt='0' AND DATE_FORMAT(tgl_terima,'%m') = MONTH(CURDATE()) AND YEAR(tgl_terima) = YEAR(CURDATE()) 
			GROUP BY TGL
			ORDER BY tgl_terima");
		return $qry->result();
	}
	
	public function m_bandingkan_dua_tahun($jns_spt){		
		$qry = $this->db->query("SELECT	
			DATE_FORMAT(tgl_terima,'%m') AS BULAN,
			SUM(CASE WHEN ((jns_spt = '".$jns_spt."') AND YEAR(tgl_terima)= YEAR(CURDATE())-1) THEN jml_spt ELSE 0 END) AS JSPTPAST,
			SUM(CASE WHEN ((jns_spt = '".$jns_spt."') AND YEAR(tgl_terima)= YEAR(CURDATE())) THEN jml_spt ELSE 0 END) AS JSPTNOW  
			FROM tb_register 
			WHERE espt='0' 
			GROUP BY BULAN  
			ORDER BY BULAN");
		return $qry->result();
	}
	
	public function m_masaTahunanDi2Tahun(){
		/*
		$qry = $this->db->query("SELECT
			SUM(CASE WHEN (jns_spt = 'SPT01' || jns_spt = 'SPT02' || jns_spt = 'SPT03' || jns_spt = 'SPT04') THEN jml_spt ELSE 0 END) AS SPTTAHUNAN,
			SUM(CASE WHEN (jns_spt = 'SPT05' || jns_spt = 'SPT06' || jns_spt = 'SPT11') THEN jml_spt ELSE 0 END) AS SPTMASA
			FROM tb_register WHERE espt='0' 
			GROUP BY YEAR(tgl_terima)");
		*/	
		$qry = $this->db->query("SELECT
			CASE WHEN jns_spt='SPT01' || jns_spt='SPT02' || jns_spt='SPT03' || jns_spt='SPT04' THEN 'SPTTHN' 
			WHEN jns_spt='SPT05' || jns_spt='SPT06' || jns_spt='SPT11' THEN 'SPTMASA'
			ELSE 'SPTLAIN' END AS JNSSPT, 
			SUM(CASE WHEN YEAR(tgl_terima) = YEAR(CURDATE()) THEN jml_spt ELSE 0 END) AS S2019,
			SUM(CASE WHEN YEAR(tgl_terima) = YEAR(CURDATE())-1 THEN jml_spt ELSE 0 END) AS S2018
			FROM tb_register WHERE espt='0' 
			GROUP BY JNSSPT");
		return $qry->result();
	}
	
	public function m_grafik_register($kriteria = "MONTH(CURDATE())"){
		
		$qry = $this->db->query("SELECT 
			CONCAT(date_format(tgl_terima,'%d/%m'),'-',
			SUBSTR(DAYNAME(tgl_terima),1,2)) as TGL,
			SUM(jml_spt) as JML_REG 
			from tb_register 
			WHERE MONTH(tgl_terima) = ".$kriteria."  AND YEAR(tgl_terima) = YEAR(CURDATE()) 
			GROUP BY DATE(tgl_terima) 
			ORDER BY DATE(tgl_terima)");
		return $qry->result();
	}
	
	public function m_grafik_register2($kriteria = "MONTH(CURDATE())"){
		$qry = $this->db->query("select 
			CONCAT(date_format(tgl_terima,'%d/%m'),'-',SUBSTR(DAYNAME(tgl_terima),1,2)) as TGL,
			sum(case when jns_spt = 'SPT01' then jml_spt else 0 end) as JMLSPT1,
			sum(case when jns_spt = 'SPT02' then jml_spt else 0 end) as JMLSPT2,
			sum(case when jns_spt = 'SPT03' then jml_spt else 0 end) as JMLSPT3,
			sum(case when jns_spt = 'SPT04' then jml_spt else 0 end) as JMLSPT4,
			sum(case when jns_spt = 'SPT05' then jml_spt else 0 end) as JMLSPT5,
			sum(case when jns_spt = 'SPT06' then jml_spt else 0 end) as JMLSPT6,
			sum(case when jns_spt = 'SPT11' then jml_spt else 0 end) as JMLSPT7 
			from tb_register 
			where espt='0' and date_format(tgl_terima,'%m') = '".$kriteria."' AND YEAR(tgl_terima) = YEAR(CURDATE()) 
			group by TGL
			order by tgl_terima");
		return $qry->result();
	}
	
	public function m_grafik_register_per_bulan(){
		$qry = $this->db->query("SELECT 
			DATE_FORMAT(tgl_terima,'%m') AS BULAN,
			SUM(CASE WHEN jns_spt = 'SPT01' THEN jml_spt ELSE 0 END) AS JML_SPT1, 
			SUM(CASE WHEN jns_spt = 'SPT02' THEN jml_spt ELSE 0 END) AS JML_SPT2, 
			SUM(CASE WHEN jns_spt = 'SPT03' THEN jml_spt ELSE 0 END) AS JML_SPT3, 
			SUM(CASE WHEN jns_spt = 'SPT04' THEN jml_spt ELSE 0 END) AS JML_SPT4, 
			SUM(CASE WHEN jns_spt = 'SPT05' THEN jml_spt ELSE 0 END) AS JML_SPT5, 
			SUM(CASE WHEN jns_spt = 'SPT06' THEN jml_spt ELSE 0 END) AS JML_SPT6, 
			SUM(CASE WHEN jns_spt = 'SPT11' THEN jml_spt ELSE 0 END) AS JML_SPT7  
			FROM tb_register 
			WHERE espt='0' AND YEAR(tgl_terima) = YEAR(CURDATE()) 
			GROUP BY BULAN");
		return $qry->result();
	}
	
	public function m_load_spt_kembali($kode_spt){
		$qry = $this->db->query("SELECT a.id_berkas,
			CONCAT(SUBSTR(a.no_lpad,1,10),'/',SUBSTR(a.no_lpad,-4)) AS  lpad,
			CONCAT(SUBSTR(a.no_lpad_baru,1,10),'/',SUBSTR(a.no_lpad_baru,-4)) AS  lpad_baru,
			SUBSTRING_INDEX(SUBSTRING_INDEX(a.no_lpad,'/',-4),'/',1) AS jns_spt,
			b.no_surat,
			DATE(b.tgl_terima) AS dtgl_terima 
			FROM tb_detail_pengembalian a RIGHT JOIN tb_pengembalian b ON (a.id_pengembalian = b.id_pengembalian)  
			WHERE a.selesai = '0' AND a.kode_spt = '".$kode_spt."' AND a.reg ='0' AND YEAR(b.tgl_terima) = YEAR(CURDATE()) 
			ORDER BY b.tgl_terima,lpad DESC");
		return $qry->result();
	}
	
	public function m_grafik_register2jenis($kriteria = "MONTH(CURDATE())"){
		$qry = $this->db->query("SELECT	
			CONCAT(DATE_FORMAT(tgl_terima,'%d/%m'),'-',SUBSTR(DAYNAME(tgl_terima),1,2)) AS TGL,
			SUM(CASE WHEN (jns_spt = 'SPT01' OR jns_spt = 'SPT02' OR jns_spt = 'SPT03' OR jns_spt = 'SPT04') THEN jml_spt ELSE 0 END) AS JMLSPTTHN,
			SUM(CASE WHEN (jns_spt = 'SPT05' OR jns_spt = 'SPT06' OR jns_spt = 'SPT11') 
			THEN jml_spt ELSE 0 END) AS JMLSPTMASA 
			FROM tb_register 
			WHERE espt='0' AND DATE_FORMAT(tgl_terima,'%m') = '".$kriteria."'
			GROUP BY TGL
			ORDER BY tgl_terima");
		return $qry->result();
	}
	
	public function m_cari_namawp(){
		$qry = $this->db->query("select 
			a.nama_wp,
			a.npwp,
			a.no_lpad, 	
			b.bc_kemasan,
			b.segel_kemasan,
			b.tgl_kemas,
			b.tgl_diambil 
			from tb_detail_kemasan a left join tb_pengemasan b on (a.id_pengemasan = b.id_pengemasan)
			where a.nama_wp is not null 
			order by a.nama_wp");
		return $qry->result();
	}
	
	public function m_cari_nama_wp($x){
		$qry = $this->db->query("SELECT  
			a.nama_wp,
			a.npwp,
			a.no_lpad, 	
			b.bc_kemasan,
			b.segel_kemasan,
			date_format(b.tgl_kemas,'%d-%m-%Y') AS ftgl_kemas,
			date_format(b.tgl_diambil,'%d-%m-%Y') AS ftgl_diambil 
			FROM tb_detail_kemasan a LEFT JOIN tb_pengemasan b ON (a.id_pengemasan = b.id_pengemasan)
			WHERE a.nama_wp IS NOT NULL AND a.nama_wp LIKE '%".$x."%'  
			ORDER by a.nama_wp");
		return $qry->result();
	}
}