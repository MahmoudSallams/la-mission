<?php

holmes_mkdf_get_single_post_format_html( $blog_single_type );

do_action( 'holmes_mkdf_after_article_content' );

holmes_mkdf_get_module_template_part( 'templates/parts/single/author-info', 'blog' );

holmes_mkdf_get_module_template_part( 'templates/parts/single/single-navigation', 'blog' );

holmes_mkdf_get_module_template_part( 'templates/parts/single/comments', 'blog' );

holmes_mkdf_get_module_template_part( 'templates/parts/single/related-posts', 'blog', '', $single_info_params );