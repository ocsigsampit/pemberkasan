<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_auth extends CI_Model{
	
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function dataPengguna($nama,$kunci) {
		$md5Kunci = md5($kunci);
		
		$this->db->select('*');
		$this->db->from('tb_user');
		$this->db->where('login_name',$nama);
		$this->db->where('kunci',$md5Kunci);
		$query = $this->db->get();

		return $query;
	}

}