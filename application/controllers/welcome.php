<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
        $this->load->model('m_laporan');
	}
	
	public function index(){
		$data['jual_bln']=$this->m_laporan->get_bulan_jual();
		$this->load->view('admin/v_index',$data);
	}
	public function ajax_timestamp(){
		$this->load->view('admin/ajax_timestamp');
	}
}