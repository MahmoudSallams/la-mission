<?php
/*
Plugin Name: WP SoundSystem
Description: Manage a music library within Wordpress; including playlists, tracks, artists, albums and radios.  The perfect fit for your music blog !
Plugin URI: https://api.spiff-radio.org
Author: G.Breant
Author URI: https://github.com/gordielachance
Version: 2.5.8
License: GPL2
*/

define("WPSSTM_BASE_SLUG", "music");

define("WPSSTM_LIVE_PLAYLISTS_SLUG", "radios");
define("WPSSTM_LIVE_PLAYLIST_SLUG", "radio");
define("WPSSTM_PLAYLISTS_SLUG", "playlists");
define("WPSSTM_PLAYLIST_SLUG", "playlist");
define("WPSSTM_ARTISTS_SLUG", "artists");
define("WPSSTM_ARTIST_SLUG", "artist");
define("WPSSTM_ALBUMS_SLUG", "albums");
define("WPSSTM_ALBUM_SLUG", "album");
define("WPSSTM_TRACKS_SLUG", "tracks");
define("WPSSTM_TRACK_SLUG", "track");
define("WPSSTM_SUBTRACKS_SLUG", "subtracks");
define("WPSSTM_SUBTRACK_SLUG", "subtrack");
define("WPSSTM_SOURCES_SLUG", "sources");
define("WPSSTM_SOURCE_SLUG", "source");

define("WPSSTM_NEW_ITEM_SLUG", "new");
define("WPSSTM_MANAGER_SLUG", "manager");

class WP_SoundSystem {
    /** Version ***************************************************************/
    /**
    * @public string plugin version
    */
    public $version = '2.5.8';
    /**
    * @public string plugin DB version
    */
    public $db_version = '201';
    /** Paths *****************************************************************/
    public $file = '';
    /**
    * @public string Basename of the plugin directory
    */
    public $basename = '';
    /**
    * @public string Absolute path to the plugin directory
    */
    public $plugin_dir = '';

    public $post_type_album = 'wpsstm_release';
    public $post_type_artist = 'wpsstm_artist';
    public $post_type_track = 'wpsstm_track';
    public $post_type_source = 'wpsstm_source';
    public $post_type_playlist = 'wpsstm_playlist';
    public $post_type_live_playlist = 'wpsstm_live_playlist';
    
    public $tracklist_post_types = array('wpsstm_playlist'); //radios & albums could be appened to this
    public $static_tracklist_post_types = array('wpsstm_playlist','wpsstm_release'); //radios & albums could be appened to this

    public $subtracks_table_name = 'wpsstm_subtracks';
    public $user;

    public $meta_name_options = 'wpsstm_options';
    
    var $menu_page;
    var $options = array();
    var $details_engine;
    
    /**
    * @var The one true Instance
    */
    private static $instance;

    public static function instance() {
        
            if ( ! isset( self::$instance ) ) {
                    self::$instance = new WP_SoundSystem;
                    self::$instance->setup_globals();
                    self::$instance->includes();
                    self::$instance->setup_actions();
            }
            return self::$instance;
    }
    /**
    * A dummy constructor to prevent plugin from being loaded more than once.
    */
    private function __construct() { /* Do nothing here */ }
    
    function setup_globals() {
        
        /** Paths *************************************************************/
        $this->file       = __FILE__;
        $this->basename   = plugin_basename( $this->file );
        $this->plugin_dir = plugin_dir_path( $this->file );
        $this->plugin_url = plugin_dir_url ( $this->file );

        $options_default = array(
            'frontend_scraper_page_id'          => null,
            'recent_wizard_entries'             => get_option( 'posts_per_page' ),
            'community_user_id'                 => null,
            'ajax_load_tracklists'              => true,
            'autosource'                        => true,
            'limit_autosources'                 => 5,
            'importer_enabled'                  => true,
            'radios_enabled'                    => true,
            'registration_notice'               => true,
            'wpsstmapi_token'                   => null,
            'details_engine'                    => array('musicbrainz'),
        );
        
        $db_option = get_option( $this->meta_name_options);
        $this->options = wp_parse_args($db_option,$options_default);
        
    }
    
    function includes(){
        
        require_once(wpsstm()->plugin_dir . '_inc/php/autoload.php'); // PHP dependencies (last.fm, scraper, etc.)
        
        require $this->plugin_dir . 'wpsstm-templates.php';
        require $this->plugin_dir . 'wpsstm-functions.php';
        require $this->plugin_dir . 'wpsstm-settings.php';
        require $this->plugin_dir . 'wpsstm-core-artists.php';
        require $this->plugin_dir . 'wpsstm-core-albums.php';
        require $this->plugin_dir . 'wpsstm-core-tracks.php';
        require $this->plugin_dir . 'wpsstm-core-sources.php';
        require $this->plugin_dir . 'wpsstm-core-tracklists.php';
        require $this->plugin_dir . 'wpsstm-core-playlists.php';
        require $this->plugin_dir . 'wpsstm-core-user.php';
        require $this->plugin_dir . 'wpsstm-core-buddypress.php';
        require $this->plugin_dir . 'wpsstm-core-api.php';
        require $this->plugin_dir . 'classes/wpsstm-music-details.php';

        if ( WPSSTM_Core_API::can_wpsstmapi() === true ){
            require $this->plugin_dir . 'wpsstm-core-importer.php';
        }

        require $this->plugin_dir . 'wpsstm-core-playlists-live.php';
        require $this->plugin_dir . 'classes/wpsstm-track-class.php';
        require $this->plugin_dir . 'classes/wpsstm-tracklist-class.php';
        require $this->plugin_dir . 'classes/wpsstm-source-class.php';
        require $this->plugin_dir . 'classes/wpsstm-player-class.php';
        require $this->plugin_dir . 'classes/wpsstm-remote-datas.php';
        
        //include APIs/services stuff (lastfm,youtube,spotify,etc.)
        $this->load_services();
    }
    
    /*
    Register scraper presets.
    */
    private function load_services(){
        
        $presets = array();

        $presets_path = trailingslashit( wpsstm()->plugin_dir . 'classes/services' );

        //get all files in /presets directory
        $preset_files = glob( $presets_path . '*.php' ); 

        foreach ($preset_files as $file) {
            require_once($file);
        }
        
        do_action('wpsstm_load_services');
    }
    
    function setup_actions(){
        // activation, deactivation...
        register_activation_hook( $this->file, array( $this, 'activate_wpsstm'));
        register_deactivation_hook( $this->file, array( $this, 'deactivate_wpsstm'));
        add_action( 'plugins_loaded', array($this, 'upgrade'));
        add_action( 'plugins_loaded', array($this, 'startup_check_options'));
        
        //init
        add_action( 'init', array($this,'init_post_types'), 5);
        add_action( 'init', array($this,'init_rewrite'), 5);
        add_action( 'init', array($this,'save_music_details_engines'));
        add_action( 'admin_init', array($this,'load_textdomain'));
        

        add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts_styles' ), 9 );
        add_action( 'admin_enqueue_scripts', array( $this, 'register_scripts_styles' ), 9 );

        add_action('edit_form_after_title', array($this,'metabox_reorder'));
        
        add_action( 'all_admin_notices', array($this, 'promo_notice'), 5 );
        
        add_filter( 'query_vars', array($this,'add_wpsstm_query_vars'));
        
        

        do_action('wpsstm_init');

    }

    function add_wpsstm_query_vars($qvars){
        $qvars[] = 'wpsstm_action';
        return $qvars;
    }

    // Move all "after_title" metaboxes above the default editor
    function metabox_reorder(){
        global $post, $wp_meta_boxes;
        do_meta_boxes(get_current_screen(), 'after_title', $post);
        unset($wp_meta_boxes[get_post_type($post)]['after_title']);
    }

    function load_textdomain() {
        load_plugin_textdomain( 'wpsstm', false, $this->plugin_dir . '/languages' );
    }
	
    function activate_wpsstm() {
        $this->debug_log('activation');
        $this->add_custom_capabilites();
    }
    
    function init_post_types(){
        //$this->debug_log('init post types');
        do_action('wpsstm_init_post_types');
    }
    
    /*
    Hook for rewrite rules.
    */
    function init_rewrite(){
        //$this->debug_log('set rewrite rules');

        do_action('wpsstm_init_rewrite');
        
        flush_rewrite_rules();
    }
    
    function save_music_details_engines(){
        $enabled_engine_slugs = wpsstm()->get_options('details_engine');
        $available_engines = wpsstm()->get_available_detail_engines();

        foreach((array)$available_engines as $engine){
            if ( !in_array($engine->slug,$enabled_engine_slugs) ) continue;
            $engine->setup_actions();
            $this->details_engine = $engine;
                
            break;//TOUFIX at the end we should be able to populate several details engines
        }
    }

    function deactivate_wpsstm() {
        $this->debug_log('deactivation');
        $this->remove_custom_capabilities();
        flush_rewrite_rules();
    }

    function upgrade(){
        global $wpdb;

        $current_version = get_option("_wpsstm-db_version");

        if ($current_version==$this->db_version) return false;
        if(!$current_version){ //not installed

            $this->setup_subtracks_table();

        }else{
            
            if($current_version < 151){ //rename old source URL metakeys

                $querystr = $wpdb->prepare( "UPDATE $wpdb->postmeta SET meta_key = '%s' WHERE meta_key = '%s'", WPSSTM_Core_Sources::$source_url_metakey, '_wpsstm_source' );

                $result = $wpdb->get_results ( $querystr );
                
            }
            
            if($current_version < 154){ //delete artist/album/track post title (we don't use them anymore)

                $querystr = $wpdb->prepare( "UPDATE $wpdb->posts SET post_title = '' WHERE post_type = '%s' OR post_type = '%s' OR post_type = '%s' ", $this->post_type_album,$this->post_type_artist,$this->post_type_track );

                $result = $wpdb->get_results ( $querystr );
                
            }

            if ($current_version < 155){
                $this->setup_subtracks_table();
                $this->migrate_subtracks();
            }
            
            if ($current_version < 156){
                
                //delete source provider slug metakey, now computed dynamically
                $querystr = $wpdb->prepare( "DELETE FROM $wpdb->postmeta WHERE meta_key = '%s'", '_wpsstm_source_provider' );
                $result = $wpdb->get_results ( $querystr );
                
                //delete source stream URL metakey, now computed dynamically
                $querystr = $wpdb->prepare( "DELETE FROM $wpdb->postmeta WHERE meta_key = '%s'", '_wpsstm_source_stream' );
                $result = $wpdb->get_results ( $querystr );
                
            }
            
            //tracks seconds > milliseconds
            if ($current_version < 157){
                $querystr = $wpdb->prepare( "UPDATE $wpdb->postmeta SET meta_key = '%s', meta_value = meta_value * 1000 WHERE meta_key = '%s'", WPSSTM_Core_Tracks::$length_metakey, '_wpsstm_length' );

                $result = $wpdb->get_results ( $querystr );
            }
            
            if ($current_version < 158){
                //update subtracks table
                $subtracks_table = $wpdb->prefix . $this->subtracks_table_name;
                $wpdb->query("ALTER TABLE $subtracks_table ADD artist longtext NOT NULL");
                $wpdb->query("ALTER TABLE $subtracks_table ADD title longtext NOT NULL");
                $wpdb->query("ALTER TABLE $subtracks_table ADD album longtext NULL");
            }
            if ($current_version < 160){
                $subtracks_table = $wpdb->prefix . $this->subtracks_table_name;
                $wpdb->query("ALTER TABLE $subtracks_table ADD time datetime NOT NULL DEFAULT '0000-00-00 00:00:00'");
                $wpdb->query("ALTER TABLE $subtracks_table ADD from_tracklist bigint(20) UNSIGNED NULL");
            }
            
            if ($current_version < 201){
                //
                $querystr = $wpdb->prepare( "UPDATE $wpdb->postmeta SET meta_key = '%s' WHERE meta_key = '%s'",'_wpsstm_details_musicbrainz_id', '_wpsstm_mbid' );
                $result = $wpdb->get_results ( $querystr );
                //
                $querystr = $wpdb->prepare( "UPDATE $wpdb->postmeta SET meta_key = '%s' WHERE meta_key = '%s'",'_wpsstm_details_musicbrainz_data', '_wpsstm_mbdata' );
                $result = $wpdb->get_results ( $querystr );
                //
                $querystr = $wpdb->prepare( "UPDATE $wpdb->postmeta SET meta_key = '%s' WHERE meta_key = '%s'",'_wpsstm_details_musicbrainz_time', '_wpsstm_mbdata_time' );
                $result = $wpdb->get_results ( $querystr );

                //
                $querystr = $wpdb->prepare( "UPDATE $wpdb->postmeta SET meta_key = '%s'  WHERE meta_key = '%s'",'_wpsstm_details_spotify_id', '_wpsstm_spotify_id' );
                $result = $wpdb->get_results ( $querystr );
                //
                $querystr = $wpdb->prepare( "UPDATE $wpdb->postmeta SET meta_key = '%s' WHERE meta_key = '%s'",'_wpsstm_details_spotify_data', '_wpsstm_spotify_data' );
                $result = $wpdb->get_results ( $querystr );
                //
                $querystr = $wpdb->prepare( "UPDATE $wpdb->postmeta SET meta_key = '%s' WHERE meta_key = '%s'",'_wpsstm_details_spotify_time', '_wpsstm_spotify_data_time' );
                $result = $wpdb->get_results ( $querystr );
            }

        }
        
        //update DB version
        update_option("_wpsstm-db_version", $this->db_version );
    }
    
    function startup_check_options(){
        
        //community user
        if ( !$user_id = $this->get_options('community_user_id') ) return;
        if ( !$userdatas = get_userdata($user_id) ) {
            $this->options['community_user_id'] = null;
        }
    }
    
    function setup_subtracks_table(){
        global $wpdb;

        $subtracks_table = $wpdb->prefix . $this->subtracks_table_name;
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $subtracks_table (
            ID bigint(20) NOT NULL AUTO_INCREMENT,
            track_id bigint(20) UNSIGNED NOT NULL DEFAULT '0',
            tracklist_id bigint(20) UNSIGNED NOT NULL DEFAULT '0',
            from_tracklist bigint(20) UNSIGNED NULL,
            track_order int(11) NOT NULL DEFAULT '0',
            artist longtext NOT NULL,
            title longtext NOT NULL,
            album longtext NULL,
            time datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
            PRIMARY KEY  (ID)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        return dbDelta( $sql );
    }
    
    /*
    Migrate old subtracks (stored in tracklist posts metas) to the new subtracks table
    Can be removed after a few months once the plugin has been updated.
    */
    function migrate_subtracks(){
        global $wpdb;
        
        $subtracks_table = $wpdb->prefix . $this->subtracks_table_name;
        
        //get all subtracks metas
        $querystr = $wpdb->prepare( "SELECT * FROM $wpdb->postmeta WHERE meta_key = '%s' OR meta_key = '%s'", 'wpsstm_subtrack_ids','wpsstm_live_subtrack_ids' );
        $metas = $wpdb->get_results ( $querystr );

        foreach($metas as $meta){
            $subtrack_ids = maybe_unserialize( $meta->meta_value );
            $subtrack_pos = 0;
            foreach((array)$subtrack_ids as $subtrack_id){
                $wpdb->insert($subtracks_table, array(
                    'track_id' =>       $subtrack_id,
                    'tracklist_id' =>   $meta->post_id,
                    'track_order' =>    $subtrack_pos
                ));
                
                //delete subtracks metas
                $querystr = $wpdb->prepare( "DELETE FROM $wpdb->postmeta WHERE meta_id = '%s'", $meta->meta_id );
                $wpdb->get_results ( $querystr );
                
                $subtrack_pos++;
            }
        }
    }
    
    
    function get_options($keys = null){
        return wpsstm_get_array_value($keys,$this->options);
    }
    
    private function get_registration_notice(){
        global $wp;
        
        //registration notice
        if ( is_admin() ) return;
        if ( get_current_user_id() ) return;
        if ( !wpsstm()->get_options('registration_notice') ) return;
        
        
        $redirect_url = home_url( $wp->request );
        $login_link = sprintf('<a class="wpsstm-login" href="%s">%s</a>',wp_login_url($redirect_url),__('Login','wpsstm'));
        
        
        $registration_link = sprintf('<a class="wpsstm-join" href="%s">%s</a>',wp_registration_url(),__('Join','wpsstm'));
        
        return sprintf(__('Get the best out of %s : create and manage playlists, favorite tracks, sync your account with other services, and much more. %s or %s now !','wpsstm'),sprintf('<strong>%s</strong>',get_bloginfo('name')),$login_link,$registration_link);
    }

    function register_scripts_styles(){

        //TO FIX conditional / move code ?
        
        //CSS
        wp_register_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',false,'4.7.0');
        wp_register_style( 'wpsstm', wpsstm()->plugin_url . '_inc/css/wpsstm.css',array('font-awesome'),wpsstm()->version );

        //JS
        wp_register_script( 'wpsstm-functions', $this->plugin_url . '_inc/js/wpsstm-functions.js', array('jquery'),$this->version, true);

        wp_register_script( 'wpsstm', $this->plugin_url . '_inc/js/wpsstm.js', array('jquery','wpsstm-functions','wpsstm-player','wpsstm-tracklists','jquery-ui-autocomplete','jquery-ui-dialog','jquery-ui-sortable'),$this->version, true);
        


        $datas = array(
            'debug'                 => (WP_DEBUG),
            'ajaxurl'               => admin_url( 'admin-ajax.php' ),
            'registration_notice'   => $this->get_registration_notice(),
        );

        wp_localize_script( 'wpsstm-functions', 'wpsstmL10n', $datas );
        
        //JS
        wp_enqueue_script( 'wpsstm' );
        
        //CSS
        wp_enqueue_style( 'wpsstm' );
 
    }

    /*
    Checks that we are on one of backend pages of the plugin
    */
    
    function is_admin_page(){
        
        if ( !wpsstm_is_backend() ) return;

        $screen = get_current_screen();
        $post_type = $screen->post_type;
        $allowed_post_types = array(
            wpsstm()->post_type_artist,
            wpsstm()->post_type_album,
            wpsstm()->post_type_track,
            wpsstm()->post_type_source,
            wpsstm()->post_type_playlist,
            wpsstm()->post_type_live_playlist,
        );

        $is_allowed_post_type =  ( in_array($post_type,$allowed_post_types) );
        $is_top_menu = ($screen->id == 'toplevel_page_wpsstm');

        if (!$is_allowed_post_type && !$is_top_menu) return;
        
        return true;
    }
    
    function promo_notice(){
        
        if ( !$this->is_admin_page() ) return;

        $rate_link_wp = 'https://wordpress.org/support/view/plugin-reviews/wp-soundsystem?rate#postform';
        $rate_link = '<a href="'.$rate_link_wp.'" target="_blank" href=""><i class="fa fa-star"></i> '.__('Reviewing the plugin','wpsstm').'</a>';
        $donate_link = '<a href="http://bit.ly/gbreant" target="_blank" href=""><i class="fa fa-usd"></i> '.__('make a donation','wpsstm').'</a>';
        ?>
        <div id="wpsstm-promo-notice">
            <p>
                <?php printf(__('Happy with WP SoundSystem ? %s and %s would help!','pinim'),$rate_link,$donate_link);?>
            </p>
        </div>
        <?php

    }

    public function debug_log($data,$title = null) {

        if (WP_DEBUG_LOG !== true) return false;

        $prefix = '[wpsstm] ';
        if($title) $prefix.=$title.': ';

        if (is_array($data) || is_object($data)) {
            $data = "\n" . json_encode($data,JSON_UNESCAPED_UNICODE);
        }

        error_log($prefix . $data);
    }
    
    function register_community_view($views){
        
        if ( !$user_id = $this->get_options('community_user_id') ) return $views;
        
        $screen = get_current_screen();
        $post_type = $screen->post_type;

        $link = add_query_arg( array('post_type'=>$post_type,'author'=>$user_id),admin_url('edit.php') );
        
        $attr = array(
            'href' =>   $link,
        );
        
        $author_id = isset($_REQUEST['author']) ? $_REQUEST['author'] : null;
        
        if ($author_id==$user_id){
            $attr['class'] = 'current';
        }
        
        $count = count_user_posts( $user_id , $post_type  );

        $views['community'] = sprintf('<a %s>%s <span class="count">(%d)</span></a>',wpsstm_get_html_attr($attr),__('Community','wpsstm'),$count);
        
        return $views;
    }
    
    /*
    List of capabilities and which roles should get them
    */

    function get_roles_capabilities($role_slug){

        //array('subscriber','contributor','author','editor','administrator'),
        
        $all = array(
            
            //radios
            'manage_live_playlists'     => array('editor','administrator'),
            'edit_live_playlists'       => array('contributor','author','editor','administrator'),
            'create_live_playlists'     => array('contributor','author','editor','administrator'),
            
            //playlists
            'manage_playlists'     => array('editor','administrator'),
            'edit_playlists'       => array('contributor','author','editor','administrator'),
            'create_playlists'     => array('contributor','author','editor','administrator'),
            
            //tracks
            'manage_tracks'     => array('editor','administrator'),
            'edit_tracks'       => array('contributor','author','editor','administrator'),
            'create_tracks'     => array('contributor','author','editor','administrator'),
            
            //tracks & tracks sources
            'manage_tracks'     => array('editor','administrator'),
            'edit_tracks'       => array('contributor','author','editor','administrator'),
            'create_tracks'     => array('contributor','author','editor','administrator'),
            
            //artists
            'manage_artists'     => array('editor','administrator'),
            'edit_artists'       => array('contributor','author','editor','administrator'),
            'create_artists'     => array('contributor','author','editor','administrator'),
            
            //albums
            'manage_albums'     => array('editor','administrator'),
            'edit_albums'       => array('contributor','author','editor','administrator'),
            'create_albums'     => array('contributor','author','editor','administrator'),
            
        );
        
        $role_caps = array();
        
        foreach ((array)$all as $cap=>$allowed_roles){
            if ( !in_array($role_slug,$allowed_roles) ) continue;
            $role_caps[] = $cap;
        }
        
        return $role_caps;
        
    }
    
    /*
    https://wordpress.stackexchange.com/questions/35165/how-do-i-create-a-custom-role-capability
    */
    
    function add_custom_capabilites(){

        $roles = get_editable_roles();
        foreach ($GLOBALS['wp_roles']->role_objects as $role_slug => $role) {
            if ( !isset($roles[$role_slug]) ) continue;
            $custom_caps = $this->get_roles_capabilities($role_slug);
            
            foreach($custom_caps as $caps){
                $role->add_cap($caps);
            }
            
        }

    }
    
    function remove_custom_capabilities(){
        
        $roles = get_editable_roles();
        foreach ($GLOBALS['wp_roles']->role_objects as $role_slug => $role) {
            if ( !isset($roles[$role_slug]) ) continue;
            $custom_caps = $this->get_roles_capabilities($role_slug);
            
            foreach($custom_caps as $caps){
                $role->remove_cap($caps);
            }
            
        }
        
    }
    
    static function get_notices_output($notices){
        
        $output = array();

        foreach ((array)$notices as $notice){

            $notice_classes = array(
                'inline',
                'settings-error',
                'wpsstm-notice',
                'is-dismissible'
            );
            
            //$notice_classes[] = ($notice['error'] == true) ? 'error' : 'updated';
            
            $notice_attr_arr = array(
                'id'    => sprintf('wpsstm-notice-%s',$notice['code']),
                'class' => implode(' ',$notice_classes),
            );

            $output[] = sprintf('<li %s><strong>%s</strong></li>',wpsstm_get_html_attr($notice_attr_arr),$notice['message']);
        }
        
        return implode("\n",$output);
    }

    public function can_importer(){
        //wpssstm API
        $can_wpsstm_api = WPSSTM_Core_API::can_wpsstmapi();
        if ( $can_wpsstm_api !== true ) return $can_wpsstm_api;
        
        //community user
        if ( !$user_id = wpsstm()->get_options('community_user_id') ){
            return new WP_Error( 'wpsstm_missing_community_user', __("Missing community user.",'wpsstm'));
        }
        
        return true;
        
    }
    
    public function can_radios(){
        return $this->can_importer();
    }

    public function can_frontend_importer(){
        $page_id = $this->get_options('frontend_scraper_page_id');
        
        if (!$page_id){
            return new WP_Error( 'wpsstm_missing_frontend_wizard_page', __('No frontend wizard page defined.','wpsstm'));
        }
        
        return $this->can_importer();

    }

    public function is_community_user_ready(){
        //community user
        $user_id = $this->get_options('community_user_id');
        if (!$user_id){
            return new WP_Error( 'wpsstm_missing_community_user', __("Missing community user.",'wpsstm'));
        }
        
        $tracklist_obj = get_post_type_object( wpsstm()->post_type_playlist );
        $can = user_can($user_id,$tracklist_obj->cap->edit_posts);
        
        if (!$can){
            return new WP_Error( 'wpsstm_cannot_remote_request', __("The community user requires edit capabilities.",'wpsstm'));
        }
        return true;
    }
    
    /*
    Get the list of services that could get music details
    */
    public function get_available_detail_engines(){
        return apply_filters('wpsstm_get_music_detail_engines',array());
    }

}

function wpsstm() {
	return WP_SoundSystem::instance();
}

wpsstm();
