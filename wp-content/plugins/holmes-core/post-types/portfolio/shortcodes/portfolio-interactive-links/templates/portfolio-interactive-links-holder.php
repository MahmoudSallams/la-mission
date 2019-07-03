<div <?php holmes_mkdf_class_attribute($ips_classes); ?>>
    <?php if ($enable_intro_section === 'yes') { ?>
        <div id="mkdf-ips-intro">
            <h1 class="mkdf-ips-intro-text">
                <span><?php echo esc_attr($intro_text); ?></span>
            </h1>
        </div>
    <?php } ?>
    <div class="mkdf-ips-holder">
        <?php if($query_results->have_posts()) { ?>
            <div class="mkdf-ips-image-holder">
                <?php while ( $query_results->have_posts() ) : $query_results->the_post();

                        $item_style = array();
                        $item_style[] = 'background-image: url("'. get_the_post_thumbnail_url() .'"';
                    ?>
                    <div class="mkdf-ips-item-image" <?php holmes_mkdf_inline_style($item_style); ?>>
                        <?php the_post_thumbnail(); ?>
                        <div class="mkdf-ips-item-content-copy">
                            <a class="mkdf-ips-item-link" itemprop="url" target="<?php echo esc_attr($target); ?>" href="<?php echo get_the_permalink(); ?>" <?php echo holmes_mkdf_get_inline_style($text_style); ?>>
                                <?php echo get_the_title();?>
                            </a>
                            <p class="mkdf-ips-item-excerpt">
                                <?php echo esc_html(substr(get_the_excerpt(), 0, 50)); ?>
                            </p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="mkdf-ips-content-holder">
                <div class="mkdf-ips-content-table">
                    <div class="mkdf-ips-content-table-cell">
                    <?php while ( $query_results->have_posts() ) : $query_results->the_post(); ?>
                                <?php
		                        $link_style = '';
		                        if(isset($link_item['text_color'])) {
		                            $link_style .= 'color:' . $link_item['text_color'] . ';';
		                        }?>

                            <div class="mkdf-ips-item-content">
                                <a class="mkdf-ips-item-link" itemprop="url" target="<?php echo esc_attr($target); ?>" href="<?php echo get_the_permalink(); ?>" <?php echo holmes_mkdf_get_inline_style($text_style); ?>>
                                    <?php echo get_the_title();?>
                                </a>
                                <p class="mkdf-ips-item-excerpt">
                                    <?php echo esc_html(substr(get_the_excerpt(), 0, 50)); ?>
                                </p>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>