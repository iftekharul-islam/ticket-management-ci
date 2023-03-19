<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_Components extends FR_Controller {

    function __construct(){
        parent::__construct();
        if(!$this->ion_auth->is_admin()) redirect('dashboard', 'refresh');
    }
    
    function add_event_content()
    {
        $data['page_title'] = "Add Content For An Event or Category";
        $this->form_validation->set_rules('content', 'Content' , 'required');
        $this->form_validation->set_rules('placement', 'placement' , 'required');
        $this->form_validation->set_rules('type', 'type' , 'required');
        $this->form_validation->set_rules('event_url', 'event url' , 'required');
        if($this->form_validation->run())
        {
            if($_POST['type'] == 'category')
            {
                if(strpos($_POST['event_url'],'category/'))
                {
                 $eventUrl = explode('category/',$_POST['event_url']);
                 $_POST['event_url'] = $eventUrl[1];
                 $result  = $this->mfrk->get_where("event_contents",['type' => 'category','placement' => $_POST['placement'],'event_url' => $_POST['event_url']])->result();
                }
                else 
                {
                    $data['message_error'] = 'The given url is not valid';
                    return  $this->mfrk->_render_backend('add_event_content', $data);
                }
            }
            else 
            {
                $this->db->like('event_url', "/" .$this->getUrlId($_POST['event_url']), 'before');
                $result  = $this->mfrk->get_where("event_contents",['type' => 'events'])->result();
            }

            if($result)
            { 
               $data['message_error'] = 'Event or category should be unique';
               return  $this->mfrk->_render_backend('add_event_content', $data);
            }

            $this->mfrk->insert('event_contents', $_POST);
            $this->session->set_flashdata('message', "Content updated. <a href='" . $_POST['type'] . "/" . $_POST['event_url'] . "'>VIEW</a>");
            redirect('home_components/event_contents', 'refresh');
        }
     
        $this->mfrk->_render_backend('add_event_content', $data);
    }

    function edit_event_content($id = NULL)
    {
        $content = $this->mfrk->get_by_id('event_contents', $id);
        if(empty($content)) show_404();
        $data['content'] = $content;
        $data['page_title'] = "Edit Content For An Event or Category";
        $this->form_validation->set_rules('content', 'Content' , 'required');
        $this->form_validation->set_rules('placement', 'placement' , 'required');
        $this->form_validation->set_rules('type', 'type' , 'required');
        $this->form_validation->set_rules('event_url', 'event url' , 'required');
        if($this->form_validation->run())
        {
            if($_POST['type'] == 'category')
            {
                if(strpos($_POST['event_url'],'category/'))
                {
                   $eventUrl = explode('category/',$_POST['event_url']);
                   $_POST['event_url'] = $eventUrl[1];
                }

                $this->db->where_not_in('id',$id);
                $result  = $this->mfrk->get_where("event_contents",['type' => 'category','placement' => $_POST['placement'],'event_url' => $_POST['event_url']])->result();
            }
            else 
            {
                $this->db->where_not_in('id',$id);
                $this->db->like('event_url', "/" .$this->getUrlId($_POST['event_url']), 'before');
                $result  = $this->mfrk->get_where("event_contents",['type' => 'events'])->result();
            }

            if($result)
            { 
                $data['message_error'] = 'Event or category should be unique';
                return  $this->mfrk->_render_backend('edit_event_content', $data);
            }          
     
            $this->mfrk->update('event_contents', $_POST, array("id" => $content->id));
            $this->session->set_flashdata('message', "Content updated. <a href='" . $_POST['type'] . "/" . $_POST['event_url'] . "'>VIEW</a>");
            redirect('home_components/event_contents', 'refresh');
        }
        
        $this->mfrk->_render_backend('edit_event_content', $data);
    }
    
    function delete_event_content($id = NULL){
        $event_contents = $this->mfrk->get_by_id('event_contents', $id);
        if(!empty($event_contents)){
            $this->mfrk->delete('event_contents', array('id' => $id));
            $this->session->set_flashdata('message', 'Content deleted.');
        }
        redirect('home_components/event_contents', 'refresh');
    }
    
    function activate_event_content($id = NULL){
        $event_contents = $this->mfrk->get_by_id('event_contents', $id);
        if(!empty($event_contents)){
            $this->mfrk->update('event_contents', array("status" => "active"), array("id" => $event_contents->id));
            $this->session->set_flashdata('message', "Content status updated. <a href='" . $event_contents->type . "/" . $event_contents->event_url . "'>VIEW</a>");
        }
        redirect('home_components/event_contents', 'refresh');
    }
    
    function deactivate_event_content($id = NULL){
        $event_contents = $this->mfrk->get_by_id('event_contents', $id);
        if(!empty($event_contents)){
            $this->mfrk->update('event_contents', array("status" => "inactive"), array("id" => $event_contents->id));
            $this->session->set_flashdata('message', "Content status updated. <a href='" . $event_contents->type . "/" . $event_contents->event_url . "'>VIEW</a>");
        }
        redirect('home_components/event_contents', 'refresh');
    }
    
    function event_contents(){
        $data['callback'] = "home_components/get_event_contents";
        $this->mfrk->_render_backend('event_contents', $data);
    }
    
    function get_event_contents(){
        $search = !empty($_REQUEST['search']['value'])? $_REQUEST['search']['value'] : '';
        $offset = !empty($_REQUEST['start'])? $_REQUEST['start'] : 0;
        $limit = !empty($_REQUEST['length'])? $_REQUEST['length'] : 100;
        $draw = !empty($_REQUEST['draw'])? $_REQUEST['draw'] : 0;
        
        $this->load->model('home_components_model'); // Model is needed only in this function so loading model in class construct is a little bit unnecessay
        $event_contents = $this->home_components_model->get_event_contents($search, $offset, $limit);
        $total_event_contents = $this->mfrk->count_results('event_contents');
        $total_filtered = $this->home_components_model->count_event_contents($search);
        
        $data = array();
        foreach($event_contents as $e){
            $details = array();
            $details[] = ucfirst($e->type);
            if($e->type == 'events')
            {
                $eventUrl = explode("/",$e->event_url);
                $eventUrl = implode(" ", array_map("ucfirst", explode("-",$eventUrl[count($eventUrl)-2])));
            }
            else 
                $eventUrl = $e->event_url;
            
            $details[] = $eventUrl;
            $details[] = ucfirst($e->placement);
            $details[] = '<a href="' . $e->type . '/' . $e->event_url . '" target="_blank"> VIEW <i class="fa fa-arrow-circle-right"></i></a>';
            $details[] = '<a class="btn btn-xs label-primary" href="home_components/edit_event_content/' . $e->id . '"> Edit </a>' .
                         '<a class="btn btn-xs label-danger" href="home_components/delete_event_content/' . $e->id . '" onclick="return confirm(\'Are you sure to delete this content?\')"> Delete </a>' .
                         ($e->status == "inactive"? '<a class="btn btn-xs label-info" href="home_components/activate_event_content/' . $e->id . '"> Activate </a>' :
                         '<a class="btn btn-xs label-warning" href="home_components/deactivate_event_content/' . $e->id . '"> Deactivate </a>') . '</div>';
            $data[] = $details;
        }
        $table_data = array("draw" => $draw, "recordsTotal" => $total_event_contents, "recordsFiltered" => $total_filtered, 'data' => $data);
        //pre($table_data);
        echo json_encode($table_data);
    }
    
    function edit_section($id = NULL){
        $section = $this->mfrk->get_by_id('home_midsections', $id);
        if(empty($section)) show_404();
        
        $this->form_validation->set_rules('link', 'link' , 'prep_url');
        $this->form_validation->set_rules('alt_text', 'Alt Text' , 'max_length[200]');
        $this->form_validation->set_rules('serial', 'Serial no' , 'numeric');
        $this->form_validation->set_rules('width', 'Width' , 'max_length[5]');
        if($this->form_validation->run()){
            if(empty($_FILES['image']['error'])){
                $this->load->library('upload');
                $config['upload_path'] = './assets/home/ads/';
                $config['allowed_types'] = 'jpg|png|gif';
                $config['max_size'] = '512';
                $config['file_name'] = time();
                $this->upload->initialize($config);
                if($this->upload->do_upload('image')){
                    if(!empty($section->image)) @unlink("./assets/home/ads/" . $section->image);
                    $file = $this->upload->data();
                    $_POST['image'] = $file['file_name'];
                }else{
                    $data['message_error'] = strip_tags($this->upload->display_errors());
                }
            }
            if(empty($data['message_error'])){
                $this->mfrk->update('home_midsections', $_POST, array("id" => $section->id));
                $this->session->set_flashdata('message', "Section updated.");
                redirect('home_components/midsections', 'refresh');
            }
        }
        $data['section'] = $section;
        $this->mfrk->_render_backend('edit_section', $data);
    }
    
    function midsections(){
        $this->form_validation->set_rules('alt_text', 'Alt Text' , 'max_length[200]');
        $this->form_validation->set_rules('serial', 'Serial no' , 'numeric');
        $this->form_validation->set_rules('width', 'Width' , 'max_length[5]');
        $this->form_validation->set_rules('link', 'link' , 'prep_url');
        if($this->form_validation->run()){
            if(empty($_FILES['image']['error'])){
                $this->load->library('upload');
                $config['upload_path'] = './assets/home/ads/';
                $config['allowed_types'] = 'jpg|png|gif';
                $config['max_size'] = '512';
                $config['file_name'] = time();
                $this->upload->initialize($config);
                if($this->upload->do_upload('image')){
                    $file = $this->upload->data();
                    $_POST['image'] = $file['file_name'];
                }else{
                    $data['message_error'] = strip_tags($this->upload->display_errors());
                }
            }
            if(empty($data['message_error'])){
                $_POST['serial'] = (!empty($_POST['serial'])? $_POST['serial'] : $this->db->select_max('serial')->get('home_midsections')->row()->serial + 1);
                $this->mfrk->insert('home_midsections', $_POST);
                $data['message'] = "A section added.";
            }
        }
        $data['midsections'] = $this->mfrk->get('home_midsections', array("column" => "serial", "order" => "ASC"))->result();
        $this->mfrk->_render_backend('midsections', $data);
    }
    
    function delete_section($id = NULL){
        $section = $this->mfrk->get_by_id('home_midsections', $id);
        if(!empty($section)){
            if(!empty($section->image)) @unlink("./assets/home/ads/" . $section->image);
            $this->mfrk->delete('home_midsections', array('id' => $id));
            $this->session->set_flashdata('message', 'Section deleted.');
        }
        redirect('home_components/midsections', 'refresh');
    }
    
    function edit_slider($id = NULL){
        $slider = $this->mfrk->get_by_id('home_sliders', $id);
        if(empty($slider)) show_404();
        
        $this->form_validation->set_rules('link', 'link' , 'prep_url');
        $this->form_validation->set_rules('serial', 'Serial' , 'integer');
        $this->form_validation->set_rules('heading', 'Heading' , 'max_length[25]');
        $this->form_validation->set_rules('description', 'Description' , 'max_length[200]');
        $this->form_validation->set_rules('link_title', 'Link Title' , 'max_length[15]');
        if($this->form_validation->run()){
            if(empty($_FILES['image']['error'])){
                $this->load->library('upload');
                $config['upload_path'] = './assets/home/sliders/';
                $config['allowed_types'] = 'jpg|png|gif';
                $config['max_size'] = '512';
                $config['file_name'] = time();
                $this->upload->initialize($config);
                if($this->upload->do_upload('image')){
                    @unlink("./assets/home/sliders/" . $slider->image);
                    $file = $this->upload->data();
                    $_POST['image'] = $file['file_name'];
                }else{
                    $data['message_error'] = strip_tags($this->upload->display_errors());
                }
            }
            if(empty($data['message_error'])){
                $this->mfrk->update('home_sliders', $_POST, array('id' => $slider->id));
                $this->session->set_flashdata('message', "Slider updated.");
                redirect("home_components/sliders", "refresh");
            }
        }
        $data['slider'] = $slider;
        $this->mfrk->_render_backend('edit_slider', $data);
    }
    
    function sliders(){
        $this->form_validation->set_rules('link', 'link' , 'prep_url');
        $this->form_validation->set_rules('heading', 'Heading' , 'max_length[25]');
        $this->form_validation->set_rules('description', 'Description' , 'max_length[200]');
        $this->form_validation->set_rules('link_title', 'Link Title' , 'max_length[15]');
        if($this->form_validation->run()){
            if(empty($_FILES['image']['error'])){
                $this->load->library('upload');
                $config['upload_path'] = './assets/home/sliders/';
                $config['allowed_types'] = 'jpg|png|gif';
                $config['max_size'] = '512';
                $config['file_name'] = time();
                $this->upload->initialize($config);
                if($this->upload->do_upload('image')){
                    $file = $this->upload->data();
                    $_POST['image'] = $file['file_name'];
                    $_POST['serial'] = $this->db->select_max('serial')->get('home_sliders')->row()->serial + 1;
            
                    $this->mfrk->insert('home_sliders', $_POST);
                    $data['message'] = "Slider added.";
                }else{
                    $data['message_error'] = strip_tags($this->upload->display_errors());
                }
            }else{
                $data['message_error'] = "No image selected.";
            }
        }
        $data['sliders'] = $this->mfrk->get('home_sliders', array("column" => "serial", "order" => "DESC"))->result();
        $this->mfrk->_render_backend('sliders', $data);
    }
    
    function delete_slider($id = NULL){
        $slider_image = $this->mfrk->get_by_id('home_sliders', $id);
        if(!empty($slider_image)){
            unlink("./assets/home/sliders/" . $slider_image->image);
            $this->mfrk->delete('home_sliders', array('id' => $id));
            $this->session->set_flashdata('message', 'Slider deleted.');
        }
        redirect('home_components/sliders', 'refresh');
    }

    function getUrlId($url)
    {
        $eventUrl = explode("/",$url);
       return  $details[] = $eventUrl[count($eventUrl)-1];
    }
}

?>