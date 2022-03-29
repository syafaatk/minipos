<?php
class Pelanggan extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
		$this->load->model('m_pelanggan');
		$this->load->model('m_laporan');
	}
	function index(){
	if($this->session->userdata('akses')=='1'||$this->session->userdata('akses')=='2'||$this->session->userdata('akses')=='4'){
		$data['data']=$this->m_pelanggan->tampil_pelanggan();
		$data['jual_bln']=$this->m_laporan->get_bulan_jual();
		$this->load->view('admin/v_pelanggan',$data);
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
	function tambah_pelanggan(){
	if($this->session->userdata('akses')=='1'||$this->session->userdata('akses')=='2'||$this->session->userdata('akses')=='4'){
		$nama=$this->input->post('nama');
		$alamat=$this->input->post('alamat');
		$notelp=$this->input->post('notelp');
		$nonpwp=$this->input->post('nonpwp');
		echo $this->session->set_flashdata('msg','Berhasil Tambah Pelanggan Nama: '.$nama.'!');
		echo $this->session->set_flashdata('alert','success');
		$this->m_pelanggan->simpan_pelanggan($nama,$alamat,$notelp,$nonpwp);
		redirect('admin/pelanggan');
		}else{
        echo $this->session->set_flashdata('msg','Anda tidak Berhak Menambah Data Pelanggan');
		echo $this->session->set_flashdata('alert','danger');
		redirect('admin/pelanggan');
		}
	}
	function edit_pelanggan(){
	if($this->session->userdata('akses')=='1'||$this->session->userdata('akses')=='2'||$this->session->userdata('akses')=='4'){
		$kode=$this->input->post('kode');
		$nama=$this->input->post('nama');
		$alamat=$this->input->post('alamat');
		$notelp=$this->input->post('notelp');
		$nonpwp=$this->input->post('nonpwp');
		echo $this->session->set_flashdata('msg','Berhasil Edit Pelanggan Nama: '.$nama.'!');
		echo $this->session->set_flashdata('alert','success');
		$this->m_pelanggan->update_pelanggan($kode,$nama,$alamat,$notelp,$nonpwp);
		redirect('admin/pelanggan');
	}else{
        echo $this->session->set_flashdata('msg','Anda tidak Berhak Mengedit Data Pelanggan');
		echo $this->session->set_flashdata('alert','danger');
		redirect('admin/pelanggan');
    }
	}
	function hapus_pelanggan(){
	if( $this->session->userdata('akses')=='6'){
		$kode=$this->input->post('kode');
		$nama=$this->input->post('nama');
		echo $this->session->set_flashdata('msg','Berhasil Hapus Pelanggan Nama: '.$nama.'!');
		echo $this->session->set_flashdata('alert','success');
		$this->m_pelanggan->hapus_pelanggan($kode);
		redirect('admin/pelanggan');
	}else{
        echo $this->session->set_flashdata('msg','Anda tidak Berhak Menghapus Data Pelanggan');
		echo $this->session->set_flashdata('alert','danger');
		redirect('admin/pelanggan');
    }
	}
}