<?php
$mkdf_search_holder_params = holmes_mkdf_get_holder_params_search();
?>
<?php get_header(); ?>
<?php holmes_mkdf_get_title(); ?>
<?php do_action('holmes_mkdf_before_main_content'); ?>
	<div class="<?php echo esc_attr( $mkdf_search_holder_params['holder'] ); ?>">
		<?php do_action( 'holmes_mkdf_after_container_open' ); ?>
		<div class="<?php echo esc_attr( $mkdf_search_holder_params['inner'] ); ?>">
			<?php holmes_mkdf_get_search_page(); ?>
		</div>
		<?php do_action( 'holmes_mkdf_before_container_close' ); ?>
	</div>
<?php get_footer(); ?>