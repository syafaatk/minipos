<?php
class M_penjualan extends CI_Model{

	function hapus_retur($kode){
		$hsl=$this->db->query("DELETE FROM tbl_retur WHERE retur_id='$kode'");
		return $hsl;
	}

	function tampil_retur(){
		$hsl=$this->db->query("SELECT retur_id,DATE_FORMAT(retur_tanggal,'%d/%m/%Y') AS retur_tanggal,retur_d_barang_id,retur_barang_nama,retur_barang_satuan,retur_harjul,retur_qty,(retur_harjul*retur_qty) AS retur_subtotal,retur_keterangan FROM tbl_retur ORDER BY retur_id DESC");
		return $hsl;
	}

	function simpan_retur($kobar,$nabar,$satuan,$harjul,$qty,$keterangan){
		$hsl=$this->db->query("INSERT INTO tbl_retur(retur_barang_id,retur_barang_nama,retur_barang_satuan,retur_harjul,retur_qty,retur_keterangan) VALUES ('$kobar','$nabar','$satuan','$harjul','$qty','$keterangan')");
		return $hsl;
	}
	function tampil_penjualan(){
		$hsl=$this->db->query("select * from tbl_jual order by jual_fak desc");
		return $hsl;
	}
	function get_nofak(){
		date_default_timezone_set('Asia/Jakarta');
		$q = $this->db->query("SELECT MAX(RIGHT(jual_nofak,4)) AS kd_max FROM tbl_jual WHERE DATE(jual_tanggal)=CURDATE()");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
        return DATE('dmy').$kd;
	}
    
    function get_nofak_manual(){
		date_default_timezone_set('Asia/Jakarta');
		$q = $this->db->query("SELECT MAX(RIGHT(jual_nofak,4)) AS kd_max FROM tbl_jual WHERE DATE(jual_tanggal)=CURDATE() AND LEFT(jual_nofak,1)='M'");
        $kd = "";
        $man = "M";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
        return $man.DATE('dmy').$kd;
	}
    
	function get_nonfak(){
		$q = $this->db->query("SELECT MAX(RIGHT(jual_fak,4)) AS kd_max FROM tbl_jual WHERE LEFT(jual_fak,4)='NON-'");
        $kd = "";
        $non = "NON-";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
        return $non.$kd;
	}

	function get_ppjfak(){
		$q = $this->db->query("SELECT MAX(RIGHT(jual_fak,4)) AS kd_max FROM tbl_jual WHERE LEFT(jual_fak,6)='PPJ-22'");
        $kd = "";
        $ppj = "PPJ-22";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
        return $ppj.$kd;
	}
	//=====================Penjualan grosir================================
	function simpan_penjualan_grosir($nofak,$fak,$tgl_bayar,$total,$pajak,$total_pajak,$pelanggan,$sales,$jml_uang,$kembalian,$keterangan,$nopo){
		$idadmin=$this->session->userdata('idadmin');
		$tbl_jual=array(
			'jual_nofak' => $nofak,
			'jual_fak' => $fak,
			'jual_tgl_byr_kredit' => $tgl_bayar,
			'jual_pelanggan_id' => $pelanggan,
			'jual_sales_id' => $sales,
			'jual_total' => $total,
			'jual_pajak' => $pajak,
			'jual_total_pajak' => $total_pajak,
			'jual_jml_uang' => $jml_uang,
			'jual_kembalian' => $kembalian,
			'jual_user_id' => $idadmin,
			'jual_keterangan' =>$keterangan,
			'jual_nopo'  =>$nopo
		);
		$this->db->insert('tbl_jual',$tbl_jual);
		return true;
	}

	function update_tgl($nofak,$tgl){
		$this->db->query("update tbl_jual set jual_tanggal ='$tgl' where jual_nofak='$nofak'");
	}

	function simpan_detail_penjualan($nofak){
		$data=array();
		foreach ($this->cart->contents() as $item) {
			$data=array(
				'd_jual_nofak' 			=>	$nofak,
				'd_jual_d_barang_id'	=>	$item['id'],
				'd_jual_barang_harjul'	=>	$item['amount'],
				'd_jual_qty'			=>	$item['qty'],
				'd_jual_diskon'			=>	$item['disc'],
				'd_jual_total'			=>	$item['subtotal']
			);
			$this->db->insert('tbl_detail_jual',$data);
			$this->db->query("update tbl_detail_barang set d_barang_stok=d_barang_stok-'$item[qty]' where d_barang_id='$item[id]'");
			$this->db->query("update tbl_barang set barang_total_stok=barang_total_stok-'$item[qty]' where barang_id='$item[brgid]'");
		}
		return $data;
	}

	function cetak_faktur(){
		$nofak=$this->session->userdata('nofak');
		$hsl=$this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d/%m/%Y %H:%i:%s') AS jual_tanggal,jual_tgl_byr_kredit,jual_total,jual_jml_uang,jual_kembalian,jual_keterangan,jual_nopo,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total,jual_pelanggan_id,tbl_pelanggan.* FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak JOIN tbl_pelanggan ON jual_pelanggan_id=pelanggan_id WHERE jual_nofak='$nofak'");
		return $hsl;
	}
	
}