<?php 
$b=$data->row_array();
$c=$jml->row_array();
if($tombol==1){
$namafile=$c['bulan']."_".$b['suplier_nama'];
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$namafile.xls");
}
?>
<html lang="en" moznomarginboxes mozdisallowselectionprint>
<head>
    <title>Laporan Pembelian Per Principal</title>
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
    <td colspan="2" style="width:800px;paddin-left:20px;"><center><h4>LAPORAN PEMBELIAN PER SUPLIER</h4></center><br/></td>
</tr>
<tr>
    <td colspan="2" style="width:800px;paddin-left:20px;"><center><h4>PT. PARIT PANJANG</h4></center><br/></td>
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
    <th colspan="11" style="text-align:left;">Nama Principal : <?php echo $b['suplier_nama'];?></th>
</tr>
<tr>
    <th colspan="11" style="text-align:left;">Bulan ke : <?php echo $c['bulan'];?></th>
</tr>
<tr>
    <th class="garis" style="width:50px;">No</th>
    <th class="garis">No Faktur</th>
    <th class="garis">Tanggal</th>
    <th class="garis">Principal Nama</th>
    <th class="garis">Total+Pajak</th>
</tr>
</thead>
<tbody>
<?php 
$no=0;
    foreach ($data->result_array() as $i) {
        $no++;
        $nofak=$i['beli_nofak'];
        $tgl=$i['beli_tanggal'];
        $total=$i['beli_total'];
        $suplier=$i['suplier_nama'];
?>
    <tr>
        <td class="garis" style="text-align:center;"><?php echo $no;?></td>
        <td class="garis" style="text-align:left;"><?php echo $nofak;?></td>
        <td class="garis" style="text-align:center;"><?php echo $tgl;?></td>
        <td class="garis" style="text-align:left;"><?php echo $suplier;?></td>
        <td class="garis" style="text-align:right;"><?php echo 'Rp '.number_format($total);?></td>
    </tr>
<?php }?>
</tbody>
<tfoot>
    <tr>
        <td colspan="4" style="text-align:center;"><b>Total</b></td>
        <td style="text-align:right;"><b><?php echo 'Rp '.number_format($c['total']);?></b></td>

    </tr>
</tfoot>
</table>
<table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
    <tr>
        <td></td>
</table>
<table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
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