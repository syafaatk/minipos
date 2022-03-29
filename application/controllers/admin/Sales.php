<?php
class Sales extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
		$this->load->model('m_sales');
		$this->load->model('m_laporan');
	}
	function index(){
	if($this->session->userdata('akses')=='1'||$this->session->userdata('akses')=='2'||$this->session->userdata('akses')=='4'){
		$data['data']=$this->m_sales->tampil_sales();
		$data['jual_bln']=$this->m_laporan->get_bulan_jual();
		$this->load->view('admin/v_sales',$data);
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
	function tambah_sales(){
	if($this->session->userdata('akses')=='1'||$this->session->userdata('akses')=='2'||$this->session->userdata('akses')=='4'){
		$nama=$this->input->post('nama');
		$alamat=$this->input->post('alamat');
		$notelp=$this->input->post('notelp');
		$nonpwp=$this->input->post('nonpwp');
		$this->m_sales->simpan_sales($nama,$alamat,$notelp,$nonpwp);
		echo $this->session->set_flashdata('msg','Berhasil Tambah Sales Nama: '.$nama.'!');
		echo $this->session->set_flashdata('alert','success');
		redirect('admin/sales');
	}else{
        echo $this->session->set_flashdata('msg','Anda tidak Berhak Menambah Data Sales');
		echo $this->session->set_flashdata('alert','danger');
		redirect('admin/sales');
    }
	}
	function edit_sales(){
	if($this->session->userdata('akses')=='1'||$this->session->userdata('akses')=='2'||$this->session->userdata('akses')=='4'){
		$kode=$this->input->post('kode');
		$nama=$this->input->post('nama');
		$alamat=$this->input->post('alamat');
		$notelp=$this->input->post('notelp');
		$nonpwp=$this->input->post('nonpwp');
		echo $this->session->set_flashdata('msg','Berhasil Mengedit Sales '.$nama.'!');
		echo $this->session->set_flashdata('alert','success');
		$this->m_sales->update_sales($kode,$nama,$alamat,$notelp,$nonpwp);
		redirect('admin/sales');
	}else{
        echo $this->session->set_flashdata('msg','Anda tidak Berhak Mengedit Data Sales!');
        echo $this->session->set_flashdata('alert','danger');
		redirect('admin/sales');
    }
	}
	function hapus_sales(){
	if($this->session->userdata('akses')=='6'){
		$kode=$this->input->post('kode');
		$nama=$this->input->post('nama');
		echo $this->session->set_flashdata('msg','Berhasil Menghapus Sales '.$nama.'!');
		echo $this->session->set_flashdata('alert','success');
		$this->m_sales->hapus_sales($kode);
		redirect('admin/sales');
	}else{
        echo $this->session->set_flashdata('msg','Anda tidak Berhak Menghapus Data Sales!');
        echo $this->session->set_flashdata('alert','danger');
		redirect('admin/sales');
    }
	}
}