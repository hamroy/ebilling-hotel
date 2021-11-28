<div class="container"  style="background-color: #dddde1">
<!--   <div class="alert alert-success alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Warning!</strong> Better check yourself, you're not looking too good.
</div>-->

   
      <div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading">  <div class="page-header" >
        <h3>DAFTAR NAMA TAMU</h3>
      </div></div>
  <!-- Table -->
  <div class="table-responsive" >
	 <table class="table table-striped table-hover table-condensed table-responsive table-bordered" >
	<tr>
		<th>Nama Tamu</th>
		<!--<th>Alamat Tamu</th>-->
		<th>No. Kamar</th>
		<th>Tanggal Check In</th>
		<!--<th>No Kamar</th>-->
		<th>Menu</th>
		
	</tr>
	<?php 
	$no=1;
	foreach($q->result() as $qq){
	//	$k=$this->db->get_where('tbl_pesan_kamar',array('id_k'=>$qq->id_kamar))->row();
	//	$var = explode ("_",$k->id_k);
		
		
		 ?>
	<tr>
		<td><?=$qq->nama?></td>
		<!--<td><?=$qq->alamat?></td>-->
		<td><?=$qq->id_k?></td>
		<td><?=$qq->cekin?></td>
		<!--<td></td>-->
		<td>
		<!--<?php// if($st =='Lunas' AND date('d-m-Y')>=substr($nm->cekout,'0','-6') ){ ?>-->
		<?php 
		$h = "7";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
$hm = $h * 60;
$ms = $hm * 60;
$tanggal = gmdate("d-m-Y  ", time()+($ms)); // the "-" can be switched to a plus if that's what your time zone is.
		$tgl1 = substr($qq->cekin,'0','-6');
		$tglnow = $tanggal;
$xxx=substr($tgl1,'6','4');
$xx=substr($tgl1,'3','2');
$x=substr($tgl1,'0','2');
$xxx1=substr($tglnow,'6','4');
$xx1=substr($tglnow,'3','2');
$x1=substr($tglnow,'0','2');
		if($xxx.''.$xx.''.$x <= $xxx1.''.$xx1.''.$x1){?>
			<a class="btn btn-xs btn-primary" onclick="return confirm('apa Anda Yakin !!!')" href="<?=base_url('C_resepsionis/cekin/'.$qq->id)?>" >Check In</a>
		<?php }else{ ?> 
		<a class="btn btn-xs btn-primary" onclick="return confirm('apa Anda Yakin !!!')" href="<?=base_url('C_resepsionis/cekin/'.$qq->id)?>" disabled >Check In</a>
		<?php }?>
			
		<!--<?php// }else{ ?>
			<a class="btn btn-xs btn-primary" onclick="return confirm(' Anda Yakin akan Akan mengcekout Tamu ini  !!!')" href="<?//=//base_url('C_resepsionis/cekout/'.$qq->id_k//amar.'/'.$qq->id_p)?>" disabled>Check out</a>
	<?php//	} ?>-->
		<div class="btn-group">
    <a class="btn btn-xs btn-danger" href="<?=base_url()?>C_cetak/cetak_bill/pdf/" ><span class="excel"> </span> PDF</a>
   
    <a   class="btn btn-xs btn-warning" target="output"   href="<?=base_url()?>C_cetak/cetak_bill/html/"  ><span class="glyphicon glyphicon-print"> Print</span></a>
    

</div>
		</td>
	</tr>
	<?php } ?>
  </table>
  </div>
</div>

    </div><!-- /.container -->
    
