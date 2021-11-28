<?php

class Login_model extends CI_Model {

	var $table = 'ueu_tbl_user';
	
	function __construct()
	{
		parent::__construct();
	}
	////rev 5/4/17
	function check_user($username, $password)
	{   
		$query = $this->db->get_where($this->table, array('username' => $username, 'password' => $password, 'block !=' => 1), 1, 0);
		
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	function check_user_shift($shift, $tgl)
	{   
		$query = $this->db->get_where('tbl_login_ship', array('ship' => $shift, 'sort' => $tgl), 1, 0);
		
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
		function get_jam_shift($shift)
	{   
		$this->db->select('*');
		return $this->db->get_where('tbl_jam_shift', array('jam' => $shift))->row()->shift;
		
		
	}
	function check_user_shift_id($shift,$tgl,$id)
	{   
		$query = $this->db->get_where('tbl_login_ship', array('ship' => $shift, 'sort' => $tgl,'id_user' => $id), 1, 0);
		
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	function check_user_id($username, $password)
	{   
		$query = $this->db->get_where('tbl_pesan_kamar', array('nama' => $username, 'id' => $password));
		
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function get_id_pass($username,$password){
		$this->db->select('*');
		$this->db->from('ueu_tbl_user');
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		return $this->db->get();
	}
	function cekonlineid($id){
		$this->db->select('*');
		$this->db->from('ueu_tbl_user');
		$this->db->where('idlog',$id);
		return $this->db->get();
	}
	function get_shift($shift){
		$this->db->from('tbl_jam_shift');
		$this->db->where('shift',$shift);
		return $this->db->get();
	}
	function get_id_pass_id($username,$password){
		$this->db->select('*');
		$this->db->from('tbl_pesan_kamar');
		$this->db->where('nama',$username);
		$this->db->where('id',$password);
		return $this->db->get();
	}
	
	function kosong_data(){
        $this->db->where('id_unit !=', 0);
        $this->db->delete('ueu_tbl_user');
		
	}
	function update_info($d)
	{
		$this->db->where('id',1);
		$this->db->update('ueu_tbl_info', $d);
	}
	//
	function update_status($d,$id)
	{
		$this->db->where('idlog',$id);
		$this->db->update('ueu_tbl_user', $d);
	}
	function sip_login($d)
	{
		//$this->db->where('id',1);
		$this->db->insert('tbl_lap_ship', $d);
	}
	function sip_login_sip($d)
	{
		//$this->db->where('id',1);
		$this->db->insert('tbl_login_ship', $d);
	}
}