<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Funding extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if(!$this->session->userdata('user_id')) {
			redirect('login');
		}
		$this->load->model('funder_model');
		$this->userType = $this->session->userdata('user_type');
		$this->userId 	= $this->session->userdata('user_id');

	}
	
	function index(){
		try{
			if($this->userType=3 ||  $this->userType=1){
				$data['title'] = 'All Funding List'; 
				$data['page'] 	= 'funding';
				$data['funding_list'] = $this->funder_model->getFunderList();
				$this->load->view('theme/prelayout/header',$data);
				$this->load->view('theme/myaccount/funder/funding_list',$data);
				$this->load->view('theme/prelayout/footer',$data);
			}else {
				throw new Exception('You do not have permission to this page');
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	function getallnotes(){
		try{
			if($this->userType=3 ||  $this->userType=1){
				$data['title'] = 'All Funding Notes List'; 
				$data['page'] 	= 'fundingnotes';
				$data['funding_list'] = $this->funder_model->getFundinNotes();
				$this->load->view('theme/prelayout/header',$data);
				$this->load->view('theme/myaccount/funder/funding_notes_list',$data);
				$this->load->view('theme/prelayout/footer',$data);
			}else {
				throw new Exception('You do not have permission to this page');
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
}
