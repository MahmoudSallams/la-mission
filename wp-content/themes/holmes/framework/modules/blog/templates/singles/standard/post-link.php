<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="mkdf-post-content">
        <div class="mkdf-post-content-mark mkdf-link-mark">
			<?php
			global $wp_filesystem;
			echo holmes_mkdf_get_clean_output( $wp_filesystem->get_contents( MIKADO_ASSETS_ROOT . '/svgs/link.php' ) );
			?>
        </div>
        <div class="mkdf-post-text">
            <div class="mkdf-post-text-inner">
                <div class="mkdf-post-text-main">
					<?php holmes_mkdf_get_module_template_part( 'templates/parts/post-type/link', 'blog', '', $part_params ); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="mkdf-post-additional-content">
		<?php the_content(); ?>

        <div class="mkdf-post-info-bottom clearfix">
			<?php holmes_mkdf_get_module_template_part( 'templates/parts/post-info/share', 'blog', '', $part_params ); ?>
        </div>
    </div>
</article>