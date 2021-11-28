<div class="table-responsive">
<br/>
<button type="button" class="btn btn-primary"data-toggle="modal" data-target="#myfblplus">
  <span class="glyphicon glyphicon-plus"> </span>  Tambah
  </button>
  <table class="table">
    <table class="table table-striped">
	<tr>
		<th>No.</th>
		<th>Username</th>
		<th>password</th>
		<th>status</th>
		<?php
  if($this->session->userdata('id_admin')==3){
  
  ?>
		<th>Wewenang</th>
		
<?php } ?>
		
    	<th>IP_Addres</th>
		<th>wilayah/IP_Addres</th>
		<th>Block</th>
		<th>Menu</th>
	</tr>
<?php
  if($this->session->userdata('id_admin')==3){
  
 	$get=$this->Madmin->geg_all_passall();
 	}else{
		$get=$this->Madmin->geg_all_pass();
	}
	$no=1;
	foreach($get->result() as $q){ ?>
		<tr>
		<td><?=$no++?></td>
		<td><?=$q->username?></td>
		<td><?=$q->password?></td>
		<td>
		<?php
		if($q->status=='online'){
			?>
		<a href="<?=base_url()?>C_admin/oflinekan/<?=$q->idlog?>"><b><?=$q->status?></b><span class="pull-right"> <span class="glyphicon glyphicon-off"></span></span></a>
		<?php }else{
			echo $q->status;
		}
		?>
		</td>
<?php
  if($this->session->userdata('id_admin')==3){
  
  ?>
		<td><?=$q->wewenang?></td>
		
<?php } ?>
    <td><?=$q->ipaddres?></td>
		<td><?=$q->wilayah?></td>
		<?php
		if($q->block==1){
			$war='danger';
			$war1='success';
			$vi='YA';
			$ic='ok';
			$up='2';
		}else{
			$war='success';
			$war1='danger';
			$vi='TIDAK';
			$ic='remove';
			$up='1';
		}
		
		?>
		<td class="<?=$war?>"><?=$vi?></td>
		<td ><button type="button" class="btn btn-info btn-xs"data-toggle="modal" data-target="#myfbl<?=$q->idlog?>">
  <span class="glyphicon glyphicon-pencil"></span>  
  </button> 
  
  <a type="submit" class="btn btn-<?=$war1?> btn-xs" onclick="return confirm('Anda Yakin ?')" href="<?=base_url('C_admin/dell_password_all/'.$q->idlog.'/'.$up)?>" >
 <span class="glyphicon glyphicon-<?=$ic?>"></span> 
  </a>
			
			<!--MODAL EDIT YTAGIHAN-->
			<div class="modal fade" id="myfbl<?=$q->idlog?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">PERBAHARUI USERNAME </h4>
      </div>
      <div class="modal-body">
       <form class="form-horizontal" role="form" method="post" action="<?=base_url()?>/C_admin/ubah_password_all/<?=$q->idlog?>">
          <ul class="list-group">
            <li href="#" class="list-group-item">
              <p class="list-group-item-text">

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"><p class="text-left">Username </p></label>
    <div class="col-sm-10">
      <input type="Text" name="user" class="form-control" id="inputEmail3" value="<?=$q->username?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"><p class="text-left">Password </p></label>
    <div class="col-sm-10">
      <input type="Text" name="pass" class="form-control" id="inputEmail3" value="<?=$q->password?>">
    </div>
  </div>
  <?php
  if($this->session->userdata('id_admin')==3){
  
  ?>
   <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"><p class="text-left">Wewenang </p></label>
    <div class="col-sm-10">
      <select class="form-control" name="we">
      <?php
      if($q->wewenang=='admin'){
	  	$a='selected';
	  	$b='';
	  }else{
	  		$a='';
	  	$b='selected';
	  }
      ?>
  <option value="admin" <?=$a?>>Admin</option>
  <option value="resepsionis" <?=$b?>>Resepsionis</option>
</select>
    </div>
  </div>
  
 <?php }
 
 ?>
 

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-5 control-label"><p class="text-left">Wilayah / IP_Addres</p></label>
    <div class="col-sm-5">
  <input type="Text" name="ip" class="form-control" id="inputEmail3" value="<?=$q->wilayah?>">
  <small>(*) Menggunakan IP_Addres</small>
    </div>
  </div>
  
  		
              </p>
            </li>
           
            
            <li href="#" class="list-group-item">

      <button type="submit" class="btn btn-success btn-block btn-lg">SIMPAN</button>
      
            </li>
          </ul>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>
		</td>
		</tr>
<?php	}
	?>
	
</table>
  </table>
</div>
<!--MODAL EDIT YTAGIHAN-->
<div class="modal fade" id="myfblplus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">TAMBAH USERNAME</h4>
      </div>
      <div class="modal-body">
       <form class="form-horizontal" role="form" method="post" action="<?=base_url()?>/C_admin/plus_password_all/">
          <ul class="list-group">
            <li href="#" class="list-group-item">
              <p class="list-group-item-text">

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"><p class="text-left">Username </p></label>
    <div class="col-sm-10">
      <input type="Text" name="user" class="form-control" id="inputEmail3">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"><p class="text-left">Password </p></label>
    <div class="col-sm-10">
      <input type="Text" name="pass" class="form-control" id="inputEmail3" >
    </div>
  </div>
  <?php
  if($this->session->userdata('id_admin')==3){
  
  ?>
   <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"><p class="text-left">Wewenang </p></label>
    <div class="col-sm-10">
      <select class="form-control" name="we">
  <option value="admin">Admin</option>
  <option value="resepsionis">Resepsionis</option>
</select>
    </div>
  </div>
  
 <?php }
 
 ?>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-5 control-label"><p class="text-left">Wilayah / IP_Addres</p></label>
    <div class="col-sm-5">
  <input type="Text" name="ip" class="form-control" id="inputEmail3" >
  <small>(*) Menggunakan IP_Addres</small>
    </div>
  </div>
  
  		
              </p>
            </li>
           
            
            <li href="#" class="list-group-item">

      <button type="submit" class="btn btn-success btn-block btn-lg">SIMPAN</button>
      
            </li>
          </ul>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>