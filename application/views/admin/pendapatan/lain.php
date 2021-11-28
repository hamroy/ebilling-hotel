<br/>
<div class="table-responsive" >
        <table class="table table-striped table-hover table-condensed table-responsive table-bordered" style="font-size: 90%" >
	<tr>
		<td class="warning" rowspan="2" align="center"><b>No. Nota</b></td>
		<td class="warning" rowspan="2" align="center"><b>Nama</b></td>
		<td class="warning" rowspan="2" align="center"><b>No.kmr</b></td>
		<td class="warning" rowspan="2" align="center"><b>Keterangan</b></td>
		<td class="warning" rowspan="1" colspan="2" align="center"><b>Jumlah</b></td>
		
	</tr>
	<tr>
		
		
		<td class="warning">Tunai</td>
		<td class="warning" >notunai</td>
	</tr>
	<?php
	$q=$this->Madmin->lap_shifs();
	if($q->num_rows() >0){ 
	foreach($q->result() as $key){
	 ?>
	<tr>
		<td><?=$key->tanggal?></td>
		<td><?=$key->tanggal?></td>
		<td><?=$key->tanggal?></td>
		<td><?=$key->tanggal?></td>
		<td><?=$key->tanggal?></td>
		<td><?=$key->tanggal?></td>
	</tr>	
	<?php } }
	?>
	
	
	</table>
      </div>