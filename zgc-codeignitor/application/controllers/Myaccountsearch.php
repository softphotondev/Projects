<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Myaccountsearch extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('user_id')) {
			redirect('login');
		}
		$this->load->helper('url');
	}


    function serachmyuploads()
    {
         $value = $this->input->post('value');
          
		if($this->session->userdata('user_type')==4)
		{
              $user_ids = getclientids($this->session->userdata('user_id'));
              $myuploads = $this->Myaccount_model->getmyuploadsbroker($this->session->userdata('user_id'),$value);
        }
        else
        {
             $myuploads = $this->Myaccount_model->getmyuploadsclient($this->session->userdata('user_id'),$value);
        }
        
        $data['myuploads'] = $myuploads;

         echo $this->load->view('theme/myaccount/front/myuploadssearch',$data,TRUE);	
    }


    function serachinvoices()
    {
        $search = $this->input->post('value');

        $invoices = $this->Myaccount_model->getinvoicelist('','',$search);
        $data['invoices'] = $invoices;

       echo $this->load->view('theme/myaccount/front/searchinvoices',$data,TRUE);
    }


    function searchtracking()
    {
        $search = $this->input->post('value'); 

       if($this->session->userdata('user_type')==4)
        {
               $user_ids = getclientids($this->session->userdata('user_id'));

                foreach ($user_ids as $key => $value) 
                    {
                              $where = array('user_id'=>$value);
                              $track = $this->Basic->getsinglerow($where,'usertrack');

                                if(!isset($track))
                                {
                        $insertdatatrack = array('user_id'=>$value,'created_at'=>date('Y-m-d H:i:s'));
                                $this->Basic->insertdata($insertdatatrack,'usertrack');
                                $this->db->flush_cache();
                                }
                    }

         $usertrack = $this->User_model->usertrack($this->session->userdata('user_id'),$search);
        }
        else
        {
                  $where = array('user_id'=>$this->session->userdata('user_id'));
                  $track = $this->Basic->getsinglerow($where,'usertrack');

                  if(!isset($track))
                  {
$insertdatatrack = array('user_id'=>$this->session->userdata('user_id'),'created_at'=>date('Y-m-d H:i:s'));
                  $requltids = $this->Basic->insertdata($insertdatatrack,'usertrack');
                  $this->db->flush_cache();
                  }

                $order = 'id'.' '.'asc';
                $where = array('user_id'=>$this->session->userdata('user_id'));
                $usertrack = $this->Basic->getmultiplerow($order,$where,'usertrack');
        }

        $data['usertrackhere'] = $usertrack;


         echo $this->load->view('theme/myaccount/front/searchtracking',$data,TRUE);
    }

    function searchsupport()
    {
    $search = $this->input->post('value'); 

    $data['ticket'] = $this->Project_model->gatallticketorderbased($search);


    $order = 'id'.' '.'asc';
    $where = array();
    $data['support_depart'] = $this->Basic->getmultiplerow($order,$where,'support_depart');


    //$data['users'] = $this->User_model->getUserDetailById('','',5);

    $data['users'] = $this->User_model->getclients();


     $order = 'id'.' '.'desc';
    $where = array();
    $data['priority'] = $this->Basic->getmultiplerow($order,$where,'priority');

    //support related values
    $order = 'status_id'.' '.'asc';
    $where = array('type'=>'support');
    $support_status_all = $this->Basic->getmultiplerow($order,$where,'status');

        $support_status = $support_count = $support_status_output = [];

    foreach($support_status_all as $suppkey=>$supp)
    {
      $support_status[$supp->status_id] = $supp->status_name;

      $support_status_output[$suppkey] =  $supp->status_name;

      $support_all = $this->Project_model->gatallticketorderbased($search,$supp->status_id);

      $support_count[$suppkey] = count($support_all);
    }

    unset($support_status['13']);
    unset($support_status['15']);
    unset($support_status['16']);


    $data['support_status'] = $support_status;
    $data['support_count'] = $support_count;
    $data['support_status_output'] = $support_status_output;

    echo $this->load->view('theme/myaccount/front/searchsupport',$data,TRUE);
    }

    function searchpayment()
    {
      $search = $this->input->post('value'); 
      $data['paymentmethods'] = $this->Project_model->searchpayment($search);
      echo $this->load->view('theme/myaccount/front/searchpayment',$data,TRUE);
    }

	  


}
