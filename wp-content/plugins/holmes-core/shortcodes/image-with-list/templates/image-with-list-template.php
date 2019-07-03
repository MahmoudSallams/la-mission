<div class="mkdf-image-with-list-item mkdf-item-space">
    <div class="mkdf-iwl-image-holder">
        <?php echo wp_get_attachment_image($image, 'full'); ?>
        <div class="mkdf-iwl-number-holder">
            <?php echo esc_html($number); ?>
        </div>
    </div>
    <div class="mkdf-iwl-content-holder">
        <h2 class="mkdf-iwl-title">
            <?php echo esc_html($title) ?>
        </h2>
        <?php echo holmes_mkdf_execute_shortcode('mkdf_linkable_list', [
            'list_items' => $list_items
        ]) ?>
    </div>
</div>