<?php
class M_pembelian extends CI_Model{

	function simpan_pembelian($nofak,$tglfak,$idsup,$beli_kode){
		$idadmin=$this->session->userdata('idadmin');
		$this->db->query("INSERT INTO tbl_beli (beli_nofak,beli_tanggal,beli_suplier_id,beli_user_id,beli_kode) VALUES ('$nofak','$tglfak','$idsup','$idadmin','$beli_kode')");
		foreach ($this->cart->contents() as $item) {
			$data=array(
				'd_beli_nofak' 		=>	$nofak,
				'd_beli_d_barang_id'=>	$item['iddet'],
				'd_beli_harga'		=>	$item['price'],
				'd_beli_jumlah'		=>	$item['qty'],
				'd_beli_total'		=>	$item['subtotal'],
				'd_beli_kode'		=>	$beli_kode
			);
			$data2=array(
				'd_barang_id'		=> $item['iddet'],
				'd_barang_brg_id'	=> $item['idbrg'],
				'd_barang_lot'		=> $item['lot'],
				'd_barang_exp'		=> $item['exp'],
				'd_barang_stok'		=> $item['qty'],
				'd_barang_tgl_input'=> $tglfak,
				'd_barang_tgl_last_update'=> NULL,
				'd_barang_status'	=> $item['status']
			);
			$this->db->insert('tbl_detail_beli',$data);
			$this->db->insert('tbl_detail_barang',$data2);
			$this->db->query("update tbl_barang set barang_total_stok=barang_total_stok+'$item[qty]' where barang_id='$item[idbrg]'");
		}
		return true;
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
}