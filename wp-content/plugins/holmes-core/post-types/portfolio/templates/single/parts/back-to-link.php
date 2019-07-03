<?php
$back_to_link = get_post_meta(get_the_ID(), 'portfolio_single_back_to_link', true);

if($back_to_link !== '') : ?>

    <div class="mkdf-ps-back-btn">
        <?php
            echo holmes_mkdf_execute_shortcode('mkdf_button', [
                'text' => esc_html__('Back to everything', 'holmes-core'),
                'description' => esc_html__('See all our projects', 'holmes-core'),
                'link' => esc_url(get_permalink($back_to_link))
            ])
        ?>
    </div>

<?php endif; ?>
