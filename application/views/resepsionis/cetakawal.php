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
        <h3>CETAK DATA PESAN KAMAR</h3>
      </div>
    	
    </h3>
  </div>
  <div class="panel-body">
  <?=$this->session->flashdata('pesan')?>
     <div class="btn-group">
  <!--<button type="button" class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown">
    Download <span class="caret"></span>
  </button>-->
  <!--<ul class="dropdown-menu" role="menu">-->
    <a class="btn  btn-danger" href="<?=base_url()?>C_cetak/cetak_deposit/pdf/<?=$id_p?>" ><span class="excel"> </span> PDF</a>
    <a   class="btn  btn-warning" target="output"   href="<?=base_url()?>C_cetak/cetak_deposit/html/<?=$id_p?>"  ><span class="glyphicon glyphicon-print"> Print</span></a>
    
  <!--</ul>-->
</div> 
<hr/>
<p align="right">   <a class="btn btn-info" href="<?=base_url()?>C_resepsionis/deposit_bar" >Lanjut <span class="glyphicon glyphicon-arrow-right
"></span></a></p>
  </div>
</div>

   

    </div><!-- /.container -->