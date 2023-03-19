<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Sitemap extends CI_Controller {


    /**
     * Index Page for this controller.
     *
     */
    public function index()
    {
        header("Content-Type: text/xml;charset=iso-8859-1");
        $query = $this->db->get("url_address");
        $data['links'] = $query->result();


        $this->load->view('sitemap', $data);
    }
}