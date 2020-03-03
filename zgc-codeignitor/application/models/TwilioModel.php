<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'application/packages/PyApi/vendor/autoload.php';
use Twilio\Rest\Client;

class TwilioModel extends CI_Model {

	public $fromPhone = '+13238941570';

	public function __construct()
	{
		// Your Account SID and Auth Token from twilio.com/console
		$accountSid = 'ACac43b48faaa79fac41ba2a3146862edf';
		$authToken = '27719ceb361451625b0d04e6ab9974d4';

		$this->client = new Client($accountSid, $authToken);
	}

	public function sendMessage($to, $message, $from = null) {
		if(is_null($from)) {
			$from = $this->fromPhone;
		}
		
		if($to)
		{
			$str2 = substr($to,2);
			
			if(strlen($str2)==10)
			{
					try
					{
					$this->client->messages->create(
					$to,
					[
					'from'  =>  $from,
					'body'  =>  $message
					]
					);
					}
					catch (Exception $e)
					{
					 return true;   
					}
			}
		}
	}

	public function getFaxInfo($sid)
	{
		return $this->client->fax->v1->faxes($sid)
			->fetch();
	}
}
