<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model 
{

	
	function getSlots($Mode)
	{
	   $this->db->select('*');	
     $this->db->where('Type',$Mode);
     // $this->db->where('DBuildingName',$Building);
     $this->db->where('Active',1);
     $this->db->order_by('SlotName','ASC');
	   $q = $this->db->get('slots');
	   if($q->num_rows()>0)
	   {
	   	 return $q->result();
	   } else { 
       return array();
	   }
	}

  function updateBooking($data,$id)
  {
    $this->db->where('BookingID', $id);
    $this->db->update('booking', $data);
  }

  function getBookingDetail($filter='')
  {
     $this->db->select('*, booking.BookingRefNo AS BookingRefNo, bookingmode.Mode AS BookMode, slottypes.Type AS SlotType, booking.CreatedOn AS BookedOn'); 
     $this->db->from('booking');
     $this->db->join('users','users.UserUID = booking.CreatedBy','LEFT');
     $this->db->join('status','status.StatusID = booking.Status','LEFT');
     $this->db->join('slottypes','slottypes.STypeID = booking.SlotType','LEFT');
     $this->db->join('bookedslots','bookedslots.SlotType = booking.SlotType AND booking.BookingID = bookedslots.BookingUID','LEFT');
     $this->db->join('slots','slots.SlotID = bookedslots.SlotID','LEFT');
     $this->db->join('vechicletype','vechicletype.TypeID = booking.VType','LEFT');
     $this->db->join('vehicle','vehicle.ID = booking.VNo','LEFT');
     $this->db->join('bookingmode','bookingmode.ModeID = booking.BookMode','LEFT');
     $this->db->join('area','area.AreaID = booking.AreaUID','LEFT');
     if($filter == 'Today')
     {
      $this->db->where('DATE(booking.CheckIn)',date('Y-m-d'));
     } else if($filter == 'Past') {
      $this->db->where('DATE(booking.CheckIn) <',date('Y-m-d'));
     } else if($filter == 'Upcoming') {
      $this->db->where_not_in('status',array(3,6),FALSE);
      $this->db->where('booking.CheckIn >',date('Y-m-d H:i:s'));
     } else if($filter == 'Security') { 
       $this->db->where_in('status',array(1,2),FALSE);
     } else if($filter == 'QC') { 
       $this->db->where('status',2);
     } else if($filter == 'RealTime') {
       $this->db->where('DATE(booking.CheckIn)',date('Y-m-d'));
       $this->db->where_not_in('status',array(3,6),FALSE);
     }

     if(in_array($this->session->userdata('Role'), array(2,4)))
     {
       $this->db->where('booking.CreatedBy', $this->session->userdata('UserUID')); 
     }
     $this->db->where('booking.Active',1);
     if($filter == 'RealTime') 
     {
       $this->db->order_by('FIELD(status.StatusID, 2,4,5,1)',FALSE);
     } else if(in_array($filter, array('Security','QC'))) {
       $this->db->order_by('FIELD(status.StatusID, 1,2,4,5)',FALSE);
     } else {
       $this->db->order_by('booking.BookingID','DESC');
     }
     $q = $this->db->get();
     if($q->num_rows()>0)
     {
       return $q->result();
     } else { 
       return array();
     }
  }

  function getBookingDetailID($id,$type='')
  {
     $this->db->select('*, bookingmode.Mode AS BookMode, slottypes.Type AS DockType, booking.CreatedOn AS BookedOn, booking.CreatedBy AS BookedBy'); 
     $this->db->from('booking');
     $this->db->join('company','company.CompanyUID = booking.DeliveryTo','LEFT');
     $this->db->join('slottypes','slottypes.STypeID = booking.SlotType','LEFT');
     $this->db->join('bookedslots','bookedslots.SlotType = booking.SlotType AND booking.BookingID = bookedslots.BookingUID','LEFT');
     $this->db->join('slots','slots.SlotID = bookedslots.SlotID','LEFT');
     $this->db->join('vechicletype','vechicletype.TypeID = booking.VType','LEFT');
     $this->db->join('vehicle','vehicle.ID = booking.VNo','LEFT');
     $this->db->join('bookingmode','bookingmode.ModeID = booking.BookMode','LEFT');
     $this->db->join('area','area.AreaID = booking.AreaUID','LEFT');
     if($type == 'RefNo')
     {
       $this->db->where('booking.BookingRefNo',$id);
     } else {
       $this->db->where('booking.BookingID',$id);
     }
     $q = $this->db->get();
     if($q->num_rows()>0)
     {
       return $q->row();
     } else { 
       return array();
     }
  }

  function bookedSlot($Type,$CheckIn,$CheckOut)
  {
    $date = explode(' ', $CheckIn);
    $out = explode(' ', $CheckOut);
    $result = $this->db->query('SELECT SlotID FROM `bookedslots` WHERE DATE(CheckIn) = "'.$date[0].'" AND (( TIME(CheckIn) >= "'.$date[1].':00" OR TIME(CheckOut) >= "'.$date[1].':00") AND (TIME(CheckIn) <= "'.$out[1].':00" OR TIME(CheckOut) <= "'.$out[1].':00")) AND SlotType ='.$Type)->result_array();
    return array_column($result, 'SlotID');
  }

	function SaveBooking($data, $slots)
	{
	   $this->db->insert('booking', $data);
     $booking_id = $this->db->insert_id();
	   if(!empty($booking_id))
	   {
	   	 foreach ($slots as $key => $value) 
       {
         $ds[$key]['SlotID'] = $value;
         $ds[$key]['BookingUID'] = $booking_id;
         $ds[$key]['SlotType'] = $data['SlotType'];
         $ds[$key]['VNo'] = $data['VNo'];
         $ds[$key]['CheckIn'] = $data['CheckIn'];
         $ds[$key]['CheckOut'] = $data['CheckOut'];
         $ds[$key]['CreatedBy'] = $this->session->userdata('UserUID');
       }
       $this->db->insert_batch('bookedslots',$ds);
       return $booking_id;
	   } else {
	   	 return 0;
	   }
	}

  function getMax()
  {
    $this->db->select('count(1) AS Booked');
    $r = $this->db->get('booking')->row();
    return $r->Booked + 1;
  }

}	
