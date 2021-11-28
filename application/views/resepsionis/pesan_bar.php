    <?php
		    $h = "7";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
$hm = $h * 60;
$ms = $hm * 60;
$tanggal = gmdate("d/m/Y ", time()+($ms)); // the "-" can be switched to a plus if that's what your time zone is.
//$waktu = gmdate ( "g:i:s A", time()+($ms));
$waktu = gmdate ( "H:i", time()+($ms));
		    ?>
		     

<div class="container"  style="background-color: #dddde1">
<!--   <div class="alert alert-success alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Warning!</strong> Better check yourself, you're not looking too good.
</div>-->

   
      <div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">
    	  <div class="page-header" >
        <h3>INPUT DATA BAR</h3>
      </div>
    	
    </h3>
  </div>
  <div class="panel-body">
  <?=$this->session->flashdata('pesan')?>
      <form class="form-horizontal" role="form" method="post" action="<?=base_url()?>/C_resepsionis/simpan_bar">
          <ul class="list-group">
            <li href="#" class="list-group-item">
              <p class="list-group-item-text">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label" ><p class="text-left">Nama</p></label>
    <div class="col-sm-10">
      <input type="text" name= "nama" class="form-control" id="inputEmail3" placeholder="nama" required>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"><p class="text-left">No. Nota</p></label>
    <div class="col-sm-10">
      <input type="Text" name="nota" class="form-control" id="inputEmail3" placeholder="No. Nota" required>
    </div>
  </div>
<?php
   $h = "7";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
$hm = $h * 60;
$ms = $hm * 60;
$tanggal = gmdate("d-m-Y  ", time()+($ms)); // the "-" can be switched to a plus if that's what your time zone is.
$tanggal_reel= gmdate("d-m-Y ", time()+($ms)); // the "-" can be switched to a plus if that's what your time zone is.
$waktu = gmdate ( "H:i:s", time()+($ms));	?>  
  		<div class="form-group">
		    <label class="col-sm-2 control-label"><p class="text-left">Tanggal</p></label>
		     <div class="col-sm-4">
		     <div class="input-group"   id="datetimepicker8">
        <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span>
   <input type="text" name="tgl" placeholder="<?=date('d-m-Y')?>"value="<?=$tanggal_reel?>" class="form-control">
      <span class="input-group-btn">
      </span>
    </div><!-- /input-group -->
			  </div>
  		</div>
  		
  		<div class="form-group">
    <label for="inputEmail3"  class="col-sm-2 control-label"><p class="text-left">Nominal</p></label>
    <div class="col-sm-4">
      <div class="input-group">
  <span class="input-group-addon">Rp : </span>
  <input type="number" name="db" class="form-control" id="inputEmail3" min='0' placeholder="-" required>
</div>
    </div>
  </div>
  		
  		<!--<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label" ><p class="text-left">Ket.</p></label>
    <div class="col-sm-10">
      <textarea type="text" name= "ket" class="form-control" id="inputEmail3" placeholder="Keterangan"></textarea>
    </div>
  </div>-->
  		
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
      <h3>Jenis </h3>
            </li>
            <li href="#" class="list-group-item">
              <p class="list-group-item-text">

<div class="form-group">
    <div class="col-sm-2">
     <div class="input-group" href="#">
     <label>
  <input type="radio" name="tp" value="1" class="btn btn-sm"  checked> Dapur
</label>
</div>
    </div>
    <div class="col-sm-2">
     <div class="input-group" href="#">
     <label>
  <input type="radio" name="tp" value="2" class="btn btn-sm"   > Snack
</label>
</div>
    </div>
    <div class="col-sm-3">
     <div class="input-group" href="#">
     <label>
  <input type="radio" name="tp" value="3" class="btn btn-sm"   > Lain-lain	
</label>
</div>
    </div>
    
  
  </div>
  
  
  		
              </p>
            </li>
   <!--TOPE-->
	 <li href="#" class="list-group-item">
      <h3>Tipe </h3>
            </li>
            <li href="#" class="list-group-item">
              <p class="list-group-item-text">

<div class="form-group">
    <div class="col-sm-4">
     <div class="input-group" href="#">
     <label>
  <input type="radio" name="tipe" value="C" class="btn btn-sm" checked > CASH MONEY
</label>
</div>
    </div>
    <div class="col-sm-4">
     <div class="input-group" >
     <label>
  <input type="radio" name="tipe" value="T" class="btn btn-sm"  > NON CASH
</label>
</div>
    </div>
	    
  
  </div>
  
  
  		
              </p>
            </li>
            
            
            <li  class="list-group-item">

  
    
      <button type="submit" class="btn btn-success btn-block btn-lg" onclick="return confirm('Anda Yakin ?')">SIMPAN</button>
    
  
            </li>
          </ul>



  
</form>
  </div>
</div>

   

    </div><!-- /.container -->