<?php
class M_kategori extends CI_Model{

	function hapus_kategori($kode){
		$hsl=$this->db->query("DELETE FROM tbl_kategori where kategori_id='$kode'");
		return $hsl;
	}

	function update_kategori($kode,$kat,$idsup,$kodekat){
		$hsl=$this->db->query("UPDATE tbl_kategori set kategori_nama='$kat',suplier_id='$idsup',kategori_kode='$kodekat' where kategori_id='$kode'");
		return $hsl;
	}

	function tampil_kategori(){
		$hsl=$this->db->query("select a.*,b.* from tbl_kategori a join tbl_suplier b ON a.suplier_id=b.suplier_id order by b.suplier_id desc");
		return $hsl;
	}

	function simpan_kategori($kat,$idsup,$kodekat){
		$query = $this->db->get_where('tbl_kategori', array('kategori_kode' => $kodekat));
		$count = $query->num_rows(); 
		if($count){
		     $this->session->set_flashdata('msg', 'Kode Kategori sudah ada. Kode Kategori tidak boleh duplikat!');
			 echo $this->session->set_flashdata('alert','danger');
		     redirect('admin/kategori');
		}
		echo $this->session->set_flashdata('msg','Berhasil Menambah Kategori!');
		echo $this->session->set_flashdata('alert','success');
		$hsl=$this->db->query("INSERT INTO tbl_kategori(kategori_nama,suplier_id,kategori_kode) VALUES ('$kat','$idsup','$kodekat')");
		return $hsl;
	}

}