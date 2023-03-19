<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* Class Name:  Mfrk
* Version: 2.0.2
* Author: M Fazle Rabby Khan
* Requirements: PHP5 or above
*/

class Mfrk extends CI_Model{
    
    public function __construct(){
        date_default_timezone_set('Asia/Dacca');
    }

    /*
     * get($table, $orderBy = NULL, $limit = NULL) // args -> table name, orderby (array 'column', 'order'), limit (array/int). return -> stdclass object
     * stdclass object // usage -> $value->result(); results the objects in table; $value->result_array(); results an object array
     */
    public function get($table, $orderBy = NULL, $limit = NULL){
        if(!empty($orderBy))$this->db->order_by($orderBy['column'], $orderBy['order']);
        if(!empty($limit)){
            if(is_array($limit)){
                $this->db->limit($limit['0'],$limit['1']);
            }else{
                $this->db->limit($limit);
            }
        }
        return $result = $this->db->get($table);
    }

    /*
     * get_where($table, $where, $orderBy = NULL, $limit = NULL) // args -> table name, where (array associative), orderby (array 'column', 'order'), limit (array/int). return -> stdclass object
     * stdclass object // usage -> $value->row(); returns single row; $value->result(); results the objects in table; $value->result_array(); results an object array
     */
    public function get_where($table, $where, $orderBy = NULL, $limit = NULL){
        if(!empty($orderBy))$this->db->order_by($orderBy['column'], $orderBy['order']);
        if(!empty($limit)){
            if(is_array($limit)){
                $this->db->limit($limit['0'],$limit['1']);
            }else{
                $this->db->limit($limit);
            }
        }
        return $result = $this->db->get_where($table, $where);
    }

    /*
     * get_or_where($table, $or_where, $orderBy = NULL, $limit = NULL) // args -> table name, or_where (array associative), orderby (array 'column', 'order'), limit (array/int). return -> stdclass object
     * stdclass object // usage -> $value->row(); returns single row; $value->result(); results the objects in table; $value->result_array(); results an object array
     */
    public function get_or_where($table, $or_where, $orderBy = NULL, $limit = NULL){
        if(!empty($orderBy))$this->db->order_by($orderBy['column'], $orderBy['order']);
        if(!empty($limit)){
            if(is_array($limit)){
                $this->db->limit($limit['0'],$limit['1']);
            }else{
                $this->db->limit($limit);
            }
        }
        $this->db->or_where($or_where);
        return $result = $this->db->get($table);
    }

    /*
     * get_by_id($table, $id) // args -> table name, id (int). return -> single row from table;
     * single row stdclass objects as column // $x = $this->mfrk->get_by_id('m', 5); $y = $x->id; $y == 5;
     */
    public function get_by_id($table, $id){
        return $query = $this->db->get_where($table, array('id' => $id))->row();            
    }

    /*
     * get_by_url($table, $url_slug) // args -> table name, url_slug (int). return -> single row from table;
     * single row stdclass objects as column // $x = $this->mfrk->get_by_url('table', 'url-friendly-string'); $y = $x->url; $y == 'url-friendly-string';
     */
    public function get_by_url($table, $url_slug){
        return $query = $this->db->get_where($table, array('url' => $url_slug))->row();            
    }

    /*
     * insert($table, $values)
     * same as codeigniter
     */
    public function insert($table, $values){
        $this->db->insert($table, $values);
        return $id = $this->db->insert_id();
    }

    /*
     * update($table, $values, $where)
     * same as codeigniter
     */
    public function update($table, $values, $where){
        return $result = $this->db->update($table, $values, $where);
    }

    /*
     * select($values)
     * same as codeigniter
     */
    public function select($values){
        $this->db->select($values);
        return $this;
    }
    
    /*
     * delete($table, $where)
     * same as codeigniter
     */
    public function delete($table, $where){
        return $result = $this->db->delete($table, $where);
    }

    private function add_comma($input){
        if(strlen($input)<=2)
        { return $input; }
        $length=substr($input,0,strlen($input)-2);
        $formatted_input = $this->add_comma($length).",".substr($input,-2);
        return $formatted_input;
    }

    /*
     * money_BDT($num) // arg -> amount (int). return -> string
     * comma seperated money amount // usage example -> '100,00,00,000.00'
     */
    public function money_BDT($num){
        $pos = strpos((string)$num, ".");
        if ($pos === false) { $decimalpart="00";}
        else { $decimalpart= substr($num, $pos+1, 2); $num = substr($num,0,$pos); }

        if(strlen($num)>3 & strlen($num) <= 12){
                    $last3digits = substr($num, -3 );
                    $numexceptlastdigits = substr($num, 0, -3 );
                    $formatted = $this->add_comma($numexceptlastdigits);
                    $stringtoreturn = $formatted.",".$last3digits ;
        }elseif(strlen($num)<=3){
                    $stringtoreturn = $num ;
        }elseif(strlen($num)>12){
                    $stringtoreturn = number_format($num, 2);
        }

        if(substr($stringtoreturn,0,2)=="-,"){$stringtoreturn = "-".substr($stringtoreturn,2 );}
        return $stringtoreturn;
    }

    /*
     * time_difference($date)  // arg -> time (int value). return -> array (associative) 
     * array('days' => x, 'minutes' => y, 'hours' => z, 'time_condition' => 'ago/later')  // usage example -> "deal ends/ended" . $diff['days'] . " days " . $diff['minutes'] . " minutes " . $diff['time_condition']... deal ends in 0 days 10 minutes later
     * 
     */ 
    public function time_difference($date){
        $difference = $date - time();
        $value['time_condition'] = ($difference >= 0)? 'later' : 'ago';
        
        $difference = abs($difference);
        $value['days'] = floor($difference / 86400);
        $value['hours'] = floor(($difference % 86400) / 3600);
        $value['minutes'] = floor(($difference % 3600) / 60);
        
        return $value;
    }

    /*
     * _render_backend($view, $data=null, $render=false) // args -> view file name, values to pass in view file (array associative), render (return string or print). return string or void
     * returns string if $render is true else outputs the html. // for any ajax call or something $login = $this->mfrk->_render_backend('login_view', $data, TRUE); otherwise just like $this->load->view();
     */
    public function _render_backend($view, $data = null){
        if(empty($data['site'])) $data['site'] = $this->mfrk->get('settings')->row();
        $data['controller'] = $this->uri->segment(1, 'dashboard');
        $data['method'] = $this->uri->segment(2);
        $data['user'] = $this->ion_auth->user()->row();
        if(!empty($data['user']->vendor_id)) $data['user']->vendor = $this->mfrk->get_where('vendors', array('id' => $data['user']->vendor_id))->row();
        $data['message'] = (!empty($data['message'])? $data['message'] . '<br>' . $this->session->flashdata('message') : $this->session->flashdata('message'));
        $data['message_error'] = (!empty($data['message_error'])? $data['message_error'] : '') . ((validation_errors()) ? validation_errors() : $this->session->flashdata('message_error'));
        if(empty($data['page_title'])) $data['page_title'] = implode(' ', explode('_', $data['method']));

        $this->load->view('backend/header', $data);
        $this->load->view($view);
        $this->load->view('backend/footer');
    }

    /*
     * _render_frontend($view, $data=null, $render=false) // args -> view file name, values to pass in view file (array associative), render (return string or print). return string or void
     * returns string if $render is true else outputs the html. // for any ajax call or something $login = $this->mfrk->_render_frontend('login_view', $data, TRUE); otherwise just like $this->load->view();
     */
    public function _render_frontend($view, $data = null, $render = true){
        if(empty($data['site'])) $data['site'] = $this->mfrk->get('settings')->row();
        $data['controller'] = $this->uri->segment(1, 'home');
        $data['method'] = $this->uri->segment(2);
        $data['redirect_url'] = $_SERVER['REQUEST_URI'];
        $data['user'] = $this->ion_auth->user()->row();
        $data['message'] = (!empty($data['message'])? $data['message'] . '<br>' . $this->session->flashdata('message') : $this->session->flashdata('message'));
        $data['message_error'] = (!empty($data['message_error'])? $data['message_error'] . '<br>' : '') . ((validation_errors()) ? validation_errors() : $this->session->flashdata('message_error'));
        if(empty($data['page_title'])) $data['page_title'] = (!empty($data['method'])? ucfirst(implode(' ', explode('_', $data['method']))) : ucfirst($data['controller']));

        $this->load->view('frontend/header', $data);
        $this->load->view($view);
        $this->load->view('frontend/footer');
    }
    
    /*
     * url_friendly_string($string, $force_lowercase = true, $anal = false) // args -> string to slugify,
     * // usage -> username or product name can be slugified (made url friendly) 
     */
    public function url_friendly_string($string){
        $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
                       "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
                       "â€”", "â€“", ",", "<", ".", ">", "/", "?", "’");
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace("/\s+/", "-", $clean);
        return (function_exists('mb_strtolower'))? mb_strtolower($clean, 'UTF-8') : strtolower($clean);
    }
    
    /*
     * has_any($table, $where, $value) // args -> table name, column name or where array('col1' => 'val1', 'col2' => 'val2');, value to check (all string). return -> boolean
     * checks whether a username or any other value exists in db or not
     */
    public function has_any($table, $where, $value = NULL){
        if(!is_array($where)) $where = array($where => $value);
        return $this->db->where($where)->count_all_results($table) > 0;
    }
    
    /*
     * set_username($name) // args -> name (string). return -> string
     * unique username
     */
    public function set_username($name){
        $username = $this->url_friendly_string($name);
        $unik = $username;
        $i = 1;
        while($this->has_any('users', 'username', $unik)){
            $unik = $username . '-' . $i;
            $i++;
        }
        return $unik;
    }
    
    /*
     * make_unique($name) // args -> name (string). return -> string
     * unique username
     */
    public function make_unique($table, $column, $value){
        $unique = $this->url_friendly_string($value);
        $unik = $unique;
        $i = 1;
        while($this->has_any($table, $column, $unik)){
            $unik = $unique . '-' . $i;
            $i++;
        }
        return $unik;
    }

    /*
     * count_results($table, $where, $or_where, $like, $or_like) // args -> table name, where array (array (column_name => value, column_name2 => value2)), or_where array (same type as where array), like array (same type as where array), or_like array (same type as where array). // return integer.
     * counts the records in table with where, or where, like & or like
     */
    public function count_results($table, $where = array(), $or_where = array(), $like = array(), $or_like = array()){
        if(!empty($where)) $this->db->where($where);
        if(!empty($or_where)) $this->db->or_where($or_where);
        if(!empty($like)) $this->db->like($like);
        if(!empty($or_like)) $this->db->or_like($or_like);
        return $this->db->count_all_results($table);
    }

    /*
     * count_orders($status) // args -> status of the order (string), return integer
     * counts the number of "new" or "shipped" orders from orders & order_details table to show at sidebar or for pagination purpose
     */
    public function count_orders($status = 'new'){
        if($this->ion_auth->is_admin()){
            return $this->db->where('status', $status)->count_all_results('orders');
        }
        $vendor_id = $this->ion_auth->user()->row()->vendor_id;
        return $this->db->query("SELECT COUNT(DISTINCT order_id) AS numrows FROM order_details WHERE vendor_id = '" . $vendor_id . "' AND status = '" . $status . "'")
                        ->row()
                        ->numrows;
    }
    
    












    /*
     * file upload or download
     * 
     * for csv & excel also
     * 
     * Not Fully Functional
     * Edit Must be Needed
     * 
     * index() read Excel Files
     * For xlsx file use Excel2007
     * For xls  file use Excel5
     */
    
    public function upload_file($file, $path, $max_size = '5120', $allowed_types = '*', $overwrite = FALSE, $encrypt_name = TRUE){
        $config['upload_path']          = $path;            // ex: './uploads/groupUser/';
        $config['allowed_types']        = $allowed_types;   // default: ALL
        $config['max_size']             = $max_size;        // default: 5MB
        $config['overwrite']            = $overwrite;       // default: NO  
        $config['encrypt_name']         = $encrypt_name;    // default: YES
        $this->load->library('upload', $config);
        $return_msg = FALSE;
        if(!empty($_FILES[$file]['name'])){
            $files = $_FILES[$file];
            foreach($files['name'] as $key => $image){
                $_FILES['images']['name']= time().$files['name'][$key];
                $_FILES['images']['type']= $files['type'][$key];
                $_FILES['images']['tmp_name']= $files['tmp_name'][$key];
                $_FILES['images']['error']= $files['error'][$key];
                $_FILES['images']['size']= $files['size'][$key];
                if ( ! $this->upload->do_upload('images')){
                    $return_msg[] = array(
                        'msg'   => 'failed',
                        'value' => $this->upload->display_errors()
                    );
                }else{
                    $return_msg[] = array(
                        'msg'   => 'success',
                        'value' => $this->upload->data()
                    );
                }
            }
            return $return_msg;
        }
    }
    
    public function download_file($file){            
        $data=file_get_contents(base_url()."uploads/".$file);
        $name = $file;
        force_download($name, $data);
    }
    
    public function read_excel(){
        $this->load->library('excel');
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("./uploads/ivan.xlsx");
        $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        foreach ($sheetData as $data) {
                echo $data['A'] . '<br />';
        }

    }
    
    public function upload_excel(){
            $this->load->library('excel');
            $code = (($this->input->get('m'))?(($this->input->get('c'))?'module='.$this->input->get('m').'&view='.$this->input->get('c'):'module='.$this->input->get('m')): '');
            if(empty($code)) show_404(); 
            $config['upload_path']='./uploads/';
            $config['allowed_types'] = 'xls|xlsx';
            $config['max_size']='10000';
            $this->load->library('upload',$config);
            if($this->upload->do_upload('excel'))
            {                    
                $upload_value=$this->upload->data();
                $ext=$upload_value['file_ext'];
                $name=$upload_value['file_name']; 
                if($ext='.xls')$objReader = PHPExcel_IOFactory::createReader('Excel5');
                else $objReader = PHPExcel_IOFactory::createReader('Excel2007');
                $objPHPExcel = $objReader->load("./uploads/".$name);
                $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
                $i=0;
                $index=array();
                $check=array();
                $head=array();
                foreach ($sheetData as $datas) {
                        if($i==0){
                            $i=1;
                            foreach ($datas as $data){
                                if(in_array($data, $head))
                                $index[]=$data;
                                $check[]=$data;
                            }
                        }
                        else{    
                            $count=0;
                            $counter=0;
                            $values=array();
                            foreach($datas as $data){
                                if((in_array($check[$count], $head))&&$data!=NULL)$values[$index[$counter++]]=$data;
                                else if(in_array($check[$count], $head))$counter++;
                                $count++;
                            }
                            $this->mfrk->inputdata($table,$values);
                        }
                } 
                $this->session->set_flashdata('message', 'Successfully Updated');
                $path_to_file = 'uploads/'.$upload_value['file_name'];
                unlink($path_to_file);
            }
            else $this->session->set_flashdata('message_error',(($this->upload->display_errors())?$this->upload->display_errors():''));
            redirect($code,'refresh');                
    }
    
    public function upload_csv(){
            $config['upload_path']='./uploads/';
            $config['allowed_types'] = 'csv';
            $config['max_size']='10000';
            $this->load->library('upload',$config);
            if($this->upload->do_upload('csv'))
            {                    
                $upload_value=$this->upload->data();
                $file='uploads/'.$upload_value['file_name']; 
                $header=NULL;
                $full = array();
                if(file_exists($file)){
                    if(($handle = fopen($file, 'r')) !== FALSE)
                    {
                        while (($row = fgetcsv($handle)) !== false) 
                        {                                
                            if(!$header)
                            {
                                $header=array();
                                foreach ($row as $col){
                                    $h=str_replace(' ', '_',$col);
                                    $h=str_replace('/', '_',$h);
                                    $h=str_replace('?', 'What',$h);
                                    $h=str_replace('(', '',$h);
                                    $h=str_replace(')', '',$h);
                                    $header[]=$h;
                                }
                            }
                            else
                            {
                                $values = array();
                                $values = array_combine($header, $row);
                                $this->mfrk->inputdata('peter',$values);
                            }

                        }
                        fclose($handle);
                        $this->session->set_flashdata('message', 'Successfully Updated');
                    }else $this->session->set_flashdata('message_error', 'File Could Not Be Open');
                }else $this->session->set_flashdata('message_error', 'File Not Found');                    
                unlink($file);
            }
            echo 'done';
    }
    
    public function upload_csv_table(){
            $config['upload_path']='./uploads/';
            $config['allowed_types'] = 'csv';
            $config['max_size']='10000';
            $this->load->library('upload',$config);
            if($this->upload->do_upload('csv'))
            {                    
                $upload_value=$this->upload->data();
                $file='uploads/'.$upload_value['file_name']; 
                $header=NULL;
                $full = array();
                if(file_exists($file)){
                    if(($handle = fopen($file, 'r')) !== FALSE)
                    {
                        while (($row = fgetcsv($handle)) !== false) 
                        {                                
                            if(!$header)
                            {
                                $header['id']= array(
                                             'type' => 'INT',
                                             'constraint' => 11, 
                                             'unsigned' => TRUE,
                                             'auto_increment' => TRUE
                                      );
                                foreach ($row as $col){
                                    $h=str_replace(' ', '_',$col);
                                    $h=str_replace('/', '_',$h);
                                    $h=str_replace('?', 'What',$h);
                                    $h=str_replace('(', '',$h);
                                    $h=str_replace(')', '',$h);
                                    $header[$h]=array(
                                        'type' => 'VARCHAR',
                                        'constraint' => '200',
                                    );
                                }
                                $this->load->dbforge();
                                $this->dbforge->add_field($header);
                                $this->dbforge->add_key('id');
                                $this->dbforge->create_table('peter');
                                $header=array();
                                foreach ($row as $col){
                                    $h=str_replace(' ', '_',$col);
                                    $h=str_replace('/', '_',$h);
                                    $h=str_replace('?', 'What',$h);
                                    $h=str_replace('(', '',$h);
                                    $h=str_replace(')', '',$h);
                                    $header[]=$h;
                                }

                            }

                            else
                            {
                                $values = array();
                                $values = array_combine($header, $row);
                                $this->mfrk->inputdata('peter',$values);
                            }

                        }
                        fclose($handle);
                        $this->session->set_flashdata('message', 'Successfully Updated');
                    }else $this->session->set_flashdata('message_error', 'File Could Not Be Open');
                }else $this->session->set_flashdata('message_error', 'File Not Found');                    
                unlink($file);
            }
            else $this->session->set_flashdata('message_error',(($this->upload->display_errors())?$this->upload->display_errors():''));
             echo 'done';               
    }
    
    public function download_excel(){
        $this->load->library('excel');
        $sheet = new PHPExcel();
        $sheet->getProperties()->setTitle('Attendance Report')->setDescription('Attendance Report');
        $sheet->setActiveSheetIndex(0);            
        $attendacne_data=$this->mfrk->get($table)->result();
        $head=array();
        $col = 0;
        foreach ($attendacne_data[0] as $field=>$value) 
        {
            if(in_array($field, $head)||count($head)==0)
            {
                $sheet->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
                $col++;                            
            }
        }
        $row = 2;
        foreach ($attendacne_data as $data) 
        {
            $col = 0;
            foreach ($data as $field=>$field_val) 
            {
                if(in_array($field, $head)||count($head)==0)
                {
                    $sheet->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $field_val);
                    $col++;
                }
            }
            $row++;
        }
        $sheet_writer = PHPExcel_IOFactory::createWriter($sheet, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="att_report_'.date('dMy').'.xls"');
        header('Cache-Control: max-age=0');

        $sheet_writer->save('php://output');
    }

    public function download_csv(){
        $datas = $this->mfrk->get($table)->result();
        $heads=array();
        $head=array();
        $values=array();            
        foreach ($datas[0] as $field=>$field_val) {
                if(in_array($field, $heads)||count($heads)==0){
                    $head[]=$field;                        
                }                        
        }            
        foreach ($datas as $data){
            $value=array();
            foreach ($data as $field=>$field_val) {
                    if(in_array($field, $head)){
                        $value[]=$field_val;                        
                    }
            }
            $values[]=$value;
        }
        $fp = fopen('uploads/export.csv', 'w');

        foreach ($values as $fields) {
            fputcsv($fp, $fields);
        }

        fclose($fp);
        $data=file_get_contents(base_url()."uploads/export.csv");
        $name = 'inventory.csv';
        force_download($name, $data);
    }
    
}

if(!function_exists('pre')){
    /*
     * Print the value of a variable
     */
    function pre($value, $name = FALSE, $die = TRUE){
        echo "<pre><br>";
        if($name) echo $name . ' - ';
        if(is_string($value)) echo $value;
        elseif(is_array($value) || is_object($value)) print_r($value);
        else var_dump($value);
        echo "<br></pre>";
        if($die) die();
    }
}
