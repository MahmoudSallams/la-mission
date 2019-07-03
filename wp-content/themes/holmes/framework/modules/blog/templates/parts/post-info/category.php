<div class="mkdf-post-info-category">

	<?php if ( ! empty( $source ) ): ?>
        <span><?php esc_html_e( 'Categorized in:', 'holmes' ); ?></span>
	<?php else: ?>
        <span><?php esc_html_e( 'In:', 'holmes' ); ?></span>
	<?php endif; ?>

	<?php the_category( ', ' ); ?>
</div>