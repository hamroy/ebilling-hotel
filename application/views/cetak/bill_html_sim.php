<html>
<head>
<style type="text/css">
html{
	padding-top: 20%
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
    
   

    <hr/>
 <table border="1" width="100%" >
	<tr>
		<th colspan="9" align="left"><img align="left" src="<?php echo base_url();?>images/<?=$s?>.png" width="150" /><h4><b></b></h4></th>
	</tr>
	<tr>
		<th class="warning" align="left">Nota.no</th>
		<th colspan="8" align="left">
		<?php 
		// $totd=$cas0+$trans0;
		 	$totd=$this->Mhotel->total_deposit_sim($id_p);/////tidak deposit total yag di payment
			$totdll=$this->Mhotel->total_all_sim($id_p); ////menggunakan deposit total yag di payment /alll semua deposit
			
			$t=$this->Mhotel->get_refund_via_sim($id_p); ///tbl lap refund
			
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
			if($disckam==0){////paymen kosong bila disc kosong
				$payment=0;
			}else{
			$payment=$p-$disckam;
			//$payment=$this->Mhotel->temporary_payment($id_p);	
			}
			///
			$paymentall=$p-$disckam	;
			$totalall=$totdll-$paymentall;////untiuk total 
			///
		if($h_row->refund_status=='lunas' or $h_row->refund=='pas'){
		if($h_row->tipe=='K'){ 
				if($totalall > 0){ 
				///GET KOLOM VIA DI LAP REFUND============================================================10317
				if($t->row()->via=='cash'){
					//echo 'RC'; //reffun cas 3
					echo $this->Mhotel->getnotanama(3);
				}else{
					//echo 'RT'; //refund transfer 4
					echo $this->Mhotel->getnotanama(4);
				}
				//==============================
				
				}else{
					//echo 'K'; //tunai 1
					echo $this->Mhotel->getnotanama(1);
					//echo $h_row->tipe.''.$totalall.''.$h_row->nota;
		}echo $h_row->nota;
		}elseif($h_row->tipe=='N'){
			if($totalall > 0){ 
			
			///GET KOLOM VIA DI LAP REFUND============================================================10317
				if($t->row()->via=='cash'){
					//echo 'RC'; //reffun cas 3
					echo $this->Mhotel->getnotanama(3);
				}else{
					//echo 'RT'; //refund transfer 4
					echo $this->Mhotel->getnotanama(4);
				}
				//==============================
			
			}else{
					//echo ''; ///transfer //non tunai 2
					echo $this->Mhotel->getnotanama(2);
		} 
		echo $h_row->nota;
		}else{
			 } 
			 
			 } ///refund
			 ?>
		
			
			
		</th>
	</tr>
	<tr>
		<th class="warning" align="left">Name</th>
		<th colspan="8" align="left"><?=$h_row->nama?></th>
	</tr>
	<tr>
		<td class="warning">Address</td>
		<td colspan="8"><?=$h_row->alamat?></td>
	</tr>
	<tr>
		<td class="warning">Check in</td>
		<td class="success">date</td>
		<td><?php  
		///=================================================CEK in============================================================
		$g_id_min=$this->Mhotel->get_tbl_bill_tgl_min_sim($id_p)->row();
		 $sorttmin= $g_id_min->sort_t;
		 $xxxm=substr($sorttmin,'0','4');
				$xxm=substr($sorttmin,'4','2');
				$xm=substr($sorttmin,'6','2');
				echo  $xm.'-'.$xxm.'-'.$xxxm;
		?></td>
		<td class="success">time</td>
		<td colspan="2"><?=substr($h_row->cekin,'11')?></td>
		<td colspan="3"></td>
	</tr>
	
	<tr>
		<td class="warning">Check out</td>
		<td class="success">date</td>
	<td><?php 
					$g_id_mak=$this->Mhotel->get_tbl_perpanjang_mak_sim($id_p)->row();
					$g_id_mak_bill=$this->Mhotel->get_tbl_perpanjang_mak_new_sim($id_p)->row();
		if(empty($g_id_mak->cekout)){
			 $sortt= $g_id_mak_bill->sort_t+1;
		}else{
			 $sortt= $g_id_mak->cekout;
		}
		
			    $xxx=substr($sortt,'0','4');
				$xx=substr($sortt,'4','2');
				$x=substr($sortt,'6','2');
				echo  $x.'-'.$xx.'-'.$xxx;
		
		//substr($h_row->cekin,'0','-6')
		?></td>
		<td class="success">time</td>
		<td colspan="2"><?=substr($h_row->cekout,'11')?></td>
		<td colspan="3"></td>

	</tr>
	
	<tr>
		<td colspan="6" align="left">
			<table border="1" width="100%">

	<tr>
		<td></td>
		<td class="warning">Date</td>
		<td class="warning">No. Nota</td>
		<td class="warning">Trnsfr (Rp)</td>
		<td class="warning">Cash (Rp)</td>
	</tr>
	
	
	<?php 
	//$d=$this->db->get_where('tbl_deposit',array('id_p'=>$id_p));
	$d=$this->Mhotel->get_all_deposit_total_sim($id_p);
	$no=1;
	foreach($d->result() as $dep){ 
	$jml = $dep->cas + $dep->transfer;
	if ($jml != 0 ){
	?>
		<tr>
		<td class="success">Deposit <?=$no++?></td>
		<td><?=$dep->tanggal?></td>
		<td><?=$dep->nota?></td>
		<td> <p align="right">
		<?php 
		echo ! empty($dep->transfer)? number_format($dep->transfer,0,',','.') :'';
		
		?>
			
			
		</p>
		</td>
		<td ><p align="right"><?php if(!empty($dep->cas)){
			echo ! empty($dep->cas)? number_format($dep->cas,0,',','.') :'';
		} ?>
		
			</p>
		</td>
	</tr>
<?php	}} ?>
	
	
	
	</table>
		</td>
		<td colspan="3" >
			<table border="1" width="100%" >
<!---->
<?php 
			
			
			if($totdll>=$paymentall){
				$wt='success';
				
			}else{
				$wt='danger';
				
			}
			
			 ?>
<!---->
	<tr>
		<td class="success" >Amount</td>
		<td align="right"><?=number_format($p,0,',','.')?></td>
	</tr>
	<tr>
		<td class="success" >Disc <span class="pull-right"></span></td>
		<td align="right"><?php
		if($disckam!=0){
			echo number_format($disckam,0,',','.');
		}?></td>
	</tr>
	<!--<tr>
		<td class="success" >Temporary Payment </td>
		<td  align="right"><?php
		///$payment = $this->Mhotel->temporary_payment($id_p);
		echo number_format($payment,0,',','.')
		?></td>
	</tr>-->
	<tr>
		<td class="success" >Deposit</td>
		<td align="right"  >
			
			<?php
			if($totd!=0){
			echo number_format($totd,0,',','.');
		} ?>
		</td>
	</tr>
	<tr>
		<td class="warning"><?php if($totalall > 0){ echo 'Refund';}else{
			echo 'Payment';
		}  ?></td>
		<td  align="right" class="<?=$wt?>">
		<?php
		//revisi masterpra:
		//setelah dilunasi, tidak boleh 0 (nol), harus bernilai positif sesuai jumlah pelunasan
		if ($totalall > 0){
		///echo number_format($this->Mhotel->total_payment_lunas($id_p),0,',','.'); //rev pra
		echo '+'.number_format($totalall,0,',','.'); ////rev ilham  : bila lebih munculkan yang lebihnya pake (+)
		
		}elseif($totalall ==0){
			$getpelunasan=$this->Mhotel->total_payment_lunas_ilham_sim($id_p);
			echo number_format($getpelunasan,0,',','.');
		}
		else{ 
		echo  number_format($totalall,0,',','.');
		}
		?>  
		</td>
	</tr>
	
	</table>
		</td>
	</tr>
	<tr>
		<td colspan="9">
			
		</td>
	</tr>
	
	<tr>
		<td colspan="9">
	<table border="1" width="100%">
	<thead>
	<tr class="success">
		<td align="center" colspan="8">Room, Bed, & OT</td>
	</tr>
	
	<tr class="warning">
		<td>Date</td>
		<td>Room.no</td>
		<td>Bed / day</td>
		<td>OT / hours</td>
		<td>DISC</td>
		<td>Early Check In</td>
		<td>Amount</td>
		<td>Balance</td>

	</tr>
	</thead>
	<tbody>
	<?php
	
	$tot=0;
	foreach($h->result() as $hh){ 
	//$amm = $this->db->get_where('tbl_pesan_kamar',array('id'=>$hh->id_k));
	$am = $this->db->get_where('tbl_kamar',array('id_kamar'=>$hh->id_k))->row();
	if($hh->ot<4){
		$ot=$am->ot;
	}else{
		$ot=$am->ot2;
	}
	?>
		<tr>
		<td ><?=$hh->tanggal?></td>
		<td>
		<!--rev 7/2/17 penhasan harga kaamar ok remove-->
		<?php 
		$dk=$hh->delkam;
		if($dk=='ya'){
			$hrgakam=0;
			$saa='remove';
			$lia='';
		}else{
			$hrgakam=$am->harga;
			 $lia=' ('.number_format($am->harga,0,',','.').')';
			$saa='ok';
		}
		?>
		<?=$hh->id_k?> <?=$lia?>
		</td>
		<!--BED-->
		<td>
		<?=!empty($hh->bed) ?  $hh->bed .'.( '.number_format($am->bed,0,',','.').' )':''?>
  		</td>
		<!--OT-->
		<td>
		<?=!empty($hh->ot) ?  $hh->ot.'.( '.number_format($ot,0,',','.').' )' :''?>
  		</td>
		<!--DISC-->
		<!--DISC-->
		<td align="right">
		<?php 
		$dtot=(int)$hrgakam;
		$disc=((int)$hh->disc*$dtot)/100;
		if($disc >0){
			echo number_format($disc,0,',','.');
		}
		?></td>
					<!--EARLY CHECK IN-->
			<td align="right">
		<?php 
		$h_kam=$hrgakam;
		if($hh->early == 1){
			//$has_early=$h_kam+$bg_kam;
			$bg_kam=($am->harga/2);
			if($bg_kam >0){
		echo number_format($bg_kam,0,',','.');	
		}
		}else{
			$bg_kam='';
		}
		
		?>
			</td>
			<!--AMOUNT & BALANCE----------------------------------------------------------------------------------------->		
				<td align="right">
				<?php 
		//number_format($hrgakam,0,',','.');
		///EV maret 17
		$hrgakamdahdisc=(int)$hrgakam-(int)$disc;
		$tot=($tot+$hrgakamdahdisc+(int)$hh->harga_bed+(int)$hh->harga_ot+(int)$bg_kam);
		echo number_format(($hrgakamdahdisc+(int)$hh->harga_bed+(int)$hh->harga_ot+(int)$bg_kam),0,',','.');
		
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
	<tr>
		<td colspan="9"></td>
	</tr>
	<tr>
		<td colspan="9">
			 <table border="1" width="100%">
	<tr class="success">
		<td  colspan="4">Food and Beverage (attached) Rp.<?=number_format($this->Mhotel->total_aux_sim($id_p),0,',','.')?></td>
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