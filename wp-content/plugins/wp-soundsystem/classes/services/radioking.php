<?php

class WPSSTM_RadioKing{
    function __construct(){
        add_filter('wpsstm_wizard_service_links',array($this,'register_radioking_service_link'));
        add_filter('wpsstm_remote_presets',array($this,'register_radioking_preset'));
    }
    //register preset
    function register_radioking_preset($presets){
        $presets[] = new WPSSTM_RadioKing_Api_Preset();
        return $presets;
    }
    function register_radioking_service_link($links){
        $item = sprintf('<a href="https://www.radioking.com" target="_blank" title="%s"><img src="%s" /></a>','RadioKing',wpsstm()->plugin_url . '_inc/img/radioking-icon.png');
        $links[] = $item;
        return $links;
    }
}

class WPSSTM_RadioKing_Api_Preset extends WPSSTM_Remote_Tracklist{
    
    var $station_slug;
    var $station_id;
    var $station_data;

    function __construct($url = null,$options = null) {
        
        $this->preset_options = array(
            'selectors' => array(
                'tracks'            => array('path'=>'root > element'),
                'track_artist'      => array('path'=>'artist'),
                'track_album'       => array('path'=>'album'),
                'track_title'       => array('path'=>'title'),
                'track_image'       => array('path'=>'cover'),
            )
        );
        
        parent::__construct($url,$options);

    }
    
    function init_url($url){
        
        $this->station_slug = $this->get_station_slug($url);
        $this->station_data = ($this->station_slug) ? $this->get_station_data($this->station_slug) : null;
        
        if ( $this->station_data ){
            $this->station_id = wpsstm_get_array_value(array('idradio'),$this->station_data);
        }
        
        return $this->station_id;
    }

    function get_remote_request_url(){
        return sprintf('https://www.radioking.com/widgets/api/v1/radio/%s/track/ckoi?limit=8',$this->station_id);
    }

    function get_station_slug($url){
        $pattern = '~^https?://(?:.*\.)?radioking.com/radio/([^/]+)~i';
        preg_match($pattern, $url, $matches);
        return isset($matches[1]) ? $matches[1] : null;
    }
    
    function get_station_data($station_slug){

        if (!$station_slug) return;
        
        $transient_name = 'wpsstm-radioking-' . $station_slug . '-data';

        if ( false === ( $station_data = get_transient($transient_name ) ) ) {
            $data_url = sprintf('https://www.radioking.com/api/radio/slug/%s',$station_slug);
            $response = wp_remote_get( $data_url );
            $json = wp_remote_retrieve_body($response);
            if ( is_wp_error($json) ) return $json;
            $api = json_decode($json,true);
            if ( $station_data = wpsstm_get_array_value(array('data'), $api) ){
                set_transient( $transient_name, $station_data, 1 * DAY_IN_SECONDS );
            }
        }
        return $station_data;

    }

    function get_remote_title(){
        return wpsstm_get_array_value(array('name'), $this->station_data);
    }

    protected function get_track_image($node){
        $selectors = $this->get_selectors( array('track_image'));
        
        if ( $image_id = $this->parse_node($node,$selectors) ){
           $image = sprintf('https://www.radioking.com/api/track/cover/%s?width=55&height=55',$image_id);
        }

        return $image;
    }

}

function wpsstm_radioking_init(){
    new WPSSTM_RadioKing();
}

add_action('wpsstm_load_services','wpsstm_radioking_init');