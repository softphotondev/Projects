<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Email_model extends CI_Model {
	
    public function __construct() {
        parent::__construct();
		
    }

    public function send_simple_mail($to, $subject, $message, $from, $sitename) {
		$headers = 'From: '.$sitename. "\r\n" .
		    'Reply-To: no-reply@'.$sitename . "\r\n" .
		    'X-Mailer: PHP/' . phpversion();
		mail($to, $subject, $message, $headers);
    }
	
	public function send_mail($data=[]) {
		$sent=FALSE;
		if(!empty($data) && count($data)>0){
		$this->load->library('email');
		$config['protocol']    	= 'smtp';
		$config['smtp_host']    = 'ssl://mail.getthatcredit.com';
		$config['smtp_port']    = '465';
		$config['smtp_timeout'] = '7';
		$config['smtp_user']    = 'noreply@getthatcredit.com';
		$config['smtp_pass']    = '#Money1984';
		$config['charset']    	= 'utf-8';
		$config['newline']    	= "\r\n";
		$config['mailtype'] 	= 'html'; // or html
		$config['validation'] 	= TRUE; // bool whether to validate email or not      
		$this->email->initialize($config);
		$this->email->from('noreply@getthatcredit.com', 'GETTHATCREDEIT');
		$this->email->to($data['to']);
		$this->email->subject($data['subject']);
		$this->email->message($data['message']);  
		//$this->email->send();
		//echo $this->email->print_debugger();
			if($this->email->send()){ 
				$this->session->set_flashdata("email_sent","Email sent successfully.");
				$sent=TRUE;
			}
			else{ 
				$this->session->set_flashdata("email_sent","Error in sending Email."); 
			}
		}
		return $sent;
      }
}
