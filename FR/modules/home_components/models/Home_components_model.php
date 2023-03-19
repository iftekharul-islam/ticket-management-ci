<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_components_model extends CI_Model{
    
    public function __construct(){
	parent::__construct();
    }
    
    function get_event_contents($search = "", $offset = 0, $limit = 100, $order_by = "id", $direction = "DESC"){
        $query = "SELECT * FROM event_contents ";
        $search = addslashes(trim($search));
        $query .= (!empty($search)? "WHERE (placement LIKE '%" . $search ."%' OR type LIKE '%" . $search ."%' OR event_url LIKE '%" . $search ."%') " : "");
        $query .= "ORDER BY " . $order_by . " " . $direction . " LIMIT " . $offset . ", " . $limit;
        return $this->db->query($query)->result();
    }
    
    function count_event_contents($search = ""){
        $query = "SELECT COUNT(*) as numrows FROM event_contents ";
        $search = addslashes(trim($search));
        $query .= (!empty($search)? "WHERE (placement LIKE '%" . $search ."%' OR type LIKE '%" . $search ."%' OR event_url LIKE '%" . $search ."%') " : "");
        
        return (int)$this->db->query($query)->row()->numrows;
    }
}
?>