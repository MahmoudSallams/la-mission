<?php
if ( ! function_exists( 'holmes_core_add_masonry_gallery_shortcode' ) ) {
    function holmes_core_add_masonry_gallery_shortcode( $shortcodes_class_name ) {
        $shortcodes = array(
            'HolmesCore\CPT\Shortcodes\MasonryGallery\MasonryGallery'
        );

        $shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );

        return $shortcodes_class_name;
    }

    add_filter( 'holmes_core_filter_add_vc_shortcode', 'holmes_core_add_masonry_gallery_shortcode' );
}

if ( ! function_exists( 'holmes_core_set_masonry_gallery_icon_class_name_for_vc_shortcodes' ) ) {
    /**
     * Function that set custom icon class name for masonry gallery shortcodes to set our icon for Visual Composer shortcodes panel
     */
    function holmes_core_set_masonry_gallery_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
        $shortcodes_icon_class_array[] = '.icon-wpb-masonry-gallery';

        return $shortcodes_icon_class_array;
    }

    add_filter( 'holmes_core_filter_add_vc_shortcodes_custom_icon_class', 'holmes_core_set_masonry_gallery_icon_class_name_for_vc_shortcodes' );
}