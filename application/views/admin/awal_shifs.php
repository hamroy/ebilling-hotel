<div class="container">
<!--   <div class="alert alert-success alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Warning!</strong> Better check yourself, you're not looking too good.
</div>-->

     <div class="page-header" >
     <div class="well well-sm" >
     <div class="row">
     <?php
     $thnkurang=$thn-1;
     $thnplus=$thn+1;
     
     ?>
  <div class="col-md-12" align="center"><span class="pull-left"><a href="<?=base_url($con.'/lap_shifs/'.$thnkurang)?>"><span class="glyphicon glyphicon-chevron-left"></span></a></span>Tahun <?=$thn?> <span class="pull-right"><a href="<?=base_url($con.'/lap_shifs/'.$thnplus)?>"><span class="glyphicon glyphicon-chevron-right"></span></a></span></div>
</div>
</div>
     <!-- Nav tabs -->
<ul class="nav nav-tabs">
  <li <?php if(date('n')==1){echo ' class="active"';}?>><a href="#bulan1" data-toggle="tab">Januari</a></li>
  <li <?php if(date('n')==2){echo ' class="active"';}?>><a href="#bulan2" data-toggle="tab">Februari</a></li>
  <li <?php if(date('n')==3){echo ' class="active"';}?>><a href="#bulan3" data-toggle="tab">Maret </a></li>
  <li <?php if(date('n')==4){echo ' class="active"';}?>><a href="#bulan4" data-toggle="tab">April</a></li>
  <li <?php if(date('n')==5){echo ' class="active"';}?>><a href="#bulan5" data-toggle="tab">Mei </a></li>
  <li <?php if(date('n')==6){echo ' class="active"';}?>><a href="#bulan6" data-toggle="tab">Juni </a></li>
  <li <?php if(date('n')==7){echo ' class="active"';}?>><a href="#bulan7" data-toggle="tab">Juli </a></li>
  <li <?php if(date('n')==8){echo ' class="active"';}?>><a href="#bulan8" data-toggle="tab">Agustus </a></li>
  <li <?php if(date('n')==9){echo ' class="active"';}?>><a href="#bulan9" data-toggle="tab">September </a></li>
  <li <?php if(date('n')==10){echo ' class="active"';}?>><a href="#bulan10" data-toggle="tab">Oktober </a></li>
  <li <?php if(date('n')==11){echo ' class="active"';}?>><a href="#bulan11" data-toggle="tab">November </a></li>
  <li <?php if(date('n')==12){echo ' class="active"';}?>><a href="#bulan12" data-toggle="tab">Desembers </a></li>
</ul>


<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane <?php if(date('n')==1){echo 'active ';}?>" id="bulan1"><?php $this->load->view('admin/bln/jan')?></div>
  <div class="tab-pane <?php if(date('n')==2){echo 'active ';}?>" id="bulan2"><?php $this->load->view('admin/bln/feb')?></div>
  <div class="tab-pane <?php if(date('n')==3){echo 'active ';}?>" id="bulan3"><?php $this->load->view('admin/bln/mar')?></div>
  <div class="tab-pane <?php if(date('n')==4){echo 'active ';}?>" id="bulan4"><?php $this->load->view('admin/bln/apr')?></div>
  <div class="tab-pane <?php if(date('n')==5){echo 'active ';}?>" id="bulan5"><?php $this->load->view('admin/bln/mei')?></div>
  <div class="tab-pane <?php if(date('n')==6){echo 'active ';}?>" id="bulan6"><?php $this->load->view('admin/bln/jun')?></div>
  <div class="tab-pane <?php if(date('n')==7){echo 'active ';}?>" id="bulan7"><?php $this->load->view('admin/bln/jul')?></div>
  <div class="tab-pane <?php if(date('n')==8){echo 'active ';}?>" id="bulan8"><?php $this->load->view('admin/bln/aug')?></div>
  <div class="tab-pane <?php if(date('n')==9){echo 'active ';}?>" id="bulan9"><?php $this->load->view('admin/bln/sep')?></div>
  <div class="tab-pane <?php if(date('n')==10){echo 'active ';}?>" id="bulan10"><?php $this->load->view('admin/bln/okt')?></div>
  <div class="tab-pane <?php if(date('n')==11){echo 'active ';}?>" id="bulan11"><?php $this->load->view('admin/bln/nov')?></div>
  <div class="tab-pane <?php if(date('n')==12){echo 'active ';}?>" id="bulan12"><?php $this->load->view('admin/bln/des')?></div>
</div>
      </div>
      
    </div><!-- /.container -->