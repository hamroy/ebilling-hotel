<br/>
<div class="table-responsive" >
        <table class="table table-striped table-hover table-condensed table-responsive table-bordered" style="font-size: 90%" >
	<tr>
		<td class="warning" rowspan="2" align="center"><b>No. Nota</b></td>
		<td class="warning" rowspan="2" align="center"><b>Nama</b></td>
		<td class="warning" rowspan="2" align="center"><b>No.kmr</b></td>
		<td class="warning" rowspan="1" colspan="2" align="center"><b>Lain-Lain</b></td>
		<td class="warning" rowspan="1" colspan="2" align="center"><b>snack	</b></td>
		<td class="warning" rowspan="1" colspan="2" align="center"><b>dapur	</b></td>
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
	$q=$this->Madmin->lap_tagihan_hotel($id_user);	
	$tkamda=0;
	$tkamsn=0;
	$tkamla=0;
	$tkamlanc=0;
	$tkamsnnc=0;
	$tkamdanc=0;
	if($q->num_rows() >0){ 

	foreach($q->result() as $key){
	 ?>
	<tr>
		<td><?=$key->nota?></td>
		<td><?=$this->Madmin->get_nama_tagihan($key->id_p)->row()->nama?> </td>
		<td><?=$key->id_k?> </td>
		<td><?php 
		if($key->tipe=='C'){
		if($key->jenis==3){///3 ==lain
			echo $key->harga;
			$tkamla=$tkamla+$key->harga;
		}else{
			echo '-';
			$tkamla=$tkamla;
		}////
		}//
		
		?></td>
		<td>
			<?php
			if($key->tipe!='C'){
			if($key->jenis==3){///3 ==lain
			echo $key->harga;
			$tkamlanc=$tkamlanc+$key->harga;
		}else{
			echo '-';
			$tkamlanc=$tkamlanc;
		}////	
			}
			?>
			
		</td>
		<td><?php
		if($key->tipe=='C'){
			if($key->jenis==2){///snack
			echo $key->harga;
			$tkamsn=$tkamsn+$key->harga;
		}else{
			echo '-';
			$tkamsn=$tkamsn;
		}////
		}//
		
		?></td>
		<td><?php
		if($key->tipe!='C'){
			if($key->jenis==2){///snack
			echo $key->harga;
			$tkamsnnc=$tkamsnnc+$key->harga;
		}else{
			echo '-';
			$tkamsnnc=$tkamsnnc;
		}////
		}//
		
		?></td>
		<td><?php
		if($key->tipe=='C'){
			
		
		 if($key->jenis==1){//dapur
		
			echo $key->harga;
			$tkamda=$tkamda+$key->harga;
		}else{
			echo '-';
			$tkamda=$tkamda;
		}///
		}//
		?></td>
		<td><?php
		if($key->tipe!='C'){
			
		
		 if($key->jenis==1){//dapur
		
			echo $key->harga;
			$tkamdanc=$tkamdanc+$key->harga;
		}else{
			echo '-';
			$tkamdanc=$tkamdanc;
		}///
		}//
		?></td>
		
	</tr>	
	<?php } }
	?>
	
	<?php
	$qq=$this->db->get('tbl_bar');
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
		if($key->tipe=='C'){
			 if($keyq->jenis==3){
			echo $keyq->harga;
			$nonlai=$nonlai+$keyq->harga;
		}else{
			echo '-';
			$nonlai=$nonlai;
		}/////
		}///
		?></td>
		<td><?php
		if($key->tipe!='C'){
			 if($keyq->jenis==3){
			echo $keyq->harga;
			$nonlainc=$nonlainc+$keyq->harga;
		}else{
			echo '-';
			$nonlainc=$nonlainc;
		}/////
		}///
		?></td>
		<td><?php
		if($key->tipe=='C'){
		 if($keyq->jenis==2){
			echo $keyq->harga;
			$nonsnac=$nonsnac+$keyq->harga;
		}else{
			echo '-';
			$nonsnac=$nonsnac;
		}///
		}//
		?></td>
		<td><?php
		if($key->tipe!='C'){
		 if($keyq->jenis==2){
			echo $keyq->harga;
			$nonsnacnc=$nonsnacnc+$keyq->harga;
		}else{
			echo '-';
			$nonsnacnc=$nonsnacnc;
		}///
		}//
		?></td>
		<td><?php 
		if($key->tipe=='C'){
		if($keyq->jenis==1){
			echo $keyq->harga;
			$nondap=$nondap+$keyq->harga;
		}else{
			echo '-';
			$nondap=$nondap;
		}////
		}//
		?></td>
		<td><?php 
		if($key->tipe!='C'){
		if($keyq->jenis==1){
			echo $keyq->harga;
			$nondapnc=$nondapnc+$keyq->harga;
		}else{
			echo '-';
			$nondapnc=$nondapnc;
		}////
		}//
		?></td>
		
	</tr>	
	<?php } }
	?>
	<tr align="right" style="background-color: #dfe1e6">
		<td colspan="3" align="right"><strong>Total</strong></td>
		<td><?=$tkamla+$nonlai?></td>
		<td><?=$tkamlanc+$nonlainc?></td>
		<td><?=$tkamsn+$nonsnac?></td>
		<td><?=$tkamsnnc+$nonsnacnc?></td>
		<td><?=$tkamda+$nondap?></td>
		<td><?=$tkamdanc+$nondapnc?></td>
	</tr>
	
	
	</table>
      </div>