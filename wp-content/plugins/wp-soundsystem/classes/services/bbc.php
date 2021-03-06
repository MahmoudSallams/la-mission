<?php

class WPSSTM_BBC{
    function __construct(){
        add_filter('wpsstm_remote_presets',array($this,'register_bbc_presets'));
        add_filter('wpsstm_wizard_service_links',array(__class__,'register_bbc_service_links'));
    }
    static function register_bbc_presets($presets){
        $presets[] = new WPSSTM_BBC_Station_Preset();
        $presets[] = new WPSSTM_BBC_Playlist_Preset();
        return $presets;
    }

    static function register_bbc_service_links($links){
        $item = sprintf('<a href="https://www.bbc.co.uk" target="_blank" title="%s"><img src="%s" /></a>',__('BBC stations & playlists','wpsstm'),wpsstm()->plugin_url . '_inc/img/bbc-icon.png');
        $links[] = $item;
        return $links;
        
    }
}

class WPSSTM_BBC_Station_Preset extends WPSSTM_Remote_Tracklist{
    var $station_slug;

    function __construct($url = null,$options = null) {
        
        $this->preset_options = array(
            'selectors' => array(
                'tracks'            => array('path'=>'.music-track'),
                'track_artist'      => array('path'=>'.music-track__artist'),
                'track_title'       => array('path'=>'.music-track__title'),
                'track_image'       => array('path'=>'.music-track__image','attr'=>'src')
            )
        );
        
        parent::__construct($url,$options);
        
    }
    
    function init_url($url){
        $this->station_slug = $this->get_station_slug($url);
        return $this->station_slug;
    }
    
    function get_station_slug($url){
        $pattern = '~^https?://(?:www.)?bbc.co.uk/(?!music)([^/]+)~i';
        preg_match($pattern, $url, $matches);
        return isset($matches[1]) ? $matches[1] : null;
    }

    function get_remote_request_url(){
        return sprintf( 'https://www.bbc.co.uk/music/tracks/find/%s',$this->station_slug );
    }    
}
class WPSSTM_BBC_Playlist_Preset extends WPSSTM_Remote_Tracklist{
    
    var $playlist_id;
    
    function __construct($url = null,$options = null) {
        
        $this->preset_options = array(
            'selectors' => array(
                'tracks'            => array('path'=>'ul.plr-playlist-trackslist li'),
                'track_artist'      => array('path'=>'.plr-playlist-trackslist-track-name-artistlink'),
                'track_title'       => array('path'=>'.plr-playlist-trackslist-track-name-title'),
            )
        );
        
        parent::__construct($url,$options);
        
    }
    
    function init_url($url){
        $this->playlist_id = $this->get_playlist_id($url);
        return $this->playlist_id;
    }

    function get_playlist_id($url){
        $pattern = '~^https?://(?:www.)?bbc.co.uk/music/playlists/([^/]+)~i';
        preg_match($pattern,$url,$matches);
        return isset($matches[1]) ? $matches[1] : null;
    }

}

function wpsstm_BBC_init(){
    new WPSSTM_BBC();
}

add_action('wpsstm_load_services','wpsstm_BBC_init');