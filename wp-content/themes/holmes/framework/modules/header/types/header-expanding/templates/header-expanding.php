<?php do_action( 'holmes_mkdf_before_page_header' ); ?>

<header class="mkdf-page-header">
	<?php if ( $show_fixed_wrapper ) : ?>
    <div class="mkdf-fixed-wrapper">
		<?php endif; ?>
        <div class="mkdf-menu-area">
			<?php do_action( 'holmes_mkdf_after_header_menu_area_html_open' ) ?>
			<?php if ( $menu_area_in_grid ) : ?>
            <div class="mkdf-grid">
				<?php endif; ?>
                <div class="mkdf-vertical-align-containers">
                    <div class="mkdf-position-left">
                        <div class="mkdf-position-left-inner">
							<?php if ( ! $hide_logo ) {
								holmes_mkdf_get_logo();
							} ?>
							<?php holmes_mkdf_get_main_menu(); ?>
                        </div>
                    </div>
                    <div class="mkdf-position-right"><!--
				 -->
                        <div class="mkdf-position-right-inner">

							<?php holmes_mkdf_get_header_widget_area_one(); ?>

                            <a href="javascript:void(0)" <?php holmes_mkdf_class_attribute( $fullscreen_menu_icon_class ); ?>>
							<span class="mkdf-fullscreen-menu-close-icon">
								<?php echo holmes_mkdf_get_icon_sources_html( 'fullscreen_menu', true ); ?>
							</span>
                                <span class="mkdf-fullscreen-menu-opener-icon">
                                <?php echo holmes_mkdf_get_icon_sources_html( 'fullscreen_menu' ); ?>
							</span>
                            </a>
                        </div>
                    </div>
                </div>
				<?php if ( $menu_area_in_grid ) : ?>
            </div>
		<?php endif; ?>
        </div>
		<?php if ( $show_fixed_wrapper ) { ?>
		<?php do_action( 'holmes_mkdf_end_of_page_header_html' ); ?>
    </div>
<?php } else {
	do_action( 'holmes_mkdf_end_of_page_header_html' );
} ?>
	<?php if ( $show_sticky ) {
		holmes_mkdf_get_sticky_header( 'expanding', 'header/types/header-expanding' );
	} ?>
	<?php do_action( 'holmes_mkdf_before_page_header_html_close' ); ?>
</header>
<?php //do_action( 'holmes_mkdf_after_page_header' ); ?>

