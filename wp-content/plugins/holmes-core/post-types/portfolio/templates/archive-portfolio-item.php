<?php
get_header();
holmes_mkdf_get_title();
do_action( 'holmes_mkdf_before_main_content' ); ?>
<div class="mkdf-container mkdf-default-page-template">
	<?php do_action( 'holmes_mkdf_after_container_open' ); ?>
	<div class="mkdf-container-inner clearfix">
		<?php
			$holmes_taxonomy_id   = get_queried_object_id();
			$holmes_taxonomy_type = is_tax( 'portfolio-tag' ) ? 'portfolio-tag' : 'portfolio-category';
			$holmes_taxonomy      = ! empty( $holmes_taxonomy_id ) ? get_term_by( 'id', $holmes_taxonomy_id, $holmes_taxonomy_type ) : '';
			$holmes_taxonomy_slug = ! empty( $holmes_taxonomy ) ? $holmes_taxonomy->slug : '';
			$holmes_taxonomy_name = ! empty( $holmes_taxonomy ) ? $holmes_taxonomy->taxonomy : '';
			
			holmes_core_get_archive_portfolio_list( $holmes_taxonomy_slug, $holmes_taxonomy_name );
		?>
	</div>
	<?php do_action( 'holmes_mkdf_before_container_close' ); ?>
</div>
<?php get_footer(); ?>
