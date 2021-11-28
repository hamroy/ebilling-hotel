<div class="container"  style="background-color: #dddde1">
<!--   <div class="alert alert-success alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Warning!</strong> Better check yourself, you're not looking too good.
</div>-->

   
      <div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">
    	  <div class="page-header" >
        <h3>INPUT TAGIHAN LAINNYA</h3>
      </div>
    	
    </h3>
  </div>
  <div class="panel-body">
  <?=$this->session->flashdata('pesan')?>
      <form class="form-horizontal" role="form" method="post" action="<?=base_url()?>/C_resepsionis/simpan_tagihan">
          <ul class="list-group">
            <li href="#" class="list-group-item">
              <p class="list-group-item-text">

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"><p class="text-left">Jenisnya</p></label>
    <div class="col-sm-10">
      <select class="form-control" name="jenis">
  <option value="1">Beverage</option>
  <option value="2">Food</option>
  <option value="3">Laundry</option>
  <option value="4">Other</option>
</select>

    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"><p class="text-left">Keterangan</p></label>
    <div class="col-sm-10">
      <textarea class="form-control" name="ket" rows="3"></textarea>
    </div>
  </div>
  
 <!--<div class="form-group">
		    <label class="col-sm-2 control-label"><p class="text-left">Check in</p></label>
		     <div class="col-sm-4">
		     
   
      <input type="text" name="cekin" id="datetimepicker5" data-date="12 04 14" data-date-format="dd/mm/yyyy" placeholder="<?=date('d/m/Y')?>" value="<?=date('d/m/Y')?>" class="form-control">
     

  </div><!-- /.col-lg-6 --
  
  		</div>-->
 <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"><p class="text-left">Nama Pengunjung</p></label>
    <div class="col-sm-10">
     <?php 
	
    echo form_dropdown('id_p',$nama,'','class="form-control" ')
    ?> 
    </div>
  </div>
  

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"><p class="text-left">Harga</p></label>
    <div class="col-sm-5 ">
    <div class="input-group">
  <span class="input-group-addon">Rp : </span>
  <input type="Text" name="harga" class="form-control" id="inputEmail3">
</div>
    </div>
  </div>
   <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"><p class="text-left">Jumlah</p></label>
    <div class="col-sm-5">
      <input type="Text" name="jmlah" class="form-control" id="inputEmail3" value="1">
    </div>
  </div>
  
  		
              </p>
            </li>
           <!--<li href="#" class="list-group-item">
              <p class="list-group-item-text">
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"><p class="text-left">Keterangan</p></label>
    <div class="col-sm-10">
      <textarea class="form-control" name="pesan" rows="3"></textarea>
    </div>
  </div>
  
  
              </p>
            </li>-->
            
            <li href="#" class="list-group-item">

  
    
      <button type="submit" class="btn btn-success btn-block btn-lg">PESAN</button>
    
  
            </li>
          </ul>



  
</form>
  </div>
</div>

   

    </div><!-- /.container -->