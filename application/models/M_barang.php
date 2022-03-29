<?php
class M_barang extends CI_Model{

	function tampil_barang(){
		$hsl=$this->db->query("SELECT a.*,b.*,c.*,d.* FROM tbl_barang a LEFT JOIN tbl_satuan b ON a.barang_satuan_id=b.satuan_id LEFT JOIN tbl_kategori c ON a.barang_kategori_id=c.kategori_id LEFT JOIN tbl_suplier d ON c.suplier_id=d.suplier_id");
		return $hsl;
	}
	function tampil_d_barang_all($id){
		$hsl=$this->db->query("SELECT a.*,b.*,c.*,d.*,e.*,f.* FROM tbl_detail_barang a LEFT JOIN tbl_barang b ON a.d_barang_brg_id=b.barang_id LEFT JOIN tbl_satuan c ON b.barang_satuan_id=c.satuan_id LEFT JOIN tbl_kategori d ON b.barang_kategori_id=d.kategori_id LEFT JOIN tbl_beli e ON a.d_barang_beli_kode=e.beli_kode LEFT JOIN tbl_suplier f ON d.suplier_id=f.suplier_id WHERE d_barang_brg_id='$id'");
		return $hsl;
	}
	function simpan_barang($id,$nm,$spc,$satid,$katid,$totstok){
		$user_id=$this->session->userdata('idadmin');
		$hsl=$this->db->query("INSERT INTO tbl_barang(barang_id,barang_nama,barang_spesifikasi,barang_satuan_id,barang_kategori_id,barang_total_stok) VALUES ('$id','$nm','$spc','$satid','$katid','$totstok')");
		return $hsl;
	}
	function update_barang($id,$nm,$spc,$satid,$katid,$totstok){
		$user_id=$this->session->userdata('idadmin');
		$hsl=$this->db->query("UPDATE tbl_barang SET barang_nama='$nm',barang_spesifikasi='$spc',barang_satuan_id='$satid',barang_kategori_id='$katid',barang_total_stok='$totstok' WHERE barang_id='$id'");
		return $hsl;
	}
	function hapus_barang($kode){
		$hsl=$this->db->query("DELETE FROM tbl_barang where barang_id='$kode'");
		return $hsl;
	}
	function tampil_detail_barang_all(){
		$hsl=$this->db->query("SELECT a.*,b.*,c.*,d.*,e.* FROM tbl_detail_barang a LEFT JOIN tbl_barang b ON a.d_barang_brg_id=b.barang_id LEFT JOIN tbl_satuan c ON b.barang_satuan_id=c.satuan_id LEFT JOIN tbl_kategori d ON b.barang_kategori_id=d.kategori_id LEFT JOIN tbl_beli e ON a.d_barang_beli_kode=e.beli_kode");
		return $hsl;
	}
	function tampil_detail_barang(){
		$hsl=$this->db->query("SELECT a.*,b.*,c.*,d.*,e.* FROM tbl_detail_barang a LEFT JOIN tbl_barang b ON a.d_barang_brg_id=b.barang_id LEFT JOIN tbl_satuan c ON b.barang_satuan_id=c.satuan_id LEFT JOIN tbl_kategori d ON b.barang_kategori_id=d.kategori_id LEFT JOIN tbl_beli e ON a.d_barang_beli_kode=e.beli_kode WHERE d_barang_status='ada'");
		return $hsl;
	}
	function tampil_detail_barang_habis(){
		$hsl=$this->db->query("SELECT a.*,b.*,c.*,d.*,e.* FROM tbl_detail_barang a LEFT JOIN tbl_barang b ON a.d_barang_brg_id=b.barang_id LEFT JOIN tbl_satuan c ON b.barang_satuan_id=c.satuan_id LEFT JOIN tbl_kategori d ON b.barang_kategori_id=d.kategori_id LEFT JOIN tbl_beli e ON a.d_barang_beli_kode=e.beli_kode WHERE d_barang_status='habis'");
		return $hsl;
	}
	function tampil_per_detail_barang($id){
		$hsl=$this->db->query("SELECT a.*,b.*,c.*,d.*,e.* FROM tbl_detail_barang a LEFT JOIN tbl_barang b ON a.d_barang_brg_id=b.barang_id LEFT JOIN tbl_satuan c ON b.barang_satuan_id=c.satuan_id LEFT JOIN tbl_kategori d ON b.barang_kategori_id=d.kategori_id LEFT JOIN tbl_beli e ON a.d_barang_beli_kode=e.beli_kode WHERE d_barang_id='$id'");
		return $hsl;
	}
	function simpan_detail_barang($id,$idbrg,$lot,$exp,$stok,$harga,$status,$kobel,$total){
		$user_id=$this->session->userdata('idadmin');
		$this->db->query("INSERT INTO tbl_detail_barang VALUES ('$id','$idbrg','$lot','$exp','$stok',$harga,'$status',NULL,NULL,'$kobel','$total','$stok')");
		$this->db->query("UPDATE tbl_barang SET barang_total_stok=barang_total_stok+'$stok' where barang_id='$idbrg'");
		return true;
	}
	function update_detail_barang($id,$idbrg,$lot,$exp,$stok,$harga,$tglinput,$tgledit,$status,$kobel,$total,$stoksekarang){
		$user_id=$this->session->userdata('idadmin');
		$this->db->query("UPDATE tbl_detail_barang SET d_barang_brg_id='$idbrg',d_barang_lot='$lot',d_barang_exp='$exp',d_barang_stok='$stoksekarang',d_barang_harga_pokok='$harga',d_barang_tgl_input='$tglinput',d_barang_tgl_last_update='$tgledit',d_barang_status='$status',d_barang_beli_kode='$kobel',d_barang_harga_total='$total',d_barang_jumlah_beli='$stoksekarang' WHERE d_barang_id='$id'");
		$this->db->query("UPDATE tbl_barang SET barang_total_stok=barang_total_stok+'$stok' where barang_id='$idbrg'");
		return true;
	}
	function hapus_detail_barang($id,$idbrg,$stok){
		$this->db->query("DELETE FROM tbl_detail_barang where d_barang_id='$id'");
		$this->db->query("UPDATE tbl_barang SET barang_total_stok=barang_total_stok-'$stok' where barang_id='$idbrg'");
		return true;
	}

	function get_barang($id){
		$hsl=$this->db->query("SELECT * FROM tbl_barang JOIN tbl_satuan ON barang_satuan_id=satuan_id JOIN tbl_kategori ON barang_kategori_id=kategori_id where barang_id='$id' ");
		return $hsl;
	}
	function get_detail_barang($id){
		$hsl=$this->db->query("SELECT * FROM tbl_detail_barang JOIN tbl_barang ON d_barang_brg_id=barang_id JOIN tbl_satuan ON barang_satuan_id=satuan_id JOIN tbl_kategori ON barang_kategori_id=kategori_id where d_barang_id='$id'");
		return $hsl;
	}
	function get_kobar($id){
		$q = $this->db->query("SELECT MAX(RIGHT(barang_id,4)) AS kd_max FROM tbl_barang WHERE barang_kategori_id='$id'");
		$ko = $this->db->query("SELECT * from tbl_kategori WHERE kategori_id='$id'");
        if($q->num_rows()>0):
            foreach($q->result() as $r):
                $tmp = ((int)$r->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            endforeach;
        else:
            $kd = "0001";
        endif;
        if($ko->num_rows()>0):
        	foreach($ko->result() as $k):
        		$kode = $k->kategori_kode;
        	endforeach;
        endif;
        return $kode.$kd;
	}

	function get_kodet($id){
		$q = $this->db->query("SELECT MAX(RIGHT(d_barang_id,6)) AS kd_max FROM tbl_detail_barang WHERE d_barang_brg_id='$id'");
        if($q->num_rows()>0):
            foreach($q->result() as $r):
                $tmp = ((int)$r->kd_max)+1;
                $kd = sprintf("%06s", $tmp);
            endforeach;
        else:
            $kd = "000001";
        endif;
        return $kd;
	}

	function habis_status($kode){
		$hsl=$this->db->query("UPDATE tbl_detail_barang SET d_barang_status='habis' WHERE d_barang_id='$kode'");
		return $hsl;
	}
	function ada_status($kode){
		$hsl=$this->db->query("UPDATE tbl_detail_barang SET d_barang_status='ada' WHERE d_barang_id='$kode'");
		return $hsl;
	}
}