<?php
defined('BASEPATH') or exit('No direct script access allowed');



class C_resepsionis extends CI_Controller
{

	function __construct()
	{

		parent::__construct();

		$this->load->model('Minfo', '', TRUE);
		$this->load->model('Mhotel', '', TRUE);
		$this->load->model('Login_model', '', TRUE);
		$this->load->model('Madmin', '', TRUE);
		$this->load->model('M_bill');
	}



	public function index() ///not function

	{
		if ($this->session->userdata('login') == TRUE) {

			$q = $this->Minfo->info()->row();



			//

			$data['namapt'] = !empty($q->namapt) ? $q->namapt : $this->config->item('nameAPP');

			$data['logo'] = !empty($q->logo) ? $q->logo : 'logo';

			$data['main_view'] = 'resepsionis/awal';

			///

			$data['nama_app'] = $q->namapt;

			$data['title'] = $q->namapt;

			//

			$data['a'] = '';

			$data['b'] = $data['c'] = $data['d'] = '';

			$data['p'] = ''; //tambahan dari MASTERPRA 16MARET2017

			$this->load->view('resepsionis/beranda', $data);
		} else {

			redirect('login/simpeg');
		}
	}

	/////////TAGIHAN 

	public function tagihan() ///not function

	{
		if ($this->session->userdata('login') == TRUE) {

			//

			$q = $this->Minfo->info()->row();



			//

			$data['namapt'] = !empty($q->namapt) ? $q->namapt : $this->config->item('nameAPP');

			$data['logo'] = !empty($q->logo) ? $q->logo : 'logo';

			$data['main_view'] = 'resepsionis/input_tagihan';

			///

			$data['nama_app'] = $q->namapt;

			$data['title'] = $q->namapt;

			//

			//$q1=$this->db->get('tbl_pesan_kamar');

			$q1 = $this->Mhotel->get_nama();

			foreach ($q1->result() as $key) {

				//$data['kamar'][$key->id]=$key->jenis_kamar.'/'.$key->id_kamar; ///agama

				$data['nama'][$key->id] = $key->nama;
			}

			//

			$data['d'] = 'active';

			$data['b'] = $data['c'] = $data['a'] = $data['e'] = $data['f'] = $data['g'] = '';

			$data['p'] = ''; //tambahan dari MASTERPRA 16MARET2017

			//

			$this->load->view('resepsionis/beranda', $data);

			//

		} else {

			redirect('login/simpeg');
		}
	}

	///////CETAK

	public function viewcetak($id) ///di pake function

	{
		if ($this->session->userdata('login') == TRUE) {

			//

			$q = $this->Minfo->info()->row();



			//

			$data['namapt'] = !empty($q->namapt) ? $q->namapt : $this->config->item('nameAPP');

			$data['logo'] = !empty($q->logo) ? $q->logo : 'logo';

			$data['id_p'] = $id;

			$data['main_view'] = 'resepsionis/cetakawal';

			///

			$data['nama_app'] = $q->namapt;

			$data['title'] = $q->namapt;

			//

			//$q1=$this->db->get('tbl_pesan_kamar');

			$q1 = $this->Mhotel->get_nama();

			foreach ($q1->result() as $key) {

				//$data['kamar'][$key->id]=$key->jenis_kamar.'/'.$key->id_kamar; ///agama

				$data['nama'][$key->id] = $key->nama;
			}

			//

			$data['c'] = 'active';

			//$data['b']=$data['d']=$data['a']='';

			$data['aa'] = $data['a'] = '';

			$data['b'] = $data['d'] = $data['a1'] = $data['e'] = $data['f'] = $data['g'] = '';

			$data['p'] = ''; //tambahan dari MASTERPRA 16MARET2017

			//

			$this->load->view('resepsionis/beranda', $data);

			//

		} else {

			redirect('login/simpeg');
		}
	}

	/////CEK KAMAR

	public function cek_kam()

	{

		if ($this->session->userdata('login') == TRUE) {



			$q = $this->Minfo->info()->row();



			//

			$data['namapt'] = !empty($q->namapt) ? $q->namapt : $this->config->item('nameAPP');

			$data['logo'] = !empty($q->logo) ? $q->logo : 'logo';

			$data['main_view'] = 'resepsionis/cek_kamar';



			//

			$data['nama_app'] = $q->namapt;

			$data['title'] = $q->namapt;

			//

			$data['aa'] = $data['a'] = 'active';

			$data['b'] = $data['c'] = $data['d'] = $data['a1'] = $data['e'] = $data['f'] = $data['g'] = '';

			$data['p'] = ''; //tambahan dari MASTERPRA 16MARET2017

			//



			$data['q'] = $this->Mhotel->cek_kamar();

			$this->load->view('resepsionis/beranda', $data);
		} else {

			redirect('login/simpeg');
		}
	}

	/////////////////daf_tunggkan
	public function daf_tunggkan()

	{
		if ($this->session->userdata('login') == TRUE) {



			$q = $this->Minfo->info()->row();



			//

			$data['namapt'] = !empty($q->namapt) ? $q->namapt : $this->config->item('nameAPP');

			$data['logo'] = !empty($q->logo) ? $q->logo : 'logo';

			$data['main_view'] = 'resepsionis/daftar_tunggakan_kamar';



			//

			$data['nama_app'] = $q->namapt;

			$data['title'] = $q->namapt;

			//

			$data['aa'] = $data['a'] = '';

			$data['b'] = $data['c'] = $data['d'] = $data['a1'] = $data['e'] = $data['g'] = '';

			$data['f'] = 'active'; //tambahan dari MASTERPRA 16MARET2017

			//

			//$data['q']=$this->Mhotel->cek_kamar();
			$data['q'] = $this->Mhotel->daftar_tunggakan();

			$this->load->view('resepsionis/beranda', $data);
		} else {

			redirect('login/simpeg');
		}
	}

	/////////////CEK YANG BOKING KAMAR

	public function cek_boking()

	{
		if ($this->session->userdata('login') == TRUE) {

			$q = $this->Minfo->info()->row();



			//

			$data['namapt'] = !empty($q->namapt) ? $q->namapt : $this->config->item('nameAPP');

			$data['logo'] = !empty($q->logo) ? $q->logo : 'logo';

			$data['main_view'] = 'resepsionis/cek_boking_kamar';



			//

			$data['nama_app'] = $q->namapt;

			$data['title'] = $q->namapt;

			//

			$data['aa'] = $data['a1'] = $data['e'] = 'active';

			$data['b'] = $data['c'] = $data['d'] = $data['a'] = $data['e'] = $data['f'] = $data['g'] = '';

			$data['p'] = ''; //tambahan dari MASTERPRA 16MARET2017

			//



			$data['q'] = $this->Mhotel->cek_kamar_bok();

			$this->load->view('resepsionis/beranda', $data);
		} else {

			redirect('login/simpeg');
		}
	}



	///////PESAN KAMAR

	public function pesan_kam()

	{
		if ($this->session->userdata('login') == TRUE) {

			$q = $this->Minfo->info()->row();



			//

			$data['namapt'] = !empty($q->namapt) ? $q->namapt : $this->config->item('nameAPP');

			$data['logo'] = !empty($q->logo) ? $q->logo : 'logo';

			$data['main_view'] = 'resepsionis/pesan_kamar';

			//

			$data['nama_app'] = $q->namapt;

			$data['title'] = $q->namapt;

			//

			$data['b'] = 'active';

			$data['aa'] = $data['a'] = $data['a1'] = $data['c'] = $data['d'] = $data['e'] = $data['f'] = $data['g'] = '';

			$data['p'] = ''; //tambahan dari MASTERPRA 16MARET2017

			//

			$q1 = $this->Mhotel->cek_kamar_no();

			foreach ($q1->result() as $key) {

				//$data['kamar'][$key->id]=$key->jenis_kamar.'/'.$key->id_kamar; ///agama

				$data['kamar']['Pilih Jenis Kamar'][$key->id_kamar] = $key->jenis_kamar;
			}

			//

			$this->load->view('resepsionis/beranda', $data);
		} else {

			redirect('login/simpeg');
		}
	}

	///////////////////////////simulasi_kam
	public function simulasi_kam()

	{
		if ($this->session->userdata('login') == TRUE) {

			$q = $this->Minfo->info()->row();



			//

			$data['namapt'] = !empty($q->namapt) ? $q->namapt : $this->config->item('nameAPP');

			$data['logo'] = !empty($q->logo) ? $q->logo : 'logo';

			$data['main_view'] = 'resepsionis/pesan_kamar_simlasi';

			//

			$data['nama_app'] = $q->namapt;

			$data['title'] = $q->namapt;

			//

			$data['g'] = 'active';
			$data['aa'] = $data['a'] = $data['a1'] = $data['c'] = $data['d'] = $data['e'] = $data['b'] = $data['f'] = '';
			$data['p'] = ''; //tambahan dari MASTERPRA 16MARET2017

			//

			$q1 = $this->Mhotel->cek_kamar_no();

			foreach ($q1->result() as $key) {

				//$data['kamar'][$key->id]=$key->jenis_kamar.'/'.$key->id_kamar; ///agama

				$data['kamar']['Pilih Jenis Kamar'][$key->id_kamar] = $key->jenis_kamar;
			}

			//

			$this->load->view('resepsionis/beranda', $data);
		} else {

			redirect('login/simpeg');
		}
	}

	//////////BAR

	public function bar()

	{
		if ($this->session->userdata('login') == TRUE) {

			$q = $this->Minfo->info()->row();



			//

			$data['namapt'] = !empty($q->namapt) ? $q->namapt : $this->config->item('nameAPP');

			$data['logo'] = !empty($q->logo) ? $q->logo : 'logo';

			$data['main_view'] = 'resepsionis/pesan_bar';

			//

			$data['nama_app'] = $q->namapt;

			$data['title'] = $q->namapt;

			//

			$data['d'] = 'active';

			$data['aa'] = $data['a'] = $data['a1'] = $data['c'] = $data['b'] = $data['e'] = $data['g'] = $data['f'] = '';

			$data['p'] = ''; //tambahan dari MASTERPRA 16MARET2017

			//

			$q1 = $this->Mhotel->cek_kamar_no();

			foreach ($q1->result() as $key) {

				//$data['kamar'][$key->id]=$key->jenis_kamar.'/'.$key->id_kamar; ///agama

				$data['kamar']['Pilih Jenis Kamar'][$key->id_kamar] = $key->jenis_kamar;
			}

			//

			$this->load->view('resepsionis/beranda', $data);
		} else {

			redirect('login/simpeg');
		}
	}

	////////DEPOSIT



	public function deposit_bar()

	{
		if ($this->session->userdata('login') == TRUE) {

			$q = $this->Minfo->info()->row();



			//

			$data['namapt'] = !empty($q->namapt) ? $q->namapt : $this->config->item('nameAPP');

			$data['logo'] = !empty($q->logo) ? $q->logo : 'logo';

			$data['main_view'] = 'resepsionis/pesan_kamar_lain';

			//

			$data['nama_app'] = $q->namapt;

			$data['title'] = $q->namapt;

			//

			$data['c'] = 'active';

			$data['aa'] = $data['a'] = $data['a1'] = $data['d'] = $data['b'] = $data['e'] = $data['g'] = $data['f'] = '';

			$data['p'] = ''; //tambahan dari MASTERPRA 16MARET2017

			//

			$q1 = $this->Mhotel->cek_kamar_no();

			foreach ($q1->result() as $key) {

				//$data['kamar'][$key->id]=$key->jenis_kamar.'/'.$key->id_kamar; ///agama

				$data['kamar']['Pilih Jenis Kamar'][$key->id_kamar] = $key->jenis_kamar;
			}

			//

			$this->load->view('resepsionis/beranda', $data);
		} else {

			redirect('login/simpeg');
		}
	}

	////BILL-=======================================================================================================

	public function bill_kam($id_p, $sm = 'no')
	{

		if ($this->session->userdata('login') == TRUE) {
			$data['noedit'] = 'tdk';
			$data['id_user'] = 0;
			////////////////////////////////////////////////10417 //// simulasi_input data
			$data['sm'] = $sm;
			////////////////////////////////////////////////10417 //// simulasi_input data

			///////
			$q = $this->Minfo->info()->row();
			//
			//	$data['nama']=$nama;
			$data['id_p'] = $id_p;
			//=========================================================================================SIM 10417
			if ($sm == 'ya') {
				$data['h_row'] = $h_row = $this->db->get_where('tbl_pesan_kamar_sim', array('id' => $id_p))->row();
			} else {
				$data['h_row'] = $h_row = $this->db->get_where('tbl_pesan_kamar', array('id' => $id_p))->row();
			}
			//=========================================================================================SIM 10417

			//
			$data['nama_app'] = $q->namapt;
			$data['title'] = $q->namapt;
			//

			if ($sm == 'ya') {
				$kamar = $this->db->get_where('tbl_pesan_kamar_sim', array('id' => $id_p)); ////berdasarkan nama id pelanggan pertama
			} else {
				$kamar = $this->db->get_where('tbl_pesan_kamar', array('id' => $id_p)); ////berdasarkan nama id pelanggan pertama
			}

			//=========================================================================================================================
			//=========================================================================================SIM 10417
			if ($sm == 'ya') {
				$data['h'] = $h = $this->Mhotel->bill_hotel_sim($id_p); ////berdasarkan nama id pelanggan pertama ///di pk
			} else {
				$data['h'] = $h = $this->Mhotel->bill_hotel($id_p); ////berdasarkan nama id pelanggan pertama ///di pk
			}
			//=========================================================================================SIM 10417
			//=========================================================================================================================

			//=========================================================================================================================

			//=========================================================================================SIM 10417
			if ($sm == 'ya') {
				$data['h1'] = $h1 = $this->db->get_where('tbl_tagihan_sim', array('id_p' => $id_p));
			} else {
				$data['h1'] = $h1 = $this->db->get_where('tbl_tagihan', array('id_p' => $id_p));
			}
			//=========================================================================================SIM 10417

			//====================================================================================================================

			$data['namapt'] = !empty($q->namapt) ? $q->namapt : $this->config->item('nameAPP');
			$data['logo'] = !empty($q->logo) ? $q->logo : 'logo';

			///
			$data['lunas'] = $kamar->row()->status;
			////


			//=========================================================================================SIM 10417
			if ($sm == 'ya') {
				$dt = $this->db->get_where('tbl_deposit_sim', array('id_p' => $id_p));
				$id_dep_a = $this->db->get('tbl_deposit_sim')->num_rows();
			} else {
				$dt = $this->db->get_where('tbl_deposit', array('id_p' => $id_p));
				$id_dep_a = $this->db->get('tbl_deposit')->num_rows();
			}
			//=========================================================================================SIM 10417



			if ($dt->num_rows() > 0) {

				foreach ($dt->result() as $depo) {
				}

				$data['depo'] = empty($kamar->row()->tipe) ? '' : $kamar->row()->tipe;
			} else {

				$data['depo'] = '';
			}

			$data['totid'] = $id_dep_a;

			///=================cek idp di bill



			//=========================================================================================SIM 10417
			if ($sm == 'ya') {
				$cbill = $this->Mhotel->cek_id_p_dbill_sim($id_p);
			} else {
				$cbill = $this->Mhotel->cek_id_p_dbill($id_p);
			}
			//=========================================================================================SIM 10417	 

			////-------------------------------------------------------------------VIEW----------------------------------------------------

			if ($id_p != 0 and $cbill == TRUE) {

				$data['main_view'] = 'resepsionis/cek_bill9';
			} else {

				redirect('C_resepsionis/cek_kam');
			}



			//-----------------------------------------------------------MEnghitung JUmlah Tagihan-------------------------------------

			if ($id_p != NULL) {

				$tot = 0;

				$totdsc = 0;

				foreach ($h->result() as $hh) {

					////''

					$dk = $hh->delkam;

					$am = $this->M_bill->getPriceRoom($hh->id, $hh->id_k);
					//
					if ($dk == 'ya') {
						$hrgakam = 0;
					} else {
						$hrgakam = $am->harga;
					}
					//

					//// revisi Early Cek in  --------------------------------------------------------------------------
					$h_kam = $hrgakam;
					if ($hh->early == 1) {
						//$has_early=$h_kam+$bg_kam;
						$bg_kam = ($am->harga / 2); ///rev haraga kamar tidak penaruh 11317
					} else {
						$bg_kam = 0;
					}
					////-=================================================================================================

					//$bg_kam=0;
					$dtot = (int)$hrgakam;
					$disc = (int)$hh->disc; ///disc
					$hrgakamdisc = (int)$hrgakam - $disc; ////harga kamar harus di disc masing
					$tot = ($tot + $hrgakamdisc + (int)$hh->harga_bed + (int)$hh->harga_ot + (int)$bg_kam); ///total - dison
					//$totdsco=($hh->disc*$hrgakamdisc)/100; ///discon-discon MEMBER
					//$totdsc=$totdsc+($hrgakamdisc); ///discon-discon MEMBER (HARGA KAMAR DIKURANGI dISKON MASING2 )
					$totdsc = $totdsc + ($dtot); ///discon-discon MEMBER (HARGA KAMAR DIKURANGI dISKON MASING2 )
					$tottt = $tot; //kamar
					$data['totdisc'] = $totdsc; ///di tampilkan -------------------------------------hasil PEG
					//
				}

				if ($h1->num_rows() > 0) {
					$tott = 0;
					foreach ($h1->result() as $hh1) { ///---------------------------------ADA TAGIHAN SELAIN KAMAR 
						$tott = $tott + $hh1->harga; /////makanan
						$data['p_kamar'] = $tottt; //total ksmar aja aja -------------------------------------------KAMARSAJA
						$data['p'] = $tott + $tottt; //-------------------------------------------------------------total amaunt bila tagihan dapur ada

					}
				} else { //-----------------------------------------------------------------------TAGIHAN KAMAR SAJA

					$data['p'] = $tottt; //totall 
					$data['p_kamar'] = $tottt; //totall

				}
			}



			///////=====================================================================================================================
			//=========================================================================================SIM 10417
			if ($sm == 'ya') {
				$qtg1 = $this->db->get_where('tbl_bill_hotel_sim', array('id_p' => $id_p));
			} else {
				$qtg1 = $this->db->get_where('tbl_bill_hotel', array('id_p' => $id_p));
			}
			//=========================================================================================SIM 10417


			foreach ($qtg1->result() as $keytgl) {

				//$data['kamar'][$key->id]=$key->jenis_kamar.'/'.$key->id_kamar; ///agama

				$data['tgl'][$keytgl->tanggal] = $keytgl->tanggal;
			}

			//

			$data['aa'] = $data['a'] = 'active';
			$data['c'] = $data['b'] = $data['d'] = $data['a1'] = $data['e'] = $data['g'] = $data['f'] = '';
			$this->load->view('resepsionis/beranda', $data);
		} else {
			redirect('login/simpeg');
		}
	}

	////BILL TANPA EDIT DATA

	public function bill_kamnoedit($id_p, $id_user, $id_tgl, $shift)

	{

		if ($this->session->userdata('login') == TRUE) {

			//if ($this->session->userdata('id_p') == $id_p){

			///////////

			$data['noedit'] = 'ya';

			$data['nav'] = 'active';

			$data['id_user'] = $id_user;

			$data['id_tgl'] = $id_tgl;

			$data['shift'] = $shift;

			///////

			$q = $this->Minfo->info()->row();



			//

			//	$data['nama']=$nama;

			$data['id_p'] = $id_p;

			$data['h_row'] = $h_row = $this->db->get_where('tbl_pesan_kamar', array('id' => $id_p))->row();

			//

			$data['nama_app'] =  'LAPORAN MASING-MASING SHIFT  ' . $q->namapt;

			$data['title'] =  'LAPORAN MASING-MASING SHIFT  ' . $q->namapt;

			//

			$kamar = $this->db->get_where('tbl_pesan_kamar', array('id' => $id_p)); ////berdasarkan nama id pelanggan pertama

			$data['hget'] = $h = $this->Mhotel->bill_hotel($id_p); ////berdasarkan nama id pelanggan pertama

			$data['h1'] = $h1 = $this->db->get_where('tbl_tagihan', array('id_p' => $id_p));

			//

			$data['namapt'] = !empty($q->namapt) ? $q->namapt : $this->config->item('nameAPP');

			$data['logo'] = !empty($q->logo) ? $q->logo : 'logo';

			$data['lunas'] = $kamar->row()->status;

			////

			$dt = $this->db->get_where('tbl_deposit', array('id_p' => $id_p));

			$id_dep_a = $this->db->get('tbl_deposit')->num_rows();

			if ($dt->num_rows() > 0) {

				foreach ($dt->result() as $depo) {
				}

				$data['depo'] = empty($kamar->row()->tipe) ? '' : $kamar->row()->tipe;
			} else {

				$data['depo'] = '';
			}

			$data['totid'] = $id_dep_a;

			////

			if ($id_p != 0) {

				////// di tampilkan

				$data['main_view'] = 'resepsionis/cek_bill_refund';
			} else {

				redirect('C_resepsionis/cek_kam');
			}



			//

			if ($id_p != NULL) {

				$tot = 0;

				$totdsc = 0;

				foreach ($h->result() as $hh) {

					////''



					$am = $this->db->get_where('tbl_kamar', array('id_kamar' => $hh->id_k))->row();

					$dk = $hh->delkam;

					//

					if ($dk == 'ya') {

						$hrgakam = 0;
					} else {

						$hrgakam = $am->harga;
					}

					//



					//// revisi Early Cek in 

					$h_kam = $hrgakam;

					if ($hh->early == 1) {

						//$has_early=$h_kam+$bg_kam;

						$bg_kam = ($h_kam / 2);
					} else {

						$bg_kam = 0;
					}

					///

					//$bg_kam=0;

					$dtot = $hrgakam;; ///discon jumlah dalam satu kamar ...////tidak lagi untuk discon

					$disc = ($hh->disc * $dtot) / 100; ///disc

					$hrgakamdahdisc = $hrgakam - $disc;

					$tot = ($tot + $hrgakamdahdisc + $hh->harga_bed + $hh->harga_ot + $bg_kam); ///total - dison

					//$totdsc=($totdsc+$hrgakam)-$disc; ///discon-discon MEMBER

					$totdsc = ($totdsc + $dtot); ///discon-discon MEMBER

					$tottt = $tot; //kamar

					$data['totdisc'] = $totdsc; ///di tampilkan

					//

				}

				if ($h1->num_rows() > 0) {

					$tott = 0;

					foreach ($h1->result() as $hh1) {

						$tott = $tott + $hh1->harga; /////makanan

						$data['p_kamar'] = $tottt; //total ksmar aja aja

						$data['p'] = $tott + $tottt; //total



					}
				} else {

					$data['p'] = $tottt; //totall

					$data['p_kamar'] = $tottt; //totall

				}
			}



			/////////

			$qtg1 = $this->db->get_where('tbl_bill_hotel', array('id_p' => $id_p));

			foreach ($qtg1->result() as $keytgl) {

				//$data['kamar'][$key->id]=$key->jenis_kamar.'/'.$key->id_kamar; ///agama

				$data['tgl'][$keytgl->tanggal] = $keytgl->tanggal;
			}

			//

			$data['aa'] = $data['b'] = 'active';

			$data['c'] = $data['a'] = $data['d'] = $data['a1'] = $data['e'] = $data['f'] = $data['g'] = $data['h'] = '';

			//$data['p']='';//tambahan dari MASTERPRA 16MARET2017

			//

			$this->load->view('beranda', $data);

			/*	 }else{

            redirect ('C_resepsionis/cek_kam');

        } */
		} else {

			redirect('login/simpeg');
		}
	}



	//////////////////peasan kamar///not function

	function simpan_old()

	{

		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

		$hm = $h * 60;

		$ms = $hm * 60;

		$tanggal = gmdate("d/m/Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

		$waktu = gmdate("g:i:s A", time() + ($ms));

		$kamar = $this->input->post('dd');

		//$j = $this->input->post('jmlah');

		//$a = $this->db->get_where('tbl_kamar', array('id'=>$kamar))->row();

		//$data=$this->session->userdata('data_simpan');

		$data = array(

			'nama' => $this->input->post('nama'),

			'update' => $tanggal . '&nbsp;' . $waktu,

			'alamat' => $this->input->post('alamat'),

			'cekin' => $this->input->post('cekin'),

			'jam_in' => $this->input->post('jam_in'),

			'jam_out' => $this->input->post('jam_out'),

			'cekout' => $this->input->post('cekout'),

			//'jmlah' => $this->input->post('jmlah'),

			'deposit' => $this->input->post('db'),

			//	'jenis_kamar' => $a->jenis_kamar,

			//'id_kamar' => $a->id_kamar,

			//'harga' => $a->harga,

			'id_k' => $this->input->post('dd') . '_',



			//	'tanggal' => $tanggal,

			//	'waktu' => $waktu,

		);



		$this->Mhotel->simpan_pesan($data);



		/*	$da = array(

		'cek' => 'terisi',

		);

		$this->Mhotel->up_cek_pesan($da,$kamar);

		*/





		$this->session->set_flashdata("pesan", "<div class=\"col-xs-12-md-12\"><div class=\"alert alert-success\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Saudara " . $this->input->post('nama') . " Telah Tersimpan </div></div>");



		redirect('C_resepsionis/pesan_kam');
	}



	//////PESAN KAMAR LANGSUNG

	function simpan_old_v16() ///not function 

	{

		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

		$hm = $h * 60;

		$ms = $hm * 60;

		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

		$waktu = gmdate("H:i:s", time() + ($ms));

		//	$kamar = $this->input->post('dd');

		//$k=$this->db->get();

		//$j = $this->input->post('jmlah');

		//$a = $this->db->get_where('tbl_kamar', array('id'=>$kamar))->row();

		//$data=$this->session->userdata('data_simpan');

		// Persiapan untuk no kmar cek bok

		$all = $this->db->get('tbl_kamar');

		$simpan = '';

		if ($all->num_rows() > 0) {

			foreach ($all->result() as $aa) {

				if ($this->input->post('k_' . $aa->id_kamar)) {

					$simpan = $simpan . '-' . $aa->id_kamar;
				}
			}
		}

		$hasil_no = $simpan;



		//

		$data = array(

			'nama' => $this->input->post('nama'),

			'insert' => $tanggal . ' ' . $waktu,

			//'update' => $tanggal .' '.$waktu,

			'alamat' => $this->input->post('alamat'),

			'cekin' => $this->input->post('cekin'),

			//'user' => $this->session->userdata('username').' [ '.$this->session->userdata('sip').' ] ',

			'user_awal' => $this->session->userdata('username') . ' [ ' . $this->session->userdata('sip') . ' ] ',

			//'jam_in' => $this->input->post('jam_in'),

			//'jam_out' => $this->input->post('jam_out'),

			'cekout' => $this->input->post('cekout'),

			'id_user' => $this->session->userdata('id_user'),

			'nota' => '',

			'boking' => 'no',

			//'jmlah' => $this->input->post('jmlah'),

			//'deposit' => $this->input->post('db'),

			//	'jenis_kamar' => $a->jenis_kamar,

			//'id_kamar' => $a->id_kamar,

			//'harga' => $a->harga,



			'id_k' => $hasil_no,

		);



		$this->Mhotel->simpan_pesan($data); ///simpan ke tabel pesan kamar tempat user dan tanggal update



		$id_last = $this->Mhotel->id_last()->row()->id;



		$pec = explode('-', $hasil_no); ////di pecah  dalam bentu array

		for ($i = 1; $i < count($pec); $i++) { ////count ===menjumlah array

			//  if ($all->id_kamar == $pec[$i]){ untuk cek bok

			$da = array(

				//'tanggal' => $tanggal,

				'cek' => 'terisi',

				'id_p' => $id_last,

				'user_awal' => $this->session->userdata('username'),

				'insert' => $tanggal . ' ' . $waktu



			);

			$this->Mhotel->up_cek_pesan($da, $pec[$i]); //tabe kamar

			//}

		}

		//TANGGAL

		$CheckInX = explode("-", substr($this->input->post('cekin'), '0', '-6'));

		$CheckOutX =  explode("-", substr($this->input->post('cekout'), '0', '-6'));

		//	

		$date1 =  mktime(0, 0, 0, $CheckInX[1], $CheckInX[0], $CheckInX[2]); ///jam,menit,detik,bulan,tanggal,tahun 

		$date2 =  mktime(0, 0, 0, $CheckOutX[1], $CheckOutX[0], $CheckOutX[2]);

		$interval = ($date2 - $date1) / (3600 * 24);

		//$hasil = ($interval < 1) ? (1) : $interval;  

		$hasil = $interval;

		if ($hasil <= 0) {

			$hasila = $hasil + 1;
		} else {

			$hasila = $hasil;
		}

		//

		//for($ii = 1; $ii <= count($hasil); $ii++){

		for ($ii = 0; $ii < $hasila; $ii++) {

			for ($iii = 1; $iii < count($pec); $iii++) {

				$tgl1 = substr($this->input->post('cekin'), '0', '-6');

				//$tgl2 = date('d/m/Y', strtotime('+'.$ii.' days', strtotime($tgl1))); //operasi penjumlahan tanggal sebanyak 6 hari

				$sortt = date('d-m-Y', strtotime('+' . $ii . ' days', strtotime($tgl1)));

				$xxx = substr($sortt, '6', '4');

				$xx = substr($sortt, '3', '2');

				$x = substr($sortt, '0', '2');

				//$date3 =  mktime(0, 0, 0, $sort[1],$sort[0],$sort[2]);

				$daa = array(

					//'tanggal'=> substr($this->input->post('cekin'),'0','-14')+$ii.'/'.substr($this->input->post('cekin'),'3','-11').'/'.substr($this->input->post('cekin'),'6','-6'), //01/01/2016

					//'tanggal'=> $ii,

					//'tanggal'=> date($tgl1, mktime(0,0,0,date("m"),date("d")+$ii,date("Y"))),

					'tanggal' => date('d-m-Y', strtotime('+' . $ii . ' days', strtotime($tgl1))), //operasi penjumlahan tanggal sebanyak 6 hari

					'sort_t' => $xxx . '' . $xx . '' . $x, //operasi penjumlahan tanggal sebanyak 6 hari

					//	'tanggal' =>mktime(0, 0, 0, $CheckInX[1],$CheckInX[0]+$ii,$CheckInX[2]),

					'id_p' => $id_last,

					'id_k' => $pec[$iii],

					'user_awal' => $this->session->userdata('username'),

					'insert' => $tanggal . ' ' . $waktu,

					//'update' => $tanggal.'&nbsp;'.$waktu



				);

				$this->Mhotel->up_bill_hotel($daa); //tabe bill hotel

			} ////pengulang no kmar

		} ///pengulangan tanggal

		///

		for ($iiii = 1; $iiii < count($pec); $iiii++) {



			$sortt_up = date('d-m-Y', strtotime('+' . $hasila . ' days', strtotime($tgl1)));

			$xxx1 = substr($sortt_up, '6', '4');

			$xx1 = substr($sortt_up, '3', '2');

			$x1 = substr($sortt_up, '0', '2');

			/////TBL PErpanjangan 

			$daaa = array(

				'tanggal' => date('d-m-Y', strtotime('+' . $hasila . ' days', strtotime($tgl1))), //operasi penjumlahan tanggal sebanyak 6 hari

				'cekout' => $xxx1 . '' . $xx1 . '' . $x1,

				'id_p' => $id_last,

				'id_k' => $pec[$iiii],

				//'update' => $tanggal.'&nbsp;'.$waktu



			);

			$this->Mhotel->up_perpanjangan($daaa);
		} ///pengulang kamar tapi tanggal tidak di ulang

		///



		////////LAPORAN SHIP



		$sip = array(

			'id_user' => $this->session->userdata('id_user'),

			'ship' => $this->session->userdata('sip'),

			'ket' => 'Input data Guest Bill yang Benama ' . $this->input->post('nama') . '  Alamat ' . $this->input->post('alamat'),

			'status' => 'Input data Guest Bill',

			'tanggal' => $tanggal . ' ' . $waktu,

		);

		$this->Login_model->sip_login($sip);

		/////



		/////// unti=uk menmbah bars di kolom deposit  guest bar

		$data0 = array('id_p' => $id_last);

		$this->Mhotel->simpan_deposit($data0);



		////////

		/*

	$daa = array(

		'tanggal' => substr($'';''this->input->post('cekin'),'0','-6'),

		//'cek' => 'terisi',

		'id_p' => $id_last,

		'update' => $tanggal.'&nbsp;'.$waktu

		

		);

	$this->Mhotel->up_bill_hotel($daa); //tabe bill hotel

 */

		//DEPOSIT

		/*$depo=array('id_p' => $id_last,

 		'tanggal' => $tanggal,

 		//'cas' => $this->input->post('db'),

 	);

 $this->Mhotel->simpan_deposit($depo);/////tbl_deposit */

		//

		$this->session->set_flashdata("pesan", "<div class=\"col-xs-12-md-12\"><div class=\"alert alert-success\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Data Berhasil Di simpan . </div></div>");



		redirect('C_resepsionis/pesan_kam');
	}

	//=================SIMPAN PAKE VALIDASI VERSI 17-==========================================

	function simpan()

	{

		// Persiapan untuk no kmar cek bok

		$all = $this->db->get('tbl_kamar');

		$simpan = '';

		if ($all->num_rows() > 0) {

			foreach ($all->result() as $aa) {

				if ($this->input->post('k_' . $aa->id_kamar)) {

					$simpan = $simpan . '-' . $aa->id_kamar;
				}
			}
		}

		$hasil_no = $simpan;

		if (!empty($hasil_no)) { ///bila ada kamar yang di pilih





			//

			$this->form_validation->set_rules('nama', 'nama', 'required');

			$this->form_validation->set_rules('cekin', 'cekin', 'required');

			$this->form_validation->set_rules('cekout', 'cekout', 'required');



			if ($this->form_validation->run() == TRUE) {



				$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

				$hm = $h * 60;

				$ms = $hm * 60;

				$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

				$waktu = gmdate("H:i:s", time() + ($ms));



				$data = array(

					'nama' => $this->input->post('nama'),

					'insert' => $tanggal . ' ' . $waktu,

					//'update' => $tanggal .' '.$waktu,

					'alamat' => $this->input->post('alamat'),

					'cekin' => $this->input->post('cekin'),

					//'user' => $this->session->userdata('username').' [ '.$this->session->userdata('sip').' ] ',

					'user_awal' => $this->session->userdata('username') . ' [ ' . $this->session->userdata('sip') . ' ] ',

					//'jam_in' => $this->input->post('jam_in'),

					//'jam_out' => $this->input->post('jam_out'),

					'cekout' => $this->input->post('cekout'),

					'id_user' => $this->session->userdata('id_user'),

					'nota' => '',

					'boking' => 'no',

					//'jmlah' => $this->input->post('jmlah'),

					//'deposit' => $this->input->post('db'),

					//	'jenis_kamar' => $a->jenis_kamar,

					//'id_kamar' => $a->id_kamar,

					//'harga' => $a->harga,



					'id_k' => $hasil_no,

				);



				$this->Mhotel->simpan_pesan($data); ///simpan ke tabel pesan kamar tempat user dan tanggal update



				$id_last = $this->Mhotel->id_last()->row()->id;



				$pec = explode('-', $hasil_no); ////di pecah  dalam bentu array

				for ($i = 1; $i < count($pec); $i++) { ////count ===menjumlah array

					//  if ($all->id_kamar == $pec[$i]){ untuk cek bok

					$da = array(

						//'tanggal' => $tanggal,

						'cek' => 'terisi',

						'id_p' => $id_last,

						'user_awal' => $this->session->userdata('username'),

						'insert' => $tanggal . ' ' . $waktu



					);

					$this->Mhotel->up_cek_pesan($da, $pec[$i]); //tabe kamar

					//}

				}

				//TANGGAL

				$CheckInX = explode("-", substr($this->input->post('cekin'), '0', '-6'));

				$CheckOutX =  explode("-", substr($this->input->post('cekout'), '0', '-6'));

				//	

				$date1 =  mktime(0, 0, 0, $CheckInX[1], $CheckInX[0], $CheckInX[2]); ///jam,menit,detik,bulan,tanggal,tahun 

				$date2 =  mktime(0, 0, 0, $CheckOutX[1], $CheckOutX[0], $CheckOutX[2]);

				$interval = ($date2 - $date1) / (3600 * 24);

				//$hasil = ($interval < 1) ? (1) : $interval;  

				$hasil = $interval;

				if ($hasil <= 0) {

					$hasila = $hasil + 1;
				} else {

					$hasila = $hasil;
				}

				//

				//for($ii = 1; $ii <= count($hasil); $ii++){

				for ($ii = 0; $ii < $hasila; $ii++) {

					for ($iii = 1; $iii < count($pec); $iii++) {

						$tgl1 = substr($this->input->post('cekin'), '0', '-6');

						//$tgl2 = date('d/m/Y', strtotime('+'.$ii.' days', strtotime($tgl1))); //operasi penjumlahan tanggal sebanyak 6 hari

						$sortt = date('d-m-Y', strtotime('+' . $ii . ' days', strtotime($tgl1)));

						$xxx = substr($sortt, '6', '4');

						$xx = substr($sortt, '3', '2');

						$x = substr($sortt, '0', '2');

						//$date3 =  mktime(0, 0, 0, $sort[1],$sort[0],$sort[2]);

						$daa = array(

							//'tanggal'=> substr($this->input->post('cekin'),'0','-14')+$ii.'/'.substr($this->input->post('cekin'),'3','-11').'/'.substr($this->input->post('cekin'),'6','-6'), //01/01/2016

							//'tanggal'=> $ii,

							//'tanggal'=> date($tgl1, mktime(0,0,0,date("m"),date("d")+$ii,date("Y"))),

							'tanggal' => date('d-m-Y', strtotime('+' . $ii . ' days', strtotime($tgl1))), //operasi penjumlahan tanggal sebanyak 6 hari

							'sort_t' => $xxx . '' . $xx . '' . $x, //operasi penjumlahan tanggal sebanyak 6 hari

							//	'tanggal' =>mktime(0, 0, 0, $CheckInX[1],$CheckInX[0]+$ii,$CheckInX[2]),

							'id_p' => $id_last,

							'id_k' => $pec[$iii],

							'user_awal' => $this->session->userdata('username'),

							'insert' => $tanggal . ' ' . $waktu,

							//'update' => $tanggal.'&nbsp;'.$waktu



						);

						$this->Mhotel->up_bill_hotel($daa); //tabe bill hotel

					} ////pengulang no kmar

				} ///pengulangan tanggal

				///

				for ($iiii = 1; $iiii < count($pec); $iiii++) {



					$sortt_up = date('d-m-Y', strtotime('+' . $hasila . ' days', strtotime($tgl1)));

					$xxx1 = substr($sortt_up, '6', '4');

					$xx1 = substr($sortt_up, '3', '2');

					$x1 = substr($sortt_up, '0', '2');

					/////TBL PErpanjangan 

					$daaa = array(

						'tanggal' => date('d-m-Y', strtotime('+' . $hasila . ' days', strtotime($tgl1))), //operasi penjumlahan tanggal sebanyak 6 hari

						'cekout' => $xxx1 . '' . $xx1 . '' . $x1,

						'id_p' => $id_last,

						'id_k' => $pec[$iiii],

						//'update' => $tanggal.'&nbsp;'.$waktu



					);

					$this->Mhotel->up_perpanjangan($daaa);
				} ///pengulang kamar tapi tanggal tidak di ulang

				///



				////////LAPORAN SHIP



				$sip = array(

					'id_user' => $this->session->userdata('id_user'),

					'ship' => $this->session->userdata('sip'),

					'ket' => 'Input data Guest Bill yang Benama ' . $this->input->post('nama') . '  Alamat ' . $this->input->post('alamat'),

					'status' => 'Input data Guest Bill',

					'tanggal' => $tanggal . ' ' . $waktu,

				);

				$this->Login_model->sip_login($sip);

				/////



				/////// unti=uk menmbah bars di kolom deposit  guest bar

				$data0 = array('id_p' => $id_last);

				$this->Mhotel->simpan_deposit($data0);



				////////

				/*

	$daa = array(

		'tanggal' => substr($'';''this->input->post('cekin'),'0','-6'),

		//'cek' => 'terisi',

		'id_p' => $id_last,

		'update' => $tanggal.'&nbsp;'.$waktu

		

		);

	$this->Mhotel->up_bill_hotel($daa); //tabe bill hotel

 */

				//DEPOSIT

				/*$depo=array('id_p' => $id_last,

 		'tanggal' => $tanggal,

 		//'cas' => $this->input->post('db'),

 	);

 $this->Mhotel->simpan_deposit($depo);/////tbl_deposit */

				//

				$this->session->set_flashdata("pesan", "<div class=\"col-xs-12-md-12\"><div class=\"alert alert-success\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Data Berhasil Di simpan . </div></div>");



				redirect('C_resepsionis/pesan_kam');
			} else { ///falidasi

				$this->session->set_flashdata('pesan', "<div class=\"col-xs-12-md-12\"><div class=\"alert alert-danger\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Maaf , Data gagal di simpan .<br/> Mohon pingisiian diisi Lengkap </div></div>");

				redirect('C_resepsionis/pesan_kam');
			} ///validasi	

		} else { ////tidak memilik kmar

			$this->session->set_flashdata('pesan', "<div class=\"col-xs-12-md-12\"><div class=\"alert alert-danger\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Maaf , Data gagal di simpan .<br/> Mohon Pilih No Kamar Salah Satu . </div></div>");

			redirect('C_resepsionis/pesan_kam');
		}
	} ///funsui



	/////BOKING KAMAR

	function simpan_boking()

	{

		// Persiapan untuk no kmar cek bok

		$all = $this->db->get('tbl_kamar');

		$simpan = '';

		if ($all->num_rows() > 0) {

			foreach ($all->result() as $aa) {

				if ($this->input->post('k_' . $aa->id_kamar)) {

					$simpan = $simpan . '-' . $aa->id_kamar;
				}
			}
		}

		$hasil_no = $simpan;

		if (!empty($hasil_no)) {







			$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

			$hm = $h * 60;

			$ms = $hm * 60;

			$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

			$waktu = gmdate("H:i:s", time() + ($ms));

			//	$kamar = $this->input->post('dd');

			//$k=$this->db->get();

			//$j = $this->input->post('jmlah');

			//$a = $this->db->get_where('tbl_kamar', array('id'=>$kamar))->row();

			//$data=$this->session->userdata('data_simpan');





			////////BUaT noTA

			$bsm = $this->input->post('bank');

			if ($bsm == 'Cash') {

				$bak = 'K';
			} else {

				$bak = 'N';
			}

			$buatnotaq = $this->Mhotel->buatnota($bak)->num_rows() + 1;





			//////

			$data = array(

				'nama' => $this->input->post('nama'),

				'insert' => $tanggal . ' ' . $waktu,

				//'update' => $tanggal .' '.$waktu,

				//'alamat' => $this->input->post('alamat'),

				'cekin' => $this->input->post('cekin'),

				'tanggal' =>  $this->input->post('tgl'),



				'id_user' => $this->session->userdata('id_user'),

				'shift' => $this->session->userdata('sip'),

				'id_tgl' => $this->session->userdata('id_tgl'),

				'user_awal' => $this->session->userdata('username') . ' [ ' . $this->session->userdata('sip') . ' ] ',

				//'jam_in' => $this->input->post('jam_in'),

				//'jam_out' => $this->input->post('jam_out'),

				'cekout' => $this->input->post('cekout'),

				'rek' => $this->input->post('rek'),

				'bank' => $this->input->post('bank'),

				'nominal' => $this->input->post('nominal'),

				'nota' => $buatnotaq,

				'tipe' => $bak,

				'Status' => 'Lunas',

				'boking' => 'ya',

				//'jmlah' => $this->input->post('jmlah'),

				//'deposit' => $this->input->post('db'),

				//	'jenis_kamar' => $a->jenis_kamar,

				//'id_kamar' => $a->id_kamar,

				//'harga' => $a->harga,



				'id_k' => $hasil_no,

			);



			$this->Mhotel->simpan_pesan($data); ///simpan ke tabel pesan tempat user dan tanggal update ////tabel pesan kamar



			$id_last = $this->Mhotel->id_last()->row()->id;



			////////////

			////////////////BUAT NOTA boking





			/////////         







			$pec = explode('-', $hasil_no);

			/*

  	  for($i = 1; $i< count($pec); $i++){

     //  if ($all->id_kamar == $pec[$i]){ untuk cek bok

		$da = array(

		//'tanggal' => $tanggal,

		'cek' => 'kosong', ///untuk BOKING

		'id_p' => '',

		'user_awal' => $this->session->userdata('username'),

		'insert' => $tanggal.' '.$waktu

		

		);

		$this->Mhotel->up_cek_pesan($da, $pec[$i]); //tabe kamar yang di tampilkan di rooms information

	//}

	} ///*/

			/*//TANGGAL

	$CheckInX = explode("-", substr($this->input->post('cekin'),'0','-6'));

	$CheckOutX =  explode("-", substr($this->input->post('cekout'),'0','-6'));

//	

	$date1 =  mktime(0, 0, 0, $CheckInX[1],$CheckInX[0],$CheckInX[2]);///jam,menit,detik,bulan,tanggal,tahun 

	$date2 =  mktime(0, 0, 0, $CheckOutX[1],$CheckOutX[0],$CheckOutX[2]);

	$interval =($date2 - $date1)/(3600*24);

	//$hasil = ($interval < 1) ? (1) : $interval;  

	$hasil = $interval;  

	if($hasil <= 0){

		$hasila=$hasil+1;

	}else{

		$hasila=$hasil;

	}

	//

	//for($ii = 1; $ii <= count($hasil); $ii++){

	for($ii = 0; $ii < $hasila; $ii++){

   	for($iii = 1; $iii< count($pec); $iii++){

$tgl1 = substr($this->input->post('cekin'),'0','-6');

//$tgl2 = date('d/m/Y', strtotime('+'.$ii.' days', strtotime($tgl1))); //operasi penjumlahan tanggal sebanyak 6 hari

$sortt=date('d-m-Y', strtotime('+'.$ii.' days', strtotime($tgl1)));

$xxx=substr($sortt,'6','4');

$xx=substr($sortt,'3','2');

$x=substr($sortt,'0','2');

//$date3 =  mktime(0, 0, 0, $sort[1],$sort[0],$sort[2]);

		$daa = array( 

		//'tanggal'=> substr($this->input->post('cekin'),'0','-14')+$ii.'/'.substr($this->input->post('cekin'),'3','-11').'/'.substr($this->input->post('cekin'),'6','-6'), //01/01/2016

		//'tanggal'=> $ii,

		//'tanggal'=> date($tgl1, mktime(0,0,0,date("m"),date("d")+$ii,date("Y"))),

		'tanggal'=> date('d-m-Y', strtotime('+'.$ii.' days', strtotime($tgl1))), //operasi penjumlahan tanggal sebanyak 6 hari

		'sort_t'=> $xxx.''.$xx.''.$x, //operasi penjumlahan tanggal sebanyak 6 hari

	//	'tanggal' =>mktime(0, 0, 0, $CheckInX[1],$CheckInX[0]+$ii,$CheckInX[2]),

		'id_p' => $id_last,

		'id_k' => $pec[$iii],

		'user_awal' => $this->session->userdata('username'),

		'insert' => $tanggal.' '.$waktu,

		//'update' => $tanggal.'&nbsp;'.$waktu

		

		);

		$this->Mhotel->up_bill_hotel($daa); //tabe bill hotel ///data yang di tampilkan

	} ////pengulang no kmar

	} ///pengulangan tanggal

	///

	for($iiii = 1; $iiii < count($pec); $iiii++){

		

		$sortt_up=date('d-m-Y', strtotime('+'.$hasila.' days', strtotime($tgl1)));

$xxx1=substr($sortt_up,'6','4');

$xx1=substr($sortt_up,'3','2');

$x1=substr($sortt_up,'0','2');

		/////TBL PErpanjangan 

		$daaa = array( 

		'tanggal'=> date('d-m-Y', strtotime('+'.$hasila.' days', strtotime($tgl1))), //operasi penjumlahan tanggal sebanyak 6 hari

		'cekout'=> $xxx1.''.$xx1.''.$x1, 

		'id_p' => $id_last,

		'id_k' => $pec[$iiii],

		//'update' => $tanggal.'&nbsp;'.$waktu

		

		);

		$this->Mhotel->up_perpanjangan($daaa); ////tbl perpanjang

		

	} ///pengulang kamar tapi tanggal tidak di ulang

	///\\*/



			////////LAPORAN SHIP



			$sip = array(

				'id_user' => $this->session->userdata('id_user'),

				'ship' => $this->session->userdata('sip'),

				'ket' => 'Input data Guest Bill yang Benama ' . $this->input->post('nama') . '  Alamat ' . $this->input->post('alamat'),

				'status' => 'Input data Guest Bill',

				'tanggal' => $tanggal . ' ' . $waktu,

			);

			$this->Login_model->sip_login($sip); //tabel laporan sip

			/////







			//DEPOSIT

			if ($this->input->post('bank') == 'Cash') {

				$cs = 'cas';

				$cs1 = 'C';
			} else {

				$cs = 'transfer';

				$cs1 = 'T';
			}

			$depo = array(

				'id_user' => $this->session->userdata('id_user'),

				'user' => $this->session->userdata('username'),

				'update' => $tanggal . ' ' . $waktu,

				'id_p' => $id_last,

				'tanggal' =>  $this->input->post('tgl'),

				'total' =>  'ya',

				'tipe' =>  $cs1,

				$cs => $this->input->post('nominal'),

			);

			$this->Mhotel->simpan_deposit($depo); /////tbl_deposit */

			//

			$this->session->set_flashdata("pesan", "<div class=\"col-xs-12-md-12\"><div class=\"alert alert-success\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Data berhasil di simpan, <br/> Tekan tombol Lanjut untuk kembali. </div></div>");



			//redirect('C_resepsionis/deposit_bar');

			redirect('C_resepsionis/viewcetak/' . $id_last);
		} else { ///Deposit_bar

			$this->session->set_flashdata('pesan', "<div class=\"col-xs-12-md-12\"><div class=\"alert alert-danger\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Maaf , Data gagal di simpan .<br/> Mohon Pilih No Kamar Salah Satu . </div></div>");

			redirect('C_resepsionis/Deposit_bar');
		}
	} ///f

	//////////CARI MASING MASING NAMA BILL

	function cari()
	{

		$nama = $this->input->post('nama');

		//if($id_p!=0 and $nama!='kosong'){

		$a = $this->Mhotel->cari_cek($nama);

		if ($a == TRUE) {

			$id_p = $this->db->get_where('tbl_pesan_kamar', array('nama' => $nama))->row()->id;

			$this->session->set_flashdata('id_p', $id_p);

			$this->bill_kam($id_p, $nama);
		} else {

			$this->bill_kam('kosong');



			//redirect('C_resepsionis/bill_kam/'.$id_p.'/'.$nama);

		}

		//}else{

		//$this->bill_kam('kosong');

		//$this->cek_kam();

		//}

	}



	///////////////CEK ID USErrv DI CEK KAMAR

	function cek_id($id_p)
	{

		$this->session->set_flashdata('id_p', $id_p);

		//$pass=$this->input->post('pass');

		$pass = $this->session->userdata('password');

		$aa = $this->Mhotel->cari_pass($pass);

		if ($aa == TRUE and $this->session->userdata('password') == $pass) {

			$a = $this->Mhotel->cari_cek($id_p);

			if ($a == TRUE) {

				//$id_p=$this->db->get_where('tbl_pesan_kamar',array('id'=>$id_p))->row()->id;



				redirect('C_resepsionis/bill_kam/' . $id_p);
			} else { ///id pelanggan / pengunjung / tamu

				redirect('C_resepsionis/cek_kam');
			}
		} else { //pass

			redirect('C_resepsionis/cek_kam');
		}
	}

	///////////////CEK ID USErrv DI CEK lap shift

	function cek_id_ship($id_user, $id_tgl, $shift)
	{

		//$this->session->set_flashdata('id_user',$id_user);

		$pass = $this->input->post('pass');

		$aa = $this->Mhotel->cari_pass($pass);

		if ($aa == TRUE and $this->session->userdata('password') == $pass) {

			$this->session->get_userdata('login_shift', 'ya');

			redirect('C_admin/rinci_pendapatan/' . $id_user . '/1/' . $id_tgl . '/' . $shift);
		} else { //pass

			redirect('C_resepsionis/lap_shifs');
		}
	}

	//////food dan ll yang menginap

	function simpan_tagihan($p)
	{

		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

		$hm = $h * 60;

		$ms = $hm * 60;

		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

		$waktu = gmdate("H:i:s ", time() + ($ms));

		//$p=$this->input->post('id_p'); id pengunjung

		$ka = $this->db->get_where('tbl_pesan_kamar', array('id' => $p))->row()->id_k;

		//$ka = $this->db->get_where('tbl_pesan_kamar', array('id'=>$p));

		$data = array(

			//	'ket' => $this->input->post('ket'),

			'jenis' => $this->input->post('tp'),

			'nota' => $this->input->post('nota'),

			'id_tgl' => $this->session->userdata('id_tgl'),

			'tipe' => 'shift', ///bareng ama satus lunas

			'shift' => $this->session->userdata('sip'),

			'harga' => $this->input->post('harga'), //*$this->input->post('jmlah'),

			'user' => $this->session->userdata('username'),

			'id_user' => $this->session->userdata('id_user'),

			'id_p' => $p,

			'id_k' => $ka,

			'update' => $tanggal . ' ' . $waktu,



			//'jmlah' => $this->input->post('jmlah'),





			'tanggal' => $this->input->post('tanggal'),

			//	'waktu' => $waktu,

		);

		$this->session->set_flashdata("pesan", "<div class=\"col-xs-12-md-12\"><div class=\"alert alert-success\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Data Sudah Tersimpan</div></div>");



		$this->Mhotel->simpan_tagihan($data);

		/////simpan orang yang merubah

		$user = array(

			'update' => $tanggal . ' ' . $waktu,

			'user' => $this->session->userdata('username') . '[ ' . $this->session->userdata('sip') . ' ] ',

		);



		$this->Mhotel->update_user($user, $p); ///simpan ke tabel pesan tempat user dan tanggal update

		//////

		////////LAPORAN SHIP

		$sip = array(

			'id_user' => $this->session->userdata('id_user'),

			'ship' => $this->session->userdata('sip'),

			'ket' => 'Tambah data Food, Beverage, Laundry, & Etc',

			'status' => 'Tambah data',

			'tanggal' => $tanggal . ' ' . $waktu,

		);

		$this->Login_model->sip_login($sip);

		/////

		redirect($this->session->userdata('url'));
	}



	/////bar yang tidak menginap

	function simpan_bar()
	{



		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

		$hm = $h * 60;

		$ms = $hm * 60;

		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

		$waktu = gmdate("H:i:s ", time() + ($ms));

		//$p=$this->input->post('id_p'); id pengunjung

		//$ka=$this->db->get_where('tbl_pesan_kamar',array('id'=>$p))->row()->id_k;

		//$ka = $this->db->get_where('tbl_pesan_kamar', array('id'=>$p));

		$data = array(

			//'ket' => $this->input->post('ket'),

			'nama' => $this->input->post('nama'),

			'id_user' => $this->session->userdata('id_user'),

			'shift' => $this->session->userdata('sip'),

			'id_tgl' => $this->session->userdata('id_tgl'),

			'jenis' => $this->input->post('tp'),

			'nota' => $this->input->post('nota'),

			'tipe' => $this->input->post('tipe'),

			'harga' => $this->input->post('db'), //*$this->input->post('jmlah'),

			//'user' => $this->session->userdata('username'),

			'update' => $tanggal . ' ' . $waktu,
			'status' => 'Lunas',

			'tanggal' => $this->input->post('tgl'),

			//	'waktu' => $waktu,

		);

		$this->session->set_flashdata("pesan", "<div class=\"col-xs-12-md-12\"><div class=\"alert alert-success\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Data Sudah Tersimpan</div></div>");



		$this->Mhotel->simpan_tagihan_bar($data);

		/////simpan orang yang merubah

		/*      $user = array(

			'update' => $tanggal .' '.$waktu,

			'user' => $this->session->userdata('username').'[ '.$this->session->userdata('sip').' ] ',

		);

		

               $this->Mhotel->update_user($user,$p); ///simpan ke tabel pesan tempat user dan tanggal update

               ////// */

		////////LAPORAN SHIP

		$sip = array(

			'id_user' => $this->session->userdata('id_user'),

			'ship' => $this->session->userdata('sip'),

			'ket' => 'Tambah data Food, Beverage, Laundry, & Etc yang tidak menginap',

			'status' => 'Tambah data',

			'tanggal' => $tanggal . ' ' . $waktu,

		);

		$this->Login_model->sip_login($sip);

		/////

		redirect($this->session->userdata('url'));
	}

	////////EDIT TAGIHAN DI BILL

	function edit_tagihan($id, $p)
	{



		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

		$hm = $h * 60;

		$ms = $hm * 60;

		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

		$waktu = gmdate("H:i:s ", time() + ($ms));

		//$p=$this->input->post('id_p'); id pengunjung

		$ka = $this->db->get_where('tbl_pesan_kamar', array('id' => $p))->row()->id_k;

		//$ka = $this->db->get_where('tbl_pesan_kamar', array('id'=>$p));

		$data = array(

			//	'ket' => $this->input->post('ket'),

			'jenis' => $this->input->post('tp'),

			'id_tgl' => $this->session->userdata('id_tgl'),

			'id_user' => $this->session->userdata('id_user'),

			'tipe' => 'shift', ///bareng ama satus lunas

			'shift' => $this->session->userdata('sip'),

			'nota' => $this->input->post('nota'),

			'harga' => $this->input->post('harga'), //*$this->input->post('jmlah'),

			'user_edit' => $this->session->userdata('username'),

			//	'id_p' => $p,

			//	'id_k' => $ka,

			'update_edit' => $tanggal . ' ' . $waktu,



			//'jmlah' => $this->input->post('jmlah'),





			'tanggal' => $this->input->post('tanggal'),

			//	'waktu' => $waktu,

		);

		$this->session->set_flashdata("pesan", "<div class=\"col-xs-12-md-12\"><div class=\"alert alert-success\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Data Sudah Tersimpan</div></div>");



		$this->Mhotel->simpan_tagihan_e($id, $data);

		/////simpan orang yang merubah

		$user = array(

			'update' => $tanggal . ' ' . $waktu,

			'user' => $this->session->userdata('username') . '[ ' . $this->session->userdata('sip') . ' ] ',

		);



		$this->Mhotel->update_user($user, $p); ///simpan ke tabel pesan tempat user dan tanggal update

		//////

		////////LAPORAN SHIP



		$sip = array(

			'id_user' => $this->session->userdata('id_user'),

			'ship' => $this->session->userdata('sip'),

			'ket' => 'Edit data Food, Beverage, Laundry, & Etc',

			'status' => 'Edit data',

			'tanggal' => $tanggal . ' ' . $waktu,

		);

		$this->Login_model->sip_login($sip);

		/////

		redirect($this->session->userdata('url'));
	}

	//////////Tambah baris di posit data NULL

	function s_deposit($id_p)
	{

		////

		/*$dt=$this->db->get_where('tbl_deposit',array('id_p'=>$id_p));

	if($dt->num_rows()>0){

	foreach($dt->result() as $depo){

		

	}

	$tipe=$depo->tipe;	

	}else{

		$tipe='';

	}

    	*/

		////

		//$data0=array('id_p' => $id_p,'tipe' => $tipe);

		$data0 = array('id_p' => $id_p);

		$this->Mhotel->simpan_deposit($data0);

		redirect($this->session->userdata('url'));
	}

	/////untuk input cas dan transfer PELUNASAN///////////////////////////////////////////////////----------------------------------------------------------

	function up_transfer($id_p, $id)
	{  ////$id ga pen ting  tinggala di ganrti perintah insert





		///////////////+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

		$hm = $h * 60;

		$ms = $hm * 60;

		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

		$waktu = gmdate("H:i:s", time() + ($ms));



		$lunas = '';

		////////BUaT noTA

		$bsm = $this->input->post('bank');

		if ($bsm == 'Cash') {

			$t = "C"; ///tbl deposit

			$t1 = "K"; ////tbl pesan kamar

			$tcas = 'cas';
		} else {

			$t = 'T';

			$t1 = 'N';

			$tcas = 'transfer';
		}





		////----------------------------------------------------------------------------------------------------------------

		$data = array(

			'id_p' => $id_p,

			'update' => $tanggal . ' ' . $waktu,

			'user' => $this->session->userdata('username'),

			'id_user' => $this->session->userdata('id_user'),

			$tcas => $this->input->post('nominal'),

			'total' => 'ya',

			'tipe' => $t,

			'tanggal' =>  $this->input->post('date'),

		);

		$this->Mhotel->simpan_deposit($data);





		/////simpan orang yang merubah ke tbl pesan kamar

		/////////-----------------------------------------------------------------nyimpan data ke tabel pemesan 

		$user = array(

			'update' => $tanggal . ' ' . $waktu,

			'tipe' => $t1,

			'nota' => $h_nota = 0,

			'rek' => $this->input->post('rek'),

			'bank' => $this->input->post('bank'),

			'nominal' => $this->input->post('nominal'),

			//'id_tgl' => $this->session->userdata('id_tgl'), ///u : get pembayaran
			//'shift'=>$this->session->userdata('sip'),
			//'id_user' => $this->session->userdata('id_user'),
			///'nota_dep' => $this->input->post('nota'),



			//'status' =>$lunas,

			'user' => $this->session->userdata('username') . ' [ ' . $this->session->userdata('sip') . ' ] ',

		);



		/////////////////////////////////////////////////tabel LOG//////////////////////////////////////////////////

		$this->Mhotel->update_user($user, $id_p); ///simpan ke tabel pesan tempat user dan tanggal update

		////////LAPORAN SHIP

		$sip = array(

			'id_user' => $this->session->userdata('id_user'),

			'ship' => $this->session->userdata('sip'),

			'ket' => 'Input Deposit Pelunasan sebesar ' . $this->input->post('cas') . '' . $this->input->post('cas_t'),

			'status' => 'Input Deposit Pelunasan ',

			'tanggal' => $tanggal . ' ' . $waktu,

		);

		$this->Login_model->sip_login($sip);

		/////



		redirect('C_resepsionis/bill_kam/' . $id_p);

		///////////////+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

	}

	/////untuk input cas dan transfer Untuk DEPOSIT------------------------------------------------------------------------------------------------------

	function up_transfer_dep($id_p, $id)
	{

		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

		$hm = $h * 60;

		$ms = $hm * 60;

		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

		$waktu = gmdate("H:i:s", time() + ($ms));

		if ($this->input->post('cas') > 0) {

			$t = 'C'; ///tbl deposit

			$t1 = 'K'; ////tbl pesan kamar

		} else {

			$t = 'T';

			$t1 = 'N';
		}

		$lunas = '';



		//$dt=$this->db->get_where('tbl_deposit',array('id_p'=>$id_p));

		$dtcek = $this->Mhotel->cari_id_dep($id);

		if ($dtcek == TRUE) {

			//////EDIT

			$data = array(

				'id_p' => $id_p,

				'update_edit' => $tanggal . ' ' . $waktu,

				'user_edit' => $this->session->userdata('username'),

				'id_user' => $this->session->userdata('id_user'),

				'cas' => $this->input->post('cas'),

				'transfer' => $this->input->post('cas_t'),

				'nota' => $this->input->post('nota'),

				'total' => 'tdk',

				'tipe' => $t,





				//	'tanggal' =>  $tanggal,

				'tanggal' =>  $this->input->post('date'),

				//	'waktu' => $waktu,

			);

			////

			$this->Mhotel->update_deposit($data, $id);

			/////

			////////LAPORAN SHIP memperbaharui

			$sip = array(

				'id_user' => $this->session->userdata('id_user'),

				'ship' => $this->session->userdata('sip'),

				'ket' => 'Memperbaharui Deposit Menjadi sebesar ' . $this->input->post('cas') . '' . $this->input->post('cas_t'),

				'status' => 'Edit Deposit',

				'tanggal' => $tanggal . ' ' . $waktu,

			);

			$this->Login_model->sip_login($sip);

			/////



		} else { ////ada atu tidak

			//////

			$data = array(

				'id_p' => $id_p,

				'update' => $tanggal . ' ' . $waktu,

				'id_user' => $this->session->userdata('id_user'),

				'user' => $this->session->userdata('username'),

				'cas' => $this->input->post('cas'),

				'transfer' => $this->input->post('cas_t'),

				'nota' => $this->input->post('nota'),

				'total' => 'tdk',

				'tipe' => $t,





				//	'tanggal' =>  $tanggal,

				'tanggal' =>  $this->input->post('date'),

				//	'waktu' => $waktu,

			);

			//////

			$this->Mhotel->simpan_deposit($data); /////simpan data baru

			//////

			////////LAPORAN SHIP

			$sip = array(

				'id_user' => $this->session->userdata('id_user'),

				'ship' => $this->session->userdata('sip'),

				'ket' => 'Input Deposit sebesar ' . $this->input->post('cas') . '' . $this->input->post('cas_t'),

				'status' => 'Input Deposit',

				'tanggal' => $tanggal . ' ' . $waktu,

			);

			$this->Login_model->sip_login($sip);

			/////

		}



		/////simpan orang yang merubah  ---------------------------Menyimpan nota deposit  

		$user = array(

			'update' => $tanggal . ' ' . $waktu,
			///'shift'=>$this->session->userdata('sip'),
			//'tipe' => $t1,
			//'id_tgl' => $this->session->userdata('id_tgl'),
			//'id_user' => $this->session->userdata('id_user'),

			'user' => $this->session->userdata('username') . ' [ ' . $this->session->userdata('sip') . ' ] ',

		);



		$this->Mhotel->update_user($user, $id_p); ///simpan ke tabel pesan tempat user dan tanggal update



		redirect('C_resepsionis/bill_kam/' . $id_p);

		//$this->bill_kam($id_p);

	}

	/////DISCONT

	function gift($a, $id_p)
	{

		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

		$hm = $h * 60;

		$ms = $hm * 60;

		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

		$waktu = gmdate("H:i:s", time() + ($ms));



		$user = array(

			'update' => $tanggal . ' ' . $waktu,

			'disc' => $a,

			'user' => $this->session->userdata('username') . ' [ ' . $this->session->userdata('sip') . ' ] ',

		);



		$this->Mhotel->update_user($user, $id_p); ///simpan ke tabel pesan tempat user dan tanggal update untuk pelanggan

		///

		////////LAPORAN SHIP

		$sip = array(

			'id_user' => $this->session->userdata('id_user'),

			'ship' => $this->session->userdata('sip'),

			'ket' => 'Meng' . $a . 'kan DISCONT Member ',

			'status' => ' DISCONT ' . $a,

			'tanggal' => $tanggal . ' ' . $waktu,

		);

		$this->Login_model->sip_login($sip);

		/////



		redirect('C_resepsionis/bill_kam/' . $id_p);
	}

	/////CEKOUT

	function cekout($id_kamar, $id_p)
	{

		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

		$hm = $h * 60;

		$ms = $hm * 60;

		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

		$waktu = gmdate("H:i:s", time() + ($ms));





		$da = array(

			'cek' => 'Kosong',

			'id_p' => '',

			'user_awal' => '',

			'user' => '',

			'update' => '',

			'insert' => '',



		);

		$this->Mhotel->up_cek_pesan($da, $id_kamar); //tabe kamar

		$user = array(

			'update' => $tanggal . ' ' . $waktu,

			'user' => $this->session->userdata('username') . ' [ ' . $this->session->userdata('sip') . ' ] ',

		);

		$this->Mhotel->update_user($user, $id_p); ///simpan ke tabel pesan tempat user dan tanggal update untuk pelanggan

		////////LAPORAN SHIP

		$sip = array(

			'id_user' => $this->session->userdata('id_user'),

			'ship' => $this->session->userdata('sip'),

			'ket' => 'Cekout Kamar ',

			'status' => 'Cekout Kamar',

			'tanggal' => $tanggal . ' ' . $waktu,

		);

		$this->Login_model->sip_login($sip);

		/////



		redirect($this->session->userdata('url'));
	}
	/////tunggkan

	function tunggkan($id_kamar, $id_p)
	{

		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

		$hm = $h * 60;

		$ms = $hm * 60;

		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

		$waktu = gmdate("H:i:s", time() + ($ms));





		$da = array(

			'cek' => 'Kosong',

			'id_p' => '',

			'user_awal' => '',

			'user' => '',

			'update' => '',

			'insert' => '',



		);
		$da1 = array(

			'status' => 'Tunggakan',

			'id_p' => $id_p,
			'id_k' => $id_kamar,

			'id_user' => $this->session->userdata('id_user'),

			'shift' => $this->session->userdata('sip'),

			'id_tgl' => $this->session->userdata('id_tgl'),
			'tanggal' => $tanggal . ' ' . $waktu,

			'update' => $tanggal . ' ' . $waktu,

			'user' => $this->session->userdata('username') . ' [ ' . $this->session->userdata('sip') . ' ] ',

		);

		$this->Mhotel->up_cek_pesan($da, $id_kamar); //tabe kamar
		$this->Mhotel->insert_tunggakan($da1); //tabe kamar

		$user = array(

			'update' => $tanggal . ' ' . $waktu,

			'user' => $this->session->userdata('username') . ' [ ' . $this->session->userdata('sip') . ' ] ',

		);

		$this->Mhotel->update_user($user, $id_p); ///simpan ke tabel pesan tempat user dan tanggal update untuk pelanggan

		////////LAPORAN SHIP

		$sip = array(

			'id_user' => $this->session->userdata('id_user'),

			'ship' => $this->session->userdata('sip'),

			'ket' => 'PINDAH KAN JADI TUNGGAKAN Kamar ',

			'status' => 'TUnggakan Kamar',

			'tanggal' => $tanggal . ' ' . $waktu,

		);

		$this->Login_model->sip_login($sip);

		/////



		redirect($this->session->userdata('url'));
	}

	///////BED

	function bed($id_b, $id_p, $id_k)
	{

		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -
		$hm = $h * 60;
		$ms = $hm * 60;
		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.
		$waktu = gmdate("H:i:s", time() + ($ms));

		$bd = $this->M_bill->getRoom($id_k);


		$da = array(
			'bed' => $this->input->post('bed'), /////maish manual harga
			'harga_bed' => $this->input->post('bed') * $bd->bed, /////maish manual harga /////bias dirubah di admin
			'user' => $this->session->userdata('username'),
			'update' => $tanggal . ' ' . $waktu,

		);

		$this->Mhotel->up_bed($da, $id_b); //tabe kamar

		$user = array(
			'update' => $tanggal . ' ' . $waktu,
			'user' => $this->session->userdata('username') . ' [ ' . $this->session->userdata('sip') . ' ] ',
		);

		$this->Mhotel->update_user($user, $id_p); ///simpan ke tabel pesan tempat user dan tanggal update untuk pelanggan

		////////LAPORAN SHIP

		$sip = array(
			'id_user' => $this->session->userdata('id_user'),
			'ship' => $this->session->userdata('sip'),
			'ket' => 'Data Bed',
			'status' => 'Data Bed',
			'tanggal' => $tanggal . ' ' . $waktu,
		);

		$this->Login_model->sip_login($sip);

		/////
		redirect('C_resepsionis/bill_kam/' . $id_p);
	}

	/////////OT

	function ot($id_b, $id_p, $id_k)
	{ /////CEKOUT-------------------------------------------------------------------------------

		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -
		$hm = $h * 60;
		$ms = $hm * 60;
		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.
		$waktu = gmdate("H:i:s", time() + ($ms));


		$ots = $this->M_bill->getRoom($id_k);

		if ($this->input->post('ot') < 4) {
			$ot = $this->input->post('ot') * $ots->ot;
		} else {
			$ot = $ots->ot2;
		}



		$da = array(
			'ot' => $this->input->post('ot'), /////maish manual harga
			'harga_ot' => $ot, /////maish manual harga
			'user' => $this->session->userdata('username'),
			'update' => $tanggal . ' ' . $waktu,
		);

		$this->Mhotel->up_bed($da, $id_b); //tabe kamar

		$user = array(
			'update' => $tanggal . ' ' . $waktu,
			'user' => $this->session->userdata('username') . ' [ ' . $this->session->userdata('sip') . ' ] ',
		);

		$this->Mhotel->update_user($user, $id_p); ///simpan ke tabel pesan tempat user dan tanggal update untuk pelanggan

		////////LAPORAN SHIP
		$sip = array(
			'id_user' => $this->session->userdata('id_user'),
			'ship' => $this->session->userdata('sip'),
			'ket' => 'Data OT',
			'status' => 'Data  OT',
			'tanggal' => $tanggal . ' ' . $waktu,
		);
		$this->Login_model->sip_login($sip);

		/////
		redirect('C_resepsionis/bill_kam/' . $id_p);
	}

	/////BED DAN OT EDIT-----------------------------------------------------------------------------------------

	function bed_ot($id_b, $id_p, $id_k)
	{ /////CEKOUT

		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -
		$hm = $h * 60;
		$ms = $hm * 60;
		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.
		$waktu = gmdate("H:i:s", time() + ($ms));

		$ots = $this->M_bill->getRoom($id_k);
		if ($this->input->post('ot') < 4) {
			$ot = $this->input->post('ot') * $ots->ot;
		} else {
			$ot = $ots->ot2;
		}

		///202012 pilihan harga
		$price_type = $this->input->post('harga_kamar');
		switch ($price_type) {
			case 1:
				$price = $ots->harga_p;
				break;
			case 2:
				$price = $ots->harga_days;
				break;
			case 3:
				$price = $ots->harga_end;
				break;
			case 4:
				$price = $ots->harga_long;
				break;

			default:
				$price = $ots->harga_n;
				break;
		}
		$d_bill = [
			'id_bill' => $id_b,
			'price' => $price,
			'type' => $price_type,
		];
		$this->M_bill->UpBillPrice($d_bill);

		// DISC
		if (empty($this->input->post('dnominal'))) {
			$disc = ($this->input->post('d10') * $price) / 100;
		} else {
			$disc = $this->input->post('dnominal');
		}

		// 
		$da = array(

			'bed' => $this->input->post('bed'), /////maish manual harga
			'early' => $this->input->post('early'), /////maish manual harga
			'harga_bed' => $this->input->post('bed') * $ots->bed, /////maish manual harga

			'ot' => $this->input->post('ot'), /////maish manual harga
			'disc' => $disc,
			'harga_ot' => $ot, /////maish manual harga
			'user' => $this->session->userdata('username'),
			'update' => $tanggal . ' ' . $waktu,

		);

		$this->Mhotel->up_bed($da, $id_b); //tabe kamar

		//////////////////// NYIMPAN TANGAL UPDATE

		$user = array(
			'update' => $tanggal . ' ' . $waktu,
			'user' => $this->session->userdata('username') . ' [ ' . $this->session->userdata('sip') . ' ] ',
		);

		$this->Mhotel->update_user($user, $id_p); ///simpan ke tabel pesan tempat user dan tanggal update untuk pelnggan

		////////LAPORAN SHIP



		$sip = array(

			'id_user' => $this->session->userdata('id_user'),
			'ship' => $this->session->userdata('sip'),
			'ket' => 'Edit Data Bed dan Overtime (OT) dan DISC',
			'status' => 'Edit Data Bed dan Overtime (OT) dan DISC',
			'tanggal' => $tanggal . ' ' . $waktu,

		);

		$this->Login_model->sip_login($sip);

		/////

		redirect('C_resepsionis/bill_kam/' . $id_p);
	}

	/////HAPUS BIILLLL--------------------------------------------------------------------------------------------------------

	function hapus_bill($id_b, $id_p, $id_k, $date)
	{

		//==========================================================================

		$this->Mhotel->hapus_bill($id_b); //tabe kamar

		////

		$ck = $this->Mhotel->cekguesbill($id_p, $id_k);

		$ckdt = $this->Mhotel->cekguesbilltg($id_p, $id_k, $date);

		if ($ck == FALSE) {

			//////////MEnghapus dari status kamar ;Terisi / tidak

			$f = array(

				'id_p' => '',

				'cek' => '',

			);

			$this->Mhotel->up_cek_kamar($f, $id_k);



			////





		}

		if ($ckdt == FALSE) {

			//////////MEnghapus dari status kamar ;Terisi / tidak

			//$this->Mhotel->hapus_bill_perpanjang($id_p,$id_k,$date); //tabe Perpanfanj kepentingan tanggal

			$this->Mhotel->hapus_bill_perpanjang($id_p, $id_k, $date); //tabe Perpanfanj kepentingan tanggal



		}

		///===============================================================

		$gtbill = $this->Mhotel->getperbaikannokamar($id_p);

		$simpan = '';

		foreach ($gtbill->result() as $gtb) {

			$all = $this->db->get('tbl_kamar');



			$simpan = $simpan . '-' . $gtb->id_k;

			$hasil_no = $simpan;

			//$pec=explode('-',$hasil_no); ///jadi arrayCEKBOK no KAmar

		}

		///===============================
		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -
		$hm = $h * 60;
		$ms = $hm * 60;
		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.
		$waktu = gmdate("H:i:s", time() + ($ms));

		$user = array(

			'update' => $tanggal . ' ' . $waktu,

			'id_k' => $hasil_no,

			'user' => $this->session->userdata('username') . ' [ ' . $this->session->userdata('sip') . ' ] ',

		);

		$this->Mhotel->update_user($user, $id_p); ///simpan ke tabel pesan tempat user dan tanggal update untuk pelanggan 	



		///



		redirect('C_resepsionis/bill_kam/' . $id_p);
	}

	////HAPUS harga kamar ------------------------------------------------------------------------------------------------------------

	function hapus_hargakamar($id_b, $id_p, $id_k, $okk)
	{

		if ($okk == 'ok') {

			$hff = 'ya';
		} else {

			$hff = 'tdk';
		}

		$f = array(

			'delkam' => $hff,

		);

		$this->Mhotel->delkamar($f, $id_b);

		//



		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

		$hm = $h * 60;

		$ms = $hm * 60;

		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

		$waktu = gmdate("H:i:s", time() + ($ms));



		$user = array(

			'update' => $tanggal . ' ' . $waktu,

			'user' => $this->session->userdata('username') . ' [ ' . $this->session->userdata('sip') . ' ] ',

		);

		$this->Mhotel->update_user($user, $id_p); ///simpan ke tabel pesan tempat user dan tanggal update untuk pelanggan ///tbl_pesan_kamar

		redirect('C_resepsionis/bill_kam/' . $id_p);
	}

	//////////HAPUS TAGIHAN

	function hapus_tagihan($id, $id_p)
	{

		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

		$hm = $h * 60;

		$ms = $hm * 60;

		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

		$waktu = gmdate("H:i:s", time() + ($ms));

		$this->Mhotel->hapus_tagihan($id); //tabe kamar

		////

		$user = array(

			'update' => $tanggal . ' ' . $waktu,

			'user' => $this->session->userdata('username') . ' [ ' . $this->session->userdata('sip') . ' ] ',

		);

		$this->Mhotel->update_user($user, $id_p); ///simpan ke tabel pesan tempat user dan tanggal update untuk pelanggan\

		/////

		////

		////////LAPORAN SHIP

		$sip = array(

			'id_user' => $this->session->userdata('id_user'),

			'ship' => $this->session->userdata('sip'),

			'ket' => 'Hapus data Food, Beverage, Laundry, & Etc',

			'status' => 'Hapus data',

			'tanggal' => $tanggal . ' ' . $waktu,

		);

		$this->Login_model->sip_login($sip);

		/////

		/////

		redirect('C_resepsionis/bill_kam/' . $id_p);
	}

	///////////////simpan update kamar bill

	function up_kamar($id_p)
	{

		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

		$hm = $h * 60;

		$ms = $hm * 60;

		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

		$waktu = gmdate("H:i:s", time() + ($ms));

		///

		$all = $this->db->get('tbl_kamar');

		$simpan = '';

		if ($all->num_rows() > 0) {

			foreach ($all->result() as $aa) {

				if ($this->input->post('k_' . $aa->id_kamar)) {

					$simpan = $simpan . '-' . $aa->id_kamar;
				}
			}
		}

		$hasil_no = $simpan;

		$pec = explode('-', $hasil_no);

		///

		$tgl2 = date('d-m-Y', strtotime('+1 days', strtotime($this->input->post('tgl'))));

		$tgl1 = $this->input->post('tgl');

		$sortt = $tgl1;

		$xxx = substr($sortt, '6', '4');

		$xx = substr($sortt, '3', '2');

		$x = substr($sortt, '0', '2');

		///

		for ($ii = 1; $ii < count($pec); $ii++) {





			$da = array(



				'id_p' => $id_p, /////maish manual harga

				'id_k' => $pec[$ii], /////maish manual harga

				'tanggal' => $tgl1,

				'sort_t' => $xxx . '' . $xx . '' . $x,

				'user_awal' => $this->session->userdata('username'),

				'insert' => $tanggal . ' ' . $waktu,





			);

			$this->Mhotel->up_bill_hotel($da); //tabe bill hotel

		} ////

		$sortt_p = $tgl2;

		$xxx1 = substr($sortt_p, '6', '4');

		$xx1 = substr($sortt_p, '3', '2');

		$x1 = substr($sortt_p, '0', '2');





		for ($iii = 1; $iii < count($pec); $iii++) {





			$da = array(



				'id_p' => $id_p, /////maish manual harga

				'id_k' => $pec[$iii], /////maish manual harga

				'tanggal' => $tgl2,

				'cekout' => $xxx1 . '' . $xx1 . '' . $x1,



			);

			$this->Mhotel->up_perpanjangan($da); //tabe bill hotel ...yang di butuhkan data tanggal cekout 

		}

		/////

		$g_id = $this->db->get_where('tbl_pesan_kamar', array('id' => $id_p));

		$user = array(

			'update' => $tanggal . ' ' . $waktu,

			'id_k' => $hasil_no . '' . $g_id->row()->id_k,

			'user' => $this->session->userdata('username') . ' [ ' . $this->session->userdata('sip') . ' ] ',

		);

		$this->Mhotel->update_user($user, $id_p); ///simpan ke tabel pesan tempat user dan tanggal update untuk pelanggan



		////



		for ($i = 1; $i < count($pec); $i++) {

			//  if ($all->id_kamar == $pec[$i]){ untuk cek bok

			$da = array(

				//'tanggal' => $tanggal,

				'cek' => 'terisi',

				//'user' => $this->session->userdata('username').' [ '.$this->session->userdata('sip').' ] ',

				'id_p' => $id_p,

				//'update' => $tanggal.'&nbsp;'.$waktu

				'user_awal' => $this->session->userdata('username'),

				'insert' => $tanggal . ' ' . $waktu,



			);

			$this->Mhotel->up_cek_pesan($da, $pec[$i]); //tabe kamar

		}

		//

		////////LAPORAN SHIP



		$sip = array(

			'id_user' => $this->session->userdata('id_user'),

			'ship' => $this->session->userdata('sip'),

			'ket' => 'Menambah data Room',

			'status' => 'Menambah data Room',

			'tanggal' => $tanggal . ' ' . $waktu,

		);

		$this->Login_model->sip_login($sip);

		/////



		redirect('C_resepsionis/bill_kam/' . $id_p);
	}

	////////////////////////////

	function perpanjang_kamar($id_p)
	{ /////prpanjangan PErubahan Waktu

		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

		$hm = $h * 60;

		$ms = $hm * 60;

		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

		$waktu = gmdate("H:i:s", time() + ($ms));

		///===============================================================

		$all = $this->db->get('tbl_kamar');

		$simpan = '';

		if ($all->num_rows() > 0) {

			foreach ($all->result() as $aa) {

				if ($this->input->post('k_' . $aa->id_kamar)) {

					$simpan = $simpan . '-' . $aa->id_kamar;
				}
			}
		}

		$hasil_no = $simpan;

		$pec = explode('-', $hasil_no); ///CEKBOK no KAmar

		$hasila = $this->input->post('hari');

		///====================================================================================



		///=================================================================



		for ($ii = 0; $ii < $hasila; $ii++) {  ///======================PENGULANGAN TANGGAL

			for ($iii = 1; $iii < count($pec); $iii++) { ////PENGULANGAN NO KAMAR



				$g_id = $this->Mhotel->get_tbl_perpanjang($pec[$iii], $id_p)->row();

				//============================================================REV 17================================================

				$g_id_mak_bill = $this->Mhotel->get_tbl_perpanjang_mak_new_idk($pec[$iii], $id_p)->row();

				/////////////////////////////////////////////////////////////////////////////



				//==============

				if (empty($g_id->cekout)) {

					$ssrt = $g_id_mak_bill->sort_t + 1;
				} else {

					$ssrt = $g_id->cekout;
				}

				//======================

				$xxx = substr($ssrt, '0', '4');

				$xx = substr($ssrt, '4', '2');

				$x = substr($ssrt, '6', '2');

				$tgl1 = $x . '-' . $xx . '-' . $xxx;

				////====================

				$tgl2 = date('d-m-Y', strtotime('+' . $hasila . ' days', strtotime($tgl1))); //operasi penjumlahan tanggal sebanyak 6 hari

				$sortt = date('d-m-Y', strtotime('+' . $ii . ' days', strtotime($tgl1)));

				$xxx = substr($sortt, '6', '4');

				$xx = substr($sortt, '3', '2');

				$x = substr($sortt, '0', '2');

				//=======================================REV 17





				$daa = array(

					//'tanggal'=> date('d-m-Y', strtotime('+'.$ii.' days', strtotime($tgl2))), //operasi penjumlahan tanggal sebanyak 6 hari

					'tanggal' => date('d-m-Y', strtotime('+' . $ii . ' days', strtotime($tgl1))), //operasi penjumlahan tanggal sebanyak 6 hari

					'id_p' => $id_p,

					'id_k' => $pec[$iii],

					'sort_t' => $xxx . '' . $xx . '' . $x,

					'user' => $this->session->userdata('username'),

					'update' => $tanggal . ' ' . $waktu



				);

				$this->Mhotel->up_bill_hotel($daa); //tabe bill hotel

			}
		}

		///////



		for ($iiii = 1; $iiii < count($pec); $iiii++) {  ////PEngulanga hanya Kamar saja Untuk Tbl PErpanjangan



			////==================================REV17

			$g_id_up = $this->Mhotel->get_tbl_perpanjang($pec[$iiii], $id_p);

			$g_id_mak_bill_p = $this->Mhotel->get_tbl_perpanjang_mak_new_idk($pec[$iiii], $id_p)->row();

			//==============

			if (empty($g_id_up->cekout)) {

				$ssrt_p = $g_id_mak_bill_p->sort_t + 1;
			} else {

				$ssrt_p = $g_id_up->cekout;
			}

			//======================

			$xxxp = substr($ssrt_p, '0', '4');

			$xxp = substr($ssrt_p, '4', '2');

			$xp = substr($ssrt_p, '6', '2');

			$tgl_up = $xp . '-' . $xxp . '-' . $xxxp;

			////====================



			$daaa = array(

				'tanggal' => date('d-m-Y', strtotime('+' . $hasila . ' days', strtotime($tgl_up))), //operasi penjumlahan tanggal sebanyak 6 hari

				'id_p' => $id_p,

				'id_k' => $pec[$iiii],

				'cekout' => $xxxp . '' . $xxp . '' . $xp, ///untuk pengukuran



			);

			$this->Mhotel->up_perpanjangan_a($daaa, $pec[$iiii]);  ///updete masing masing



		}



		/////



		/////=========================================================TBL PeSAN KAMAR=========================

		$user = array(



			'update' => $tanggal . ' ' . $waktu,

			'user' => $this->session->userdata('username') . ' [ ' . $this->session->userdata('sip') . ' ] ',



		);

		$this->Mhotel->update_user($user, $id_p); ///simpan ke tabel pesan tempat user dan tanggal update untuk pelanggan



		////

		////////============================================LAPORAN SHIP======================================



		$sip = array(

			'id_user' => $this->session->userdata('id_user'),

			'ship' => $this->session->userdata('sip'),

			'ket' => 'Memperpanjang Room',

			'status' => 'Memperpanjang Room',

			'tanggal' => $tanggal . ' ' . $waktu,

		);

		$this->Login_model->sip_login($sip);

		/////   	

		//



		redirect('C_resepsionis/bill_kam/' . $id_p);
	}

	///////cekin KAN YAng PESAN KAMAR

	function cekin($id)

	{

		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

		$hm = $h * 60;

		$ms = $hm * 60;

		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

		$waktu = gmdate("H:i:s", time() + ($ms));



		$all = $this->db->get('tbl_kamar');

		$getid_k = $this->db->get_where('tbl_pesan_kamar', array('id' => $id));

		/////untuk memecah id_k

		$pec = explode('-', $getid_k->row()->id_k);



		//

		$data = array(



			'boking' => 'no',



		);



		$this->Mhotel->simpan_pesan_up($data, $id); ///UPDATE ke tabel pesan tempat user dan tanggal update

		//

		$id_last = $id;

		//============================================================================================================================               



		for ($i = 1; $i < count($pec); $i++) {

			//  if ($all->id_kamar == $pec[$i]){ untuk cek bok

			$da = array(

				//'tanggal' => $tanggal,

				'cek' => 'terisi',

				'id_p' => $id_last,

				'user_awal' => $this->session->userdata('username'),

				'insert' => $tanggal . ' ' . $waktu



			);

			$this->Mhotel->up_cek_pesan($da, $pec[$i]); //tabe kamar

			//}

		}

		//TANGGAL
		$CheckInX = explode("-", substr($getid_k->row()->cekin, '0', '-6'));

		$CheckOutX =  explode("-", substr($getid_k->row()->cekout, '0', '-6'));

		//	

		$date1 =  mktime(0, 0, 0, $CheckInX[1], $CheckInX[0], $CheckInX[2]); ///jam,menit,detik,bulan,tanggal,tahun 

		$date2 =  mktime(0, 0, 0, $CheckOutX[1], $CheckOutX[0], $CheckOutX[2]);

		$interval = ($date2 - $date1) / (3600 * 24);

		//$hasil = ($interval < 1) ? (1) : $interval;  

		$hasil = $interval;

		if ($hasil <= 0) {

			$hasila = $hasil + 1;
		} else {

			$hasila = $hasil;
		}

		//

		//for($ii = 1; $ii <= count($hasil); $ii++){

		for ($ii = 0; $ii < $hasila; $ii++) {

			for ($iii = 1; $iii < count($pec); $iii++) {

				$tgl1 = substr($this->input->post('cekin'), '0', '-6');

				//$tgl2 = date('d/m/Y', strtotime('+'.$ii.' days', strtotime($tgl1))); //operasi penjumlahan tanggal sebanyak 6 hari

				$sortt = date('d-m-Y', strtotime('+' . $ii . ' days', strtotime($tgl1)));

				$xxx = substr($sortt, '6', '4');

				$xx = substr($sortt, '3', '2');

				$x = substr($sortt, '0', '2');

				//$date3 =  mktime(0, 0, 0, $sort[1],$sort[0],$sort[2]);

				$daa = array(

					//'tanggal'=> substr($this->input->post('cekin'),'0','-14')+$ii.'/'.substr($this->input->post('cekin'),'3','-11').'/'.substr($this->input->post('cekin'),'6','-6'), //01/01/2016

					//'tanggal'=> $ii,

					//'tanggal'=> date($tgl1, mktime(0,0,0,date("m"),date("d")+$ii,date("Y"))),

					'tanggal' => date('d-m-Y', strtotime('+' . $ii . ' days', strtotime($tgl1))), //operasi penjumlahan tanggal sebanyak 6 hari

					'sort_t' => $xxx . '' . $xx . '' . $x, //operasi penjumlahan tanggal sebanyak 6 hari

					//	'tanggal' =>mktime(0, 0, 0, $CheckInX[1],$CheckInX[0]+$ii,$CheckInX[2]),

					'id_p' => $id_last,

					'id_k' => $pec[$iii],

					'user_awal' => $this->session->userdata('username'),

					'insert' => $tanggal . ' ' . $waktu,

					//'update' => $tanggal.'&nbsp;'.$waktu



				);

				$this->Mhotel->up_bill_hotel($daa); //tabe bill hotel

			} ////pengulang no kmar

		} ///pengulangan tanggal

		///

		for ($iiii = 1; $iiii < count($pec); $iiii++) {



			$sortt_up = date('d-m-Y', strtotime('+' . $hasila . ' days', strtotime($tgl1)));

			$xxx1 = substr($sortt_up, '6', '4');

			$xx1 = substr($sortt_up, '3', '2');

			$x1 = substr($sortt_up, '0', '2');

			/////TBL PErpanjangan 

			$daaa = array(

				'tanggal' => date('d-m-Y', strtotime('+' . $hasila . ' days', strtotime($tgl1))), //operasi penjumlahan tanggal sebanyak 6 hari

				'cekout' => $xxx1 . '' . $xx1 . '' . $x1,

				'id_p' => $id_last,

				'id_k' => $pec[$iiii],

				//'update' => $tanggal.'&nbsp;'.$waktu



			);

			$this->Mhotel->up_perpanjangan($daaa);
		} ///pengulang kamar tapi tanggal tidak di ulang

		///



		////////LAPORAN SHIP



		$sip = array(

			'id_user' => $this->session->userdata('id_user'),

			'ship' => $this->session->userdata('sip'),

			'ket' => 'Input data Guest Bill yang Benama ' . $this->input->post('nama') . '  Alamat ' . $this->input->post('alamat'),

			'status' => 'Input data Guest Bill',

			'tanggal' => $tanggal . ' ' . $waktu,

		);

		$this->Login_model->sip_login($sip);

		/////

		/*

	$daa = array(

		'tanggal' => substr($'';''this->input->post('cekin'),'0','-6'),

		//'cek' => 'terisi',

		'id_p' => $id_last,

		'update' => $tanggal.'&nbsp;'.$waktu

		

		);

	$this->Mhotel->up_bill_hotel($daa); //tabe bill hotel

 */

		//DEPOSIT

		/*$depo=array('id_p' => $id_last,

 		'tanggal' => $tanggal,

 		//'cas' => $this->input->post('db'),

 	);

 $this->Mhotel->simpan_deposit($depo);/////tbl_deposit */

		//

		$this->session->set_flashdata("pesan", "<div class=\"col-xs-12-md-12\"><div class=\"alert alert-success\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Saudara " . $this->input->post('nama') . " Telah Memesan Kamar </div></div>");



		redirect('C_resepsionis/cek_boking');
	}



	/////SEMENTARA KALPAO ADMIN SHIP

	public function lap_shifs($thn = NULL)

	{
		if ($this->session->userdata('login') == TRUE) {

			//

			$q = $this->Minfo->info()->row();



			//



			$data['namapt'] = !empty($q->namapt) ? $q->namapt : $this->config->item('nameAPP');

			$data['logo'] = !empty($q->logo) ? $q->logo : 'logo';

			//$data['main_view'] = 'admin/awal';

			$data['main_view'] = 'admin/awal_shifs'; ///yang mau di pake



			//

			$data['nama_app'] = 'LAPORAN MASING-MASING SHIFT  ' . $q->namapt;

			$data['title'] = 'LAPORAN MASING-MASING SHIFT  ' . $q->namapt;

			//

			if ($thn == NULL) {

				$data['thn'] = date('Y');
			} else {

				$data['thn'] = $thn;
			}

			$data['con'] = 'C_resepsionis';

			///

			$data['e'] = 'active';

			$data['nav'] = 'nonactive';

			$data['a'] = $data['b'] = $data['c'] = $data['d'] = $data['g'] = $data['f'] = '';

			$data['p'] = ''; //tambahan dari MASTERPRA 16MARET2017

			//



			$data['q'] = $this->Mhotel->cek_kamar();

			$this->load->view('resepsionis/beranda', $data);



			//

		} else {

			redirect('login');
		}
	}

	////REFUND



	function refund($id, $via, $nama)
	{



		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

		$hm = $h * 60;

		$ms = $hm * 60;

		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

		$waktu = gmdate("H:i:s ", time() + ($ms));



		$data1 = array(

			'id_user' => $this->session->userdata('id_user'),

			'user' => $this->session->userdata('username'),

			'id_tgl' => $this->session->userdata('id_tgl'),

			'shift' => $this->session->userdata('sip'),

			'id_p' => $id,

			//'nama'=>$nama,

			'via' => $via,

			'update' => $tanggal . ' ' . $waktu,

			'tanggal' => $tanggal,

			'status' => 'lunas',



		);

		$data2 = array(

			'id_user' => $this->session->userdata('id_user'),

			'user' => $this->session->userdata('username'),

			'id_p' => $id,

			'via' => $via,

			'id_tgl' => $this->session->userdata('id_tgl'),

			'shift' => $this->session->userdata('sip'),

			'update' => $tanggal . ' ' . $waktu,

			'tanggal' => $this->input->post('tglkom'),

			'hotel' => $this->input->post('hotel'),

			'nota' => $this->input->post('nota'),

			'nominal' => $this->input->post('nominal'),

			'nama' => $this->input->post('anama'),

			'atas_nama' => $this->input->post('anama2'),

			'tglci' => $this->input->post('c/i'),

			'tglco' => $this->input->post('c/o'),

			'bank' => $this->input->post('bank'),

			'tipe_kamar' => $this->input->post('tkamar'),

			'norek' => $this->input->post('rek'),

			'status' => 'lunas',

		);

		$data0 = array(

			'refund' => 'ok',
			'id_tgl' => $this->session->userdata('id_tgl'),
			'shift' => $this->session->userdata('sip'),
			'refund_status' => 'lunas',

		);



		if ($via == 'cash') {

			$data = $data1;
		} else {

			$data = $data2;
		}

		$this->session->set_flashdata("pesan", "<div class=\"col-xs-12-md-12\"><div class=\"alert alert-success\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Data Sudah Tersimpan</div></div>");





		/////////cek supya ga nyimpan ganda

		$t = $this->Mhotel->cek_refund($id);

		//

		if ($t == TRUE) {

			$this->Mhotel->simpan_up_refund($id, $data);
		} else {

			$this->Mhotel->simpan_refund($data);
		}





		$this->Mhotel->simpan_refund_pesan($id, $data0); ///simpan ke tabel pesan kamar 

		/////=============================REKAM

		$sip = array(

			'id_user' => $this->session->userdata('id_user'),

			'ship' => $this->session->userdata('sip'),

			'ket' => 'refund ',

			'status' => 'mengaktifkan refund Via ' . $via,

			'tanggal' => $tanggal . ' ' . $waktu,

		);

		$this->Login_model->sip_login($sip);

		/////

		$user = array(

			'update' => $tanggal . ' ' . $waktu,

			'user' => $this->session->userdata('username') . ' [ ' . $this->session->userdata('sip') . ' ] ',

		);

		$this->Mhotel->update_user($user, $id); ///simpan ke tabel pesan tempat user dan tanggal update untuk pelanggan

		///////

		//redirect($this->session->userdata('url'));

		redirect('C_resepsionis/bill_kam/' . $id);
	}

	function simpan_editnama($id_p)
	{
		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -
		$hm = $h * 60;
		$ms = $hm * 60;
		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.
		$waktu = gmdate("H:i:s ", time() + ($ms));
		$time_in = $this->input->post('time_in');
		$time_out = $this->input->post('time_out');
		$user = array(

			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'cekin' => $this->input->post('cekin') . '' . $time_in,
			'cekout' => $this->input->post('cekout') . '' . $time_out,

			'update' => $tanggal . ' ' . $waktu,
			'user' => $this->session->userdata('username') . ' [ ' . $this->session->userdata('sip') . ' ] ',

		);

		$this->Mhotel->update_user($user, $id_p); ///simpan ke tabel pesan tempat user dan tanggal update untuk pelanggan

		$this->session->set_flashdata("pesan", "<div class=\"col-xs-12-md-12\"><div class=\"alert alert-success\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Data Sudah Tersimpan</div></div>");

		redirect('C_resepsionis/bill_kam/' . $id_p);
	}

	function cekoutbeberapa()
	{

		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

		$hm = $h * 60;

		$ms = $hm * 60;

		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

		$waktu = gmdate("H:i:s ", time() + ($ms));



		/////=============================REKAM

		$sip = array(

			'id_user' => $this->session->userdata('id_user'),

			'ship' => $this->session->userdata('sip'),

			'ket' => 'CHECKOUT ',

			'status' => 'CHECKOUT kamar',

			'tanggal' => $tanggal . ' ' . $waktu,

		);

		$this->Login_model->sip_login($sip);

		/////



		///========================================MEMECAH CEKBOK

		$all = $this->db->get('tbl_kamar');

		$simpan = '';

		if ($all->num_rows() > 0) {

			foreach ($all->result() as $aa) {

				if ($this->input->post($aa->id_kamar)) {

					$simpan = $simpan . '-' . $aa->id_kamar;
				}
			}
		}

		$hasil_no = $simpan;

		$pec = explode('-', $hasil_no);

		///

		for ($i = 1; $i < count($pec); $i++) {

			$da = array(

				//'tanggal' => $tanggal,

				'cek' => 'Kosong',

				'id_p' => '',

				'user' => $this->session->userdata('username'),

				'update' => $tanggal . ' ' . $waktu



			);

			$this->Mhotel->up_cek_pesan($da, $pec[$i]); //tabe kamar

		} //loop kamar

		redirect('C_resepsionis/cek_kam/#' . $pec[$i]);
	} //fu



	/*----------------------tambahan dari MASTERPRA 16MARET2017-------------------*/

	/////BOOKING KAMAR

	public function book()

	{
		if ($this->session->userdata('login') == TRUE) {



			$q = $this->Minfo->info()->row();



			//

			$data['namapt'] = !empty($q->namapt) ? $q->namapt : $this->config->item('nameAPP');

			$data['logo'] = !empty($q->logo) ? $q->logo : 'logo';

			$data['main_view'] = 'resepsionis/book_kamar';



			//

			$data['nama_app'] = $q->namapt;

			$data['title'] = $q->namapt;

			//

			$data['aa'] = $data['a'] = '';

			$data['b'] = $data['c'] = $data['d'] = $data['a1'] = $data['e'] = '';

			$data['p'] = 'active'; //tambahan dari MASTERPRA 16MARET2017

			//



			$data['q'] = $this->Mhotel->cek_kamar();

			$this->load->view('resepsionis/beranda', $data);
		} else {

			redirect('login/simpeg');
		}
	}



	/////BOOKING KAMAR

	function save_book()

	{

		// Persiapan untuk no kmar cek bok

		$all = $this->db->get('tbl_kamar');

		$simpan = '';

		if ($all->num_rows() > 0) {

			foreach ($all->result() as $aa) {

				if ($this->input->post('k_' . $aa->id_kamar)) {

					$simpan = $simpan . '-' . $aa->id_kamar;
				}
			}
		}

		$hasil_no = $simpan;

		if (!empty($hasil_no)) {







			$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

			$hm = $h * 60;

			$ms = $hm * 60;

			$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

			$waktu = gmdate("H:i:s", time() + ($ms));











			//////

			$data = array(

				'nama' => $this->input->post('nama'),

				'alamat' => $this->input->post('alamat'),

				'no_contact' => $this->input->post('hp'),

				'insert' => $tanggal . ' ' . $waktu,

				'cekin' => $this->input->post('cekin'),

				//'tanggal' =>  $this->input->post('tgl'),



				'id_user' => $this->session->userdata('id_user'),

				'shift' => $this->session->userdata('sip'),

				'id_tgl' => $this->session->userdata('id_tgl'),

				'user_awal' => $this->session->userdata('username') . ' [ ' . $this->session->userdata('sip') . ' ] ',

				'cekout' => $this->input->post('cekout'),

				//'rek' => $this->input->post('rek'),

				//'bank' => $this->input->post('bank'),

				//'nominal' => $this->input->post('nominal'),

				//'nota' => $buatnotaq,

				'tipe' => $bak = 0,

				//'Status' => 'Lunas',

				'boking' => 'ya',



				'id_k' => $hasil_no,

			);



			$this->Mhotel->save_book($data); ///simpan ke tabel pesan tempat user dan tanggal update ////tabel pesan kamar



			$id_last = $this->Mhotel->id_last()->row()->id;



			////////////

			////////////////BUAT NOTA boking





			/////////         







			$pec = explode('-', $hasil_no);





			////////LAPORAN SHIP



			$sip = array(

				'id_user' => $this->session->userdata('id_user'),

				'ship' => $this->session->userdata('sip'),

				'ket' => 'Input data Pemesan Kamar yang Benama ' . $this->input->post('nama') . '  Alamat ' . $this->input->post('alamat'),

				'status' => 'Input data Room Booking',

				'tanggal' => $tanggal . ' ' . $waktu,

			);

			$this->Login_model->sip_login($sip); //tabel laporan sip

			/////









			//

			$this->session->set_flashdata("pesan", "<div class=\"col-xs-12-md-12\"><div class=\"alert alert-success\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Data berhasil di simpan, <br/> Tekan tombol Lanjut untuk kembali. </div></div>");



			//redirect('C_resepsionis/deposit_bar');

			redirect('C_resepsionis/viewcetak/' . $id_last);
		} else { ///Deposit_bar

			$this->session->set_flashdata('pesan', "<div class=\"col-xs-12-md-12\"><div class=\"alert alert-danger\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Maaf , Data gagal di simpan .<br/> Mohon Pilih No Kamar Salah Satu . </div></div>");

			redirect('C_resepsionis/Deposit_bar');
		}
	} ///f



	/*----------------------tambahan dari MASTERPRA 16MARET2017-------------------*/
}
