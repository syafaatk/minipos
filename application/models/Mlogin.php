<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mlogin extends CI_Model{
    public function cekadmin($u,$p){
        $this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where(array('user_username'	=> $u,
							   'user_password'	=> md5($p)));
		$this->db->order_by('user_id');
		$query = $this->db->get();
		return $query->row();
    }
}
