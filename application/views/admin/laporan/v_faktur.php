<html lang="en" moznomarginboxes mozdisallowselectionprint>
<head>
    <title>Faktur Penjualan Barang</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/laporan.css')?>"/>
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

<body onload="window.print()">
<div id="laporan">
<table align="center">
<!--<tr>
    <td><img src="<?php// echo base_url().'assets/img/kop_surat.png'?>"/></td>
</tr>-->
</table>
<?php 
    $b=$data->row_array();
?>
<table border="1" align="center" style="width:700px;margin-top:5px;margin-bottom:0px;">
<tr>
    <th rowspan="4" class="garis"><img src="<?php echo base_url().'assets/img/logoparit.png'?>" width="40px" height="40px"/></th>
    <th colspan="3" class="garis">FAKTUR PENJUALAN</th>
    <th colspan="2">Kepada Yth.</th>
</tr>
<tr>
    <td colspan="3">PT.PARIT PANJANG</th>
    <td colspan="2"><?php echo $b['pelanggan_nama'];?></td>   
</tr>
<tr>
    <td colspan="3">Komp.Villa Kenten Blok G.2 Kel. Sukamaju Palembang</th>
    <td colspan="2"><?php echo $b['pelanggan_alamat'];?></td>   
</tr>     
<tr>
    <td colspan="3">NPWP : 03 152 490 3 307 000</th>
    <td colspan="2"><?php echo $b['pelanggan_notelp'];?></td> 
</tr> 
<tr class="garis">
    <td style="text-align:center;">No Faktur</td>
    <td style="text-align:center;">Tgl Faktur</td>
    <td style="text-align:center;">Pembayaran</td>
    <td style="text-align:center;">Tgl Pembayaran</td>
    <td style="text-align:center;">Kerangan</td>
    <td style="text-align:center;">NPWP Pelanggan</td>
</tr>
<tr class="garis">
    <td style="text-align:left;"><?php echo $b['jual_nofak'];?></td>
    <th style="text-align:left;"><?php echo $b['jual_tanggal'];?></th>
    <th style="text-align:left;">[Eceran]</th>
    <th style="text-align:left;"><?php echo $b['jual_tanggal'];?></th>
    <td style="text-align:left;"><?php echo $b['jual_keterangan'];?></td>
    <td style="text-align:left;"><?php echo $b['pelanggan_nonpwp'];?></td>
</tr>
</table>

<table border="1" align="center" style="width:700px;">
        
        <tr>
            <th style="text-align:left;">Tanggal</th>
            
            <th style="text-align:left;">Tunai</th>
            <th style="text-align:left;">: <?php echo 'Rp '.number_format($b['jual_jml_uang']).',-';?></th>
        </tr>
        <tr>
            <th style="text-align:left;">Keterangan</th>
            
            <th style="text-align:left;">Kembalian</th>
            <th style="text-align:left;">: <?php echo 'Rp '.number_format($b['jual_kembalian']).',-';?></th>
        </tr>
</table>

<table border="1" align="center" style="width:700px;margin-bottom:20px;">
<thead>

    <tr>
        <th style="width:50px;">No</th>
        <th>Nama Barang</th>
        <th>Satuan</th>
        <th>Harga Jual</th>
        <th>Qty</th>
        <th>Diskon</th>
        <th>SubTotal</th>
    </tr>
</thead>
<tbody>
<?php 
$no=0;
    foreach ($data->result_array() as $i) {
        $no++;
        
        $nabar=$i['d_jual_barang_nama'];
        $satuan=$i['d_jual_barang_satuan'];
        
        $harjul=$i['d_jual_barang_harjul'];
        $qty=$i['d_jual_qty'];
        $diskon=$i['d_jual_diskon'];
        $total=$i['d_jual_total'];
?>
    <tr>
        <td style="text-align:center;"><?php echo $no;?></td>
        <td style="text-align:left;"><?php echo $nabar;?></td>
        <td style="text-align:center;"><?php echo $satuan;?></td>
        <td style="text-align:right;"><?php echo 'Rp '.number_format($harjul);?></td>
        <td style="text-align:center;"><?php echo $qty;?></td>
        <td style="text-align:right;"><?php echo 'Rp '.number_format($diskon);?></td>
        <td style="text-align:right;"><?php echo 'Rp '.number_format($total);?></td>
    </tr>
<?php }?>
</tbody>
<tfoot>

    <tr>
        <td colspan="6" style="text-align:center;"><b>Total</b></td>
        <td style="text-align:right;"><b><?php echo 'Rp '.number_format($b['jual_total']);?></b></td>
    </tr>
    <tr>
        <td style="text-align:center;"><b>Terbilang</b></td>
        <td colspan="6" style="text-align:right;"><b><?php echo terbilang($b['jual_total']).' Rupiah';?></b></td>
    </tr>
</tfoot>
</table>
<table align="center" style="width:700px; border:none;margin-top:5px;margin-bottom:20px;">
    <tr>
        <td></td>
</table>
<table align="center" style="width:700px; border:none;margin-top:5px;margin-bottom:20px;">
    <tr>
        <td align="right">Palembang, <?php echo date('d-M-Y')?></td>
    </tr>
    <tr>
        <td align="right"></td>
    </tr>
   
    <tr>
    <td><br/><br/><br/><br/></td>
    </tr>    
    <tr>
        <td align="right">( <?php echo $this->session->userdata('nama');?> )</td>
    </tr>
    <tr>
        <td align="center"></td>
    </tr>
</table>
<table align="center" style="width:700px; border:none;margin-top:5px;margin-bottom:20px;">
    <tr>
        <th><br/><br/></th>
    </tr>
    <tr>
        <th align="left"></th>
    </tr>
</table>
</div>
</body>
</html>