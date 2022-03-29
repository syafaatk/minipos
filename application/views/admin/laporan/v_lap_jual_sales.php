<?php 
$b=$data->row_array();
$c=$jml->row_array();
$d=$jmlretur->row_array();
if($tombol==1){
$namafile=$c['bulan']."_".$b['sales_nama'];
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$namafile.xls");
}
?>
<html lang="en" moznomarginboxes mozdisallowselectionprint>
<head>
    <title>Laporan Penjualan Per Sales</title>
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
    <td colspan="10" style="width:800px;paddin-left:20px;"><center><h4>LAPORAN PENJUALAN PER SALES</h4></center></td>
</tr>
<tr>
    <td colspan="10" style="width:800px;paddin-left:20px;"><center><h4>PT. PARIT PANJANG</h4></center></td>
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
    <th colspan="10" style="text-align:left;">Nama Sales : <?php echo $b['sales_nama'];?></th>
</tr>
<tr>
    <th colspan="10" style="text-align:left;">Bulan ke : <?php echo $c['bulan'];?></th>
</tr>
<tr>
    <th class="garis" style="width:50px;">No</th>
    <th class="garis">No Faktur</th>
    <th class="garis">Tanggal</th>
    <th class="garis">Pelanggan</th>
    <th class="garis">Sales Nama</th>
    <th class="garis">Keterangan</th>
    <th class="garis">id_jual</th>
    <th class="garis">Total</th>
    <th class="garis">Pajak</th>
    <th class="garis">Total+Pajak</th>
</tr>
</thead>
<tbody>
<?php 
$no=0;
    foreach ($data->result_array() as $i) {
        $no++;
        $nofak=$i['jual_nofak'];
        $fak=$i['jual_fak'];
        $tgl=$i['jual_tanggal'];
        $pelanggan=$i['pelanggan_nama']; 
        $total=$i['jual_total'];
        $pajak=$i['jual_pajak'];
        $totalpajak=$i['jual_total_pajak'];
        $sales=$i['sales_nama'];
        $ket=$i['jual_keterangan'];
?>
    <tr>
        <td class="garis" style="text-align:center;"><?php echo $no;?></td>
        <td class="garis" style="padding-left:5px;"><?php echo $fak;?></td>
        <td class="garis" style="text-align:center;"><?php echo $tgl;?></td>
        <td class="garis" style="text-align:center;"><?php echo $pelanggan;?></td>
        <td class="garis" style="text-align:left;"><?php echo $sales;?></td>
        <td class="garis" style="text-align:left;"><?php echo $ket;?></td>
        <td class="garis" style="text-align:left;"><?php echo $nofak;?></td>
        <td class="garis" style="text-align:right;"><?php echo 'Rp '.number_format($total,2,',','.');?></td>
        <td class="garis" style="text-align:right;"><?php echo 'Rp '.number_format($pajak,2,',','.');?></td>
        <td class="garis" style="text-align:right;"><?php echo 'Rp '.number_format($totalpajak,2,',','.');?></td>
    </tr>
<?php }?>
</tbody>
<tfoot>
    <tr>
        <td colspan="7" style="text-align:center;"><b>Total Kotor</b></td>
        <td style="text-align:right;"><b><?php echo 'Rp '.number_format($c['total'],2,',','.');?></b></td>
        <td style="text-align:right;"><b><?php echo 'Rp '.number_format($c['pajak'],2,',','.');?></b></td>
        <td style="text-align:right;"><b><?php echo 'Rp '.number_format($c['total_pajak'],2,',','.');?></b></td>
    </tr>
    <tr>
        <td colspan="7" style="text-align:center;"><b>Total Return</b></td>
        <td style="text-align:right;"><b><?php echo 'Rp '.number_format($d['total'],2,',','.');?></b></td>
        <td style="text-align:right;"><b><?php echo 'Rp '.number_format($d['pajak'],2,',','.');?></b></td>
        <td style="text-align:right;"><b><?php echo 'Rp '.number_format($d['total_pajak'],2,',','.');?></b></td>
    </tr>
    <tr>
        <td colspan="7" style="text-align:center;"><b>Total Bersih</b></td>
        <td style="text-align:right;"><b><?php echo 'Rp '.number_format($c['total']-$d['total'],2,',','.');?></b></td>
        <td style="text-align:right;"><b><?php echo 'Rp '.number_format($c['pajak']-$d['pajak'],2,',','.');?></b></td>
        <td style="text-align:right;"><b><?php echo 'Rp '.number_format($c['total_pajak']-$d['total_pajak'],2,',','.');?></b></td>
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
        <td></td>
        <td colspan="2" align="right">Palembang, <?php echo date('d-M-Y')?></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td align="right"></td>
        <td></td>
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
        <td></td>
        <td colspan="2" align="right">( <?php echo $this->session->userdata('nama');?> )</td>
        <td></td>
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