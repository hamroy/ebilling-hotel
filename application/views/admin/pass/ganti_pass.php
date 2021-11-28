<form class="form-horizontal" role="form" method="post" action="<?=base_url()?>/C_admin/up_password_id/">
          <ul class="list-group">
            <li href="#" class="list-group-item">
              <p class="list-group-item-text">

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"><p class="text-left">Username </p></label>
    <div class="col-sm-10">
      <input type="Text" name="user" value="<?=$this->session->userdata('username')?>" class="form-control" id="inputEmail3">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"><p class="text-left">Password </p></label>
    <div class="col-sm-10">
      <input type="Text" name="pass" value="<?=$this->session->userdata('password')?>" class="form-control" id="inputEmail3" >
    </div>
  </div>
  
 

  		
              </p>
            </li>
           
            
            <li href="#" class="list-group-item">

      <button type="submit" class="btn btn-success btn-block btn-lg">GANTI</button>
      
            </li>
          </ul>
</form>