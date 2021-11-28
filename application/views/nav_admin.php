   <div class="navmenu navmenu-default navmenu-fixed-left offcanvas-sm" style="background-color: ##b7b6be">
      <a class="navmenu-brand visible-md visible-lg" style="padding-bottom: 0px; padding-left: 50px"  href="#" >
                <img  src="<?=base_url()?>images/<?=$logo?>.png" class="img-thumbnail"  width="200">  <b><!--<?=$namapt?>--></b>
              	</a>
    <!--  <a class="navmenu-brand visible-md visible-lg" href="#">Project name</a>-->
      <!--<ul class="nav navmenu-nav">-->
      <ul class="nav  nav-pills nav-stacked">
      <?php if ($this->session->userdata('wewenang') == 'admin' ){ ?>
  <li class="<?=$a?>"><a href="<?=base_url()?>C_admin"><span class="pull-right"></span> <b>Laporan Shifs</b><span class="pull-right"> <span class="glyphicon glyphicon-chevron-right"></span></span></a> </li>
  
  <?php }else{ ?> 
  <li class="<?=$a?>"><a href="<?=base_url()?>C_resepsionis/lap_shifs"><span class="pull-right"></span> <b>GUEST BILL</b><span class="pull-right"> <span class="glyphicon glyphicon-home"></span></span></a> </li>	
  <?php } ?>
      <?php if($nav=='active'){ ?>
  <li class="<?=$b?>"><a href="<?=base_url()?>C_admin/rinci_pendapatan/<?=$id_user?>/1/<?=$id_tgl?>/<?=$shift?>"><span class="pull-right"></span> <b>Laporan Pendapatan</b><span class="pull-right"> <span class="glyphicon glyphicon-chevron-right"></span> </span></a> </li>	
  <?php if ($this->session->userdata('login') == FALSE ){ ?>
  <li class="<?=$e?>"><a href="<?=base_url()?>C_admin/cek_boking/<?=$id_user?>/<?=$id_tgl?>/<?=$shift?>"><span class="pull-right"></span> <b>Guest Boking</b><span class="pull-right"> <span class="glyphicon glyphicon-chevron-right"></span> </span></a></li>
  <?php } ?>
  	<li class="<?=$c?>"><a href="<?=base_url()?>C_admin/rinci_pengeluaran/<?=$id_user?>/<?=$id_tgl?>/<?=$shift?>"><span class="pull-right"></span> <b>Laporan Pengeluaran</b><span class="pull-right"> <span class="glyphicon glyphicon-chevron-right"></span></span></a> </li>	
  <?php }else{ ?>
  	
   <?php } ?>
        
     <!--   <li class="<?=$c?>"><a href="<?=base_url()?>C_resepsionis/bill_kam"><b>CEK BILL</b><span class="pull-right"><img src="<?=base_url()?>icon/right.gif" alt="10" /></span></a></li>-->
        <!--<li class="<?=$d?>"><a href="<?=base_url()?>C_resepsionis/tagihan"><b>INPUT TAGIHAN</b><span class="pull-right"><img src="<?=base_url()?>icon/right.gif" alt="10" /></span></a></li>-->
        <?php if ($this->session->userdata('wewenang') == 'admin' ){ ?>
        <li class="<?=$f?>"><a href="<?=base_url()?>C_admin/pass"><span class="pull-right"></span> <b>Pengaturan User</b><span class="pull-right"> <span class="glyphicon glyphicon-chevron-right"></span></span></a> </li>
  <li class="<?=$g?>"><a href="<?=base_url()?>C_admin/p_kamar"><span class="pull-right"></span> <b>Pengaturan Kamar</b><span class="pull-right"> <span class="glyphicon glyphicon-chevron-right"></span></span></a> </li>
    <li class="<?=$h?>"><a href="<?=base_url()?>C_admin/rekap_nota"><span class="pull-right"></span> <b>Rekap Nota</b><span class="pull-right"> <span class="glyphicon glyphicon-chevron-right"></span></span></a> </li>
    <li class="<?=empty($Search)?'':$Search?>"> <a href="<?=base_url()?>C_search/"><b>Search Nota </b><span class="pull-right"> <span class="glyphicon glyphicon-chevron-right"></span></span></a></li>	
   <li><a href="<?=base_url()?>C_resepsionis/cek_kam"><span class="pull-right"></span> <b>GUEST BILL</b><span class="pull-right"> <span class="glyphicon glyphicon glyphicon-list-alt"></span></span></a> </li>	
        
        <br/>
        <li><?=anchor('login/logoutadmin','<b>KELUAR</b>',array("onclick"=>"return confirm('Anda Yakin akan KELUAR !')"))?></li>
        <?php }else{
			?>
			<li  ><?=anchor('login/logout','<b>KELUAR</b>',array("onclick"=>"return confirm('Anda Yakin akan KELUAR !')"))?></li>
		<?php } ?>
        <!--<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
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
<p><span class="pull-lift" style="font-size: 20px"><?=$nama_app?></span><span class="pull-right muted">Selamat Datang Admin <b>[ <?=$this->session->userdata('username')?> ]</b></span></p>
</div>