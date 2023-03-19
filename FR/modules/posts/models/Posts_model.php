<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts_model extends CI_Model{
    
    public function __construct(){
	parent::__construct();
    }
    
    function get_posts($filter = array(), $search = "", $offset = 0, $limit = 100, $order_by = "date", $direction = "DESC"){
        $query = "SELECT * FROM posts ";
        $query .= "WHERE status " . (!empty($filter['status'])? "= '" . $filter['status'] ."' " : "!= 'deleted' ");
        $query .= (!empty($filter['author'])? "AND author = '" . $filter['author'] . "' " : "");
        $query .= ((!empty($filter['category']) || isset($filter['category']))? "AND in_categories LIKE '%|" . $filter['category'] . "|%' " : "");
        
        $search = addslashes(trim($search));
        $query .= (!empty($search)? "AND (title LIKE '%" . $search ."%' OR content LIKE '%" . $search ."%' OR date LIKE '%" . $search ."%' OR author LIKE '%" . $search ."%' OR url LIKE '%" . $search ."%') " : "");
        $query .= "ORDER BY " . $order_by . " " . $direction . " LIMIT " . $offset . ", " . $limit;
        return $this->db->query($query)->result();
    }
    
    function count_posts($filter = array(), $search = ""){
        $query = "SELECT COUNT(*) as numrows FROM posts ";
        $query .= "WHERE status " . (!empty($filter['status'])? "= '" . $filter['status'] ."' " : "!= 'deleted' ");
        $query .= (!empty($filter['author'])? "AND author = '" . $filter['author'] . "' " : "");
        $query .= (!empty($filter['category'])? "AND in_categories LIKE '%|" . $filter['category'] . "|%' " : "");
        $search = addslashes(trim($search));
        $query .= (!empty($search)? "AND (title LIKE '%" . $search ."%' OR content LIKE '%" . $search ."%' OR date LIKE '%" . $search ."%' OR author LIKE '%" . $search ."%' OR url LIKE '%" . $search ."%') " : "");
        
        return (int)$this->db->query($query)->row()->numrows;
    }
}
?>