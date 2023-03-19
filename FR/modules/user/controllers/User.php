<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends FR_Controller {

    function __construct(){
        parent::__construct();
        $this->load->helper(array('language'));
        $this->lang->load('auth');
    }
            
    function index(){
        if(!$this->ion_auth->logged_in()) redirect('login', 'refresh');
        redirect('dashboard', 'refresh');
    }
    
    function login(){
        if($this->ion_auth->logged_in()) redirect('dashboard', 'refresh');
        $this->form_validation->set_rules('identity', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if($this->form_validation->run()){
            $remember = TRUE;
            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)){
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect('dashboard', 'refresh');
            }else{
                $data['message_error'] = $this->ion_auth->errors();
            }
        }
        $data['site'] = $this->mfrk->get('settings')->row();
        $data['page_title'] = "Login";
        $this->load->view('login', $data);
    }
            
    function logout(){
        $this->ion_auth->logout();
        redirect('login', 'refresh');
    }
    
    //simple function send a new temp pass to user
    public function forgot_pass(){
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        if($this->form_validation->run() == true){
            $email = $this->input->post('email');
            $user = $this->db->get_where('users', array('email' => $email))->row();
            if(!empty($user)){
                $password = rand(10000000, 99999999);
                $data['password'] = $this->ion_auth->hash_password($password);
                $this->db->update('users', $data, array('id' => $user->id));
                
                $site = $this->mfrk->get('settings')->row();
                mail($email, '[' . $site->app_title . '] Password has been reset.', "\nDear Concern,\n\n\nThe password for your account has been changed to --\n\n" . $password . "\n\nPlease Login here " . base_url() . "login\nYou can change this password at 'Menu > Me > Profile' after logging in.\n\n\nThank you for being with us\nSupport Team", 'Reply-To: ' . $site->reply_email);
                echo "Password has been sent to your email. Go back to login";
            }else{
                echo "Email doesn't exist";
            }
        }else{
            echo strip_tags(validation_errors());
        }
    }

    //manual function lets the user change their own password through a link
    function forgot_password(){
        if($this->ion_auth->logged_in()) redirect('dashboard', 'refresh');
        $this->form_validation->set_rules('email', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');

        $data['page_title'] = "Forgot Password";
        $data['site'] = $this->mfrk->get('settings')->row();
        if($this->form_validation->run() == true){
            $identity = $this->ion_auth->where('email', strtolower($this->input->post('email')))->users()->row();
            if(!empty($identity)){
                $forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});
                if($forgotten){
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    redirect("user/login", 'refresh');
                }
            }else{
                $this->ion_auth->set_error('forgot_password_email_not_found');
            }
        }
        $data['message_error'] = (validation_errors()) ? validation_errors() : $this->ion_auth->errors();
        $this->load->view('forgot_password', $data);
    }

    function edit($username){
        $is_admin = $this->ion_auth->is_admin();
        if (!$is_admin && !($this->session->userdata('username') == $username)) redirect('dashboard', 'refresh');
        $user = $this->mfrk->get_where('users', array('username' => $username))->row();
        
        $this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required');
        if($is_admin && $this->session->userdata('username') != $username){
            $this->form_validation->set_rules('group', 'Group', 'required|numeric');
            $password = $this->input->post('password');
            if($password){
                $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
            }
        }
        if($this->form_validation->run()){
            $data['first_name'] = $this->input->post('first_name');
            $data['last_name'] = $this->input->post('last_name');
            $data['designation'] = $this->input->post('designation');
            $data['phone'] = $this->input->post('phone');            
            if($is_admin && $this->session->userdata('username') != $username){
                if($password) $data['password'] = $this->ion_auth->hash_password($password, $user->salt);
                $group = $this->input->post('group');
                $this->ion_auth->remove_from_group('', $user->id);
                $this->ion_auth->add_to_group($group, $user->id);
            }
            if($this->mfrk->update('users', $data, array('id' => $user->id))){
                $data['message'] = "Update successful";
                if(!empty($_GET['re'])) redirect($_GET['re'], 'refresh');
            }
            else $data['message_error'] = "Update unsuccessful. Try again.";
        }
        $groups = $this->ion_auth->groups()->result();
        foreach($groups as $y) $data['groups'][$y->id] = $y->name;
        $data['user_data'] = $user;
        $data['is_admin'] = $is_admin;
        $data['page_title'] = ($this->session->userdata('username') == $username)? "My Profile" : "Edit User";
        $this->mfrk->_render_backend('edit', $data);
    }
    
    function create(){
        if (!$this->ion_auth->is_admin()) redirect('dashboard', 'refresh');

        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
        $this->form_validation->set_rules('designation', 'Designation', 'max_length[50]');
        $this->form_validation->set_rules('phone', 'Phone', 'max_length[20]');
        $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[users.email]', array('is_unique' => 'This %s already exists.'));
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');
        $this->form_validation->set_rules('group', 'Group', 'numeric|required');

        if($this->form_validation->run()){
            $data['password'] = $this->ion_auth->hash_password($this->input->post('password'));
            $data['email'] = strtolower($this->input->post('email'));
            $data['created_on'] = time();
            $data['last_login'] = 0;
            $data['active'] = 1;
            $data['first_name'] = $this->input->post('first_name');
            $data['last_name'] = $this->input->post('last_name');
            $data['designation'] = $this->input->post('designation');
            $data['phone'] = $this->input->post('phone');
            $data['username'] = $this->mfrk->set_username($data['first_name'] . '-' . $data['last_name']);
            $data['ip_address'] = $this->input->ip_address();

            $id = $this->mfrk->insert('users', $data);
            $group = $this->input->post('group');
            $this->ion_auth->add_to_group($group, $id);
            $this->session->set_flashdata('message', 'User creation successful. User can login to system using provided credentials.');

            if($group == 1) redirect('user/admin_users', 'refresh');
            else redirect('user/customers', 'refresh');
        }
        $groups = $this->ion_auth->groups()->result();
        foreach($groups as $y) $data['groups'][$y->id] = $y->name;
        $data['page_title'] = 'Create User';
        $this->mfrk->_render_backend('create', $data);
    }

    function customers(){
        if(!$this->ion_auth->is_admin()) redirect('dashboard', 'refresh');
        $this->form_validation->set_rules('keyword', 'Search Keyword' , 'required');
        if($this->form_validation->run()){
            $keyword = $this->input->post('keyword');
            $this->ion_auth->like(array('last_name' => $keyword, 'first_name' => $keyword, 'phone' => $keyword, 'email' => $keyword, 'username' => $keyword));
        }
        
        $paginate['base_url'] = base_url() . 'user/customers/';
        $paginate['total_rows'] = $this->ion_auth->count_users(2);
        $paginate['per_page'] = 30;
        $paginate['uri_segment'] = 3;
        $this->pagination->initialize($paginate);     
        $page = ($this->uri->segment(3))? (int)$this->uri->segment(3) : 0;

        $data['links'] = $this->pagination->create_links();
        $data['users'] = $this->ion_auth->limit($paginate['per_page'])->offset($page)->users(2)->result();
        $data['noofusers'] = $paginate['total_rows'];
        $this->mfrk->_render_backend('customers', $data);
    }
    
    function activate($username, $code=false){
        $user = $this->mfrk->get_where('users',array('username' => $username))->row();
        if ($code !== false){
            $activation = $this->ion_auth->activate($user->id, $code);
        }elseif($this->ion_auth->is_admin()){
            $activation = $this->ion_auth->activate($user->id);
        }
        $this->session->set_flashdata('message', $this->ion_auth->messages());
        $this->session->set_flashdata('message_error', $this->ion_auth->errors());
        redirect((!empty($_GET['re'])? $_GET['re'] : ""), 'refresh');    
    }

    function deactivate($username = NULL){
        if(!$this->ion_auth->is_admin() || $username == 'administrator'){
            return show_error('You must be an administrator to complete this action.');
        }
        $user = $this->mfrk->get_where('users',array('username' => $username))->row();
        if(!empty($user)){
            $this->ion_auth->deactivate($user->id);
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            $this->session->set_flashdata('message_error', $this->ion_auth->errors());
        }
        redirect((!empty($_GET['re'])? $_GET['re'] : ""), 'refresh');
    }
    
    function admin_users(){
        if(!$this->ion_auth->is_admin()) redirect('dashboard', 'refresh');
        $data['users'] = $this->ion_auth->users(1)->result();
        $this->mfrk->_render_backend('admin_users', $data);
    }

    //change password
    function change_password(){
        $data['page_title'] = 'Change Password';
        $this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
        $this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
        $this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');
        if (!$this->ion_auth->logged_in()) redirect('user/login', 'refresh');

        if ($this->form_validation->run() == false){
            $data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
            $data['old_password'] = array(
                    'name'      => 'old',
                    'class'     => 'form-control',
                    'type'      => 'password',
            );
            $data['new_password'] = array(
                    'name'      => 'new',
                    'class'     => 'form-control',
                    'type'      => 'password',
                    'pattern'   => '^.{'.$data['min_password_length'].'}.*$',
            );
            $data['new_password_confirm'] = array(
                    'name'      => 'new_confirm',
                    'class'     => 'form-control',
                    'type'      => 'password',
                    'pattern'   => '^.{'.$data['min_password_length'].'}.*$',
            );
            //render
            $this->mfrk->_render_backend('change_password', $data);
        }else{
            $identity = $this->session->userdata('identity');
            $change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));
            if ($change) $this->session->set_flashdata('message', $this->ion_auth->messages());
            else $this->session->set_flashdata('message_error', $this->ion_auth->errors());
            redirect('user/change_password', 'refresh');
        }
    }
    
    //reset password - final step for forgotten password
    public function reset_password($code = NULL){
            if (!$code)
            {
                    show_404();
            }

            $user = $this->ion_auth->forgotten_password_check($code);

            if ($user)
            {
                    //if the code is valid then display the password reset form

                    $this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
                    $this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

                    if ($this->form_validation->run() == false)
                    {
                            //display the form

                            //set the flash data error message if there is one
                            $data['message'] = $this->session->flashdata('message');
                            $data['message_error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message_error');

                            $data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
                            $data['new_password'] = array(
                                    'name'      => 'new',
                                    'class'     => 'form-control',
                                    'type'      => 'password',
                                    'pattern'   => '^.{'.$data['min_password_length'].'}.*$',
                            );
                            $data['new_password_confirm'] = array(
                                    'name'      => 'new_confirm',
                                    'class'     => 'form-control',
                                    'type'      => 'password',
                                    'pattern'   => '^.{'.$data['min_password_length'].'}.*$',
                            );
                            $data['csrf'] = $this->_get_csrf_nonce();
                            $data['code'] = $code;

                            //render
                            $this->mfrk->_render_backend('reset_password', $data);
                    }
                    else
                    {
                            // do we have a valid request?
                            if ($this->_valid_csrf_nonce() === FALSE)
                            {

                                //something fishy might be up
                                $this->ion_auth->clear_forgotten_password_code($code);

                                show_error($this->lang->line('error_csrf'));

                            }
                            else
                            {
                                // finally change the password
                                $identity = $user->{$this->config->item('identity', 'ion_auth')};

                                $change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

                                if ($change)
                                {
                                        //if the password was successfully changed
                                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                                        redirect("user/login", 'refresh');
                                }
                                else
                                {
                                        $this->session->set_flashdata('message_error', $this->ion_auth->errors());
                                        redirect('user/reset_password/' . $code, 'refresh');
                                }
                            }
                    }
            }
            else
            {
                    //if the code is invalid then send them back to the forgot password page
                    $this->session->set_flashdata('message_error', $this->ion_auth->errors());
                    redirect("user/forgot_password", 'refresh');
            }
    }
 
    // create a new group
    function create_group(){
            $data['page_title'] = 'Create Group';

            if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
            {
                    redirect('user', 'refresh');
            }

            //validate form input
            $this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash');

            if ($this->form_validation->run() == TRUE)
            {
                    $new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
                    if($new_group_id)
                    {
                            // check to see if we are creating the group
                            // redirect them back to the admin page
                            $this->session->set_flashdata('message', $this->ion_auth->messages());
                            redirect("user", 'refresh');
                    }
            }
            else
            {
                    //display the create group form
                    //set the flash data error message if there is one
                    $data['message'] = $this->session->flashdata('message');
                    $data['message_error'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message_error')));


                    $data['group_name'] = array(
                            'name'  => 'group_name',
                            'class'    => 'form-control',
                            'type'  => 'text',
                            'value' => $this->form_validation->set_value('group_name'),
                    );
                    $data['description'] = array(
                            'name'  => 'description',
                            'class'    => 'form-control',
                            'type'  => 'text',
                            'value' => $this->form_validation->set_value('description'),
                    );

                    $this->mfrk->_render_backend('create_group', $data);
            }
    }

    //edit a group
    function edit_group($id){
        $data['page_title'] = 'Edit Group';
        // bail if no group id given
        if(!$id || empty($id))
        {
                redirect('user', 'refresh');
        }

        $data['title'] = $this->lang->line('edit_group_title');

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
                redirect('user', 'refresh');
        }

        $group = $this->ion_auth->group($id)->row();

        //validate form input
        $this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');

        if (isset($_POST) && !empty($_POST))
        {
                if ($this->form_validation->run() === TRUE)
                {
                        $group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

                        if($group_update)
                        {
                                $this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
                        }
                        else
                        {
                                $this->session->set_flashdata('message_error', $this->ion_auth->errors());
                        }
                        redirect("user/all", 'refresh');
                }
        }

        //set the flash data error message if there is one
        $data['message_error'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message_error')));
        $data['message'] = $this->session->flashdata('message');

        //pass the user to the view
        $data['group'] = $group;

        $readonly = $this->config->item('admin_group', 'ion_auth') === $group->name ? 'readonly' : '';

        $data['group_name'] = array(
                'name'  => 'group_name',
                'class'    => 'form-control',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('group_name', $group->name),
                $readonly => $readonly,
        );
        $data['group_description'] = array(
                'name'  => 'group_description',
                'class'    => 'form-control',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('group_description', $group->description),
        );

        $this->mfrk->_render_backend('edit_group', $data);
    }

    //change profile image or avatar
    public function change_avatar(){
        if (!$this->ion_auth->logged_in()) redirect('user/login', 'refresh');
        $this->form_validation->set_rules('submit', 'Submit', 'required');
        if($this->form_validation->run() == true){  

            $config['upload_path']      = './assets/avatars/';
            $config['allowed_types']    = 'gif|jpg|png';
            $config['max_size']         = '512';
            $config['overwrite']        = FALSE;
            $config['encrypt_name']     = TRUE;
            $this->load->library('upload', $config);
            
            if ($this->upload->do_upload()){
                $user = $this->ion_auth->user()->row();
                $path_to_file = 'assets/avatars/'.$user->avatar;

                $upload_data = $this->upload->data();
                $values['avatar'] = $upload_data['file_name'];
                $where['id'] = $user->id;
                $this->mfrk->update('users',$values,$where);

                if(!empty($user->avatar) && file_exists($path_to_file))unlink($path_to_file);
                $data['message'] =  'Your file was successfully uploaded!';
            }else{
                $data['message_error'] = $this->upload->display_errors();
            }
        }
        $data['page_title'] = 'Change Avatar';
        $this->mfrk->_render_backend('change_avatar', $data);
    }
    
    
    
    
    
    
    function _get_csrf_nonce(){
        $this->load->helper('string');
        $key   = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    function _valid_csrf_nonce(){
        if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
                $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
            return TRUE;
        else return FALSE;
    }

}
