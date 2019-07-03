<div class="mkdf-container">
    <div class="mkdf-container-inner clearfix">
		<?php do_action( 'mkdf_themename_after_portfolio_container_inner_open' ); ?>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div class="mkdf-portfolio-single-holder <?php echo esc_attr( $holder_classes ); ?>">
				<?php if ( post_password_required() ) {
					echo get_the_password_form();
				} else {
					do_action( 'holmes_mkdf_portfolio_page_before_content' );

					holmes_core_get_cpt_single_module_template_part( 'templates/single/layout-collections/' . $item_layout, 'portfolio', '', $params );

					do_action( 'holmes_mkdf_portfolio_page_after_content' );

					holmes_core_get_cpt_single_module_template_part( 'templates/single/parts/back-to-link', 'portfolio', $item_layout );

					holmes_core_get_cpt_single_module_template_part( 'templates/single/parts/comments', 'portfolio' );
				} ?>
            </div>
		<?php endwhile; endif; ?>
    </div>
</div>