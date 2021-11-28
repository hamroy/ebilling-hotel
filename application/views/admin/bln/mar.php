<div class="container">
<!--   <div class="alert alert-success alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Warning!</strong> Better check yourself, you're not looking too good.
</div>-->

     <div class="page-header" >
        <table class="table table-striped table-hover table-condensed table-responsive table-bordered" >
	<tr>
		<td class="warning" rowspan="2" align="center"><b>Tanggal</b></td>
		<td class="warning" align="center" colspan="4"><b>Shifs</b></td>
		
	</tr>
	<tr>
		
		<td class="warning">Pagi</td>
		<td class="warning" >Siang</td>
		<td class="warning">Malam</td>
	</tr>
	<?php
	//$q=$this->Madmin->lap_shifs();
	//$jumHari = cal_days_in_month(CAL_GREGORIAN, 12, date('Y'));
	$blnnow=3;
	$blnnowid='Maret';
	///
	//=========================================================================================================================================
	// copy awal
	$Pagi='Pagi';
	$Siang='Siang';
	$Malam='Malam';
	///
	$jumHari = cal_days_in_month(CAL_GREGORIAN, $blnnow, $thn);
	for($q=1;$q<=$jumHari;$q++){
		
		$cektglpagi=$this->Madmin->cektglmodel('pagi',$q,$blnnow,$thn);
		$cektglsiang=$this->Madmin->cektglmodel('siang',$q,$blnnow,$thn);
		$cektglmalam=$this->Madmin->cektglmodel('Malam',$q,$blnnow,$thn);
		
		if($cektglpagi==TRUE){ ///cek laporan sift

		$id_usserpagis=$this->Madmin->gettgl('pagi',$q,$blnnow,$thn)->row()->id_user;
		$id_tglp=$this->Madmin->gettgl('pagi',$q,$blnnow,$thn)->row()->sort; ////rev pake filter tanggal dan shift ; 29/1/17
		
		if($this->Madmin->getusename($id_usserpagis)->num_rows() > 0){
$id_usserpagi=$this->Madmin->getusename($id_usserpagis)->row()->username; ////merubah id jadi usernamae
		}else{
			$id_usserpagi='';
		}
		//
		if($this->session->userdata('wewenang')=='admin'){
			$modalpagi= '<a href="'.base_url('C_admin/rinci_pendapatan/'.$id_usserpagis.'/1/'.$id_tglp.'/'.$Pagi).'"><span class="pull-right"></span> '.$id_usserpagi.'</a>';
		}else{
$modalpagi='<a data-toggle="modal" data-target="#myModal'.$id_usserpagis.''.$Pagi.''.$id_tglp.'" href="" >'.$id_usserpagi.'</a>
<!-- Modal -->
<div class="modal fade" id="myModal'.$id_usserpagis.''.$Pagi.''.$id_tglp.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">KONFIRMASI</h4>
      </div>
      <div class="modal-body">
        <form action='.base_url().'C_resepsionis/cek_id_ship/'.$id_usserpagis.'/'.$id_tglp.'/'.$Pagi.' method="post">
      <div class="form-group">
        <input type="password" class="form-control" placeholder="Masukkan password anda" name="pass" autofacus>
        </div>
        <input type="submit" class="btn btn-primary btn-lg btn-block " value="Lanjut" />
        
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
      </div>
    </div>
  </div>
</div>


			'; ////cas non cas
		}
		
		//	
		}else{
			$id_usserpagi='-';
			$modalpagi='';
		}
		if($cektglsiang==TRUE){
		$id_ussersiangs=$this->Madmin->gettgl('siang',$q,$blnnow,$thn)->row()->id_user;	
		$id_tgls=$this->Madmin->gettgl('siang',$q,$blnnow,$thn)->row()->sort; 
		if($this->Madmin->getusename($id_ussersiangs)->num_rows() > 0){
$id_ussersiang=$this->Madmin->getusename($id_ussersiangs)->row()->username;
		}else{
			$id_ussersiang='';
		}
		
			//
			if($this->session->userdata('wewenang')=='admin'){
			$modalsiang= '<a href="'.base_url('C_admin/rinci_pendapatan/'.$id_ussersiangs.'/1/'.$id_tgls.'/'.$Siang).'"><span class="pull-right"></span> '.$id_ussersiang.'</a>';
		}else{
			$modalsiang='<a data-toggle="modal" data-target="#myModal'.$id_ussersiangs.''.$Siang.''.$id_tgls.'" href="" >'.$id_ussersiang.'</a>
<!-- Modal -->
<div class="modal fade" id="myModal'.$id_ussersiangs.''.$Siang.''.$id_tgls.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">KONFIRMASI</h4>
      </div>
      <div class="modal-body">
        <form action='.base_url().'C_resepsionis/cek_id_ship/'.$id_ussersiangs.'/'.$id_tgls.'/'.$Siang.' method="post">
      <div class="form-group">
        <input type="password" class="form-control" placeholder="Masukkan password anda" name="pass" autofacus>
        </div>
        <input type="submit" class="btn btn-primary btn-lg btn-block " value="Lanjut" />
        
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
      </div>
    </div>
  </div>
</div>


			';
		//
		}
		
		}else{
			$modalsiang='';
			$id_ussersiang='-';
		}
		if($cektglmalam==TRUE){
		
		$id_ussermalams=$this->Madmin->gettgl('Malam',$q,$blnnow,$thn)->row()->id_user;
		
		$id_tglm=$this->Madmin->gettgl('Malam',$q,$blnnow,$thn)->row()->sort; 	
		if($this->Madmin->getusename($id_ussermalams)->num_rows() > 0){
$id_ussermalam=$this->Madmin->getusename($id_ussermalams)->row()->username;
		}else{
$id_ussermalam='';
		}
		
			//

		if($this->session->userdata('wewenang')=='admin'){
				$modalmalam= '<a href="'.base_url('C_admin/rinci_pendapatan/'.$id_ussermalams.'/1'.'/'.$id_tglm.'/'.$Malam).'"><span class="pull-right"></span> '.$id_ussermalam.'</a>';
		}else{
		$modalmalam='<a data-toggle="modal" data-target="#myModal'.$id_ussermalams.''.$Malam.''.$id_tglm.'" href="" >'.$id_ussermalam.'</a>
<!-- Modal -->
<div class="modal fade" id="myModal'.$id_ussermalams.''.$Malam.''.$id_tglm.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">KONFIRMASI</h4>
      </div>
      <div class="modal-body">
        <form action='.base_url().'C_resepsionis/cek_id_ship/'.$id_ussermalams.'/'.$id_tglm.'/'.$Malam.' method="post">
      <div class="form-group">
        <input type="password" class="form-control" placeholder="Masukkan password anda" name="pass" autofacus>
        </div>
        <input type="submit" class="btn btn-primary btn-lg btn-block " value="Lanjut" />
        
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
      </div>
    </div>
  </div>
</div>


			'. '';
		//	
		}
		
		}else{
			$id_ussermalam='-';
			$modalmalam='';
		}
		///////////////
		
	 ?>
	<tr>
	
	<?php 
	
	
	
	
	?>
		<td width="14%"><?=$q.' '. $blnnowid.' '.$thn?></td>
		<td><?php 

		echo $modalpagi;
		
		?></td>
		<td><?php 
		echo $modalsiang;
		?></td>
		<td><?php 
		echo $modalmalam;
		?></td>
	</tr>	
	<?php } 
	
	// copy akhir///===============================
 
	?>
	
	
	</table>
      </div>
      
    </div><!-- /.container -->