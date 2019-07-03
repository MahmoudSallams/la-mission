<?php do_action( 'holmes_mkdf_after_sticky_header' ); ?>

    <div class="mkdf-sticky-header">
		<?php do_action( 'holmes_mkdf_after_sticky_menu_html_open' ); ?>
        <div class="mkdf-sticky-holder">
			<?php if ( $sticky_header_in_grid ) : ?>
            <div class="mkdf-grid">
				<?php endif; ?>
                <div class=" mkdf-vertical-align-containers">
                    <div class="mkdf-position-left">
                        <div class="mkdf-position-left-inner">
							<?php if ( ! $hide_logo ) {
								holmes_mkdf_get_logo( 'sticky' );
							} ?>
							<?php holmes_mkdf_get_sticky_menu( 'mkdf-sticky-nav' ); ?>
                        </div>
                    </div>
                    <div class="mkdf-position-right"><!--
                 -->
                        <div class="mkdf-position-right-inner">

							<?php holmes_mkdf_get_sticky_header_widget_menu_area(); ?>

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
				<?php if ( $sticky_header_in_grid ) : ?>
            </div>
		<?php endif; ?>
        </div>
    </div>

<?php do_action( 'holmes_mkdf_after_sticky_header' ); ?>