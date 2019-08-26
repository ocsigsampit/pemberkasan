<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Er4044 extends CI_Controller
{
	public function index(){
		if($this->session->userdata('status_login')=="ON"){
			$data['info_error']   = "Maaf, halaman tidak ditemukan";
			$this->load->view('pemberkasan/error_page',$data);
		}else{
			redirect('auth');
		}
	}

}