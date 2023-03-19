<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends FR_Controller {

    function __construct(){
        parent::__construct();
        if(!$this->ion_auth->is_admin()) redirect('dashboard', 'refresh');
    }
    
    function restore($id = NULL){
        $post = $this->mfrk->get_by_id('posts', $id);
        if(empty($post)) show_404();
        $this->mfrk->update("posts", array("status" => "drafted"), array("id" => $post->id));
        $this->session->set_flashdata('message', "Post restored.");
        redirect('posts/all', 'refresh');
    }
    
    function delete($id = NULL){
        $post = $this->mfrk->get_by_id('posts', $id);
        if(empty($post)) show_404();
        $this->mfrk->update("posts", array("status" => "deleted"), array("id" => $post->id));
        $this->session->set_flashdata('message', "Post deleted.");
        redirect('posts/all', 'refresh');
    }
    
    function all(){
        $data['callback'] = "posts/get_posts" . (!empty($_SERVER['QUERY_STRING'])? "?" . $_SERVER['QUERY_STRING'] : "");
        $data['page_title'] = "Posts";
        $data['all'] = $this->mfrk->count_results('posts', array("status !=" => "deleted"));
        $data['published'] = $this->mfrk->count_results('posts', array("status" => "published"));
        $data['drafts'] = $this->mfrk->count_results('posts', array("status" => "drafted"));;
        $data['trash'] = $this->mfrk->count_results('posts', array("status" => "deleted"));;
        
        $this->mfrk->_render_backend('all', $data);
    }
    
    function get_posts(){
        $search = !empty($_REQUEST['search']['value'])? $_REQUEST['search']['value'] : '';
        $offset = !empty($_REQUEST['start'])? $_REQUEST['start'] : 0;
        $limit = !empty($_REQUEST['length'])? $_REQUEST['length'] : 100;
        $draw = !empty($_REQUEST['draw'])? $_REQUEST['draw'] : 0;
        
        $this->load->model('posts_model'); // Model is needed only in this function so loading model in class construct is a little bit unnecessay
        $posts = $this->posts_model->get_posts($_GET, $search, $offset, $limit);
        $total_posts = $this->mfrk->count_results('posts', array('status !=' => "deleted"));
        $total_filtered = $this->posts_model->count_posts($_GET, $search);
        
        $status_query = !empty($_GET['status'])? "status=" . $_GET['status'] . "&" : "";
        $category_query = !empty($_GET['category'])? "category=" . $_GET['category'] . "&" : "";
        $author_query = !empty($_GET['author'])? "author=" . $_GET['author'] . "&" : "";
        $data = array();
        foreach($posts as $p){
            $details = array();
            $details[] = '<a href="blog/' . $p->url . '" target="_blank"><img src="assets/posts/images/' . (!empty($p->featured_image)? $p->featured_image : 'default.jpg') . '" width="40"></a>';
            $details[] = '<a href="blog/' . $p->url . '" target="_blank">' . $p->title . '</a> ' . (($p->status == "drafted")? ' -- <span class="label-xs-td">Draft</span>' : '');
            
            $post_categories = "";
            $category_ids = explode("|", trim($p->in_categories, "|"));
            foreach($category_ids as $c){
                if($c == 0) $cat_name = "Uncategorized";
                else{
                    $cat_details = $this->mfrk->get_by_id("post_categories", $c);
                    if(!empty($cat_details)) $cat_name = $cat_details->name;
                    else continue;
                }
                $post_categories .= '<a href="posts/all?' . $status_query . $author_query . 'category=' . $c . '">' . $cat_name . '</a><br>';
            }
            $details[] = $post_categories;
            $details[] = '<a href="posts/all?' . $status_query . $category_query . 'author=' . $p->author . '">' . $p->author . '</a>';
            $details[] = ($p->status == "drafted"? "<span class='label-xs-underlined'>Last Modified</span>" : '<span class="label-xs-td">' . $p->status . '</span><br>') . '<div class="post-date-td">' . $p->date . '</div>';
            $details[] = '<div class="post-action-td"><a class="btn btn-xs label-primary" href="posts/edit/' . $p->id . '"> Edit </a>' .
                         ($p->status == "deleted"? '<a class="btn btn-xs label-info" href="posts/restore/' . $p->id . '"> Restore </a>' :
                         '<a class="btn btn-xs label-danger" href="posts/delete/' . $p->id . '"> Delete </a>') . '</div>';
            $data[] = $details;
        }
        $table_data = array("draw" => $draw, "recordsTotal" => $total_posts, "recordsFiltered" => $total_filtered, 'data' => $data);
        echo json_encode($table_data);
    }
    
    function add(){
        $this->form_validation->set_rules('title', 'Title' , 'required|max_length[200]');
        $this->form_validation->set_rules('content', 'Content' , 'encode_php_tags');
        $this->form_validation->set_rules('excerpt', 'Excerpt' , 'encode_php_tags');
        $this->form_validation->set_rules('in_categories', 'Category' , 'numeric');
        $this->form_validation->set_rules('author', 'Author' , 'max_length[30]');
        $this->form_validation->set_rules('alt_text', 'Alt Text' , 'max_length[220]');
        $this->form_validation->set_rules('url', 'URL Slug' , 'max_length[220]|is_unique[posts.url]');
        $this->form_validation->set_rules('date', 'Date' , 'required');
        if($this->form_validation->run()){
            $in['title'] = $this->input->post('title');
            $in['content'] = $this->input->post('content');
            $in['excerpt'] = $this->input->post('excerpt');
            $in['in_categories'] = !empty($_POST['in_categories'])? "|" . implode("|", $_POST['in_categories']) . "|" : "|0|";
            if(!empty($_POST['author'])) $in['author'] = $this->input->post('author');
            $in['alt_text'] = !empty($_POST['alt_text'])? htmlspecialchars($_POST['alt_text']) : htmlspecialchars($in['title']);
            $in['url'] = $this->mfrk->make_unique('posts', 'url', (!empty($_POST['url'])? $_POST['url'] : $in['title']));
            $in['date'] = $this->input->post('date');
            $in['og_description'] = $this->input->post('og_description');
            $in['og_title'] = $this->input->post('og_title');
            $in['og_keywords'] = $this->input->post('og_keywords');
            $in['full_width'] = (int)$this->input->post('full_width');
            $in['is_standalone'] = (int)$this->input->post('is_standalone');
            
            if(empty($_FILES['featured_image']['error'])){
                $config['upload_path'] = './assets/posts/images/';
                $config['allowed_types'] = 'jpg|png|gif';
                $config['max_size'] = '300';
                $config['file_name'] = time();
                
                $this->load->library('upload');
                $this->upload->initialize($config);
                if($this->upload->do_upload('featured_image')){
                    $file = $this->upload->data();
                    $in['featured_image'] = $file['file_name'];
                }else{
                    $message_error = "Warning! Featured image upload Failed. " . strip_tags($this->upload->display_errors());
                    $this->session->set_flashdata('message_error', $message_error);
                }
            }
            $in['status'] = !empty($message_error)? "drafted" : $_POST["status"];
            $id = $this->mfrk->insert('posts', $in);
            
            $this->session->set_flashdata('message', "Post " . $in['status'] . ". <a href='blog/" . $in['url'] . "'>View</a>");
            if($in['status'] == "drafted") redirect('posts/edit/' . $id, 'refresh');
            redirect('posts/all', 'refresh');
        }
        $data['page_title'] = "Add New Post";
        $data['categories'] = $this->mfrk->get('post_categories', array('column' => 'parent_id', 'order' => 'asc'))->result();
        $this->mfrk->_render_backend('add', $data);
    }
    
    function edit($id = NULL){
        $post = $this->mfrk->get_by_id('posts', $id);
        if(empty($post)) show_404();
        
        $this->form_validation->set_rules('title', 'Title' , 'required|max_length[200]');
        $this->form_validation->set_rules('content', 'Content' , 'encode_php_tags');
        $this->form_validation->set_rules('excerpt', 'Excerpt' , 'encode_php_tags');
        $this->form_validation->set_rules('in_categories', 'Category' , 'numeric');
        $this->form_validation->set_rules('author', 'Author' , 'max_length[30]');
        $this->form_validation->set_rules('alt_text', 'Alt Text' , 'max_length[220]');
        $this->form_validation->set_rules('url', 'URL Slug' , 'max_length[220]');
        $this->form_validation->set_rules('date', 'Date' , 'required');
        if($this->form_validation->run()){
            $in['title'] = $this->input->post('title');
            $in['content'] = $this->input->post('content');
            $in['excerpt'] = $this->input->post('excerpt');
            $in['in_categories'] = !empty($_POST['in_categories'])? "|" . implode("|", $_POST['in_categories']) . "|" : "|0|";
            if(!empty($_POST['author'])) $in['author'] = $this->input->post('author');
            $in['alt_text'] = !empty($_POST['alt_text'])? htmlspecialchars($_POST['alt_text']) : htmlspecialchars($in['title']);
            $in['url'] = ($post->url !== $_POST['url'])? $this->mfrk->make_unique('posts', 'url', (!empty($_POST['url'])? $_POST['url'] : $in['title'])) : $post->url;
            $in['date'] = $this->input->post('date');
            $in['og_description'] = $this->input->post('og_description');
            $in['og_title'] = $this->input->post('og_title');
            $in['og_keywords'] = $this->input->post('og_keywords');
            $in['full_width'] = $this->input->post('full_width');
            $in['is_standalone'] = $this->input->post('is_standalone');
            
            if(empty($_FILES['featured_image']['error'])){
                $config['upload_path'] = './assets/posts/images/';
                $config['allowed_types'] = 'jpg|png|gif';
                $config['max_size'] = '300';
                $config['file_name'] = time();
                
                $this->load->library('upload');
                $this->upload->initialize($config);
                if($this->upload->do_upload('featured_image')){
                    if(!empty($post->featured_image)) @unlink("./assets/posts/images/" . $post->featured_image);
                    $file = $this->upload->data();
                    $in['featured_image'] = $file['file_name'];
                }else {
                    $message_error = "Warning! Featured image upload Failed. " . strip_tags($this->upload->display_errors());
                    $this->session->set_flashdata('message_error', $message_error);
                }
            }
            $in['status'] = !empty($message_error)? "drafted" : $_POST['status'];
            $this->mfrk->update('posts', $in, array('id' => $post->id));
            
            $this->session->set_flashdata('message', "Post " . $in['status'] . ". <a href='blog/" . $in['url'] . "'>View</a>");
            if($in['status'] == "drafted") redirect('posts/edit/' . $id, 'refresh');
            redirect('posts/all', 'refresh');
        }
        $data['in_categories'] = explode("|", trim($post->in_categories, "|"));
        $data['post'] = $post;
        $data['page_title'] = "Edit Post";
        $data['categories'] = $this->mfrk->get('post_categories', array('column' => 'parent_id', 'order' => 'asc'))->result();
        $this->mfrk->_render_backend('edit', $data);
    }
    
    function activate_category($id = NULL){
        $category = $this->mfrk->get_by_id('post_categories', $id);
        if(empty($category)) show_404();
        $this->mfrk->update("post_categories", array("status" => "active"), array("id" => $category->id));
        $this->session->set_flashdata('message', $category->name . " category activated.");
        redirect('posts/categories', 'refresh');
    }
    
    function deactivate_category($id = NULL){
        $category = $this->mfrk->get_by_id('post_categories', $id);
        if(empty($category)) show_404();
        $this->mfrk->update("post_categories", array("status" => "inactive"), array("id" => $category->id));
        $this->session->set_flashdata('message', $category->name . " category deactivated.");
        redirect('posts/categories', 'refresh');
    }
    
    function categories(){
        $this->form_validation->set_rules('name', 'Name' , 'required|max_length[30]');
        $this->form_validation->set_rules('parent_id', 'Parent category' , 'numeric');
        $this->form_validation->set_rules('description', 'Description' , 'max_length[100]');
        $this->form_validation->set_rules('url', 'URL Slug' , 'max_length[30]|is_unique[post_categories.url]');
        if($this->form_validation->run()){
            $in['name'] = $this->input->post('name');
            $in['parent_id'] = (int)$this->input->post('parent_id');
            $in['description'] = $this->input->post('description');
            $in['url'] = $this->mfrk->make_unique('post_categories', 'url', (!empty($_POST['url'])? $_POST['url'] : $in['name']));
            
            $this->mfrk->insert('post_categories', $in);
            $this->session->set_flashdata('message', $in['name'] . " category added.");
            redirect('posts/categories', 'refresh');
        }
        $data['categories'] = $this->mfrk->get('post_categories', array('column' => 'parent_id', 'order' => 'asc'))->result();
        $this->mfrk->_render_backend('categories', $data);
    }
    
    function edit_categories($id = NULL){
        $category = $this->mfrk->get_by_id('post_categories', $id);
        if(empty($category)) show_404();
        
        $this->form_validation->set_rules('name', 'Name' , 'required|max_length[30]');
        $this->form_validation->set_rules('parent_id', 'Parent category' , 'numeric');
        $this->form_validation->set_rules('description', 'Description' , 'max_length[100]');
        $this->form_validation->set_rules('url', 'URL Slug' , 'max_length[30]');
        if($this->form_validation->run()){
            $in['name'] = $this->input->post('name');
            $in['parent_id'] = (int)$this->input->post('parent_id');
            $in['description'] = $this->input->post('description');
            if($category->url !== $_POST['url']) $in['url'] = $this->mfrk->make_unique('post_categories', 'url', (!empty($_POST['url'])? $_POST['url'] : $in['name']));
            
            $this->mfrk->update('post_categories', $in, array('id' => $id));
            $this->session->set_flashdata('message', $in['name'] . " category updated.");
            redirect('posts/categories', 'refresh');
        }
        
        $data['category'] = $category;
        $data['page_title'] = 'Edit Post Category';
        $data['categories'] = $this->mfrk->get('post_categories', array('column' => 'parent_id', 'order' => 'asc'))->result();
        $this->mfrk->_render_backend('edit_categories', $data);
    }
    
}

?>