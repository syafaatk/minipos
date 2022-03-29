<?php
class M_pelanggan extends CI_Model{

	function hapus_pelanggan($kode){
		$hsl=$this->db->query("DELETE FROM tbl_pelanggan where pelanggan_id='$kode'");
		return $hsl;
	}

	function update_pelanggan($kode,$nama,$alamat,$notelp,$nonpwp){
		$hsl=$this->db->query("UPDATE tbl_pelanggan set pelanggan_nama='$nama',pelanggan_alamat='$alamat',pelanggan_notelp='$notelp',pelanggan_nonpwp='$nonpwp' where pelanggan_id='$kode'");
		return $hsl;
	}

	function tampil_pelanggan(){
		$hsl=$this->db->query("select * from tbl_pelanggan order by pelanggan_id desc");
		return $hsl;
	}

	function simpan_pelanggan($nama,$alamat,$notelp,$nonpwp){
		$hsl=$this->db->query("INSERT INTO tbl_pelanggan(pelanggan_nama,pelanggan_alamat,pelanggan_notelp,pelanggan_nonpwp) VALUES ('$nama','$alamat','$notelp','$nonpwp')");
		return $hsl;
	}

}