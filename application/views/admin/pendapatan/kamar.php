<br/>
<div class="table-responsive" >
        <table class="table table-striped table-hover table-condensed table-responsive table-bordered" style="font-size: 90%" >
	<tr>
		<td class="warning" rowspan="2" align="center"><b>No. Nota</b></td>
		<td class="warning" rowspan="2" align="center"><b>Nama</b></td>
		<td class="warning" rowspan="2" align="center"><b>No.kmr</b></td>
		<!--<td class="warning" rowspan="2" align="center"><b>Tarif</b></td>-->
		<td class="warning" rowspan="1" colspan="2" align="center"><b>Check In	</b></td>
		<td class="warning" rowspan="1" colspan="2" align="center"><b>Check Out	
</b></td>
		<td class="warning" rowspan="2" align="center"><b>Jmlh KxH</b></td>
		<td class="warning" rowspan="2" align="center"><b>Sumbangan</b></td>
		<td class="warning" rowspan="1" colspan="2" align="center"><b>Kamar
</b></td>
<td class="warning" rowspan="1" colspan="2" align="center"><b>Extra Bed</b></td>
<td class="warning" rowspan="1" colspan="2" align="center"><b>Overtime</b></td>
<td class="warning" rowspan="1" colspan="2" align="center"><b>Early Check in</b></td>
	</tr>
	<tr>
		
		<td class="warning" width="8%">Tanggal</td>
		<td class="warning" >Jam</td>
		<td class="warning" width="8%">Tanggal</td>
		<td class="warning" >Jam</td>
		<td class="warning">Tunai</td>
		<td class="warning" >nontunai</td>
		<td class="warning">Tunai</td>
		<td class="warning" >nontunai</td>
		<td class="warning">Tunai</td>
		<td class="warning" >nontunai</td>
		<td class="warning">Tunai</td>
		<td class="warning" >nontunai</td>
	</tr>
	<?php
	$q=$this->Madmin->getkamar($id_user,$id_tgl,$shift); ///tbl_pesan_kamar
	
	///new`
			$mintotrefund=0;	
	///new`

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
	if($q->num_rows() >0){ 
	
	foreach($q->result() as $key){
	$ok=$key;
	if(!empty($key->nota)){
		///===============BUAt REFUND ==============================================================================================
		if($ok->boking!='ya'){
		$qcekrf=$this->Madmin->ceklap_refund($id_user,$id_tgl,$shift);
		$t=$this->Mhotel->get_refund_via($ok->id); ///tbl lap refund
		$totdll=$this->Mhotel->total_all($key->id); ////menggunakan deposit total yag di payment /alll semua deposit
		
		$totdisc=$this->Madmin->get_disc_tagihankamr_dandapur($key->id);;
		 if($key->disc=='active'){
		 	
				$disckam=$totdisc/20; ////member only ..///yang di disconkn kamar tooo //totdis masih error
			}else{
				$disckam=0;
			}
		$p=$this->Madmin->get_tagihankamr_dandapur($key->id);
		$paymentall=$p-$disckam; ////tagihankamar dan dapur dikurangi disckon
		$totalall=$totdll-$paymentall;////untiuk total ////uang yang di bayar di kurangi tagihan kamar	
		if($ok->refund_status=='lunas' AND $t->row()->via=='cash'){
				///GET KOLOM VIA DI LAP REFUND============================================================10317
					$mintotrefund=$mintotrefund+$totalall;
				}else{
					$mintotrefund=$mintotrefund;
				}	
				}
		///===============BUAt REFUND ==============================================================================================
	
		
		$dep=$this->Madmin->get_tbl_deposit($key->id)->row();
		//$ok=$this->Madmin->get_tbl_pesan_kamar($key->id_p);
		//$ok_kamar=$this->Madmin->get_tbl_kamar($ok->id_k);

	 ?>

	<tr>
		<th align="left">
		<?php 
		//-----------------------------------------------------------MEnghitung JUmlah Tagihan-------------------------------------
	
	
		 
		// $totd=$cas0+$trans0;
		
		if($ok->boking!='ya'){
		if($ok->tipe=='K'){ 
		if($ok->refund_status=='lunas'){
				///GET KOLOM VIA DI LAP REFUND============================================================10317
				if($t->row()->via=='cash'){
					//echo 'RC';
					echo $this->Mhotel->getnotanama(3);
				}else{
					//echo 'RT';
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
					//echo 'RC';
					echo $this->Mhotel->getnotanama(3);
				}else{
					//echo 'RT';
					echo $this->Mhotel->getnotanama(4);
				}
				//==============================}else{
					//
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
			$hk=$hk+1;////
			
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
		<!--=========================================================kxH=========================================================-->
			<td align="right"><?php  
		if($ok->boking=='ya'){
			echo 'DP';
		}else{
			echo $hxk;
			//echo $hxk;
			//echo $kamnil;
			//echo $nilaikamar;
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
	$totkamnodisc=$this->Madmin->total_allkamarnodisc($ok->id);
	//
	$totbed=$this->Madmin->total_allbed($ok->id);
	//
	//
	$totot=$this->Madmin->total_allot($ok->id);
	//
	//
	$try=$this->Madmin->total_allerly($ok->id);
	
	
	$hcas=$totalep-$transd;///bayar cas
	$ht=$totalep-$casd; //bayar noncas
	$alldep=$this->Madmin->get_deposit_pelunasan($ok->id); ////////GET tbl deposit  selain PElunasan
	$alldepall=$this->Madmin->get_deposit_pelunasan_all($ok->id); ////////GET tbl deposit  semua
	//
//	echo  $alldepall;
	//
		if($ok->boking=='ya'){
		//	echo $dep->cas;
		//////BAGIAN BOKING
		if($ok->tipe=='K'){
			if($ok->nominal!=0){
				echo  number_format($ok->nominal,0,',','.');
			}
			
			$totalkamardepocas=$totalkamardepocas+$ok->nominal;/////masing masing  cas
			}
		///////
		}else{
		///////GUEST ==============================================================================================
			if($ok->tipe=='K'){///cek tipe
			/////disc 
			if($ok->disc=='active'){
				/////harga kamar asli kali disk member 24/3/17
				$disc_ok=$totkam-($totkamnodisc/20);
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
			}
		}//echo $totkam;
		
		 //($ck=$disc_ok);
		?></td>
<!--NOON CAS KMAAR-->
		<td align="right"><?php 
		if($ok->boking=='ya'){
		//	echo $dep->cas;
		if($ok->tipe!='K' or $ok->tipe==NULL){
		if($ok->nominal!=0){
			echo  number_format($ok->nominal,0,',','.');
		}
			
			$totalkamardepot=$totalkamardepot+$ok->nominal;/////masing masing antara v=cas nn cas
			}
		}else{
			if($ok->tipe!='K'){///cek tipe
			/////// 
			if($ok->disc=='active'){
				$disc_ok=$totkam-($totkam/20);
			}else{
				$disc_ok=$totkam;
			}
			///////
			////BESARKECIL ANTARA DEPOSIT DAN JUMLA HARGA KAMAR case
			if($alldep >= $disc_ok){
				$hsldep=0;
			}else{
				$hsldep=$disc_ok-$alldep;
			}
			//////
			if($hsldep!=0){
				echo  number_format($hsldep,0,',','.');
			}
			$totalkamart=$totalkamart+$hsldep;/////masing masing antara v=cas nn cas
			}
		}
		
		?></td>
<!--CAS BED-->
		<td align="right"><?php 
		//echo $alldepall-$ck+$totbed;
		if($ok->boking=='ya'){
		//	echo $dep->cas;
	
			echo 'DP';
			
		}else{
			if($ok->tipe=='K'){///cek tipe 
			if($totbed!=0){
				
				
				/////
			if($ok->refund_status!='lunas'){
				echo  number_format($totbed,0,',','.');
				$totalexbed=$totalexbed+$totbed;/////masing masing antara v=cas nn cas
				
				}
				
				/////
				
			}
			
			}
		}
		?></td>
<!-- nON CAS BED-->
		<td align="right"><?php 
		if($ok->boking=='ya'){
		//	echo $dep->cas;
		
			echo 'DP';
			
		}else{
			if($ok->tipe!='K'){///cek tipe 
			if($totbed!=0){
				
				/////
			if($ok->refund_status!='lunas'){
					echo  number_format($totbed,0,',','.');
					$totalexbedtra=$totalexbedtra+$totbed;
				}
				/////
				////masing masing antara v=cas nn cas
				
			}
			
			}
		}
		
		////
		
		///
		?></td>
<!--  CAS OT-->
		<td align="right"><?php 
		if($ok->boking=='ya'){
		//	echo $dep->cas;
		
			echo 'DP';
			
		}else{
			if($ok->tipe=='K'){///cek tipe
			if($totot!=0){
				
				
				////
			if($ok->refund_status!='lunas'){
			echo  number_format($totot,0,',','.');	
			$totalot=$totalot+$totot;/////masing masing antara v=cas nn cas
			}	
				////
				
				
			} 
			
			}
		}
		?></td>
<!-- nON CAS OT-->
		<td align="right"><?php  
		if($ok->boking=='ya'){
		//	echo $dep->cas;
		
			echo 'DP';
			
		}else{
			if($ok->tipe!='K'){///cek tipe 
				if($totot!=0){
					if($ok->refund_status!='lunas'){
				echo  number_format($totot,0,',','.');
				$totalottra=$totalottra+$totot;/////masing masing antara v=cas nn cas
				}
			} 
			
			}
		}
		?></td>
<!--  CAS EARLY-->
		<td align="right"><?php 
		if($ok->boking=='ya'){
		//	echo $dep->cas;
		
			echo 'DP';
			
		}else{
			if($ok->tipe=='K'){///cek tipe 
			if($try!=0){
				if($ok->refund_status!='lunas'){
				echo  number_format($try,0,',','.');
			$totaleary=$totaleary+$try;/////masing masing antara v=cas nn cas
				}
			} 
			
			}
		}
		?></td>
<!-- nON CAS EARLY-->
		<td align="right"><?php 
		if($ok->boking=='ya'){
		//	echo $dep->cas;
		
			echo 'DP';
			
		}else{
			if($ok->tipe!='K'){///cek tipe 
			if($try!=0){
				if($ok->refund_status!='lunas'){
				echo  number_format($try,0,',','.');
				$totalearytras=$totalearytras+$try;/////masing masing antara v=cas nn cas
				}
			} 
			
			}
		}
		?></td>

		
	</tr>	


	<?php
	
	//echo $totalkamarcas+$totalkamardepocas+$totalexbed+$totalot;
	
	 }
	 } ///if nota kosong
	 
	  } ///foreach

///-=========================================TOTAL===================================================================
	?>
	<tr style="background-color: #e7e7e9">
		<td colspan="9" align="right" > Total</td>
		<td align="right"><?php 
		if($totalkamarcas+$totalkamardepocas!=0){
			echo number_format($totalkamarcas+$totalkamardepocas,0,',','.');
		}
		?></td>
		<td align="right">
		<?php 
		if($totalkamart+$totalkamardepot!=0){
			echo number_format($totalkamart+$totalkamardepot,0,',','.');
		}
		?>
			
		</td>
		<td align="right">
		<?php 
		if($totalexbed!=0){
			echo number_format($totalexbed,0,',','.');
		}
		?>
			
		</td>
		<td align="right">
		<?php 
		if($totalexbedtra!=0){
			echo number_format($totalexbedtra,0,',','.');
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
		if($totalottra!=0){
			echo number_format($totalottra,0,',','.');
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
		<td align="right">
		<?php 
		if($totalearytras!=0){
			echo number_format($totalearytras,0,',','.');
		}
		?>
			
		</td>
		</tr>
	
	</table>
	<?php 
	//$tottt=$totalearytras+$totalkamarcas+$totalkamardepocas+$totalkamart+$totalkamardepot+$totalexbed+$totalexbedtra+$totalot+$totalottra+$totaleary+$totalearytras;
	$totttnoncas=$totalkamart+$totalkamardepot+$totalexbedtra+$totalottra+$totalearytras;
	$totttcas=($totalkamarcas+$totalkamardepocas+$totalexbed+$totalot+$totaleary)-$mintotrefund;
	$tottt=$totttcas+$totttnoncas;
	$this->session->set_userdata('tot',$tottt);  
	$this->session->set_userdata('totcas',$totttcas);  
	$this->session->set_userdata('totnoncas',$totttnoncas);  
	// $mintotrefund;
	?>
      </div> 