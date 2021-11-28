    <?php
		    $h = "7";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
$hm = $h * 60;
$ms = $hm * 60;
$tanggal = gmdate("d/m/Y ", time()+($ms)); // the "-" can be switched to a plus if that's what your time zone is.

$waktu = gmdate ( "H:i", time()+($ms));
		    ?>
		     

<div class="container"  style="background-color: #ef8b10">
   
      <div class="panel panel-warning">
  <div class="panel-heading">
    <h3 class="panel-title">
    	  <div class="page-header" >
        <h3>INPUT DATA BOOKING KAMAR</h3>
      </div>
    	
    </h3>
  </div>
  <div class="panel-body">
  <?=$this->session->flashdata('pesan')?>
      <form class="form-horizontal" role="form" method="post" action="<?=base_url()?>/C_resepsionis/save_book">
          <ul class="list-group">
            <li class="list-group-item">
              <p class="list-group-item-text">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label" ><p class="text-left">Nama Pemesan</p></label>
    <div class="col-sm-10">
      <input type="text" name= "nama" class="form-control" id="inputEmail3" placeholder="Nama Pemesan" required>
    </div>
  </div>
 
   <div class="form-group">
    <label class="col-sm-2 control-label" ><p class="text-left">Alamat</p></label>
    <div class="col-sm-10">
      <input type="text" name= "alamat" class="form-control" placeholder="Alamat" >
    </div>
  </div>

   <div class="form-group">
    <label class="col-sm-2 control-label" ><p class="text-left">No. HP/Telpon</p></label>
    <div class="col-sm-10">
      <input type="text" name= "telpon" class="form-control" placeholder="No. HP/Telpon" >
    </div>
  </div>

<?php
$h = "7";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
$hm = $h * 60;
$ms = $hm * 60;
$tanggal = gmdate("d-m-Y  ", time()+($ms)); // the "-" can be switched to a plus if that's what your time zone is.
$tanggal_reel= gmdate("d-m-Y H:i ", time()+($ms)); // the "-" can be switched to a plus if that's what your time zone is.
$waktu = gmdate ( "H:i:s", time()+($ms));	  

  	$jkol=$this->Mhotel->getjenis_kamar();	?>

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
  

		
              </p>
            </li>
        
            
            <li href="#" class="list-group-item">

  
    
      <button type="submit" class="btn btn-success btn-block btn-lg">SIMPAN</button>
    
  
            </li>
          </ul>



  
</form>
  </div>
</div>

   

    </div><!-- /.container -->