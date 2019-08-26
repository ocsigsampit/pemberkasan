<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Model_upload extends CI_Model {
		public function __construct() {
			parent::__construct();
			$this->load->database();
		}

		public function m_kategori(){
			$q=$this->db->query("SELECT * FROM kategori WHERE kategori<> 'Artikel' ORDER BY kategori");
			$hasil=$q->result();
			return $hasil;
		}

		public function m_simpan_data_upload($data){
			$this->db->insert('posting',$data);
		}

		public function m_cari_id_posting_baru() {
			$q=$this->db->query("select max(id_posting) as X from posting");
			if($q->num_rows()>0){
				foreach ($q->result() as $r) {
					$tmp=(int)substr($r->X,2,4)+1;
					$id_baru="P".sprintf("%04d",$tmp);
				}
			}else{
				$id_baru="P0001";
			}

			return $id_baru;

		}

	}
?>