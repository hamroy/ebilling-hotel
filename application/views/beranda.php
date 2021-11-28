<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('header')?>
 

  <body>
  
  <?php
  if($this->session->userdata('wewenang')=='admin'){
$this->load->view('nav_admin');		
}else{
	if($this->session->userdata('login_shift')=='ya')
{
	$this->load->view('nav');	
}else{
	$this->load->view('nav_admin');	
}

}
   ?>
 

<!--ISI BERANDA-->
   <?php $this->load->view($main_view);
   ?>
   <!--footeer-->
    <hr/>
    <?php $this->load->view('footer')?>
    
  </body>
</html>
