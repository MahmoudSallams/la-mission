<?php do_action( 'holmes_mkdf_before_mobile_header' ); ?>

    <header class="mkdf-mobile-header">
		<?php do_action( 'holmes_mkdf_after_mobile_header_html_open' ); ?>

        <div class="mkdf-mobile-header-inner">
            <div class="mkdf-mobile-header-holder">
                <div class="mkdf-grid">
                    <div class="mkdf-vertical-align-containers">


                        <div class="mkdf-position-left"><!--
						 -->
                            <div class="mkdf-position-left-inner">
								<?php holmes_mkdf_get_mobile_logo(); ?>
                            </div>
                        </div>


                        <div class="mkdf-position-right"><!--
						 -->
                            <div class="mkdf-position-right-inner">
								<?php //if ( is_active_sidebar( 'mkdf-right-from-mobile-logo' ) ) {
								//	dynamic_sidebar( 'mkdf-right-from-mobile-logo' );
								//} ?>

								<?php if ( $show_navigation_opener ) : ?>

                                    <a href="javascript:void(0)" <?php holmes_mkdf_class_attribute( $mobile_icon_class ); ?>>
        									<span class="mkdf-mobile-menu-icon">
		        								<?php echo holmes_mkdf_get_icon_sources_html( 'mobile' ); ?>
				        					</span>
										<?php //if ( ! empty( $mobile_menu_title ) ) { ?>
                                        <!--    <h5 class="mkdf-mobile-menu-text">--><?php //echo esc_attr( $mobile_menu_title ); ?><!--</h5>-->
										<?php //} ?>
                                    </a>

								<?php endif; ?>

                            </div>
                        </div>


                    </div>

                </div>
            </div>
			<?php holmes_mkdf_get_mobile_nav(); ?>
        </div>

		<?php do_action( 'holmes_mkdf_before_mobile_header_html_close' ); ?>
    </header>

<?php do_action( 'holmes_mkdf_after_mobile_header' ); ?>