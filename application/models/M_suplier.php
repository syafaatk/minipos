<?php
class M_suplier extends CI_Model{

	function hapus_suplier($kode){
		$hsl=$this->db->query("DELETE FROM tbl_suplier where suplier_id='$kode'");
		return $hsl;
	}

	function update_suplier($kode,$nama,$kodesup,$alamat,$notelp,$nonpwp){
		$hsl=$this->db->query("UPDATE tbl_suplier set suplier_nama='$nama',suplier_kode='$kodesup',suplier_alamat='$alamat',suplier_notelp='$notelp',suplier_nonpwp='$nonpwp' where suplier_id='$kode'");
		return $hsl;
	}

	function tampil_suplier(){
		$hsl=$this->db->query("select * from tbl_suplier order by suplier_id desc");
		return $hsl;
	}

	function simpan_suplier($nama,$kodesup,$alamat,$notelp,$nonpwp){
		$query = $this->db->get_where('tbl_suplier', array('suplier_kode' => $kodesup));
		$count = $query->num_rows(); 
		if($count){
		     $this->session->set_flashdata('msg', 'Kode Suplier sudah ada. Kode Suplier tidak boleh duplikat!');
			 echo $this->session->set_flashdata('alert','danger');
		     redirect('admin/suplier');
		}
		echo $this->session->set_flashdata('msg','Berhasil Menambah Suplier!');
		echo $this->session->set_flashdata('alert','success');
		$hsl=$this->db->query("INSERT INTO tbl_suplier(suplier_nama,suplier_kode,suplier_alamat,suplier_notelp,suplier_nonpwp) VALUES ('$nama','$kodesup','$alamat','$notelp','$nonpwp')");
		return $hsl;
	}

}