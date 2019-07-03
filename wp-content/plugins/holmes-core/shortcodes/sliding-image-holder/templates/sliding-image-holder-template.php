<div class="mkdf-sliding-image-holder">
	<div class="mkdf-sih-image-holder" style="background-image:url(<?php echo wp_get_attachment_url($image); ?>)">
		<img class="mkdf-sliding-image-background-image" src="<?php echo wp_get_attachment_url($image); ?>" alt="<?php esc_html_e('Sliding Image', 'holmes-core') ?>" />
		<img class="mkdf-sliding-image-background-image mkdf-aux-background-image" src="<?php echo wp_get_attachment_url($image); ?>" alt="<?php esc_html_e('Sliding Image', 'holmes-core') ?>" />
	</div>
	<?php echo do_shortcode($content); ?>
</div>