<div class="mkdf-portfolio-pair-holder <?php echo esc_attr($holder_classes); ?>">
    <?php foreach($portfolios as $portfolio) : ?>
        <div class="mkdf-ppi <?php echo esc_html($portfolio['class_name']); ?>">
            <div class="mkdf-ppi-inner">
                <div class="mkdf-ppi-image">
                    <a class="mkdf-ppi-link" itemprop="url" href="<?php echo get_the_permalink($portfolio['portfolio_id']); ?>" title="<?php the_title_attribute(); ?>">
                        <?php
                        if($portfolio['enable_custom_image'] == 'no') {
                            echo get_the_post_thumbnail($portfolio['portfolio_id'], $portfolio['image_size']);
                        }
                        else {
                            echo wp_get_attachment_image($portfolio['custom_image'], 'full');
                        }
                        ?>
                    </a>
                </div>
                <div class="mkdf-ppi-text-wrapper clearfix">
                    <<?php echo esc_attr($title_tag); ?> itemprop="name" class="entry-title mkdf-ppi-title">
                        <a itemprop="url" href="<?php echo get_the_permalink($portfolio['portfolio_id']); ?>">
                            <?php echo get_the_title($portfolio['portfolio_id']); ?>
                            <span>
                               <?php include HOLMES_CORE_ASSETS_PATH . '/svgs/arrow-right.php'?>
                            </span>
                        </a>
                    </<?php echo esc_attr($title_tag); ?>>
                    <?php if($enable_category == 'yes') : ?>
                        <?php
                        $portfolio_categories = wp_get_post_terms($portfolio['portfolio_id'], 'portfolio-category');
                        if (!empty($portfolio_categories)) : ?>
                            <div class="mkdf-ppi-category">
                                <?php foreach ($portfolio_categories as $category) :?>
                                    <a href="<?php echo get_term_link($category->term_id) ;?>"><?php echo wp_kses_post($category->name); ?> </a>
                                <?php endforeach;  ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
