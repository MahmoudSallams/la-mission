<?php

get_header();

holmes_mkdf_get_title();

do_action( 'holmes_mkdf_before_main_content' );

holmes_core_get_single_portfolio();

//do_action( 'holmes_mkdf_portfolio_page_after_content' );

get_footer();