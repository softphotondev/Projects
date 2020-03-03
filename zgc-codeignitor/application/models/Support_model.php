<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Support_model extends CI_Model {
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
	function getSupportById($supportId=0){
		$this->db->select('tickets.*,users.first_name,users.last_name,users.username,status.status_name,priority.priority as priority_name,support_depart.dept as department_name')->from('tickets');
		$this->db->join('users','users.id = tickets.added_by');
		$this->db->join('priority','priority.id = tickets.priority');
		$this->db->join('status','status.status_id = tickets.status');
		$this->db->join('support_depart','support_depart.id = tickets.department');
		$this->db->where('tickets.is_delete <>',2);
		$this->db->where('tickets.ticket_id',$supportId);
		$query = $this->db->get();
		return $query->row();
	}
	function getSupportReplyById($supportId=0){
		$this->db->select('support_ticket_reply.*,users.first_name,users.last_name,users.username')->from('support_ticket_reply');
		$this->db->join('tickets','support_ticket_reply.ticket_id = tickets.ticket_id');
		$this->db->join('users','users.id = support_ticket_reply.user_id');
		//$this->db->join('orders','orders.order_id = support_ticket_reply.user_id');
		$this->db->where('support_ticket_reply.ticket_id',$supportId);
		$query = $this->db->get();
		return $query->result();
	}
	
	function getOrdersSupportById($supportId=0){
		    $this->db->select('order_number');
			$this->db->from('orders');
			$this->db->where('user_id', $supportId);
		    $query = $this->db->get();
		    return $query->result();
	} 
	function getLastReplyById($supportId=0){
		    $this->db->select('*');
			$this->db->from('support_ticket_reply');
			$this->db->where('ticket_id', $supportId);
			$this->db->order_by("support_ticket_reply_id", "desc");
			$this->db->limit(1);
		    $query = $this->db->get();
			return $query->row();
			//return $query->row()->message;
	}
}
