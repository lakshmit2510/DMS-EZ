<?php
class Company extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Company_model');
    } 

    function index()
    {
        $data['company'] = $this->Company_model->get_all_company();        
        $data['Title'] = 'List of Companies';
        $data['Page'] = 'Company';
        $this->load->view('list_company',$data);
    }

    function add()
    {   
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				    'CompanyName' => $this->input->post('CompanyName'),
				    'BuildingName' => $this->input->post('BuildingName'),
				    'BuildingAddress' => $this->input->post('BuildingAddress'),
            'CreatedBy' => $this->session->userdata('UserUID'),
				    'Active' => 1,
            );            
            $company_id = $this->Company_model->add_company($params);
            $this->session->set_flashdata('done','Company detail successfully added.');
            redirect('Company');
        }
        else
        {            
            $data['Title'] = 'Add New Company';
            $data['Page'] = 'AddCompany';
            $this->load->view('add_company', $data);
        }
    }  

    function edit($CompanyUID)
    {   
        // check if the company exists before trying to edit it
        $data['company'] = $this->Company_model->get_company($CompanyUID);
        if(isset($data['company']['CompanyUID']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					     'CompanyName' => $this->input->post('CompanyName'),
					     'BuildingName' => $this->input->post('BuildingName'),
					     'BuildingAddress' => $this->input->post('BuildingAddress')
                );
                $this->Company_model->update_company($CompanyUID,$params);  
                $this->session->set_flashdata('done','Company detail successfully updated.');          
                redirect('Company');
            }
            else
            {
              $data['Title'] = 'Edit Company';
              $data['Page'] = 'editCompany';
              $this->load->view('edit_company', $data);
            }
        }
        else
        show_error('The company you are trying to edit does not exist.');
    } 

    function remove($CompanyUID)
    {
        $company = $this->Company_model->get_company($CompanyUID);
        // check if the company exists before trying to delete it
        if(isset($company['CompanyUID']))
        {
          $this->Company_model->delete_company($CompanyUID);
          redirect('Company');
        }
        else
        show_error('The company you are trying to delete does not exist.');
    }
    
}
