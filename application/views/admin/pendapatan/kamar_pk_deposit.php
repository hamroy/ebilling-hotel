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
	$q=$this->Madmin->getkamar($id_user);
	if($q->num_rows() >0){ 
	
	foreach($q->result() as $key){
		$ok=$this->Madmin->get_tbl_pesan_kamar($key->id_p);
		//$ok_kamar=$this->Madmin->get_tbl_kamar($ok->id_k);
	 ?>
	<tr>
		<td><?php if($ok->tipe=='K'){echo 'K' ;}?><?=$ok->nota?></td>
		<td><?=$ok->nama?></td>
		<td><?=$ok->id_k?></td>
		<?php
		$h=$this->Mhotel->bill_hotel($ok->id);
	$tot=0;
	foreach($h->result() as $hh){ 
	$am = $this->db->get_where('tbl_kamar',array('id_kamar'=>$hh->id_k))->row();
	$h_kam=$am->harga;
		if($hh->early == 1){
			$bg_kam=($h_kam/2);
		}else{
			$bg_kam=0;
		}
	$dtot=$am->harga+$hh->harga_bed+$hh->harga_ot+$bg_kam; ///discon jumlah dalam satu kamar ...////tidak lagi untuk discon
	$disc=($hh->disc*$dtot)/100; ///disc
    	$tot=($tot+$am->harga+$hh->harga_bed+$hh->harga_ot+$bg_kam)-$disc; ///total - dison
    	
	}//echo //$tot;//kamar	 
	$pec=explode('-',$ok->id_k);
	$hk=0;
	//$bed=0;
	$bedd=0;
	$earlyy=0;
	$hxk=0;
		for($k = 1; $k< count($pec); $k++){
			$kama=$this->Madmin->get_jenis($pec[$k])->row()->nilai;
			$bed=$this->Madmin->get_bed($key->id_p,$pec[$k])->row()->bed;
			$early=$this->Madmin->get_bed($key->id_p,$pec[$k])->row()->early;
			//$bed=$this->Madmin->get_bed($pec[$k])->row()->bed;
		    if($bed!=NULL){
				$bedd=$bedd+(1/2);
			}else{
				$bedd=$bedd;
			}
			 if($early!=NULL){
				$earlyy=$earlyy+(1/2);
			}else{
				$earlyy=$earlyy;
			}
			$hxk=$hk+$kama+$bedd+$earlyy;////
			$hk=$hk+$kama;////hanya nilai kamar aja
		
			
			
		}
	$jumkam=count($pec)-1;////jumlah kamar///blm selesaii
	//TANGGAL
	$CheckInX = explode("-", substr($ok->cekin,'0','-6'));
	$CheckOutX =  explode("-", substr($ok->cekout,'0','-6'));
//	
	$date1 =  mktime(0, 0, 0, $CheckInX[1],$CheckInX[0],$CheckInX[2]);///jam,menit,detik,bulan,tanggal,tahun 
	$date2 =  mktime(0, 0, 0, $CheckOutX[1],$CheckOutX[0],$CheckOutX[2]);
	$interval =($date2 - $date1)/(3600*24);//MENCARI SEISIH HARI
	
	
	?>
		<td><?=substr($ok->cekin,'0','-6')?></td>
		<td><?=substr($ok->cekin,'11')?></td>
		<td><?=substr($ok->cekout,'0','-6')?></td>
		<td><?=substr($ok->cekout,'11')?></td>
		<!--kxH-->
		<td><?php 
		if($ok->boking=='ya'){
			echo 'DP';
		}else{
			echo $hxk*$interval;
		}
		?></td>
		<!--sumbangan-->
		<td><?php 
		if($ok->boking=='ya'){
			echo 'DP';
		}else{
			echo $interval*$hk;
		}
		?></td>
		<!---->
		<td><?php 
		if($key->tipe='C'){
			echo $key->cas;
		}
		?></td>
		<td><?php 
		if($key->tipe='K'){
			echo $key->transfer;
		}
		?></td>
		<td></td>
		<td>-</td>
		<td>-</td>
		<td>-</td>
		<td>-</td>
		<td>-</td>
	</tr>	
	<?php } }
	?>
	
	
	</table>
      </div> 