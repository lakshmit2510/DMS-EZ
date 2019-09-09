<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model 
{

  function getTableData($table,$active='')
  {
    if(!empty($active))
    {
      $this->db->where('Active',1);
    }
    $q = $this->db->get($table);  
    if($q->num_rows()>0)
    {
      return $q->result();
    } else {
      return 0;
    }
  }

  function getUserdetails($UserUID)
  {
    $this->db->where('UserUID',$UserUID);
    $this->db->join('company','company.CompanyUID = users.CompanyUID','LEFT');
    $q = $this->db->get('users');  
    if($q->num_rows()>0)
    {
      return $q->row();
    } else {
      return 0;
    }
  }

  function getUserByRole($Role)
  {
     if($this->session->userdata('Role') == 2) 
     {
      $this->db->where('CreatedBy', $this->session->userdata('UserUID')); 
     } 
     $this->db->where('Role',$Role);
     $this->db->where('IsApproved',1);
     $this->db->join('company','company.CompanyUID = users.CompanyUID','LEFT');
     $q = $this->db->get('users');  
     if($q->num_rows()>0)
     {
      return $q->result();
     } else {
      return array();
     } 
  }

	function SaveUser($data)
	{
	   $this->db->select('UserUID');
     $this->db->where('UserName',$data['UserName']);  
	   $this->db->or_where('EmailAddress1',$data['EmailAddress1']);	
	   $q = $this->db->get('users');
	   if($q->num_rows()>0)
	   {
	   	 return 2;
	   } else {
	   	 if($this->db->insert('users',$data))
	     {
	   	   $user = $this->db->insert_id();
         return 1;
	     } else {
	   	   return 0;
	     }
	   }
	}

  function ProcessUpdate($UserUID,$data)
  {
    $this->db->where('UserUID',$UserUID);
    if($this->db->update('users',$data))
    {
     return 1;
    } else {
     return 0;
    }
  }

  function DeleteUser($UserUID)
  {
    $this->db->where('UserUID', $UserUID);
    if($this->db->delete('users'))
    {
     return 1;
    } else {
     return 0;
    }
  }

  function UpdateUser($data,$UserUID)
  {
     $this->db->select('UserUID');
     $this->db->where('UserName',$data['UserName']);  
     $this->db->where('Role',$data['Role']);  
     $this->db->where("UserUID !=".$UserUID);   
     $q = $this->db->get('users');
     if($q->num_rows()>0)
     {
       return 2;
     } else {
       $this->db->where('UserUID',$UserUID);
       if($this->db->update('users',$data))
       {
         return 1;
       } else {
         return 0;
       }
     }
  }

	function updatepassword($data,$UserUID)
	{
   	 $this->db->where('UserUID',$UserUID);
   	 if($this->db->update('users',$data))
     {
   	   return 1;
     } else {
   	   return 0;
     }
	}

  function getApprovalPending()
  {
    $this->db->where('IsApproved',0);   
    $this->db->join('vechicletype','vechicletype.TypeID = users.VType','LEFT');
    $q = $this->db->get('users');  
    if($q->num_rows()>0)
    {
      return $q->result();
    } else {
      return array();
    }
  }

	function GetUsers($Role='')
	{
    if(empty($Role))
    {
      if($this->session->userdata('Role') == 2) 
      {
        $this->db->where('CreatedBy', $this->session->userdata('UserUID')); 
      }      
    } else {
      $this->db->where('Role', $Role);
    }
    $this->db->where('IsApproved',1);
    $this->db->join('vechicletype','vechicletype.TypeID = users.VType','LEFT');
	  $q = $this->db->get('users');	 
	  if($q->num_rows()>0)
	  {
	  	return $q->result();
	  } else {
	  	return 0;
	  }
	}

	function GetUsersDetailsByUserID($UserUID)
	{
	  $this->db->where('UserUID',$UserUID);		
	  $q = $this->db->get('users');	 
	  return $q->row();
	}

	function deleteUsersDetailsByUserID($UserUID)
    {
        $this->db->where('UserUID',$UserUID);
        if($this->db->delete('users'))
        {
            return 1;
        } else {
            return 0;
        }
    }

	function GetUsersOnly()
	{
	  $data['Roles'] = 'User';	
    $this->db->where('IsApproved',1);
	  $q = $this->db->get_where('users',$data);	
	  if($q->num_rows()>0)
	  {
	  	return $q->result();
	  } else {
	  	return 0;
	  }
	}
}
