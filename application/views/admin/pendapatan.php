<div class="container">
<!--   <div class="alert alert-success alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Warning!</strong> Better check yourself, you're not looking too good.
</div>-->
<?php
	/////MEngambil bulan dari tanggal
	
	$ti=substr($id_tgl,'6','2');
	$bi=substr($id_tgl,'4','2');
	$bln=array(
	'01'=>'Januari',
	'02'=>'Februari',
	'03'=>'Maret',
	'04'=>'April',
	'05'=>'Mei',
	'06'=>'Juni',
	'07'=>'Juli',
	'08'=>'Agustus',
	'09'=>'September',
	'10'=>'Oktober',
	11=>'November',
	12=>'Desember',
	);

	$thi= substr($id_tgl,'0','4');
	?>
<div class="well well-sm">Resepsionis  <em><b><?=$this->Madmin->get_user($id_user)->row()->username?></b></em></div>
<div class="well well-sm">Tanggal : <?=$ti.' '.'<b>'.$bln[$bi].'</b>'.' '.$thi?> [ <?=$shift?> ]</div>
<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3><b>PENDAPATAN HOTEL</b></h3></div>
  <div class="panel-body">
<?php 
 	switch($tab){
		case 1:
		$d1='active';
		$d2='';
		$d3='';
		break;
		case 2:
		$d1='';
		$d2='active';
		$d3='';
		break;
		case 3:
		$d1='';
		$d2='';
		$d3='active';
		break;
	}
?>
     <!-- Nav tabs -->
<ul class="nav nav-tabs">
  <li class="<?=$d1?>"><a href="#home" data-toggle="tab">KAMAR</a></li>
  <li class="<?=$d2?>"><a href="#profile" data-toggle="tab">DAPUR</a></li>
  <li class="<?=$d3?>"><a href="#REFUND" data-toggle="tab">REFUND</a></li>
 	<!-- <li><a href="#messages" data-toggle="tab">LAIN-LAIN</a></li>-->
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane <?=$d1?>" id="home"><?php $this->load->view('admin/pendapatan/kamar')?></div>
  <div class="tab-pane <?=$d2?>" id="profile"><?php $this->load->view('admin/pendapatan/dapur')?></div>
  <div class="tab-pane <?=$d3?>" id="REFUND"><?php $this->load->view('admin/pendapatan/refund')?></div>
</div>
  </div>

 
</div>
<!--<div class="well well-sm"><b>TOTAL PENDAPATAN CASH</b></div>
<div class="well well-sm"><b>  Rp : <?=number_format($this->session->userdata('totcas')+$this->session->userdata('totdapcas'),0,',','.')?></b></div>
<div class="well well-sm"><b>TOTAL PENDAPATAN NON CASH</b></div>
<div class="well well-sm"><b>  Rp : <?=number_format($this->session->userdata('totnoncas')+$this->session->userdata('totdapnoncas'),0,',','.')?></b></div>
<div class="well well-sm"><b>TOTAL PENDAPATAN HOTEL</b></div>
<div class="well well-sm"><b>  Rp : <?=number_format($this->session->userdata('tot')+$this->session->userdata('totdap'),0,',','.')?></b></div>-->
  <div class="table-responsive" >  
<table class="table" >
	<tr>
	<td></td>
		<td><b>CASH</b></td>
		<td><b>NON CASH</b></td>
		<td><b>TOTAL</b></td>
	</tr>
	<tr>
		<td><div class="well well-sm"><b> PENDAPATAN KAMAR</b></div></td>
		<td><div class="well well-sm"><b>  Rp : <?=number_format($this->session->userdata('totcas'),0,',','.')?></b></div></td>
		<td><div class="well well-sm"><b>  Rp : <?=number_format($this->session->userdata('totnoncas'),0,',','.')?></b></div></td>
		<td><div class="well well-sm"><b>  Rp : <?=number_format($this->session->userdata('totcas')+$this->session->userdata('totnoncas'),0,',','.')?></b></div></td>
	</tr>
	<tr>
		<td><div class="well well-sm"><b> PENDAPATAN DAPUR</b></div></td>
		<td><div class="well well-sm"><b>  Rp : <?=number_format($this->session->userdata('totdapcas'),0,',','.')?></b></div></td>
		<td><div class="well well-sm"><b>  Rp : <?=number_format($this->session->userdata('totdapnoncas'),0,',','.')?></b></div></td>
		<td><div class="well well-sm"><b>  Rp : <?=number_format($this->session->userdata('totdapnoncas')+$this->session->userdata('totdapcas'),0,',','.')?></b></div></td>
	</tr>
	<tr>
		<td><div class="well well-sm"><b> PENDAPATAN HOTEL</b></div></td>
		<td><div class="well well-sm"><b>  Rp : <?=number_format($this->session->userdata('totcas')+$this->session->userdata('totdapcas'),0,',','.')?></b></div></td>
		<td><div class="well well-sm"><b>  Rp : <?=number_format($this->session->userdata('totnoncas')+$this->session->userdata('totdapnoncas'),0,',','.')?></b></div></td>
		<td><div class="well well-sm"><b>  Rp : <?=number_format($this->session->userdata('totcas')+$this->session->userdata('totdapcas')+$this->session->userdata('totnoncas')+$this->session->userdata('totdapnoncas'),0,',','.')?></b></div></td>
	</tr>
	
</table></div>
     <?=$this->session->userdata('login_shift');?>
      
    </div><!-- /.container -->