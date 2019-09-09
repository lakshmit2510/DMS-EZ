<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model 
{

	function GetUserCount($flt)
	{
    if($flt == 'Active')
    {
      $status = 1;
    } else {
      $status = 0;
    }
    $this->db->where('Active', $status);
	  $this->db->select('COUNT(UserUID) AS User');
    $result = $this->db->get('users')->row();
    if(is_object($result))
    {
      return $result->User;
    } else {
      return 0;
    }
  }

	function GetProjectView($ProjectUID)
	{
	  $this->db->select('*, projects.ProjectUID as ProjectUID, wing.WingName as Wing, circle.CircleName as Circle, division.DivisionName as Division')->from('projects');
	  $this->db->join('detailsofworks','detailsofworks.ProjectUID = projects.ProjectUID','LEFT');
	  $this->db->join('alignment_details','alignment_details.ProjectUID = projects.ProjectUID','LEFT');
	  $this->db->join('wing','wing.WingID = detailsofworks.Wing','LEFT');
	  $this->db->join('circle','circle.CircleID = detailsofworks.Circle','LEFT');
	  $this->db->join('division','division.DivisionID = detailsofworks.Division','LEFT');
	  $this->db->where('projects.ProjectUID',$ProjectUID);
	  $this->db->order_by('projects.ProjectUID','ASC');	
	  $q = $this->db->get();
	  if($q->num_rows()>0)
	  {
	    return $q->result();
	  } else {
	    return 0;
	  }
	}

}
