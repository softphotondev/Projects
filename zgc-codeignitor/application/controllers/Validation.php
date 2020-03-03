<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Validation extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('id')) {
			redirect('login');
		}
		$this->load->helper('url');
	}
	public function index($file_name){
		if($this->session->userdata('id'))  // login check
			if(preg_match('^[A-Za-z0-9]{2,32}+[.]{1}[A-Za-z]{3,4}$^', $file_name)) // validation
				{
				$file = 'uploads/'.$file_name;
				if (file_exists($file)) // check the file is existing 
					{
					header('Content-Type: '.get_mime_by_extension($file));
					readfile($file);
					}
				else show_404();
				}
		else    show_404();
	}
}
