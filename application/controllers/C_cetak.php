<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_cetak extends CI_Controller {
function __construct (){
        parent::__construct();
        $this->load->model('Minfo','', TRUE);
        $this->load->model('Madmin','', TRUE);
		$this->load->model('Mhotel','', TRUE);
		$this->load->model('M_bill','', TRUE);
		$this->load->library('Pdf');
 
    }
	public function index()
	{
		$this->load->view('welcome_message');
	}
	
	public function cetak_bill($cetak,$id_p)////
	{
		if ($this->session->userdata('login') == TRUE){
	//////
	$q = $this->Minfo->info()->row();
	//////
	$data['namapt'] = ! empty ($q->namapt) ? $q->namapt : $this->config->item('nameAPP');
    	$data['logo'] = ! empty ($q->logo) ? $q->logo : 'logo';	
    	$data['nama_app'] = 'SISTEM INFORMASI PERHOTELAN ';
    	$data['title'] = 'SISTEM INFORMASI PERHOTELAN || CEK BILL';
    	$data['h_row']=$h_row=$this->db->get_where('tbl_pesan_kamar',array('id'=>$id_p))->row();
    	//
    	$dt=$this->db->get_where('tbl_deposit',array('id_p'=>$id_p));
		$id_dep_a=$this->db->get('tbl_deposit')->num_rows();
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
    
    	$data['h']=$h=$this->Mhotel->bill_hotel($id_p);
    	$data['h1']=$h1=$this->db->get_where('tbl_tagihan',array('id_p'=>$id_p));
    	///
    	 $nm=$this->db->get_where('tbl_pesan_kamar',array('id'=>$id_p))->row();
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
	$am = $this->M_bill->getPriceRoom($hh->id,$hh->id_k);
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
    $dtot=(int)$hrgakam;; ///discon jumlah dalam satu kamar
	$disc=(int)$hh->disc; ///disc
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
    	$tott=$tott+(int)$hh1->harga; /////makanan
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
                $this->load->view('cetak/bill_html3',$data);
                break;
                   case 'xls':
                 
                //$this->load->view('cetak/bill_xls',$data);
                $this->load->view('cetak/bill_xls2',$data);
                break;
				case 'pdf':
					$pdfroot  = dirname(dirname(dirname(__FILE__)))."/images/paid.png";
					$data['imgPdf']=$this->pdf->encode_img_base64($pdfroot);
					$this->pdf->setPaper('A4', 'potrait');
					$this->pdf->filename = "bill-hotel.pdf";
					$this->pdf->load_view('cetak/bill_pdf2', $data);
					// $this->load->view('cetak/bill_pdf2',$data);
                break;
        }
		}else{
			redirect ('login/simpeg');
		}
	}

	////cetak DEPOSIt
	public function cetak_deposit($cetak,$id_p)////
	{
		if ($this->session->userdata('login') == TRUE){
	//////
	$q = $this->Minfo->info()->row();
	//////
	$data['namapt'] = ! empty ($q->namapt) ? $q->namapt : $this->config->item('nameAPP');
    	$data['logo'] = ! empty ($q->logo) ? $q->logo : 'logo';	
    	$data['nama_app'] = 'SISTEM INFORMASI PERHOTELAN ';
    	$data['title'] = 'SISTEM INFORMASI PERHOTELAN || CEK BILL';
    	$data['h_row']=$h_row=$this->db->get_where('tbl_pesan_kamar',array('id'=>$id_p))->row();
    	//
    	$dt=$this->db->get_where('tbl_deposit',array('id_p'=>$id_p));
		$id_dep_a=$this->db->get('tbl_deposit')->num_rows();
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
    
    	$data['h']=$h=$this->Mhotel->bill_hotel($id_p);
    	$data['h1']=$h1=$this->db->get_where('tbl_tagihan',array('id_p'=>$id_p));
    	///
    	 $nm=$this->db->get_where('tbl_pesan_kamar',array('id'=>$id_p))->row();
    if($nm->status=='Lunas'){
 	$data['s']='paid';
 }else{
	$data['s']='unpaid';
}
    		//
	
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
                $this->load->view('cetak/deposit_html',$data);
                break;
                   case 'xls':
                 
                //$this->load->view('cetak/bill_xls',$data);
                $this->load->view('cetak/deposit_xls',$data);
                break;
				case 'pdf':
					$this->pdf->setPaper('A4', 'potrait');
					$this->pdf->filename = "cetak-deposit-hotel.pdf";
					$pdfroot  = dirname(dirname(dirname(__FILE__)))."/images/paid.png";
					$data['imgPdf']=$this->pdf->encode_img_base64($pdfroot);
					$this->pdf->load_view('cetak/deposit_pdf', $data);
                break;
        }
		}else{
			redirect ('login/simpeg');
		}
	}

}
