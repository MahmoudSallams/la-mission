<div class="mkdf-image-with-text-holder <?php echo esc_attr($holder_classes); ?>">
    <div class="mkdf-iwt-image">
        <?php if ($image_behavior === 'lightbox') { ?>
            <a itemprop="image" href="<?php echo esc_url($image['url']); ?>" data-rel="prettyPhoto[iwt_pretty_photo]" title="<?php echo esc_attr($image['alt']); ?>">
        <?php } else if ($image_behavior === 'custom-link' && !empty($custom_link)) { ?>
	            <a itemprop="url" href="<?php echo esc_url($custom_link); ?>" target="<?php echo esc_attr($custom_link_target); ?>">
        <?php } ?>
        <?php if ($image_behavior === 'lightbox' || $image_behavior === 'custom-link') { ?>
            </a>
        <?php } ?>
        <?php if(is_array($image_size) && count($image_size)) : ?>
            <?php echo holmes_mkdf_generate_thumbnail($image['image_id'], null, $image_size[0], $image_size[1]); ?>
        <?php else: ?>
            <?php echo wp_get_attachment_image($image['image_id'], $image_size); ?>
        <?php endif; ?>
    </div>
    <div class="mkdf-iwt-text-holder">
        <?php if(!empty($title)) { ?>
            <<?php echo esc_attr($title_tag); ?> class="mkdf-iwt-title" <?php echo holmes_mkdf_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
        <?php } ?>
		<?php if(!empty($text)) { ?>
            <p class="mkdf-iwt-text" <?php echo holmes_mkdf_get_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
        <?php } ?>
        <?php if ($image_behavior === 'custom-link') { ?>
            <span class="mkdf-iwt-arrow">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 12.5 27.6" style="height: 25px;" xml:space="preserve">
                    <path d="M4.6,25.6V5.8L3.2,7.2c-0.6,0.6-1.5,0.6-2.1,0S0.5,5.7,1.1,5l4-4c0.6-0.6,1.5-0.6,2.1,0l4,4c0.3,0.3,0.4,0.7,0.4,1.1  s-0.1,0.8-0.4,1.1c-0.6,0.6-1.5,0.6-2.1,0L7.7,5.9v19.8c0,0.8-0.7,1.5-1.5,1.5C5.3,27.1,4.6,26.5,4.6,25.6z"/>
                </svg>        
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 12.5 27.6" style="height: 25px;" xml:space="preserve">
                    <path d="M4.6,25.6V5.8L3.2,7.2c-0.6,0.6-1.5,0.6-2.1,0S0.5,5.7,1.1,5l4-4c0.6-0.6,1.5-0.6,2.1,0l4,4c0.3,0.3,0.4,0.7,0.4,1.1  s-0.1,0.8-0.4,1.1c-0.6,0.6-1.5,0.6-2.1,0L7.7,5.9v19.8c0,0.8-0.7,1.5-1.5,1.5C5.3,27.1,4.6,26.5,4.6,25.6z"/>
                </svg>                
            </span>
        <?php } ?>
    </div>
</div>