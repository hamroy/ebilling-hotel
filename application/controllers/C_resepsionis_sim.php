<?php

defined('BASEPATH') or exit('No direct script access allowed');



class C_resepsionis_sim extends CI_Controller
{

	function __construct()
	{

		parent::__construct();

		$this->load->model('Minfo', '', TRUE);

		$this->load->model('Mhotel', '', TRUE);

		$this->load->model('Login_model', '', TRUE);

		$this->load->model('Madmin', '', TRUE);
	}






	//=================SIMPAN PAKE VALIDASI VERSI 17-==========================================

	function simpan_sim()

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
		$pec = explode('-', $hasil_no); ////di pecah  dalam bentu array

		///////////////////////////////////////==============================================================
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


				/////////////////////////////SIMPAN KE TPL PESAN KAMAR

				$data = array(

					'nama' => $this->input->post('nama'),

					'insert' => $tanggal . ' ' . $waktu,


					'alamat' => $this->input->post('alamat'),

					'cekin' => $this->input->post('cekin'),

					'user_awal' => $this->session->userdata('username') . ' [ ' . $this->session->userdata('sip') . ' ] ',

					'cekout' => $this->input->post('cekout'),

					'id_user' => $this->session->userdata('id_user'),

					'nota' => '',

					'boking' => 'no',

					'id_k' => $hasil_no,

				);



				$this->Mhotel->simpan_pesan_sim($data); ///simpan ke tabel pesan kamar tempat user dan tanggal update

				/////////////////////////////SIMPAN KE TPL PESAN KAMAR




				$id_last = $this->Mhotel->id_last_sim()->row()->id; //////get id terakgir di tbl pesankamr




				//TANGGAL

				$CheckInX = explode("-", substr($this->input->post('cekin'), '0', '-6'));

				$CheckOutX =  explode("-", substr($this->input->post('cekout'), '0', '-6'));

				//	

				$date1 =  mktime(0, 0, 0, $CheckInX[1], $CheckInX[0], $CheckInX[2]); ///jam,menit,detik,bulan,tanggal,tahun 

				$date2 =  mktime(0, 0, 0, $CheckOutX[1], $CheckOutX[0], $CheckOutX[2]);

				$interval = ($date2 - $date1) / (3600 * 24);


				$hasil = $interval;

				if ($hasil <= 0) {

					$hasila = $hasil + 1;
				} else {

					$hasila = $hasil;
				}

				//===================================================================================================

				for ($ii = 0; $ii < $hasila; $ii++) {

					for ($iii = 1; $iii < count($pec); $iii++) {

						$tgl1 = substr($this->input->post('cekin'), '0', '-6');

						//$tgl2 = date('d/m/Y', strtotime('+'.$ii.' days', strtotime($tgl1))); //operasi penjumlahan tanggal sebanyak 6 hari

						$sortt = date('d-m-Y', strtotime('+' . $ii . ' days', strtotime($tgl1)));

						$xxx = substr($sortt, '6', '4');

						$xx = substr($sortt, '3', '2');

						$x = substr($sortt, '0', '2');


						$daa = array(


							'tanggal' => date('d-m-Y', strtotime('+' . $ii . ' days', strtotime($tgl1))), //operasi penjumlahan tanggal sebanyak 6 hari

							'sort_t' => $xxx . '' . $xx . '' . $x, //operasi penjumlahan tanggal sebanyak 6 hari

							'id_p' => $id_last,

							'id_k' => $pec[$iii],

							'user_awal' => $this->session->userdata('username'),

							'insert' => $tanggal . ' ' . $waktu,


						);

						$this->Mhotel->up_bill_hotel_sim($daa); //tabe bill hotel

					} ////pengulang no kmar

				} ///pengulangan tanggal

				///======================================================================================================PERPANJANG

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


					);

					$this->Mhotel->up_perpanjangan_sim($daaa); ////tbl perpanjang



				} ///pengulang kamar tapi tanggal tidak di ulang

				///



				////////LAPORAN SHIP



				$sip = array(

					'id_user' => $this->session->userdata('id_user'),

					'ship' => $this->session->userdata('sip'),

					'ket' => 'Input data Guest Bill yang Benama ' . $this->input->post('nama') . '  Alamat ' . $this->input->post('alamat') . ' (simulator) ',

					'status' => 'Input data Guest Bill (simulator)',

					'tanggal' => $tanggal . ' ' . $waktu,

				);

				$this->Login_model->sip_login($sip);

				/////



				/////// unti=uk menmbah bars di kolom deposit  guest bar

				$data0 = array('id_p' => $id_last);

				$this->Mhotel->simpan_deposit($data0);
				$this->Mhotel->simpan_deposit_sim($data0);



				////////


				//============SUCCESS

				$this->session->set_flashdata("pesan", "<div class=\"col-xs-12-md-12\"><div class=\"alert alert-success\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Data Berhasil Di simpan . </div></div>");



				redirect('C_resepsionis/bill_kam/' . $id_last . '/ya');
			} else { ///falidasi

				$this->session->set_flashdata('pesan', "<div class=\"col-xs-12-md-12\"><div class=\"alert alert-danger\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Maaf , Data gagal di simpan .<br/> Mohon pingisiian diisi Lengkap </div></div>");

				redirect('C_resepsionis/simulasi_kam');
			} ///validasi	

		} else { ////tidak memilik kmar

			$this->session->set_flashdata('pesan', "<div class=\"col-xs-12-md-12\"><div class=\"alert alert-danger\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Maaf , Data gagal di simpan .<br/> Mohon Pilih No Kamar Salah Satu . </div></div>");

			redirect('C_resepsionis/simulasi_kam');
		}
	} ///funsui








	//////food dan ll yang menginap

	function simpan_tagihan_sim($p, $sm)
	{



		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

		$hm = $h * 60;

		$ms = $hm * 60;

		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

		$waktu = gmdate("H:i:s ", time() + ($ms));

		//$p=$this->input->post('id_p'); id pengunjung

		$ka = $this->db->get_where('tbl_pesan_kamar_sim', array('id' => $p))->row()->id_k;

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



		$this->Mhotel->simpan_tagihan_sim_mod($data);

		/////simpan orang yang merubah

		$user = array(

			'update' => $tanggal . ' ' . $waktu,

			'user' => $this->session->userdata('username') . '[ ' . $this->session->userdata('sip') . ' ] ',

		);



		$this->Mhotel->update_user_sim($user, $p); ///simpan ke tabel pesan tempat user dan tanggal update

		//////

		////////LAPORAN SHIP

		$sip = array(

			'id_user' => $this->session->userdata('id_user'),

			'ship' => $this->session->userdata('sip'),

			'ket' => '(simulasi) Tambah data Food, Beverage, Laundry, & Etc',

			'status' => '(simulasi) Tambah data',

			'tanggal' => $tanggal . ' ' . $waktu,

		);

		$this->Login_model->sip_login($sip);

		/////

		redirect('C_resepsionis/bill_kam/' . $p . '/' . $sm);
	}



	////////EDIT TAGIHAN DI BILL ok

	function edit_tagihan_sim($id, $p, $sm)
	{



		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

		$hm = $h * 60;

		$ms = $hm * 60;

		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

		$waktu = gmdate("H:i:s ", time() + ($ms));

		//$p=$this->input->post('id_p'); id pengunjung

		$ka = $this->db->get_where('tbl_pesan_kamar_sim', array('id' => $p))->row()->id_k;

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



			'update_edit' => $tanggal . ' ' . $waktu,








			'tanggal' => $this->input->post('tanggal'),

			//	'waktu' => $waktu,

		);

		$this->session->set_flashdata("pesan", "<div class=\"col-xs-12-md-12\"><div class=\"alert alert-success\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Data Sudah Tersimpan</div></div>");



		$this->Mhotel->simpan_tagihan_e_sim($id, $data);

		/////simpan orang yang merubah

		$user = array(

			'update' => $tanggal . ' ' . $waktu,

			'user' => $this->session->userdata('username') . '[ ' . $this->session->userdata('sip') . ' ] ',

		);



		$this->Mhotel->update_user_sim($user, $p); ///simpan ke tabel pesan tempat user dan tanggal update

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

		redirect('C_resepsionis/bill_kam/' . $p . '/' . $sm);
	}

	//////////Tambah baris di posit data NULL

	function s_deposit_sim($id_p, $sm)
	{


		$data0 = array('id_p' => $id_p);

		if ($sm == 'ya') {
			$this->Mhotel->simpan_deposit_sim($data0);
		} else {
			$this->Mhotel->simpan_deposit($data0);
		}


		redirect('C_resepsionis/bill_kam/' . $id_p . '/' . $sm);
	}

	/////untuk input cas dan transfer PELUNASAN///////////////////////////////////////////////////------ok----------------------------------------------------

	function up_transfer_sim($id_p, $id, $sm)
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

			$t = 'C'; ///tbl deposit

			$t1 = 'K'; ////tbl pesan kamar

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

		$this->Mhotel->simpan_deposit_sim($data);





		/////simpan orang yang merubah ke tbl pesan kamar

		/////////-----------------------------------------------------------------nyimpan data ke tabel pemesan 

		$user = array(

			'update' => $tanggal . ' ' . $waktu,

			'tipe' => $t1,

			'nota' => $h_nota = 0,

			'rek' => $this->input->post('rek'),

			'bank' => $this->input->post('bank'),

			'nominal' => $this->input->post('nominal'),


			'user' => $this->session->userdata('username') . ' [ ' . $this->session->userdata('sip') . ' ] ',

		);



		/////////////////////////////////////////////////tabel LOG//////////////////////////////////////////////////

		$this->Mhotel->update_user_sim($user, $id_p); ///simpan ke tabel pesan tempat user dan tanggal update

		////////LAPORAN SHIP

		$sip = array(

			'id_user' => $this->session->userdata('id_user'),

			'ship' => $this->session->userdata('sip'),

			'ket' => '(simulasi) Input Deposit Pelunasan sebesar ' . $this->input->post('cas') . '' . $this->input->post('cas_t'),

			'status' => '(simulasi) Input Deposit Pelunasan ',

			'tanggal' => $tanggal . ' ' . $waktu,

		);

		$this->Login_model->sip_login($sip);

		/////



		redirect('C_resepsionis/bill_kam/' . $id_p . '/' . $sm);

		///////////////+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

	}

	/////untuk input cas dan transfer Untuk DEPOSIT---------------ok---------------------------------------------------------------------------------------

	function up_transfer_dep_sim($id_p, $id, $sm)
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



		$dtcek = $this->Mhotel->cari_id_dep_sim($id);

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

				'tanggal' =>  $this->input->post('date'),

			);

			////

			$this->Mhotel->update_deposit_sim($data, $id);

			/////

			////////LAPORAN SHIP memperbaharui

			$sip = array(

				'id_user' => $this->session->userdata('id_user'),

				'ship' => $this->session->userdata('sip'),

				'ket' => '(simulasi) Memperbaharui  Deposit Menjadi sebesar ' . $this->input->post('cas') . '' . $this->input->post('cas_t'),

				'status' => '(simulasi)  Edit Deposit',

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

				'tanggal' =>  $this->input->post('date'),

			);

			//////

			$this->Mhotel->simpan_deposit_sim($data); /////simpan data baru

			//////

			////////LAPORAN SHIP

			$sip = array(

				'id_user' => $this->session->userdata('id_user'),

				'ship' => $this->session->userdata('sip'),

				'ket' => '(simulasi) Input Deposit sebesar ' . $this->input->post('cas') . '' . $this->input->post('cas_t'),

				'status' => '(simulasi)  Input Deposit',

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



		$this->Mhotel->update_user_sim($user, $id_p); ///simpan ke tabel pesan tempat user dan tanggal update



		redirect('C_resepsionis/bill_kam/' . $id_p . '/' . $sm);

		//$this->bill_kam($id_p);

	}

	/////DISCONT

	function gift_sim($a, $id_p, $sm)
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



		$this->Mhotel->update_user_sim($user, $id_p); ///simpan ke tabel pesan tempat user dan tanggal update untuk pelanggan

		///

		////////LAPORAN SHIP

		$sip = array(

			'id_user' => $this->session->userdata('id_user'),

			'ship' => $this->session->userdata('sip'),

			'ket' => '(simulasi) Meng' . $a . 'kan DISCONT Member ',

			'status' => '(simulasi) DISCONT ' . $a,

			'tanggal' => $tanggal . ' ' . $waktu,

		);

		$this->Login_model->sip_login($sip);

		/////



		redirect('C_resepsionis/bill_kam/' . $id_p . '/' . $sm);
	}


	///////BED ok

	function bed_sim($id_b, $id_p, $id_k, $sm)
	{

		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

		$hm = $h * 60;

		$ms = $hm * 60;

		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

		$waktu = gmdate("H:i:s", time() + ($ms));


		$bd = $this->db->get_where('tbl_kamar', array('id_kamar' => $id_k))->row();


		$da = array(

			'bed' => $this->input->post('bed'), /////maish manual harga

			'harga_bed' => $this->input->post('bed') * $bd->bed, /////maish manual harga /////bias dirubah di admin

			'user' => $this->session->userdata('username'),

			'update' => $tanggal . ' ' . $waktu,



		);

		$this->Mhotel->up_bed_sim($da, $id_b); //tabe kamar

		$user = array(

			'update' => $tanggal . ' ' . $waktu,

			'user' => $this->session->userdata('username') . ' [ ' . $this->session->userdata('sip') . ' ] ',

		);

		$this->Mhotel->update_user_sim($user, $id_p); ///simpan ke tabel pesan tempat user dan tanggal update untuk pelanggan

		////////LAPORAN SHIP



		$sip = array(

			'id_user' => $this->session->userdata('id_user'),

			'ship' => $this->session->userdata('sip'),

			'ket' => '(simulasi) Data Bed',

			'status' => '(simulasi) Data Bed',

			'tanggal' => $tanggal . ' ' . $waktu,

		);

		$this->Login_model->sip_login($sip);

		/////



		redirect('C_resepsionis/bill_kam/' . $id_p . '/' . $sm);
	}

	/////////OT ok

	function ot_sim($id_b, $id_p, $id_k, $sm)
	{ /////CEKOUT-------------------------------------------------------------------------------

		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

		$hm = $h * 60;

		$ms = $hm * 60;

		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

		$waktu = gmdate("H:i:s", time() + ($ms));



		$ots = $this->db->get_where('tbl_kamar', array('id_kamar' => $id_k))->row();

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

		$this->Mhotel->up_bed_sim($da, $id_b); //tabe kamar

		$user = array(

			'update' => $tanggal . ' ' . $waktu,

			'user' => $this->session->userdata('username') . ' [ ' . $this->session->userdata('sip') . ' ] ',

		);

		$this->Mhotel->update_user_sim($user, $id_p); ///simpan ke tabel pesan tempat user dan tanggal update untuk pelanggan

		////////LAPORAN SHIP



		$sip = array(

			'id_user' => $this->session->userdata('id_user'),

			'ship' => $this->session->userdata('sip'),

			'ket' => '(simulasi) Data OT',

			'status' => '(simulasi) Data  OT',

			'tanggal' => $tanggal . ' ' . $waktu,

		);

		$this->Login_model->sip_login($sip);

		/////



		redirect('C_resepsionis/bill_kam/' . $id_p . '/' . $sm);
	}

	/////BED DAN OT EDIT-----ok------------------------------------------------------------------------------------

	function bed_ot_sim($id_b, $id_p, $id_k, $sm)
	{ /////CEKOUT

		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

		$hm = $h * 60;

		$ms = $hm * 60;

		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

		$waktu = gmdate("H:i:s", time() + ($ms));



		$ots = $this->db->get_where('tbl_kamar', array('id_kamar' => $id_k))->row();

		if ($this->input->post('ot') < 4) {

			$ot = $this->input->post('ot') * $ots->ot;
		} else {

			$ot = $ots->ot2;
		}



		$da = array(

			'bed' => $this->input->post('bed'), /////

			'early' => $this->input->post('early'), /////manoish manual harga

			'harga_bed' => $this->input->post('bed') * $ots->bed, /////UPTUDET



			'ot' => $this->input->post('ot'), /////maish manual harga

			'disc' => $this->input->post('d10'), /////maish manual harga

			'harga_ot' => $ot, /////maish manual harga

			'user' => $this->session->userdata('username'),

			'update' => $tanggal . ' ' . $waktu,



		);

		$this->Mhotel->up_bed_sim($da, $id_b); //tabe kamar

		//////////////////// NYIMPAN TANGAL UPDATE

		$user = array(

			'update' => $tanggal . ' ' . $waktu,

			'user' => $this->session->userdata('username') . ' [ ' . $this->session->userdata('sip') . ' ] ',

		);

		$this->Mhotel->update_user_sim($user, $id_p); ///simpan ke tabel pesan tempat user dan tanggal update untuk pelanggan

		////////LAPORAN SHIP



		$sip = array(

			'id_user' => $this->session->userdata('id_user'),

			'ship' => $this->session->userdata('sip'),

			'ket' => '(simulasi) Edit Data Bed dan Overtime (OT) dan DISC',

			'status' => '(simulasi) Edit Data Bed dan Overtime (OT) dan DISC',

			'tanggal' => $tanggal . ' ' . $waktu,

		);

		$this->Login_model->sip_login($sip);

		/////

		redirect('C_resepsionis/bill_kam/' . $id_p . '/' . $sm);
	}

	/////HAPUS BIILLLL-ok-------------------------------------------------------------------------------------------------------

	function hapus_bill_sim($id_b, $id_p, $id_k, $date, $sm)
	{

		//==========================================================================

		$this->Mhotel->hapus_bill_sim($id_b); //tabe kamar

		////


		$ckdt = $this->Mhotel->cekguesbilltg_sim($id_p, $id_k, $date);


		if ($ckdt == FALSE) {

			//////////MEnghapus dari status kamar ;Terisi / tidak


			$this->Mhotel->hapus_bill_perpanjang_sim($id_p, $id_k, $date); //tabe Perpanfanj kepentingan tanggal



		}

		///===============================================================

		$gtbill = $this->Mhotel->getperbaikannokamar_sim($id_p);

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

		$this->Mhotel->update_user_sim($user, $id_p); ///simpan ke tabel pesan tempat user dan tanggal update untuk pelanggan 	



		///



		redirect('C_resepsionis/bill_kam/' . $id_p . '/' . $sm);
	}

	////HAPUS harga kamar -------ok-----------------------------------------------------------------------------------------------------

	function hapus_hargakamar_sim($id_b, $id_p, $id_k, $okk, $sm)
	{

		if ($okk == 'ok') {

			$hff = 'ya';
		} else {

			$hff = 'tdk';
		}

		$f = array(

			'delkam' => $hff,

		);

		$this->Mhotel->delkamar_sim($f, $id_b);

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

		$this->Mhotel->update_user_sim($user, $id_p); ///simpan ke tabel pesan tempat user dan tanggal update untuk pelanggan ///tbl_pesan_kamar

		redirect('C_resepsionis/bill_kam/' . $id_p . '/' . $sm);
	}

	//////////HAPUS TAGIHAN

	function hapus_tagihan_sim($id, $id_p, $sm)
	{

		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

		$hm = $h * 60;

		$ms = $hm * 60;

		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

		$waktu = gmdate("H:i:s", time() + ($ms));

		$this->Mhotel->hapus_tagihan_sim_mod($id); //tabe kamar

		////

		$user = array(

			'update' => $tanggal . ' ' . $waktu,

			'user' => $this->session->userdata('username') . ' [ ' . $this->session->userdata('sip') . ' ] ',

		);

		$this->Mhotel->update_user_sim($user, $id_p); ///simpan ke tabel pesan tempat user dan tanggal update untuk pelanggan\

		/////

		////

		////////LAPORAN SHIP

		$sip = array(

			'id_user' => $this->session->userdata('id_user'),

			'ship' => $this->session->userdata('sip'),

			'ket' => '(simulasi)  Hapus data Food, Beverage, Laundry, & Etc',

			'status' => '(simulasi)  Hapus data',

			'tanggal' => $tanggal . ' ' . $waktu,

		);

		$this->Login_model->sip_login($sip);

		/////

		/////

		redirect('C_resepsionis/bill_kam/' . $id_p . '/' . $sm);
	}

	///////////////simpan update kamar bill ok

	function up_kamar_sim($id_p, $sm)
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

			$this->Mhotel->up_bill_hotel_sim($da); //tabe bill hotel

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

			$this->Mhotel->up_perpanjangan_sim($da); //tabe bill hotel ...yang di butuhkan data tanggal cekout 

		}

		/////

		$g_id = $this->db->get_where('tbl_pesan_kamar_sim', array('id' => $id_p));

		$user = array(

			'update' => $tanggal . ' ' . $waktu,

			'id_k' => $hasil_no . '' . $g_id->row()->id_k,

			'user' => $this->session->userdata('username') . ' [ ' . $this->session->userdata('sip') . ' ] ',

		);

		$this->Mhotel->update_user_sim($user, $id_p); ///simpan ke tabel pesan tempat user dan tanggal update untuk pelanggan



		////





		//

		////////LAPORAN SHIP



		$sip = array(

			'id_user' => $this->session->userdata('id_user'),

			'ship' => $this->session->userdata('sip'),

			'ket' => '(simulasi) Menambah data Room',

			'status' => '(simulasi) Menambah data Room',

			'tanggal' => $tanggal . ' ' . $waktu,

		);

		$this->Login_model->sip_login($sip);

		/////



		redirect('C_resepsionis/bill_kam/' . $id_p . '/' . $sm);
	}

	////////////////////////////

	function perpanjang_kamar_sim($id_p, $sm)
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



				$g_id = $this->Mhotel->get_tbl_perpanjang_sim($pec[$iii], $id_p)->row();

				//============================================================REV 17================================================

				$g_id_mak_bill = $this->Mhotel->get_tbl_perpanjang_mak_new_idk_sim($pec[$iii], $id_p)->row();

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

				$this->Mhotel->up_bill_hotel_sim($daa); //tabe bill hotel

			}
		}

		///////



		for ($iiii = 1; $iiii < count($pec); $iiii++) {  ////PEngulanga hanya Kamar saja Untuk Tbl PErpanjangan



			////==================================REV17

			$g_id_up = $this->Mhotel->get_tbl_perpanjang_sim($pec[$iiii], $id_p);

			$g_id_mak_bill_p = $this->Mhotel->get_tbl_perpanjang_mak_new_idk_sim($pec[$iiii], $id_p)->row();

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

			$this->Mhotel->up_perpanjangan_a_sim($daaa, $pec[$iiii]);  ///updete masing masing



		}



		/////



		/////=========================================================TBL PeSAN KAMAR=========================

		$user = array(



			'update' => $tanggal . ' ' . $waktu,

			'user' => $this->session->userdata('username') . ' [ ' . $this->session->userdata('sip') . ' ] ',



		);

		$this->Mhotel->update_user_sim($user, $id_p); ///simpan ke tabel pesan tempat user dan tanggal update untuk pelanggan



		////

		////////============================================LAPORAN SHIP======================================



		$sip = array(

			'id_user' => $this->session->userdata('id_user'),

			'ship' => $this->session->userdata('sip'),

			'ket' => '(simulasi) Memperpanjang Room',

			'status' => '(simulasi) Memperpanjang Room',

			'tanggal' => $tanggal . ' ' . $waktu,

		);

		$this->Login_model->sip_login($sip);

		/////   	

		//



		redirect('C_resepsionis/bill_kam/' . $id_p . '/' . $sm);
	}


	////REFUND



	function refund_sim($id, $via, $nama, $sm)
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

		$t = $this->Mhotel->cek_refund_sim($id);

		//

		if ($t == TRUE) {

			$this->Mhotel->simpan_up_refund_sim($id, $data);
		} else {

			$this->Mhotel->simpan_refund_sim($data);
		}





		$this->Mhotel->simpan_refund_pesan_sim($id, $data0); ///simpan ke tabel pesan kamar 

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

		$this->Mhotel->update_user_sim($user, $id); ///simpan ke tabel pesan tempat user dan tanggal update untuk pelanggan

		///////

		//redirect($this->session->userdata('url'));

		redirect('C_resepsionis/bill_kam/' . $id . '/' . $sm);
	}

	function simpan_editnama_sim($id_p, $sm)
	{

		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

		$hm = $h * 60;

		$ms = $hm * 60;

		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

		$waktu = gmdate("H:i:s ", time() + ($ms));

		$user = array(

			'nama' => $this->input->post('nama'),

			'alamat' => $this->input->post('alamat'),

			'update' => $tanggal . ' ' . $waktu,

			'user' => $this->session->userdata('username') . ' [ ' . $this->session->userdata('sip') . ' ] ',

		);

		$this->Mhotel->update_user_sim($user, $id_p); ///simpan ke tabel pesan tempat user dan tanggal update untuk pelanggan

		$this->session->set_flashdata("pesan", "<div class=\"col-xs-12-md-12\"><div class=\"alert alert-success\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Data Sudah Tersimpan</div></div>");

		redirect('C_resepsionis/bill_kam/' . $id_p . '/' . $sm);
	}
}
