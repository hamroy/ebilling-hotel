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
	function buatnota($cas){
		$this->db->where('boking','ya');
		$this->db->where('tipe',$cas);
		return $this->db->get('tbl_pesan_kamar');
	}
	function gettglpesakamar($id){
		$this->db->where('id',$id);
		return $this->db->get('tbl_pesan_kamar');
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
    		$this->db->order_by('cekout','acs');
    	//	$this->db->select_max('cekout');
		$this->db->where('id_p',$id_p);
		$this->db->where('id_k',$id_k);
		return $this->db->get('tbl_perpanjang');
	}
	function get_tbl_perpanjang_mak($id_p){
    		//$this->db->order_by('cekout','acs');
    		$this->db->select_max('cekout');
		$this->db->where('id_p',$id_p);
		return $this->db->get('tbl_perpanjang');
	}
	
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
	
	
	function cek_kamar(){
		//$this->db->where( 'cek','' );////bila 1 berarti kosong
		//$this->db->where( 'cek != ','terisi' );////bila 1 berarti kosong
		//$this->db->select('*');
		//$this->db->from('tbl_kamar,tbl_pesan_kamar');

       		 //$this->db->where('tbl_kamar.id_kamar = tbl_pesan_kamar.id_kamar');

		$this->db->order_by('id_kamar');
		return $this->db->get('tbl_kamar');
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
	function simpan_pesan($d){
		$this->db->insert('tbl_pesan_kamar',$d);
	}
	function simpan_refund_pesan($id,$d){
		$this->db->where('id',$id);
		$this->db->update('tbl_pesan_kamar',$d);
	}
	function simpan_tagihan($d){
		$this->db->insert('tbl_tagihan',$d);
	}
	function simpan_tagihan_bar($d){
		$this->db->insert('tbl_bar',$d);
	}
	function simpan_tagihan_e($id,$d){
		$this->db->where('id',$id);
		$this->db->update('tbl_tagihan',$d);
	}
	function simpan_deposit($d){
		$this->db->insert('tbl_deposit',$d);
	}
	function update_deposit($d,$id,$id_p){
		$this->db->where('id',$id);
		$this->db->where('id_p',$id_p);
		$this->db->update('tbl_deposit',$d);
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
	function up_perpanjangan($d){
		//$this->db->where('id_kamar',$id);
		$this->db->insert('tbl_perpanjang',$d);
	}
	function up_bill_hotel($d){
		//$this->db->where('id_kamar',$id);
		$this->db->insert('tbl_bill_hotel',$d);
	}
	/////////////refund
	function simpan_up_refund($id,$d){
		$this->db->where('id_p',$id);
		$this->db->update('tbl_lap_refund',$d);
	}
	function simpan_refund($d){
		//$this->db->where('id_kamar',$id);
		$this->db->insert('tbl_lap_refund',$d);
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
	
	function up_bed($d,$id){
		$this->db->where('id',$id);
		$this->db->update('tbl_bill_hotel',$d);
	}
	
	function lunas($id,$da){ ///id_p ///kas/noncas
		
		$g=$this->db->get_where('tbl_pesan_kamar',array('id'=>$id))->row();
		$depo=$g->tipe;
		$adepo=$depo;
		if($da=='Lunas'){
			
		
		switch ($g->nota){
			case 'K':
			break;
			case 'N':
			break;
			case '':
			break;
		}
		if(!empty($g->nota)){
			$h_nota=$g->nota;
		}else{
		$n_row=$this->cek_nota_n()->num_rows();////T / N
		$c_row=$this->cek_nota()->num_rows();////C ??K
		
	switch ($depo) {
           
            case 'K':
             if($c_row>0){
			$h_nota=$c_row+1;		
		}else{
			$h_nota=1;
		}	
             break;
             case 'N':
                 
             	if($n_row>0){
			$h_nota=$n_row+1;		
		}else{
			$h_nota=1;
		}	
		//////////////////////////////////////// harus revisi karena bila kosong maka nota kosong ==coba di buat 
                break;
                case '':
         		$h_nota='kosong';    
	
                break;
        }
		
		}////antara ambil dan creat
		} else{ ///ANTARA LUNAS DAN TIDAK BILA LUNAS BUAT NOTA...JIKA TIDAK YA TIDAK BUAT.
		
			$h_nota='';
			//$adepo='';
		/////bila status jadi tagihan id tanggala jai null
		$dd=array(
	
		'shift' =>'',
		'id_tgl' =>'',
		
					
		);
		$this->db->where('id',$id);
		$this->db->update('tbl_pesan_kamar',$dd);
			
		}
		$d=array(
		'status'=>$da,
		'nota'=>$h_nota,
		//'shift' =>$this->session->userdata('sip'),
		//'id_tgl' => $this->session->userdata('id_tgl'),
		'tipe'=>$adepo,///cass=K |||| noncas=0
					
		);
		$this->db->where('id',$id);
		$this->db->update('tbl_pesan_kamar',$d);
	}

	
	function tgldeposit($id){
		
		$g=$this->db->get_where('tbl_pesan_kamar',array('id'=>$id))->row();
		
		$d=array(
	
		'shift' =>$this->session->userdata('sip'),
		'id_tgl' => $this->session->userdata('id_tgl'),
		
					
		);
		$this->db->where('id',$id);
		$this->db->update('tbl_pesan_kamar',$d);
		
	}
	function tgldeposittagihan($id){
		
		$g=$this->db->get_where('tbl_pesan_kamar',array('id'=>$id))->row();
		
		$d=array(
	
		'shift' =>$this->session->userdata('sip'),
		'id_tgl' => $this->session->userdata('id_tgl'),
		
					
		);
		$this->db->where('id_p',$id);
		$this->db->update('tbl_tagihan',$d);
		
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
	function lunastagihan($id,$da){
		/*$y=$this->db->get_where('tbl_pesan_kamar',array('id',$id));
		if($y->row()->tipe=='K'){
			$dati='C';
			
		}else{
				$dati='T';
			} 
		//$d=array('status'=>$da,'tipe'=>$dati); */
		$d=array('status'=>$da);
		$this->db->where('id_p',$id);
		$this->db->update('tbl_tagihan',$d);
	}
	
	//////update kolom status di refund
	function lunasrefund($id,$da){
		
		$d=array('status'=>$da);
		$this->db->where('id_p',$id);
		$this->db->update('tbl_lap_refund',$d);
	}
	function okrefund($id,$da){
		
		$d=array('refund'=>$da);
		$this->db->where('id',$id);
		$this->db->update('tbl_pesan_kamar',$d);
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
		function delkamar($f,$id){
		//$d=array('status'=>'Lunas');
		$this->db->where('id',$id);
		$this->db->update('tbl_bill_hotel',$f);
	}
		function hapus_tagihan($id){
		//$d=array('status'=>'Lunas');
		$this->db->where('id',$id);
		$this->db->delete('tbl_tagihan');
	}
	function cek_nota(){
		
		$this->db->where('tipe','K');
		$this->db->where('status','Lunas');
		return $this->db->get('tbl_pesan_kamar');
	}
	
	function cek_nota_n(){
		
		$this->db->where('tipe','N');
		$this->db->where('boking','no');
		$this->db->where('status','Lunas');
		return $this->db->get('tbl_pesan_kamar');
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
	function cari_id_dep($id,$id_p){
		
		$query = $this->db->get_where('tbl_deposit', array('id' => $id,'id_p'=>$id_p));
		
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
	////////////////DEPOSIT PELUNASAN
	function get_all_deposit_total($id_p){
		$this->db->where('id_p',$id_p);	
		$this->db->where('total !=','ya');			
		return $this->db->get('tbl_deposit');
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
//--------------revisi by masterpra-----------------01nov2016---------------


}