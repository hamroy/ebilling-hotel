<html>
<head>
<style type="text/css">
html{
	/* padding-top: 10% */
}

body {
	
    margin: 0.1in;
}
#kiri {
    width: 20%;
    float: left;
    padding: 10px;
}
#kanan {
    width: 80%;
}

h1, h2, h3, h4, h5, h6, li, blockquote, p, th, td {
    font-family: Helvetica, Arial, Verdana, sans-serif; /*Trebuchet MS,*/
}
h1, h2, h3, h4 {
    color: #000000;
    font-weight: normal;
}
h4, h5, h6 {
    color: #000000;
}
h2 {
    margin: 0 auto auto auto;
    font-size: x-large;
}
li, blockquote, p, th, td {
    font-size: 80%;
}
ul {
    list-style: url(/img/bullet.gif) none;
}

#footer {
    border-top: 1px solid #000000;
    text-align: right;
}

table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    font-family: "Trebuchet MS", Arial, sans-serif;
    color: black;    
}
td, th {
    padding: 4px;
}

p {page-break-after: always}
.footer {
	right: 0;
	position: fixed;bottom: 1px;
}
.pagenum:before {
	counter-increment: page;
	content: counter(page);
}
</style>
</head>
 <body>
 <div class="page-header" style="padding:10px">
   <br/>
        <h2 align="center"> ROOM RESERVATION</h2>
        <h3 align="center"> <?=$namapt?></h3>
        </div>
	<h4>Your Payment Details</h4>
    <hr/>
   
 <table border="1" width="100%" >
	<tr>
		<th colspan="5" align="left"><img align="left" src="<?php echo base_url();?>images/<?=$s?>.png" width="150" /><h4><b></b></h4></th>
	</tr>
	<tr>
		<th class="warning" align="left">Nota.no</th>
		<th colspan="4" align="left">
		<?php 
		// $totd=$cas0+$trans0;
			 $totd=$this->Mhotel->total_deposit($id_p); ///deposit
			 $totdll=$this->Mhotel->total_all($id_p); ///guest bill
			 $t=$this->Mhotel->get_refund_via($id_p); ///tbl lap refund
			 if($h_row->disc=='active'){
				 $disckam=(5*$totdisc)/100;
				 $active='Non active';
				$span='remove-sign';
				$hrf='NULL';
			}else{
				$active='active';
				$span='ok-circle';
				$hrf='active';
				$disckam=0;
			}
			///
			$p=0;
			if($disckam==0){////paymen kosong bila disc kosong
				$payment=0;
			}else{
			$payment=$p-$disckam;
			//$payment=$this->Mhotel->temporary_payment($id_p);	
			}
			///
			$paymentall=$p-$disckam	;
			$totalall=$totdll-$paymentall;////untiuk total 
			
			///rev 2/5/17
			//$getnota=$this->Mhotel->getnotanama();
			///rev 2/5/17
			
			///Print Nota
			if($h_row->tipe=='K'){ echo'DC'; }else{ echo 'DT' ;} ?><?=$h_row->nota;

			?>
		</th>
	</tr>
	<tr>
		<th class="warning" align="left">Name of the guest</th>
		<th colspan="4" align="left"><?=$h_row->nama?></th>
	</tr>
	<?php if ($h_row->bank != "Cash") {
	?>
	<tr>
		<td class="warning">Sender's Account</td>
		<td colspan="4"><?=$h_row->rek?> (<?=$h_row->bank?>)</td>
	</tr>
	<?php
	}
	?>
	<tr>
		<td class="warning">Check in</td>
		<td class="success">date</td>
		<td><?php  
		///=================================================CEK in============================================================
		$ti=substr($h_row->cekin,'0','2');
		$bi=substr($h_row->cekin,'3','2');
		$bln=array(
		'01'=>'Januari',
		'02'=>'Februari',
		'03'=>'Maret',
		'04'=>'April',
		'05'=>'Mei',
		'06'=>'Juni',
		'07'=>'Juli',
		'08'=>'Agustus',
		'09'=>'September',
		'10'=>'Oktober',
		11=>'November',
		12=>'Desember',
		);

		$thi= substr($h_row->cekin,'6','4');
		echo $ti.' '.'<b>'.$bln[$bi].'</b>'.' '.$thi;
		?></td>
		<td class="success">time</td>
		<td colspan="1"><?=substr($h_row->cekin,'11')?> ( WIB )</td>
	</tr>
	
	<tr>
		<td class="warning">Check out</td>
		<td class="success">date</td>
		<td><?php 
		$tc=substr($h_row->cekout,'0','2');
		$bc=substr($h_row->cekout,'3','2');
		$thc= substr($h_row->cekout,'6','4');

		echo $tc.' '.'<b>'.$bln[$bc].'</b>'.' '.$thc;
		
		//substr($h_row->cekin,'0','-6')
		?></td>
		<td class="success">time</td>
		<td colspan="1"><?=substr($h_row->cekout,'11')?> ( WIB )</td>

	</tr>
	
	<tr>
		<td colspan="5" align="left">
			<table border="1" width="100%">

	<tr>
		<td></td>
		<td class="warning">Date</td>
		<td class="warning">Trnsfr (Rp)</td>
		<td class="warning">Cash (Rp)</td>
	</tr>
	
		<tr>
		<td class="success">Deposit</td>
		<td><?php
		$tt=substr($h_row->tanggal,'0','2');
		$bt=substr($h_row->tanggal,'3','2');
		$tht= substr($h_row->tanggal,'6','4');
		?>
		<?=$tt.' '.'<b>'.$bln[$bt].'</b>'.' '.$tht?>
		</td>
		<td> <p align="right">
		<?php 
		echo $h_row->tipe != "K"? number_format($totalall,0,',','.') :'';		
		?>
			
			
		</p>
		</td>
		<td ><p align="right">
		<?php 
		echo $h_row->tipe == "K"? number_format($totalall,0,',','.') :'';
		?>
		
			</p>
		</td>
	</tr>
	
	</table>
		</td>
		
	</tr>

	<tr>
		<td colspan="5">
			
		</td>
	</tr>
	
	<tr>
		<td colspan="5">
	<table border="1" width="100%">
	<thead>
	<tr class="success">
		<td align="center" colspan="8">Rooms</td>
	</tr>
	
	<tr class="warning">
		<td width="17%">Type Room.no</td>
		<td>Amount</td>
		<td>Balance</td>

	</tr>
	</thead>
	<tbody>
	<?php
	$pec=explode('-', $h_row->id_k); ////di pecah di masukkan dalam erray
	$tot=0;
	for($i = 1; $i< count($pec); $i++){ 
	$am = $this->M_bill->getRoom($pec[$i]);
	$hrgakam = $am->harga_n;
	?>
		<tr>
		<td>
		<?=$am->jenis_kamar?> <?=$pec[$i]?>
		</td>
	
			<!--AMOUNT & BALANCE----------------------------------------------------------------------------------------->		
		<td align="right">
		<?php 
		$subTotal=(int)$hrgakam;
		$tot=($tot+$subTotal);
		echo number_format($subTotal,0,',','.');		
		?>			
		</td>

			
			<!--penjumlahan ber.ulang-->
		<td  align="right"><?=number_format($tot,0,',','.');?></td>
		</tr>
<?php	 }
	 ?>
	</tbody>
	
  </table>
			
		</td>
		
	</tr>
	
  </table>
		</td>
	</tr>
	</table>
<br/>

<br/>
  <div class="footer"><p align="right"><span class="pagenum"></span></p></div>
</body>
</html>