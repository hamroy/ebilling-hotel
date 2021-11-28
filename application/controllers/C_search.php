<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_search extends CI_Controller {

	function __construct (){
        parent::__construct();
        $this->load->model('Login_model','', TRUE);
        $this->load->model('Minfo','', TRUE);
        $this->load->model('M_bill','', TRUE);
        $this->load->model('Madmin','', TRUE);
        $this->load->model('Mhotel','', TRUE);
    }
	
	
	public function index()
	{	
        if ($this->session->userdata('login') == TRUE){
		//
		$q = $this->Minfo->info()->row();
    	$data['nama_app'] = $q->namapt;
    	$data['title'] = $q->namapt;
    	//        
        $data['namapt'] = ! empty ($q->namapt) ? $q->namapt : $this->config->item('nameAPP');
    	$data['logo'] = ! empty ($q->logo) ? $q->logo : 'logo';		
    	$data['main_view'] = 'search/listNota';
    	//
    	$data['Search']='active';
    	$data['aa']=$data['a']=$data['a1']=$data['c']=$data['d']=$data['e']=$data['b']=$data['f']=$data['g']='';
    	$data['p']='';//tambahan dari MASTERPRA 16MARET2017
    	//
	
		$this->load->view('resepsionis/beranda',$data);
	//
		 }else{
            redirect ('login/simpeg');
        }
    }
    
    public function search(Type $var = null)
    {
        #DC = cas, DT = transfer, RC=refund Cas, RT,K = Kamar kas, = non kas
        $inNota= strtoupper($this->input->get('nota'));
        $kalimat = substr($inNota,0,2);

        if($kalimat == "RC") {
            $tipe = "K";
            $dep = "no";
            $rf = "ok";
            $nota = substr($inNota, 2);
            
        }elseif ($kalimat == "RT") {
            $tipe = "N";
            $dep = "no";
            $rf = "ok";
            $nota = substr($inNota, 2);
        }
        elseif ($kalimat == "DC") {
            $tipe = "K";
            $dep = "ya";
            $rf = "";
            $nota = substr($inNota, 2);
        }
        elseif ($kalimat == "DT") {
            $tipe = "N";
            $dep = "ya";
            $rf = "";
            $nota = substr($inNota, 2);
        }
        elseif (substr($kalimat,0,1) == "K") {
            $tipe = "K";
            $dep = "no";
            $rf = "pas";
            $nota = substr($inNota, 1);
        }
        else {
            $tipe = "N";
            $dep = "no";
            $rf = "pas";
            $nota = substr($inNota, 0);
        }
        if ($this->session->userdata('login') == TRUE){
            //
            $q = $this->Minfo->info()->row();
            $data['nama_app'] = $q->namapt;
            $data['title'] = $q->namapt;
            //        
            $data['namapt'] = ! empty ($q->namapt) ? $q->namapt : $this->config->item('nameAPP');
            $data['logo'] = ! empty ($q->logo) ? $q->logo : 'logo';		
            $data['main_view'] = 'search/listNota';
            //
            $data['Search']='active';
            $data['h']='';
            $data['aa']=$data['a']=$data['a1']=$data['c']=$data['d']=$data['e']=$data['b']=$data['f']=$data['g']='';
            $data['p']='';//tambahan dari MASTERPRA 16MARET2017
            $data['q']=$this->M_bill->searchNota_Room($tipe,$dep,$rf,$nota);
            //
        
            $this->load->view('resepsionis/beranda',$data);
        //
             }else{
                redirect ('login/simpeg');
            }
    }
}
