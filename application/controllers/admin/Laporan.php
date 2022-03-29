<?php
class Laporan extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
		$this->load->model('m_kategori');
		$this->load->model('m_barang');
		$this->load->model('m_sales');
		$this->load->model('m_suplier');
		$this->load->model('m_pelanggan');
		$this->load->model('m_pembelian');
		$this->load->model('m_penjualan');
		$this->load->model('m_laporan');
	}
	function index(){
	if($this->session->userdata('akses')=='1'||$this->session->userdata('akses')=='2'||$this->session->userdata('akses')=='5'){
		$data['data']=$this->m_barang->tampil_barang();
		$data['sales']=$this->m_sales->tampil_sales();
		$data['principal']=$this->m_suplier->tampil_suplier();
		$data['pelanggan']=$this->m_pelanggan->tampil_pelanggan();
		$data['kat']=$this->m_kategori->tampil_kategori();
		$data['jual_bln']=$this->m_laporan->get_bulan_jual();
		$data['beli_bln']=$this->m_laporan->get_bulan_beli();
		$data['jual_thn']=$this->m_laporan->get_tahun_jual();
		$this->load->view('admin/v_laporan',$data);
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
	function lap_stok_barang(){
		$x['data']=$this->m_laporan->get_stok_barang();
		$this->load->view('admin/laporan/v_lap_stok_barang',$x);
	}
	function lap_data_barang(){
		$x['data']=$this->m_laporan->get_data_barang();
		$this->load->view('admin/laporan/v_lap_barang',$x);
	}
	function lap_data_penjualan(){
		$x['data']=$this->m_laporan->get_data_penjualan();
		$x['jml']=$this->m_laporan->get_total_penjualan();
		$this->load->view('admin/laporan/v_lap_penjualan',$x);
	}
//=====================================================
	function lap_data_penjualan_sales(){
		$sales=$this->input->post('sales');
		$bulan=$this->input->post('bln');
		$x['tombol']=$this->input->post('tombol');
		$x['data']=$this->m_laporan->get_penjualan_by_sales($sales,$bulan);
		$x['jml']=$this->m_laporan->get_total_penjualan_by_sales($sales,$bulan);
		$x['jmlretur']=$this->m_laporan->get_total_penjualan_by_sales_retur($sales,$bulan);
		$this->load->view('admin/laporan/v_lap_jual_sales',$x);
	}
	function lap_data_pembelian_principal(){
		$principal=$this->input->post('principal');
		$bulan=$this->input->post('bln');
		$x['tombol']=$this->input->post('tombol');
		$x['data']=$this->m_laporan->get_pembelian_by_principal($principal,$bulan);
		$x['jml']=$this->m_laporan->get_total_pembelian_by_principal($principal,$bulan);
		$this->load->view('admin/laporan/v_lap_beli_principal',$x);
	}
	function lap_data_pembelian_pelanggan(){
		$pelanggan=$this->input->post('pelanggan');
		$kategori=$this->input->post('kategori');
		$bulan=$this->input->post('bln');
		$x['tombol']=$this->input->post('tombol');
		if($kategori=='NULL'){
			$x['data']=$this->m_laporan->get_pembelian_by_pelanggan($pelanggan,$kategori,$bulan);
			$x['detail']=$this->m_laporan->detail_faktur();
			$x['jml']=$this->m_laporan->get_total_pembelian_by_pelanggan($pelanggan,$kategori,$bulan);
			$x['jmlretur']=$this->m_laporan->get_total_pembelian_by_pelanggan_retur($pelanggan,$bulan);
			$this->load->view('admin/laporan/v_lap_beli_pelanggan_seluruh',$x);
		}else{
			$x['data']=$this->m_laporan->get_pembelian_by_pelanggan($pelanggan,$kategori,$bulan);
			$x['detail']=$this->m_laporan->detail_faktur();
			$x['jml']=$this->m_laporan->get_total_pembelian_by_pelanggan($pelanggan,$kategori,$bulan);
			$x['jmlretur']=$this->m_laporan->get_total_pembelian_by_pelanggan_retur($pelanggan,$bulan);
			$this->load->view('admin/laporan/v_lap_beli_pelanggan',$x);	
		}
	}
	function lap_data_penjualan_kategori(){
		$kategori=$this->input->post('kategori');
		$bulan=$this->input->post('bln');
		$x['tombol']=$this->input->post('tombol');
		$x['data']=$this->m_laporan->get_penjualan_by_kategori($kategori,$bulan);
		$x['jml']=$this->m_laporan->get_total_penjualan_by_kategori($kategori,$bulan);
		$this->load->view('admin/laporan/v_lap_jual_kategori',$x);
	}
//=====================================================
	function lap_penjualan_pertanggal(){
		$tanggal=$this->input->post('tgl');
		$x['jml']=$this->m_laporan->get_data__total_jual_pertanggal($tanggal);
		$x['data']=$this->m_laporan->get_data_jual_pertanggal($tanggal);
		$this->load->view('admin/laporan/v_lap_jual_pertanggal',$x);
	}
	function lap_penjualan_perbulan(){
		$bulan=$this->input->post('bln');
		$x['jml']=$this->m_laporan->get_total_jual_perbulan($bulan);
		$x['data']=$this->m_laporan->get_jual_perbulan($bulan);
		$this->load->view('admin/laporan/v_lap_jual_perbulan',$x);
	}
	function lap_penjualan_pertahun(){
		$tahun=$this->input->post('thn');
		$x['jml']=$this->m_laporan->get_total_jual_pertahun($tahun);
		$x['data']=$this->m_laporan->get_jual_pertahun($tahun);
		$this->load->view('admin/laporan/v_lap_jual_pertahun',$x);
	}
	function lap_laba_rugi(){
		$bulan=$this->input->post('bln');
		$x['jml']=$this->m_laporan->get_total_lap_laba_rugi($bulan);
		$x['data']=$this->m_laporan->get_lap_laba_rugi($bulan);
		$this->load->view('admin/laporan/v_lap_laba_rugi',$x);
	}
	function lap_data_pembelian(){
		$x['data']=$this->m_laporan->get_data_pembelian();
		$x['jml']=$this->m_laporan->get_total_pembelian();
		$this->load->view('admin/laporan/v_lap_pembelian',$x);
	}
	function lap_retur(){
			$x['data']=$this->m_barang->tampil_barang();
			$x['retur']=$this->m_penjualan->tampil_retur();
			$this->load->view('admin/laporan/v_lap_retur',$x);
		}
}