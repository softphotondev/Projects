<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

	}
	
	function getclientlist(){
		  $this->load->view('client/getclientlist'); 
	}
	function getbrokerlist(){
		  $this->load->view('client/getbrokerlist'); 
	}
}
