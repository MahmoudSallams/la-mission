<?php
$image_meta = get_post_meta( get_the_ID(), 'mkdf_blog_list_featured_image_meta', true );
$image_meta = $image_meta ?: get_the_post_thumbnail_url();
?>
<li class="mkdf-bl-item mkdf-item-space">
    <div class="mkdf-bli-inner">
        <a href="<?php echo get_the_permalink(); ?>" class="mkdf-bli-link"></a>
        <div class="mkdf-post-image" style="background-image: url('<?php echo esc_attr( $image_meta ); ?>')"></div>
        <div class="mkdf-bli-content">
            <div class="mkdf-bli-info">
				<?php
				holmes_mkdf_get_module_template_part( 'templates/parts/title', 'blog', '', $params );
				holmes_mkdf_get_module_template_part( 'templates/parts/post-info/date', 'blog', 'shortcode', $params );
				holmes_mkdf_get_module_template_part( 'templates/parts/post-info/category', 'blog', 'shortcode', $params );
				?>
            </div>
        </div>
        <div class="mkdf-bli-btn">
			<?php

			$button_params['link'] = get_the_permalink();
			$button_params['text'] = esc_html__( 'Read the full post', 'holmes' );

			echo holmes_mkdf_return_button_html( $button_params );

			?>
        </div>
    </div>
</li>