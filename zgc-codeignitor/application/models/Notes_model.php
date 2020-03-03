<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Notes_model extends CI_Model {
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
	function getNoteById($noteId=0){
		$this->db->select('notes.*,users.first_name,users.last_name,users.username,orders.order_id')->from('notes');
		$this->db->join('users','users.id = notes.added_by');
		$this->db->join('orders','orders.order_id = notes.order_id');
		$this->db->where('notes.is_delete <>',2);
		$this->db->where('notes.notes_id',$noteId);
		$query = $this->db->get();
		return $query->row();
	}
	function getNoteReplyById($noteId=0){
		$this->db->select('notes_reply.*,users.first_name,users.last_name,users.username,orders.order_id')->from('notes_reply');
		$this->db->join('notes','notes_reply.notes_id = notes.notes_id');
		$this->db->join('users','users.id = notes_reply.user_id');
		$this->db->join('orders','orders.order_id = notes_reply.order_id');
		$this->db->where('notes_reply.status',1);
		$this->db->where('notes_reply.notes_id',$noteId);
		$query = $this->db->get();
		return $query->result();
	}
}
