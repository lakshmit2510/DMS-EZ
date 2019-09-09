<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model 
{

  function getBarChartData($keyword,$fdate,$tdate,$month_year,$flt)
  {
    $where = $this->getwhere($flt);
    if(!empty($where))
    {
      $where = ' AND '.$where;
    }
    foreach($month_year as $Y_m)
    { 

      if($keyword == '30Days')
      {
        $case_when = "DATE(CreatedOn) = '$Y_m'";
      } else {
        $mon = explode('-', $Y_m);  
        $case_when = "MONTH(CreatedOn) = '".$mon[1]."' AND YEAR(CreatedOn) = '".$mon[0]."'";
      }

       $sql = "select COALESCE(COUNT(BookingID),0) as booking from booking where $case_when ".$where."";
       $sqlquery = $this->db->query($sql);
       $result[] = $sqlquery->result(); 
    }
    return $result;
  }

  function getDoughChartData($fdate,$tdate,$flt)
  {
    $where = $this->getwhere($flt);
    if(!empty($where))
    {
      $where = 'where '.$where;
    }
    $sql = "select COUNT(CASE WHEN(DATE(CreatedOn) < DATE(NOW()) AND Active = 1) THEN 1 END) as Past,COUNT(CASE WHEN(DATE(CreatedOn) > DATE(NOW())) THEN 1 END) as Upcoming,COUNT(CASE WHEN(Active = 0) THEN 1 END) as Cancel from booking ".$where."";
    $sqlquery = $this->db->query($sql);
    $result = $sqlquery->row();
    return $result;
  }

  function getwhere($filter)
  {
    $where = array_filter($filter);
    if(empty($where))
    {
      return '';
    }

    if(in_array($this->session->userdata('Role'),array(3,4)))
    {
      $role = ','.$this->session->userdata('UserUID');
    } else {
      $role = '';
    }

    $sql = array();
    if(!empty($where['CompanyUID']))
    {
      $sql[] = 'CompanyUID = '.$where['CompanyUID'];
    }
    
    if(!empty($where['supplier']) && !empty($where['subcontractor']))
    {
      $sql[] = 'CreatedBy IN ('.$where['supplier'].','.$where['subcontractor'].''.$role.')';
    } else {
      if(!empty($where['supplier']))
      {
        $sql[] = 'CreatedBy IN ('.$where['supplier'].''.$role.')';
      }

      if(!empty($where['subcontractor']))
      {
        $sql[] = 'CreatedBy IN ('.$where['subcontractor'].''.$role.')';
      }
    }

    return implode(' AND ',$sql);
  }
   // Dock type bookings information
    function getDockTypeTableData($tableParams){
        $whereDate = '';
        $whereDocktype = '';
        if(!empty($tableParams) && !empty($tableParams["fDate"])){
            $whereDate = ' && booking.Checkin >= "'.date("Y-m-d H:i:s", $tableParams["fDate"]).'" && booking.Checkin <= "'.date("Y-m-d H:i:s", $tableParams["tDate"]).'"';
        }
        if(!empty($tableParams) && !empty($tableParams['dockType'])){
            $whereDocktype = ' && booking.SlotType = '.$tableParams['dockType'];
        }

        $sql = "select DATE(Floor(booking.CheckIn)) as Date, slottypes.Type as DockType,numberofslots.NumberOfDocks, DATE_FORMAT(booking.CheckIn, '%e %b %Y') as Booked, 
	COUNT(slottypes.Type) as BookedDocks from booking 
	LEFT JOIN slottypes ON (slottypes.STypeID = booking.SlotType) 
	LEFT JOIN (SELECT slots.Type as SlotTypeNo, COUNT(slottypes.Type) as NumberOfDocks From slots INNER JOIN slottypes ON (slottypes.STypeID = slots.Type) GROUP BY SlotTypeNo) as numberofslots 
	ON (slottypes.STypeID = numberofslots.SlotTypeNo ) where slottypes.Active = 1".$whereDocktype.$whereDate." GROUP BY Booked,DockType";

        $sqlquery = $this->db->query($sql);
        $result = $sqlquery->result();
        return $result;
    }
    function getDockTypeChartData($requestParams){
        $whereDate = '';
        $whereDocktype = '';
        if(!empty($requestParams) && !empty($requestParams["fDate"])){
            $whereDate = ' && booking.Checkin >= "'.date("Y-m-d H:i:s", $requestParams["fDate"]).'" && booking.Checkin <= "'.date("Y-m-d H:i:s", $requestParams["tDate"]).'"';
        }
        if(!empty($requestParams) && !empty($requestParams['dockType'])){
            $whereDocktype = ' && booking.SlotType = '.$requestParams['dockType'];
        }

        $sql = "select slots.SlotName,slots.Type,DATE(Floor(booking.CheckIn)) as Date, slottypes.Type AS DockType, COUNT(slottypes.Type) as BookedDocks,
    DATE_FORMAT(booking.CheckIn, '%e %b %Y') as Booked from booking
    LEFT JOIN slottypes ON (slottypes.STypeID = booking.SlotType)
    LEFT JOIN bookedslots ON (bookedslots.SlotType = booking.SlotType AND booking.BookingID = bookedslots.BookingUID)
    LEFT JOIN slots ON (slots.SlotID = bookedslots.SlotID)
    where booking.Active = 1".$whereDocktype.$whereDate."
    GROUP BY DockType,Booked,SlotName order by Date";


        $sqlquery = $this->db->query($sql);
        $result = $sqlquery->result();
        return $result;
    }

}
