<?php
class Barang extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
		$this->load->model('m_kategori');
		$this->load->model('m_barang');
		$this->load->model('m_satuan');
		$this->load->model('m_laporan');
	}
	function index(){
	if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2' || $this->session->userdata('akses')=='3'|| $this->session->userdata('akses')=='4'){
		$data['data']=$this->m_barang->tampil_barang();
		$data['kat']=$this->m_kategori->tampil_kategori();
		$data['sat']=$this->m_satuan->tampil_satuan();
		$data['jual_bln']=$this->m_laporan->get_bulan_jual();
		$this->load->view('admin/v_barang',$data);
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
	function get_barang($id){
	if($this->session->userdata('akses')=='1'||$this->session->userdata('akses')=='2'||$this->session->userdata('akses')=='3'){
		$this->session->set_userdata('id_barang',$id);
		$x['data']=$this->m_barang->get_barang($id);
		$x['jual_bln']=$this->m_laporan->get_bulan_jual();
		$this->load->view('admin/v_edit_barang',$x);
		$this->session->unset_userdata('id_barang');
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}
	function get_detail_barang($id){
	if($this->session->userdata('akses')=='1'||$this->session->userdata('akses')=='2'||$this->session->userdata('akses')=='3'|| $this->session->userdata('akses')=='4'){
		$this->session->set_userdata('id_barang',$id);
		$x['data']=$this->m_barang->tampil_d_barang_all($id);
		$x['jual_bln']=$this->m_laporan->get_bulan_jual();
		$x['data_jual']=$this->m_laporan->get_data_penjualan();
		$this->load->view('admin/v_opname_barang',$x);
		$this->session->unset_userdata('id_barang');
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}

	function tambah_barang(){
	if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2' || $this->session->userdata('akses')=='3'){
		$idkat=$this->input->post('idkat');
		$id=$this->m_barang->get_kobar($idkat);
		$nm=$this->input->post('nm');
		$spc=$this->input->post('spc');
		$idsat=$this->input->post('idsat');
		$stok=$this->input->post('stok');
		$this->m_barang->simpan_barang($id,$nm,$spc,$idsat,$idkat,$stok);
		echo $this->session->set_flashdata('msg','Berhasil Tambah Barang dengan Id Barang '.$id.'-'.$nm.'-'.$spc.'!');
		echo $this->session->set_flashdata('alert','success');
		redirect('admin/barang');
	}else{
        echo $this->session->set_flashdata('msg','Anda tidak Berhak menambah Data Barang!');
        echo $this->session->set_flashdata('alert','danger');
		redirect('admin/barang');
    }
	}
	function edit_barang(){
	if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2' || $this->session->userdata('akses')=='3'){
		$id=$this->input->post('id');
		$idkat=$this->input->post('idkat');
		$nm=$this->input->post('nm');
		$spc=$this->input->post('spc');
		$idsat=$this->input->post('idsat');
		$stok=$this->input->post('stok');
		echo $this->session->set_flashdata('msg','Berhasil Edit Barang dengan Id Barang '.$id.'-'.$nm.'-'.$spc.'!');
		echo $this->session->set_flashdata('alert','success');
		$this->m_barang->update_barang($id,$nm,$spc,$idsat,$idkat,$stok);
		redirect('admin/barang');
	}else{
        echo $this->session->set_flashdata('msg','Anda tidak Berhak mengedit Data Barang!');
        echo $this->session->set_flashdata('alert','danger');
		redirect('admin/barang');
    }
	}
	function hapus_barang(){
	if($this->session->userdata('akses')=='6'){
		$kode=$this->input->post('kode');
		$this->m_barang->hapus_barang($kode);
		echo $this->session->set_flashdata('msg','Berhasil Hapus Barang!');
		echo $this->session->set_flashdata('alert','success');
		redirect('admin/barang');
	}else{
        echo $this->session->set_flashdata('msg','Anda tidak Berhak menghapus Data Barang!');
        echo $this->session->set_flashdata('alert','danger');
		redirect('admin/barang');
    }
	}
}