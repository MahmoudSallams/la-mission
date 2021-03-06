<?php

class WPSSTM_Core_User{

    var $user_id;
    var $favorites_id;
    var $can_subtracks;
    
    static $favorites_tracklist_usermeta_key = 'wpsstm_favorites_tracklist_id';
    static $loved_tracklist_meta_key = 'wpsstm_user_favorite';

    function __construct($user_id = null){
        if (!$user_id) $user_id = get_current_user_id();

        if ($user_id){
            $this->user_id = $user_id;
            $this->can_subtracks = $this->can_manage_static_tracklists();
            $this->favorites_id = self::get_user_favorites_id($this->user_id);
            
            //create the favorites tracklist if it does not exists
            if (!$this->favorites_id){
                $favorites_id = self::create_user_favorites_tracklist($this->user_id);
                if ( !is_wp_error($favorites_id) ){
                    $this->favorites_id = $favorites_id;
                }
            }
        }
    }

    /*
    Get the ID of the favorites tracklist for a user, or create it and store option
    */
    
    public static function get_user_favorites_id($user_id = null){
        if (!$user_id) $user_id = get_current_user_id();
        if (!$user_id) return;

        $love_id = get_user_option( self::$favorites_tracklist_usermeta_key, $user_id );
        
        //usermeta exists but tracklist does not
        if ( $love_id && !get_post_type($love_id) ){
            delete_user_option( $user_id, self::$favorites_tracklist_usermeta_key );
            $love_id = null;
        }

        return $love_id;
        
    }
    
    
    /*
    create new tracklist
    */
    private static function create_user_favorites_tracklist($user_id = null){
        
        if (!$user_id) $user_id = get_current_user_id();
        if (!$user_id) return;

        //capability check
        $post_type_obj = get_post_type_object(wpsstm()->post_type_playlist);
        $required_cap = $post_type_obj->cap->create_posts;
        if ( !current_user_can($required_cap) ){
            return new WP_Error( 'wpsstm_track_no_edit_cap', __("You don't have the capability required to create tracklists.",'wpsstm') );
        }

        //user
        $user_info = get_userdata($user_id);

        $playlist_new_args = array(
            'post_type'     => wpsstm()->post_type_playlist,
            'post_status'   => 'publish',
            'post_author'   => $user_id,
            'post_title'    => sprintf(__("%s's favorites tracks",'wpsstm'),$user_info->user_login)
        );

        $success = wp_insert_post( $playlist_new_args, true );
        if ( is_wp_error($success) ) return $success;

        $love_id = $success;
        $meta = update_user_option( $user_id, self::$favorites_tracklist_usermeta_key, $love_id);

        //add to favorites
        $tracklist = new WPSSTM_Post_Tracklist($love_id);
        $tracklist->love_tracklist(true);

        wpsstm()->debug_log(array('user_id'=>$user_id,'post_id'=>$love_id,'meta'=>$meta),'created favorites tracklist');
        
        return $love_id;
    }
    
    private function can_manage_static_tracklists(){

        $can = false;
        $post_types = wpsstm()->static_tracklist_post_types;
        foreach ($post_types as $post_type){
            if ( !$post_type_obj = get_post_type_object($post_type) ) continue;
            $can = user_can( $this->user_id, $post_type_obj->cap->edit_posts);
            if ( $can ) break;
        }

        return $can;
    }

}

function wpsstm_user_init(){
    wpsstm()->user = new WPSSTM_Core_User();
}

add_action('init','wpsstm_user_init'); //when user is ready