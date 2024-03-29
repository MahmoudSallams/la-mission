<?php

use \ForceUTF8\Encoding;

class WPSSTM_Remote_Tracklist{
    
    //url request
    var $url = null; //url requested
    var $remote_request_url = null; //url filtered by preset
    var $remote_request_args;
    
    var $default_options = array(
        'selectors' => array(
            'tracklist_title'   => array('path'=>'head title','regex'=>null,'attr'=>null),
            'tracks'            => array('path'=>null,'regex'=>null,'attr'=>null),
            'track_artist'      => array('path'=>null,'regex'=>null,'attr'=>null),
            'track_title'       => array('path'=>null,'regex'=>null,'attr'=>null),
            'track_album'       => array('path'=>null,'regex'=>null,'attr'=>null),
            'track_source_urls' => array('path'=>null,'regex'=>null,'attr'=>null),
            'track_image'       => array('path'=>null,'regex'=>null,'attr'=>null),
        ),
        'tracks_order'              => 'desc',
    );
    
    var $options = array();
    var $preset_options = array(); //options that will override the user options

    var $default_request_args = array(
        'headers'   => array(
            'User-Agent'        => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36'
        )
    );

    var $request_pagination = array(
        'total_pages'       => 1,
        'tracks_per_page'   => null, //When possible (eg. APIs), set the limit of tracks each request can get
        'current_page'      => 0
    );

    //request
    static $querypath_options = array(
        'omit_xml_declaration'      => true,
        'ignore_parser_warnings'    => true,
        'convert_from_encoding'     => 'UTF-8', //our input is always UTF8 - look for fixUTF8() in code
        //'convert_to_encoding'       => 'UTF-8' //match WP database (or transients won't save)
    );
    
    public $response = null;
    public $response_type = null;
    public $response_body = null;
    public $body_node = null;
    public $track_nodes = array();
    
    public $tracks = array();
    public $title;
    public $author;

    public function __construct($url = null,$options = array() ) {
        $this->url = trim($url);

        //push custom options if any
        if ( !empty($options) ){
            
            $this->options = $options;
            $this->options = array_replace_recursive($this->default_options,$options); //last one has priority

        }else{
            $this->options = $this->default_options;
        }

        //override with presets options if any
        if ( !empty($this->preset_options) ){
            $this->options = array_replace_recursive($this->options,$this->preset_options); //last one has priority
        }

    }
    
    /*
    Test if this URL can be handled by the preset.
    Your preset class SHOULD override this funtion.
    */
    function init_url($url){
        return (filter_var($url, FILTER_VALIDATE_URL) !== FALSE);
    }
    
    /*
    Filter the preset URL if needed (redirect to api, etc)
    You could eventually rely on $this->request_pagination for pagination purposes.
    */
    
    function get_remote_request_url(){
        return $this->url;
    }
    
    /*
    Filter the preset URL args if needed
    You could eventually rely on $this->request_pagination for pagination purposes.
    */

    function get_remote_request_args(){
        return $this->default_request_args;
    }
    
    /*
    Populate remote tracks.
    Returns success, or first WP Error.
    
    */
    
    function populate_remote_tracks(){
        
        $success = true;
        
        while ( $this->request_pagination['current_page'] < $this->request_pagination['total_pages'] ){
            
            $page_tracks = $this->get_remote_page_tracks();

            if ( is_wp_error($page_tracks) ){
                $success = $page_tracks;
                break;
            }
            
            //first page
            if ($this->request_pagination['current_page'] == 0){
                $this->title = $this->get_remote_title();
                $this->author = $this->get_remote_author();
            }
            
            $this->tracks = array_merge($this->tracks,(array)$page_tracks);
            $this->request_pagination['current_page']++;
        }

        //sort
        if ($this->get_options('tracks_order') == 'asc'){
            $this->tracks = array_reverse($this->tracks);
        }
        
        return $success;
    
    }
    
    private function get_remote_page_tracks(){

        require_once(wpsstm()->plugin_dir . '_inc/php/class-array2xml.php');
        
        /*
        init request data
        */
        $this->remote_request_url = $this->get_remote_request_url();
        if ( is_wp_error($this->remote_request_url) ){
            $this->remote_log( $this->remote_request_url->get_error_message(),'Request URL error' );
            return $this->remote_request_url;
        }
        
        $this->remote_request_args = $this->get_remote_request_args();
        if ( is_wp_error($this->remote_request_args) ){
            $this->remote_log( $this->remote_request_url->get_error_message(),'Request ARGS error' );
            return $this->remote_request_args;
        }
            
        
        /*
        some debug on first page
        */
        
        $this->remote_log($this->request_pagination['current_page'],'***GET REMOTE PAGE***' );

        if ( $this->url != $this->remote_request_url){
            $this->remote_log($this->url,'original URL' );
        }
        $this->remote_log($this->remote_request_url,'redirect URL' );

        if ($this->remote_request_args != $this->default_request_args){
            $this->remote_log($this->remote_request_args,'URL args' );
        }

        /* POPULATE PAGE */
        $response = $this->populate_remote_response($this->remote_request_url,$this->remote_request_args);
        $response_code = wp_remote_retrieve_response_code( $response );
        if ( is_wp_error($response) ) return $response;
        
        $response_type = $this->populate_response_type();
        if ( is_wp_error($response_type) ) return $response_type;
        
        $response_body = $this->populate_response_body();
        if ( is_wp_error($response_body) ) return $response_body;
        do_action('wpsstm_did_remote_response',$this);
        
        $body_node = $this->populate_body_node();
        if ( is_wp_error($body_node) ) return $body_node;
        
        $track_nodes = $this->populate_track_nodes();
        if ( is_wp_error($track_nodes) ) return $track_nodes;
            
        //tracks
        $tracks = $this->parse_track_nodes();
        $this->remote_log(count($tracks),'found tracks' );
        return $tracks;

    }

    function get_options($keys = null){
        return wpsstm_get_array_value($keys,$this->options);
    }
    function get_preset_options($keys = null){
        return wpsstm_get_array_value($keys,$this->preset_options);
    }
    
    function get_selectors($keys = null){
        $keys = array_merge(array('selectors'),$keys);
        return $this->get_options($keys);
    }

    private function populate_track_nodes(){
        //tracks HTML
        $track_nodes = $this->get_track_nodes($this->body_node);
        if ( is_wp_error($track_nodes) ){
            $this->remote_log( $track_nodes->get_error_message(),'Track nodes error' );
            return $track_nodes;
        }
        
        return $this->track_nodes = $track_nodes;
    }

    private function populate_remote_response($url,$args){

        $response = wp_remote_get($url,$args);

        //errors
        if ( !is_wp_error($response) ){

            $response_code = wp_remote_retrieve_response_code( $response );

            if ($response_code && $response_code != 200){
                $response_message = wp_remote_retrieve_response_message( $response );
                $response = new WP_Error( 'http_response_code', sprintf('[%1$s] %2$s',$response_code,$response_message ) );
            }

        }
        
        if ( is_wp_error($response) ){
            $this->remote_log( $response->get_error_message(),'Get remote URL error' );
        }

        $this->response = $response;
        
        if ( !is_wp_error($response) ){
            $this->remote_log('*** SUCCESS ***' );
        }

        return $this->response;

    }

    private function populate_response_type(){

        $type = null;
        $response = $this->response;
        
        if ( $response && !is_wp_error($response) ){
            $content_type = wp_remote_retrieve_header( $response, 'content-type' );
            
            //JSON
            if ( substr(trim(wp_remote_retrieve_body( $response )), 0, 1) === '{' ){ // is JSON
                $content_type = 'application/json';
            }
            
            //XML to XSPF
            $split = explode('/',$content_type);
            $is_xml = ( ( isset($split[1]) ) && ($split[1]=='xml') );
            
            if ( $is_xml ){
                
                $content = wp_remote_retrieve_body($response);

                //QueryPath
                try{
                    if ( qp( $content, 'playlist trackList track', self::$querypath_options )->length > 0 ){
                        $content_type = sprintf('%s/xspf+xml',$split[0]);
                    }
                }catch(Exception $e){

                }
            }

            //remove charset if any
            $split = explode(';',$content_type);

            if ( !isset($split[0]) ){
                $type = new WP_Error( 'response_type', __('No response type found','wpsstm') );
            }else{
                $type = $split[0];
            }
        }

        $this->response_type = $type;
        return $this->response_type;

    }
    
    protected function populate_response_body(){

        $content = null;

        //response
        $response = $this->response;
        if ( is_wp_error($response) ) return $response;
        
        //response type
        $response_type = $this->response_type;
        if ( is_wp_error($response_type) ) return $response_type;

        //response body
        $content = wp_remote_retrieve_body( $response ); 
        if ( is_wp_error($content) ) return $content;
        
        $content = Encoding::fixUTF8($content);//fix mixed encoding //TO FIX TO CHECK at the right place?
        
        $this->response_body = $content;
        return $this->response_body;
    }
    
    protected function populate_body_node(){

        $result = null;

        $response_type = $this->response_type;
        $response_body = $this->response_body;
        
        if ( is_wp_error($response_body) ) return $response_body;

        libxml_use_internal_errors(true); //TO FIX TO CHECK should be in the XML part only ?
        
        switch ($response_type){
                
            case 'application/json':
                
                $xml = null;

                try{
                    $data = json_decode($response_body, true);
                    $dom = WPSSTM_Array2XML::createXML($data,'root','element');
                    $xml = $dom->saveXML($dom);
                    

                }catch(Exception $e){
                    return WP_Error( 'XML2Array', sprintf(__('XML2Array Error [%1$s] : %2$s','wpsstm'),$e->getCode(),$e->getMessage()) );
                }
                
                if ($xml){
                    $this->remote_log("The json input has been converted to XML.");
                    
                    //reload this functions with our updated type/body
                    $this->response_type = 'text/xml';
                    $this->response_body = $xml;
                    return $this->populate_body_node();
                }
            break;

            case 'text/xspf+xml':
            case 'application/xspf+xml':
            case 'application/xml':
            case 'text/xml':

                $xml = simplexml_load_string($response_body);

                //maybe libxml will output error but will work; do not abord here.
                $xml_errors = libxml_get_errors();
                
                if ($xml_errors){
                    $this->remote_log("There has been some errors while parsing the input XML.");
                    
                    /*
                    foreach( $xml_errors as $xml_error_obj ) {
                        $this->remote_log(sprintf(__('simplexml Error [%1$s] : %2$s','wpsstm'),$xml_error_obj->code,$xml_error_obj->message) );
                    }
                    */
                }

                //QueryPath
                try{
                    $result = qp( $xml, null, self::$querypath_options );
                }catch(Exception $e){
                    return new WP_Error( 'querypath', sprintf(__('QueryPath Error [%s] : %s','wpsstm'),$e->getCode(),$e->getMessage()) );
                }

            break;

            case 'text/html': 

                //QueryPath
                try{
                    $result = htmlqp( $response_body, null, self::$querypath_options );
                }catch(Exception $e){
                    return WP_Error( 'querypath', sprintf(__('QueryPath Error [%s] : %s','wpsstm'),$e->getCode(),$e->getMessage()) );
                }

            break;
        
            //TO FIX seems to put a wrapper around our content + bad content type
        
            default: //text/plain
                //QueryPath
                try{
                    $result = qp( $response_body, 'body', self::$querypath_options );
                }catch(Exception $e){
                    return new WP_Error( 'querypath', sprintf(__('QueryPath Error [%s] : %s','wpsstm'),$e->getCode(),$e->getMessage()) );
                }
                
            break;
        
        }
        
        libxml_clear_errors(); //TO FIX TO CHECK should be in the XML part only ?

        if ( (!$result || ($result->length == 0)) ){
            return new WP_Error( 'querypath', __('We were unable to populate the page node') );
        }

        return $this->body_node = $result;

    }

    /*
    Get the title tag of the page as playlist title.  Could be overriden in presets.
    */
    
    protected function get_remote_title(){
        $title = null;
        
        if ( $selector_title = $this->get_selectors( array('tracklist_title') ) ){
            $title = $this->parse_node($this->body_node,$selector_title);
        }
        return $title;
    }
    
    /*
    Get the playlist author.  Could be overriden in presets.
    */
    
    protected function get_remote_author(){
        $author = null;
        return $author;
    }

    protected function get_track_nodes($body_node){

        $selector = $this->get_selectors( array('tracks','path') );
        if (!$selector) return new WP_Error( 'no_track_selector', __('Required tracks selector is missing.','wpsstm') );

        //QueryPath
        try{
            $track_nodes = qp( $body_node, null, self::$querypath_options )->find($selector);
        }catch(Exception $e){
            return new WP_Error( 'querypath', sprintf(__('QueryPath Error [%s] while parsing tracks : %s','wpsstm'),$e->getCode(),$e->getMessage()) );
        }

        if ( $track_nodes->length == 0 ){
            return new WP_Error( 'no_track_nodes', __('Either the tracks selector is invalid, or there is actually no tracks in the playlist.','wpsstm') );
        }

        return $track_nodes;

    }

    protected function parse_track_nodes(){
        
        if ( is_wp_error($this->track_nodes) ) return $this->track_nodes;
        if (!$this->track_nodes) return new WP_Error( 'no_track_nodes', __('No track nodes found.','wpsstm') );

        $selector_artist = $this->get_selectors( array('track_artist') );
        if (!$selector_artist) return new WP_Error( 'no_track_selector', __('Required track artist selector is missing.','wpsstm') );
        
        $selector_title = $this->get_selectors( array('track_title') );
        if (!$selector_title) return new WP_Error( 'no_track_selector', __('Required track title selector is missing.','wpsstm') );

        $tracks_arr = array();
        
        foreach($this->track_nodes as $key=>$single_track_node) {

            $args = array(
                'artist'        => $this->get_track_artist($single_track_node),
                'title'         => $this->get_track_title($single_track_node),
                'album'         => $this->get_track_album($single_track_node),
                'image_url'     => $this->get_track_image($single_track_node),
                'source_urls'   => $this->get_track_source_urls($single_track_node),
            );

            $tracks_arr[] = array_filter($args);

        }

        return $tracks_arr;

    }
    
    protected function get_track_artist($track_node){
        $selectors = $this->get_selectors( array('track_artist'));
        return $this->parse_node($track_node,$selectors);
    }
    
    protected function get_track_title($track_node){
        $selectors = $this->get_selectors( array('track_title'));
        return $this->parse_node($track_node,$selectors);
    }
    
    protected function get_track_album($track_node){
        $selectors = $this->get_selectors( array('track_album'));
        return $this->parse_node($track_node,$selectors);
    }
    
    protected function get_track_image($track_node){
        $selectors = $this->get_selectors( array('track_image'));
        $image = $this->parse_node($track_node,$selectors);

        if (filter_var((string)$image, FILTER_VALIDATE_URL) === false) return false;
        
        return $image;
    }
    
    protected function get_track_source_urls($track_node){
        $selectors = $this->get_selectors( array('track_source_urls'));
        $source_urls = $this->parse_node($track_node,$selectors,false);

        foreach ((array)$source_urls as $key=>$url){
            if (filter_var((string)$url, FILTER_VALIDATE_URL) === false) {
                unset($source_urls[$key]);
            }
        }

        return $source_urls;
        
    }

    public function parse_node($current_node,$selectors,$single_value=true){
        $pattern = null;
        $strings = array();
        $result = array();

        $selector_css   = wpsstm_get_array_value('path',$selectors);
        $selector_regex = wpsstm_get_array_value('regex',$selectors);
        $selector_attr  = wpsstm_get_array_value('attr',$selectors);
        $in_track_node = wpsstm_get_array_value('in_track_node',$selectors);
        
        /*
        Use top level node instead of current node if path starts with '/'
        */
        $root_prefix = '/';
        if (substr($selector_css, 0, strlen($root_prefix)) == $root_prefix) {
            
            //update path
            $selector_css = substr($selector_css, strlen($root_prefix));
            $selector_css = trim($selector_css);
            
            //switch node
            $current_node = $this->body_node;
        }
        
        if (!$current_node) return;

        //abord
        if ( !$selector_css && !$selector_regex && !$selector_attr ){
            return false;
        }

        //QueryPath
        try{

            if ($selector_css){
                $nodes = $current_node->find($selector_css);
            }else{
                $nodes = $current_node;
            }

            //get the first tag found only
            if ($single_value){
                $nodes = $nodes->eq(0);
            }

            foreach ($nodes as $node){
                if ($selector_attr){
                    $strings[] = $node->attr($selector_attr);
                }else{
                    $strings[] = $node->innerHTML();
                }
            }

        }catch(Exception $e){
            return new WP_Error( 'querypath', sprintf(__('QueryPath Error [%s] : %s','wpsstm'),$e->getCode(),$e->getMessage()) );
        }

        foreach($strings as $key=>$string){
            
            if (!$string = trim($string)) continue;

            //CDATA fix
            $string = $this->sanitize_cdata_string($string);
            
            //regex pattern
            if ( $selector_regex ){
                $pattern = $selector_regex;
            }

            if($pattern) {

                $pattern = sprintf('~%s~m',$pattern);
                preg_match($pattern, $string, $matches);

                $matches = array_filter($matches);
                $matches = array_values($matches);

                if (isset($matches[1])){
                    $string = strip_tags($matches[1]);
                }

            }

            $result[] = $this->sanitize_remote_string($string);
            
        }
        
        if ($result){
            if ($single_value){
                return $result[0];
            }else{
                return $result;
            }
            
        }
        
    }
    
    protected function sanitize_cdata_string($string){
        $string = str_replace("//<![CDATA[","",$string);
        $string = str_replace("//]]>","",$string);

        $string = str_replace("<![CDATA[","",$string);
        $string = str_replace("]]>","",$string);

        return trim($string);
    }
    
    function sanitize_remote_string($string){
        //sanitize result
        $string = strip_tags($string);
        $string = urldecode($string);
        $string = htmlspecialchars_decode($string);
        $string = trim($string);
        return $string;
    }
    
    function remote_log($message,$title = null){

        $title = '[remote] ' . $title;
        
        wpsstm()->debug_log($message,$title);

    }

    public function get_preset_name(){
    return static::class;
    }
    
}