<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_admin extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Minfo', '', TRUE);
		$this->load->model('Mhotel', '', TRUE);
		$this->load->model('Madmin', '', TRUE);
		$this->load->model('M_bill', '', TRUE);
	}


	public function index() ///===============================================================================BERANDA
	{
		$this->lap_shifs(date('Y'));
	}
	public function lap_shifs($thn) ///
	{
		if ($this->session->userdata('master_login') == TRUE) {
			//
			$q = $this->Minfo->info()->row();

			//
			$data['namapt'] = !empty($q->namapt) ? $q->namapt : $this->config->item('nameAPP');
			$data['logo'] = !empty($q->logo) ? $q->logo : 'logo';
			//$data['main_view'] = 'admin/awal';
			$data['main_view'] = 'admin/awal_shifs'; ///yang mau di pake
			////
			if ($thn == NULL) {
				$data['thn'] = date('Y');
			} else {
				$data['thn'] = $thn;
			}
			//
			$data['con'] = 'C_admin';
			$data['nama_app'] = 'LAPORAN MASING-MASING SHIFT  ' . $q->namapt;
			$data['title'] = 'LAPORAN MASING-MASING SHIFT  ' . $q->namapt;
			//
			$data['id_tgl'] = $this->session->userdata('id_tgl');
			$data['shift'] = $this->session->userdata('sip');
			$data['a'] = 'active';
			$data['nav'] = 'nonactive';
			$data['b'] = $data['c'] = $data['d'] = $data['e'] = $data['g'] = $data['f'] = $data['h'] = '';
			//

			$data['q'] = $this->Mhotel->cek_kamar();
			$this->load->view('beranda', $data);

			//
		} else {
			redirect('login');
		}
	}
	//
	public function rinci_pendapatan($id_user, $tab, $id_tgl, $shift) ///PENDAPATAN PER SHIFT TANGGAl =================================
	{
		if ($this->session->userdata('master_login') == TRUE or $this->session->userdata('login') == TRUE) {
			//
			$q = $this->Minfo->info()->row();

			//
			$data['namapt'] = !empty($q->namapt) ? $q->namapt : $this->config->item('nameAPP');
			$data['logo'] = !empty($q->logo) ? $q->logo : 'logo';
			$data['id_user'] = $id_user;
			$data['id_tgl'] = $id_tgl;
			$data['shift'] = $shift;
			$data['main_view'] = 'admin/pendapatan';

			//
			$data['nama_app'] = 'LAPORAN MASING-MASING SHIFT  ' . $q->namapt;
			$data['title'] = 'LAPORAN MASING-MASING SHIFT  ' . $q->namapt;
			//
			$data['b'] = 'active';
			$data['nav'] = 'active';
			$data['tab'] = $tab;
			$data['a'] = $data['c'] = $data['d'] = $data['e'] = $data['g'] = $data['f'] = $data['h'] = '';
			//

			$data['q'] = $this->Mhotel->cek_kamar();
			$this->load->view('beranda', $data);

			//
		} else {
			redirect('login');
		}
	}
	/////pengaturan password ======================================================================================
	public function pass()
	{
		if ($this->session->userdata('master_login') == TRUE) {
			//
			$q = $this->Minfo->info()->row();

			//
			$data['namapt'] = !empty($q->namapt) ? $q->namapt : $this->config->item('nameAPP');
			$data['logo'] = !empty($q->logo) ? $q->logo : 'logo';
			/*$data['id_user'] = $id_user;
    	$data['id_tgl'] = $id_tgl;
    	$data['shift'] = $shift;//*/
			$data['main_view'] = 'admin/pass/pe_pass';

			//
			$data['nama_app'] = 'LAPORAN   ' . $q->namapt;
			$data['title'] = 'LAPORAN   ' . $q->namapt;
			//
			$data['b'] = '';
			$data['f'] = 'active';
			$data['nav'] = '';
			$data['tab'] = '';
			$data['a'] = $data['c'] = $data['d'] = $data['e'] = $data['g'] = $data['h'] = '';
			//

			$data['q'] = $this->Mhotel->cek_kamar();
			$this->load->view('beranda', $data);

			//
		} else {
			redirect('login');
		}
	}
	///
	/////pengaturan p_kamar==================================================================================
	public function p_kamar()
	{
		if ($this->session->userdata('master_login') == TRUE) {
			//
			$q = $this->Minfo->info()->row();

			//
			$data['namapt'] = !empty($q->namapt) ? $q->namapt : $this->config->item('nameAPP');
			$data['logo'] = !empty($q->logo) ? $q->logo : 'logo';
			/*$data['id_user'] = $id_user;
    	$data['id_tgl'] = $id_tgl;
    	$data['shift'] = $shift;//*/
			$data['main_view'] = 'admin/kamar/harga';

			//
			$data['nama_app'] = 'LAPORAN   ' . $q->namapt;
			$data['title'] = 'LAPORAN   ' . $q->namapt;
			//
			$data['b'] = $data['f'] = '';
			$data['g'] = 'active';
			$data['nav'] = '';
			$data['tab'] = '';
			$data['a'] = $data['c'] = $data['d'] = $data['e'] = $data['h'] = '';
			//

			$data['q'] = $this->Mhotel->cek_kamar();
			$this->load->view('beranda', $data);

			//
		} else {
			redirect('login');
		}
	}
	///// rekap_nota==================================================================================
	public function rekap_nota($tipe = 1, $tgl1 = NULL, $tgl2 = NULL)
	{
		if ($this->session->userdata('master_login') == TRUE) {
			//
			$q = $this->Minfo->info()->row();

			//
			//////////
			$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

			$hm = $h * 60;

			$ms = $hm * 60;

			$tanggal = gmdate("d/m/Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.
			$xxx = substr($tanggal, '6', '4');

			$xx = substr($tanggal, '3', '2');

			$x = substr($tanggal, '0', '2');
			//////////
			$data['namapt'] = !empty($q->namapt) ? $q->namapt : $this->config->item('nameAPP');
			$data['logo'] = !empty($q->logo) ? $q->logo : 'logo';
			/*$data['id_user'] = $id_user;
    	$data['id_tgl'] = $id_tgl;
    	$data['shift'] = $shift;//*/

			$data['tipe'] = $tipe; //
			$data['main_view'] = 'admin/rekap/nota';

			//
			$data['nama_app'] = 'LAPORAN   ' . $q->namapt;
			$data['title'] = 'LAPORAN   ' . $q->namapt;
			//
			$data['b'] = $data['g'] = $data['f'] = '';
			$data['h'] = 'active';
			$data['nav'] = '';
			$data['tab'] = '';
			$data['a'] = $data['c'] = $data['d'] = $data['e'] = '';
			//


			///////////////
			$intgl = $this->input->post('tanggal');
			$intgl0 = $this->input->post('tanggal1');
			$xxxi = substr($intgl, '6', '4');
			$xxi = substr($intgl, '3', '2');
			$xi = substr($intgl, '0', '2');
			$xxxii = substr($intgl0, '6', '4');
			$xxii = substr($intgl0, '3', '2');
			$xii = substr($intgl0, '0', '2');
			///////////////

			//
			if ($tgl1 != NULL) {
				$data['tgl'] = $tgl1 = $xxxi . $xxi . $xi;
				$data['tgl1'] = $tgl2 = $xxxii . $xxii . $xii;
			} else {
				//////
				$data['tgl'] = $tgl1 = $xxx . $xx . $x;
				$data['tgl1'] = $tgl2 = $xxx . $xx . $x;
				//////	
			}


			switch ($tipe) {
				case 1:
					$q = $this->Madmin->getkamar_rekap_nota('K', 'no', 'tdk', $tgl1, $tgl2); ///tbl_pesan_kamar CAS tipe//
					break;
				case 2:
					$q = $this->Madmin->getkamar_rekap_nota('N', 'no', 'tdk', $tgl1, $tgl2); ///tbl_pesan_kamar TRANSFER
					break;
				case 3:
					$q = $this->Madmin->getkamar_rekap_notadep('K', 'ya', $tgl1, $tgl2); ///tbl_pesan_kamar DEPOSIT CAS
					break;
				case 4:
					$q = $this->Madmin->getkamar_rekap_notadep('N', 'ya', $tgl1, $tgl2); ///tbl_pesan_kamar DEPOSIT TRANSFER
					break;
				case 5:
					$q = $this->Madmin->getkamar_rekap_notarefund('K', 'no', 'ok', $tgl1, $tgl2); ///tbl_pesan_kamar TRANSFER
					break;
				case 6:
					$q = $this->Madmin->getkamar_rekap_notarefund('N', 'no', 'ok', $tgl1, $tgl2); ///tbl_pesan_kamar TRANSFER
					break;
				case 7:
					$q = $this->Madmin->lap_tagihan_hotel_all($tgl1, $tgl2);
					break;
				case 8:
					$q = $this->Madmin->lap_tagihan_hotel_all($tgl1, $tgl2);
					break;
				case '':
					$q = NULL;
					break;
			}
			$data['q'] = $q;
			$this->load->view('beranda', $data);

			//
		} else {
			redirect('login');
		}
	}
	///================================================================================PENGELUARAN per shift
	public function rinci_pengeluaran($id_user, $id_tgl, $shift)
	{
		if ($this->session->userdata('master_login') == TRUE or $this->session->userdata('login') == TRUE) {
			//if ($this->session->userdata('master_login') == TRUE){
			//
			$q = $this->Minfo->info()->row();

			//
			$data['namapt'] = !empty($q->namapt) ? $q->namapt : $this->config->item('nameAPP');
			$data['logo'] = !empty($q->logo) ? $q->logo : 'logo';
			$data['id_user'] = $id_user;
			$data['main_view'] = 'admin/pengeluaran';

			//
			$data['nama_app'] = 'LAPORAN MASING-MASING SHIFT  ' . $q->namapt;
			$data['title'] = 'LAPORAN MASING-MASING SHIFT  ' . $q->namapt;
			//
			$data['id_tgl'] = $id_tgl;
			$data['shift'] = $shift;
			$data['c'] = 'active';
			$data['nav'] = 'active';
			$data['b'] = $data['a'] = $data['d'] = $data['e'] = $data['g'] = $data['f'] = $data['h'] = '';
			//

			$data['q'] = $this->Mhotel->cek_kamar();
			$this->load->view('beranda', $data);

			//
		} else {
			redirect('login');
		}
	}
	///=========================================================================CEKBOKING
	public function cek_boking($id_user, $id_tgl, $shift)
	{
		if ($this->session->userdata('master_login') == TRUE or $this->session->userdata('login') == TRUE) { //if ($this->session->userdata('master_login') == TRUE){
			$q = $this->Minfo->info()->row();

			//
			//
			$data['e'] = 'active';
			$data['nav'] = 'active';
			$data['b'] = $data['a'] = $data['c'] = $data['d'] = '';
			//
			$data['namapt'] = !empty($q->namapt) ? $q->namapt : $this->config->item('nameAPP');
			$data['logo'] = !empty($q->logo) ? $q->logo : 'logo';
			$data['main_view'] = 'resepsionis/cek_boking_kamar';
			$data['id_user'] = $id_user;
			$data['id_tgl'] = $id_tgl;
			$data['shift'] = $shift;
			//
			$data['nama_app'] = $q->namapt;
			$data['title'] = $q->namapt;
			//
			$data['aa'] = $data['a1'] = 'active';
			$data['b'] = $data['c'] = $data['d'] = $data['a'] = '';
			//

			$data['q'] = $this->Mhotel->cek_kamar_bok();
			$this->load->view('beranda', $data);
		} else {
			redirect('login/simpeg');
		}
	}
	/////=======================================================================================MARET
	function ubah_password_all($id)
	{
		if ($this->session->userdata('id_admin') == 3) {
			$w = $this->input->post('we');
		} else {
			$w = 'resepsionis';
		}
		$d = array(
			'username' => $this->input->post('user'),
			'password' => $this->input->post('pass'),
			'wilayah' => $this->input->post('ip'),
			'wewenang' => $w,
		);
		$this->Madmin->up_pass($d, $id);
		$this->session->set_flashdata("pesan", "<div class=\"col-xs-12-md-12\"><div class=\"alert alert-success\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Saudara " . $this->input->post('nama') . " Telah Tersimpan </div></div>");

		redirect('C_admin/pass');
	}
	///========================================================HARGAKAMAR
	function ubah_hargakamr($id)
	{
		///dua data yang disipan

		if ($this->session->userdata('wewenang') == "admin") {

			$d = array(
				'harga_n' => $this->input->post('harga_n'),
				'harga_p' => $this->input->post('harga'),
				'harga_days' => $this->input->post('harga_days'),
				'harga_end' => $this->input->post('harga_end'),
				'harga_long' => $this->input->post('harga_long'),
				'bed' => $this->input->post('b'),
				'ot' => $this->input->post('o'),
				'ot2' => $this->input->post('t'),
				'tgl' => date("Y-m-d H:i:s"),
				'user' => $this->session->userdata('username'),
			);
			// $this->Madmin->up_hargadikamar($d,$id); ////nyimpan ke tbl kamar ngerubah harga
			$this->Madmin->up_hargadijeniskamar($d, $id); ////nyimpan ke tbl kamar ngerubah namam jenis kamar
			$this->session->set_flashdata("pesan", "<div class=\"col-xs-12-md-12\"><div class=\"alert alert-success\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Saudara " . $this->input->post('nama') . " Telah Tersimpan </div></div>");
		}
		redirect('C_admin/p_kamar');
	}
	/////////////////////////////////////////////////KAMAR

	/////////////////////////////////////////////////KAMAR========================================================
	function up_password_id()
	{
		$d = array(
			'username' => $this->input->post('user'),
			'password' => $this->input->post('pass'),
		);
		$id = $this->session->userdata('id_admin');
		$this->Madmin->up_pass($d, $id);
		$this->session->set_userdata('login', FALSE);
		$this->session->set_userdata('master_login', FALSE);
		$this->session->set_userdata('id_login', FALSE);
		$this->session->sess_destroy();
		$this->session->set_flashdata("pesan", "<div class=\"col-xs-12-md-12\"><div class=\"alert alert-success\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Saudara " . $this->input->post('nama') . " Telah Tersimpan </div></div>");

		redirect('login');
	}
	/////////////////////PASWORD
	function plus_password_all()
	{
		if ($this->session->userdata('id_admin') == 3) {
			$w = $this->input->post('we');
		} else {
			$w = 'resepsionis';
		}
		$d = array(
			'username' => $this->input->post('user'),
			'password' => $this->input->post('pass'),
			'wilayah' => $this->input->post('ip'),
			'wewenang' => $w,
		);
		$this->Madmin->plus_pass($d);
		$this->session->set_flashdata("pesan", "<div class=\"col-xs-12-md-12\"><div class=\"alert alert-success\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Saudara " . $this->input->post('nama') . " Telah Tersimpan </div></div>");

		redirect('C_admin/pass');
	}
	/////////////////////KAMAR
	function plus_jenis_kamr()
	{
		$d = array(
			'jenis_kamar' => $this->input->post('jenis'),
			'harga_n' => $this->input->post('harga'),
		);
		$this->Madmin->plus_jkamar($d);
		$this->session->set_flashdata("pesan", "<div class=\"col-xs-12-md-12\"><div class=\"alert alert-success\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Saudara " . $this->input->post('nama') . " Telah Tersimpan </div></div>");

		redirect('C_admin/p_kamar');
	}
	/////////////////////KAMAR IST
	function plus_list_kamr()
	{
		$get = $this->Madmin->get_hargan($this->input->post('jenis'))->row()->harga_n;
		$get_nama_jesnis = $this->Madmin->get_hargan($this->input->post('jenis'))->row()->jenis_kamar;
		$d = array(
			'id_jkamar' => $this->input->post('jenis'),
			'jenis_kamar' => $get_nama_jesnis,
			'id_kamar' => $this->input->post('no'),
		);
		$cek = $this->Madmin->get_jenis($this->input->post('no'))->num_rows();
		if ($cek > 0) {
		} else {
			$this->Madmin->plus_listkamar($d);
		}

		$this->session->set_flashdata("pesan", "<div class=\"col-xs-12-md-12\"><div class=\"alert alert-success\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Saudara " . $this->input->post('nama') . " Telah Tersimpan </div></div>");

		redirect('C_admin/p_kamar');
	}
	////////////////////////////////////////////////////PASWORD
	function dell_password_all($id, $up)
	{

		//	$this->Madmin->dell_pass($id);
		$d = array(
			'block' => $up,

		);
		$this->Madmin->up_pass($d, $id);
		$this->session->set_flashdata("pesan", "<div class=\"col-xs-12-md-12\"><div class=\"alert alert-success\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Telah Tersimpan </div></div>");

		redirect('C_admin/pass');
	}
	////////////KAMAR
	function dell_kamar($id)
	{

		$this->Madmin->dell_mkamar($id);
		$this->session->set_flashdata("pesan", "<div class=\"col-xs-12-md-12\"><div class=\"alert alert-success\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Saudara " . $this->input->post('nama') . " Telah Tersimpan </div></div>");

		redirect('C_admin/p_kamar');
	}
	////////////KAMAR LIST
	function dell_listkamar($id)
	{

		$this->Madmin->dell_mkamar_list($id);
		$this->session->set_flashdata("pesan", "<div class=\"col-xs-12-md-12\"><div class=\"alert alert-success\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Saudara " . $this->input->post('nama') . " Telah Tersimpan </div></div>");

		redirect('C_admin/p_kamar');
	}
	////oflie kan pass word======================
	function oflinekan($id)
	{

		$this->Madmin->merubah_ofline($id);
		$this->session->set_flashdata("pesan", "<div class=\"col-xs-12-md-12\"><div class=\"alert alert-success\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Status Telah DiRubah </div></div>");

		redirect('C_admin/pass');
	}
}
