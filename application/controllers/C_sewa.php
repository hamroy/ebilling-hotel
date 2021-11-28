<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_sewa extends CI_Controller {

	function __construct (){
        parent::__construct();
        $this->load->model('Minfo','', TRUE);
        $this->load->model('Mhotel','', TRUE);
 
    }
	
	
	public function index()
	{	if ($this->session->userdata('id_login') == TRUE){
		//
		$q = $this->Minfo->info()->row();
    	$data['nama_app'] = 'SISTEM INFORMASI PERHOTELAN ';
    	$data['title'] = ' INPUT TAGIHAN || SISTEM INFORMASI PERHOTELAN';
    	//
    	 $data['namapt'] = ! empty ($q->namapt) ? $q->namapt : $this->config->item('nameAPP');
    	$data['logo'] = ! empty ($q->logo) ? $q->logo : 'logo';		
    	$data['main_view'] = 'sewa/beranda';
    	//
    	$data['a']='active';
    	$data['b']=$data['c']='';
    	//
	
		$this->load->view('beranda',$data);
	//
		 }else{
            redirect ('login/simpeg');
        }
	}
}
