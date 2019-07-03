<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="mkdf-search-cover" method="get">
    <div class="mkdf-search-cover-inner">
		<?php if ( $search_in_grid ) { ?>
        <div class="mkdf-container">
            <div class="mkdf-container-inner clearfix">
				<?php } ?>
                <div class="mkdf-form-holder-outer">
                    <div class="mkdf-form-holder">
                        <div class="mkdf-form-holder-inner">
                            <input type="text" placeholder="<?php esc_attr_e( 'Type Your search and tap Enter', 'holmes' ); ?>" name="s" class="mkdf_search_field" autocomplete="off"/>
                            <a <?php holmes_mkdf_class_attribute( $search_close_icon_class ); ?> href="#">
								<?php echo holmes_mkdf_get_icon_sources_html( 'search', true, array( 'search' => 'yes' ) ); ?>
                            </a>
                        </div>
                    </div>
                </div>
				<?php if ( $search_in_grid ) { ?>
            </div>
        </div>
	<?php } ?>
    </div>
</form>