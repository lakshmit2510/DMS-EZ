<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller 
{

	function __construct()
	{
	   parent::__construct();
	   $this->load->model('User_model');
	   $this->load->model('Booking_model');
	  if(!$this->session->userdata('is_loggin')){ redirect(base_url('Login')); }
	  if($this->session->userdata('Role')==2)
	  { 
	  	redirect(base_url('Dashboard')); 
	  }
	}

	public function index()
	{
	  $data['Title'] = 'List of Users';
	  $data['Page'] = 'listuser';	
    $data['Users'] = $this->User_model->GetUsers();
    $this->load->view('List-users',$data);
  }

  function Add()
  {
    $data['Title'] = 'Create New User';
    $data['Page'] = 'adduser';  
    $data['vtype'] = $this->Common_model->getTableData('vechicletype','Active');
    $data['company'] = $this->Common_model->getTableData('company','Active');
	  $this->load->view('Add-users',$data); 	
	}

	function Edit($UserUID)
	{
	  $data['Title'] = 'Edit User';
	  $data['Page'] = 'listuser';	
    $data['vtype'] = $this->Common_model->getTableData('vechicletype','Active');
	  $data['userdetail'] = $this->User_model->GetUsersDetailsByUserID($UserUID);
    $data['company'] = $this->Common_model->getTableData('company','Active');
	  $this->load->view('Edit-users',$data); 	
	}

	function save_user()
	{
	  if($this->input->post())
	  {	
    $data['UserType'] = $this->input->post('UserType');
    $data['CompanyUID'] = $this->input->post('Company');
		$data['Name'] = $this->input->post('Name');
		$data['EmailAddress'] = $this->input->post('EmailAddress');
		$data['PhoneNumber'] = $this->input->post('PhoneNumber');
		/*$data['UserName'] = $this->input->post('UserName');*/
		$data['Password'] = $this->input->post('Password');
    $data['VNo'] = $this->input->post('VNo');
    $data['VType'] = $this->input->post('VType');
    $data['Supplier'] = $this->input->post('Supplier');
    $data['Role'] = $this->input->post('Role');
    $data['UAN'] = $this->input->post('UAN');
    
    $store = $this->User_model->SaveUser($data);
		if($store==1)
		{
		  $this->session->set_flashdata('msg',$data['Name'].' has been Created Successfully');
		  $this->session->set_flashdata('type','done');
		} else {
		  if($store!=2)
		  {
		  	$this->session->set_flashdata('msg',$data['Name'].' has been Create Error');
		  }	else {
		  	$this->session->set_flashdata('msg','Username Already Exit. Try again!.');
		  }
		  $this->session->set_flashdata('type','error');
		}
	  }
	  redirect(base_url('Users/Add'));
	}

	function update_user()
	{
	 if($this->input->post())
	  {	
     $data['UserType'] = $this->input->post('UserType');
     $data['CompanyUID'] = $this->input->post('Company');
	   $UserUID = $this->input->post('UserUID');
		 $data['Name'] = $this->input->post('Name');
     $data['EmailAddress'] = $this->input->post('EmailAddress');
     $data['PhoneNumber'] = $this->input->post('PhoneNumber');
     /*$data['UserName'] = $this->input->post('UserName');*/
     /*$data['Password'] = $this->input->post('Password');*/
     $data['VNo'] = $this->input->post('VNo');
     $data['VType'] = $this->input->post('VType');
     $data['Supplier'] = $this->input->post('Supplier');
     $data['Role'] = $this->input->post('Role');
     $data['UAN'] = $this->input->post('UAN');
		$store = $this->User_model->UpdateUser($data, $UserUID);
		if($store==1)
		{
		  $this->session->set_flashdata('msg',$data['Name'].' has been Updated Successfully');
		  $this->session->set_flashdata('type','done');
		} else {
		  if($store!=2)
		  {
		  	$this->session->set_flashdata('msg',$data['Name'].' has been Update Error');
		  }	else {
		  	$this->session->set_flashdata('msg','Username Already Exit. Try again!.');
		  }
		  $this->session->set_flashdata('type','error');
		}
	  }
	  redirect($_SERVER['HTTP_REFERER']); 	
	}
}
