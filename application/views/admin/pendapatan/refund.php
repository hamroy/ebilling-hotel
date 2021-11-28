<br/>
<div class="table-responsive" >
        <table class="table table-striped table-hover table-condensed table-responsive table-bordered" style="font-size: 90%" >
	<tr>
		<td class="warning"  align="center"><b>No. </b></td>
		<td class="warning"  align="center"><b>Nama</b></td>
		<td class="warning"  align="center"><b>Via</b></td>
		<td class="warning"  align="center"><b>Menu</b></td>
		
	</tr>
	<?php
	////get aporan refund
	$q=$this->Madmin->lap_refund($id_user,$id_tgl,$shift);
	if($q->num_rows() >0){ 
	$no=1;
	foreach($q->result() as $key){
	 ?>
	<tr>
		<td><?=$no++?></td>
		<td><?php
		if($key->via=='cash'){
			
			echo $this->Madmin->getnama($key->id_p)->row()->nama;
			}else{
				echo $key->nama;
			}
		
		?></td>
		<td>
		<?PHP
		if($key->via=='cash'){ ?>
			cash
	<?php	}else{
		?>
		<a data-toggle="modal" data-target="#myModalefun<?=$key->id?>" href="" > Transfer <span class="pull-right"><span class="glyphicon glyphicon-eye-open
"> </span></span></a>
<!-- Modal -->
	<div class="modal fade" id="myModalefun<?=$key->id?>" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Refund Via Transfer</h4>
      </div>
      <div class="modal-body">
       <form class="form-horizontal">
          <ul class="list-group">
            <li  class="list-group-item">
              <p class="list-group-item-text">

 
<div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label"><p class="text-left">HOTEL</p></label>
    <div class="col-sm-9">
      <input type="Text" name="hotel"  class="form-control" placeholder="-" value="<?=$key->hotel?>"  id="inputEmail3" readonly>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label"><p class="text-left">Note.no </p></label>
    <div class="col-sm-9">
      <input type="Text" name="nota" class="form-control" placeholder="-" readonly value="<?=$key->nota?>" id="inputEmail3">
    </div>
  </div>
  

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label"><p class="text-left">Nominal</p></label>
    <div class="col-sm-5 ">
    <div class="input-group">
  <span class="input-group-addon">Rp : </span>
  <input type="Text" name="nominal" class="form-control" placeholder="-" readonly value="<?= ! empty($key->nominal) ? number_format($key->nominal,0,',','.'):0?>" id="inputEmail3">
</div>
    </div>
  </div>
 <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label"><p class="text-left">Atas Nama</p></label>
    <div class="col-sm-9">
      <input type="Text" name="anama" class="form-control" readonly placeholder="-" value="<?=$key->nama?>" id="inputEmail3">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label"><p class="text-left">Tanggal c/i</p></label>
    <div class="col-sm-5">
      <input type="text" name="c/i" id="<!--datetimepicker11-->" readonly placeholder="<?=date('d-m-Y')?>" value="<?=$key->tglci?>" class="form-control date">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label"><p class="text-left">Tanggal c/o</p></label>
    <div class="col-sm-5">
      <input type="text" name="c/o"  readonly placeholder="<?=date('d-m-Y')?>" value="<?=$key->tglco?>" class="form-control date">
    </div>
  </div>
   <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label"><p class="text-left">Type Kamar</p></label>
    <div class="col-sm-9">
      <input type="Text" name="tkamar" class="form-control" placeholder="-" readonly value="<?=$key->tipe_kamar?>" id="inputEmail3">
    </div>
  </div>
  	 <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label"><p class="text-left">Return Via BANK</p></label>
    <div class="col-sm-9">
      <input type="text" name="bank" class="form-control" placeholder="-" readonly value="<?=$key->bank?>" id="inputEmail3">
    </div>
  </div>	
   <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label"><p class="text-left">No. Rek</p></label>
    <div class="col-sm-9">
      <input type="Text" name="rek" class="form-control" readonly placeholder="-" value="<?=$key->norek?>" id="inputEmail3">
    </div>
  </div>
   <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label"><p class="text-left">Atas Nama</p></label>
    <div class="col-sm-9">
      <input type="Text" name="anama2" class="form-control" readonly placeholder="-" value="<?=$key->atas_nama?>" id="inputEmail3">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label"><p class="text-left">Tanggal Konfirmasi</p></label>
    <div class="col-sm-5">
      <input type="text" name="tglkom" readonly placeholder="<?=date('d-m-Y')?>" value="<?=$key->tanggal?>" class="form-control date">
    </div>
  </div>
              </p>
            </li>
         
           
          
          </ul>



  
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
      </div>
    </div>
  </div>
</div>
	<?php }
		?>	
			
		</td>
		<td>
		<?php 
		if($key->via=='cash'){
			?>
				<a href="<?=base_url('C_resepsionis/bill_kamnoedit/'.$key->id_p.'/'.$id_user.'/'.$id_tgl.'/'.$shift)?>"> Rincian <span class="pull-right"><span class="glyphicon glyphicon-eye-open
"> </span></span></a>   
	<?php	} else{
		?>
			<a href="<?=base_url('C_resepsionis/bill_kamnoedit/'.$key->id_p.'/'.$id_user.'/'.$id_tgl.'/'.$shift)?>"> Rincian <span class="pull-right"><span class="glyphicon glyphicon-eye-open
"> </span></span></a> 

	
<?php	}
		?>
		
	
</td>
	</tr>	
	<?php } }
	?>
	
	
	</table>
      </div>
        