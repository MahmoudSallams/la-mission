<?php

if ( post_password_required() ) {
	echo get_the_password_form();
} else {
	$excerpt_length = isset( $params['excerpt_length'] ) ? $params['excerpt_length'] : '';
	$excerpt        = holmes_mkdf_excerpt( $excerpt_length );
	
	$link_page_exists = apply_filters( 'holmes_mkdf_single_links_exists', '' );
	
	if ( ! empty( $excerpt ) && empty( $link_page_exists ) ) { ?>
		<div class="mkdf-post-excerpt-holder">
			<p itemprop="description" class="mkdf-post-excerpt">
				<?php echo wp_kses_post( $excerpt ); ?>
			</p>
		</div>
	<?php }
} ?>