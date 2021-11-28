<div class="container"  style="background-color: #dddde1">
<!--   <div class="alert alert-success alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Warning!</strong> Better check yourself, you're not looking too good.
</div>-->

   
      <div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading">  <div class="page-header" >
        <h3>DAFTAR TUNGGAKAN KAMAR</h3>
      </div></div>
  <!-- Table -->
  <div class="table-responsive" >
  <form method="post" id="form1"> 
	 <table class="table table-striped table-hover table-condensed table-responsive table-bordered" >
	<tr>
		<th>No</th>
		<th>Nama Tamu</th>
		<th>Status</th>
		
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
		$v='<a data-toggle="modal" href="'.base_url().'C_resepsionis/cek_id/'.$qq->id_p.'" >'.$nama.'</a>';
		
		if(!empty($qq->status)){
			if($qq->status == 'Tunggakan'){
			$war='danger';
			}else{
			$war='success';		
			}
			
		$st = $qq->status	;
		}else{
		$war='';
		$st = '';
		}
		
		 ?>
	
	<tr>
		<td><?=$no++?></td>
		<td><?=$v?></td>
		<td class="<?=$war?>"><?=$st?></td>
	</tr>
	
	<?php }
	
	 ?>
	 
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
