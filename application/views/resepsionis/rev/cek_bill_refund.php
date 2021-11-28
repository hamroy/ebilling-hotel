<div class="container">

<div class="well well-sm">Resepsionis  <em><?=$this->Madmin->get_user($id_user)->row()->username?></em></div>
<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3><b>PENDAPATAN HOTEL</b></h3></div>
  <div class="panel-body">
<ul class="nav nav-tabs">
  <li><a href="<?=base_url()?>C_admin/rinci_pendapatan/<?=$id_user?>/1/<?=$id_tgl?>/<?=$shift?>">KAMAR</a></li>
  <li><a href="<?=base_url()?>C_admin/rinci_pendapatan/<?=$id_user?>/2/<?=$id_tgl?>/<?=$shift?>"	>DAPUR</a></li>
  <li class="active"><a href="<?=base_url()?>C_admin/rinci_pendapatan/<?=$id_user?>/3/<?=$id_tgl?>/<?=$shift?>">REFUND</a></li>
</ul>
<br/>

 <a href="<?=base_url()?>C_admin/rinci_pendapatan/<?=$id_user?>/3/<?=$id_tgl?>/<?=$shift?>"><span class="glyphicon glyphicon-arrow-left
"></span> Kembali</a>
  <hr/>
  
  <div class="table-responsive" >

	
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
		<td><?php  
		///=================================================CEK in============================================================
		$g_id_min=$this->Mhotel->get_tbl_bill_tgl_min($id_p)->row();
		 $sorttmin= $g_id_min->sort_t;
		 $xxxm=substr($sorttmin,'0','4');
				$xxm=substr($sorttmin,'4','2');
				$xm=substr($sorttmin,'6','2');
				echo  $xm.'-'.$xxm.'-'.$xxxm;
		?></td>
		<td class="success">time</td>
		<td colspan="2"><?=substr($h_row->cekin,'11')?></td>
		<td colspan="3"></td>
	</tr>
	
	<tr>
		<td class="warning">Check out</td>
		<td class="success">date</td>
	<td><?php $g_id_mak=$this->Mhotel->get_tbl_perpanjang_mak($id_p)->row();
					$g_id_mak_bill=$this->Mhotel->get_tbl_perpanjang_mak_new($id_p)->row();
		if(empty($g_id_mak->cekout)){
			 $sortt= $g_id_mak_bill->sort_t+1;
		}else{
			 $sortt= $g_id_mak->cekout;
		}
		
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
			 $totd=$this->Mhotel->total_deposit($id_p);/////tidak deposit total yag di payment
			 $totdll=$this->Mhotel->total_all($id_p); ////menggunakan deposit total yag di payment /alll semua deposit
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
			
			$paymentall=$p-$disc; ////
			$totalall=$totdll-$paymentall;////untiuk total ////uang yang di bayar di kurangi tagihan kamar
			////
			////untuk mecari total dep
			///
			///
			if($totdll>=$paymentall){
				//$this->Mhotel->lunas($id_p,'Lunas');
				//$this->Mhotel->lunastagihan($id_p,'Lunas');
				$wt='success';
				$warna='#4bd853';
				
			}else{
				//$this->Mhotel->lunas($id_p,'Tagihan');
				//$this->Mhotel->lunastagihan($id_p,'Tagihan');
				$wt='danger';
				$warna='#ff0000';
			}
			
			 ?>

	<!---->
	<div class="col-sm-6 col-md-7">
	 <table class="table table-striped table-hover table-condensed table-responsive table-bordered" >

	<tr>
		<td>
		<?php if($wt=='success'){ }else{?>
		<a class="btn btn-primary btn-xs"  href="<?=base_url('C_resepsionis/s_deposit/'.$id_p)?>" ><span class="glyphicon glyphicon-plus"> Tambah</span></a>
		<?php } 
		?>
		</td>
		<td class="warning">Date</td>
		<td class="warning">No. Nota</td>
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
		<td><?=$dep->nota?></td>
		<td> <p align="right"><?=number_format($dep->transfer,0,',','.')?>
			<?php if(empty($dep->transfer) AND $dep->transfer != 0 OR !empty($dep->cas)){ ?>
		<?php }else{ 
		 if($wt=='success'){ }else{?>
		
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
	
		<?php } ?>
			
	<?php	} ?>
			</p>
		</td>
	</tr>
<?php	} ?>
	
	
	
	</table>
</div>
	<div class="col-sm-6 col-md-5">
	 <table class="table table-striped table-hover table-condensed table-responsive table-bordered" >
	<tr>
		<td class="success" >Amount</td>
		<td align="right"  colspan="2"><?=number_format($p,0,',','.')?></td>
	</tr>
	<tr>
		<td class="success" >Disc.  Member 
		<?php if($noedit!='ya'){ ?> 
		<span class="pull-right"><a href="<?=base_url('C_resepsionis/gift/'.$hrf.'/'.$id_p)?>"><span class="glyphicon glyphicon-<?=$span?>"></span> <?=$active?></a>   </span>
		<?php } ?>
		</td>
		<td align="right"  colspan="2"><?=number_format($disc,0,',','.')?></td>
	</tr>
	<!--<tr>
		<td class="success" >Temporary Payment </td>
		<td  align="right"><?=number_format($payment,0,',','.')?> </td>
	</tr>-->
	<tr>
		<td class="success" >Deposit</td>
		<td align="right"  colspan="2" >
			
			<?=number_format($totd,0,',','.')?>
		</td>
	</tr>
	<tr>
	
		<td class="warning" >Refund  
		<?php if($wt=='success'){ }else{?>
		
		<?php } ?>
		</td>
		<td  align="right" colspan="2"  bgcolor="<?=$warna?>">
		<?php
		//revisi masterpra:
		//setelah dilunasi, tidak boleh 0 (nol), harus bernilai positif sesuai jumlah pelunasan
		if ($totalall > 0){
		///echo number_format($this->Mhotel->total_payment_lunas($id_p),0,',','.'); //rev pra
		echo '+'.number_format($totalall,0,',','.'); ////rev ilham  : bila lebih munculkan yang lebihnya pake (+)
		
		}elseif($totalall ==0){
			$getpelunasan=$this->Mhotel->total_payment_lunas_ilham($id_p);
		echo number_format($getpelunasan,0,',','.');	
		}
		else{ 
		echo  number_format($totalall,0,',','.');
		}
		?>  

		</td>
		
	</tr>
	<?php 
	/////////////REFUND
	if ($totalall > 0){  ?>
	
	 <?php } ?>
	 
	</table>
</div>
</div>
	<!--lpaoran keuangan kamar // room-->
<div class="row">

  <div class="col-sm-6 col-md-7">
  <!---->
 
<table class="table table-striped table-hover table-condensed table-responsive table-bordered" style="font-size: 90%" width="100%">
	<tr class="success">
		<td align="center" colspan="9">Room, Bed, & OT</td>
	</tr>
	<tr class="warning">
		<td width="15%">Date</td>
		<td width="15%">Room.no</td>
		<td >Bed / day</td>
		<td >OT / hours</td>
		<td>DISC</td>
		<td>Early</td>
		<td>Amount</td>
		<td>Balance</td>
		<?php if($noedit!='ya'){ ?> 
		<td  width="16%">Menu</td>
<?php } ?>

	</tr>
	<?php
	$tot=0;
	foreach($hget->result() as $hh){ 
	//$amm = $this->db->get_where('tbl_pesan_kamar',array('id'=>$hh->id_k));
	//$am = $this->db->get_where('tbl_kamar',array('id_kamar'=>$hh->id_k))->row();
	$am = $this->Mhotel->cek_bill_kamar($hh->id_k)->row();
	if($hh->ot<4){
		$ot=$am->ot;
	}else{
		$ot=$am->ot2;
	}
	?>
		<tr style="font-size: 85%">
		
		<td ><?=$hh->tanggal?></td>
		<td><?=$hh->id_k?>
			<?php 
		$dk=$hh->delkam;
		if($dk=='ya'){
			$hrgakam=0;
			$saa='remove';
			echo $lia='';
		}else{
			$hrgakam=$am->harga;
			echo $lia=' ('.number_format($am->harga,0,',','.').')';
			$saa='ok';
		}
		?>
		</td>
		<!--BED-->
		<td>
		<?=!empty($hh->bed) ?  $hh->bed .'.( '.number_format(60000,0,',','.').' )':''?>
		<?php if(empty($hh->bed)){ ?>
		 
	<?php	} ?>
		
  		
  		</td>
		<!--OT-->
		<td>
		<?=!empty($hh->ot) ?  $hh->ot.'.( '.$ot.' )' :''?>
		<?php if(empty($hh->ot)){ ?>
		
	 <?php } ?>	
  		
  		</td>
		<!--DISC-->
		<td align="right">
		<?php 
		$dtot=$hrgakam;;
		$disc=($hh->disc*$dtot)/100;
		if($disc>0){
			echo number_format($disc,0,',','.');
		}
		
		?>
		</td>
			<!--EARLY CHECK IN-->
			<td align="right">
		<?php 
		$h_kam=$hrgakam;
		if($hh->early == 1){
			//$has_early=$h_kam+$bg_kam;
			$bg_kam=($h_kam/2);
		echo number_format($bg_kam,0,',','.');	
		}else{
			$bg_kam=0;
			echo '';
		}
		
		?>
			</td>
			<!--AMOUNT & BALANCE-->		
			<td align="right">
			<?php 
			$hrgakamdahdisc=$hrgakam-$disc;
			$tot=$tot+$hh->harga_bed+$hh->harga_ot+$bg_kam+$hrgakamdahdisc; //harga bed//harga ot//harga Early///harga kamar 
			//echo number_format($hrgakam,0,',','.');
			
			echo number_format(($hrgakamdahdisc+$hh->harga_bed+$hh->harga_ot+$bg_kam),0,',','.');
			?>
			
		</td>

		<!--penjumlahan ber.ulang-->
		<td  align="right"><?=number_format($tot,0,',','.');?></td>
		<!--Menu-->
	
<!--END-->
		</tr>
<?php	 } ?>
	
	
  </table>
  </div>
  <div class="col-sm-6 col-md-5">
 
  <table class="table table-striped table-hover table-condensed table-responsive table-bordered" style="font-size: 87%" width="100%" >
  <?php 
  if($totdll > $p_kamar){
  	//$this->Mhotel->simpanperbahantipe();
  }
  $totdll
  ?>
	<tr class="success">
		<td align="center" colspan="5">Food, Beverage, Laundry, & Etc</td>
	</tr>
	<tr class="warning">
		<td>Date</td>
		<td>Note.no</td>
		<td>Amount</td>
		<td>Balance</td>
		<?php if($noedit!='ya'){ ?> 
		<td  width="16%">Menu</td>
<?php } ?>
	</tr>
	<?php $tott=0;	foreach($h1->result() as $hh1){ ?>
	           <tr>
		<td ><?php echo $hh1->tanggal?></td>
		<td><?=$hh1->nota?></td>
		<td  align="right"><?=number_format($hh1->harga,0,',','.');
		$tott=$tott+$hh1->harga;
		?></td>
		<td  align="right"><?=number_format($tott,0,',','.');?></td>
		<?php if($noedit!='ya'){ ?> 
		<td ><button type="button" class="btn btn-info btn-xs"data-toggle="modal" data-target="#myfbl<?=$hh1->id?>">
  <span class="glyphicon glyphicon-pencil"></span>  
  </button> <a type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Anda Yakin?')" href="<?=base_url('C_resepsionis/hapus_tagihan/'.$hh1->id.'/'.$id_p)?>" >
 <span class="glyphicon glyphicon-remove"></span> 
  </a>
			<!--MODAL EDIT YTAGIHAN-->
			
		</td>
<?php }else{ ?> 
<?php } ?>
	</tr>
<?php	}?>
	
	
  </table>
  </div>
  </div>

  </div>	
  </div>

 
</div>

      
    </div>