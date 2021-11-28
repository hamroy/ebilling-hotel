<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	  <title>Login <?=$namapt?> </title>    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Apliksi billing hotel berbasis web">
    <meta name="author" content="hamroy,sediakoding.com,www.supra-center.com">

    <!-- Le styles -->
    <link href="<?=base_url()?>boot3_login/bootstrap.css" rel="stylesheet">
    <style type="text/css">
     body {
        padding-top: 80px;
        padding-bottom: 40px;
              }
      
      body {

  height: 100%;

 background-color: #343572;
  /*background: url("http://localhost/peg_smk_muhiwon/images/") no-repeat center center fixed; */
  
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;  


}



      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }
      p{
	  	color:#ffffff;
	  }

    </style>
    <link href="<?=base_url()?>boot3_login/bootstrap-responsive.css" rel="stylesheet">

    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="<?=base_url()?>images/<?=$logo?>.png"  />
</head>

<body >
    <div class="navbar navbar-warning navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
        
           <a class="brand text-center" href="#"><img src="<?=base_url()?>images/<?=$logo?>.png" class="img-thumbnail" width="90"  /> | <?=$simlong?>  | <span class="text-info"><?=$namapt?> </span> </a>
        </div>
      </div>
    </div>

	<div class="wrap">
		<div class="container">
    <?php
        $attributes = array('name' => 'login_form', 'class' => 'form-signin', 'style' => 'background:'.$warna2);
        
        echo form_open('login/proses', $attributes);
        $message = $this->session->flashdata('pesan');
    	echo $message == '' ? '' : '<div class="alert alert-error text-danger" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message . '</p></div>';
    ?>
        <h2 class="form-signin-heading">Silahkan Masuk</h2>
        <input type="text" class="input-block-level" placeholder="Username" name="username">
        <input type="password" class="input-block-level" placeholder="Password" name="password">
        <select class="form-control" name="sip" spellcheck="true">
  <option value="" selected>--Pilih Shift--</option>  
  
  <?php
 		$h = "7";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
		$hm = $h * 60;
		$ms = $hm * 60;
		$tanggal = gmdate("d-m-Y ", time()+($ms)); // the "-" can be switched to a plus if that's what your time zone is.
		$waktu = gmdate ( "H", time()+($ms));
    //if($waktu >='06'  and $waktu <='14'){
    if($waktu >='07'  and $waktu <='14'){
	echo '<option value="Pagi"> Pagi </option>';
	} 
?>
  <?php if($waktu >='15'  and $waktu <='22'){
	echo '<option value="Siang">Siang</option>';
	}  ?>
  <?php 
  //if($waktu >='0'  and $waktu <='5' or $waktu==23){
  if($waktu >='0'  and $waktu <='6' or $waktu==23){
	echo '<option value="Malam">Malam</option>';
	}  ?>
</select>

        <!--<label class="checkbox">
          <input type="checkbox" value="remember-me"> Ingatkan saya
        </label>-->
        <button class="btn btn-large btn-primary" type="submit">Masuk</button>
		<br><br>
		<!--<a href="<?=base_url()?>download/modul_penganggaran.pdf" class="btn btn-success">Unduh Manual Penganggaran SIMAKU-PT</a>-->
      </form>

    </div> <!-- /container -->
</div>
<div class="footer" align="center">
          <p class="text-muted"  align="center"> <?=date('Y')?>  &copy;  <?=$namapt?> </p>
	</div>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?=base_url()?>boot3_login/js/jquery-1.8.0.min.js"></script>
    <script src="<?=base_url()?>boot3_login/js/bootstrap-transition.js"></script>
    <script src="<?=base_url()?>boot3_login/js/bootstrap-alert.js"></script>
    <script src="<?=base_url()?>boot3_login/js/bootstrap-modal.js"></script>
    <script src="<?=base_url()?>boot3_login/js/bootstrap-dropdown.js"></script>
    <script src="<?=base_url()?>boot3_login/js/bootstrap-scrollspy.js"></script>
    <script src="<?=base_url()?>boot3_login/js/bootstrap-tab.js"></script>
    <script src="<?=base_url()?>boot3_login/js/bootstrap-tooltip.js"></script>
    <script src="<?=base_url()?>boot3_login/js/bootstrap-popover.js"></script>
    <script src="<?=base_url()?>boot3_login/js/bootstrap-button.js"></script>
    <script src="<?=base_url()?>boot3_login/js/bootstrap-collapse.js"></script>
    <script src="<?=base_url()?>boot3_login/js/bootstrap-carousel.js"></script>
    <script src="<?=base_url()?>boot3_login/js/bootstrap-typeahead.js"></script>

</body>

 
</html>