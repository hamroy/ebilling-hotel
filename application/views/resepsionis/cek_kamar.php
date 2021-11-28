<div class="container"  style="background-color: #dddde1">
<!--   <div class="alert alert-success alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Warning!</strong> Better check yourself, you're not looking too good.
</div>-->

   
      <div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading">  <div class="page-header" >
        <h3>DAFTAR KAMAR HOTEL</h3>
      </div></div>
  <!-- Table -->
  <div class="table-responsive" >
  <form method="post" id="form1"> 
	 <table class="table table-striped table-hover table-condensed table-responsive table-bordered" >
	<tr>
		<th>No. Kamar</th>
		<th>Jenis Kamar</th>
		<!--<th>No Kamar</th>-->
		<th>Nama Tamu</th>
		<th>Status</th>
		<th>Menu</th>
		<th> Pilih </th>
		
	</tr>
	<?php 
	$no=1;
	foreach($q->result() as $qq){
	//	$k=$this->db->get_where('tbl_pesan_kamar',array('id_k'=>$qq->id_kamar))->row();
	//	$var = explode ("_",$k->id_k);
		//
		$nm=$this->db->get_where('tbl_pesan_kamar',array('id'=>$qq->id_p))->row();
		$nama=! empty ($nm->nama) ? $nm->nama : 'kosong';
		$id_p=! empty ($qq->id_p) ? $qq->id_p : '0';
		
		//
		if($qq->cek=='terisi'){
			
			$w='danger';
			$v='<a data-toggle="modal" href="'.base_url().'C_resepsionis/cek_id/'.$qq->id_p.'" >'.$nama.'</a>
	<!--<button class="btn btn-link" data-toggle="modal" data-target="#myModala'.$qq->id_p.'">
 '.$nama.'
</button>	-->		
<!-- Modal -->
<!--<div class="modal" id="myModala'.$qq->id_p.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">KONFIRMASI</h4>
      </div>
      <div class="modal-body">
        
        <form action='.base_url().'C_resepsionis/cek_id/'.$qq->id_p.' method="post">
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
</div>-->


			';
		}else{
			$w='difault';
			$v='';
		}
		
		////
		if(!empty($nm->status)){
			if($nm->status == 'Tagihan'){
			$war='danger';
			}else{
			$war='success';		
			}
			
		$st = $nm->status	;
		}else{
		$war='';
		$st = '';
		}
		
		 ?>
	
	<tr>
		<td><?=$qq->id_kamar?></td>
		<td><?=$qq->jenis_kamar?></td>
		<!--<td></td>-->
		<td class="<?=$w?>"><?=$v?></td>
		<td class="<?=$war?>"><?=$st?></td>
		<td width="17%">
			
		
	
	<?php
	if($war=='danger'){ 
	?>
		
			<a class="btn btn-xs btn-primary" onclick="return confirm(' Anda Yakin akan Akan mengcekout  Kamar  Tamu ini  !!!')" href="<?=base_url('C_resepsionis/cekout/'.$qq->id_kamar.'/'.$qq->id_p)?>">Check out</a>
			<a class="btn btn-xs btn-danger" onclick="return confirm(' Anda Yakin !!!')" href="<?=base_url('C_resepsionis/tunggkan/'.$qq->id_kamar.'/'.$qq->id_p)?>">Tunggakan</a>
			
	
	<?php
	}else{
		?>
	<a class="btn btn-xs btn-primary" onclick="return confirm(' Anda Yakin akan Akan mengcekout  Kamar  Tamu ini  !!!')" href="<?=base_url('C_resepsionis/cekout/'.$qq->id_kamar.'/'.$qq->id_p)?>">Check out</a>
	<a class="btn btn-xs btn-danger" onclick="return confirm(' Anda Yakin !!!')" href="<?=base_url('C_resepsionis/tunggkan/'.$qq->id_kamar.'/'.$qq->id_p)?>">Tunggakan</a>
<?php	}
	
	?>
		 
		</td>
		
		<td>
			<input class="btn btn-link" type="checkbox" name="<?=$qq->id_kamar?>"/>
		</td>	
		
	</tr>
	
	<?php }
	
	 ?>
	 <tr>
	 	<td colspan="4">
	 		
	 	</td>
	 	<td colspan="2">
	 	 <input type="submit" class="btn btn-warning btn-block" onclick="submitForm('<?=base_url('C_resepsionis/cekoutbeberapa')?>')" value="Chekout" title="Pilih . kamar salah satu"/>
	 	</td>
	 </tr>
  </table>
  </form>
  </div>
</div>

    </div><!-- /.container -->
    
<script type="text/javascript">
    function submitForm(action)
    {
        document.getElementById('form1').action = action;
        document.getElementById('form1').submit();
    }
</script>
<script type="text/javascript">
$('#myModal').modal('hide')
</script>

<?php
if($this->session->userdata('sip')){
	
}else{
	redirect('Login/logout_paksa');
}

?>