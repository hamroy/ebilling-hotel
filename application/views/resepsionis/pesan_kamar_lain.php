<?php 
    
    $jkol=$this->Mhotel->getjenis_kamar();
    ?>

    <?php
$h = "7";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
$hm = $h * 60;
$ms = $hm * 60;
$tanggal = gmdate("d-m-Y  ", time()+($ms)); // the "-" can be switched to a plus if that's what your time zone is.
$tanggal_reel= gmdate("d-m-Y H:i ", time()+($ms)); // the "-" can be switched to a plus if that's what your time zone is.
$waktu = gmdate ( "H:i:s", time()+($ms));	?> 
		     

<div class="container"  style="background-color: #dddde1">
<!--   <div class="alert alert-success alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Warning!</strong> Better check yourself, you're not looking too good.
</div>-->

   
      <div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">
    	  <div class="page-header" >
        <h3>INPUT DATA PESAN KAMAR</h3>
      </div>
    	
    </h3>
  </div>
  <div class="panel-body">
  <?=$this->session->flashdata('pesan')?>
      <form class="form-horizontal" role="form" method="post" action="<?=base_url()?>/C_resepsionis/simpan_boking">
          <ul class="list-group">
            <li href="#" class="list-group-item">
              <p class="list-group-item-text">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label" ><p class="text-left">Nama</p></label>
    <div class="col-sm-10">
      <input type="text" name= "nama" class="form-control" id="inputEmail3" placeholder="nama" required>
    </div>
  </div>
 <!-- <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"><p class="text-left">Alamat</p></label>
    <div class="col-sm-10">
      <input type="Text" name="alamat" class="form-control" id="inputEmail3" placeholder="alamat">
    </div>
  </div>-->
 
  		<div class="form-group">
		    <label class="col-sm-2 control-label"><p class="text-left">Check in</p></label>
		     <div class="col-sm-4">
		     <div class="input-group"   id="datetimepicker6_1">
        <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span>
   <input type="text" name="cekin" placeholder="<?=date('d-m-Y')?>"value="<?=date('d-m-Y 15:00', strtotime('+1 days', strtotime($tanggal_reel)))?>" class="form-control">
      <span class="input-group-btn">
      </span>
    </div><!-- /input-group -->
			  </div>
  		</div>
  		<div class="form-group">
		    <label class="col-sm-2 control-label"><p class="text-left">Check out</p></label>
		     <div class="col-sm-4">
		     <div class="input-group"   id="datetimepicker6">
        <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span>
   <input type="text" name="cekout" placeholder="<?=date('d-m-Y')?>"value="<?=date('d-m-Y', strtotime('+2 days', strtotime($tanggal)))?>" class="form-control">
      <span class="input-group-btn">
      </span>
    </div><!-- /input-group -->
			  </div>
  		</div>
  		
  		<!--<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"><p class="text-left">Deposit</p></label>
    <div class="col-sm-10">
      <div class="input-group">
  <span class="input-group-addon">Rp : </span>
  <input type="Text" name="db" class="form-control" id="inputEmail3" placeholder="Deposit Belum Masuk">
</div>
    </div>
  </div>-->
 <div class="table-responsive">
  <table class="table table-condensed table-bordered">
  <tr>
  	<td colspan="<?=$jkol->num_rows()?>" class="active"><b>PILIH KAMAR</b></td>
  </tr>
  <tr>
  
  <?php
  foreach($jkol->result() as $kol){?>
  	
  	<td class="active"><b><?=$kol->jenis_kamar?></b></td>
  	
  <?php }
  ?>
  </tr>
    <tr>
  <?php
  foreach($jkol->result() as $kol){?>
  	
  	<td>
  		
  		<?php
  		$dd=$this->Mhotel->cek_kamar_no_dd_all($kol->id_jkamar);
    foreach($dd->result() as $dd1){?>
  		
  		<input class="btn btn-xs" type="checkbox" name="k_<?=$dd1->id_kamar?>" value="<?=$dd1->id_kamar?>"/> No. <?=$dd1->id_kamar?><br/>
  		
	<?php }
    ?>
  		
  	</td>
  	
  <?php }
  ?>
  </tr>
  </table>
  </div>
  <div class="form-group">
		    <label class="col-sm-2 control-label"><p class="text-left">Tanggal Deposit</p></label>
		     <div class="col-sm-4">
		     <div class="input-group"   id="datetimepicker10">
        <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span>
   <input type="text" name="tgl" placeholder="<?=date('d-m-Y')?>" value="<?=date('d-m-Y H:i')?>" class="form-control">
      <span class="input-group-btn">
      </span>
    </div><!-- /input-group -->
			  </div>
  		</div>
  		<!---->
  		<div class="form-group">
		    <label class="col-sm-2 control-label"><p class="text-left">Nominal</p></label>
		     <div class="col-sm-4">
		     <div class="input-group">
        <span class="input-group-addon">Rp :</span>
   <input type="number" name="nominal" placeholder="-" min="0" value="" class="form-control" required> 
      <span class="input-group-btn">
      </span>
    </div><!-- /input-group -->
			  </div>
			  <!--  <div class="col-sm-4">
			   <label class="radio-inline">
  <input type="radio" name="tipe" id="radio1" value="option1"> CAS
</label> <label class="radio-inline">
  <input type="radio" name="tipe" value="option12"> TRANSFER
</label>
 
			    
			    </div>-->
			    </div>
		<!---->	
		<div class="form-group">
		    <label class="col-sm-2 control-label" ><p class="text-left">Nama Rekening Pengirim</p></label>
		      <div class="col-sm-4">
      <input type="text" name= "rek" class="form-control" id="inputEmail3" placeholder="-">
    </div>
			   <label class="col-sm-1 control-label"><p class="text-left">BANK</p></label>
			   <div class="col-sm-3">
			   <select name="bank" class="form-control">
			   <option value="Cash">Cash Money</option>
  <option value="BCA">BCA</option>
  <option value="Mandiri">Mandiri</option>
  
</select>
     
    </div>
			  </div>
		<!---->
<!--    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" >
          TRANSFER
        </a>
      </h4>
    </div>-->
    <!--<div id="collapseOne" class="panel-collapse collapse">
      <div class="panel-body">
      <div class="row">
        <div class="form-group">
		    <label class="col-sm-2 control-label" ><p class="text-left">Nama Rekening Pengirim</p></label>
		      <div class="col-sm-4">
      <input type="text" name= "rek" class="form-control" id="inputEmail3" placeholder="-">
    </div>
			   <label class="col-sm-1 control-label"><p class="text-left">Tipe</p></label>
			   <div class="col-sm-3">
      <input type="text" name= "bank" class="form-control" id="inputEmail3" placeholder="-">
    </div>
			  </div>
  		</div>
      </div>
    </div>
  		-->
              </p>
            </li>
         <!--   <li href="#" class="list-group-item">
              <p class="list-group-item-text">
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"><p class="text-left">Pesan/ Catatan</p></label>
    <div class="col-sm-10">
      <textarea class="form-control" name="pesan" rows="3"></textarea>
    </div>
  </div>
  
  
              </p>
            </li>-->
            
            <li href="#" class="list-group-item">

  
    
      <button type="submit" class="btn btn-success btn-block btn-lg" onclick="return confirm('Anda Yakin ?')">SIMPAN</button>
    
  
            </li>
          </ul>



  
</form>
  </div>
</div>

   

    </div><!-- /.container -->