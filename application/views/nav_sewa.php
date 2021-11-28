   <div class="navmenu navmenu-default navmenu-fixed-left offcanvas-sm">
     <a class="navmenu-brand visible-md visible-lg" href="#">
               <img  src="<?=base_url()?>images/<?=$logo?>.png" class="img-thumbnail"  width="350">  <b><!--<?=$namapt?>--></b>
              	</a>
    <!--  <a class="navmenu-brand visible-md visible-lg" href="#">Project name</a>-->
    <hr/>
    <ul class="nav  nav-pills nav-stacked">
    <li><a href="<?=base_url()?>C_sewa/profil"><span class="pull-right"></span><b>PROFIL</b> <span class="pull-right"><img src="<?=base_url()?>icon/right.gif" alt="10" /></span></a></li>
    <li class="<?=$a?>"><a href="<?=base_url()?>C_sewa/"><span class="pull-right"></span><b>BERANDA</b><span class="pull-right"><img src="<?=base_url()?>icon/right.gif" alt="10" /></span></a></li>
    <li><a href="<?=base_url()?>C_sewa/laporan"><span class="pull-right"></span><b>INFO</b><span class="pull-right"><img src="<?=base_url()?>icon/right.gif" alt="10" /></span></a> </li>
    <li><a data-toggle="modal" data-target="#myModal" href="#"><span class="pull-right"></span><b>PESAN</b><span class="pull-right"><img src="<?=base_url()?>icon/comment.gif" alt="10" /></span></a> </li>
    <li><?=anchor('login/logout','<b>KELUAR</b>',array("onclick"=>"return confirm('Anda Yakin akan KELUAR ?')"))?></li>
    </ul>
    		
    </div>
    <div class="navbar navbar-default navbar-fixed-top hidden-md hidden-lg" style="background-color: #b7b6be">
      <button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target=".navmenu">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" class="tbl tbl-info" href="#">
                <img  src="<?=base_url()?>images/<?=$logo?>.png" class="img-rounded"  width="29">  <?=$namapt?>
              	</a>
   <!--   <a class="navbar-brand" class="tbl tbl-info" href="#">Project name</a>-->
    </div>
   <div class="alert alert-md"  id="header" style="background-color: #b7b6be" >
<p><span class="pull-lift" style="font-size: 20px"><?=$nama_app?></span><span class="pull-right muted">Selamat Datang Admin [ <?=$this->session->userdata('username')?> ]</span></p>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">PESAN</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary">KIRIM</button>
      </div>
    </div>
  </div>
</div>
        