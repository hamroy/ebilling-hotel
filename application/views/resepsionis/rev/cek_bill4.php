<div class="container"  style="background-color: #dddde1">
<!--   <div class="alert alert-success alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Warning!</strong> Better check yourself, you're not looking too good.
</div>-->

   
      <div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">
    	  <div class="page-header" >
        <h3>GUEST BILL</h3>
      </div>
    	
    </h3>
      <!--<form class="form-horizontal" role="form" method="post" action="<?=base_url()?>/C_resepsionis/cari">
          <ul class="list-group">
            <li href="#" class="list-group-item">
              <p class="list-group-item-text">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label" ><p class="text-left text-inner" style="color: #000000">Cari Nama</p></label>
    <div class="col-sm-5">
      <input type="text" name= "nama" class="form-control" id="inputEmail3" placeholder="Nama">
    </div>
    <div class="col-sm-5">
     <button type="submit" class="btn btn-success btn-md">TAMPILKAN</button>
    </div>
  </div>

  		
              </p>
            </li>
          </ul>



  
</form>-->
  </div>
  <div class="panel-body">
  <?php if('kosong'!='kosong'){
	echo '<p class="text-denger"  style="color: #ff0000">Nama '.$this->session->userdata('nama').'Tidak Terdaftar</p>';
}else{ ?>
	  <div class="table-responsive" >
	<p class="pull-right"> 
        <div class="btn-group">
  <!--<button type="button" class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown">
    Download <span class="caret"></span>
  </button>-->
  <!--<ul class="dropdown-menu" role="menu">-->
    <a class="btn btn-xs btn-danger" href="<?=base_url()?>C_cetak/cetak_bill/pdf/<?=$id_p?>" ><span class="excel"> </span> PDF</a>
    <a class="btn btn-xs btn-success" href="<?=base_url()?>C_cetak/cetak_bill/xls/<?=$id_p?>" ><span class="excel"> </span> XLS</a>
    <a   class="btn btn-xs btn-warning" target="output"   href="<?=base_url()?>C_cetak/cetak_bill/html/<?=$id_p?>"  ><span class="glyphicon glyphicon-print"> Print</span></a>
    
  <!--</ul>-->
</div>
	</p>
	<div class="pull-right text-muted" align="right"><?=$h_row->user?> <?=$h_row->update?></div>
	<!--INPUT DEPOSIT-->
	<div class="row">

  <div class="col-sm-6 col-md-12">
	 <table class="table table-striped table-hover table-condensed table-responsive table-bordered" >
	<tr>
		<th class="warning">Name</th>
		<th colspan="8"><?=$h_row->nama?></th>
	</tr>
	<tr>
		<td class="warning">Address</td>
		<td colspan="8"><?=$h_row->alamat?></td>
	</tr>
	<tr>
		<td class="warning">Check in</td>
		<td class="success">date</td>
		<td><?=substr($h_row->cekin,'0','-6')?></td>
		<td class="success">time</td>
		<td colspan="2"><?=substr($h_row->cekin,'11')?></td>
		<td colspan="3"></td>
	</tr>
	
	<tr>
		<td class="warning">Check out</td>
		<td class="success">date</td>
		<td><?php $g_id_mak=$this->Mhotel->get_tbl_perpanjang_mak($id_p)->row();
		 $sortt= $g_id_mak->cekout;
		 $xxx=substr($sortt,'0','4');
$xx=substr($sortt,'4','2');
$x=substr($sortt,'6','2');
		echo  $x.'-'.$xx.'-'.$xxx;
		
		//substr($h_row->cekin,'0','-6')
		?></td>
		<td class="success">time</td>
		<td colspan="2"><?=substr($h_row->cekout,'11')?></td>
		<td colspan="3"></td>

	</tr>
	<tr>
		<td colspan="9"></td>
	</tr>
	</table>
	</div>
	<!---->
	<?php 
			
			// $totd=$cas0+$trans0;
			 $totd=$this->Mhotel->total_deposit($id_p);
			 $totdll=$this->Mhotel->total_all($id_p);
			 if($h_row->disc=='active'){
				 $disc=(5*$totdisc)/100;
				 $active='Non active';
				$span='remove-sign';
				$hrf='NULL';
			}else{
				$active='active';
				$span='ok-circle';
				$hrf='active';
				$disc=0;
			}
			///
			if($disc==0){////paymen kosong bila disc kosong
				$payment=0;
			}else{
			$payment=$p-$disc;
			//$payment=$this->Mhotel->temporary_payment($id_p);	
			}
			///
			$paymentall=$p-$disc;
			$totalall=$totdll-$paymentall;////untiuk total 
			///
			if($totdll>=$paymentall){
				$this->Mhotel->lunas($id_p,'Lunas');
				$wt='success';
				
			}else{
				$this->Mhotel->lunas($id_p,'Tagihan');
				$wt='danger';
				
			}
			
			 ?>

	<!---->
	<div class="col-sm-6 col-md-7">
	 <table class="table table-striped table-hover table-condensed table-responsive table-bordered" >

	<tr>
		<td>
		<?php if($wt=='success'){ }else{?>
		<a class="btn btn-primary btn-xs"  href="<?=base_url('C_resepsionis/s_deposit/'.$id_p)?>" ><span class="glyphicon glyphicon-plus"> Tambah</span></a>
		<?php } ?>
		</td>
		<td class="warning">Date</td>
		<td class="warning">Trnsfr (Rp)</td>
		<td class="warning">Cash (Rp)</td>
	</tr>
	
	
	<?php 
	$d=$this->Mhotel->get_all_deposit_total($id_p);
	$no=1;
	foreach($d->result() as $dep){ ?>
		<tr>
		<td class="success">Deposit <?=$no++?></td>
		<td><?=$dep->tanggal?></td>
		<td> <p align="right"><?=number_format($dep->transfer,0,',','.')?>
			<?php if(empty($dep->transfer) AND $dep->transfer != 0 OR !empty($dep->cas)){ ?>
		<?php }else{ 
		 if($wt=='success'){ }else{?>
		<a data-toggle="modal" data-target="#myModaltransferup<?=$dep->id?>" href="" ><span class="glyphicon glyphicon-pencil"> </span></a>
<!-- Modal -->
<div class="modal fade" id="myModaltransferup<?=$dep->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">TRANSFER</h4>
      </div>
      <div class="modal-body">
     	<form class="form-inline" role="form" action="<?=base_url()?>C_resepsionis/up_transfer_dep/<?=$id_p?>/<?=$dep->id?>" method="post">
   <div class="form-group">
<div class="input-group"   id="datetimepicker8">
        <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span>
   <input type="text" name="date" placeholder="<?=date('d-m-Y')?>" value="<?=$dep->tanggal?>" class="form-control">
      <span class="input-group-btn">
      </span>
    </div><!-- /input-group -->

  </div>
  <div class="form-group">
<div class="input-group">
        <span class="input-group-addon">Rp : </span>
  <input type="text" class="form-control" name="cas_t" placeholder="Masukkan angka" value="<?=$dep->transfer?>" autofocus>
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit">Simpan</button>
      </span>
    </div><!-- /input-group -->

  </div>
</form>
      </div>
    </div>
  </div>
</div>	
		<?php } ?>
				
	<?php	} ?>
			
		</p>
		</td>
		<td ><p align="right"><?php if(!empty($dep->cas)){
			echo number_format($dep->cas,0,',','.');
		} ?>
		<?php if(empty($dep->cas) AND $dep->cas!=0 OR !empty($dep->transfer)){ ?>
		<?php }else{  ?>
		<?php if($wt=='success'){ }else{?>
		<a data-toggle="modal" data-target="#myModalcasup<?=$dep->id?>" href="" ><span class="glyphicon glyphicon-pencil"> </span></a>
<!-- Modal -->
<div class="modal fade" id="myModalcasup<?=$dep->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">CASH</h4>
      </div>
      <div class="modal-body">
     	<form class="form-inline" role="form" action="<?=base_url()?>C_resepsionis/up_transfer_dep/<?=$id_p?>/<?=$dep->id?>" method="post">
  <div class="form-group">
<div class="input-group"  id="datetimepicker9">
        <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span>
   <input type="text" name="date" placeholder="<?=date('d-m-Y')?>" value="<?=$dep->tanggal?>" class="form-control">
      <span class="input-group-btn">
      </span>
    </div><!-- /input-group -->

  </div>
  <div class="form-group">
<div class="input-group">
        <span class="input-group-addon">Rp : </span>
  <input type="text" class="form-control" name="cas" placeholder="Masukkan angka" value="<?=$dep->cas?>" autofocus>
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit">Simpan</button>
      </span>
    </div><!-- /input-group -->

  </div>
</form>
      </div>
    </div>
  </div>
</div>		
		<?php } ?>
			
	<?php	} ?>
			</p>
		</td>
	</tr>
<?php	} ?>
	
	
	<tr>
		<td colspan="4"></td>
	</tr>
	</table>
</div>
	<div class="col-sm-6 col-md-5">
	 <table class="table table-striped table-hover table-condensed table-responsive table-bordered" >
	<tr>
		<td class="success" >Amount</td>
		<td align="right"><?=number_format($p,0,',','.')?></td>
	</tr>
	<tr>
		<td class="success" >Disc.  Member<span class="pull-right"><a href="<?=base_url('C_resepsionis/gift/'.$hrf.'/'.$id_p)?>"><span class="glyphicon glyphicon-<?=$span?>"></span> <?=$active?></a>   </span></td>
		<td align="right"><?=number_format($disc,0,',','.')?></td>
	</tr>
	<!--<tr>
		<td class="success" >Temporary Payment </td>
		<td  align="right"><?=number_format($payment,0,',','.')?> </td>
	</tr>-->
	<tr>
		<td class="success" >Deposit</td>
		<td align="right"  >
			
			<?=number_format($totd,0,',','.')?>
		</td>
	</tr>
	<tr>
	
		<td class="warning" rowspan="2">Total Payment  
		<?php if($wt=='success'){ }else{?>
		<span class="pull-right"><a data-toggle="modal" data-target="#myModalTotal" href="" ><span class="glyphicon glyphicon-pencil"> </span></a></span>
		
		<!-- Modal -->
<div class="modal fade" id="myModalTotal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Total Payment  </h4>
      </div>
      <div class="modal-body">
     	<form class="form-inline" role="form" action="<?=base_url()?>C_resepsionis/up_transfer/<?=$id_p?>/<?=$totid+1?>" method="post">
     	
  <div class="form-group">
  <label for="" class="label-control"> Total Payment  : <?=$totalall?> </label>
  </div>
  <hr/>
   <div class="form-group">
  <label for="" class="label-control"> Date </label><br/>
<div class="input-group"   id="datetimepicker10">
        <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span>
   <input type="text" name="date" placeholder="<?=date('d-m-Y')?>"value="<?=date('d-m-Y')?>" class="form-control">
      <span class="input-group-btn">
      </span>
    </div><!-- /input-group -->

  </div>
<hr/>
  <div class="form-group">
  <label for="">CAS </label><br/>
<div class="input-group">
        <span class="input-group-addon">Rp : </span>
  <input type="text" class="form-control" name="cas" placeholder="Masukkan angka" value="0"  autofocus>
      <span class="input-group-btn">
      </span>
    </div><!-- /input-group -->

  </div>
  <hr/>
  <div class="form-group">
  
  <label for="">TRANSFER  </label><br/>
<div class="input-group">
        <span class="input-group-addon">Rp : </span>
  <input type="text" class="form-control" name="cas_t" placeholder="Masukkan angka" value="0"  autofocus>
      <span class="input-group-btn">
        
      </span>
    </div><!-- /input-group -->

  </div><br/><hr/>
  <div class="form-group">
  <button class="btn btn-default" type="submit">Simpan</button>
  </div>
</form>
      </div>
    </div>
  </div>
</div>	
		<?php } ?>
		</td>
		<td  align="right" rowspan="2" class="<?=$wt?>"><?php
		//revisi masterpra:
		//setelah dilunasi, tidak boleh 0 (nol), harus bernilai positif sesuai jumlah pelunasan
		if ($totalall==0){
		echo number_format($this->Mhotel->total_payment_lunas($id_p),0,',','.');
		}else{
		echo number_format($totalall,0,',','.').'x';
		}
		?>  
			

		</td>
	</tr>
	
	</table>
</div>
</div>
	<!--lpaoran keuangan kamar // room-->
<div class="row">

  <div class="col-sm-6 col-md-7">
  <!---->
  <p class="pull-right"> 
        <div class="btn-group">
  <button type="button" class="btn btn-info btn-md"data-toggle="modal" data-target="#myModalroom">
 <span class="glyphicon glyphicon-plus"></span> Tambah 
  </button>
</div>
  <button type="button" class="btn btn-success btn-md"data-toggle="modal" data-target="#myModalperpanjang">
 <span class="glyphicon glyphicon-plus"></span> Perpanjang 
  </button>

	</p>
	
<table class="table table-striped table-hover table-condensed table-responsive table-bordered"style="font-size: 90%" >
	<tr class="success">
		<td align="center" colspan="8">Room, Bed, & OT</td>
	</tr>
	<tr class="warning">
		<td>Date</td>
		<td>Room.no</td>
		<td>Bed / day</td>
		<td>OT / hours</td>
		<td>DISC</td>
		<td>Amount</td>
		<td>Balance</td>
		<td>Menu</td>

	</tr>
	<?php
	$tot=0;
	foreach($h->result() as $hh){ 
	//$amm = $this->db->get_where('tbl_pesan_kamar',array('id'=>$hh->id_k));
	//$am = $this->db->get_where('tbl_kamar',array('id_kamar'=>$hh->id_k))->row();
	$am = $this->Mhotel->cek_bill_kamar($hh->id_k)->row();
	if($hh->ot<4){
		$ot=$am->ot;
	}else{
		$ot=$am->ot2;
	}
	?>
		<tr>
		<td ><?=$hh->tanggal?></td>
		<td><?=$hh->id_k?></td>
		<!--BED-->
		<td>
		<?=!empty($hh->bed) ?  $hh->bed .'.( 60000 )':''?>
		<?php if(empty($hh->bed)){ ?>
			<button type="button" class="btn btn-info btn-xs"data-toggle="modal" data-target="#mybad<?=$hh->id?>">
 <span class="glyphicon glyphicon-plus"></span> 
  </button>
  		<!--MODAL-->
  		<div class="modal fade" id="mybad<?=$hh->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Tambah Data Bed</h4>
      </div>
      <div class="modal-body">
    
          <ul class="list-group">
             <form class="form-horizontal" role="form" method="post" action="<?=base_url()?>/C_resepsionis/bed/<?=$hh->id?>/<?=$id_p?>">
             <li href="#" class="list-group-item">
      <h3>BED</h3>
            </li>
            <li href="#" class="list-group-item">
              <p class="list-group-item-text">
<div class="form-group">
    <div class="col-sm-10">
     <div class="input-group">
  <input type="text" name="bed" value="1"  class="form-control">
  <span class="input-group-addon">Bed/day</span>
</div>

    </div>
  </div>

  
  <div class="form-group">
     
 <div class="col-sm-5">
      <button type="submit" class="btn btn-success btn-md ">SIMPAN</button>
    </div>
  </div>
  		
              </p>
            </li>
 </form>         
          </ul>



  

      </div>
    </div>
  </div>
</div> 
	<?php	} ?>
		
  		
  		</td>
		<!--OT-->
		<td>
		<?=!empty($hh->ot) ?  $hh->ot.'.( '.$ot.' )' :''?>
		<?php if(empty($hh->ot)){ ?>
			<button type="button" class="btn btn-info btn-xs"data-toggle="modal" data-target="#myot<?=$hh->id?>">
 <span class="glyphicon glyphicon-plus"></span> 
  </button>
  		<!--MODAL-->
  		<div class="modal fade" id="myot<?=$hh->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Tambah Data OverTime ( OT)</h4>
      </div>
      <div class="modal-body">
    
          <ul class="list-group">
             <form class="form-horizontal" role="form" method="post" action="<?=base_url()?>/C_resepsionis/ot/<?=$hh->id?>/<?=$id_p?>/<?=$hh->id_k?>">
             <li href="#" class="list-group-item">
      <h3>OverTime</h3>
            </li>
            <li href="#" class="list-group-item">
              <p class="list-group-item-text">
<div class="form-group">
    <div class="col-sm-10">
     <div class="input-group">
  <input type="text" name="ot" value="1"  class="form-control">
  <span class="input-group-addon">Hours</span>
</div>

    </div>
  </div>

  
  <div class="form-group">
     
 <div class="col-sm-5">
      <button type="submit" class="btn btn-success btn-md ">SIMPAN</button>
    </div>
  </div>
  		
              </p>
            </li>
 </form>         
          </ul>



  

      </div>
    </div>
  </div>
</div> 
	<?php	} ?>
		
  		
  		</td>
		<!--DISC-->
		<td align="right">
		<?php 
		$dtot=$am->harga+$hh->harga_bed+$hh->harga_ot;
		$disc=($hh->disc*$dtot)/100;
		echo number_format($disc,0,',','.');
		?></td>
			<!--AMOUNT & BALANCE-->		
		<td align="right"><?=number_format($am->harga,0,',','.');
		$tot=($tot+$am->harga+$hh->harga_bed+$hh->harga_ot)-$disc;
		
		?></td><!--penjumlahan ber.ulang-->
		<td  align="right"><?=number_format($tot,0,',','.');?></td>
		<!--Menu-->
		<td  align="left">
			
				<button type="button" class="btn btn-info btn-xs"data-toggle="modal" data-target="#myedit<?=$hh->id?>">
 <span class="glyphicon glyphicon-pencil"></span> 
  </button>
  			<a type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Anda Yakin?')" href="<?=base_url('C_resepsionis/hapus_bill/'.$hh->id.'/'.$id_p)?>" >
 <span class="glyphicon glyphicon-remove"></span> 
  </a>
  		<!--MODAL-->
  		   <!--MODAL TAMBAH DATA LAIN ROOM-->
<div class="modal fade" id="myedit<?=$hh->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit Data Bed dan Overtime (OT) dan DISC</h4>
      </div>
      <div class="modal-body">
    
          <ul class="list-group">
               <form class="form-horizontal" role="form" method="post" action="<?=base_url()?>/C_resepsionis/bed_ot/<?=$hh->id?>/<?=$id_p?>/<?=$hh->id_k?>">
             <li href="#" class="list-group-item">
      <h3>BED</h3>
            </li>
            <li href="#" class="list-group-item">
              <p class="list-group-item-text">
<div class="form-group">
    <div class="col-sm-10">
     <div class="input-group">
  <input type="text" name="ot" value="<?=$hh->bed?>"  class="form-control">
  <span class="input-group-addon">Bed / day</span>
</div>

    </div>
  </div>
 
  		
              </p>
            </li>
 
             <li href="#" class="list-group-item">
      <h3>OverTime (OT)</h3>
            </li>
            <li href="#" class="list-group-item">
              <p class="list-group-item-text">

<div class="form-group">
    <div class="col-sm-10">
     <div class="input-group">
  <input type="text" name="ot" value="<?=$hh->ot?>"  class="form-control">
  <span class="input-group-addon">Hours</span>
</div>

    </div>
  </div>
  
  
  		
              </p>
            </li>
            <li href="#" class="list-group-item">
      <h3>DISC </h3>
            </li>
            <li href="#" class="list-group-item">
              <p class="list-group-item-text">

<div class="form-group">
    <div class="col-sm-2">
     <div class="input-group" href="#">
     <label>
  <input type="radio" name="d10" value="0" class="btn btn-sm"  <?php if($hh->disc==0){ echo 'checked' ;} ?> > 0</label>
</div>
    </div>
    <div class="col-sm-2">
     <div class="input-group" href="#">
     <label>
  <input type="radio" name="d10" value="10" class="btn btn-sm"  <?php if($hh->disc==10){ echo 'checked' ;} ?> > 10%
</label>
</div>
    </div>
    <div class="col-sm-2">
     <div class="input-group" href="#">
     <label>
  <input type="radio" name="d10" value="20" class="btn btn-sm"  <?php if($hh->disc==20){ echo 'checked' ;} ?> > 20%
</label>
</div>
    </div>
    <div class="col-sm-2">
     <div class="input-group" href="#">
     <label>
  <input type="radio" name="d10" value="30" class="btn btn-sm"  <?php if($hh->disc==30){ echo 'checked' ;} ?> > 30%
</label>
</div>
    </div>
    
  
  </div>
  
  
  		
              </p>
            </li>
            <div class="form-group">
     
 <div class="col-sm-12">
      <button type="submit" class="btn btn-success btn-block btn-md ">Simpan</button>
    </div>
  </div>
 </form>      
          </ul>



  

      </div>
    </div>
  </div>
</div> 
			
		</td>
<!--END-->
		</tr>
<?php	 }
	 ?>
	
	
  </table>
  </div>
  <div class="col-sm-6 col-md-5">
  <p class="pull-right"> 
        <div class="btn-group">
  <button type="button" class="btn btn-info btn-md"data-toggle="modal" data-target="#myModal">
  <span class="glyphicon glyphicon-plus"></span>  Tambah Data 
  </button>
 
</div>
	</p>
  <table class="table table-striped table-hover table-condensed table-responsive table-bordered" >
	<tr class="success">
		<td align="center" colspan="5">Food, Beverage, Laundry, & Etc</td>
	</tr>
	<tr class="warning">
		<td>Date</td>
		<td>Note.no</td>
		<td>Amount</td>
		<td>Balance</td>
		<td>Menu</td>

	</tr>
	<?php $tott=0;	foreach($h1->result() as $hh1){ ?>
	           <tr>
		<td ><?php echo $hh1->tanggal?></td>
		<td><?=$hh1->nota?></td>
		<td  align="right"><?=number_format($hh1->harga,0,',','.');
		$tott=$tott+$hh1->harga;
		?></td>
		<td  align="right"><?=number_format($tott,0,',','.');?></td>
		<td ><button type="button" class="btn btn-info btn-xs"data-toggle="modal" data-target="#myfbl<?=$hh1->id?>">
  <span class="glyphicon glyphicon-pencil"></span>  
  </button> <a type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Anda Yakin?')" href="<?=base_url('C_resepsionis/hapus_tagihan/'.$hh1->id.'/'.$id_p)?>" >
 <span class="glyphicon glyphicon-remove"></span> 
  </a>
			<!--MODAL EDIT YTAGIHAN-->
			<div class="modal fade" id="myfbl<?=$hh1->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">EDIT</h4>
      </div>
      <div class="modal-body">
       <form class="form-horizontal" role="form" method="post" action="<?=base_url()?>/C_resepsionis/edit_tagihan/<?=$hh1->id?>/<?=$id_p?>">
          <ul class="list-group">
            <li href="#" class="list-group-item">
              <p class="list-group-item-text">

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"><p class="text-left">Tanggal </p></label>
    <div class="col-sm-10">
      <input type="Text" name="tanggal" class="form-control" id="inputEmail3" value="<?=$hh1->tanggal?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"><p class="text-left">Note.no </p></label>
    <div class="col-sm-10">
      <input type="Text" name="nota" class="form-control" id="inputEmail3" value="<?=$hh1->nota?>">
    </div>
  </div>
  
 

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"><p class="text-left">Harga</p></label>
    <div class="col-sm-5 ">
    <div class="input-group">
  <span class="input-group-addon">Rp : </span>
  <input type="Text" name="harga" class="form-control" id="inputEmail3" value="<?=$hh1->harga?>">
</div>
    </div>
  </div>
  
  		
              </p>
            </li>
           <!--<li href="#" class="list-group-item">
              <p class="list-group-item-text">
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"><p class="text-left">Keterangan</p></label>
    <div class="col-sm-10">
      <textarea class="form-control" name="pesan" rows="3"></textarea>
    </div>
  </div>
  
  
              </p>
            </li>-->
            
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
<?php	}?>
	
	
  </table>
  </div>
  </div>

  </div>
	
<?php } ?>
  
  </div>
</div>
<!-- Modall food dl -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">PESANAN</h4>
      </div>
      <div class="modal-body">
       <form class="form-horizontal" role="form" method="post" action="<?=base_url()?>/C_resepsionis/simpan_tagihan/<?=$id_p?>">
          <ul class="list-group">
            <li href="#" class="list-group-item">
              <p class="list-group-item-text">

  <!--<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"><p class="text-left">Jenisnya</p></label>
    <div class="col-sm-10">
      <select class="form-control" name="jenis">
  <option value="1">Beverage</option>
  <option value="2">Food</option>
  <option value="3">Laundry</option>
  <option value="4">Other</option>
</select>

    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"><p class="text-left">Keterangan</p></label>
    <div class="col-sm-10">
      <textarea class="form-control" name="ket" rows="3"></textarea>
    </div>
  </div>-->
<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"><p class="text-left">Note.no </p></label>
    <div class="col-sm-10">
      <input type="Text" name="nota" class="form-control" id="inputEmail3">
    </div>
  </div>
  
 <!--<div class="form-group">
		    <label class="col-sm-2 control-label"><p class="text-left">Check in</p></label>
		     <div class="col-sm-4">
		     
   
      <input type="text" name="cekin" id="datetimepicker5" data-date="12 04 14" data-date-format="dd/mm/yyyy" placeholder="<?=date('d/m/Y')?>" value="<?=date('d/m/Y')?>" class="form-control">
     

  </div><!-- /.col-lg-6 --
  
  		</div>-->
 <!--<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"><p class="text-left">Nama Pengunjung</p></label>
    <div class="col-sm-10">
     <?php 
	
  //  echo form_dropdown('id_p',$nama,'','class="form-control" ')
    ?> 
    </div>
  </div>-->
  

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"><p class="text-left">Harga</p></label>
    <div class="col-sm-5 ">
    <div class="input-group">
  <span class="input-group-addon">Rp : </span>
  <input type="Text" name="harga" class="form-control" id="inputEmail3">
</div>
    </div>
  </div>
   <!--<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"><p class="text-left">Jumlah</p></label>
    <div class="col-sm-5">
      <input type="Text" name="jmlah" class="form-control" id="inputEmail3" value="1">
    </div>
  </div>-->
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"><p class="text-left">Tanggal </p></label>
    <div class="col-sm-5">
      <input type="text" name="tanggal" id="datetimepicker7" placeholder="<?=date('d/m/Y')?>" value="<?=date('d/m/Y')?>" class="form-control date">
    </div>
  </div>
  
  		
              </p>
            </li>
           <!--<li href="#" class="list-group-item">
              <p class="list-group-item-text">
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"><p class="text-left">Keterangan</p></label>
    <div class="col-sm-10">
      <textarea class="form-control" name="pesan" rows="3"></textarea>
    </div>
  </div>
  
  
              </p>
            </li>-->
            
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
<!--MODAL TAMBAH DATA LAIN ROOM-->
<div class="modal fade" id="myModalroom" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Tambah Kamar</h4>
      </div>
      <div class="modal-body">
    
          <ul class="list-group">
             <form class="form-horizontal" role="form" method="post" action="<?=base_url()?>/C_resepsionis/up_kamar/<?=$id_p?>">
             <li href="#" class="list-group-item">
      <h3>Pilih Jenis Kamar</h3>
            </li>
            <li href="#" class="list-group-item">
              <p class="list-group-item-text">

    
  <div class="form-group">
    <div class="col-sm-12">
    
    <div class="col-sm-2">
     <p class="text-left"><b>Deluxe Depan</b></p>
   <?php 
   
    $dd=$this->Mhotel->cek_kamar_no_dd();
    foreach($dd->result() as $dd1){ ?>
   <input class="btn btn-xs" type="checkbox" name="k_<?=$dd1->id_kamar?>" value="<?=$dd1->id_kamar?>"/> No. <?=$dd1->id_kamar?><br/>
  <?php } ?>
    </div>
     <div class="col-sm-3">
     <p><b>Deluxe Belakang</b></p>
      <?php 
    $db=$this->Mhotel->cek_kamar_no_db();
    foreach($db->result() as $db1){ ?>
   <input class="btn btn-xs" type="checkbox" name="k_<?=$db1->id_kamar?>" value="<?=$db1->id_kamar?>" /> No. <?=$db1->id_kamar?><br/>
  <?php } ?>
    </div>
    <div class="col-sm-2">
    <p><b>Famliy room</b></p>
    <?php 
    $f=$this->Mhotel->cek_kamar_no_f();
    foreach($f->result() as $fa){ ?>
   <input class="btn btn-xs" type="checkbox" name="k_<?=$fa->id_kamar?>" value="<?=$fa->id_kamar?>" /> No. <?=$fa->id_kamar?><br/>
  <?php } ?>
    </div>
    <div class="col-sm-2">
   <p> <b>junior suite</b></p>
     <?php 
    $jus=$this->Mhotel->cek_kamar_no_js();
    foreach($jus->result() as $js){ ?>
   <input class="btn btn-xs" type="checkbox" name="k_<?=$js->id_kamar?>" value="<?=$js->id_kamar?>" /> No. <?=$js->id_kamar?>
  <?php } ?>
    </div>
    <div class="col-sm-2">
    <p><b>Paviliun <br/>&nbsp;&nbsp;</b></p>
    <?php 
    $pa=$this->Mhotel->cek_kamar_no_pa();
    foreach($pa->result() as $p){ ?>
   <input class="btn btn-xs" type="checkbox" name="k_<?=$p->id_kamar?>" value="<?=$p->id_kamar?>"/> No. <?=$p->id_kamar?>
  <?php } ?>

    </div>
    
     <?php 
  
   //  echo form_dropdown('kamar',$kamar,'','class="form-control" ')
    ?> 
    </div>
  </div>
<hr/>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"><p class="text-left">Date</p></label>
    <div class="col-sm-10">
      <?php 
  
    echo form_dropdown('tgl',$tgl,'','class="form-control" ')
    ?> 
    </div>
  </div>
  <!---->
  <hr/>

  
  
  
  <div class="form-group">
     
 <div class="col-sm-12" align="right">
      <button type="submit" class="btn btn-success btn-md ">Simpan</button>
    </div>
  </div>
  		
              </p>
            </li>
 </form>         
              
          </ul>



  

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>
<!--PERPANJANG-->
<div class="modal fade" id="myModalperpanjang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Perpanjang Kamar</h4>
      </div>
      <div class="modal-body">
    
          <ul class="list-group">
             <form class="form-horizontal" role="form" method="post" action="<?=base_url()?>/C_resepsionis/perpanjang_kamar/<?=$id_p?>">
             <li href="#" class="list-group-item">
      <h3>Pilih Jenis Kamar</h3>
            </li>
            <li href="#" class="list-group-item">
              <p class="list-group-item-text">

    
  <div class="form-group">
    <div class="col-sm-12">
    
    <div class="col-sm-2">
     <p class="text-left"><b>Deluxe Depan</b></p>
   <?php 
   
    $dd=$this->Mhotel->cek_kamar_no_dd_id($id_p);
    foreach($dd->result() as $dd1){ ?>
   <input class="btn btn-xs" type="checkbox" name="k_<?=$dd1->id_kamar?>" value="<?=$dd1->id_kamar?>"/> No. <?=$dd1->id_kamar?><br/>
  <?php } ?>
    </div>
     <div class="col-sm-3">
     <p><b>Deluxe Belakang</b></p>
      <?php 
    $db=$this->Mhotel->cek_kamar_no_db_id($id_p);
    foreach($db->result() as $db1){ ?>
   <input class="btn btn-xs" type="checkbox" name="k_<?=$db1->id_kamar?>" value="<?=$db1->id_kamar?>" /> No. <?=$db1->id_kamar?><br/>
  <?php } ?>
    </div>
    <div class="col-sm-2">
    <p><b>Famliy room</b></p>
    <?php 
    $f=$this->Mhotel->cek_kamar_no_f_id($id_p);
    foreach($f->result() as $fa){ ?>
   <input class="btn btn-xs" type="checkbox" name="k_<?=$fa->id_kamar?>" value="<?=$fa->id_kamar?>" /> No. <?=$fa->id_kamar?><br/>
  <?php } ?>
    </div>
    <div class="col-sm-2">
   <p> <b>junior suite</b></p>
     <?php 
    $jus=$this->Mhotel->cek_kamar_no_js_id($id_p);
    foreach($jus->result() as $js){ ?>
   <input class="btn btn-xs" type="checkbox" name="k_<?=$js->id_kamar?>" value="<?=$js->id_kamar?>" /> No. <?=$js->id_kamar?>
  <?php } ?>
    </div>
    <div class="col-sm-2">
    <p><b>Paviliun <br/>&nbsp;&nbsp;</b></p>
    <?php 
    $pa=$this->Mhotel->cek_kamar_no_pa_id($id_p);
    foreach($pa->result() as $p){ ?>
   <input class="btn btn-xs" type="checkbox" name="k_<?=$p->id_kamar?>" value="<?=$p->id_kamar?>"/> No. <?=$p->id_kamar?>
  <?php } ?>

    </div>
    
     <?php 
  
   //  echo form_dropdown('kamar',$kamar,'','class="form-control" ')
    ?> 
    </div>
  </div>
<hr/>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"><p class="text-left">Perpanjang</p></label>
    <div class="col-sm-10">
      <div class="input-group">
  <input type="text" name="hari" value="1"  class="form-control">
  <span class="input-group-addon">hari</span>
</div>
    </div>
  </div>
  

  
  
  <hr/>
  <div class="form-group">
     
 <div class="col-sm-12" align="right">
      <button type="submit" class="btn btn-success btn-md ">Simpan</button>
    </div>
  </div>
  		
              </p>
            </li>
 </form>         
              
          </ul>



  

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>

   

    </div><!-- /.container -->
  


