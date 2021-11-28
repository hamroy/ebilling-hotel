<div class="container"  style="background-color: #dddde1">
   
      <div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">
    	  <div class="page-header" >
        <h3>GUEST BILL</h3>
      </div>
    	
    </h3>
  </div>

  <div class="panel-body">
  <?php if('kosong'!='kosong'){
	echo '<p class="text-denger"  style="color: #ff0000">Nama '.$this->session->userdata('nama').'Tidak Terdaftar</p>';
}else{ ?>
	  <div class="table-responsive" >
	<p class="pull-right"> 
        <div class="btn-group">
    <a class="btn btn-xs btn-danger" href="<?=base_url()?>C_cetak/cetak_bill/pdf/<?=$id_p?>" ><span class="excel"> </span> PDF</a>
    <a class="btn btn-xs btn-success" href="<?=base_url()?>C_cetak/cetak_bill/xls/<?=$id_p?>" ><span class="excel"> </span> XLS</a>
    <a   class="btn btn-xs btn-warning" target="output"   href="<?=base_url()?>C_cetak/cetak_bill/html/<?=$id_p?>"  ><span class="glyphicon glyphicon-print"> Print</span></a>
    

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
		<td><?=substr($h_row->cekout,'0','-6')?></td>
		<td class="success">time</td>
		<td colspan="2"><?=substr($h_row->cekout,'11')?></td>
		<td colspan="3"></td>

	</tr>
	<tr>
		<td colspan="9"></td>
	</tr>
	</table>
	</div>
	
	<div class="col-sm-6 col-md-7">
	 <table class="table table-striped table-hover table-condensed table-responsive table-bordered" >

	<tr>
		<td>
		<?php if($lunas=='Lunas'){ }else{?>
		<a class="btn btn-primary btn-xs"  href="<?=base_url('C_resepsionis/s_deposit/'.$id_p)?>" ><span class="glyphicon glyphicon-plus"> Tambah</span></a>
		<?php } ?>
		</td>
		<td class="warning">Date</td>
		<td class="warning">Trnsfr (Rp)</td>
		<td class="warning">Cash (Rp)</td>
	</tr>
	
	
	<?php 
	//$d=$this->db->get_where('tbl_deposit',array('id_p'=>$id_p));
	$d=$this->Mhotel->get_all_deposit($id_p);
	
	$no=1;
	foreach($d->result() as $dep){ 
	$jml = $dep->cas + $dep->transfer;
	if ($jml != 0 ){
	?>
		<tr>
		<td class="success">Deposit <?=$no++?></td>
		<td><?=$dep->tanggal?></td>
		<td> <p align="right"><?=number_format($dep->transfer,0,',','.')?>
			<?php if(empty($dep->transfer) AND $dep->transfer != NULL OR !empty($dep->cas)){ ?>
		<?php }else{ ?>
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
     	<form class="form-inline" role="form" action="<?=base_url()?>C_resepsionis/up_transfer/<?=$id_p?>/<?=$dep->id?>" method="post">
   <div class="form-group">
<div class="input-group"   id="datetimepicker8">
        <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span>
   <input type="text" name="date" placeholder="<?=date('d/m/Y')?>" value="<?=$dep->tanggal?>" class="form-control">
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
	<?php	} ?>
			
		</p>
		</td>
		<td ><p align="right"><?php if(!empty($dep->cas)){
			echo number_format($dep->cas,0,',','.');
		} ?>
		<?php if(empty($dep->cas) AND $dep->cas!=NULL OR !empty($dep->transfer)){ ?>
		<?php }else{ ?>
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
     	<form class="form-inline" role="form" action="<?=base_url()?>C_resepsionis/up_transfer/<?=$id_p?>/<?=$dep->id?>" method="post">
  <div class="form-group">
<div class="input-group"   id="datetimepicker9">
        <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span>
   <input type="text" name="date" placeholder="<?=date('d/m/Y')?>" value="<?=$dep->tanggal?>" class="form-control">
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
	<?php	} ?>
			</p>
		</td>
	</tr>
<?php	}} ?>
	
	
	<tr>
		<td colspan="4"></td>
	</tr>
	</table>
</div>
	<div class="col-sm-6 col-md-5">
	 <table class="table table-striped table-hover table-condensed table-responsive table-bordered" >
<?php 
			//$dtota=0;
			$cas0=0;
			$trans0=0;
			$dt=$this->db->get_where('tbl_deposit',array('id_p'=>$id_p));
			foreach($dt->result() as $dto){ 
			  $cas0=$cas0+$dto->cas;
			 $trans0=$trans0+$dto->transfer;
			
			 //$cas0;
			} 
			 $totd=$cas0+$trans0;
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
			
			$payment=$p-$disc;
			$totalall=$totd-$payment;
			if($totd>=$payment){
				$this->Mhotel->lunas($id_p,'Lunas',$depo);
				$wt='success';
				
			}else{
				$this->Mhotel->lunas($id_p,'Tagihan',$depo);
				$wt='danger';
				
			}
			
			 ?>
	<tr>
		<td class="success" >Amount</td>
		<td align="right"><?=number_format($p,0,',','.')?></td>
	</tr>
	<tr>
		<td class="success" >Disc  ( 5% )<span class="pull-right"><a href="<?=base_url('C_resepsionis/gift/'.$hrf.'/'.$id_p)?>"><span class="glyphicon glyphicon-<?=$span?>"></span> <?=$active?></a>   </span></td>
		<td align="right"><?=number_format($disc,0,',','.')?></td>
	</tr>
	<tr>
		<td class="success" >Temporary Payment </td>
		<td  align="right"><?php
		$payment = $this->Mhotel->temporary_payment($id_p);
		echo number_format($payment,0,',','.')
		?> </td>
	</tr>
	<tr>
		<td class="success" >Deposit</td>
		<td align="right"  >
			
			<?php 
			$totd = $this->Mhotel->total_deposit($id_p);
			echo number_format($totd,0,',','.');
			?>
			
		</td>
	</tr>
	<tr>
	
		<td class="warning" rowspan="2">Total Payment  
		<?php if($lunas=='Lunas'){ }else{?>
		<span class="pull-right"><a data-toggle="modal" data-target="#myModalTotal" href="" ><span class="glyphicon glyphicon-pencil"></span></a></span>
		
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
  <label for="" class="label-control"> Total Payment </label>
<label for="" class="form-control"><?=number_format($totalall,0,',','.')?> </label>
  </div>
  <hr/>
   <div class="form-group">
  <label for="" class="label-control"> Date </label><br/>
<div class="input-group"   id="datetimepicker6">
        <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span>
   <input type="text" name="date" placeholder="<?=date('d-m-Y')?>"value="<?=date('d-m-Y')?>" class="form-control">
      <span class="input-group-btn">
      </span>
    </div><!-- /input-group -->

  </div>
<hr/>
  <div class="form-group">
  <label for="">Payment </label><br/>
<div class="input-group">
        <span class="input-group-addon">Rp : </span>
  <input type="text" class="form-control" name="cas" placeholder="Masukkan angka" value="0"  autofocus>
      <span class="input-group-btn">
      </span>
    </div><!-- /input-group -->

  </div>
  <hr/>
  <input type="hidden" name="payment" value="LUNAS">
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
		<td  align="right" rowspan="2" class="<?=$wt?>">
		
		<?php
		if($lunas=='Lunas'){ 
			echo number_format($payment,0,',','.');
		}else{
			echo number_format($totalall,0,',','.');
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
	</p>
	
<table class="table table-striped table-hover table-condensed table-responsive table-bordered" >
	<tr class="success">
		<td align="center" colspan="7">Room, Bed, & OT</td>
	</tr>
	<tr class="warning">
		<td>Date</td>
		<td>Room.no</td>
		<td>Bed / day</td>
		<td>OT / hours</td>
		<td>Amount</td>
		<td>Balance</td>
		<td>Menu</td>

	</tr>
	<?php
	$tot=0;
	foreach($h->result() as $hh){ 
	//$amm = $this->db->get_where('tbl_pesan_kamar',array('id'=>$hh->id_k));
	$am = $this->db->get_where('tbl_kamar',array('id_kamar'=>$hh->id_k))->row();
	if($hh->ot<4){
		$ot=$am->ot;
	}else{
		$ot=$am->ot2;
	}
	?>
		<tr>
		<td ><?=$hh->tanggal?></td>
		<td><?=$hh->id_k?></td>
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
				
		<td align="right"><?=number_format($am->harga,0,',','.');
		$tot=$tot+$am->harga+$hh->harga_bed+$hh->harga_ot;
		?></td><!--penjumlahan ber.ulang-->
		<td  align="right"><?=number_format($tot,0,',','.');?></td>
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
        <h4 class="modal-title" id="myModalLabel">Edit Data Bed dan Overtime (OT)</h4>
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

 
<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"><p class="text-left">Note.no </p></label>
    <div class="col-sm-10">
      <input type="Text" name="nota" class="form-control" id="inputEmail3">
    </div>
  </div>
  

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"><p class="text-left">Harga</p></label>
    <div class="col-sm-5 ">
    <div class="input-group">
  <span class="input-group-addon">Rp : </span>
  <input type="Text" name="harga" class="form-control" id="inputEmail3">
</div>
    </div>
  </div>
   
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"><p class="text-left">Tanggal </p></label>
    <div class="col-sm-5">
      <input type="text" name="tanggal" id="datetimepicker7" placeholder="<?=date('d/m/Y')?>" value="<?=date('d/m/Y')?>" class="form-control date">
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
    
     
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"><p class="text-left">Date</p></label>
    <div class="col-sm-10">
      <?php 
  
    echo form_dropdown('tgl',$tgl,'','class="form-control" ')
    ?> 
    </div>
  </div>
  

  
  
  
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
  

  
