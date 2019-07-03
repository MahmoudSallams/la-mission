<article id="post-<?php the_ID(); ?>" <?php post_class( $post_classes ); ?>>
    <div class="mkdf-post-content">
        <div class="mkdf-post-content-mark mkdf-quote-mark">
			<?php
			global $wp_filesystem;
			echo holmes_mkdf_get_clean_output( $wp_filesystem->get_contents( MIKADO_ASSETS_ROOT . '/svgs/quote.php' ) );
			?>
        </div>
        <div class="mkdf-post-text">
            <div class="mkdf-post-text-inner">
                <div class="mkdf-post-text-main">
					<?php holmes_mkdf_get_module_template_part( 'templates/parts/post-type/quote', 'blog', '', $part_params ); ?>
                </div>
                <div class="mkdf-post-info-bottom">
					<?php holmes_mkdf_get_module_template_part( 'templates/parts/post-info/category', 'blog', '', $part_params ); ?>
                </div>
            </div>
        </div>
    </div>
</article>