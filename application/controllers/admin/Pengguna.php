<?php
class Pengguna extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
		$this->load->model('m_pengguna');
		$this->load->model('m_laporan');
	}
	function index(){
	if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
		$data['data']=$this->m_pengguna->get_pengguna();
		$data['jual_bln']=$this->m_laporan->get_bulan_jual();
		$this->load->view('admin/v_pengguna',$data);
	}else{
        echo "Halaman tidak ditemukan";
    }
	}

	function tambah_pengguna(){
	if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
		$nama=$this->input->post('nama');
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		$password2=$this->input->post('password2');
		$level=$this->input->post('level');
		if ($password2 <> $password) {
			echo $this->session->set_flashdata('msg','Password yang Anda Masukan Tidak Sama');
			redirect('admin/pengguna');
		}else{
			$this->m_pengguna->simpan_pengguna($nama,$username,$password,$level);
			echo $this->session->set_flashdata('msg','Pengguna '.$nama.' Berhasil ditambahkan');
			redirect('admin/pengguna');
		}
		
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
	function edit_pengguna(){
	if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
		$kode=$this->input->post('kode');
		$nama=$this->input->post('nama');
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		$password2=$this->input->post('password2');
		$level=$this->input->post('level');
		if (empty($password) && empty($password2)) {
			$this->m_pengguna->update_pengguna_nopass($kode,$nama,$username,$level);
			echo $this->session->set_flashdata('msg','Pengguna '.$nama.' Berhasil diupdate');
			redirect('admin/pengguna');
		}elseif ($password2 <> $password) {
			echo $this->session->set_flashdata('msg','Password yang Anda Masukan Tidak Sama');
			redirect('admin/pengguna');
		}else{
			$this->m_pengguna->update_pengguna($kode,$nama,$username,$password,$level);
			echo $this->session->set_flashdata('msg','Pengguna '.$nama.' Berhasil diupdate');
			redirect('admin/pengguna');
		}
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
	function nonaktifkan(){
	if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
		$kode=$this->input->post('kode');
		$nama=$this->input->post('nama');
		$this->m_pengguna->update_status($kode);
		echo $this->session->set_flashdata('msg','Pengguna '.$nama.' Berhasil dinonaktifkan');
		redirect('admin/pengguna');
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
	function aktifkan(){
	if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
		$kode=$this->input->post('kode');
		$nama=$this->input->post('nama');
		$this->m_pengguna->aktif_status($kode);
		echo $this->session->set_flashdata('msg','Pengguna '.$nama.' Berhasil diaktifkan');
		redirect('admin/pengguna');
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
}