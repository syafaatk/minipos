<?php
class M_laporan extends CI_Model{
    function datatables($bulan=NULL){
		$this->datatables->select("jual_nofak,jual_fak,jual_tanggal,jual_total,pelanggan_nama,jual_total,jual_jml_uang,jual_user_id,jual_keterangan,user_nama,sales_nama,jual_sales_id");
		$this->datatables->from("tbl_jual");
		$this->datatables->join("tbl_pelanggan","tbl_pelanggan.pelanggan_id=tbl_jual.jual_pelanggan_id");
		$this->datatables->join("tbl_user","user_id=jual_user_id");
		$this->datatables->join("tbl_sales","sales_id=jual_sales_id");
		$this->db->like("jual_tanggal", $bulan);
		return $this->datatables->generate();
	}
	function get_stok_barang(){
		$hsl=$this->db->query("SELECT kategori_id,kategori_nama,a.suplier_kode,b.suplier_nama,barang_nama,barang_stok FROM tbl_kategori a JOIN tbl_barang ON kategori_id=barang_kategori_id JOIN tbl_suplier b ON a.suplier_kode=b.suplier_kode GROUP BY kategori_id,barang_nama");
		return $hsl;
	}
	function get_data_barang(){
		$hsl=$this->db->query("SELECT kategori_id,a.suplier_kode,b.suplier_nama,barang_id,kategori_nama,barang_nama,barang_satuan,barang_harjul,barang_stok FROM tbl_kategori a JOIN tbl_barang ON kategori_id=barang_kategori_id JOIN tbl_suplier b ON a.suplier_kode=b.suplier_kode GROUP BY kategori_id,barang_nama");
		return $hsl;
	}
	function get_data_penjualan(){
		$hsl=$this->db->query("SELECT pelanggan_nama,d_jual_nofak,jual_nofak,jual_fak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,d_jual_d_barang_id,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak JOIN tbl_pelanggan ON tbl_pelanggan.pelanggan_id=tbl_jual.jual_pelanggan_id ORDER BY jual_nofak DESC");
		return $hsl;
	}

	function get_data_jual(){
		$hsl=$this->db->query("SELECT jual_nofak,jual_fak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,pelanggan_nama,jual_total,jual_jml_uang,jual_user_id,jual_keterangan,user_nama,sales_nama,jual_sales_id FROM tbl_jual JOIN tbl_pelanggan ON tbl_pelanggan.pelanggan_id=tbl_jual.jual_pelanggan_id JOIN tbl_user ON user_id=jual_user_id JOIN tbl_sales ON sales_id=jual_sales_id ORDER BY jual_fak DESC");
		return $hsl;
	}

	function get_data_jual_bulan($bulan){
		$hsl=$this->db->query("SELECT jual_nofak,jual_fak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,pelanggan_nama,jual_total,jual_jml_uang,jual_user_id,jual_keterangan,user_nama,sales_nama,jual_sales_id FROM tbl_jual JOIN tbl_pelanggan ON tbl_pelanggan.pelanggan_id=tbl_jual.jual_pelanggan_id JOIN tbl_user ON user_id=jual_user_id JOIN tbl_sales ON sales_id=jual_sales_id WHERE DATE_FORMAT(jual_tanggal,'%M %Y')='$bulan' ORDER BY jual_fak DESC");
		return $hsl;
	}

	function get_data_jual_nofak($nofak){
		$hsl=$this->db->query("SELECT jual_nofak,jual_fak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,pelanggan_nama,jual_total,jual_jml_uang,jual_user_id,jual_keterangan,user_nama,sales_nama,jual_sales_id FROM tbl_jual JOIN tbl_pelanggan ON tbl_pelanggan.pelanggan_id=tbl_jual.jual_pelanggan_id JOIN tbl_user ON user_id=jual_user_id JOIN tbl_sales ON sales_id=jual_sales_id WHERE jual_nofak='$nofak' ORDER BY jual_fak DESC");
		return $hsl;
	}
	function get_total_penjualan(){
		$hsl=$this->db->query("SELECT jual_nofak,sum(jual_total) as total FROM tbl_jual ORDER BY jual_nofak DESC");
		return $hsl;
	}
	function get_total_penjualan_bulan($bulan){
		$hsl=$this->db->query("SELECT jual_nofak,sum(jual_total) as total FROM tbl_jual WHERE DATE_FORMAT(jual_tanggal,'%M %Y')='$bulan' ORDER BY jual_nofak DESC");
		return $hsl;
	}
	function get_data_jual_pertanggal($tanggal){
		$hsl=$this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE(jual_tanggal)='$tanggal' ORDER BY jual_nofak DESC");
		return $hsl;
	}
	function get_data__total_jual_pertanggal($tanggal){
		$hsl=$this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,SUM(d_jual_total) as total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE(jual_tanggal)='$tanggal' ORDER BY jual_nofak DESC");
		return $hsl;
	}
	function get_bulan_jual(){
		$hsl=$this->db->query("SELECT DISTINCT DATE_FORMAT(jual_tanggal,'%M %Y') AS bulan,DATE_FORMAT(jual_tanggal,'%Y-%m') AS bln FROM tbl_jual ORDER BY jual_tanggal ASC");
		return $hsl;
	}
	function get_bulan_beli(){
		$hsl=$this->db->query("SELECT DISTINCT DATE_FORMAT(beli_tanggal,'%M %Y') AS bulan FROM tbl_beli");
		return $hsl;
	}
	function get_tahun_jual(){
		$hsl=$this->db->query("SELECT DISTINCT YEAR(jual_tanggal) AS tahun FROM tbl_jual");
		return $hsl;
	}
	function get_jual_perbulan($bulan){
		$hsl=$this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%M %Y') AS bulan,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE_FORMAT(jual_tanggal,'%M %Y')='$bulan' ORDER BY jual_nofak DESC");
		return $hsl;
	}
	function get_jual_pertahun($tahun){
		$hsl=$this->db->query("SELECT jual_nofak,YEAR(jual_tanggal) AS tahun,DATE_FORMAT(jual_tanggal,'%M %Y') AS bulan,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE YEAR(jual_tanggal)='$tahun' ORDER BY jual_nofak DESC");
		return $hsl;
	}
	function get_total_jual_pertahun($tahun){
		$hsl=$this->db->query("SELECT jual_nofak,YEAR(jual_tanggal) AS tahun,DATE_FORMAT(jual_tanggal,'%M %Y') AS bulan,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,SUM(d_jual_total) as total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE YEAR(jual_tanggal)='$tahun' ORDER BY jual_nofak DESC");
		return $hsl;
	}
	// PEMBELIAN
	function get_data_pembelian(){
		$hsl=$this->db->query("SELECT beli_nofak,DATE_FORMAT(beli_tanggal,'%d %M %Y') AS beli_tanggal,beli_suplier_id,d_beli_id,d_beli_barang_id,d_beli_harga,d_beli_jumlah,d_beli_total FROM tbl_beli JOIN tbl_detail_barang ON beli_nofak=d_beli_nofak ORDER BY beli_nofak DESC");
		return $hsl;
	}
	function get_total_pembelian(){
		$hsl=$this->db->query("SELECT beli_nofak,DATE_FORMAT(beli_tanggal,'%d %M %Y') AS beli_tanggal,beli_suplier_id,d_beli_id,d_beli_barang_id,d_beli_harga,d_beli_jumlah,sum(d_beli_total) as total FROM tbl_beli JOIN tbl_detail_barang ON beli_nofak=d_beli_nofak ORDER BY beli_nofak DESC");
		return $hsl;
	}
//=====================
	function get_lap_laba_rugi($bulan){
		$hsl=$this->db->query("SELECT DATE_FORMAT(jual_tanggal,'%d %M %Y %H:%i:%s') as jual_tanggal,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,(d_jual_barang_harjul-d_jual_barang_harpok) AS keunt,d_jual_qty,d_jual_diskon,((d_jual_barang_harjul-d_jual_barang_harpok)*d_jual_qty)-(d_jual_qty*d_jual_diskon) AS untung_bersih FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE_FORMAT(jual_tanggal,'%M %Y')='$bulan'");
		return $hsl;
	}
	function get_total_lap_laba_rugi($bulan){
		$hsl=$this->db->query("SELECT DATE_FORMAT(jual_tanggal,'%M %Y') AS bulan,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,(d_jual_barang_harjul-d_jual_barang_harpok) AS keunt,d_jual_qty,d_jual_diskon,SUM(((d_jual_barang_harjul-d_jual_barang_harpok)*d_jual_qty)-(d_jual_qty*d_jual_diskon)) AS total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE_FORMAT(jual_tanggal,'%M %Y')='$bulan'");
		return $hsl;
	}
//=====================
	function get_pembelian_by_principal($id,$bulan){
		$hsl=$this->db->query("SELECT beli_nofak,DATE_FORMAT(beli_tanggal,'%d %M %Y') AS beli_tanggal,beli_total,suplier_nama FROM tbl_beli JOIN tbl_suplier ON suplier_id=beli_suplier_id WHERE beli_suplier_id='$id' AND DATE_FORMAT(beli_tanggal,'%M %Y')='$bulan'  ORDER BY beli_nofak DESC");
		return $hsl;
	}
	function get_total_pembelian_by_principal($id,$bulan){
		$hsl=$this->db->query("SELECT beli_nofak,DATE_FORMAT(beli_tanggal,'%d %M %Y') AS beli_tanggal,DATE_FORMAT(beli_tanggal,'%M %Y') AS bulan, sum(beli_total) as total,suplier_nama FROM tbl_beli JOIN tbl_suplier ON suplier_id=beli_suplier_id WHERE beli_suplier_id='$id' AND DATE_FORMAT(beli_tanggal,'%M %Y')='$bulan' ORDER BY beli_nofak DESC");
		return $hsl;
	}
//=====================
	function get_pembelian_by_pelanggan($id,$katid,$bulan){
		if($katid=='NULL'){
			$hsl=$this->db->query("SELECT DISTINCT jual_fak,jual_nofak,DATE_FORMAT(jual_tanggal,'%M %Y') AS bulan,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,pelanggan_nama,sales_nama,jual_total,jual_pajak,jual_total_pajak,jual_jml_uang,jual_keterangan FROM tbl_jual JOIN tbl_pelanggan ON pelanggan_id=jual_pelanggan_id JOIN tbl_sales ON sales_id=jual_sales_id JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak JOIN tbl_detail_barang ON d_jual_d_barang_id=d_barang_id JOIN tbl_barang ON d_barang_brg_id=barang_id WHERE jual_pelanggan_id='$id' AND DATE_FORMAT(jual_tanggal,'%M %Y')='$bulan' ORDER BY jual_nofak DESC");
		}else{
			$hsl=$this->db->query("SELECT DISTINCT jual_fak,jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,pelanggan_nama,sales_nama,jual_total,jual_pajak,jual_total_pajak,jual_jml_uang,jual_keterangan,barang_kategori_id,g.* FROM tbl_jual JOIN tbl_pelanggan ON pelanggan_id=jual_pelanggan_id JOIN tbl_sales ON sales_id=jual_sales_id JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak JOIN tbl_detail_barang ON d_jual_d_barang_id=d_barang_id JOIN tbl_barang ON d_barang_brg_id=barang_id JOIN tbl_kategori g ON barang_kategori_id=kategori_id WHERE jual_pelanggan_id='$id' AND DATE_FORMAT(jual_tanggal,'%M %Y')='$bulan' AND barang_kategori_id='$katid' ORDER BY jual_nofak DESC");
		}
		return $hsl;
	}
	function detail_faktur(){
		$hsl=$this->db->query("SELECT a.*,DATE_FORMAT(jual_tanggal,'%d-%m-%Y') AS jual_tanggal,b.*,c.*,d.*,e.*,f.*,g.*,h.* FROM tbl_jual a JOIN tbl_detail_jual b ON jual_nofak=d_jual_nofak JOIN tbl_pelanggan c ON jual_pelanggan_id=pelanggan_id JOIN tbl_sales d ON jual_sales_id=sales_id JOIN tbl_detail_barang e ON d_jual_d_barang_id=d_barang_id JOIN tbl_barang f ON d_barang_brg_id=barang_id JOIN tbl_kategori g ON barang_kategori_id=kategori_id JOIN tbl_satuan h ON barang_satuan_id=satuan_id");
		return $hsl;
	}
	function get_total_pembelian_by_pelanggan($id,$katid,$bulan){
		if($katid=='NULL'){
		$hsl=$this->db->query("SELECT jual_nofak,jual_fak,DATE_FORMAT(jual_tanggal,'%M %Y') AS bulan,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,d_jual_d_barang_id,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,sum(d_jual_total) as total,sum(d_jual_total*10/100) as pajak,sum(d_jual_total+(d_jual_total*10/100)) as total_pajak FROM tbl_jual JOIN tbl_pelanggan ON pelanggan_id=jual_pelanggan_id JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak JOIN tbl_detail_barang ON d_jual_d_barang_id=d_barang_id JOIN tbl_barang ON d_barang_brg_id=barang_id WHERE jual_pelanggan_id='$id' AND DATE_FORMAT(jual_tanggal,'%M %Y')='$bulan' ORDER BY jual_nofak DESC");
		}else{
		$hsl=$this->db->query("SELECT jual_nofak,jual_fak,DATE_FORMAT(jual_tanggal,'%M %Y') AS bulan,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,d_jual_d_barang_id,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,sum(d_jual_total) as total,sum(d_jual_total*10/100) as pajak,sum(d_jual_total+(d_jual_total*10/100)) as total_pajak FROM tbl_jual JOIN tbl_pelanggan ON pelanggan_id=jual_pelanggan_id JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak JOIN tbl_detail_barang ON d_jual_d_barang_id=d_barang_id JOIN tbl_barang ON d_barang_brg_id=barang_id WHERE jual_pelanggan_id='$id' AND DATE_FORMAT(jual_tanggal,'%M %Y')='$bulan' AND barang_kategori_id='$katid' ORDER BY jual_nofak DESC");
		}
		return $hsl;
	}
	function get_total_pembelian_by_pelanggan_retur($id,$bulan){
		$hsl=$this->db->query("SELECT jual_nofak,jual_fak,DATE_FORMAT(jual_tanggal,'%M %Y') AS bulan,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,d_jual_d_barang_id,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,sum(d_jual_total) as total,sum(jual_pajak) as pajak,sum(jual_total_pajak) as total_pajak FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE jual_pelanggan_id='$id' AND DATE_FORMAT(jual_tanggal,'%M %Y')='$bulan' AND jual_keterangan='RETURN' ORDER BY jual_nofak DESC");
		return $hsl;
	}
//=====================
	function get_penjualan_by_sales($id,$bulan){
		$hsl=$this->db->query("SELECT jual_nofak,jual_fak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,pelanggan_nama,sales_nama,jual_total,jual_pajak,jual_total_pajak,jual_jml_uang,jual_keterangan FROM tbl_jual JOIN tbl_pelanggan ON tbl_pelanggan.pelanggan_id=tbl_jual.jual_pelanggan_id JOIN tbl_sales ON sales_id=jual_sales_id WHERE jual_sales_id='$id' AND DATE_FORMAT(jual_tanggal,'%M %Y')='$bulan' ORDER BY jual_nofak DESC");
		return $hsl;
	}
	function get_total_penjualan_by_sales($id,$bulan){
		$hsl=$this->db->query("SELECT jual_nofak,jual_fak,DATE_FORMAT(jual_tanggal,'%M %Y') AS bulan,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,d_jual_d_barang_id,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,sum(d_jual_total) as total,sum(d_jual_total*10/100) as pajak,sum(d_jual_total+(d_jual_total*10/100)) as total_pajak FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE jual_sales_id='$id' AND DATE_FORMAT(jual_tanggal,'%M %Y')='$bulan' ORDER BY jual_nofak DESC");
		return $hsl;
	}
	function get_total_penjualan_by_sales_retur($id,$bulan){
		$hsl=$this->db->query("SELECT jual_nofak,jual_fak,DATE_FORMAT(jual_tanggal,'%M %Y') AS bulan,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,d_jual_d_barang_id,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,sum(d_jual_total) as total,sum(jual_pajak) as pajak,sum(jual_total_pajak) as total_pajak FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE jual_sales_id='$id' AND DATE_FORMAT(jual_tanggal,'%M %Y')='$bulan' AND jual_keterangan='RETURN' ORDER BY jual_nofak DESC");
		return $hsl;
	}
//=====================
	function get_penjualan_by_kategori($id,$bulan){
		$hsl=$this->db->query("SELECT jual_fak,tbl_barang.*,tbl_suplier.*,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_total,kategori_nama FROM tbl_detail_jual JOIN tbl_jual ON jual_nofak=d_jual_nofak JOIN tbl_detail_barang ON d_jual_d_barang_id=d_barang_id JOIN tbl_barang ON d_barang_brg_id=barang_id JOIN tbl_kategori ON kategori_id=barang_kategori_id JOIN tbl_suplier ON tbl_kategori.suplier_id=tbl_suplier.suplier_id WHERE barang_kategori_id='$id' AND DATE_FORMAT(jual_tanggal,'%M %Y')='$bulan'  ORDER BY jual_nofak DESC");
		return $hsl;
	}
	function get_total_penjualan_by_kategori($id,$bulan){
		$hsl=$this->db->query("SELECT jual_fak,tbl_barang.*,tbl_suplier.*,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,DATE_FORMAT(jual_tanggal,'%M %Y') AS bulan, sum(d_jual_total) as total,kategori_nama FROM tbl_detail_jual JOIN tbl_jual ON jual_nofak=d_jual_nofak JOIN tbl_detail_barang ON d_jual_d_barang_id=d_barang_id JOIN tbl_barang ON d_barang_brg_id=barang_id JOIN tbl_kategori ON kategori_id=barang_kategori_id JOIN tbl_suplier ON tbl_kategori.suplier_id=tbl_suplier.suplier_id WHERE barang_kategori_id='$id' AND DATE_FORMAT(jual_tanggal,'%M %Y')='$bulan'  ORDER BY jual_fak DESC");
		return $hsl;
	}
//=====================
	function get_total_jual_perbulan($bulan){
		$hsl=$this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%M %Y') AS bulan,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,SUM(d_jual_total) as total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE_FORMAT(jual_tanggal,'%M %Y')='$bulan' ORDER BY jual_nofak DESC");
		return $hsl;
	}
}