<?php

class Mhotel extends CI_Model {

    function __construct(){
        parent::__construct();
       // $this->load->model('Mpagu','',TRUE);
    }
    
    function id_last(){
    		$this->db->order_by('id','desc');
		return $this->db->get('tbl_pesan_kamar');
	}
	///////SM
	function id_last_sim(){
    		$this->db->order_by('id','desc');
		return $this->db->get('tbl_pesan_kamar_sim');
	}
	function buatnota($cas){
		$this->db->where('boking','ya');
		$this->db->where('tipe',$cas);
		return $this->db->get('tbl_pesan_kamar');
	}
	
	///
	function getnotanama($id){
		$this->db->where('id',$id);
		return $this->db->get('tbl_ket_nota')->row()->nama_nota;
	}
	//
	function gettglpesakamar($id){
		$this->db->where('id',$id);
		return $this->db->get('tbl_pesan_kamar');
	}
	
	function gettglpesakamar_sim($id){
		$this->db->where('id',$id);
		return $this->db->get('tbl_pesan_kamar_sim');
	}
	function getjenis_kamar(){ ///hotel rev 4/2/17
		//$this->db->where('id',$id);
		return $this->db->get('tbl_jenis_kamar');
	}
	function gettgltagihan($id){
		$this->db->where('id_d',$id);
		return $this->db->get('tbl_tagihan');
	}
	function get_tbl_perpanjang($id_k,$id_p){
    	//$this->db->order_by('cekout','acs');
    		$this->db->select_max('cekout');
		$this->db->where('id_p',$id_p);
		$this->db->where('id_k',$id_k);
		return $this->db->get('tbl_perpanjang');
	}
	
	////_sim
	function get_tbl_perpanjang_sim($id_k,$id_p){
    	//$this->db->order_by('cekout','acs');
    		$this->db->select_max('cekout');
		$this->db->where('id_p',$id_p);
		$this->db->where('id_k',$id_k);
		return $this->db->get('tbl_perpanjang_sim');
	}
	//=======================================================REv 17
	function get_tbl_perpanjang_mak_new_idk($id_k,$id_p){
    	//$this->db->order_by('cekout','acs');
    		$this->db->select_max('sort_t');
		$this->db->where('id_p',$id_p);
		$this->db->where('id_k',$id_k);
		return $this->db->get('tbl_bill_hotel');
	}
	
	//=======================================================REv 17
	function get_tbl_perpanjang_mak_new_idk_sim($id_k,$id_p){
    	//$this->db->order_by('cekout','acs');
    		$this->db->select_max('sort_t');
		$this->db->where('id_p',$id_p);
		$this->db->where('id_k',$id_k);
		return $this->db->get('tbl_bill_hotel_sim');
	}
	///=================REV 17
	function get_tbl_perpanjang_mak_new($id_p){
    		//$this->db->order_by('cekout','acs');
    	$this->db->select_max('sort_t');
		$this->db->where('id_p',$id_p);
		return $this->db->get('tbl_bill_hotel');
	}
	///=================REV 10417
	function get_tbl_perpanjang_mak_new_sim($id_p){
    		//$this->db->order_by('cekout','acs');
    	$this->db->select_max('sort_t');
		$this->db->where('id_p',$id_p);
		return $this->db->get('tbl_bill_hotel_sim');
	}
	//=========================================REv 17
	function get_tbl_bill_tgl_min($id_p){
    		//$this->db->order_by('cekout','acs');
    	$this->db->select_min('sort_t');
		$this->db->where('id_p',$id_p);
		return $this->db->get('tbl_bill_hotel');
	}
	////////////////REV 10417
	function get_tbl_bill_tgl_min_sim($id_p){
    		//$this->db->order_by('cekout','acs');
    	$this->db->select_min('sort_t');
		$this->db->where('id_p',$id_p);
		return $this->db->get('tbl_bill_hotel_sim');
	}
	///=====================================REV 17
	function getperbaikannokamar($id_p){
		$this->db->where('id_p',$id_p);
		return $this->db->get('tbl_bill_hotel');
	}
	///=====================================REV 17
	function getperbaikannokamar_sim($id_p){
		$this->db->where('id_p',$id_p);
		return $this->db->get('tbl_bill_hotel_sim');
	}
	//////////////////============================
	function get_tbl_perpanjang_mak($id_p){
    		//$this->db->order_by('cekout','acs');
    	$this->db->select_max('cekout');
		$this->db->where('id_p',$id_p);
		return $this->db->get('tbl_perpanjang');
	}
	//////////////////============================
	function get_tbl_perpanjang_mak_sim($id_p){
    		//$this->db->order_by('cekout','acs');
    	$this->db->select_max('cekout');
		$this->db->where('id_p',$id_p);
		return $this->db->get('tbl_perpanjang_sim');
	}
	///////////////////=====================================
	
	
	function cek_bill_kamar($id_kamar){
    		//$this->db->order_by('id_kamar','desc');
    		$this->db->where('id_kamar',$id_kamar);
		return $this->db->get('tbl_kamar');
	}
	function bill_hotel($id_p){ ////yang di tampilkandalam pengulangan
    		
    		$this->db->order_by('sort_t','asc');
    		//$this->db->order_by('id_k','asc');
    		
    		$this->db->order_by('id','asc');
    		$this->db->order_by('id_k','asc');
    		$this->db->where('id_p',$id_p);
		return $this->db->get('tbl_bill_hotel');
	}
	////bill_hotel_sim sim
	function bill_hotel_sim($id_p){ ////yang di tampilkandalam pengulangan
    		
    		$this->db->order_by('sort_t','asc');
    		//$this->db->order_by('id_k','asc');
    		
    		$this->db->order_by('id','asc');
    		$this->db->order_by('id_k','asc');
    		$this->db->where('id_p',$id_p);
		return $this->db->get('tbl_bill_hotel_sim');
	}
	
	
	function cek_kamar(){
		//$this->db->where( 'cek','' );////bila 1 berarti kosong
		//$this->db->where( 'cek != ','terisi' );////bila 1 berarti kosong
		//$this->db->select('*');
		//$this->db->from('tbl_kamar,tbl_pesan_kamar');

       		 //$this->db->where('tbl_kamar.id_kamar = tbl_pesan_kamar.id_kamar');

		$this->db->order_by('id_kamar');
		return $this->db->get('tbl_kamar');
	}
	function daftar_tunggakan(){
		//$this->db->where( 'cek','' );////bila 1 berarti kosong
		//$this->db->where( 'cek != ','terisi' );////bila 1 berarti kosong
		//$this->db->select('*');
		//$this->db->from('tbl_kamar,tbl_pesan_kamar');

       		 //$this->db->where('tbl_kamar.id_kamar = tbl_pesan_kamar.id_kamar');
       	$this->db->where('status','tunggakan');

		$this->db->order_by('id_tgl','ASC');
		return $this->db->get('tbl_tunggakan');
	}
	function up_cek_kamar($f,$id){
		$this->db->where('id_kamar',$id);//
		 $this->db->update('tbl_kamar',$f);
	}
	function cek_kamar_bok(){
		//$this->db->where( 'cek','' );////bila 1 berarti kosong
		//$this->db->where( 'cek != ','terisi' );////bila 1 berarti kosong
		//$this->db->select('*');
		//$this->db->from('tbl_kamar,tbl_pesan_kamar');

       		 //$this->db->where('tbl_kamar.id_kamar = tbl_pesan_kamar.id_kamar');
       		 $this->db->where('boking','ya');

		$this->db->order_by('id');
		return $this->db->get('tbl_pesan_kamar');
	}
	function get_nama(){
		//$this->db->where( 'cek','' );////bila 1 berarti kosong
		//$this->db->where( 'cek != ','terisi' );////bila 1 berarti kosong
		$this->db->group_by('nama');
		return $this->db->get('tbl_pesan_kamar');
	}
	function cek_kamar_no(){
		//$this->db->where( 'cek','' );////bila 1 berarti kosong
		$this->db->order_by('id_kamar');
		$this->db->group_by('jenis_kamar');
		$this->db->where( 'cek != ','terisi' );////bila 1 berarti kosong
		return $this->db->get('tbl_kamar');
	}
	function cek_kamar_no_pa(){///drpdown paviliun
		//$this->db->where( 'cek','' );////bila 1 berarti kosong
		$this->db->order_by('id_kamar');
		$this->db->where( 'cek != ','terisi' );////bila 1 berarti kosong
		$this->db->where( 'jenis_kamar ','paviliun' );////bila 1 berarti kosong
		return $this->db->get('tbl_kamar');
	}
	function cek_kamar_no_pa_all(){///drpdown paviliun
		//$this->db->where( 'cek','' );////bila 1 berarti kosong
		$this->db->order_by('id_kamar');
		//$this->db->where( 'cek != ','terisi' );////bila 1 berarti kosong
		$this->db->where( 'jenis_kamar ','paviliun' );////bila 1 berarti kosong
		return $this->db->get('tbl_kamar');
	}
	function cek_kamar_no_pa_id($id){///drpdown paviliun
		//$this->db->where( 'cek','' );////bila 1 berarti kosong
		$this->db->order_by('id_kamar');
		$this->db->where( 'id_p',$id );
		$this->db->where( 'cek = ','terisi' );
		$this->db->where( 'jenis_kamar ','paviliun' );////bila 1 berarti kosong
		return $this->db->get('tbl_kamar');
	}
	function cek_kamar_no_js(){///drpdown junior s
		//$this->db->where( 'cek','' );////bila 1 berarti kosong
		$this->db->order_by('id_kamar');
		$this->db->where( 'cek != ','terisi' );////bila 1 berarti kosong
		$this->db->where( 'jenis_kamar ','junior suite' );////bila 1 berarti kosong
		return $this->db->get('tbl_kamar');
	}
	function cek_kamar_no_js_all(){///drpdown junior s
		//$this->db->where( 'cek','' );////bila 1 berarti kosong
		$this->db->order_by('id_kamar');
		//$this->db->where( 'cek != ','terisi' );////bila 1 berarti kosong
		$this->db->where( 'jenis_kamar ','junior suite' );////bila 1 berarti kosong
		return $this->db->get('tbl_kamar');
	}
	function cek_kamar_no_js_id($id){///drpdown junior s
		//$this->db->where( 'cek','' );////bila 1 berarti kosong
		$this->db->order_by('id_kamar');
		$this->db->where( 'id_p',$id );
		$this->db->where( 'cek = ','terisi' );
		$this->db->where( 'jenis_kamar ','junior suite' );////bila 1 berarti kosong
		return $this->db->get('tbl_kamar');
	}
	function cek_kamar_no_f(){///drpdown FAMILY
		//$this->db->where( 'cek','' );////bila 1 berarti kosong
		$this->db->order_by('id_kamar');
		$this->db->where( 'cek != ','terisi' );////bila 1 berarti kosong
		$this->db->where( 'jenis_kamar ','Famliy room' );////bila 1 berarti kosong
		return $this->db->get('tbl_kamar');
	}
	function cek_kamar_no_fall(){///drpdown FAMILY
		//$this->db->where( 'cek','' );////bila 1 berarti kosong
		$this->db->order_by('id_kamar');
		//$this->db->where( 'cek != ','terisi' );////bila 1 berarti kosong
		$this->db->where( 'jenis_kamar ','Famliy room' );////bila 1 berarti kosong
		return $this->db->get('tbl_kamar');
	}
	function cek_kamar_no_f_id($id){///drpdown FAMILY
		//$this->db->where( 'cek','' );////bila 1 berarti kosong
		$this->db->order_by('id_kamar');
		$this->db->where( 'id_p',$id );
		$this->db->where( 'cek = ','terisi' );
		$this->db->where( 'jenis_kamar ','Famliy room' );////bila 1 berarti kosong
		return $this->db->get('tbl_kamar');
	}
	function cek_kamar_no_db(){///drpdown d belakang
		//$this->db->where( 'cek','' );////bila 1 berarti kosong
		$this->db->order_by('id_kamar');
		$this->db->where( 'cek != ','terisi' );////bila 1 berarti kosong
		$this->db->where( 'jenis_kamar ','Deluxe Belakang' );////bila 1 berarti kosong
		return $this->db->get('tbl_kamar');
	}
	function cek_kamar_no_db_all(){///drpdown d belakang
		//$this->db->where( 'cek','' );////bila 1 berarti kosong
		$this->db->order_by('id_kamar');
		//$this->db->where( 'cek != ','terisi' );////bila 1 berarti kosong
		$this->db->where( 'jenis_kamar ','Deluxe Belakang' );////bila 1 berarti kosong
		return $this->db->get('tbl_kamar');
	}
	function cek_kamar_no_db_id($id){///drpdown d belakang
		//$this->db->where( 'cek','' );////bila 1 berarti kosong
		$this->db->order_by('id_kamar');
		$this->db->where( 'cek = ','terisi' );
		$this->db->where( 'id_p',$id );
		$this->db->where( 'jenis_kamar ','Deluxe Belakang' );////bila 1 berarti kosong
		return $this->db->get('tbl_kamar');
	}
	function cek_kamar_no_dd($idjkam){///drpdown d Depan
		//$this->db->where( 'cek','' );////bila 1 berarti kosong
		$this->db->order_by('id_kamar');
		$this->db->where( 'cek != ','terisi' );////bila 1 berarti kosong
		//$this->db->where( 'jenis_kamar ','Deluxe Depan' );////bila 1 berarti kosong
		$this->db->where( 'id_jkamar ',$idjkam );////sekaragpakeid jeis kamar
		return $this->db->get('tbl_kamar');
	}
	function cek_kamar_no_dd_all($idjkam){///drpdown d Depan
		//$this->db->where( 'cek','' );////bila 1 berarti kosong
		$this->db->order_by('id_kamar');
		//$this->db->where( 'cek != ','terisi' );////bila 1 berarti kosong
		//$this->db->where( 'jenis_kamar ','Deluxe Depan' );////bila 1 berarti kosong
		$this->db->where( 'id_jkamar ',$idjkam );////sekaragpakeid jeis kamar
		return $this->db->get('tbl_kamar');
	}
	function cek_kamar_no_dd_id($id){///drpdown d Depan
		//$this->db->where( 'cek','' );////bila 1 berarti kosong
		$this->db->order_by('id_kamar');
		$this->db->where( 'id_p',$id );
		$this->db->where( 'cek = ','terisi' );////bila 1 berarti kosong
		//$this->db->where( 'id_jkamar ',$idjkam );////sekaragpakeid jeis kamar
		return $this->db->get('tbl_kamar');
	}
	
	function cek_kamar_no_dd_id_sim($id){///drpdown d Depan
		//$this->db->where( 'cek','' );////bila 1 berarti kosong
		$this->db->order_by('id_k');
		$this->db->where( 'id_p',$id );
		return $this->db->get('tbl_bill_hotel_sim');
	}
	function simpan_pesan($d){
		$this->db->insert('tbl_pesan_kamar',$d);
	}
	//=================================simpan_pesan_sim
	function simpan_pesan_sim($d){
		$this->db->insert('tbl_pesan_kamar_sim',$d);
	}
	
	function simpan_refund_pesan($id,$d){
		$this->db->where('id',$id);
		$this->db->update('tbl_pesan_kamar',$d);
	}
	//_sim
	function simpan_refund_pesan_sim($id,$d){
		$this->db->where('id',$id);
		$this->db->update('tbl_pesan_kamar_sim',$d);
	}
	function simpan_tagihan($d){
		$this->db->insert('tbl_tagihan',$d);
	}
	
	////////////////////REV ilahm
	
	function simpan_tagihan_sim_mod($d){
		$this->db->insert('tbl_tagihan_sim',$d);
	}
	
	
	
	function simpan_tagihan_bar($d){
		//$this->db->insert('tbl_bar',$d);
		///.....REV di gabung ke tbl tagihan
		$this->db->insert('tbl_tagihan',$d);
	}
	function insert_tunggakan($d){
		//$this->db->insert('tbl_bar',$d);
		///.....REV di gabung ke tbl tagihan
		$this->db->insert('tbl_tunggakan',$d);
	}
	function simpan_tagihan_e($id,$d){
		$this->db->where('id',$id);
		$this->db->update('tbl_tagihan',$d);
	}
	///_sim
	
	function simpan_tagihan_e_sim($id,$d){
		$this->db->where('id',$id);
		$this->db->update('tbl_tagihan_sim',$d);
	}
	function simpan_deposit($d){
		$this->db->insert('tbl_deposit',$d);
	}

	////SIm
	function simpan_deposit_sim($d){
		$this->db->insert('tbl_deposit_sim',$d);
	}
	function update_deposit($d,$id){
		$this->db->where('id',$id);
		//$this->db->where('id_p',$id_p);
		$this->db->update('tbl_deposit',$d);
		//$this->db->insert('tbl_deposit',$d);
	}
	/////////_sim
	function update_deposit_sim($d,$id){
		$this->db->where('id',$id);
		//$this->db->where('id_p',$id_p);
		$this->db->update('tbl_deposit_sim',$d);
		//$this->db->insert('tbl_deposit',$d);
	}
	/////UPDATE BOKING
	function simpan_pesan_up($d,$id){
		$this->db->where('id',$id);
		$this->db->update('tbl_pesan_kamar',$d);
		//$this->db->insert('tbl_deposit',$d);
	}
	
	function up_cek_pesan($d,$id){
		$this->db->where('id_kamar',$id);
		$this->db->update('tbl_kamar',$d);
	}
	function up_perpanjangan_a($d,$id){
		$this->db->where('id_k',$id);
		$this->db->update('tbl_perpanjang',$d);
	}
	///SIM
	function up_perpanjangan_a_sim($d,$id){
		$this->db->where('id_k',$id);
		$this->db->update('tbl_perpanjang_sim',$d);
	}
	function up_perpanjangan($d){
		//$this->db->where('id_kamar',$id);
		$this->db->insert('tbl_perpanjang',$d);
	}
	////////////////////////////===========sim
	function up_perpanjangan_sim($d){
		//$this->db->where('id_kamar',$id);
		$this->db->insert('tbl_perpanjang_sim',$d);
	}
	function up_bill_hotel($d){
		//$this->db->where('id_kamar',$id);
		$this->db->insert('tbl_bill_hotel',$d);
	}
	
	///////////===========================================
	function up_bill_hotel_sim($d){
		//$this->db->where('id_kamar',$id);
		$this->db->insert('tbl_bill_hotel_sim',$d);
	}
	/////////////refund
	function simpan_up_refund($id,$d){
		$this->db->where('id_p',$id);
		$this->db->update('tbl_lap_refund',$d);
	}
	
	/////////////refund _sim
	function simpan_up_refund_sim($id,$d){
		$this->db->where('id_p',$id);
		$this->db->update('tbl_lap_refund_sim',$d);
	}
	function simpan_refund($d){
		//$this->db->where('id_kamar',$id);
		$this->db->insert('tbl_lap_refund',$d);
	}
	//_sim
	function simpan_refund_sim($d){
		//$this->db->where('id_kamar',$id);
		$this->db->insert('tbl_lap_refund_sim',$d);
	}
	/////////////refund
	function cek_refund($id){
		$t=$this->db->get_where('tbl_lap_refund',array('id_p'=>$id));
		if($t->num_rows() > 0){
			return TRUE;
		}else{
			return FALSE ;
		}
	
	}
	/////////////refund
	function cek_refund_sim($id){
		$t=$this->db->get_where('tbl_lap_refund_sim',array('id_p'=>$id));
		if($t->num_rows() > 0){
			return TRUE;
		}else{
			return FALSE ;
		}
	
	}
	/////////////refund
	function get_refund_via($id){
		$t=$this->db->get_where('tbl_lap_refund',array('id_p'=>$id));
		return $t ;
	
	}
	/////////////refund
	function get_refund_via_sim($id){
		$t=$this->db->get_where('tbl_lap_refund_sim',array('id_p'=>$id));
		return $t ;
	
	}
	/////////////refund REKAP
	function get_refund_viarekapcash($id){
		$t=$this->db->get_where('tbl_lap_refund',array('id_p'=>$id,'via'=>'cash'));
		return $t ;
	
	}
	
	/////////////refund REKAP
	function get_refund_viarekaptrans($id){
		$t=$this->db->get_where('tbl_lap_refund',array('id_p'=>$id,'via !='=>'cash'));
		return $t ;
	
	}
	
	function up_bed($d,$id){
		$this->db->where('id',$id);
		$this->db->update('tbl_bill_hotel',$d);
	}
	///SIM BED
	function up_bed_sim($d,$id){
		$this->db->where('id',$id);
		$this->db->update('tbl_bill_hotel_sim',$d);
	}
	
	function lunas($id,$da){ ///id_p ///Lunas dan Tagihan
		
		$g=$this->db->get_where('tbl_pesan_kamar',array('id'=>$id))->row();
		$depo=$g->tipe;
		
		if($da=='Lunas'){
		
		
		
		if(!empty($g->nota)){  ///YANG TETAP
			$h_nota=$g->nota;
			$adepo=$depo; ////NOta teatap
		}else{ ///MENGALAMI PERUBAHAN
		$n_row=$this->get_max_nota_n();///get mak nota ////rev feb 17
		$c_row=$this->get_max_nota();////C ??K
		
	switch ($depo) {
           
            case 'K':
             $h_nota=$c_row+1;
             $adepo=$depo;
            	 	break;
             case 'N':
              $h_nota=$n_row+1;
             $adepo=$depo;
		//////////////////////////////////////// harus revisi karena bila kosong maka nota kosong ==coba di buat 
         		   break;
          	  case '':
            //Ngambil Tipepembayaran terakhir di tbl deposit ====================REV 17
           // $gtpe=$this->Mhotel->get_all_deposit_notatipe($id); ///anya pelunasan
            $gtpe=$this->Mhotel->get_all_deposit_notatipe_tipe($id);
            if($gtpe->num_rows() >0){
			  $depo1=$gtpe->row()->tipe;
            	if($depo1=='T'){
					 $h_nota=$n_row+1;
            			  $adepo='N';
				}else{
					 $h_nota=$c_row+1;
            		 $adepo='K';
				}		
			}else{
				$h_nota='';
				$adepo='';
			}
          
				
                break;
        }
		
		}////antara ambil dan creat
		} else{ ///ANTARA LUNAS DAN TIDAK BILA LUNAS BUAT NOTA...JIKA TIDAK YA TIDAK BUAT.
		
			$h_nota='';
			$adepo='';
		/////bila status jadi tagihan id tanggala jai null
		$dd=array(
	
		'shift' =>'',
		'id_tgl' =>'',
		
					
		);
		$this->db->where('id',$id);
		$this->db->update('tbl_pesan_kamar',$dd);
			
		}
		//////AKHIR
		$d=array(
		'status'=>$da,
		'nota'=>$h_nota,
		'tipe'=>$adepo,///cass=K |||| noncas=0
					
		);
		$this->db->where('id',$id);
		$this->db->update('tbl_pesan_kamar',$d);
		/////
		
	}

///////////////$this->Mhotel->lunas($id_p,'Lunas'); SIm
	function lunas_sim($id,$da){ ///id_p ///Lunas dan Tagihan
		
		$g=$this->db->get_where('tbl_pesan_kamar_sim',array('id'=>$id))->row();
		$depo=$g->tipe;
		
		if($da=='Lunas'){
		
		
		
		if(!empty($g->nota)){  ///YANG TETAP
			$h_nota=$g->nota;
			$adepo=$depo; ////NOta teatap
		}else{ ///MENGALAMI PERUBAHAN
		$n_row=$this->get_max_nota_n_sim();///get mak nota ////rev feb 17
		$c_row=$this->get_max_nota_sim();////C ??K
		
	switch ($depo) {
           
            case 'K':
             $h_nota=$c_row+1;
             $adepo=$depo;
            	 	break;
             case 'N':
              $h_nota=$n_row+1;
             $adepo=$depo;
		//////////////////////////////////////// harus revisi karena bila kosong maka nota kosong ==coba di buat 
         		   break;
          	  case '':
            
            $gtpe=$this->Mhotel->get_all_deposit_notatipe_tipe_sim($id);
            if($gtpe->num_rows() >0){
			  $depo1=$gtpe->row()->tipe;
            	if($depo1=='T'){
					 $h_nota=$n_row+1;
            			  $adepo='N';
				}else{
					 $h_nota=$c_row+1;
            		 $adepo='K';
				}		
			}else{
				$h_nota='';
				$adepo='';
			}
          
				
                break;
        }
		
		}////antara ambil dan creat
		} else{ ///ANTARA LUNAS DAN TIDAK BILA LUNAS BUAT NOTA...JIKA TIDAK YA TIDAK BUAT.
		
			$h_nota='';
			$adepo='';
		/////bila status jadi tagihan id tanggala jai null
		$dd=array(
	
		'shift' =>'',
		'id_tgl' =>'',
		
					
		);
		$this->db->where('id',$id);
		$this->db->update('tbl_pesan_kamar_sim',$dd);
			
		}
		//////AKHIR
		$d=array(
		'status'=>$da,
		'nota'=>$h_nota,
		'tipe'=>$adepo,///cass=K |||| noncas=0
					
		);
		$this->db->where('id',$id);
		$this->db->update('tbl_pesan_kamar_sim',$d);
		/////
		
	}

	
	function tgldeposit($id){
		
		$g=$this->db->get_where('tbl_pesan_kamar',array('id'=>$id))->row();
		
		$d=array(
		'id_user' => $this->session->userdata('id_user'),
		'shift' =>$this->session->userdata('sip'),
		'id_tgl' => $this->session->userdata('id_tgl'),
		
					
		);
		$this->db->where('id',$id);
		$this->db->update('tbl_pesan_kamar',$d);
		
	}
	function tgldeposit_sim($id){
		
		$g=$this->db->get_where('tbl_pesan_kamar_sim',array('id'=>$id))->row();
		
		$d=array(
		'id_user' => $this->session->userdata('id_user'),
		'shift' =>$this->session->userdata('sip'),
		'id_tgl' => $this->session->userdata('id_tgl'),
		
					
		);
		$this->db->where('id',$id);
		$this->db->update('tbl_pesan_kamar_sim',$d);
		
	}
	function tgldeposittagihan($id){
		
		$g=$this->db->get_where('tbl_pesan_kamar',array('id'=>$id))->row();
		
		$d=array(
		'id_user' => $this->session->userdata('id_user'),
		'shift' =>$this->session->userdata('sip'),
		'id_tgl' => $this->session->userdata('id_tgl'),
		
					
		);
		$this->db->where('id_p',$id);
		$this->db->update('tbl_tagihan',$d);
		
	}
	
	function tgldeposittagihan_sim($id){
		
		$g=$this->db->get_where('tbl_pesan_kamar_sim',array('id'=>$id))->row();
		
		$d=array(
		'id_user' => $this->session->userdata('id_user'),
		'shift' =>$this->session->userdata('sip'),
		'id_tgl' => $this->session->userdata('id_tgl'),
		
					
		);
		$this->db->where('id_p',$id);
		$this->db->update('tbl_tagihan_sim',$d);
		
	}
	function lunas_old($id,$da,$depo){
		$c=$this->cek_nota();
		$n=$this->cek_nota_n();
		//$c_row=1;
		$n_row=$this->cek_nota_n()->num_rows();////T / N
		$c_row=$this->cek_nota()->num_rows();////C ??K
		/*$n_row=1;
		foreach($n->result() as $nn){
			$n_row=1+$n_row;
		}
		
		foreach($c->result() as $kk){
			$c_row=1+$c_row;
		}
		*/
	if($da=='Lunas' and $depo=='K'){
		if($c_row>0){
	$c_rows=$c_row+1;		
		}else{
			$c_rows=1;
		}	
	
	if($depo=='K'){
		$kas='K';
	}else{
		$kas='';
	}
	
	}else{///lunas
	if($n_row>0){
	$n_rows=$n_row+1;		
		}else{
			$n_rows=1;
		}	
		//$c_rows=$n_row;
		$kas='N';
	}	
		$d=array(
		'status'=>$da,
		'nota'=>$c_rows,
		'tipe'=>$kas,///cass=K |||| noncas=0
					
		);
		$this->db->where('id',$id);
		$this->db->update('tbl_pesan_kamar',$d);
	}
	/////////update user di kamarr
	function update_user($d,$id){
		//$d=array('status'=>'Lunas');
		$this->db->where('id',$id);
		$this->db->update('tbl_pesan_kamar',$d);
	}
		
	/////////update user di kamarr SIM
	function update_user_sim($d,$id){
		//$d=array('status'=>'Lunas');
		$this->db->where('id',$id);
		$this->db->update('tbl_pesan_kamar_sim',$d);
	}
	function lunastagihan($id,$da){
	/*	$y=$this->db->get_where('tbl_pesan_kamar',array('id'=>$id));
		if($y->row()->tipe=='K'){
			$dati='K';
			
		}else{
			$dati='N';
			} 
		$d=array('status'=>$da,'tipe'=>$dati); //*/
		//=====================================rev di laporan langsung nembak ke tbl pesan kamar.
		$d=array('status'=>$da);
		$this->db->where('id_p',$id);
		$this->db->update('tbl_tagihan',$d);
	}
	function lunastagihan_sim($id,$da){
	
		//=====================================rev di laporan langsung nembak ke tbl pesan kamar.
		$d=array('status'=>$da);
		$this->db->where('id_p',$id);
		$this->db->update('tbl_tagihan_sim',$d);
	}
	
	function lunastunggakan($id,$da){
	/*	$y=$this->db->get_where('tbl_pesan_kamar',array('id'=>$id));
		if($y->row()->tipe=='K'){
			$dati='K';
			
		}else{
			$dati='N';
			} 
		$d=array('status'=>$da,'tipe'=>$dati); //*/
		//=====================================rev di laporan langsung nembak ke tbl pesan kamar.
		$d=array('status'=>$da);
		$this->db->where('id_p',$id);
		$this->db->update('tbl_tunggakan',$d);
	}
	
	//////update kolom status di refund
	function lunasrefund($id,$da){
		
		$d=array('status'=>$da);
		$this->db->where('id_p',$id);
		$this->db->update('tbl_lap_refund',$d);
	}
	function okrefund($id,$da){
		
		$d=array('refund'=>$da,'refund_status'=>'no');
		$this->db->where('id',$id);
		$this->db->update('tbl_pesan_kamar',$d);
	}
	function okrefund_sim($id,$da){
		
		$d=array('refund'=>$da,'refund_status'=>'no');
		$this->db->where('id',$id);
		$this->db->update('tbl_pesan_kamar_sim',$d);
	}
	function okrefundpas($id,$da){
		
		$d=array('refund'=>$da);
		$this->db->where('id',$id);
		$this->db->update('tbl_pesan_kamar',$d);
	}
	
	function okrefundpas_sim($id,$da){
		
		$d=array('refund'=>$da);
		$this->db->where('id',$id);
		$this->db->update('tbl_pesan_kamar_sim',$d);
	}
	///updatee tipe di tabel deposit
	
	function simpanperbahantipe($da,$id){
		//$d=array('status'=>'Lunas');
		$d=array('tipe'=>$da);
		$this->db->where('id',$id);
		$this->db->update('tbl_deposit',$d);
	}
	function hapus_bill($id){
		//$d=array('status'=>'Lunas');
		$this->db->where('id',$id);
		$this->db->delete('tbl_bill_hotel');
	}
	function hapus_bill_sim($id){
		//$d=array('status'=>'Lunas');
		$this->db->where('id',$id);
		$this->db->delete('tbl_bill_hotel_sim');
	}
	function hapus_bill_perpanjang($id_p,$id_k,$date){
		//$d=array('status'=>'Lunas');
		$this->db->where('id_p',$id_p);
		$this->db->where('id_k',$id_k);
		$this->db->where('cekout',$date+1);
		$this->db->delete('tbl_perpanjang');
	}
	function hapus_bill_perpanjang_sim($id_p,$id_k,$date){
		//$d=array('status'=>'Lunas');
		$this->db->where('id_p',$id_p);
		$this->db->where('id_k',$id_k);
		$this->db->where('cekout',$date+1);
		$this->db->delete('tbl_perpanjang_sim');
	}
	
		function delkamar($f,$id){
		//$d=array('status'=>'Lunas');
		$this->db->where('id',$id);
		$this->db->update('tbl_bill_hotel',$f);
	}
	/////SIm
	function delkamar_sim($f,$id){
		//$d=array('status'=>'Lunas');
		$this->db->where('id',$id);
		$this->db->update('tbl_bill_hotel_sim',$f);
	}
		function hapus_tagihan($id){
		//$d=array('status'=>'Lunas');
		$this->db->where('id',$id);
		$this->db->delete('tbl_tagihan');
	}
	///hapus_tagihan_sim_mod
		function hapus_tagihan_sim_mod($id){
		//$d=array('status'=>'Lunas');
		$this->db->where('id',$id);
		$this->db->delete('tbl_tagihan_sim');
	}
	//===========================================================================get nota
	function cek_nota(){
		$this->db->select('nota');
		$this->db->where('tipe','K');
		$this->db->where('status','Lunas');
		$this->db->where('boking','no');
		$this->db->where('nota !=','0');
		$this->db->order_by('nota ASC');
		return $this->db->get('tbl_pesan_kamar');
	}
	
	function cek_nota_sim(){
		$this->db->select('nota');
		$this->db->where('tipe','K');
		$this->db->where('status','Lunas');
		$this->db->where('boking','no');
		$this->db->where('nota !=','0');
		$this->db->order_by('nota ASC');
		return $this->db->get('tbl_pesan_kamar_sim');
	}
	
	function cek_nota_n(){
		$this->db->select('nota');
		$this->db->where('tipe','N');
		$this->db->where('status','Lunas');
		$this->db->where('boking','no');
		$this->db->order_by('nota ASC');
		$this->db->where('nota !=','0');
		return $this->db->get('tbl_pesan_kamar');
	}
	
	function cek_nota_n_sim(){
		$this->db->select('nota');
		$this->db->where('tipe','N');
		$this->db->where('status','Lunas');
		$this->db->where('boking','no');
		$this->db->order_by('nota ASC');
		$this->db->where('nota !=','0');
		return $this->db->get('tbl_pesan_kamar_sim');
	}
	
	function get_max_nota_n(){
		if($this->cek_nota_n()->num_rows() >0){
				foreach($this->cek_nota_n()->result() as $k){
					$n=$k->nota;	
				}
									
		}else{
			
$n=0;

		}
		return $n;
	}
	////SIM
	
	function get_max_nota_n_sim(){
		if($this->cek_nota_n_sim()->num_rows() >0){
				foreach($this->cek_nota_n_sim()->result() as $k){
					$n=$k->nota;	
				}
									
		}else{
			
$n=0;

		}
		return $n;
	}
	
	
	function get_max_nota(){
		if($this->cek_nota()->num_rows() >0){
					foreach($this->cek_nota()->result() as $kk){
					$n=$kk->nota;	
				}
				
		}else{
			
$n=0;

		}
		return $n;
	}
	
	
	function get_max_nota_sim(){
		if($this->cek_nota_sim()->num_rows() >0){
					foreach($this->cek_nota_sim()->result() as $kk){
					$n=$kk->nota;	
				}
				
		}else{
			
$n=0;

		}
		return $n;
	}
	
	
	
	
	function cari_cek($id){
		
		$query = $this->db->get_where('tbl_pesan_kamar', array('id' => $id));
		
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	function cekguesbill($id_p,$id_k){
		
		$query = $this->db->get_where('tbl_bill_hotel', array('id_p' => $id_p,'id_k' => $id_k));
		
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function cekguesbill_sim($id_p,$id_k){
		
		$query = $this->db->get_where('tbl_bill_hotel_sim', array('id_p' => $id_p,'id_k' => $id_k));
		
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	function cekguesbilltg($id_p,$id_k,$date){
		
		$query = $this->db->get_where('tbl_bill_hotel', array('id_p' => $id_p,'id_k' => $id_k,'sort_t' => $date));
		
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function cekguesbilltg_sim($id_p,$id_k,$date){
		
		$query = $this->db->get_where('tbl_bill_hotel_sim', array('id_p' => $id_p,'id_k' => $id_k,'sort_t' => $date));
		
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function cek_id_p_dbill($id_p){
		
		$query = $this->db->get_where('tbl_bill_hotel', array('id_p' => $id_p));
		
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	////SIM
	
	function cek_id_p_dbill_sim($id_p){
		
		$query = $this->db->get_where('tbl_bill_hotel_sim', array('id_p' => $id_p));
		
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	///
	function cari_pass($id){
		
		$query = $this->db->get_where('ueu_tbl_user', array('password' => $id));
		
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	function cari_id_dep($id){
		
		$query = $this->db->get_where('tbl_deposit', array('id' => $id));
		
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	////====================cari_id_dep_sim
	function cari_id_dep_sim($id){
		
		$query = $this->db->get_where('tbl_deposit_sim', array('id' => $id));
		
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	function cek_tanggal_perpanjangan($id_k,$id_p,$tgl){
		
		$query = $this->db->get_where('tbl_perpanjang', array('id_k' => $id_k,'id_p'=>$id_p,'cekout'=>$tgl));
		
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	
	function get_all_deposit($id_p){
		$this->db->where('id_p',$id_p);	
		//$this->db->where('total !=','ya');			
		return $this->db->get('tbl_deposit');
	}
	
	////
	function get_all_deposit_sim($id_p){
		$this->db->where('id_p',$id_p);	
		//$this->db->where('total !=','ya');			
		return $this->db->get('tbl_deposit_sim');
	}
	////TBL deposita ambil tipe
	function get_all_deposit_notatipe($id_p){
		$this->db->where('id_p',$id_p);	
		$this->db->where('total','ya');			
		$this->db->order_by('id','ASC');			
		return $this->db->get('tbl_deposit');
	}
	///SEMUA
	function get_all_deposit_notatipe_tipe($id_p){
		$this->db->where('id_p',$id_p);	
		$this->db->order_by('id','ASC');			
		return $this->db->get('tbl_deposit');
	}
	///SEMUA
	function get_all_deposit_notatipe_tipe_sim($id_p){
		$this->db->where('id_p',$id_p);	
		$this->db->order_by('id','ASC');			
		return $this->db->get('tbl_deposit_sim');
	}
	////////////////DEPOSIT PELUNASAN
	function get_all_deposit_total($id_p){
		$this->db->where('id_p',$id_p);	
		$this->db->where('total !=','ya');			
		return $this->db->get('tbl_deposit');
	}
	
	
	////////////////DEPOSIT PELUNASAN
	function get_all_deposit_total_sim($id_p){
		$this->db->where('id_p',$id_p);	
		$this->db->where('total !=','ya');			
		return $this->db->get('tbl_deposit_sim');
	}
	
	
		function temporary_payment($id_p){
		$this->db->where('id_p',$id_p);	
		$this->db->where('tipe','L');			
		$q = $this->db->get('tbl_deposit');
		if ($q->num_rows()>0){
			return $q->row()->cas;
		}else{
			return 0;
		}
		
	}
	function total_deposit($id_p){////pake
		$q = $this->get_all_deposit_total($id_p);
		if ($q->num_rows()>0){
			$t=0;
			foreach($q->result() as $q1){
				$t = $t + ($q1->cas + $q1->transfer);
			}
			return $t;
		}else{
			return 0;
		}
	}
	
	//_sim
	function total_deposit_sim($id_p){////pake
		$q = $this->get_all_deposit_total_sim($id_p);
		if ($q->num_rows()>0){
			$t=0;
			foreach($q->result() as $q1){
				$t = $t + ($q1->cas + $q1->transfer);
			}
			return $t;
		}else{
			return 0;
		}
	}
	
	function total_all($id_p){////tampa total
		$q = $this->get_all_deposit($id_p);
		if ($q->num_rows()>0){
			$t=0;
			foreach($q->result() as $q1){
				$t = $t + ($q1->cas + $q1->transfer);
			}
			return $t;
		}else{
			return 0;
		}
	}
	///_sim
	function total_all_sim($id_p){////tampa total
		$q = $this->get_all_deposit_sim($id_p);
		if ($q->num_rows()>0){
			$t=0;
			foreach($q->result() as $q1){
				$t = $t + ($q1->cas + $q1->transfer);
			}
			return $t;
		}else{
			return 0;
		}
	}
		
	function total_aux($id_p){
		$this->db->where('id_p',$id_p);	
		
		$q = $this->db->get('tbl_tagihan');
		if ($q->num_rows()>0){
			$t=0;
			foreach($q->result() as $q1){
				$t = $t + $q1->harga;
			}
			return $t;
		}else{
			return 0;
		}
	}
	
	function total_aux_sim($id_p){
		$this->db->where('id_p',$id_p);	
		
		$q = $this->db->get('tbl_tagihan_sim');
		if ($q->num_rows()>0){
			$t=0;
			foreach($q->result() as $q1){
				$t = $t + $q1->harga;
			}
			return $t;
		}else{
			return 0;
		}
	}
	//--------------revisi by masterpra-----------------01nov2016---------------total payment
	function total_payment_lunas($id_p){
		$this->db->where('id_p',$id_p);	
		$this->db->where('total','ya');			
		$q = $this->db->get('tbl_deposit');
		if ($q->num_rows()>0){
			if ($q->row()->cas==0){
				return $q->row()->transfer;
			}else{
				return $q->row()->cas;
			}
		
		}else{
			return 0;
		}
	}
	///------------------------------ilahm
	function total_payment_lunas_ilham($id_p){
		$this->db->where('id_p',$id_p);	
		$this->db->where('total','ya');			
		$q = $this->db->get('tbl_deposit');
		
		if ($q->num_rows()>0){
			$t=0;
			foreach($q->result() as $q1){
				$t = $t + $q1->cas+$q1->transfer;
			}
			return $t;
		}else{
			return 0;
		}
	}
	
	///------------------------------ilahm sim
	function total_payment_lunas_ilham_sim($id_p){
		$this->db->where('id_p',$id_p);	
		$this->db->where('total','ya');			
		$q = $this->db->get('tbl_deposit_sim');
		
		if ($q->num_rows()>0){
			$t=0;
			foreach($q->result() as $q1){
				$t = $t + $q1->cas+$q1->transfer;
			}
			return $t;
		}else{
			return 0;
		}
	}
//--------------revisi by masterpra-----------------01nov2016---------------

/*--------------------tambahan dari MASTERPRA 16MARET2017 ---------------------*/
	function save_book($d){
		$this->db->insert('tbl_booking',$d);
	}
/*--------------------tambahan dari MASTERPRA 16MARET2017 ---------------------*/

}