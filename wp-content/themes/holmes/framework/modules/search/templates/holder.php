<div class="mkdf-grid-row">
	<div <?php echo holmes_mkdf_get_content_sidebar_class(); ?>>
		<div class="mkdf-search-page-holder">
			<?php holmes_mkdf_get_search_page_layout(); ?>
		</div>
		<?php do_action( 'holmes_mkdf_page_after_content' ); ?>
	</div>
	<?php if ( $sidebar_layout !== 'no-sidebar' ) { ?>
		<div <?php echo holmes_mkdf_get_sidebar_holder_class(); ?>>
			<?php get_sidebar(); ?>
		</div>
	<?php } ?>
</div>