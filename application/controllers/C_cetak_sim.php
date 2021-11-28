<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_cetak_sim extends CI_Controller {
function __construct (){
        parent::__construct();
        $this->load->model('Minfo','', TRUE);
        $this->load->model('Madmin','', TRUE);
        $this->load->model('Mhotel','', TRUE);
        $this->load->library('Pdf');
 
    }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
		public function cetak_bill_sim($cetak,$id_p,$sm='no')////
	{
		if ($this->session->userdata('login') == TRUE){
	//////
	$q = $this->Minfo->info()->row();
	//////
		$data['namapt'] = ! empty ($q->namapt) ? $q->namapt : $this->config->item('nameAPP');
    	$data['logo'] = ! empty ($q->logo) ? $q->logo : 'logo';	
    	$data['nama_app'] = 'SISTEM INFORMASI PERHOTELAN ';
    	$data['title'] = 'SISTEM INFORMASI PERHOTELAN || CEK BILL';
    
    //=========================================================================================SIM 10417
	$data['h_row']=$h_row=$this->db->get_where('tbl_pesan_kamar_sim',array('id'=>$id_p))->row();
	//=========================================================================================SIM 10417
    
    	//
    	$dt=$this->db->get_where('tbl_deposit_sim',array('id_p'=>$id_p));
		$id_dep_a=$this->db->get('tbl_deposit_sim')->num_rows();
		//
		
	if($dt->num_rows() > 0){
	foreach($dt->result() as $depo){
		
	}
	//$data['depo']= empty($depo->tipe)?'':$depo->tipe; /// memakai tipe di tabel deposit yang terakhir
	$data['depo']= empty($h_row->tipe)?'':$h_row->tipe;
	//$data['totid']=$dt->num_rows();
	//$data['totid']=$depo->id;		
		}else{
			$data['depo']='';
			
		}
    	$data['totid']=$id_dep_a;
	////
    	//
    	$data['id_p']=$id_p;
    	//=========================================================================================SIM 10417
		$data['h']=$h=$this->Mhotel->bill_hotel_sim($id_p);////berdasarkan nama id pelanggan pertama ///di pk
    	$data['h1']=$h1=$this->db->get_where('tbl_tagihan_sim',array('id_p'=>$id_p));
		$nm=$this->db->get_where('tbl_pesan_kamar_sim',array('id'=>$id_p))->row();
		//=========================================================================================SIM 10417
    	///
    	 
    if($nm->status=='Lunas'){
 	$data['s']='paid';
 	}else{
	$data['s']='unpaid';
	}
    		//
	if($id_p != NULL){
	$tot=0;
	$totdsc=0;
	foreach($h->result() as $hh){ 
	$am = $this->db->get_where('tbl_kamar',array('id_kamar'=>$hh->id_k))->row();
	$dk=$hh->delkam;
	//
		if($dk=='ya'){
			$hrgakam=0;
			
		}else{
			$hrgakam=$am->harga;
		
		}
	//
	//// revisi Early Cek in 
	$h_kam=$hrgakam;
		if($hh->early == 1){
			//$has_early=$h_kam+$bg_kam;
			$bg_kam=($am->harga/2); ///haraga kamar tidak nharuh
		}else{
			$bg_kam=0;
		}
	///
    //////-------------------------revesi yang di dic kamar saja  maret 17
    $dtot=$hrgakam;; ///discon jumlah dalam satu kamar
	$disc=((int)$hh->disc*(int)$dtot)/100; ///disc
	$hrgakamdisc=(int)$hrgakam-$disc;
    	$tot=($tot+$hrgakamdisc+(int)$hh->harga_bed+(int)$hh->harga_ot+(int)$bg_kam); ///total - dison
    	//$totdsc=($totdsc+$hrgakam)-$disc; ///discon-discon perkamar
    	$totdsc=($totdsc+$dtot); ///discon-discon perkamar
    	$tottt=$tot;//kamar
    	$data['totdisc']=$totdsc;
 	  } 
 	  if($h1->num_rows() > 0){
		$tott=0;
	foreach($h1->result() as $hh1){ 
    	$tott=$tott+$hh1->harga; /////makanan
    	$data['p']=$tott+$tottt;//total
 	  } 
	}else{
		$data['p']=$tottt;//totall
	}}
 	  
    	//
    	
	//
	
    	//
		
        $page=$this->uri->segment(3);
        $data['hal'] = $page;
        $limit_unit=20;
        if(!$page):
            $offset_unit = 0;
        else:
            $offset_unit = $page;
        endif;

            
       switch ($cetak) {
           
            case 'html':
                //$this->load->view('cetak/bill_html',$data);
                //$this->load->view('cetak/bill_html2',$data);
                $this->load->view('cetak/bill_html_sim',$data);
                break;
                   case 'xls':
                 
                //$this->load->view('cetak/bill_xls',$data);
                $this->load->view('cetak/bill_xls_sim',$data);
                break;
                case 'pdf':
                //$file_pdf = $this->load->view('cetak/bill_pdf',$data,TRUE); 
                $file_pdf = $this->load->view('cetak/bill_pdf_sim',$data,TRUE); 
              
              //  $this->pdf->pdf_create_portrait_down($file_pdf,'daftar Aparat Desa');
              //  $this->pdf->pdf_create_landscape($file_pdf,'bill-hotel');
                $this->pdf->pdf_create_portrait_down($file_pdf,'bill-hotel');

                break;
        }
		}else{
			redirect ('login/simpeg');
		}
	}

	

}
