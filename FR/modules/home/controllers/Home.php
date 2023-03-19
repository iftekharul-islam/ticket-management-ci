<?php
defined('BASEPATH') OR exit('No direct script access allowed');
define('WSDL', 'http://tnwebservices.ticketnetwork.com/tnwebservice/v3.2/tnwebservicestringinputs.asmx?WSDL');
define('WCID', 26493);

class Home extends FR_Controller{
    
    function __construct(){
        parent::__construct();
        
        $this->load->driver('cache', array('adapter' => 'file'));
        
        
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
             $url = "https://";   
        else  
             $url = "http://";   
        // Append the host(domain name, ip) to the URL.   
        $url.= $_SERVER['HTTP_HOST'];   
        
        // Append the requested resource location to the URL   
        $url.= $_SERVER['REQUEST_URI'];    
        
        $sql = "INSERT INTO url_address (page_link) VALUES ('$url')";
        $query = $this->db->query($sql);
        
    }
    
    private function categories(){
        $categories = array(
            "sports" => array(
                "parentCategoryID" => 1,
                "subcategories" => array(
                    "baseball" => array(
                        "childCategoryID" => 63,
                        "subcategories" => array(
                            "mlb" => array("grandchildCategoryID" => 16),
                            "ncaa-baseball" => array("grandchildCategoryID" => 17),
                            "ilb" => array("grandchildCategoryID" => 44),
                            "minors-aaa" => array("grandchildCategoryID" => 27),
                            "other-baseball" => array("grandchildCategoryID" => 29),
                            "pcl" => array("grandchildCategoryID" => 84)
                        )
                    ),
                    "basketball" => array(
                        "childCategoryID" => 66,
                        "subcategories" => array(
                            "ncaa-basketball" => array("grandchildCategoryID" => 17),
                            "other-basketball" => array("grandchildCategoryID" => 29),
                            "nba" => array("grandchildCategoryID" => 30),
                            "wnba" => array("grandchildCategoryID" => 31)
                        )
                    ),
                    "football" => array(
                        "childCategoryID" => 65,
                        "subcategories" => array(
                            "afl" => array("grandchildCategoryID" => 42),
                            "cfl" => array("grandchildCategoryID" => 36),
                            "ncaa-football" => array("grandchildCategoryID" => 17),
                            "nfl" => array("grandchildCategoryID" => 32),
                            "other-football" => array("grandchildCategoryID" => 29)
                        )
                    ),
                    "hockey" => array(
                        "childCategoryID" => 68,
                        "subcategories" => array(
                            "ahl" => array("grandchildCategoryID" => 40),
                            "chl-canadian" => array("grandchildCategoryID" => 91),
                            "chl-central" => array("grandchildCategoryID" => 89 ),
                            "ncaa-hockey" => array("grandchildCategoryID" => 17),
                            "echl" => array("grandchildCategoryID" => 41),
                            "sphl" => array("grandchildCategoryID" => 185),
                            "whl" => array("grandchildCategoryID" => 171),
                            "nhl" => array("grandchildCategoryID" => 19)
                        )
                    ),
                    "racing" => array(
                        "childCategoryID" => 69,
                        "subcategories" => array(
                            "auto" => array("grandchildCategoryID" => 20),
                            "boat" => array("grandchildCategoryID" => 184),
                            "horse" => array("grandchildCategoryID" => 35),
                            "motorcycle" => array("grandchildCategoryID" => 21),
                            "nascar" => array("grandchildCategoryID" => 187),
                            "truck" => array("grandchildCategoryID" => 46),
                        )
                    ),
                    "soccer" => array(
                        "childCategoryID" => 71,
                        "subcategories" => array(
                            "ncaa-soccer" => array("grandchildCategoryID" => 17),
                            "english-premier-league" => array("grandchildCategoryID" => 49),
                            "euro-cup" => array("grandchildCategoryID" => 43),
                            "french-ligue-1" => array("grandchildCategoryID" => 60),
                            "german-bundesliga" => array("grandchildCategoryID" => 50),
                            "italian-serie-a" => array("grandchildCategoryID" => 64),
                            "mexican-primera-division" => array("grandchildCategoryID" => 66),
                            "indoor-soccer" => array("grandchildCategoryID" => 83),
                            "national-teams" => array("grandchildCategoryID" => 183),
                            "north-american-soccer-league" => array("grandchildCategoryID" => 191),
                            "other-soccer" => array("grandchildCategoryID" => 29),
                            "portuguese-primeira-liga" => array("grandchildCategoryID" => 71),
                            "mls" => array("grandchildCategoryID" => 22),
                            "scottish-premier-league" => array("grandchildCategoryID" => 74),
                            "spanish-liga" => array("grandchildCategoryID" => 78),
                            "world-cup" => array("grandchildCategoryID" => 28)
                        )
                    ),
                    "boxing" => array(
                        "childCategoryID" => 50
                    ),
                    "cricket" => array(
                        "childCategoryID" => 90
                    ),
                    "golf" => array(
                        "childCategoryID" => 67,
                        "subcategories" => array(
                            "pga" => array("grandchildCategoryID" => 18),
                            "lpga" => array("grandchildCategoryID" => 86)
                        )
                    ),
                    "gynmastics" => array(
                        "childCategoryID" => 84
                    ),
                    "lacrosse" => array(
                        "childCategoryID" => 76,
                        "subcategories" => array(
                            "ncaa-lacrosse" => array("grandchildCategoryID" => 17),
                            "nll" => array("grandchildCategoryID" => 38),
                        )
                    ),
                    "mixed-martial-arts" => array(
                        "childCategoryID" => 101
                    ),
                    "olympics" => array(
                        "childCategoryID" => 78
                    ),
                    "rodeo" => array(
                        "childCategoryID" => 53
                    ),
                    "rugby" => array(
                        "childCategoryID" => 77
                    ),
                    "skating" => array(
                        "childCategoryID" => 52
                    ),
                    "softball" => array(
                        "childCategoryID" => 103
                    ),
                    "skating" => array(
                        "childCategoryID" => 52
                    ),
                    "tennis" => array(
                        "childCategoryID" => 27,
                        "subcategories" => array(
                            "ncaa-tennis" => array("grandchildCategoryID" => 17),
                            "professional-tennis" => array("grandchildCategoryID" => 24)
                        )
                    ),
                    "volleyball" => array(
                        "childCategoryID" => 47
                    ),
                    "wrestling" => array(
                        "childCategoryID" => 39,
                        "subcategories" => array(
                            "ncaa-wrestling" => array("grandchildCategoryID" => 17),
                            "other-wrestling" => array("grandchildCategoryID" => 29),
                            "wwe" => array("grandchildCategoryID" => 26)
                        )
                    )
                )
            ),
            "concerts" => array(
                "parentCategoryID" => 2,
                "subcategories" => array(
                    "50s-era" => array(
                        "childCategoryID" => 87
                    ),
                    "alternative" => array(
                        "childCategoryID" => 22
                    ),
                    "bluegrass" => array(
                        "childCategoryID" => 46
                    ),
                    "family" => array(
                        "childCategoryID" => 55
                    ),
                    "classical" => array(
                        "childCategoryID" => 49
                    ),
                    "comedy" => array(
                        "childCategoryID" => 24
                    ),
                    "folk" => array(
                        "childCategoryID" => 23
                    ),
                    "festival" => array(
                        "childCategoryID" => 100
                    ),
                    "metal" => array(
                        "childCategoryID" => 61
                    ),
                    "holiday" => array(
                        "childCategoryID" => 86
                    ),
                    "jazz" => array(
                        "childCategoryID" => 21
                    ),
                    "las-vegas-shows" => array(
                        "childCategoryID" => 34
                    ),
                    "latin" => array(
                        "childCategoryID" => 73
                    ),
                    "new-age" => array(
                        "childCategoryID" => 48
                    ),
                    "other-concerts" => array(
                        "childCategoryID" => 37
                    ),
                    "performance-series" => array(
                        "childCategoryID" => 105
                    ),
                    "pop" => array(
                        "childCategoryID" => 62
                    ),
                    "soul" => array(
                        "childCategoryID" => 45
                    ),
                    "hip-hop" => array(
                        "childCategoryID" => 36
                    ),
                    "reggae" => array(
                        "childCategoryID" => 83
                    ),
                    "religious" => array(
                        "childCategoryID" => 43
                    ),
                    "techno" => array(
                        "childCategoryID" => 98
                    ),
                    "world" => array(
                        "childCategoryID" => 57
                    )
                )
            ),
            "theater" =>  array(
                "parentCategoryID" => 3,
                "subcategories" => array(
                    "opera" => array(
                        "childCategoryID" => 75
                    ),
                    "ballet" => array(
                        "childCategoryID" => 60
                    ),
                    "broadway" => array(
                        "childCategoryID" => 70
                    ),
                    "children" => array(
                        "childCategoryID" => 97
                    ),
                    "cirque-du-soleil" => array(
                        "childCategoryID" => 102
                    ),
                    "dance" => array(
                        "childCategoryID" => 82
                    ),
                    "las-vegas" => array(
                        "childCategoryID" => 35
                    ),
                    "musical" => array(
                        "childCategoryID" => 38
                    ),
                    "off-broadway" => array(
                        "childCategoryID" => 32
                    ),
                    "west-end" => array(
                        "childCategoryID" => 104
                    ),
                    "other-theater" => array(
                        "childCategoryID" => 74
                    )
                )
            )
        );
        return $categories;
    }
            
    function category($name1 = NULL, $name2 = NULL, $name3 = NULL){
        $categories = $this->categories();
        if(!empty($name1) && !empty($categories[$name1])){
            $name = $name1; $url = $name;
            $params['parentCategoryID'] = $categories[$name1]['parentCategoryID'];
            $img_url = "assets/home/images/category-" . $categories[$name1]['parentCategoryID'] . ".jpg";
            if(!empty($name2)){
                if(!empty($categories[$name1]['subcategories'][$name2])){
                    $name = $name2; $url .= "/" . $name;
                    $params['childCategoryID'] = $categories[$name1]['subcategories'][$name2]['childCategoryID'];
                    $img_url = "assets/home/images/category-" . $params['childCategoryID'] . ".jpg";
                    if(!empty($name3)){
                        if(!empty($categories[$name1]['subcategories'][$name2]['subcategories'][$name3])){
                            $name = $name3; $url .= "/" . $name; 
                            $params['grandchildCategoryID'] = $categories[$name1]['subcategories'][$name2]['subcategories'][$name3]['grandchildCategoryID'];
                        }else show_404();
                    }
                }else show_404();
                $caller = array("cache_id" => $name, "time" => 24*3600, "params" => $params, "method" => 'GetPerformerByCategory');
                $data['performers'] = $this->tn($caller);
            }else{
                $caller = array("time" => 24*3600, "method" => 'GetPerformerByCategory');
                //***  an easy looping could have been implemented but I didnt want to lie to them about iterative or looping execution of WebServices calls
                if($name == "sports"){
                    $params['grandchildCategoryID'] = "30";
                    $params['childCategoryID'] = "66";
                    $caller['cache_id'] = "nba";
                    $caller['params'] = $params;
                    $data['popular_subcategories']["NBA"] = $this->tn($caller);
                    $data['popular_subcategories']["NBA"]->url = "sports/basketball/nba";
                            
                    $params['grandchildCategoryID'] = "32";
                    $params['childCategoryID'] = "65";
                    $caller['cache_id'] = "nfl";
                    $caller['params'] = $params;
                    $data['popular_subcategories']["NFL"] = $this->tn($caller);
                    $data['popular_subcategories']["NFL"]->url = "sports/football/nfl";
                    
                    $params['grandchildCategoryID'] = "19";
                    $params['childCategoryID'] = "68";
                    $caller['cache_id'] = "nhl";
                    $caller['params'] = $params;
                    $data['popular_subcategories']["NHL"] = $this->tn($caller);
                    $data['popular_subcategories']["NHL"]->url = "sports/hockey/nhl";
                    
                    $params['grandchildCategoryID'] = "16";
                    $params['childCategoryID'] = "63";
                    $caller['cache_id'] = "mlb";
                    $caller['params'] = $params;
                    $data['popular_subcategories']["MLB"] = $this->tn($caller);
                    $data['popular_subcategories']["MLB"]->url = "sports/baseball/mlb";
                    
                    $params['grandchildCategoryID'] = "17";
                    $params['childCategoryID'] = "65";
                    $caller['cache_id'] = "ncaa-football";
                    $caller['params'] = $params;
                    $data['popular_subcategories']["NCAA Football"] = $this->tn($caller);
                    $data['popular_subcategories']["NCAA Football"]->url = "sports/football/ncaa-football";
                    
                    $params['grandchildCategoryID'] = "46";
                    $params['childCategoryID'] = "69";
                    $caller['cache_id'] = "truck";
                    $caller['params'] = $params;
                    $data['popular_subcategories']["Racing"] = $this->tn($caller);
                    $data['popular_subcategories']["Racing"]->url = "sports/racing/truck";
                    
                }elseif($name == "concerts"){
                    $params['childCategoryID'] = "62";
                    $caller['cache_id'] = "pop";
                    $caller['params'] = $params;
                    $data['popular_subcategories']["POP Music"] = $this->tn($caller);
                    $data['popular_subcategories']["POP Music"]->url = "concerts/pop";
                    
                    $params['childCategoryID'] = "23";
                    $caller['cache_id'] = "folk";
                    $caller['params'] = $params;
                    $data['popular_subcategories']["Country Music"] = $this->tn($caller);
                    $data['popular_subcategories']["Country Music"]->url = "concerts/folk";
                    
                    $params['childCategoryID'] = "24";
                    $caller['cache_id'] = "comedy";
                    $caller['params'] = $params;
                    $data['popular_subcategories']["Top Comedy"] = $this->tn($caller);
                    $data['popular_subcategories']["Top Comedy"]->url = "concerts/comedy";
                    
                    $params['childCategoryID'] = "100";
                    $caller['cache_id'] = "festival";
                    $caller['params'] = $params;
                    $data['popular_subcategories']["Festivals"] = $this->tn($caller);
                    $data['popular_subcategories']["Festivals"]->url = "concerts/festival";
                    
                    $params['childCategoryID'] = "36";
                    $caller['cache_id'] = "hip-hop";
                    $caller['params'] = $params;
                    $data['popular_subcategories']["Hip-Hop Rap"] = $this->tn($caller);
                    $data['popular_subcategories']["Hip-Hop Rap"]->url = "concerts/hip-hop";
                    
                    $params['childCategoryID'] = "61";
                    $caller['cache_id'] = "metal";
                    $caller['params'] = $params;
                    $data['popular_subcategories']["Hard Rock"] = $this->tn($caller);
                    $data['popular_subcategories']["Hard Rock"]->url = "concerts/metal";
                
                }else{
                    $params['childCategoryID'] = "38";
                    $caller['cache_id'] = "musical";
                    $caller['params'] = $params;
                    $data['popular_subcategories']["Musicals & Plays"] = $this->tn($caller);
                    $data['popular_subcategories']["Musicals & Plays"]->url = "theater/musical";
                    
                    $params['childCategoryID'] = "70";
                    $caller['cache_id'] = "broadway";
                    $caller['params'] = $params;
                    $data['popular_subcategories']["Broadway"] = $this->tn($caller);
                    $data['popular_subcategories']["Broadway"]->url = "theater/broadway";
                    
                    $params['childCategoryID'] = "97";
                    $caller['cache_id'] = "children";
                    $caller['params'] = $params;
                    $data['popular_subcategories']["Children & Family"] = $this->tn($caller);
                    $data['popular_subcategories']["Children & Family"]->url = "theater/children";
                    
                    $params['childCategoryID'] = "75";
                    $caller['cache_id'] = "opera";
                    $caller['params'] = $params;
                    $data['popular_subcategories']["Opera"] = $this->tn($caller);
                    $data['popular_subcategories']["Opera"]->url = "theater/opera";
                    
                    $params['childCategoryID'] = "102";
                    $caller['cache_id'] = "cirque-du-soleil";
                    $caller['params'] = $params;
                    $data['popular_subcategories']["Cirque du Soleil"] = $this->tn($caller);
                    $data['popular_subcategories']["Cirque du Soleil"]->url = "theater/cirque-du-soleil";
                    
                    $params['childCategoryID'] = "82";
                    $caller['cache_id'] = "dance";
                    $caller['params'] = $params;
                    $data['popular_subcategories']["Dance Shows"] = $this->tn($caller);
                    $data['popular_subcategories']["Dance Shows"]->url = "theater/dance";
                }
            }
        }else show_404();
        
        $data['contents_on_top'] = $this->mfrk->get_where("event_contents", array("event_url" => $url, "placement" => "top", "status" => "active"))->result();
        $data['contents_on_bottom'] = $this->mfrk->get_where("event_contents", array("event_url" => $url, "placement" => "bottom", "status" => "active"))->result();
        $data['page_title'] = implode(" ", array_map("ucfirst", explode("-", $name)));
        $data['img_url'] = $img_url;
        $this->mfrk->_render_frontend("category", $data);
    }
    
    function about(){
        $data['page_title'] = "About Us";
        $this->mfrk->_render_frontend("about", $data);
    }
    
    function faq(){
        $data['page_title'] = "Frequently Asked Questions";
        $this->mfrk->_render_frontend("faq", $data);
    }
    
    function contact(){
        $data['page_title'] = "Contact Us";
        $this->mfrk->_render_frontend("contact", $data);
    }
    
    function career(){
        $data['page_title'] = "Career";
        $this->mfrk->_render_frontend("career", $data);
    }
    
    function policies(){
        $data['page_title'] = "Terms & Policies";
        $this->mfrk->_render_frontend("policies", $data);
    }
            
    function tickets($id = NULL, $name = NULL){
        $data['page_title'] = implode(" ", array_map("ucfirst", explode("-", $name)));
        $data['id'] = $id;
        $data['wcid'] = WCID;
        $this->mfrk->_render_frontend("tickets", $data);
    }
    
    function search(){
        $search = (string)$this->input->get('query');
        if(!empty($search)){
            $parameters['searchTerms'] = $search;
            $where = $this->input->get('city');
            if(!empty($where)) $parameters['whereClause'] = 'city="' . ucfirst($where) . '"';
            $parameters['websiteConfigID'] = WCID;
            try{
                $client = new SoapClient(WSDL);
                $result = $client->__soapCall("SearchEvents", array('parameters' => $parameters));
            }catch(Exception $e){
                pre($e->getMessage());
            }
        }
        $data['events'] = empty($result->SearchEventsResult->Event)? FALSE : $result->SearchEventsResult->Event;
        $data['page_title'] = "Search result for - " . $search . (!empty($where)? " & City - " . $where : "") ;
        $data['img_url'] = "";
        $this->mfrk->_render_frontend("events", $data);
    }
    
    function events($name = NULL, $id = NULL){
        $id || show_404();
        $id = (int)$id;
        $caller = array("cache_id" => $id, "time" => 3600, "params" => array("numberOfEvents" => 500, "performerID" => $id,'orderByClause' => "Date ASC"), "method" => 'GetEvents');
        $data['events'] = $this->tn($caller);
        $data['page_title'] = "OOPS";
        $data['img_url'] = "";
        if(!empty($data['events'])){
            is_array($data['events']) || $data['events'] = array($data['events']);
            $data['page_title'] = implode(" ", array_map("ucfirst", explode("-", $name)));
            $img_url = "https://dtr2k13nvgx2o.cloudfront.net/auto-resized/responsive-images/performer/" . $id . "/" . $id . "-1200x250.jpg";
            if(stripos(get_headers($img_url)[0], "200 OK") == FALSE) $img_url = "assets/home/images/category-" . $data['events'][0]->ChildCategoryID . ".jpg";
            $data['img_url'] = $img_url;
        }
        
        $this->db->like('event_url', "/" . $id, 'before');
        $data['contents_on_top'] = $this->mfrk->get_where("event_contents", array("placement" => "top", "status" => "active"))->result();
        $this->db->like('event_url', "/" . $id, 'before');
        $data['contents_on_sidebar'] = $this->mfrk->get_where("event_contents", array("placement" => "sidebar", "status" => "active"))->result();
        $this->db->like('event_url', "/" . $id, 'before');
        $data['contents_on_bottom'] = $this->mfrk->get_where("event_contents", array("placement" => "bottom", "status" => "active"))->result();
        $this->mfrk->_render_frontend("events", $data);
    }
    
    function featured($type = NULL){
        if($type == "on-sale-now"){
            $caller = array("cache_id" => "on-sale-now", "time" => 24*3600, "params" => array("numReturned" => 100), "method" => 'GetHighSalesPerformers');
            $data['page_title'] = "On Sale Now";
            $data['stdobject'] = "GetHighSalesPerformersResult";
        }elseif($type == "trending-events"){
            $caller = array("cache_id" => "trending-events", "time" => 24*3600, "params" => array("numReturned" => 100), "method" => 'GetHighInventoryPerformers');
            $data['page_title'] = "Trending Events";
            $data['stdobject'] = "GetHighInventoryPerformersResult";
        }else show_404();
        $data['performers'] = $this->tn($caller);
        $this->mfrk->_render_frontend("featured", $data);
    }
    
    function index(){
        $caller = array("cache_id" => "on-sale-now", "time" => 24*3600, "params" => array("numReturned" => 100), "method" => 'GetHighSalesPerformers');
        $data['on_sale_now'] = $this->tn($caller);
        $caller = array("cache_id" => "trending-events", "time" => 24*3600, "params" => array("numReturned" => 100), "method" => 'GetHighInventoryPerformers');
        $data['trending_events'] = $this->tn($caller);
        $caller = array("cache_id" => "top-sports", "time" => 24*3600, "params" => array("numReturned" => 100, "parentCategoryID" => 1), "method" => 'GetHighInventoryPerformers');
        $data['top_sports'] = $this->tn($caller);
        $caller = array("cache_id" => "top-concerts", "time" => 24*3600, "params" => array("numReturned" => 100, "parentCategoryID" => 2), "method" => 'GetHighInventoryPerformers');
        $data['top_concerts'] = $this->tn($caller);
        $caller = array("cache_id" => "top-theater", "time" => 24*3600, "params" => array("numReturned" => 100, "parentCategoryID" => 3), "method" => 'GetHighInventoryPerformers');
        $data['top_theater'] = $this->tn($caller);
        $data['sliders'] = $this->mfrk->get('home_sliders', array("column" => "serial", "order" => "DESC"))->result();
        $data['midsections'] = $this->mfrk->get('home_midsections', array("column" => "serial", "order" => "ASC"))->result();
        $data['posts'] = $this->mfrk->get_where('posts', array("status" => "published"), array("column" => "date", "order" => "DESC"), 5)->result();
        $this->mfrk->_render_frontend('index', $data);
    }
    
    function login(){
        $this->mfrk->_render_frontend('login');
    }
    
    function blog($segment2 = NULL, $segment3 = NULL){
        $data['categories'] = $this->mfrk->get_where('post_categories', array('parent_id' => 0, 'status' => 'active'))->result();
        foreach($data['categories'] as $key => $value){
            $data['categories'][$key]->child_categories = $this->mfrk->get_where('post_categories', array('parent_id' => $value->id, 'status' => 'active'))->result();
        }
        $this->load->model('home_model');
        $data = array_merge($data, $this->home_model->get_data($segment2, $segment3));
        $this->mfrk->_render_frontend('blog', $data);
    }
    
    function newsletter_signup(){
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[newsletter_subscribers.email]');
        if($this->form_validation->run()){
            $this->mfrk->insert('newsletter_subscribers', array('email' => $_POST['email']));
            echo 'Newsletter subscription successful';
        }else{
            echo strip_tags(validation_errors());
        }
    }
    
    function delete_cache(){
        pre($this->cache->clean());
    }
    
    private function tn($caller = array()){
        if($result = $this->cache->get($caller['cache_id'])) return $result;
        $caller['params']['websiteConfigID'] = WCID;
        try{
            $client = new SoapClient(WSDL);
            $result = $client->__soapCall($caller['method'], array('parameters' => $caller['params']));
            if($caller['method'] == "GetEvents"){
                if(empty($result->GetEventsResult->Event)) return FALSE;
                $result = $result->GetEventsResult->Event;
            }
        }catch(Exception $e){
            pre($e->getMessage());
        }
        unset($client);
        $this->cache->save($caller['cache_id'], $result, $caller['time']);
        return $result;
    }
    
    function loadtime($n1 = NULL, $n2 = NULL, $n3 = NULL, $n4 = NULL, $n5 = NULL){
        $starttime = microtime(true);
        if($n1 == "https:" || $n1 == "http:"){
            $n1 = $n3;
            $n2 = $n4;
            $n3 = $n5;
        }
        if($n1 == "home"){
            $n1 = $n2;
            $n2 = $n3;
        }
        $n1 OR $n1 = 'index';
        printf('<script type="text/javascript"> var timerStart = Date.now(); </script>');
        $this->$n1($n2, $n3);
        $endtime = microtime(true);
        printf("<h1 id='rendering-time'>Server rendered in %f seconds</h1>", $endtime - $starttime );
    }
    
    function test($wcid = NULL){ //testing function
        $wcid OR $wcid = 3551;
        $data['wcid'] = $wcid;
        $data['page_title'] = $wcid == 3551? "WCID of Ticketnetwork.com is used ($wcid)" : ($wcid == 26493? "WCID of 888seats.com is used ($wcid)" : ($wcid == 17581? "WCID of Ticketright.com is used ($wcid)" : "WCID =  $wcid"));
        $data['id'] = 4458711;
        $this->mfrk->_render_frontend("template", $data);
    }
    
}
