<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class BotJobs extends CI_Model
{
	/**
	 * @var string
	 */
	protected $table = "bot_jobs";

	/**
	 * N_State_model constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * @param array $data
	 *
	 * @return mixed
	 */
	public function insert($data)
	{
		return $this->db->insert($this->table, $data) ? $this->db->insert_id() : false;
	}

	/**
	 * @param array $data
	 *
	 * @return mixed
	 */
	public function insertOrIgnore($data)
	{
		$query = $this->db->get_where($this->table, $data);
		if($query->num_rows() >= 1) {
			return (int) $query->result()[0]->id;
		}

		return $this->insert($data);
	}

	/**
	 * @param $id
	 *
	 * @return bool|mixed
	 */
	public function get($id)
	{
		$query = $this->db->get_where($this->table, ['id' => $id]);
		if($query->num_rows() >= 1) {
			return $query->result()[0];
		}

		return false;
	}

	/**
	 * @param $id
	 */
	public function delete($id) {
		$this->db->where([
			'id'    => $id
		]);

		$this->db->delete($this->table);
	}
	
	/**************Retrive User Balance of Certified Mail ************/
	
	function getCertifiedMailBalance($username='',$password=''){
		if(!empty($username) && !empty($password)){
			$headers=array();
			$headers['Content-Type']='application/json';
			$headers['Accept']='application/json';
			$headers['User-Agent']='test';
			$loginDetail=[
				'login_password' => $password,
				'login_user' 	 => $username
			];
			
			$requestData = json_encode($loginDetail);
			
			$url	= BOT_MAIN_DOMAIN.CERTIFIED_MAIL_GET_BALANCE;
			$response = json_decode(sendPostData($url,$requestData,$headers),true);
			
			return $response;
		}
	}

}