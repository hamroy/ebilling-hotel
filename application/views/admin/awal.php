<div class="container">
<!--   <div class="alert alert-success alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Warning!</strong> Better check yourself, you're not looking too good.
</div>-->

     <div class="page-header" >
        <table class="table table-striped table-hover table-condensed table-responsive table-bordered" >
	<tr>
		<td class="warning" rowspan="2" align="center"><b>Tanggal</b></td>
		<td class="warning" align="center" colspan="4"><b>Shifs</b></td>
		
	</tr>
	<tr>
		
		<td class="warning">Pagi</td>
		<td class="warning" >Siang</td>
		<td class="warning">Malam</td>
	</tr>
	<?php
	$q=$this->Madmin->lap_shifs();
	if($q->num_rows() >0){ 
	foreach($q->result() as $key){
	 ?>\
	<tr>
		<td><?=substr($key->tanggal,'0','-10')?></td>
		<td><?php
		if($key->ship=='Pagi'){
		echo '<a href="'.base_url('C_admin/rinci_pendapatan/'.$key->id_user).'"><span class="pull-right"></span> '.$this->Madmin->get_user($key->id_user)->row()->username.'</a>';
		}
		
		 ?></td>
		<td><?php
		if($key->ship=='Siang'){
			
			echo '<a href="'.base_url('C_admin/rinci_pendapatan/'.$key->id_user).'"><span class="pull-right"></span> '.$this->Madmin->get_user($key->id_user)->row()->username.'</a>';
		}
		
		 ?></td>
		 <td><?php
		if($key->ship=='Malam'){
			echo '<a href="'.base_url('C_admin/rinci_pendapatan/'.$key->id_user).'"><span class="pull-right"></span> '.$this->Madmin->get_user($key->id_user)->row()->username.'</a>';
		}
		
		 ?></td>
	</tr>	
	<?php } }
	?>
	
	
	</table>
      </div>
      
    </div><!-- /.container -->