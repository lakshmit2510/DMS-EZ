<?php

class Slots extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('is_loggin')){ redirect(base_url('Login')); }
        $this->load->model('Slots_model');
    }

    public function index() { 
        $data['Title'] = 'List of Docks';
        $data['Page'] = 'Docks';
        $data["slotss"] = $this->Slots_model->getAll();
        $this->load->view('list_slots', $data);
    }
    

    public function add() {
        $data['Title'] = 'Add New Docks';
        $data['Page'] = 'addDocks';
        $data['slottype'] = $this->Common_model->getTableData('slottypes','Active');
        $this->load->view('add_slots', $data);
    }
    
    public function addSlotsPost() 
    {
        $data['SlotName'] = $this->input->post('SlotName');
        $data['DMode'] = $this->input->post('Mode');
        $data['DBuildingName'] = $this->input->post('BuildingName');
        $data['Type'] = $this->input->post('SlotType');
        if($this->input->post('Price')=='')
        { 
          $data['Price'] = '0';
        } else { 
          $data['Price'] = $this->input->post('Price'); 
        }
        $this->Slots_model->insert($data);
        $this->session->set_flashdata('done', 'Docks added Successfully');
        redirect('Docks');
    }

    public function editSlots($slots_id) 
    {
        $data['slots_id'] = $slots_id;
        $data['Title'] = 'Slots';
        $data['Page'] = 'Slots';
        $data['slots'] = $this->Slots_model->getDataById($slots_id);
        $data['slottype'] = $this->Common_model->getTableData('slottypes','Active');
        $this->load->view('edit_slots', $data);
    }
    

    public function editSlotsPost() 
    {
        $slots_id = $this->input->post('ID');
        $slots = $this->Slots_model->getDataById($slots_id);
        $data['SlotName'] = $this->input->post('SlotName');
        $data['DMode'] = $this->input->post('Mode');
        $data['DBuildingName'] = $this->input->post('BuildingName');
        $data['Type'] = $this->input->post('SlotType');
        if($this->input->post('Price')=='')
        { 
          $data['Price'] = '0';
        } else { 
          $data['Price'] = $this->input->post('Price'); 
        }
        $edit = $this->Slots_model->update($slots_id,$data);
        if($edit) {
          $this->session->set_flashdata('done', 'Docks details Updated');
          redirect('Docks');
        }
    }
        

    public function deleteSlots($slots_id) {
        $delete = $this->Slots_model->delete($slots_id);
        $this->session->set_flashdata('done', 'Docks deleted');
        redirect('Docks');
    }
    

    public function changeStatus($slots_id) 
    {
        $edit = $this->Slots_model->changeStatus($slots_id);
        if(empty($edit))
        {
          $this->session->set_flashdata('done', 'Docks closed Successfully');
        } else {
          $this->session->set_flashdata('done', 'Docks opened Successfully');
        }
        redirect('Docks');
    }
    
}