<?php

class Madmin extends CI_Model {

    function __construct(){
        parent::__construct();
       // $this->load->model('Mpagu','',TRUE);
    }

	function lap_shifs(){
		//$this->db->group_by('sort');
		return $this->db->get_where('tbl_lap_ship',array('status ' => 'login'));
	}
	function lap_refund($id,$id_tgl,$shift){
		//$this->db->group_by('sort');
		$this->db->where('id_tgl',$id_tgl); ////yang pake id
	 	$this->db->where('shift',$shift); ////yang pake id
		$this->db->where('status','lunas');
		return $this->db->get_where('tbl_lap_refund',array('id_user ' => $id));
	}
	function lap_tagihan($id){
		$this->db->from('tbl_pesan_kamar,tbl_tagihan,tbl_kamar');
	//$this->db->from('tbl_jadwalkuliah,tbl_hari_jam');
		$this->db->where('tbl_pesan_kamar.id = tbl_tagihan.id_p');
		$this->db->where('tbl_tagihan.id_k = tbl_kamar.id_kamar ');
		$this->db->where('tbl_tagihan.id_user',$id);
		return $this->db->get();
	}
	function lap_tagihan_hotel($id,$id_tgl,$shift){
		
		$this->db->from('tbl_tagihan');
		//$this->db->where('tbl_pesan_kamar.status','lunas');
	//$this->db->from('tbl_jadwalkuliah,tbl_hari_jam');
		$this->db->where('id_tgl',$id_tgl); ////yang pake id
	 	$this->db->where('shift',$shift); ////yang pake id
		$this->db->where('id_user',$id);
		$this->db->where('status','lunas');
		return $this->db->get();
	}
	function lap_tagihan_hotel_all($tgl1,$tgl2){
		
		$this->db->from('tbl_tagihan');
		//$this->db->where('tbl_pesan_kamar.status','lunas');
	//$this->db->from('tbl_jadwalkuliah,tbl_hari_jam');
		$this->db->where('status','lunas');
		//////FILTER tgl
		$this->db->where('id_tgl >=',$tgl1);
		$this->db->where('id_tgl <=',$tgl2);
		//////FILTER tgl
		$this->db->order_by('nota','ASC');
		return $this->db->get();
	}
	function get_nama_tagihan($id){
		$this->db->from('tbl_pesan_kamar');
	//$this->db->from('tbl_jadwalkuliah,tbl_hari_jam');
		
		$this->db->where('id',$id);
		return $this->db->get();
	}
	function get_user($id){
		return $this->db->get_where('ueu_tbl_user',array('idlog ' => $id));
	}
	function get_jenis($id_k){
		return $this->db->get_where('tbl_kamar',array('id_kamar' => $id_k));
	}
	function get_sempeljenis($id_k){
		return $this->db->get_where('tbl_kamar',array('id_jkamar' => $id_k));
	}
	///jenis kamr
	function geg_all_jenis_kamar(){
		return $this->db->get('tbl_jenis_kamar');
	}
	///jenis kamr
	function get_hargan($id){
		return $this->db->get_where('tbl_jenis_kamar',array('id_jkamar' => $id));
	}
	///all kamr
	function geg_all_kamar(){
	   $this->db->from('tbl_kamar,tbl_jenis_kamar');
		
		$this->db->where('tbl_jenis_kamar.id_jkamar= tbl_kamar.id_jkamar');
		return $this->db->get();
	}
	function get_bed($id_p,$id_k){
		$this->db->select_max('bed');
		return $this->db->get_where('tbl_bill_hotel',array('id_p' => $id_p,'id_k' => $id_k));
		//return $this->db->get_where('tbl_kxh',array('id_k' => $id_k));
	}
	function get_early($id_p,$id_k){
		$this->db->select_max('early');
		return $this->db->get_where('tbl_bill_hotel',array('id_p' => $id_p,'id_k' => $id_k));
		//return $this->db->get_where('tbl_kxh',array('id_k' => $id_k));
	}
	function get_nilai_k($id_p,$id_k){
		//$this->db->order_by('delkam','DESC');
		return $this->db->get_where('tbl_bill_hotel',array('id_p' => $id_p,'id_k' => $id_k));
		//return $this->db->get_where('tbl_kxh',array('id_k' => $id_k));
	}
	function getkamar($id,$id_tgl,$shift){ ////id_user , // id_tgl ,,///shift
		$this->db->from('tbl_pesan_kamar');
	//$this->db->from('tbl_jadwalkuliah,tbl_hari_jam');
		//$this->db->where('tbl_pesan_kamar.id_user = tbl_deposit.id_user');
	 	$this->db->where('id_user',$id); ////yang pake id
	 	$this->db->where('id_tgl',$id_tgl); ////yang pake id
	 	$this->db->where('shift',$shift); ////yang pake id
		$this->db->where('status','Lunas'); 
		$this->db->where('refund !=','tdk'); 
		//$this->db->where('id_p',$id);
		return $this->db->get();
	}
	//////////REKAP NOTA KAMAR
	function getkamar_rekap_nota($tipe,$dep,$rf,$tgl1,$tgl2){ ////tipe ///rekap berdasarkan tipe
		$this->db->from('tbl_pesan_kamar');
	//$this->db->from('tbl_jadwalkuliah,tbl_hari_jam');
		//$this->db->where('tbl_pesan_kamar.id_user = tbl_deposit.id_user');
		$this->db->where('status','Lunas');
		$this->db->where('boking','no'); //no deposit 
		$this->db->where('refund','pas'); 
		$this->db->order_by('nota','ASC'); 
		//////FILTER tgl
		$this->db->where('id_tgl >=',$tgl1);
		$this->db->where('id_tgl <=',$tgl2);
		//////FILTER tgl
		//$this->db->like('refund','pas'); 
		$this->db->like('tipe',$tipe); 
		//$this->db->where('id_p',$id);
		return $this->db->get();
	}
	////////REKAP NOTA REFUND
	function getkamar_rekap_notarefund($tipe,$dep,$rf,$tgl1,$tgl2){ ////tipe ///rekap berdasarkan tipe
		$this->db->from('tbl_pesan_kamar');
	//$this->db->from('tbl_jadwalkuliah,tbl_hari_jam');
		//$this->db->where('tbl_pesan_kamar.id_user = tbl_deposit.id_user');
		$this->db->where('status','Lunas');
		$this->db->where('boking','no'); //no deposit 
		$this->db->where('refund','ok'); 
		$this->db->where('refund_status','lunas'); 
		$this->db->order_by('nota','ASC');
		//////FILTER tgl
		$this->db->where('id_tgl >=',$tgl1);
		$this->db->where('id_tgl <=',$tgl2);
		//////FILTER tgl
		//$this->db->like('refund','pas'); 
		//$this->db->like('tipe',$tipe); 
		//$this->db->where('id_p',$id);
		return $this->db->get();
	}
	////////////REKAP NOTA DEPOSIT
	function getkamar_rekap_notadep($tipe,$dep,$tgl1,$tgl2){ ////tipe ///rekap berdasarkan tipe
		$this->db->from('tbl_pesan_kamar');
	//$this->db->from('tbl_jadwalkuliah,tbl_hari_jam');
		//$this->db->where('tbl_pesan_kamar.id_user = tbl_deposit.id_user');
		$this->db->where('status','Lunas'); 
		$this->db->like('boking',$dep); 
		$this->db->where('tipe',$tipe); 
		$this->db->order_by('nota','ASC');
		//////FILTER tgl
		$this->db->where('id_tgl >=',$tgl1);
		$this->db->where('id_tgl <=',$tgl2);
		//////FILTER tgl
		//$this->db->where('id_p',$id);
		return $this->db->get();
	}
	function get_tbl_pesan_kamar($id){
		$this->db->from('tbl_pesan_kamar');
	//$this->db->from('tbl_jadwalkuliah,tbl_hari_jam');
		//$this->db->where('tbl_pesan_kamar.id_user = tbl_deposit.id_user');
		$this->db->where('id',$id);
		return $this->db->get()->row();
	}
	function get_tbl_deposit($id){
		$this->db->from('tbl_deposit');
	//$this->db->from('tbl_jadwalkuliah,tbl_hari_jam');
		//$this->db->where('tbl_pesan_kamar.id_user = tbl_deposit.id_user');
		$this->db->where('id_p',$id);
		return $this->db->get();
	}
	function get_tbl_deposit_rekap($id){
		$this->db->from('tbl_deposit');
	//$this->db->from('tbl_jadwalkuliah,tbl_hari_jam');
		//$this->db->where('tbl_pesan_kamar.id_user = tbl_deposit.id_user');
		$this->db->where('id_p',$id);
		return $this->db->get();
	}
	function get_tbl_kamar($id){
		$this->db->from('tbl_kamar');
	//$this->db->from('tbl_jadwalkuliah,tbl_hari_jam');
		//$this->db->where('tbl_pesan_kamar.id_user = tbl_deposit.id_user');
		$this->db->where('id_kamar',$id);
		return $this->db->get()->row();
	}
		
	////
	function get_all_deposit_cas($id_p){
		$this->db->where('id_p',$id_p);	
		$this->db->where('tipe','C');			
		return $this->db->get('tbl_deposit');
	}
	////
	function getjenikam($id_k){
		$this->db->where('id_kamar',$id_k);	
		//$this->db->where('tipe','C');			
		return $this->db->get('tbl_kamar');
	}
	////////
	function getusename($id_user){
		$this->db->where('idlog',$id_user);	
		return $this->db->get('ueu_tbl_user');
	}
	/////
	////////
	function geg_all_pass(){
		$this->db->where('idlog !=',$this->session->userdata('id_admin'));	
		$this->db->where('wewenang !=','admin');	
		$this->db->where('idlog !=',13);	
		return $this->db->get('ueu_tbl_user');
	}
	/////
	////////
	function geg_all_passall(){
		$this->db->where('idlog !=',$this->session->userdata('id_admin'));	
		$this->db->where('idlog !=',975);	
		$this->db->order_by('idlog');	
		return $this->db->get('ueu_tbl_user');
	}
	/////
	////////
	function up_pass($d,$id){
		$this->db->where('idlog',$id);	
		$this->db->update('ueu_tbl_user',$d);
	}
	/////
	////////
	function up_hargadikamar($d,$id){
		$this->db->where('id_jkamar',$id);	
		$this->db->update('tbl_kamar',$d); ////daftar kamar
	}
	/////
	//mengoflinekan
	////////
	function merubah_ofline($id){
		$a=array(
		'status'=>'ofline',
		);
		$this->db->where('idlog',$id);	
		$this->db->update('ueu_tbl_user',$a); ////daftar kamar
	}
	/////
	////////
	function up_hargadijeniskamar($d,$id){
		$this->db->where('id_jkamar',$id);	
		$this->db->update('tbl_jenis_kamar',$d); ////jens kamar
	}
	/////
	////////
	function plus_jkamar($d){
		$this->db->insert('tbl_jenis_kamar',$d); ////jens kamar
	}
	/////
	////////
	function dell_pass($id){
		$this->db->where('idlog',$id);	
		$this->db->delete('ueu_tbl_user');
	}
	/////
	////////
	function dell_mkamar($id){
		$this->db->where('id_jkamar',$id);	
		$this->db->delete('tbl_jenis_kamar');
	}
	/////
	////////
	function dell_mkamar_list($id){
		$this->db->where('id_kamar',$id);	
		$this->db->delete('tbl_kamar');
	}
	/////
	////////
	function plus_listkamar($d){
		$this->db->insert('tbl_kamar',$d);
	}
	/////
	////////
	function plus_pass($d){
		$this->db->insert('ueu_tbl_user',$d);
	}
	/////
	function gettgl($w,$t,$b,$th){
		$this->db->where('ship',$w);	
		$this->db->where('tgl',$t);	
		$this->db->where('bln',$b);	
		$this->db->where('thn',$th);
		$this->db->order_by('id','DESC');	
		$this->db->where('status','Login');			
		return $this->db->get('tbl_login_ship');
	}
	function get_all_deposit_t($id_p){
		$this->db->where('id_p',$id_p);	
		$this->db->where('tipe','T');			
		return $this->db->get('tbl_deposit');
	}
	function getnama($id_p){
		$this->db->where('id',$id_p);	
		//$this->db->where('tipe','T');			
		return $this->db->get('tbl_pesan_kamar');
	}
	function ceklap_refund($id,$id_tgl,$shift){
		$tgl=$this->lap_refund($id,$id_tgl,$shift);
		if($tgl->num_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}		
	}
	//////////////
	function cektglmodel($w,$t,$b,$th){
		$tgl=$this->gettgl($w,$t,$b,$th);
		if($tgl->num_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}		
	}
	///bagin kamar deposit
	function total_cas($id_p){////tampa deposit
		$q = $this->get_all_deposit_cas($id_p);
		if ($q->num_rows()>0){
			$t=0;
			foreach($q->result() as $q1){
				$t = $t + ($q1->cas);
			}
			return $t;
		}else{
			return 0;
		}
	}
	function total_trans($id_p){////tampa deposit
		$q = $this->get_all_deposit_t($id_p);
		if ($q->num_rows()>0){
			$t=0;
			foreach($q->result() as $q1){
				$t = $t + ($q1->transfer);
			}
			return $t;
		}else{
			return 0;
		}
	}
	function total_allkamar($id_p){////KAMAR -DIsk 
		$q = $this->db->get_where('tbl_bill_hotel',array('id_p'=>$id_p));
		if ($q->num_rows()>0){
			$t=0;
			$ttc=0;
			foreach($q->result() as $q1){
		///===============================================================================================
		$am = $this->M_bill->getPriceRoom($q1->id,$q1->id_k);
		$dk=$q1->delkam;
		if($dk=='ya'){
			$hrgakam=0;
			
		}else{
			$hrgakam=$am->harga;
		
		}
		///===============================================================================================
				//$dtot=$am->harga+$q1->harga_bed+$q1->harga_ot;
				$disc=(int)$q1->disc;
				//$disc=0;
				$ttc=$ttc+$disc;
				$t = $t + ($hrgakam-$disc);
			}
			//return $t;
			return $t;
		}else{
			return 0;
		}
	}
	function total_allkamarnodisc($id_p){////KAMAR -DIsk 
		$q = $this->db->get_where('tbl_bill_hotel',array('id_p'=>$id_p));
		if ($q->num_rows()>0){
			$t=0;
			$ttc=0;
			foreach($q->result() as $q1){
		///===============================================================================================
		$am = $this->M_bill->getPriceRoom($q1->id,$q1->id_k);
		$dk=$q1->delkam;
		if($dk=='ya'){
			$hrgakam=0;
			
		}else{
			$hrgakam=$am->harga;
		
		}
		$t=$t+$hrgakam;
			}
			return $t;
		}else{
			return 0;
		}
	}
	function total_allbed($id_p){////BED
		$q = $this->db->get_where('tbl_bill_hotel',array('id_p'=>$id_p));
		if ($q->num_rows()>0){
			$t=0;
			foreach($q->result() as $q1){
				//$am =$q ->row();
				$t = $t + ($q1->harga_bed);
			}
			return $t;
		}else{
			return 0;
		}
	}
	function total_allot($id_p){////OT
		$q = $this->db->get_where('tbl_bill_hotel',array('id_p'=>$id_p));
		if ($q->num_rows()>0){
			$t=0;
			foreach($q->result() as $q1){
				//$am =$q ->row();
				$t = $t + ((int)$q1->harga_ot);
			}
			return $t;
		}else{
			return 0;
		}
	}
	function total_allerly($id_p){////EARLYs
		$q = $this->db->get_where('tbl_bill_hotel',array('id_p'=>$id_p));
		if ($q->num_rows()>0){
			$t=0;
			foreach($q->result() as $q1){
				//$am =$q ->row();
				if($q1->early==1){
					$am = $this->M_bill->getPriceRoom($q1->id,$q1->id_k);
					// $am = $this->Mhotel->cek_bill_kamar($q1->id_k)->row();
					$t = $t + ($am->harga/2);
				}else{
					$t=$t;
				}
				
			}
			return $t;
		}else{
			return 0;
		}
	}
	//////////////////////////////////////////////REV feb 17
	
	function get_deposit_pelunasan_get($id_p){
		$this->db->where('id_p',$id_p);	
		$this->db->where('total !=','ya');			
	return	$this->db->get('tbl_deposit');
		
	}
	function get_deposit_pelunasan_get_all($id_p){
		$this->db->where('id_p',$id_p);	
		//$this->db->where('total !=','ya');			
	return	$this->db->get('tbl_deposit');
		
	}
	function get_deposit_pelunasan($id_p){
		$q=$this->get_deposit_pelunasan_get($id_p);
	if ($q->num_rows()>0){
			$t=0;
			foreach($q->result() as $q1){
				$t = $t + $q1->cas + $q1->transfer;
				
			}
			return $t;
		}else{
			return 0;
		}
		
	}
	function get_deposit_pelunasan_all($id_p){
		$q=$this->get_deposit_pelunasan_get_all($id_p);
	if ($q->num_rows()>0){
			$t=0;
			foreach($q->result() as $q1){
				$t = $t + $q1->cas + $q1->transfer;
				
			}
			return $t;
		}else{
			return 0;
		}
		
	}
	//////REFUND
	function get_tagihankamr_dandapur($id_p){
	
	$h=$this->Mhotel->bill_hotel($id_p);////berdasarkan nama id pelanggan pertama ///di pk
	$h1=$this->db->get_where('tbl_tagihan',array('id_p'=>$id_p));
	$tot=0;

	$totdsc=0;

	foreach($h->result() as $hh){ 

	////''

	$dk=$hh->delkam;

	$am = $this->M_bill->getPriceRoom($hh->id,$hh->id_k);

	//

		if($dk=='ya'){

			$hrgakam=0;

			

		}else{

			$hrgakam=$am->harga;

		

		}

	//



	//// revisi Early Cek in  --------------------------------------------------------------------------

	$h_kam=$hrgakam;

		if($hh->early == 1){

			$bg_kam=($am->harga/2); ///rev haraga kamar tidak penaruh 11317

		}else{

			$bg_kam=0;

		}

	////-=================================================================================================
	$dtot=$hrgakam;

	$disc=$hh->disc; ///disc

	$hrgakamdisc=$hrgakam-$disc; ////harga kamar harus di disc masing

    	$tot=($tot+$hrgakamdisc+$hh->harga_bed+$hh->harga_ot+$bg_kam); ///total - dison
    	$totdsc=$totdsc+($dtot); ///discon-discon MEMBER (HARGA KAMAR DIKURANGI dISKON MASING2 )
    	$tottt=$tot;//kamar
    	//return $totdsc;///di tampilkan -------------------------------------hasil PEG

    	//

 	  } 

 	///jiaka ada tagihan
 	if($h1->num_rows() > 0){

		$tott=0;

	foreach($h1->result() as $hh1){ ///---------------------------------ADA TAGIHAN SELAIN KAMAR 

    	$tott=$tott+$hh1->harga; /////makanan
    	return $tott+$tottt;//-------------------------------------------------------------total amaunt bila tagihan dapur ada
 	  } 
	
	}else{
	return $tottt;//totall 	
	}
	
	}

	////GET DISC REFUND
	function get_disc_tagihankamr_dandapur($id_p){
	
	$h=$this->Mhotel->bill_hotel($id_p);////berdasarkan nama id pelanggan pertama ///di pk
	$h1=$this->db->get_where('tbl_tagihan',array('id_p'=>$id_p));
	$tot=0;

	$totdsc=0;

	foreach($h->result() as $hh){ 

	////''

	$dk=$hh->delkam;
	
	// $am = $this->M_bill->get_where('tbl_kamar',array('id_kamar'=>$hh->id_k))->row();
	$am = $this->M_bill->getPriceRoom($hh->id,$hh->id_k);

	//

		if($dk=='ya'){

			$hrgakam=0;

			

		}else{

			$hrgakam=$am->harga;

		

		}

	//



	//// revisi Early Cek in  --------------------------------------------------------------------------

	$h_kam=$hrgakam;

		if($hh->early == 1){

			$bg_kam=($am->harga/2); ///rev haraga kamar tidak penaruh 11317

		}else{

			$bg_kam=0;

		}

	////-=================================================================================================
	$dtot=$hrgakam;

	$disc=$hh->disc; ///disc

	$hrgakamdisc=$hrgakam-$disc; ////harga kamar harus di disc masing

    	$totdsc=$totdsc+($hrgakamdisc); ///discon-discon MEMBER (HARGA KAMAR DIKURANGI dISKON MASING2 )
    	

    	//

 	  } 
	return $totdsc;///di tampilkan -------------------------------------hasil PEG
 	
	}

}