<?php 
$b=$data->row_array();
$c=$jml->row_array();
$d=$jmlretur->row_array();
if($tombol==1){
$namafile=$c['bulan']."_".$b['pelanggan_nama'];
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$namafile.xls");
}
?>
<html lang="en" moznomarginboxes mozdisallowselectionprint>
<head>
    <title>Laporan Penjualan Per Pelanggan</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/laporan.css')?>"/>
</head>
<body onload="window.print()">
<div id="laporan">
<table align="center" style="width:900px; border-bottom:3px double;border-top:none;border-right:none;border-left:none;margin-top:5px;margin-bottom:20px;">
<!--<tr>
    <td><img src="<?php// echo base_url().'assets/img/kop_surat.png'?>"/></td>
</tr>-->
</table>

<table border="0" align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:0px;">
<tr>
    <td colspan="9" style="width:800px;paddin-left:20px;"><center><h4>LAPORAN PENJUALAN PER PELANGGAN ALL MEREK</h4></center></td>
</tr>
<tr>
    <td colspan="9" style="width:800px;paddin-left:20px;"><center><h4>PT. PARIT PANJANG</h4></center></td>
</tr>
                       
</table>
 
<table border="0" align="center" style="width:900px;border:none;">
        <tr>
            <th style="text-align:left"></th>
        </tr>
</table>
<table border="1" align="center" style="width:900px;margin-bottom:20px;">
<thead>
<tr>
    <th colspan="9" style="text-align:left;">Nama Pelanggan : <?php echo $b['pelanggan_nama'];?></th>
</tr>
<tr>
    <th colspan="9" style="text-align:left;">Bulan ke : <?php echo $b['bulan'];?></th>
</tr>
<tr>
    <th class="garis" style="width:50px;">No</th>
    <th class="garis">No Faktur</th>
    <th class="garis">Tanggal</th>
    <th class="garis">Pelanggan Nama</th>
    <th class="garis">Keterangan</th>
    <th class="garis">Sales</th>
    <th class="garis">Total</th>
    <th class="garis">Pajak</th>
    <th class="garis">Total+Pajak</th>
</tr>
</thead>
<tbody>
<?php 
$no=0;
    foreach ($data->result_array() as $i) :
        $no++;
        $nofak=$i['jual_nofak'];
        $fak=$i['jual_fak'];
        $tgl=$i['jual_tanggal'];
        $pelanggan=$i['pelanggan_nama']; 
        $sales=$i['sales_nama']; 
        $total=$i['jual_total'];
        $pajak=$i['jual_pajak'];
        $totalpajak=$i['jual_total_pajak'];
        $ket=$i['jual_keterangan'];
?>
    <tr style="background-color:#DCDCDC;">
        <td style="border-top: 1px solid black;text-align:center;"><?php echo $no;?></td>
        <td class="garis" style="padding-left:5px;"><?php echo $fak;?></td>
        <td class="garis" style="text-align:center;"><?php echo $tgl;?></td>
        <td class="garis" style="text-align:center;"><?php echo $pelanggan;?></td>
        <td class="garis" style="text-align:left;"><?php echo $ket;?></td>
        <td class="garis" style="text-align:left;"><?php echo $sales;?></td>
        <td class="garis" style="text-align:right;"><?php echo 'Rp '.number_format($total);?></td>
        <td class="garis" style="text-align:right;"><?php echo 'Rp '.number_format($pajak);?></td>
        <td class="garis" style="text-align:right;"><?php echo 'Rp '.number_format($totalpajak);?></td>
    </tr>
    <tr">
        <th style="background-color:#DCDCDC;"></th>
        <th class="garis" style="background-color:#E0FFFF;">No</th>
        <th class="garis" style="background-color:#E0FFFF;">Merek</th>
        <th class="garis" style="background-color:#E0FFFF;">Nama Barang</th>
        <th class="garis" style="background-color:#E0FFFF;">Satuan</th>
        <th class="garis" style="background-color:#E0FFFF;">Qty</th>
        <th class="garis" style="background-color:#E0FFFF;">Sub Total</th>
        <th class="garis" style="background-color:#E0FFFF;">Sub Pajak</th>
        <th class="garis" style="background-color:#E0FFFF;">Total</th>
    </tr>
    <?php 
    $noo=0;
    foreach ($detail->result_array() as $j) :
        if($j['jual_fak']==$fak):
            $noo++;?>
            <tr>
                <td style="background-color:#DCDCDC;"></td>
                <td class="garis" style="text-align:center;"><?php echo $noo;?></td>
                <td class="garis" style="text-align:center;"><?php echo $j['kategori_nama'];?></td>  
                <td class="garis" style="text-align:center;"><?php echo $j['barang_nama'].' '.$j['barang_spesifikasi'];?></td>  
                <td class="garis" style="text-align:center;"><?php echo $j['satuan_nama'];?></td>  
                <td class="garis" style="text-align:center;"><?php echo $j['d_jual_qty'];?></td>  
                <td class="garis" style="text-align:right;"><?php echo  'Rp '.number_format($j['d_jual_total'],2,',','.');?></td>  
                <td class="garis" style="text-align:right;"><?php echo  'Rp '.number_format($j['d_jual_total']*10/100,2,',','.');?></td>  
                <td class="garis" style="text-align:right;"><?php echo  'Rp '.number_format($j['d_jual_total']+($j['d_jual_total']*10/100),2,',','.');?></td>  
            </tr>
       <?php endif;?>
    <?php endforeach; ?>
<?php endforeach;?>
</tbody>
<tfoot>
    <tr>
        <td class="garis" colspan="6" style="text-align:center;"><b>Total Kotor</b></td>
        <td class="garis" style="text-align:right;"><b><?php echo 'Rp '.number_format($c['total'],2,',','.');?></b></td>
        <td class="garis" style="text-align:right;"><b><?php echo 'Rp '.number_format($c['pajak'],2,',','.');?></b></td>
        <td class="garis" style="text-align:right;"><b><?php echo 'Rp '.number_format($c['total_pajak'],2,',','.');?></b></td>
    </tr>
    <tr>
        <td class="garis" colspan="6" style="text-align:center;"><b>Total Return</b></td>
        <td class="garis" style="text-align:right;"><b><?php echo 'Rp '.number_format($d['total'],2,',','.');?></b></td>
        <td class="garis" style="text-align:right;"><b><?php echo 'Rp '.number_format($d['pajak'],2,',','.');?></b></td>
        <td class="garis" style="text-align:right;"><b><?php echo 'Rp '.number_format($d['total_pajak'],2,',','.');?></b></td>
    </tr>
    <tr>
        <td class="garis" colspan="6" style="text-align:center;"><b>Total Bersih</b></td>
        <td class="garis" style="text-align:right;"><b><?php echo 'Rp '.number_format($c['total']-$d['total'],2,',','.');?></b></td>
        <td class="garis" style="text-align:right;"><b><?php echo 'Rp '.number_format($c['pajak']-$d['pajak'],2,',','.');?></b></td>
        <td class="garis" style="text-align:right;"><b><?php echo 'Rp '.number_format($c['total_pajak']-$d['total_pajak'],2,',','.');?></b></td>
    </tr>
</tfoot>
</table>
<table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
    <tr>
        <td></td>
</table>
<table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td align="right">Palembang, <?php echo date('d-M-Y')?></td>
    </tr>
    <tr>
        <td align="right"></td>
    </tr>
   
    <tr>
    <td><br/><br/><br/><br/></td>
    </tr>    
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td align="right">( <?php echo $this->session->userdata('nama');?> )</td>
    </tr>
    <tr>
        <td align="center"></td>
    </tr>
</table>
<table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
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