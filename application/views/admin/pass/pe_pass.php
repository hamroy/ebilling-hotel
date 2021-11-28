<div class="container">

     
     <h3>PENGATURAN USER</h3><hr/>
     <!-- Nav tabs -->
<ul class="nav nav-tabs">
  <li class="active"><a href="#bulan1" data-toggle="tab">Password Resepsionis</a></li>
  <li ><a href="#bulan2" data-toggle="tab">Ganti password</a></li>
</ul>


<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="bulan1"><?php $this->load->view('admin/pass/all_resepsionis')?></div>
  <div class="tab-pane " id="bulan2"><?php $this->load->view('admin/pass/ganti_pass')?></div>
</div>
     
      
    </div><!-- /.container -->