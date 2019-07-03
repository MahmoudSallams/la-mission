<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="mkdf-post-content">
        <div class="mkdf-post-heading">
			<?php holmes_mkdf_get_module_template_part( 'templates/parts/media', 'blog', $post_format, $part_params ); ?>
        </div>
        <div class="mkdf-post-text">
            <div class="mkdf-post-text-inner">

				<?php if ( holmes_mkdf_options()->getOptionValue( 'blog_single_categories' ) === 'yes' || holmes_mkdf_options()->getOptionValue( 'blog_single_tags' ) === 'yes' ): ?>
					<?php $part_params['source'] = 'single'; // needed for formatting labels differently on single and lists ?>

                    <div class="mkdf-post-info-top">
						<?php if ( holmes_mkdf_options()->getOptionValue( 'blog_single_date' ) === 'yes' ): ?>
							<?php holmes_mkdf_get_module_template_part( 'templates/parts/post-info/date', 'blog', '', $part_params ); ?>
						<?php endif; ?>
						<?php if ( holmes_mkdf_options()->getOptionValue( 'blog_single_categories' ) === 'yes' ): ?>
							<?php holmes_mkdf_get_module_template_part( 'templates/parts/post-info/category', 'blog', '', $part_params ); ?>
						<?php endif; ?>

						<?php if ( holmes_mkdf_options()->getOptionValue( 'blog_single_tags' ) === 'yes' ): ?>
							<?php holmes_mkdf_get_module_template_part( 'templates/parts/post-info/tags', 'blog', '', $part_params ); ?>
						<?php endif; ?>
                    </div>

				<?php endif; ?>

                <div class="mkdf-post-text-main">
					<?php the_content(); ?>
					<?php do_action( 'holmes_mkdf_single_link_pages' ); ?>
                </div>
                <div class="mkdf-post-info-bottom clearfix">
					<?php holmes_mkdf_get_module_template_part( 'templates/parts/post-info/share', 'blog', '', $part_params ); ?>
                </div>
            </div>
        </div>
    </div>
</article>