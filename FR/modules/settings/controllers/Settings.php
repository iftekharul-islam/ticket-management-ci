<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends FR_Controller {

    function __construct(){
        parent::__construct();
        $this->ion_auth->is_admin() || redirect('dashboard', 'refresh');
    }

    function index(){
        redirect('settings/general_info', 'refresh');
    }
    
    function general_info(){
        $this->form_validation->set_rules('company', 'Company' , 'required');
        $this->form_validation->set_rules('contact_person', 'Contact Person' , 'required');
        $this->form_validation->set_rules('phone', 'Contact No' , 'required');
        $this->form_validation->set_rules('email', 'Email' , 'required|valid_email');
        $this->form_validation->set_rules('address', 'Address' , 'required');
        $this->form_validation->set_rules('reply_email', 'Reply_email' , 'required|valid_email');
        $this->form_validation->set_rules('app_title', 'App Title' , 'required');
        $this->form_validation->set_rules('tagline', 'Tagline' , 'max_length[55]');
        $this->form_validation->set_rules('footer_text', 'Footer Text' , 'required');
        $this->form_validation->set_rules('footer_link', 'Footer Link' , 'required|prep_url');
        $this->form_validation->set_rules('facebook', 'Facebook Link' , 'prep_url');
        $this->form_validation->set_rules('twitter', 'Twitter Link' , 'prep_url');
        $this->form_validation->set_rules('instagram', 'Instagram Link' , 'prep_url');
        $this->form_validation->set_rules('description', 'Site Description' , 'max_length[160]');
        $this->form_validation->set_rules('keywords', 'Keywords' , '');
        $this->form_validation->set_rules('before_head_end_tag', 'Codes before Closing Head tag' , '');
        $this->form_validation->set_rules('before_body_end_tag', 'Codes before Closing Body tag' , '');
        
        $data = array();
        if($this->form_validation->run()){
            $this->mfrk->update('settings', $_POST, array('id' => 1));
            $data['message'] = 'Information updated.';
        }
        $this->mfrk->_render_backend('general_info', $data);
    }
    
    function logos(){
        $data['message_error'] = '';
        $data['message'] = '';
        if($this->input->post('submit')){
            if(empty($_FILES['backend-logo']['error']) || empty($_FILES['logo']['error'])){
                $this->load->library('upload');
                $config['upload_path'] = './assets/logo/';
                $config['allowed_types'] = 'png';
                $config['max_size'] = '512';
                $config['max_width'] = '600';
                $config['max_height'] = '200';
                $config['overwrite'] = TRUE;

                if(empty($_FILES['backend-logo']['error'])){
                    $config['file_name'] = 'backend-logo.png';
                    $this->upload->initialize($config);
                    if($this->upload->do_upload('backend-logo')) $data['message'] = "Backend Logo uploaded successfully";
                    else $data['message_error'] = strip_tags ($this->upload->display_errors());
                }
                if(empty($_FILES['logo']['error'])){
                    $config['file_name'] = 'logo.png';
                    $this->upload->initialize($config);
                    if($this->upload->do_upload('logo')) $data['message'] .= "Frontend Logo uploaded successfully";
                    else $data['message_error'] .= strip_tags($this->upload->display_errors());
                }
            }else{
                $data['message_error'] = "No image selected.";
            }
        }
        $data['page_title'] = 'Change Logos';
        $this->mfrk->_render_backend('logos', $data);
    }
}

?>