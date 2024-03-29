<?php
/*
Template Name: Full Width Template
*/
?>
<?php
$mkdf_sidebar_layout = holmes_mkdf_sidebar_layout();

get_header();
holmes_mkdf_get_title();
get_template_part( 'slider' );
do_action('holmes_mkdf_before_main_content');
?>

<div class="mkdf-full-width">
    <?php do_action( 'holmes_mkdf_after_container_open' ); ?>
	<div class="mkdf-full-width-inner">
        <?php do_action( 'holmes_mkdf_after_container_inner_open' ); ?>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="mkdf-grid-row">
				<div <?php echo holmes_mkdf_get_content_sidebar_class(); ?>>
					<?php
						the_content();
						do_action( 'holmes_mkdf_page_after_content' );
					?>
				</div>
				<?php if ( $mkdf_sidebar_layout !== 'no-sidebar' ) { ?>
					<div <?php echo holmes_mkdf_get_sidebar_holder_class(); ?>>
						<?php get_sidebar(); ?>
					</div>
				<?php } ?>
			</div>
		<?php endwhile; endif; ?>
        <?php do_action( 'holmes_mkdf_before_container_inner_close' ); ?>
	</div>

    <?php do_action( 'holmes_mkdf_before_container_close' ); ?>
</div>

<?php get_footer(); ?>