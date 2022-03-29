<html lang="en" moznomarginboxes mozdisallowselectionprint>
    <head>
        <title>Faktur Penjualan Barang</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="<?=base_url('assets/css/laporan.css')?>"/>
        <link rel="stylesheet" type="text/css" href="https://id.allfont.net/allfont.css?fonts=dot-matrix">
    </head>
    <?php
    function penyebut($nilai) {
            $nilai = abs($nilai);
            $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
            $temp = "";
            if ($nilai < 12) {
                $temp = " ". $huruf[$nilai];
            } else if ($nilai <20) {
                $temp = penyebut($nilai - 10). " Belas";
            } else if ($nilai < 100) {
                $temp = penyebut($nilai/10)." Puluh". penyebut($nilai % 10);
            } else if ($nilai < 200) {
                $temp = " Seratus" . penyebut($nilai - 100);
            } else if ($nilai < 1000) {
                $temp = penyebut($nilai/100) . " Ratus" . penyebut($nilai % 100);
            } else if ($nilai < 2000) {
                $temp = " Seribu" . penyebut($nilai - 1000);
            } else if ($nilai < 1000000) {
                $temp = penyebut($nilai/1000) . " Ribu" . penyebut($nilai % 1000);
            } else if ($nilai < 1000000000) {
                $temp = penyebut($nilai/1000000) . " Juta" . penyebut($nilai % 1000000);
            } else if ($nilai < 1000000000000) {
                $temp = penyebut($nilai/1000000000) . " Milyar" . penyebut(fmod($nilai,1000000000));
            } else if ($nilai < 1000000000000000) {
                $temp = penyebut($nilai/1000000000000) . " Trilyun" . penyebut(fmod($nilai,1000000000000));
            }     
            return $temp;
        }
     
        function terbilang($nilai) {
            if($nilai<0) {
                $hasil = "Minus ". trim(penyebut(ceil($nilai)));
            } else {
                $hasil = trim(penyebut($nilai));
            }           
            return $hasil;
        }
    ?>
    <!--onload="window.print()"-->
    <body style="font-family: 'Arial';width: 8.5in;height: 5.5in;border-spacing: 1px;">
        <div id="laporan">
            <table align="center">
            <!--<tr>
                <td><img src="<?php// echo base_url().'assets/img/kop_surat.png'?>"/></td>
            </tr>-->
            </table>
            <?php 
                $b=$data->row_array();
            ?>
            <table border="1" align="center" style="width:780px;margin-top:5px;margin-bottom:0.2px;">
                <tr>
                    <th rowspan="4" class="garis"><img src="<?=base_url().'assets/img/logoparit.png'?>" width="50px" height="50px" style="margin: 5px;"/></th>
                    <th colspan="3" class="garis" style="width: 500px;font-size: 14px;">FAKTUR PENJUALAN</th>
                    <th colspan="3" class="garis" style="font-size: 14px;">Kepada Yth.</th>
                </tr>
                <tr>
                    <td colspan="3" style="font-size: 14px;">PT.PARIT PANJANG</td>
                    <td colspan="3" style="border-left: 1px solid;font-size: 14px;"><?=$b['pelanggan_nama'];?></td>   
                </tr>
                <tr>
                    <td colspan="3" style="font-size: 14px;">Komp.Villa Kenten Blok G.2 Kel. Sukamaju Palembang</td>
                    <td colspan="3" style="border-left: 1px solid;font-size: 13px;"><?=$b['pelanggan_alamat'];?></td>   
                </tr>     
                <tr>
                    <td colspan="3" style="font-size: 14px;">NPWP : 03 152 490 3 307 000</td>
                    <td colspan="3" style="border-left: 1px solid;font-size: 14px;">NPWP : <?=$b['pelanggan_nonpwp'];?></td> 
                </tr> 
                <tr class="garis">
                    <td class="garis" style="text-align:center;font-size: 14px;" width="10%">Sales</td>
                    <td class="garis" style="text-align:center;font-size: 14px;" width="15%">No Faktur</td>
                    <td class="garis" style="text-align:center;font-size: 14px;" width="18%">Tgl Faktur</td>
                    <td class="garis" colspan="2" style="text-align:center;font-size: 14px;" width="20%">Tgl Jatuh Tempo</td>
                    <td class="garis" style="text-align:center;font-size: 14px;" width="15%">Pembayaran</td>
                    <td class="garis" style="text-align:center;font-size: 14px;" width="15%">No PO</td> 
                </tr>
                <tr class="garis">
                    <td class="garis" style="font-family: 'Calibri';text-align:center;font-size: 16px;"><?=$b['sales_nama'];?></td>
                    <td class="garis" style="font-family: 'Calibri';text-align:center;font-size: 16px;"><?=$b['jual_fak'];?></td>
                    <td class="garis" style="font-family: 'Calibri';text-align:center;font-size: 16px;"><?=$b['jual_tanggal'];?></td>
                    <td class="garis" colspan="2" style="font-family: 'Calibri';text-align:center;font-size: 16px;"><?=$b['jual_tgl_byr_kredit'];?></td>
                    <td class="garis" style="font-family: 'Calibri';text-align:center;font-size: 16px;"><?=$b['jual_keterangan'];?></td>
                    <td class="garis" style="font-family: 'Calibri';text-align:center;font-size: 16px;"><?=$b['jual_nopo'];?></td>
                </tr>
                <tr style="height: 2px;"></tr>
            </table>
            <table border="1" align="center" style="width:780px;margin-bottom:0.2px;">
                <thead>

                    <tr>
                        <th style="border: 1px solid;font-size: 13px;" width="3%">No</th>
                        <th style="border: 1px solid;font-size: 13px;" width="10%">LOT</th>
                        <th style="border: 1px solid;font-size: 13px;" width="10%">ED</th>
                        <th style="border: 1px solid;font-size: 13px;" width="10%">Merek</th>
                        <th style="border: 1px solid;font-size: 13px;" width="35%">Nama Barang</th>
                        <th style="border: 1px solid;font-size: 13px;" width="5%">Satuan</th>
                        <th style="border: 1px solid;font-size: 13px;" width="4%">Qty</th>
                        <th colspan="2" style="border: 1px solid;font-size: 13px;" width="8%">Harga</th>
                        <th style="border: 1px solid;font-size: 13px;" width="4%">Disc%</th>
                        <th style="border: 1px solid;font-size: 13px;" width="12%">SubTotal</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $no=0;
                    foreach ($data->result_array() as $a) {
                        $no++;
                        $nofak=$a['d_jual_nofak'];
                        $idbrg=$a['d_jual_d_barang_id'];
                        $harjul=$a['d_jual_barang_harjul'];
                        $qty=$a['d_jual_qty'];
                        $diskon=$a['d_jual_diskon'];
                        $total=$a['d_jual_total'];
                ?>
                    <tr>
                        <td style="text-align:center;border: 1px solid;font-size: 14px;"><?=$no;?></td>
                        <?php foreach ($barang->result_array() as $b):
                            $id=$b['d_barang_id'];
                            $nm=$b['barang_nama'];
                            $spc=$b['barang_spesifikasi'];
                            $kat=$b['kategori_nama'];
                            $satuan=$b['satuan_nama'];
                            $d_barang_id=$b['d_barang_brg_id'];
                            $d_barang_lot=$b['d_barang_lot'];
                            $d_barang_exp=$b['d_barang_exp'];
                            $d_barang_stok=$b['d_barang_stok'];
                            $d_barang_harga_pokok=$b['d_barang_harga_pokok'];
                            $d_barang_tgl_input=$b['d_barang_tgl_input'];
                            $d_barang_tgl_update=$b['d_barang_tgl_last_update'];
                            $d_barang_status=$b['d_barang_status'];
                            $beli_kode=$b['d_barang_beli_kode'];
                            $nama=$nm.' '.$spc;?>
                            
                        <?php if($idbrg==$id):?>
                        <td style="text-align:center;border: 1px solid;font-size: 14px;"><?=$d_barang_lot;?></td>
                        <td style="text-align:center;border: 1px solid;font-size: 14px;"><?=$d_barang_exp;?></td>
                        <td style="text-align:center;border: 1px solid;font-size: 14px;"><?=$kat;?></td>
                        <td style="text-align:left;border: 1px solid;font-size: 14px;"><?=substr($nama, 0, 50);?></td>
                        <td style="text-align:center;border: 1px solid;font-size: 14px;"><?=$satuan;?></td>
                        <?php endif;?>
                        <?php endforeach;?>
                        <td style="text-align:center;border: 1px solid;font-size: 14px;"><?=$qty;?></td>
                        <td style="text-align:right;border: 1px solid;font-size: 14px;" colspan="2"><?=number_format($harjul,2);?></td>
                        <td style="text-align:center;border: 1px solid;font-size: 14px;"><?=$diskon;?></td>
                        <td style="text-align:right;border: 1px solid;font-size: 14px;"><?=number_format($total,2);?></td>
                    </tr>
                <?php }?>
                </tbody>
                <tfoot>
                    <tr class="garis">
                        <td width="10%" colspan="2" style="font-size: 14px;"><u>Terbilang :</u></td>
                        <td width="10%" colspan="3" style="font-size: 13px;"><u></u></td>
                        <td colspan="2" style="text-align:center;font-size: 14px;" class="garis">Total</td>
                        <td style="text-align: right;font-size: 14px;">Rp.</td>
                        <td colspan="3" style="text-align:right;font-size: 14px;"><?=number_format($a['jual_total'],2);?></td>
                    </tr>
                    <tr class="garis">
                        <td style="font-size: 14px;" rowspan="2" colspan="5"><b><i><?=ucwords(number_to_words($a['jual_total_pajak'])).' Rupiah';?></i></b></td>
                        <td colspan="2" style="text-align:center;font-size: 14px;" class="garis">PPN 10%</td>
                        <td style="text-align: right;font-size: 14px;">Rp.</td>
                        <td colspan="3" style="text-align:right;font-size: 14px;"><?=number_format($a['jual_pajak'],2);?></td>
                    </tr>
                    <tr class="garis">
                        <td colspan="2" style="text-align:center;font-size: 14px;" class="garis">Grand Total</td>
                        <td style="text-align: right;font-size: 14px;">Rp.</td>
                        <td colspan="3" style="text-align:right;font-size: 14px;"><?=number_format($a['jual_total_pajak'],2);?></td>
                    </tr>
                </tfoot>
            </table>
            <table align="center" style="width:780px; border:1;margin-top:0px;margin-bottom:0px;">
                <tr>
                    <td colspan="4" align="left" style="font-size: 14px; width: 25%;" class="garis">Barang telah diterima dengan baik</td>
                </tr>
                <tr>
                    <td style="font-size: 14px;border-right: 1px solid black;">Transfer Rekening Bank A/N PT.Parit Panjang</td>
                    <td align="center" style="font-size: 14px; width: 20%;">Penerima</td>
                    <td align="center" style="font-size: 14px; width: 20%;">Hormat Kami</td>
                    <td align="center" style="font-size: 14px; width: 20%;">Diperiksa oleh</td>
                </tr>
                <tr style="width:300px;">
                    <td style="font-size: 13px;border-right: 1px solid black;">1. BNI : 1 6 1 1 1 9 7 1 9 9</td>
                    <td style="font-size: 13px;"></td>
                    <td style="font-size: 13px;"></td>
                    <td style="font-size: 13px;"></td>
                </tr>
                <tr style="width:300px;">
                    <td style="font-size: 13px;border-right: 1px solid black;">2. Mandiri : 1 1 3 0 0 0 7 0 8 8 0 6 9</td>
                    <td style="font-size: 13px;"></td>
                    <td style="font-size: 13px;"></td>
                    <td style="font-size: 13px;"></td>
                </tr>
                <tr style="width:300px;">
                    <td style="font-size: 13px;border-right: 1px solid black;">3. Bank Sumsel Babel : 1 5 0 6 1 0 1 1 3 7</td>
                    <td align="center" style="font-size: 14px;">( ................ )</td>
                    <td align="center" style="font-size: 14px;">( Direktur/Manager )</td>
                    <td align="center" style="font-size: 14px;margin-bottom: 20px;">( Logistik )</td>
                </tr>
            </table>
            <table align="center" style="width:780px; border:1;margin-top:-1px;margin-bottom:20px;">
                <tr style="font-size: 12px;">
                    <td width="10%"><u>Catatan :</u></td>
                    <td style="font-size: 12px;">Batas waktu maksimum retur 10 hari setelah tanggal faktur||Ketentuan retur: barang harus dalam kondisi baik </td>
                </tr>
            </table>
        </div>
    </body>
</html>