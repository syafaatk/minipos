<?php
class M_sales extends CI_Model{

	function hapus_sales($kode){
		$hsl=$this->db->query("DELETE FROM tbl_sales where sales_id='$kode'");
		return $hsl;
	}

	function update_sales($kode,$nama,$alamat,$notelp,$nonpwp){
		$hsl=$this->db->query("UPDATE tbl_sales set sales_nama='$nama',sales_alamat='$alamat',sales_notelp='$notelp',sales_nonpwp='$nonpwp' where sales_id='$kode'");
		return $hsl;
	}

	function tampil_sales(){
		$hsl=$this->db->query("select * from tbl_sales order by sales_id desc");
		return $hsl;
	}

	function simpan_sales($nama,$alamat,$notelp,$nonpwp){
		$hsl=$this->db->query("INSERT INTO tbl_sales(sales_nama,sales_alamat,sales_notelp,sales_nonpwp) VALUES ('$nama','$alamat','$notelp','$nonpwp')");
		return $hsl;
	}

}