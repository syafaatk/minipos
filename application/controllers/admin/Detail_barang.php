<?php
class Detail_barang extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
		$this->load->model('m_kategori');
		$this->load->model('m_barang');
		$this->load->model('m_satuan');
		$this->load->model('m_beli');
		$this->load->model('m_laporan');
	}
	function index(){
	if($this->session->userdata('akses')=='1'||$this->session->userdata('akses')=='2'||$this->session->userdata('akses')=='3'){
		$data['data']=$this->m_barang->tampil_detail_barang();
		$data['bar']=$this->m_barang->tampil_barang();
		$data['kat']=$this->m_kategori->tampil_kategori();
		$data['sat']=$this->m_satuan->tampil_satuan();
		$data['beli']=$this->m_beli->tampil_beli();
		$data['jual_bln']=$this->m_laporan->get_bulan_jual();
		$this->load->view('admin/v_detail_barang',$data);
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
	function get_detail_barang($id){
	if($this->session->userdata('akses')=='1'||$this->session->userdata('akses')=='2'||$this->session->userdata('akses')=='3'){
		$this->session->set_userdata('id_barang',$id);
		$x['data']=$this->m_barang->tampil_per_detail_barang($id);
		$x['beli']=$this->m_beli->tampil_beli();
		$x['jual_bln']=$this->m_laporan->get_bulan_jual();
		$this->load->view('admin/v_edit_detail_barang',$x);
		$this->session->unset_userdata('id_barang');
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}
	function tambah_detail_barang(){
	if($this->session->userdata('akses')=='1'||$this->session->userdata('akses')=='2'||$this->session->userdata('akses')=='3'){
		$idbrg=$this->input->post('idbrg');
		$iddet=$this->m_barang->get_kodet($idbrg);
		$id=$idbrg.$iddet;
		$lot=$this->input->post('lot');
		$exp=$this->input->post('exp');
		$stok=$this->input->post('stok');
		$harga=$this->input->post('harga');
		$total=$stok*$harga;
		$status=$this->input->post('status');
		$kobel=$this->input->post('belikode');
		$this->m_barang->simpan_detail_barang($id,$idbrg,$lot,$exp,$stok,$harga,$status,$kobel,$total);
		echo $this->session->set_flashdata('msg','Berhasil Tambah Detail Barang dengan Id Barang '.$id.'!');
		echo $this->session->set_flashdata('alert','success');
		redirect('admin/detail_barang');
	}else{
        echo $this->session->set_flashdata('msg','Anda tidak Berhak menambah Data Detail Barang!');
        echo $this->session->set_flashdata('alert','danger');
		redirect('admin/detail_barang');
    }
	}
	function edit_detail_barang(){
	if($this->session->userdata('akses')=='1'||$this->session->userdata('akses')=='2'||$this->session->userdata('akses')=='3'){
		$id=$this->input->post('id');
		$idbrg=$this->input->post('idbrg');
		$lot=$this->input->post('lot');
		$exp=$this->input->post('exp');
		$stok=$this->input->post('stok');
		$stoksekarang=$this->input->post('stoksekarang');
		$harga=$this->input->post('harga');
		$total=($stoksekarang+$stok)*$harga;
		$tgledit=date("Y-m-d H:i:s");
		$tglinput=$this->input->post('tglinput');
		$kobel=$this->input->post('belikode');
		if($stoksekarang>0){
			$status="ada";
		}else{
			$status="habis";
		}
		$this->m_barang->update_detail_barang($id,$idbrg,$lot,$exp,$stok,$harga,$tglinput,$tgledit,$status,$kobel,$total,$stoksekarang);
		echo $this->session->set_flashdata('msg','Edit berhasil pada id detail barang '.$id.'!');
		echo $this->session->set_flashdata('alert','success');
		redirect('admin/detail_barang');
	}else{
		echo $this->session->set_flashdata('msg','Hanya Superadmin yang bisa melakukannya!');
		echo $this->session->set_flashdata('alert','danger');
		redirect('admin/detail_barang');
    }
	}
	function hapus_detail_barang(){
	if($this->session->userdata('akses')=='6'){
		$id=$this->input->post('id');
		$idbrg=$this->input->post('idbrg');
		$stok=$this->input->post('stok');
		$this->m_barang->hapus_detail_barang($id,$idbrg,$stok);
		echo $this->session->set_flashdata('msg','Hapus berhasil pada detail barang '.$id.'!');
		echo $this->session->set_flashdata('alert','success');
		redirect('admin/detail_barang');
	}else{
        echo $this->session->set_flashdata('msg','Anda tidak Berhak menghapus Data Detail Barang!');
        echo $this->session->set_flashdata('alert','danger');
		redirect('admin/detail_barang');
    }
	}
	function habiskan(){
	if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'||$this->session->userdata('akses')=='3'){
		$kode=$this->input->post('kode');
		$this->m_barang->habis_status($kode);
		echo $this->session->set_flashdata('msg','Status Barang '.$nama.' Berhasil dihabiskan');
		echo $this->session->set_flashdata('alert','success');
		redirect('admin/detail_barang');
	}else{
        echo $this->session->set_flashdata('msg','Anda tidak Berhak menghabiskan Data Detail Barang!');
        echo $this->session->set_flashdata('alert','danger');
		redirect('admin/detail_barang');
    }
	}
	function adakan(){
	if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'||$this->session->userdata('akses')=='3'){
		$kode=$this->input->post('kode');
		$this->m_barang->ada_status($kode);
		echo $this->session->set_flashdata('msg','Status Barang '.$nama.' Berhasil diadakan');
		echo $this->session->set_flashdata('alert','success');
		redirect('admin/detail_barang');
	}else{
        echo $this->session->set_flashdata('msg','Anda tidak Berhak menghabiskan Data Detail Barang!');
        echo $this->session->set_flashdata('alert','danger');
		redirect('admin/detail_barang');
    }
	}
}