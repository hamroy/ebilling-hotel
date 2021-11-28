   <div class="navmenu navmenu-default navmenu-fixed-left offcanvas-sm" style="background-color: ##b7b6be">
     <a class="navmenu-brand visible-md visible-lg" style="padding-bottom: 0px; padding-left: 50px"  href="<?=base_url()?>C_resepsionis/cek_kam" >
                <img  src="<?=base_url()?>images/<?=$logo?>.png" class="img-thumbnail"  width="200">  <b><!--<?=$namapt?>--></b>
              	</a>
    <!--  <a class="navmenu-brand visible-md visible-lg" href="#">Project name</a>-->
      <!--<ul class="nav navmenu-nav">-->
      <ul class="nav  nav-pills nav-stacked">
     <!-- <li  class="dropdown <?=$aa?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Rooms Iformation</b> <span class="pull-right"> <span class="glyphicon glyphicon-chevron-down"></span> <!--<img src="<?=base_url()?>icon/right.gif" alt="10" />--</span></a>
          <ul class="dropdown-menu navmenu-nav nav-pills nav-stacked">
            <li   class="<?=$a?>"><a href="<?=base_url()?>C_resepsionis/cek_kam"><span class="pull-right"></span> <b>Rooms</b><span class="pull-right"> <span class="glyphicon glyphicon-chevron-right"></span> <!--<img src="<?=base_url()?>icon/right.gif" alt="10" />--</span></a></li>
            <li class="<?=$a1?>"><a href="<?=base_url()?>C_resepsionis/cek_boking"><span class="pull-right"></span> <b>Guest Boking</b><span class="pull-right"> <span class="glyphicon glyphicon-chevron-right"></span> <!--<img src="<?=base_url()?>icon/right.gif" alt="10" />--</span></a></li>
            
          </ul>
        </li>-->
     
     <!--TAMBAHAN MENU DARI MASTERPRA 16MARET2017-->
       <!--<li class="<?=$p?>"><a href="<?=base_url()?>C_resepsionis/book"><span class="pull-right"></span> <b>Booking</b><span class="pull-right"> <span class="glyphicon glyphicon-chevron-right"></span> <!--<img src="<?=base_url()?>icon/right.gif" alt="10" />--</span></a> </li>-->
     <!--TAMBAHAN MENU DARI MASTERPRA-->
     
     
       <li class="<?=$a?>"><a href="<?=base_url()?>C_resepsionis/cek_kam"><span class="pull-right"></span> <b>Rooms Information</b><span class="pull-right"> <span class="glyphicon glyphicon-chevron-right"></span> <!--<img src="<?=base_url()?>icon/right.gif" alt="10" />--></span></a> </li>
       
        <li class="<?=$b?>"><a href="<?=base_url()?>C_resepsionis/pesan_kam"><b>Input Billing</b><span class="pull-right"> <span class="glyphicon glyphicon-chevron-right"></span> <!--<img src="<?=base_url()?>icon/right.gif" alt="10" />--></span></a></li>
        <li class="<?=$c?>"><a href="<?=base_url()?>C_resepsionis/Deposit_bar"><b>Deposit</b><span class="pull-right"> <span class="glyphicon glyphicon-chevron-right"></span> <!--<img src="<?=base_url()?>icon/right.gif" alt="10" />--></span></a></li>
         <li class="<?=$d?>"> <a href="<?=base_url()?>C_resepsionis/bar"><b>Food & Beverage</b><span class="pull-right"> <span class="glyphicon glyphicon-chevron-right"></span> <!--<img src="<?=base_url()?>icon/right.gif" alt="10" />--></span></a></li>
         <li class="<?=$f?>"> <a href="<?=base_url()?>C_resepsionis/daf_tunggkan"><b>Unpaid Bill</b><span class="pull-right"> <span class="glyphicon glyphicon-chevron-right"></span></span></a></li>
         <li class="<?=$g?>"> <a href="<?=base_url()?>C_resepsionis/simulasi_kam"><b>Invoice </b><span class="pull-right"> <span class="glyphicon glyphicon-chevron-right"></span></span></a></li>
         <li class="<?=empty($Search)?'':$Search?>"> <a href="<?=base_url()?>C_search/"><b>Search Nota </b><span class="pull-right"> <span class="glyphicon glyphicon-chevron-right"></span></span></a></li>
         <!---->
         <?php if ($this->session->userdata('wewenang') == 'admin' ){ ?>
         <li class="<?=$e?>"><a href="<?=base_url()?>C_admin"><span class="pull-right"></span> <b>Beranda Admin</b><span class="pull-right"> <span class="glyphicon glyphicon-home"></span> <!--<img src="<?=base_url()?>icon/right.gif" alt="10" />--></span></a> </li>	
           <li><?=anchor('login/logoutadmin','<b>Logout</b>',array("onclick"=>"return confirm('Anda Yakin akan KELUAR !')"))?></li>
         <?php }else{ ?>
          <li class="<?=$e?>"><a href="<?=base_url()?>C_resepsionis/lap_shifs"><span class="pull-right"></span> <b>Laporan Shift RCP</b><span class="pull-right"> <span class="glyphicon glyphicon-chevron-right"></span> <!--<img src="<?=base_url()?>icon/right.gif" alt="10" />--></span></a> </li>	
         <li  ><?=anchor('login/logout','<b>Logout</b>',array("onclick"=>"return confirm('Anda Yakin akan KELUAR !')"))?></li>
         <?php } ?>
        
         <!---->
     <!--   <li class="<?=$c?>"><a href="<?=base_url()?>C_resepsionis/bill_kam"><b>CEK BILL</b><span class="pull-right"><img src="<?=base_url()?>icon/right.gif" alt="10" /></span></a></li>-->
        <!--<li class="<?=$d?>"><a href="<?=base_url()?>C_resepsionis/tagihan"><b>INPUT TAGIHAN</b><span class="pull-right"><img src="<?=base_url()?>icon/right.gif" alt="10" /></span></a></li>--><br/>
        
        <!--<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Input Data</b> <b class="caret"></b></a>
          <ul class="dropdown-menu navmenu-nav">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li class="dropdown-header">Nav header</li>
            <li><a href="#">Separated link</a></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>-->
      </ul>
      
    </div>
    <div class="navbar navbar-default navbar-fixed-top hidden-md hidden-lg" style="background-color: #b7b6be">
      <button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target=".navmenu">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" class="tbl tbl-info" href="#">
             <p>   <img  src="<?=base_url()?>images/<?=$logo?>.png"  width="50">  <?=$namapt?></p>
              	</a>
   <!--   <a class="navbar-brand" class="tbl tbl-info" href="#">Project name</a>-->
    </div>
   <div class="alert alert-md"  id="header" style="background-color: #b7b6be" >
<p><span class="pull-lift" style="font-size: 20px"><?=$nama_app?></span><span class="pull-right muted">Selamat Datang Resepsionis [<b> <?=$this->session->userdata('username')?></b> ]</span></p>
</div>



<?php
////////engofline kan
 $q = $this->Login_model->get_id_pass($this->session->userdata('username'), $this->session->userdata('password'));
	if($q->row()->status=='ofline'){
//$this->Madmin->merubah_ofline();
$this->session->sess_destroy();
	}
//$this->Madmin->merubah_ofline();
//$this->session->sess_destroy();
 ?>
 <?php
////////engofline kan
 //$q = $this->Login_model->get_id_pass($this->session->userdata('username'), $this->session->userdata('password'));
	if($this->session->userdata('sip')==NULL){
//$this->Madmin->merubah_ofline();
$this->session->sess_destroy();
	}elseif($this->session->userdata('id_tgl')==NULL){
	$this->session->sess_destroy();		
	}else{
		//echo 'normal';
	}
//$this->Madmin->merubah_ofline();
//$this->session->sess_destroy();
 ?>