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
	  if($this->session->userdata('Role')==4)
	  { 
	  	redirect(base_url('Dashboard')); 
	  }
	}

  public function index()
  {
    if($this->session->userdata('Role') == 2)
    {
      $data['Title'] = 'List of Sub-contractors';
      $Role = 4;
    } else {
      $data['Title'] = 'List of Suppliers';
      $Role = 2;
    }
    $data['Page'] = 'listuser'; 
    $data['Users'] = $this->User_model->GetUsers($Role);
    $this->load->view('List-users',$data);
  }

	public function update()
  {
    if($this->session->userdata('Role') == 2)
    {
      $data['Title'] = 'Update Sub-contractors Information';
      $Role = 4;
    } else {
      $data['Title'] = 'Update Suppliers Information';
      $Role = 2;
    }
    $data['Page'] = 'add_edit_users_list';  
    $data['Users'] = $this->User_model->GetUsers($Role);
    $this->load->view('add_edit_users_list',$data);
  }

  function Add()
  {
    if($this->session->userdata('Role') == 2)
    {
      $data['Title'] = 'Create New Sub-contractor';
    } else {
      $data['Title'] = 'Create New Supplier';
    }
    $data['Page'] = 'adduser';  
    $data['vtype'] = $this->Common_model->getTableData('vechicletype','Active');
    $data['company'] = $this->Common_model->getTableData('company','Active');
    $this->load->view('Add-users',$data);   
  }

  public function Security()
  {
    $data['Title'] = 'List of Security Check';
    $data['Page'] = 'list_security';  
    $data['Users'] = $this->User_model->GetUsers(5);
    $this->load->view('list_security',$data);
  }

  public function QC()
  {
    $data['Title'] = 'List of QC Check';
    $data['Page'] = 'list_qc';  
    $data['Users'] = $this->User_model->GetUsers(6);
    $this->load->view('list_qcchecker',$data);
  }

  public function Approval()
  {
    $data['Title'] = 'List of Approvals';
    $data['Page'] = 'Approval';  
    $data['Users'] = $this->User_model->getApprovalPending();
    $this->load->view('list_approval',$data);
  }

  function AddSecurity()
  {
    $data['Title'] = 'Add New Security Check';
    $data['Page'] = 'AddSecurity';  
    $data['company'] = $this->Common_model->getTableData('company','Active');
    $this->load->view('Add-security',$data);   
  }

  function AddQc()
  {
    $data['Title'] = 'Add New QC Check';
    $data['Page'] = 'AddQc';  
    $data['company'] = $this->Common_model->getTableData('company','Active');
    $this->load->view('Add-qcchecker',$data);   
  }

  function Changepassword()
  {
    $data['Title'] = 'Change Password';
    $data['Page'] = 'changepassword';  
	  $this->load->view('changepassword',$data); 	
	}

  function Edit($UserUID)
  {
    if(empty($UserUID)) { redirect(base_url('Dashboard')); }
    if($this->session->userdata('Role') == 2)
    {
      $data['Title'] = 'Edit Sub-contractors';
    } else {
      $data['Title'] = 'Edit Suppliers';
    }
    $data['Page'] = 'listuser'; 
    $data['vtype'] = $this->Common_model->getTableData('vechicletype','Active');
    $data['userdetail'] = $this->User_model->GetUsersDetailsByUserID($UserUID);
    $data['company'] = $this->Common_model->getTableData('company','Active');
    $this->load->view('Edit-users',$data);  
  }

  function editSecurity($UserUID)
  {
    if(empty($UserUID)) { redirect(base_url('Dashboard')); }
    $data['Title'] = 'Edit Security Checker';
    $data['Page'] = 'listsecurity'; 
    $data['detail'] = $this->User_model->GetUsersDetailsByUserID($UserUID);
    $data['company'] = $this->Common_model->getTableData('company','Active');
    $this->load->view('Edit-security',$data);   
  }

  function deleteSecurity($UserUID)
  {
      if(empty($UserUID)) { redirect(base_url('Dashboard')); }
      $data['detail'] = $this->User_model->deleteUsersDetailsByUserID($UserUID);
        echo json_encode(array("success"=>'ok',"message"=>"User Successfully Deleted."));
  }

	function editQc($UserUID)
	{
    if(empty($UserUID)) { redirect(base_url('Dashboard')); }
	  $data['Title'] = 'Edit QC Checker';
    $data['Page'] = 'listqc';	
	  $data['detail'] = $this->User_model->GetUsersDetailsByUserID($UserUID);
    $data['company'] = $this->Common_model->getTableData('company','Active');
	  $this->load->view('Edit-qcchecker',$data); 	
	}

  function Approve($UserUID)
  {
    if(empty($UserUID)) { redirect(base_url('Dashboard')); }
    $data['IsApproved'] = 1;
    $approved = $this->User_model->ProcessUpdate($UserUID,$data);
    if($approved==1)
    {
      $usr = $this->User_model->GetUsersDetailsByUserID($UserUID);
      $data['UserName'] = $usr->UserName;
      $data['EmailAddress1'] = $usr->EmailAddress1;
      $data['UniqueID'] = $usr->UniqueID;
      $data['Password'] = $usr->Password;
      $data['url'] = base_url();
      $this->config_email();
      $data['mail_title'] = 'Your Login Details - SATS Dock Management System';
      $from_email = "aws.admin@elizabeth-zion.com.sg"; 
      $this->email->from($from_email); 
      $this->email->to($data['EmailAddress1']); #$Old->EmailAddress1;
      $this->email->subject('Thank you. Your Account is Created in SATS Dock Management System'); 
      $mes_body=$this->load->view('email/user-template.php',$data,true);// load html templates
      $this->email->message($mes_body); 
      $this->email->send();
      $this->session->set_flashdata('done',1);
      $this->session->set_flashdata('msg',$data['UserName'].' Approved successfully, Login details send to registerd email address.');
    } else {
      $this->session->set_flashdata('msg',$data['UserName'].' Approved error, Try again!.');
      $this->session->set_flashdata('error',1);
    }
    redirect($_SERVER['HTTP_REFERER']);
  }

  function Reject($UserUID)
  {
    if(empty($UserUID)) { redirect(base_url('Dashboard')); }
    $reject = $this->User_model->DeleteUser($UserUID);
    if($reject==1)
    {
      $this->session->set_flashdata('done',1);
      $this->session->set_flashdata('msg','User Rejected successfully.');
    } else {
      $this->session->set_flashdata('msg',$data['UserName'].' reject error, Try again!.');
      $this->session->set_flashdata('error',1);
    }
    redirect($_SERVER['HTTP_REFERER']);
  }

	function save_user()
  {
    if($this->input->post())
    { 
     $supplier = $this->Common_model->getMax('users');
     $data['UserType'] = $this->input->post('UserType');
     $data['CompanyUID'] = $this->input->post('Company');
     /*$data['Name'] = $this->input->post('Name');*/
     $data['EmailAddress1'] = $this->input->post('EmailAddress1');
     $data['EmailAddress2'] = $this->input->post('EmailAddress2');
     $data['PhoneNumber'] = $this->input->post('PhoneNumber');
     $data['UserName'] = $this->input->post('UserName');
     $data['Password'] = $this->input->post('Password');
     /*$data['VNo'] = $this->input->post('VNo');
     $data['VType'] = $this->input->post('VType');*/
     // $data['Supplier'] = $this->input->post('Supplier');
     if($this->session->userdata('Role') == 2)
     {
       $data['Role'] = 4;
     } else {
       $data['Role'] = $this->input->post('Role');
     }
     $data['UAN'] = $this->input->post('UAN');
     if($data['Role'] == 2)
     {
       $data['UniqueID'] = 'SS0000'.$supplier; # 'S'.str_pad($supplier, 5, '0', STR_PAD_LEFT);
     } else if($data['Role'] == 4) {
       $data['UniqueID'] = 'EP0000'.$supplier;
     }
     $data['CreatedBy'] = $this->session->userdata('UserUID');
     $data['IsApproved'] = 1;
     $store = $this->User_model->SaveUser($data);
     if($store==1)
     {
       $this->session->set_flashdata('msg',$data['UserName'].' has been Created Successfully');
       $this->session->set_flashdata('type','done');

       if(empty($data['UniqueID'])) { $data['UniqueID'] = ''; }
       $data['url'] = base_url();
       $this->config_email();
       $data['mail_title'] = 'Your Login Details - SATS Dock Management System';
       $from_email = "aws.admin@elizabeth-zion.com.sg"; 
       $this->email->from($from_email); 
       $this->email->to($data['EmailAddress1']); #$Old->EmailAddress1;
       $this->email->subject('Thank you. Your Account is Created in SATS Dock Management System'); 
       $mes_body=$this->load->view('email/user-template.php',$data,true);// load html templates
       $this->email->message($mes_body); 
       $this->email->send();

     } else {
      if($store!=2)
      {
        $this->session->set_flashdata('msg',$data['UserName'].' has been Create Error');
      } else {
        $this->session->set_flashdata('msg','Email Already Exist. Try again!.');
      }
      $this->session->set_flashdata('type','error');
    }
    }
    redirect(base_url('Users/Add'));
  }

  function save_security()
	{
	  if($this->input->post())
	  {	
     $data['UserType'] = 'Internal';
     $data['UAN'] = $this->input->post('UAN');
     $data['CompanyUID'] = $this->input->post('Company');
     $data['EmailAddress1'] = $this->input->post('EmailAddress1');
     $data['EmailAddress2'] = $this->input->post('EmailAddress2');
     $data['PhoneNumber'] = $this->input->post('PhoneNumber');
     $data['UserName'] = $this->input->post('UserName');
     $data['Password'] = $this->input->post('Password');
     // $data['Supplier'] = $this->input->post('Security');
     $data['Role'] = $this->input->post('Role');
     $data['CreatedBy'] = $this->session->userdata('UserUID');
     $data['IsApproved'] = 1;
     $store = $this->User_model->SaveUser($data);
		 if($store==1)
		 {
		   $this->session->set_flashdata('msg',$data['UserName'].' has been Created Successfully');
		   $this->session->set_flashdata('type','done');
       $data['url'] = base_url();
       $this->config_email();
       $data['mail_title'] = 'Your Login Details - SATS Dock Management System';
       $from_email = "aws.admin@elizabeth-zion.com.sg"; 
       $this->email->from($from_email); 
       $this->email->to($data['EmailAddress1']); #$Old->EmailAddress1;
       $this->email->subject('Thank you. Your Account is Created in SATS Dock Management System'); 
       $mes_body=$this->load->view('email/user-template.php',$data,true);// load html templates
       $this->email->message($mes_body); 
       $this->email->send();

		 } else {
		  if($store!=2)
		  {
		  	$this->session->set_flashdata('msg',$data['UserName'].' has been Create Error');
		  }	else {
		  	$this->session->set_flashdata('msg','Email Already Exist. Try again!.');
		  }
		  $this->session->set_flashdata('type','error');
		}
	  }
	  redirect($_SERVER['HTTP_REFERER']);   
	}

  function update_user()
  {
   if($this->input->post())
    { 
     $data['UserType'] = $this->input->post('UserType');
     $data['CompanyUID'] = $this->input->post('Company');
     $UserUID = $this->input->post('UserUID');
     /*$data['Name'] = $this->input->post('Name');*/
     $data['EmailAddress1'] = $this->input->post('EmailAddress1');
     $data['EmailAddress2'] = $this->input->post('EmailAddress2');
     $data['PhoneNumber'] = $this->input->post('PhoneNumber');
     $data['UserName'] = $this->input->post('UserName');
     /*$data['Password'] = $this->input->post('Password');*/
     /*$data['VNo'] = $this->input->post('VNo');
     $data['VType'] = $this->input->post('VType');*/
     $data['Supplier'] = $this->input->post('Supplier');
     if($this->session->userdata('Role') == 2)
     {
      $data['Role'] = 4;
     } else {
      $data['Role'] = $this->input->post('Role');
     }
     $data['UAN'] = $this->input->post('UAN');
    $store = $this->User_model->UpdateUser($data, $UserUID);
    if($store==1)
    {
      $this->session->set_flashdata('msg',$data['UserName'].' has been Updated Successfully');
      $this->session->set_flashdata('type','done');
    } else {
      if($store!=2)
      {
        $this->session->set_flashdata('msg',$data['UserName'].' has been Update Error');
      } else {
        $this->session->set_flashdata('msg','UserName Already Exist. Try again!.');
      }
      $this->session->set_flashdata('type','error');
    }
    }
    redirect($_SERVER['HTTP_REFERER']);   
  }

	function update_security()
  {
   if($this->input->post())
    { 
     $UserUID = $this->input->post('UserUID');
     $data['UserType'] = $this->input->post('UserType');
     $data['CompanyUID'] = $this->input->post('Company');
     $data['EmailAddress1'] = $this->input->post('EmailAddress1');
     $data['EmailAddress2'] = $this->input->post('EmailAddress2');
     $data['PhoneNumber'] = $this->input->post('PhoneNumber');
     $data['UserName'] = $this->input->post('UserName');
     $data['Supplier'] = $this->input->post('Supplier');
     $data['Role'] = $this->input->post('Role');
     $data['UAN'] = $this->input->post('UAN');
     $store = $this->User_model->UpdateUser($data, $UserUID);
     if($store==1)
     {
       $this->session->set_flashdata('msg',$data['UserName'].' has been Updated Successfully');
       $this->session->set_flashdata('type','done');
     } else {
      if($store!=2)
      {
        $this->session->set_flashdata('msg',$data['UserName'].' has been Update Error');
      } else {
        $this->session->set_flashdata('msg','UserName Already Exist. Try again!.');
      }
      $this->session->set_flashdata('type','error');
      }
    }
    redirect($_SERVER['HTTP_REFERER']);   
  }

  function updatepassword()
	{
	 if($this->input->post())
	 {	
     $UserUID = $this->session->userdata('UserUID');
     $Password = $this->input->post('Current');
     $Pass = $this->input->post('Password');
     $Npass = $this->input->post('NPassword');
     $Old = $this->User_model->getUserdetails($UserUID);
     
     if($Old->Password != $Password)
     {
       $this->session->set_flashdata('msg','Current Password do not match.');
       $this->session->set_flashdata('type','error');
       redirect($_SERVER['HTTP_REFERER']);        
     } else {
      if($Pass != $Npass) 
      {
        $this->session->set_flashdata('msg','Confirm Password do not match.');
        $this->session->set_flashdata('type','error');
        redirect($_SERVER['HTTP_REFERER']);        
      }
     }

     $data['Password'] = $Npass;
		 $store = $this->User_model->updatepassword($data, $UserUID);
		 if($store==1)
		 {
		   $this->session->set_flashdata('msg','Password changed successfully');
		   $this->session->set_flashdata('type','done');
		 } else {
		   $this->session->set_flashdata('msg',' Cannot reset your Password. Try again sometime');
		   $this->session->set_flashdata('type','error');
		 }
	 }
	 redirect($_SERVER['HTTP_REFERER']); 	
	}

  public function config_email()
  {
    $config = Array( 
      'protocol' => 'smtp', 
      'smtp_host' => 'email-smtp.us-east-1.amazonaws.com', 
      'smtp_port' => 587, 
      'smtp_user' => 'AKIA3SSJBQUNC5FHZTP7', 
      'smtp_pass' => 'BNDs7tsY4Jzt7g6af5qdxzPKXXyEDmhBN3SfRKSQKbBY',
      'smtp_crypto' => 'tls',
      'mailtype'  => 'html', 
      'charset'   => 'iso-8859-1',
      'newline' => '\r\n',
      'starttls'  => true,
      'wordwrap'  =>  true ); 
    $emailconf = $this->load->library('email', $config);
    $this->email->set_newline("\r\n");
    return $emailconf;
  }

}
