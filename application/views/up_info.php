<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="<?=base_url()?>/images/<?=$logo?>.png">    
<title><?=$namapt?> </title>    
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Apliksi billing hotel berbasis web">
  <meta name="author" content="hamroy,sediakoding.com,www.supra-center.com">

    <!-- Le styles -->
    <link href="<?=base_url()?>css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 80px;
        padding-bottom: 40px;
        background-color: <?=$warna?>;
        f
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
    <link href="<?=base_url()?>css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="<?=base_url()?>images/<?=$logo?>.png"  />
</head>

<body >
    <div class="navbar navbar-warning navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
         
           <a class="brand text-center" href="#"><img src="<?=base_url()?>images/<?=$logo?>.png" width="50" />  | <span class="text-info"><?=$namapt?> </span> </a>
        </div>
      </div>
    </div>

	<div class="wrap">
		<div class="container">
 
 <form  role="form" method="post" class="form" action="<?=base_url('login/s_info')?>" enctype="multipart/form-data">
        <h2 class="form-signin-heading">Selamat datang... Apakah anda Ingin Merubah tabel  INFO di database</h2>
         <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">nama pt</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="<?=$q->namapt?>" name="nama">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">alamat</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="<?=$q->alamat?>" name="alamat">
    </div>
  </div>
	
	  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">tel</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="<?=$q->tel?>" name="tel">
    </div>
  </div>
    <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">email</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="<?=$q->email?>" name="email">
    </div>
  </div>
    <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">nama rektor</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="<?=$q->namarektor?>" name="rektor">
    </div>
  </div>
    <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">nip</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="<?=$q->nip?>" name="nip">
    </div>
  </div>
    <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Website</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="<?=$q->website?>" name="website">
    </div>
  </div>
    <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">awal anggaran</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="<?=$q->awal_angg?>" name="awal_a">
    </div>
  </div>
    <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">akhir anggaran</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="<?=$q->akhir_angg?>" name="akhir_a">
    </div>
  </div>
    <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">thn anggaran</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="<?=$q->th_angg?>" name="thn">
    </div>
  </div>
    <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">logo</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="<?=$q->logo?>" name="logo">
    </div>
  </div>
  

        <button class="btn btn-large btn-primary" type="submit">Simpan dan Keluar</button>
		<br><br>
		<!--<a href="<?=base_url()?>download/modul_penganggaran.pdf" class="btn btn-success">Unduh Manual Penganggaran SIMAKU-PT</a>-->
      </form>
      

    </div> <!-- /container -->
</div>
<div class="footer">
        <p class="text-danger" align="center"><strong><?=date('Y')?> &copy; <?=$namapt?></strong></p>
	</div>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?=base_url()?>js/jquery-1.8.0.min.js"></script>
    <script src="<?=base_url()?>js/bootstrap-transition.js"></script>
    <script src="<?=base_url()?>js/bootstrap-alert.js"></script>
    <script src="<?=base_url()?>js/bootstrap-modal.js"></script>
    <script src="<?=base_url()?>js/bootstrap-dropdown.js"></script>
    <script src="<?=base_url()?>js/bootstrap-scrollspy.js"></script>
    <script src="<?=base_url()?>js/bootstrap-tab.js"></script>
    <script src="<?=base_url()?>js/bootstrap-tooltip.js"></script>
    <script src="<?=base_url()?>js/bootstrap-popover.js"></script>
    <script src="<?=base_url()?>js/bootstrap-button.js"></script>
    <script src="<?=base_url()?>js/bootstrap-collapse.js"></script>
    <script src="<?=base_url()?>js/bootstrap-carousel.js"></script>
    <script src="<?=base_url()?>js/bootstrap-typeahead.js"></script>

</body>
</html>