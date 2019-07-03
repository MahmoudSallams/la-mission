<section class="mkdf-side-menu">
    <a <?php holmes_mkdf_class_attribute( $close_icon_classes ); ?> href="#">
        <span>
    		<?php echo holmes_mkdf_get_icon_sources_html( 'side_area', true ); ?>
        </span>
    </a>
	<?php if ( is_active_sidebar( 'sidearea' ) ) {
		dynamic_sidebar( 'sidearea' );
	} ?>
</section>