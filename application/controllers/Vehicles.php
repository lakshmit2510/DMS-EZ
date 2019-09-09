<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicles extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('is_loggin')){ redirect(base_url('Login')); }
        $this->load->model('Vehicle_model');
    }

    public function index() 
    { 
      $data['Title'] = 'List of Vehicles';
      $data['Page'] = 'Vehicles';
      $data["vehicles"] = $this->Vehicle_model->getAll();
      $this->load->view('list_vehicle', $data);
    }
    
    public function add() 
    {
      $data['Title'] = 'Add Vehicle';
      $data['Page'] = 'Vehicles';
      $data['vtype'] = $this->Common_model->getTableData('vechicletype','Active');
      $this->load->view('add-vehicle', $data);
    }

    public function update() 
    {
      $data['Title'] = 'Update Vehicle Information';
      $data['Page'] = 'Vehicles';
      $data["vehicles"] = $this->Vehicle_model->getAll();
      $this->load->view('update_vehicle_list', $data);
    }
      
    public function addVehiclePost() 
    {
        $data['VehicleNo'] = $this->input->post('VehicleNo');
        $data['VehicleTypeID'] = $this->input->post('Type');
        $data['DriverName'] = $this->input->post('Driver');
        $data['DriverNumber'] = $this->input->post('DriverNo');
        $data['DriverNRIC'] = $this->input->post('NRIC');
        $data['CreatedBy'] = $this->session->userdata('UserUID');
        $this->Vehicle_model->insert($data);
        $this->session->set_flashdata('done', 'Vehicle added Successfully');
        redirect(base_url('Vehicles/update'));
    }
    

    public function edit($vehicle_id) 
    {
        $data['Title'] = 'Edit Vehicle Details';
        $data['Page'] = 'Vehicles';
        $data['vehicle_id'] = $vehicle_id;
        $data['vehicle'] = $this->Vehicle_model->getDataById($vehicle_id);
        $data['vtype'] = $this->Common_model->getTableData('vechicletype');
        $this->load->view('edit-vehicle', $data);
    }
    

    public function editVehiclePost() 
    {
        $vehicle_id = $this->input->post('vehicle_id');
        $vehicle = $this->Vehicle_model->getDataById($vehicle_id);
        $data['VehicleNo'] = $this->input->post('VehicleNo');
        $data['VehicleTypeID'] = $this->input->post('Type');
        $data['DriverName'] = $this->input->post('Driver');
        $data['DriverNumber'] = $this->input->post('DriverNo');
        $data['DriverNRIC'] = $this->input->post('NRIC');
        $edit = $this->Vehicle_model->update($vehicle_id,$data);
        if ($edit) {
            $this->session->set_flashdata('done', 'Vehicle updated Successfully');
            redirect(base_url('Vehicles/update'));
        }
    }
    

    public function viewVehicle($vehicle_id) 
    {
        $data['vehicle_id'] = $vehicle_id;
        $data['vehicle'] = $this->Vehicle_model->getDataById($vehicle_id);
        $this->load->view('view-vehicle', $data);
    }

    public function delete($vehicle_id) 
    {
        $delete = $this->Vehicle_model->delete($vehicle_id);
        $this->session->set_flashdata('done', 'Vehicle deleted Successfully');
        redirect(base_url('Vehicles/update'));
    }
    
    public function changeStatusVehicle($vehicle_id) 
    {
        $edit = $this->Vehicle_model->changeStatus($vehicle_id);
        $this->session->set_flashdata('done', 'vehicle '.$edit.' Successfully');
        redirect(base_url('Vehicles'));
    }
    
}