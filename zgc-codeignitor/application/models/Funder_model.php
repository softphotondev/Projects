<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Funder_model extends CI_Model {
    public function __construct() {
        parent::__construct();
		
		if(!$this->session->userdata('user_id')) {
			redirect('login');
		}
		
		$this->load->model('User_model');
		$this->load->model('Common');
		
		$this->userType = $this->session->userdata('user_type');
		$this->userId 	= $this->session->userdata('user_id');
    }
	
	function getFunderList($order_id=0){
		$this->db->select('*')->from('funding');
		$this->db->join('orders','orders.order_id = funding.order_id');
		$this->db->join('users','users.id = orders.user_id');
		if(!empty($order_id)){
		$this->db->where('funding.order_id',$order_id);
		}
		$query = $this->db->get();
		return $query->result();
	}
	
	function getFundinNotes(){
		$this->db->select('notes.*,users.first_name,users.last_name,users.username,orders.order_id,orders.order_number')->from('notes');
		$this->db->join('users','users.id = notes.added_by');
		$this->db->join('orders','orders.order_id = notes.order_id');
		$this->db->where('notes.is_delete <>',2);
		$this->db->where('notes.added_by',$this->userId );
		$this->db->where('notes.user_type_id',$this->userType );
		$query = $this->db->get();
		return $query->result();
	}
}
