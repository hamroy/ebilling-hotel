<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

 function __construct (){
        parent::__construct();
        $this->load->model('Minfo','', TRUE);
        $this->load->model('Mhotel','', TRUE);
 
    }

	public function index()
	{
		if ($this->session->userdata('login2') == TRUE){
			$q = $this->Minfo->info()->row();
    	 	$d['namapt'] = ! empty ($q->namapt) ? $q->namapt : $this->config->item('nameAPP');
			$d['logo']='logo-hotel-kusuma';
			$this->load->view('admin/beranda',$d);
		}else{
	  		redirect(base_url()); 
		} 
	}
}
