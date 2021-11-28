<div class="container">
<!--   <div class="alert alert-success alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Warning!</strong> Better check yourself, you're not looking too good.
</div>-->
<div class="well well-sm">Resepsionis  <em><?=$this->Madmin->get_user($id_user)->row()->username?></em></div>
<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3><b>PENGELUARAN HOTEL</b></h3></div>
  <div class="panel-body">
    <br/>
<div class="table-responsive" >
        <table class="table table-striped table-hover table-condensed table-responsive table-bordered" style="font-size: 90%" >
	<tr>
		<td class="warning" rowspan="1" align="center"><b>keterangan</b></td>
		<td class="warning" rowspan="1" align="center"><b>Pengeluaran hotel</b></td>
		<td class="warning" rowspan="1" align="center"><b>Pengeluaran dapur</b></td>
		<td class="warning" rowspan="1" align="center"><b>Pengembalian deposit</b></td>
		<td class="warning" rowspan="1" align="center"><b>setoran</b></td>
		<td class="warning" rowspan="1" align="center"><b>pengeluaran laundry

</b></td>
		
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
	<tr>
		<td align="right"><b>Jumlah</b></td>
		<td align="right"><b></b></td>
		<td align="right"><b></b></td>
		<td align="right"><b></b></td>
		<td align="right"><b></b></td>
		<td align="right"><b></b></td>
	</tr>
	
	
	</table>
      </div>
    
  </div>

 
</div>

    

     
      
    </div><!-- /.container -->