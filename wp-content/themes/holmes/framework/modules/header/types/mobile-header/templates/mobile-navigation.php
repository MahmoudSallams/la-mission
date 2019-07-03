<?php do_action('holmes_mkdf_before_mobile_navigation'); ?>
<?php if ( has_nav_menu( 'mobile-navigation' ) || has_nav_menu( 'main-navigation' ) ) { ?>
<nav class="mkdf-mobile-nav" role="navigation" aria-label="<?php esc_attr_e( 'Mobile Menu', 'holmes' ); ?>">
    <div class="mkdf-grid">
        <?php
        // Set main navigation menu as mobile if mobile navigation is not set
        $theme_location = has_nav_menu( 'mobile-navigation' ) ? 'mobile-navigation' : 'main-navigation';
        wp_nav_menu(array(
            'theme_location' => $theme_location,
            'container'  => '',
            'container_class' => '',
            'menu_class' => '',
            'menu_id' => '',
            'fallback_cb' => 'top_navigation_fallback',
            'link_before' => '<span>',
            'link_after' => '</span>',
            'walker' => new HolmesMkdfMobileNavigationWalker()
        )); ?>
    </div>
</nav>
<?php } ?>
<?php do_action('holmes_mkdf_after_mobile_navigation'); ?>
