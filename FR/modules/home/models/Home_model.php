<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model{
    
    public function __construct(){
	parent::__construct();
    }
    
    function get_data($segment2 = NULL, $segment3 = NULL){
        $paginate['per_page'] = 5;
        $paginate['base_url'] = base_url() . 'blog';
        $paginate['total_rows'] = $this->count_posts($segment2, $segment3);
        if($segment2 == "category"){
            $cat = $this->mfrk->get_where('post_categories', array('url' => $segment3, 'status' => "active"))->row();
            if(!empty($cat)){
                $data['page_title'] = $cat->name;
                $paginate['base_url'] .= "/" . $segment2 . "/" . $segment3;
                $this->db->like('in_categories', '|' . $cat->id . '|');
            }else show_404();
        }elseif($segment2 == "search"){
            $search = !empty($segment3)? $segment3 : $this->input->get('query');
            if(!empty($search)){
                $paginate['base_url'] .= "/" . $segment2 . "/" . $search;
                $data['page_title'] = "Search Results for - " . htmlspecialchars($search);
                $this->db->like('title', $search);
            }else show_404();
        }elseif(!empty($segment2) && $segment2 !== "page"){
            $data['post'] = $this->ion_auth->is_admin()? $this->mfrk->get_by_url('posts', $segment2) : $this->db->get_where('posts', array('status' => "published", 'url' => $segment2))->row();
            if(empty($data['post'])) show_404();
            else{
                if($data['post']->is_standalone){
                    echo $data['post']->content;
                    die();
                }
                $data['page_title'] = $data['post']->title;
                $data['og_type'] = "article";
                $data['og_title'] = $data['post']->og_title;
                $data['og_description'] = $data['post']->og_description;
                $data['og_keywords'] = $data['post']->og_keywords;
                $data['og_image'] = ("assets/posts/images/" . (!empty($data['post']->featured_image)? $data['post']->featured_image : "default.jpg"));
                $data['full_width'] = $data['post']->full_width;
                
                $this->db->like('in_categories', $data['post']->in_categories); // To get related posts of same categories
                $this->db->where('id !=', $data['post']->id);
            }
        }else $data['page_title'] = "Blog";
        
        $this->pagination->initialize($paginate);     
        $data['links'] = $this->pagination->create_links();
        $offset = (int)$this->uri->segment(count($this->uri->segment_array()));
        $data['posts'] = $this->db
                                ->select("title, url, featured_image, author, date, alt_text")
                                ->where("status", "published")
                                ->limit($paginate['per_page'], $offset)
                                ->order_by('date', "DESC")
                                ->get('posts')
                                ->result();        
        return $data;
    }
    
    private function count_posts($segment2 = NULL, $segment3 = NULL){
        if($segment2 == "category"){
            $cat = $this->mfrk->get_where('post_categories', array('url' => $segment3, 'status' => "active"))->row();
            if(!empty($cat)) $this->db->like('in_categories', '|' . $cat->id . '|');
            else return 0;
        }elseif($segment2 == "search"){
            $search = !empty($segment3)? $segment3 : $this->input->get('query');
            if(!empty($search)) $this->db->like('title', $search);
            else return 0;
        }elseif($segment2 == "page" || empty($segment2));
        else return 0;
        $this->db->where(array("status" => "published"));
        return $this->db->count_all_results('posts');
    }
        
}
?>