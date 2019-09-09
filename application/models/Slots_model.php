<?php

class Slots_model extends CI_Model 
{

    public function getAll() 
    {
        $this->db->select('*, slots.Active AS Active, slottypes.Type AS DockType');
        $this->db->join('bookingmode','slots.DMode = bookingmode.ModeID','LEFT');
        $this->db->join('slottypes','slots.Type = slottypes.STypeID','LEFT');
        return $this->db->get('slots')->result();
    }

    public function insert($data) {
        $this->db->insert('slots', $data);
        return $this->db->insert_id();
    }

    public function getDataById($id) {
        $this->db->where('SlotID', $id);
        return $this->db->get('slots')->row();
    }
    

    public function update($id,$data) {
        $this->db->where('SlotID', $id);
        $this->db->update('slots', $data);
        return true;
    }
    

    public function delete($id) {
        $this->db->where('SlotID', $id);
        $this->db->delete('slots');
        return true;
    }
    
    
    public function changeStatus($id) {
        $table=$this->getDataById($id);
             if($table->Active==0)
             {
                $this->update($id,array('Active' => '1'));
                return 1;
             }else{
                $this->update($id,array('Active' => '0'));
                return 0;
             }
    }

}