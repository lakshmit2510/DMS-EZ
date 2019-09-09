<?php

class Vehicle_model extends CI_Model {

   
    public function getAll() {
        $this->db->join('vechicletype','vechicletype.TypeID = vehicle.VehicleTypeID','LEFT');
        if(in_array($this->session->userdata('Role'), array(2,4))) 
        {
         $this->db->where('vehicle.CreatedBy', $this->session->userdata('UserUID')); 
        }
        return $this->db->get('vehicle')->result();
    }
   
    public function insert($data) {
        $this->db->insert('vehicle', $data);
        return $this->db->insert_id();
    }
   
    public function getDataById($id) {
        $this->db->where('ID', $id);
        return $this->db->get('vehicle')->row();
    }
   
    public function update($id,$data) {
        $this->db->where('ID', $id);
        $this->db->update('vehicle', $data);
        return true;
    }
   
    public function delete($id) {
        $this->db->where('ID', $id);
        $this->db->delete('vehicle');
        return true;
    }
   
    public function changeStatus($id) {
        $table=$this->getDataById($id);
             if($table[0]->status==0)
             {
                $this->update($id,array('status' => '1'));
                return "Activated";
             }else{
                $this->update($id,array('status' => '0'));
                return "Deactivated";
             }
    }

}