<?php
get_header();
holmes_mkdf_get_title();
get_template_part( 'slider' );
do_action('holmes_mkdf_before_main_content');

if ( have_posts() ) : while ( have_posts() ) : the_post();
	//Get blog single type and load proper helper
	holmes_mkdf_include_blog_helper_functions( 'singles', 'standard' );
	
	//Action added for applying module specific filters that couldn't be applied on init
	do_action( 'holmes_mkdf_blog_single_loaded' );
	
	//Get classes for holder and holder inner
	$mkdf_holder_params = holmes_mkdf_get_holder_params_blog();
	?>
	
	<div class="<?php echo esc_attr( $mkdf_holder_params['holder'] ); ?>">
		<?php do_action( 'holmes_mkdf_after_container_open' ); ?>
		
		<div class="<?php echo esc_attr( $mkdf_holder_params['inner'] ); ?>">
			<?php holmes_mkdf_get_blog_single( 'standard' ); ?>
		</div>
		
		<?php do_action( 'holmes_mkdf_before_container_close' ); ?>
	</div>
<?php endwhile; endif;

get_footer(); ?>