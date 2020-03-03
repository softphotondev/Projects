<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if(!$this->session->userdata('user_id')) {
			redirect('login');
		}
		
	}

	function getpages()
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		$data['title'] 		= 'Manage Pages';
        $data['subtitle'] 	= 'Manage Pages';
        $order = 'id'.' '.'asc';
		$where = array();
		$data['list'] = $this->Basic->getmultiplerow($order,$where,'pages');
		
		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/pages',$data);
		$this->load->view('theme/layout/footer',$data);
	}


		function addpages($id='')
		{
			if($this->session->userdata('user_type')!=1){
				redirect('order/myaccount');
			}
			if($id)
			{
			$data['title'] 		= 'Update Page';
	        $data['subtitle'] 	= 'Update Page';

			$where = array('id' => $id);
            $data['pages'] = $this->Basic->getsinglerow($where,'pages');
			}
			else
			{	
			$data['title'] 		= 'Create New Page';
	        $data['subtitle'] 	= 'Create New Page';
	        }

	    $order = 'id'.' '.'asc';
		$where = array('status !='=>2);
		$data['menulist'] = $this->Basic->getmultiplerow($order,$where,'navigation');

	      $category = $this->Product_model->getCategoryList();

		 foreach($category as $cate)
	     {
	         $userrole[$cate->category_id] = $cate->category_name; 
	     }

	     $data['category'] = $userrole;


		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/addpages',$data);
		$this->load->view('theme/layout/footer',$data);
	    }

	function saveCMS()
	{
		$postData = $this->input->post();
		
		try{
			if(isset($postData['save'])){
				if(!empty($postData['id']))	{
					unset($postData['save']);
					$pageId = $postData['id'];
					$this->Basic->updatedata($postData,['id' => $pageId],'pages');
					$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Updated Successfully</div>');
				}else{
					$result= $this->Basic->select('pages',array('page_url'=>$postData['page_url']),'id');
					if(isset($result) && !empty($result)){
						throw new Exception('Page URL already Exist');
					}
					unset($postData['save']);					
					$this->Basic->insertdata($postData,'pages');
				
					$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Inserted Successfully</div>');
				}
			}
			redirect('getpages');
		}
		catch(Exception $e){
			$message ="Invalid Request Exception ". $e->getMessage();
			$this->session->set_flashdata('message', $message);
		}
		redirect($_SERVER['HTTP_REFERER']);
	}


	/// menus starts here

	function getmenus()
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		$data['title'] 		= 'Manage Navigation';
        $data['subtitle'] 	= 'Manage Navigation';
        $order = 'id'.' '.'asc';
		$where = array('status !='=>2);
		$list = $this->Basic->getmultiplerow($order,$where,'navigation');

		$head = ['Navigation Menu','Parent','Group','Status','Actions'];
	    $headrows = [];

	    $group = ['Main','Header','Footer'];

	      foreach($list as $menu)
	      {
	      	$where = array('id' => $menu->parent_id);
            $pages = $this->Basic->getsinglerow($where,'pages');

            $title = ($pages && $pages->title)?$pages->title:'-';

	      	$status = ($menu->status==1)?'Active':'Inactive';

               $headrows[] = [$menu->id,$menu->menu,$title,$group[$menu->group_position],$status,'<a class="btn btn-success btn-xs" href='.base_url('copymenu/'.$menu->id).' data-original-title="btn btn-danger btn-xs" title="">Copy</a>

               <a class="btn btn-success btn-xs" href='.base_url('addmenu/'.$menu->id).' data-original-title="btn btn-danger btn-xs" title="">Edit</a>

                          <a class="btn btn-danger btn-xs"  href='.base_url('pages/deletemenu/'.$menu->id).' onClick="return doconfirm();"  data-original-title="btn btn-danger btn-xs" title="">Delete</a>'];
	      }

          $datasdable['formaction'] = base_url('Pages/multimenudelete');
	      $datasdable['head'] = $head;
	      $datasdable['headrows'] = $headrows;


		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/dynamictable',$datasdable);
		$this->load->view('theme/layout/footer',$data);
	}

	function deletemenu($id)
	{
          if($id)
        {
            
            $data = ['status'=>2];
            $where = array('id'=>$id);
            $this->Basic->updatedata($data,$where,'navigation');
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Menu has been  deleted Successfully</div>');
           redirect($_SERVER['HTTP_REFERER']);
        }
	}


	function addmenu($id='')
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
      	if($id)
			{
			$data['title'] 		= 'Update Navigation';
	        $data['subtitle'] 	= 'Update Navigation';

			$where = array('id' => $id);
            $data['menu'] = $this->Basic->getsinglerow($where,'navigation');
			}
			else
			{	
			$data['title'] 		= 'Create New Navigation';
	        $data['subtitle'] 	= 'Create New Navigation';
	        }


	     $order = 'id'.' '.'asc';
		$where = array();
		$data['list'] = $this->Basic->getmultiplerow($order,$where,'pages');


		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/addmenu',$data);
		$this->load->view('theme/layout/footer',$data);
	}


		function saveMenu()
	{
		$postData = $this->input->post();
		
		try{
			if(isset($postData['menu'])){
				if(!empty($postData['id']))	{
					unset($postData['save']);
					$pageId = $postData['id'];
					$this->Basic->updatedata($postData,['id' => $pageId],'navigation');
					$this->session->set_flashdata('msg', '<div class="alert alert-success">Navigation Updated Successfully</div>');
				}else{
					$result= $this->Basic->select('navigation',array('menu'=>$postData['menu']),'id');
					if(isset($result) && !empty($result)){
						$this->session->set_flashdata('msg', '<div class="alert alert-danger">Navigation Name already Exist</div>');
						redirect($_SERVER['HTTP_REFERER']);
					}
					unset($postData['save']);

					$postData['datetime'] = date('Y-m-d H:i:s');	

					$this->Basic->insertdata($postData,'navigation');
				
					$this->session->set_flashdata('msg', '<div class="alert alert-success">Navigation Inserted Successfully</div>');
				}
			}
			redirect('getmenus');
		}
		catch(Exception $e){
			$message ="Invalid Request Exception ". $e->getMessage();
			$this->session->set_flashdata('message', $message);
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

		function copymenu($id)
		{
			if($this->session->userdata('user_type')!=1){
				redirect('order/myaccount');
			}
				$data['title'] = 'Copy Navigation';  

			    $where = array('id' => $id);
                $data['menu'] = $this->Basic->getsinglerow($where,'navigation');

				$this->load->view('theme/layout/header',$data);
				$this->load->view('theme/myaccount/addmenu',$data);
				$this->load->view('theme/layout/footer',$data);
		}

	function multimenudelete()
	{
		$RequestData = $this->input->post();

          if(count($RequestData['ids'])>0)
          {
          	foreach ($RequestData['ids'] as $key =>$id) 
          	{
			$data = array('status'=>2);
			$where = array('id'=>$id);
			$this->Basic->updatedata($data,$where,'navigation');
          	}
          }

          $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Navigation has been Deleted successfully</div>');

           redirect($_SERVER['HTTP_REFERER']);
	}


	function choosesubcategory()
	{
			$cate_id = $this->input->post('cate_id');

	     $order = 'category_id'.' '.'asc';
		$where = array('parent_id'=>$cate_id);
		$list = $this->Basic->getmultiplerow($order,$where,'category');

         $option = ' <option value="">--Select Subcategory --</option>';

		foreach($list as $sub)
		{
			$option .= ' <option value="'.$sub->category_id.'">'.$sub->category_name.'</option>';
		}

		echo $option;
	}





	
}
