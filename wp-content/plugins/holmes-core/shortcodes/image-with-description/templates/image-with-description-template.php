<div class="mkdf-image-with-description-item mkdf-item-space">
    <div class="mkdf-iwd-image-holder">
        <?php echo wp_get_attachment_image($image, 'full'); ?>
    </div>
    <div class="mkdf-iwd-content-holder">
        <div class="mkdf-iwd-col-1">
            <h5 class="mkdf-iwd-title">
                <?php echo esc_html($title_1) ?>
            </h5>
            <div class="mkdf-iwd-description">
                <?php echo wp_kses_post($description_1) ?>
            </div>
        </div>
        <div class="mkdf-iwd-col-2">
            <h5 class="mkdf-iwd-title">
                <?php echo esc_html($title_2) ?>
            </h5>
            <div class="mkdf-iwd-description">
                <?php echo wp_kses_post($description_2) ?>
            </div>
            <div class="mkdf-iwd-arrow">
                <a href="<?php echo esc_url($link)?>">
                    <?php include HOLMES_CORE_ASSETS_PATH . '/svgs/arrow-right.php'?>
                </a>
            </div>
        </div>
    </div>
</div>