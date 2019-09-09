<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller 
{

	function __construct()
	{
	  parent::__construct();
	  $this->load->model('Login_model');
	}

	public function index()
	{
	   if($this->session->userdata('is_loggin')==TRUE)
	   	{ 
	   	  redirect(base_url('Dashboard')); 
	   	} else {
		    $this->load->view('login');
	   	}
	}

  function Signup()
  {
    $data['vtype'] = $this->Common_model->getTableData('vechicletype','Active');
    $data['company'] = $this->Common_model->getTableData('company','Active');
    if($this->session->userdata('is_loggin')==TRUE)
    { 
      redirect(base_url('Dashboard')); 
    } else {
      $this->load->view('signup',$data);
    }
  }

  function save()
  {
    $this->load->model('User_model');
    if($this->input->post())
    { 
      $data['UserType'] = $this->input->post('UserType');
      $data['CompanyUID'] = $this->input->post('Company');
      $data['Name'] = $this->input->post('Name');
      $data['EmailAddress'] = $this->input->post('EmailAddress');
      $data['PhoneNumber'] = $this->input->post('PhoneNumber');
      $data['UserName'] = $this->input->post('UserName');
      $data['Password'] = $this->input->post('Password');
      $data['VNo'] = $this->input->post('VNo');
      $data['VType'] = $this->input->post('VType');
      $data['Supplier'] = $this->input->post('Supplier');
      $data['UAN'] = $this->input->post('UAN');
      $data['Role'] = 2;

      $store = $this->User_model->SaveUser($data);
      if($store==1)
      {
        $row = $this->Login_model->CheckAuthendication(array('UserName'=>$data['UserName'],'Password'=>$data['Password']));
        if(!empty($row))
        {
         $this->session->set_userdata(array(
          'UserUID'=>$row->UserUID,
          'UserName'=>$row->UserName,
          'Role'=>$row->Role,
          'UserType'=>$row->UserType,
          'FullName'=>$row->Name,
          'is_loggin'=>TRUE
        ));
        redirect(base_url('Dashboard'));
       } 
      } else {
        if($store!=2)
        {
          $this->session->set_flashdata('msg',$data['Name'].' has been Create Error');
        } else {
          $this->session->set_flashdata('msg','Username Already Exit. Try again!.');
        }
        $this->session->set_flashdata('type','error');
        redirect(base_url('Login/Signup'));
      }
    }
  }

	function Authendication()
	{
	   $data['EmailAddress'] = $this->input->post('UserName');
	   $data['Password'] = $this->input->post('Password');
     $data['Active'] = 1;
	   $row = $this->Login_model->CheckAuthendication($data);
	   
	   if(!empty($row))
	   {
	   	 $this->session->set_userdata(array(
	   	 	'UserUID'=>$row->UserUID,
	   	 	'UserName'=>$row->UserName,
        'Role'=>$row->Role,
        'UserType'=>$row->UserType,
	   	 	'FullName'=>$row->Name,
	   	 	'is_loggin'=>TRUE
	   	  ));
	   	 redirect(base_url('Dashboard'));
	   } else {
	   	 $this->session->set_flashdata('error',1);
	   	 redirect(base_url());
	   }
	}

	function logout()
	{
	  $this->session->sess_destroy();
	  redirect(base_url());
	}

	function error_404()
	{
	  $this->load->view('404-Error');
	}
}
