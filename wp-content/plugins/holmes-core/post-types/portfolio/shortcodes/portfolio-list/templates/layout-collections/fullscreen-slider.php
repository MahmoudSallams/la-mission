<div class="mkdf-pli-image-holder" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>')">
    <div class="mkdf-pli-text-holder">
        <div class="mkdf-pli-text-wrapper">
            <div class="mkdf-pli-text">
                <?php echo holmes_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/category', $item_style, $params); ?>
                <?php echo holmes_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/title', $item_style, $params); ?>
                <?php echo holmes_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/excerpt', $item_style, $params); ?>
                <span class="arrow_right"></span>
            </div>

        </div>
    </div>
</div>
