<script>

function loadPage(list) {

  location.href=list.options[list.selectedIndex].value

}

</script>
<?php
$h = "7";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -

$hm = $h * 60;

$ms = $hm * 60;

$tanggal = gmdate("d/m/Y ", time()+($ms)); // the "-" can be switched to a plus if that's what your time zone is.
$xxx=substr($tanggal,'6','4');

$xx=substr($tanggal,'3','2');

$x=substr($tanggal,'0','2');
?>
<div class="container">
<!--   <div class="alert alert-success alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Warning!</strong> Better check yourself, you're not looking too good.
</div>-->
 <div class="alert alert-success" style="padding-bottom: 0px">
 <form class="form-horizontal" role="form">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Pilih Tipe</label>
    <div class="col-sm-4">
      <select class="form-control" onchange="loadPage(this.form.elements[0])">
  <option value="<?=base_url('C_admin/rekap_nota/1/')?>" <?php if($tipe==1){echo'selected';}else{}?>>CASH</option>
  <option value="<?=base_url('C_admin/rekap_nota/2')?>" <?php if($tipe==2){echo'selected';}else{}?>>NON CASH</option>
  <option value="<?=base_url('C_admin/rekap_nota/3')?>" <?php if($tipe==3){echo'selected';}else{}?>>DEPOSIT CASH</option>
  <option value="<?=base_url('C_admin/rekap_nota/4')?>" <?php if($tipe==4){echo'selected';}else{}?>>DEPOSIT TRANSFER</option>
  <option value="<?=base_url('C_admin/rekap_nota/5')?>" <?php if($tipe==5){echo'selected';}else{}?>>REFUND CASH</option>
  <option value="<?=base_url('C_admin/rekap_nota/6')?>" <?php if($tipe==6){echo'selected';}else{}?>>REFUND TRANSFER </option>
  <option value="<?=base_url('C_admin/rekap_nota/7')?>" <?php if($tipe==7){echo'selected';}else{}?>>FOOD, BEVERAGE </option>
  <!--<option value="<?=base_url('C_admin/rekap_nota/8')?>" <?php if($tipe==8){echo'selected';}else{}?>>FOOD, BEVERAGE NON CASH </option>-->
</select>
    </div>
  </div>
 <hr/>
</form>
<form class="form-horizontal" action="<?=base_url('C_admin/rekap_nota/'.$tipe.'/'.$tgl.'/'.$tgl1)?>"  method="post" role="form">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Tanggal 1</label>
    <div class="col-sm-4">
       <input type="text" name="tanggal" id="datetimepicker11" placeholder="<?=$tanggal?>" class="form-control date" required>
    </div>
  </div>
<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Tanggal 2</label>
    <div class="col-sm-4">
       <input type="text" name="tanggal1"  id="datetimepicker11" placeholder="<?=$tanggal?>" class="form-control date" required>
    </div>
  </div>
<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"></label>
    <div class="col-sm-4">
        <button type="submit" class="btn btn-success">TAMPILKAN</button>
    </div>
  </div>
 
</form>
 </div>

<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3><b>REKAP NOTA</b></h3></div>
 <!--ISI REKAP-->
 <?php
 if($tipe!=7 and $tipe!=8){
 	
 
 ?>
 <!--ISI REKAP KAMAR-->
 
 <div class="table-responsive" >
        <table class="table table-striped table-hover table-condensed table-responsive table-bordered" style="font-size: 90%" >
	<tr>
		<td class="warning" rowspan="2" align="center"><b>No.</b></td>
		<td class="warning" rowspan="2" align="center"><b>No. Nota</b></td>
		<td class="warning" rowspan="2" align="center"><b>Nama</b></td>
		<td class="warning" rowspan="2" align="center"><b>No.kmr</b></td>
		<!--<td class="warning" rowspan="2" align="center"><b>Tarif</b></td>-->
		<td class="warning" rowspan="1" colspan="2" align="center"><b>Check In	</b></td>
		<td class="warning" rowspan="1" colspan="2" align="center"><b>Check Out	
</b></td>
		<td class="warning" rowspan="2" align="center"><b>Jmlh KxH</b></td>
		<td class="warning" rowspan="2" align="center"><b>Sumbangan</b></td>
		<td class="warning" rowspan="2" align="center"><b>Kamar
</b></td>
<td class="warning" rowspan="2"align="center"><b>Extra Bed</b></td>
<td class="warning" rowspan="2"align="center"><b>Overtime</b></td>
<td class="warning" rowspan="2" align="center"><b>Early Check in</b></td>
	</tr>
	<tr>
		
		<td class="warning" width="8%">Tanggal</td>
		<td class="warning" >Jam</td>
		<td class="warning" width="8%">Tanggal</td>
		<td class="warning" >Jam</td>
	</tr>
	<?php
	//$q=$this->Madmin->getkamar($id_user,$id_tgl,$shift); ///tbl_pesan_kamar
	
	
	
	$totalkamarcas=0;
	$totalkamardepocas=0;
	$totalkamardepot=0;
	$totalkamart=0;
	$totalexbed=0;
	$totalexbedtra=0;
	$totalot=0;
	$totalottra=0;
	$totaleary=0;
	$totalearytras=0;
	if($q!=NULL){
		
	
	if($q->num_rows() >0){ 
	$no=1;
	foreach($q->result() as $key){
		$ok=$key;
	
	$t=$this->Mhotel->get_refund_via($ok->id); ///tbl lap refund
	if($tipe==5){
	if($t->row()->via!='cash'){
		continue;
	}
	}elseif($tipe==6){
	if($t->row()->via=='cash'){
		continue;
	}	
	}else{
		
	}
		
	
	
	if(!empty($key->nota)){
		
	
		
		$dep=$this->Madmin->get_tbl_deposit($key->id)->row();
		//$ok=$this->Madmin->get_tbl_pesan_kamar($key->id_p);
		//$ok_kamar=$this->Madmin->get_tbl_kamar($ok->id_k);

	 ?>

	<tr>
		<td><?=$no++?></td>
		<th align="left">
		<?php 
		//-----------------------------------------------------------MEnghitung JUmlah Tagihan-------------------------------------
	
	
		 
		// $totd=$cas0+$trans0;
		//$qcekrf=$this->Madmin->ceklap_refund($id_user,$id_tgl,$shift);
		
		if($ok->boking!='ya'){
		if($ok->tipe=='K'){ 
		if($ok->refund_status=='lunas'){
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
					//echo 'K';
					echo $this->Mhotel->getnotanama(1);
		} echo $ok->nota;
		}elseif($ok->tipe=='N'){
		if($ok->refund_status=='lunas'){
			///GET KOLOM VIA DI LAP REFUND============================================================10317
				if($t->row()->via=='cash'){
					//echo 'RC'; //reffun cas 3
					echo $this->Mhotel->getnotanama(3);
				}else{
					//echo 'RT'; //refund transfer 4
					echo $this->Mhotel->getnotanama(4);
				}
				//==============================}else{
					//echo '';
					echo $this->Mhotel->getnotanama(2);
		} echo $ok->nota;
		}else{
			 	
			 }
			 //////////dp
			 }else{
			 	if($ok->tipe=='K'){ 
			 	//echo 'DC'; 
			 	echo $this->Mhotel->getnotanama(5);
			 	}else{
				//	echo 'DT';
					echo $this->Mhotel->getnotanama(6);
				}echo $ok->nota;
			 }
		//======================================================================================NOTA=====================
			  ?>
		
		</th>
		<td><?=$ok->nama?></td>
		<td><?=$ok->id_k?></td>
		<?php //=========================================================================PEMBUATAN KXH
	$h=$this->Mhotel->bill_hotel($ok->id);
	$tot=0;
	//===============================================================KHX
	$pec=explode('-',$ok->id_k);
	$hk=0;
	//$bed=0;
	//$bedd=0;
	//$earlyy=0;
	$hxk=0;
	///////////========================================REV KXH 25317
	foreach($h->result() as $kx){
		$kama=$this->M_bill->getRoom($kx->id_k)->nilai;	
		//$kamnil=$this->Madmin->get_nilai_k($kx->id_k)->row()->delkam; ////ke tabel tbl_bill_hotel
		$kamnil=$kx->delkam; ////ke tabel tbl_bill_hotel
		$bed=$kx->bed; /////ke tabel tbl_bill_hotel
		$early=$kx->early; ////ke tabel tbl_bill_hotel
			////////////////////////////////////////////////////////////////////////////////////////
			///-------------------------------------CEK delet kamar
			if($kamnil=='ya'){
			$nilaikamar=0;
			
			}else{
			$nilaikamar=$kama;
		
			}
			////==================================BED
		    if($bed!=NULL){
				$bedd=($bed*1/2);
			}else{
				$bedd=0;
			}
			///===========================================EARLY
			 if($early==1){
				$earlyy=1/2;
			}else{
				$earlyy=0;
			}
			///////////////////////////////////////////TOTAL
			$hxk=$hxk+(int)$nilaikamar+(int)$bedd+(int)$earlyy;////
			$hk=$hk+(int)$nilaikamar;////
			
			////////////////////////////////////////////////////////////////////////////////////////
	
	} //loop
	
	///////////========================================REV KXH 25317
	
	
	$jumkam=count($pec)-1;////jumlah kamar///blm selesaii
	//TANGGAL=======================================================================H
	///=================================================CEK in============================================================
		$g_id_min=$this->Mhotel->get_tbl_bill_tgl_min($ok->id)->row();
		 $sorttmin= $g_id_min->sort_t;
		 $xxxm=substr($sorttmin,'0','4');
				$xxm=substr($sorttmin,'4','2');
				$xm=substr($sorttmin,'6','2');
			$CheckInX=$xm.'-'.$xxm.'-'.$xxxm;
	//=============================================cEK OUT========================================================================
		$g_id_mak=$this->Mhotel->get_tbl_perpanjang_mak($ok->id)->row();
					$g_id_mak_bill=$this->Mhotel->get_tbl_perpanjang_mak_new($ok->id)->row();
		if(empty($g_id_mak->cekout)){
			 $sortt= $g_id_mak_bill->sort_t+1;
		}else{
			 $sortt= $g_id_mak->cekout;
		}
		
			    $xxx=substr($sortt,'0','4');
				$xx=substr($sortt,'4','2');
				$x=substr($sortt,'6','2');
				$CheckOutX=$x.'-'.$xx.'-'.$xxx;
		
	
	
	
	?>
		<td><?php //=============================================TANGGAL CEKIN
		if($ok->boking=='ya'){
			echo substr($ok->cekin,'0','-6');
			 }else{
		echo $CheckInX;	
		}
		?></td>
		<td><?=substr($ok->cekin,'11')?></td>
		<td>
		<?php ///-----------------------------------------------------------CEK OUT
		if($ok->boking=='ya'){
			echo substr($ok->cekout,'0','-6');
			 }else{
		echo $CheckOutX;	
		}
		?>
			
		</td>
		<td><?=substr($ok->cekout,'11')?></td>
		<!--kxH-->
			<td align="right"><?php  
		if($ok->boking=='ya'){
			echo 'DP';
		}else{
			echo $hxk;
			//echo $hxk;
			//echo count($pec);
			//echo '='.$nilaikamar.'+'.$bedd.'+'.$earlyy;
			//echo $interval;
			//echo $hxk;
			//echo $pec[];
		}
		?></td>
		<!--sumbangan-->
	<td align="right"><?php  
		if($ok->boking=='ya'){
			echo 'DP';
		}else{
			echo $hk;
		}
		?></td>
		<!---->
		<!--LAPORAN KEUAGAN-->
		<!---->
		<!--CAS KMAAR-->
		<td align="right"><?php  
		$totalep=$this->Mhotel->total_all($ok->id);
		$casd=$this->Madmin->total_cas($ok->id);
		$transd=$this->Madmin->total_trans($ok->id);
	//	$casd=$this->Madmin->total_cas($ok->id);
	////harga semua total kamar
	$totkam=$this->Madmin->total_allkamar($ok->id);
	//
	$totbed=$this->Madmin->total_allbed($ok->id);
	//
	//
	$totot=$this->Madmin->total_allot($ok->id);
	//
	//
	$try=$this->Madmin->total_allerly($ok->id);
	//
	$hcas=$totalep-$transd;///bayar cas
	$ht=$totalep-$casd; //bayar noncas
	$alldep=$this->Madmin->get_deposit_pelunasan($ok->id); ////////GET tbl deposit  selain PElunasan
		
		
		///////GUEST ==============================================================================================
			/////disc 
			if($ok->disc=='active'){
				$disc_ok=$totkam-($totkam/20);
			}else{
				$disc_ok=$totkam;
			}
			//////
			
			////BESARKECIL ANTARA DEPOSIT DAN JUMLA HARGA KAMAR case
			if($alldep >= $disc_ok){
				$hsldep=0;
			}else{
				$hsldep=$disc_ok-$alldep;
			}
			////////
			if($hsldep!=0){
				echo  number_format($hsldep,0,',','.');
			}
			
			$totalkamarcas=$totalkamarcas+$hsldep;/////masing masing cas
			
		?></td>

<!--CAS BED-->
		<td align="right"><?php 
		
			if($totbed!=0){
				echo number_format($totbed,0,',','.');
			}
			$totalexbed=$totalexbed+$totbed;/////masing masing antara v=cas nn cas
		
		?></td>

<!--  CAS OT-->
		<td align="right"><?php 
		
			if($totot!=0){
				echo  number_format($totot,0,',','.');
			} 
			$totalot=$totalot+$totot;/////masing masing antara v=cas nn cas
		?></td>

<!--  CAS EARLY-->
		<td align="right"><?php 

			if($try!=0){
				echo  number_format($try,0,',','.');
			} 
			$totaleary=$totaleary+$try;/////masing masing antara v=cas nn cas
		?></td>


		
	</tr>	


	<?php
	
	//echo $totalkamarcas+$totalkamardepocas+$totalexbed+$totalot;
	
	 }
	 } ///if nota kosong
	 
	  } ///foreach


	} ///$q kosong
///-=========================================TOTAL===================================================================
	?>
	<tr style="background-color: #e7e7e9">
		<td colspan="10" align="right" > Total</td>
		<td align="right"><?php 
		if($totalkamarcas+$totalkamardepocas!=0){
			echo number_format($totalkamarcas+$totalkamardepocas,0,',','.');
		}
		?></td>
		<td align="right">
		<?php 
		if($totalexbed!=0){
			echo number_format($totalexbed,0,',','.');
		}
		?>
			
		</td>
		<td align="right">
		<?php 
		if($totalot!=0){
			echo number_format($totalot,0,',','.');
		}
		?>
			
		</td>
		<td align="right">
		<?php 
		if($totaleary!=0){
			echo number_format($totaleary,0,',','.');
		}
		?>
			
		</td>
		</tr>
	
	</table>
	<?php 
	
	$totttcas=$totalkamarcas+$totalkamardepocas+$totalexbed+$totalot+$totaleary;
	
	?>
      </div> 
 
 <!--ISI REKAP-->
 
 <!--TOTAL-->
 <div class="table-responsive" >  
<table class="table" width="50%">
	
	
	<tr>
		<td><div class="well well-sm"><b> PENDAPATAN HOTEL</b></div></td>
		<td><div class="well well-sm"><b>  Rp : <?=number_format($totttcas,0,',','.')?></b></div></td>
	</tr>
	
</table>
</div>
 <!--TOTAL-->
 
 
 
 <?php
 //==================================================ATAS LAP KAMAR , BAWAH LAPORAN DAPUR==========================================
 }else{
 	
 
 ?>
  <!--ISI REKAP DAPUR -->
 
 <div class="table-responsive" >
        <table class="table table-striped table-hover table-condensed table-responsive table-bordered" style="font-size: 90%" >
	<tr>
		<td class="warning" rowspan="2" align="center"><b>No. Nota</b></td>
		<td class="warning" rowspan="2" align="center"><b>Nama</b></td>
		<td class="warning" rowspan="2" align="center"><b>No.kmr</b></td>
		
		<td class="warning" rowspan="1" colspan="2" align="center"><b>snack	</b></td>
		<td class="warning" rowspan="1" colspan="2" align="center"><b>dapur	</b></td>
		<td class="warning" rowspan="1" colspan="2" align="center"><b>Lain-Lain</b></td>
	</tr>
	<tr>
		
		
		<td class="warning">Tunai</td>
		<td class="warning" >non tunai</td>
		<td class="warning">Tunai</td>
		<td class="warning" >non tunai</td>
		<td class="warning">Tunai</td>
		<td class="warning" >non tunai</td>
	</tr>
	<?php
	
	$tkamda=0;
	$tkamsn=0;
	$tkamla=0;
	$tkamlanc=0;
	$tkamsnnc=0;
	$tkamdanc=0;
	if($q->num_rows() >0){ 

	foreach($q->result() as $key){   ////////dep tb deposit
	$shiftkamar=$this->Madmin->get_nama_tagihan($key->id_p)->row();
	 ?>
	<tr>
		<td><?=$key->nota?></td>
		<td>
		<?php
		if($key->tipe=='shift'){ ?> 
		<?=$this->Madmin->get_nama_tagihan($key->id_p)->row()->nama?>
		<?php }else{
			echo $key->nama;
		}
		?>
		 </td>
		<td><?=$key->id_k?> </td>
		
		<td><?php
		if($key->tipe=='shift'){ 
		if($shiftkamar->tipe=='K'){
			if($key->jenis==2){///snack
			echo $key->harga;
			$tkamsn=$tkamsn+$key->harga;
		}else{
			
			$tkamsn=$tkamsn;
		}////
		}//
		}else{
			if($key->tipe=='C'){
			if($key->jenis==2){///snack
			echo $key->harga;
			$tkamsn=$tkamsn+$key->harga;
		}else{
			
			$tkamsn=$tkamsn;
		}////
		}//
		}
		
		
		?></td>
		<td><?php ////////non cash scak
		if($key->tipe=='shift'){ 
		if($shiftkamar->tipe!='K'){
			if($key->jenis==2){///snack
			if($key->harga!=0){
				echo $key->harga;
			}
			
			$tkamsnnc=$tkamsnnc+$key->harga;
		}else{
			
			$tkamsnnc=$tkamsnnc;
		}////
		}//
		}else{
			if($key->tipe!='C'){
			if($key->jenis==2){///snack
			if($key->harga!=0){
				echo $key->harga;
			}
			$tkamsnnc=$tkamsnnc+$key->harga;
		}else{
			
			$tkamsnnc=$tkamsnnc;
		}////
		}//
		}
		
		
		?></td>
		<td><?php
		if($key->tipe=='shift'){ 
			if($shiftkamar->tipe=='K'){
			
		
		 if($key->jenis==1){//dapur
		
			if($key->harga!=0){
				echo $key->harga;
			}
			$tkamda=$tkamda+$key->harga;
		}else{
			
			$tkamda=$tkamda;
		}///
		}//
		}else{
			if($key->tipe=='C'){
			
		
		 if($key->jenis==1){//dapur
		
			if($key->harga!=0){
				echo $key->harga;
			}
			$tkamda=$tkamda+$key->harga;
		}else{
			
			$tkamda=$tkamda;
		}///
		}//
		}
	
		?></td>
		<td><?php
		if($key->tipe=='shift'){
			if($shiftkamar->tipe!='K'){
			
		
		 if($key->jenis==1){//dapur
		
			if($key->harga!=0){
				echo $key->harga;
			}
			$tkamdanc=$tkamdanc+$key->harga;
		}else{
			
			$tkamdanc=$tkamdanc;
		}///
		}//
		}else{
			if($key->tipe!='C'){
			
		
		 if($key->jenis==1){//dapur
		
			if($key->harga!=0){
				echo $key->harga;
			}
			$tkamdanc=$tkamdanc+$key->harga;
		}else{
			
			$tkamdanc=$tkamdanc;
		}///
		}//
		}
		
		?></td>
		<td><?php  ///////cash lain
			if($key->tipe=='shift'){ 
			if($shiftkamar->tipe=='K'){
		if($key->jenis==3){///3 ==lain
			if($key->harga!=0){
				echo $key->harga;
			}
			$tkamla=$tkamla+$key->harga;
		}
		else{
			
			$tkamla=$tkamla;
		}////
		}//
			}else{
				if($key->tipe=='C'){
		if($key->jenis==3){///3 ==lain
			if($key->harga!=0){
				echo $key->harga;
			}
			$tkamla=$tkamla+$key->harga;
		}
		else{
			
			$tkamla=$tkamla;
		}////
		}//
			}
		
		
		?></td>
		<td>
			<?php /////non cash lain
			if($key->tipe=='shift'){  
			if($shiftkamar->tipe!='K'){
			if($key->jenis==3){///3 ==lain
			if($key->harga!=0){
				echo $key->harga;
			}
			$tkamlanc=$tkamlanc+$key->harga;
		}else{
			
			$tkamlanc=$tkamlanc;
		}////	
			}
			}else{
				if($key->tipe!='C'){
			if($key->jenis==3){///3 ==lain
			if($key->harga!=0){
				echo $key->harga;
			}
			$tkamlanc=$tkamlanc+$key->harga;
		}else{
			
			$tkamlanc=$tkamlanc;
		}////	
			}
			}
			
			?>
			
		</td>
		
	</tr>	
	<?php } }
	?>
	
	
	<tr align="right" style="background-color: #dfe1e6">
		<td colspan="3" align="right"><strong>Total</strong></td>
	
		<td><?php
		if($tkamsn!=0){
			
		echo number_format($tkamsn,0,',','.');	
		}
		?></td>
		<td>
		<?php
		if($tkamsnnc!=0){
			
		 echo number_format($tkamsnnc,0,',','.');		
		}
		?>
			
		</td>
		<td>
		<?php
		if($tkamda!=0){
			
		 echo number_format($tkamda,0,',','.');		
		}
		?>
			
		</td>
		<td>
		<?php
		if($tkamdanc!=0){
			
		 echo number_format($tkamdanc,0,',','.');		
		}
		?>
		</td>
		<td>
		<?php
		if($tkamla!=0){
			
		 echo number_format($tkamla,0,',','.');		
		}
		?>
			
		</td>
		<td>
		<?php
		if($tkamlanc!=0){
			
		 echo number_format($tkamlanc,0,',','.');		
		}
		?>
			
		</td>
	</tr>
	<?php
	$totcsas=$tkamsn+$tkamda+$tkamla;
	$totnoncas=$tkamsnnc+$tkamdanc+$tkamlanc;
	?>
	
	</table>
      </div>
	 
 <!--ISI REKAP-->
 <!--TOTAL-->
 <div class="table-responsive" >  
<table class="table" width="50%">
	<tr>
	<td></td>
		<td><b>CASH</b></td>
		<td><b>NON CASH</b></td>
		<td><b>TOTAL</b></td>
	</tr>
	
	
	<tr>
		<td><div class="well well-sm"><b> PENDAPATAN HOTEL</b></div></td>
		<td><div class="well well-sm"><b>  Rp : <?=number_format($totcsas,0,',','.')?></b></div></td>
		<td><div class="well well-sm"><b>  Rp : <?=number_format($totnoncas,0,',','.')?></b></div></td>
		<td><div class="well well-sm"><b>  Rp : <?=number_format($totcsas+$totnoncas,0,',','.')?></b></div></td>
	</tr>
	
</table>
</div>
 <!--TOTAL-->
 
 <?php
 }
 
 ?>
 <!--ISI REKAP-->
</div>


      
    </div><!-- /.container -->