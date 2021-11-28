<br/>
<div class="table-responsive" >
        <table class="table table-striped table-hover table-condensed table-responsive table-bordered" style="font-size: 90%" >
	<tr>
		<td class="warning" rowspan="2" align="center"><b>No. Nota</b></td>
		<td class="warning" rowspan="2" align="center"><b>Nama</b></td>
		<td class="warning" rowspan="2" align="center"><b>No.kmr</b></td>
		
		<td class="warning" rowspan="1" colspan="2" align="center"><b>snack	</b></td>
		<td class="warning" rowspan="1" colspan="2" align="center"><b>dapur	</b></td>
		<td class="warning" rowspan="1" colspan="2" align="center"><b>Lain-Lain</b></td>
		<!--<td class="warning" rowspan="1" colspan="10" align="center"><b>soft drink</b></td>-->
	</tr>
	<tr>
		
		
		<td class="warning">Tunai</td>
		<td class="warning" >non tunai</td>
		<td class="warning">Tunai</td>
		<td class="warning" >non tunai</td>
		<td class="warning">Tunai</td>
		<td class="warning" >non tunai</td>
		<!--<td class="warning" >soft drink</td>
		<td class="warning" >vit besar</td>
		<td class="warning" >vit kecil</td>
		<td class="warning" >PS besar</td>
		<td class="warning" >PS kecil</td>
		<td class="warning" >sprlla</td>
		<td class="warning" >mizone</td>
		<td class="warning" >pulpy</td>
		<td class="warning" >root beer</td>
		<td class="warning" >a'vera</td>-->
	</tr>
	<?php
	$q=$this->Madmin->lap_tagihan_hotel($id_user,$id_tgl,$shift);	
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
		if($key->tipe=='shift'){ 
		echo $this->Madmin->get_nama_tagihan($key->id_p)->row()->nama;
		}else{
		echo 	$key->nama;		
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
	
	<?php
	$qq=$this->db->get_where('tbl_bar',array('id_user'=>$id_user,'id_tgl'=>$id_tgl,'shift'=>$shift));
	$nondap=0;
	$nonsnac=0;
	$nonlai=0;
	$nondapnc=0;
	$nonsnacnc=0;
	$nonlainc=0;
	if($qq->num_rows() >0){ 
	
	foreach($qq->result() as $keyq){
	 ?>
	<tr>
		<td><?=$keyq->nota?></td>
		<td><?=$keyq->nama?></td>
		<td>-</td>
		
		<td><?php
		if($keyq->tipe=='C'){
		 if($keyq->jenis==2){
		 	if($keyq->harga!=0){
				echo $keyq->harga;
			}
			$nonsnac=$nonsnac+$keyq->harga;
		}else{
			$nonsnac=$nonsnac;
		}///
		}//
		?></td>
		<td><?php
		if($keyq->tipe!='C'){
		 if($keyq->jenis==2){
			echo $keyq->harga;
			$nonsnacnc=$nonsnacnc+$keyq->harga;
		}else{
			$nonsnacnc=$nonsnacnc;
		}///
		}//
		?></td>
		<td><?php 
		if($keyq->tipe=='C'){
		if($keyq->jenis==1){
			if($keyq->harga!=0){
				echo $keyq->harga;
			}
			$nondap=$nondap+$keyq->harga;
		}else{
			$nondap=$nondap;
		}////
		}//
		?></td>
		<td><?php 
		if($keyq->tipe!='C'){
		if($keyq->jenis==1){
			if($keyq->harga!=0){
				echo $keyq->harga;
			}
			$nondapnc=$nondapnc+$keyq->harga;
		}else{
			
			$nondapnc=$nondapnc;
		}////
		}//
		?></td>
<td><?php
		if($keyq->tipe=='C'){
			 if($keyq->jenis==3){
			if($keyq->harga!=0){
				echo $keyq->harga;
			}
			$nonlai=$nonlai+$keyq->harga;
		}else{
			
			$nonlai=$nonlai;
		}/////
		}///
		?></td>
		<td><?php
		if($keyq->tipe!='C'){
			 if($keyq->jenis==3){
			if($keyq->harga!=0){
				echo $keyq->harga;
			}
			$nonlainc=$nonlainc+$keyq->harga;
		}else{
			
			$nonlainc=$nonlainc;
		}/////
		}///
		?></td>
		
	</tr>	
	<?php } }
	?>
	<tr align="right" style="background-color: #dfe1e6">
		<td colspan="3" align="right"><strong>Total</strong></td>
	
		<td><?php
		if($tkamsn+$nonsnac!=0){
			
		echo number_format($tkamsn+$nonsnac,0,',','.');	
		}
		?></td>
		<td>
		<?php
		if($tkamsnnc+$nonsnacnc!=0){
			
		 echo number_format($tkamsnnc+$nonsnacnc,0,',','.');		
		}
		?>
			
		</td>
		<td>
		<?php
		if($tkamda+$nondap!=0){
			
		 echo number_format($tkamda+$nondap,0,',','.');		
		}
		?>
			
		</td>
		<td>
		<?php
		if($tkamdanc+$nondapnc!=0){
			
		 echo number_format($tkamdanc+$nondapnc,0,',','.');		
		}
		?>
		</td>
		<td>
		<?php
		if($tkamla+$nonlai!=0){
			
		 echo number_format($tkamla+$nonlai,0,',','.');		
		}
		?>
			
		</td>
		<td>
		<?php
		if($tkamlanc+$nonlainc!=0){
			
		 echo number_format($tkamlanc+$nonlainc,0,',','.');		
		}
		?>
			
		</td>
	</tr>
	<?php
	$dapdro=$tkamsn+$nonsnac+$tkamsnnc+$nonsnacnc+$tkamda+$nondap+$tkamdanc+$nondapnc+$tkamla+$nonlai+$tkamlanc+$nonlainc;
	$totcsas=$tkamsn+$nonsnac+$tkamda+$nondap+$tkamla+$nonlai;
	$totnoncas=$tkamsnnc+$nonsnacnc+$tkamdanc+$nondapnc+$tkamlanc+$nonlainc;
	$this->session->set_userdata('totdap',$dapdro);  
	$this->session->set_userdata('totdapcas',$totcsas);  
	$this->session->set_userdata('totdapnoncas',$totnoncas);  
	?>
	
	</table>
      </div>