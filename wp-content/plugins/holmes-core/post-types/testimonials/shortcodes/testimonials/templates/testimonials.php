<div class="mkdf-testimonials-holder clearfix <?php echo esc_attr($holder_classes); ?>" <?php echo holmes_mkdf_get_inline_style($box_styles); ?>>
    <div class="mkdf-testimonials-holder-outer">
        <div class="mkdf-testimonials mkdf-testimonials-image-pagination-inner" <?php echo holmes_mkdf_get_inline_attrs( $data_attr ) ?>>

            <?php if ( $query_results->have_posts() ):
                $pagination_images = array();
                $count = 0;
                while ( $query_results->have_posts() ) : $query_results->the_post();
                    $title    = get_post_meta( get_the_ID(), 'mkdf_testimonial_title', true );
                    $text     = get_post_meta( get_the_ID(), 'mkdf_testimonial_text', true );
                    $current_id = get_the_ID();
                    $pagination_images[]  = get_the_post_thumbnail(get_the_ID(), array(40, 40), ["class" => "mkdf-idle"]);
                    $authorSlider[$count]['author'] = get_post_meta( get_the_ID(), 'mkdf_testimonial_author', true );
                    $authorSlider[$count]['position'] = get_post_meta( get_the_ID(), 'mkdf_testimonial_author_position', true );
                    $count++;
                    ?>

                    <div class="mkdf-testimonial-content" id="mkdf-testimonials-<?php echo esc_attr( $current_id ) ?>">
                        <div class="mkdf-testimonial-text-holder">
                            <?php if ( ! empty( $title ) ) { ?>
                                <h2 itemprop="name" class="mkdf-testimonial-title entry-title"><?php echo esc_html( $title ); ?></h2>
                            <?php } ?>
                            <?php if ( ! empty( $text ) ) { ?>
                                <p class="mkdf-testimonial-text"><?php echo esc_html( $text ); ?></p>
                            <?php } ?>
                            <?php if ( ! empty( $author ) ) { ?>
                                <h4 class="mkdf-testimonial-author">
                                    <span class="mkdf-testimonials-author-name"><?php echo esc_html( $author ); ?></span>
                                    <?php if ( ! empty( $position ) ) { ?>
                                        <span class="mkdf-testimonials-author-job"><?php echo esc_html( $position ); ?></span>
                                    <?php } ?>
                                </h4>
                            <?php } ?>
                        </div>
                    </div>

                <?php
                endwhile;
            else:
                echo esc_html__( 'Sorry, no posts matched your criteria.', 'holmes-core' );
            endif;

            wp_reset_postdata();
            ?>
        </div>
        <ul id="mkdf-testimonial-pagination" class="clearfix" >
            <?php foreach ($pagination_images as $image) : ?>
                <li class="mkdf-tsp-item"> <?php echo  $image; ?> </li>
            <?php endforeach; ?>
        </ul>

        <div class="mkdf-testimonial-author-slider mkdf-owl-custom-slider">
            <?php foreach ($authorSlider as $auth) { ?>
                <h4 class="mkdf-testimonial-author">
                    <span class="mkdf-testimonials-author-name"><?php echo esc_html( $auth['author'] ); ?></span>
                    <?php if ( ! empty( $auth['position'] ) ) { ?>
                        <span class="mkdf-testimonials-author-job"><?php echo esc_html( $auth['position'] ); ?></span>
                    <?php } ?>
                </h4>
            <?php } ?>
        </div>
    </div>
    <div class="mkdf-testimonal-nav-prev">
        <span>
            <?php include HOLMES_CORE_ASSETS_PATH . '/svgs/arrow-left.php'?>
        </span>
    </div>
    <div class="mkdf-testimonal-nav-next">
        <span>
            <?php include HOLMES_CORE_ASSETS_PATH . '/svgs/arrow-right.php'?>
        </span>
    </div>
</div>