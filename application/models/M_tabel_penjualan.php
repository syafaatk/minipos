<?php
class M_tabel_penjualan extends CI_Model{
	function faktur($nofak){
		$hsl=$this->db->query("SELECT a.*,DATE_FORMAT(jual_tanggal,'%d-%m-%Y') AS jual_tanggal,b.*,c.*,d.* FROM tbl_jual a JOIN tbl_detail_jual b ON jual_nofak=d_jual_nofak JOIN tbl_pelanggan c ON jual_pelanggan_id=pelanggan_id JOIN tbl_sales d ON jual_sales_id=sales_id WHERE a.jual_nofak='$nofak'");
		return $hsl;
	}
	function cetak_faktur(){
		$nofak=$this->session->userdata('nofak');
		$hsl=$this->db->query("SELECT a.*,DATE_FORMAT(jual_tanggal,'%d-%m-%Y') AS jual_tanggal,b.*,c.*,d.* FROM tbl_jual a JOIN tbl_detail_jual b ON jual_nofak=d_jual_nofak JOIN tbl_pelanggan c ON jual_pelanggan_id=pelanggan_id JOIN tbl_sales d ON jual_sales_id=sales_id WHERE a.jual_nofak='$nofak'");
		return $hsl;
	}
	function hapus_faktur($nofak){
	    $hsl=$this->db->query("DELETE FROM tbl_jual WHERE jual_nofak = '$nofak'");
	    return $hsl;
	}
	function update_sales($idjual,$idsales){
		$hsl=$this->db->query("UPDATE tbl_jual SET jual_sales_id='$idsales' WHERE jual_nofak='$idjual'");
		return $hsl;
	}
	function hapus_detail_faktur($kode,$qty,$dbrgid,$brgid,$faktur,$fak,$total){
		$query1=$this->db->query("SELECT * FROM tbl_detail_jual where d_jual_id='$kode'");
		$count=$query1->num_rows();
		if ($count>0) {
			foreach($query1->result() as $rows){
				if($rows->d_jual_qty > $qty){
					$harjul=$rows->d_jual_barang_harjul;
					$totaljual=$harjul*$qty;
					$up1=$this->db->query("UPDATE tbl_detail_jual SET d_jual_qty=d_jual_qty-'$qty',d_jual_total=d_jual_total-'$totaljual' where d_jual_id='$kode'");
					$pajak=$totaljual*10/100;
					$totpajak=$totaljual+$pajak;
					$up2=$this->db->query("UPDATE tbl_jual SET jual_total=jual_total-'$totaljual',jual_pajak=jual_pajak-'$pajak',jual_total_pajak=jual_total_pajak-'$totpajak',jual_jml_uang=jual_jml_uang-'$totpajak' where jual_nofak='$faktur'");
					$up3=$this->db->query("UPDATE tbl_detail_barang SET d_barang_stok=d_barang_stok+'$qty' where d_barang_id='$dbrgid'");
					$up4=$this->db->query("UPDATE tbl_barang SET barang_total_stok=barang_total_stok+'$qty' where barang_id='$brgid'");	
					echo $this->session->set_flashdata('msg','Berhasil Menghapus '.$qty.' stok Barang '.$dbrgnm.' dan mengembalikannya ke Gudang');
					echo $this->session->set_flashdata('alert','success');
					$query=$this->db->query("SELECT * FROM tbl_detail_jual where d_jual_nofak='$faktur'");
					if ($query->num_rows()==0) {
						$hsl=$this->db->query("DELETE FROM tbl_jual where jual_nofak='$faktur'");
						$this->session->set_flashdata('msg', 'Faktur '.$fak.' Berhasil dihapus! dan mengembalikan semua stok ke gudang!');
						echo $this->session->set_flashdata('alert','danger');
					    redirect('admin/tabel_penjualan');
					}
					return true;
				}elseif($rows->d_jual_qty == $qty){
					$up1=$this->db->query("DELETE FROM tbl_detail_jual where d_jual_id='$kode'");
					$pajak=$total*10/100;
					$totpajak=$total+$pajak;
					$up2=$this->db->query("UPDATE tbl_jual SET jual_total=jual_total-'$total',jual_pajak=jual_pajak-'$pajak',jual_total_pajak=jual_total_pajak-'$totpajak',jual_jml_uang=jual_jml_uang-'$totpajak' where jual_nofak='$faktur'");
					$up3=$this->db->query("UPDATE tbl_detail_barang SET d_barang_stok=d_barang_stok+'$qty' where d_barang_id='$dbrgid'");
					$up4=$this->db->query("UPDATE tbl_barang SET barang_total_stok=barang_total_stok+'$qty' where barang_id='$brgid'");
					echo $this->session->set_flashdata('msg','Berhasil Menghapus '.$qty.' stok Barang '.$dbrgnm.' dan mengembalikannya ke Gudang');
					echo $this->session->set_flashdata('alert','success');
					$query=$this->db->query("SELECT * FROM tbl_detail_jual where d_jual_nofak='$faktur'");
					if ($query->num_rows()==0) {
						$hsl=$this->db->query("DELETE FROM tbl_jual where jual_nofak='$faktur'");
						$this->session->set_flashdata('msg', 'Faktur '.$fak.' Berhasil dihapus! dan mengembalikan semua stok ke gudang!');
						echo $this->session->set_flashdata('alert','danger');
					    redirect('admin/tabel_penjualan');
					}
					return true;	
				}else{
					$harjul=$rows->d_jual_barang_harjul;
					$sqty=$rows->d_jual_qty;
					$totqty=$qty-$sqty;
					$totaljual=$harjul*$qty;
					$d_jual_total=$rows->d_jual_total;
					$up1=$this->db->query("UPDATE tbl_detail_jual SET d_jual_qty='$qty',d_jual_total='$totaljual' where d_jual_id='$kode'");
					$spajak=$d_jual_total*10/100;
					$stotal=$d_jual_total+$spajak;
					$pajak=$totaljual*10/100;
					$totpajak=$totaljual+$pajak;
					$up2=$this->db->query("UPDATE tbl_jual SET jual_total=jual_total-'$d_jual_total'+'$totaljual',jual_pajak=jual_pajak-'$spajak'+'$pajak',jual_total_pajak=jual_total_pajak-'$stotal'+'$totpajak',jual_jml_uang=jual_jml_uang-'$stotal'+'$totpajak' where jual_nofak='$faktur'");
					$up3=$this->db->query("UPDATE tbl_detail_barang SET d_barang_stok=d_barang_stok+'$sqty'-'$qty' where d_barang_id='$dbrgid'");
					$up4=$this->db->query("UPDATE tbl_barang SET barang_total_stok=barang_total_stok+'$sqty'-'$qty' where barang_id='$brgid'");	
					echo $this->session->set_flashdata('msg','Berhasil Mengedit Detail Faktur dan menambahkan '.$totqty.' stok Barang '.$dbrgnm.' ke Faktur');
					echo $this->session->set_flashdata('alert','success');
					return $up4;
				    redirect('admin/tabel_penjualan');
				}
			}
		}
	}
}