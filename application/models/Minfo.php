<?php

class Minfo extends CI_Model {

    function __construct(){
        parent::__construct();
       // $this->load->model('Mpagu','',TRUE);
    }

	function info(){
		return $this->db->get_where('ueu_tbl_info',array('id' => 1));
	}
	

}