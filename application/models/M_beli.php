<?php
class M_beli extends CI_Model{
    function datatables(){
		$this->datatables->select("tbl_beli.*,tbl_suplier.*,tbl_user.*");
		$this->datatables->from("tbl_beli");
		$this->datatables->join("tbl_suplier","suplier_id=beli_suplier_id");
		$this->datatables->join("tbl_user","user_id=beli_user_id");
		return $this->datatables->generate();
	}
	function tampil_beli(){
		$hsl=$this->db->query("SELECT a.*,b.*,c.* FROM tbl_beli a LEFT JOIN tbl_suplier b ON a.beli_suplier_id=b.suplier_id LEFT JOIN tbl_user c ON a.beli_user_id=c.user_id");
		return $hsl;
	}
	function tampil_beli_id($id=NULL){
		$hsl=$this->db->query("SELECT * FROM tbl_beli a LEFT JOIN tbl_suplier b ON a.beli_suplier_id=b.suplier_id LEFT JOIN tbl_user c ON a.beli_user_id=c.user_id WHERE beli_kode='$id'");
		return $hsl;
	}
	function tampil_detail_barang($id=NULL){
		$hsl=$this->db->query("SELECT * FROM tbl_detail_barang a LEFT JOIN tbl_barang b ON a.d_barang_brg_id=b.barang_id LEFT JOIN tbl_satuan c ON b.barang_satuan_id=c.satuan_id LEFT JOIN tbl_kategori d ON b.barang_kategori_id=d.kategori_id LEFT JOIN tbl_beli e ON a.d_barang_beli_kode=e.beli_kode WHERE d_barang_beli_kode='$id'");
		return $hsl;
	}
	function tampil_beli_barang($id){
		$hsl=$this->db->query("SELECT * FROM tbl_beli a LEFT JOIN tbl_suplier b ON a.beli_suplier_id=b.suplier_id LEFT JOIN tbl_user c ON a.beli_user_id=c.user_id LEFT JOIN tbl_detail_barang d ON d.d_barang_beli_kode=a.beli_kode LEFT JOIN tbl_barang e ON e.barang_id=d.d_barang_brg_id LEFT JOIN tbl_satuan f ON e.barang_satuan_id=f.satuan_id LEFT JOIN tbl_kategori g ON e.barang_kategori_id=g.kategori_id WHERE beli_kode='$id'")->row();
		return $hsl;
	}
	function simpan_beli($nofak,$tglfak,$idsup,$total,$beli_kode){
		$idadmin=$this->session->userdata('idadmin');
		$hsl=$this->db->query("INSERT INTO tbl_beli (beli_nofak,beli_tanggal,beli_total,beli_suplier_id,beli_user_id,beli_kode) VALUES ('$nofak','$tglfak','$total','$idsup','$idadmin','$beli_kode')");
		return $hsl;
	}
	function get_kobel($id){
			$q = $this->db->query("SELECT MAX(RIGHT(beli_kode,3)) AS kd_max FROM tbl_beli WHERE DATE(beli_tanggal)=CURDATE()");
	        $kd = "";
	        if($q->num_rows()>0){
	            foreach($q->result() as $k){
	                $tmp = ((int)$k->kd_max)+1;
	                $kd = sprintf("%03s", $tmp);
	            }
	        }else{
				$kd = "001";
	        }
	    return $id.date('dmyhis').$kd;
	}
	function update_beli($nofak,$tglfak,$idsup,$total,$beli_kode){
		$idadmin=$this->session->userdata('idadmin');
		$hsl=$this->db->query("UPDATE tbl_beli SET beli_nofak='$nofak',beli_tanggal='$tglfak',beli_suplier_id='$idsup',beli_total='$total',beli_user_id='$idadmin' WHERE beli_kode='$beli_kode'");
		return $hsl;
	}
	function hapus_beli($kode){
		$hsl=$this->db->query("DELETE FROM tbl_beli where beli_kode='$kode'");
		return $hsl;
	}


}