<?php if(holmes_mkdf_options()->getOptionValue('portfolio_single_hide_date') === 'yes') : ?>
    <div class="mkdf-ps-info-item mkdf-ps-date">
	    <?php holmes_core_get_cpt_single_module_template_part('templates/single/parts/info-title', 'portfolio', '', array( 'title' => esc_attr__('Date', 'holmes-core') ) ); ?>
        <p itemprop="dateCreated" class="mkdf-ps-info-date entry-date updated"><?php the_time(get_option('date_format')); ?></p>
        <meta itemprop="interactionCount" content="UserComments: <?php echo get_comments_number(holmes_mkdf_get_page_id()); ?>"/>
    </div>
<?php endif; ?>