<?php
class Company_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function get_company($CompanyUID)
    {
        return $this->db->get_where('company',array('CompanyUID'=>$CompanyUID))->row_array();
    }
        
    function get_all_company()
    {
        $this->db->order_by('CompanyUID', 'desc');
        return $this->db->get('company')->result_array();
    }
        
    function add_company($params)
    {
        $this->db->insert('company',$params);
        return $this->db->insert_id();
    }
    
    function update_company($CompanyUID,$params)
    {
        $this->db->where('CompanyUID',$CompanyUID);
        return $this->db->update('company',$params);
    }
   
    function delete_company($CompanyUID)
    {
        return $this->db->delete('company',array('CompanyUID'=>$CompanyUID));
    }
}
