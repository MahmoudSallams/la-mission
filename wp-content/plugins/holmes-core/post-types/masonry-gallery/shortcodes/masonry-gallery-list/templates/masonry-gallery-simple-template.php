<?php
    if($word_color) {
        $titleArray = explode(' ', $item_title);
        $length = count($titleArray);
        $titleArray[$length - 1] = '<span style="color:' . $word_color . '">' . $titleArray[$length - 1] . '</span>';
        $item_title = implode(' ', $titleArray);
    }
?>
<article class="mkdf-item-space <?php echo esc_attr($item_classes) ?>">
	<div class="mkdf-mg-content">
		<?php if (has_post_thumbnail()) { ?>
			<div class="mkdf-mg-image">
				<?php the_post_thumbnail(); ?>
			</div>
		<?php } ?>
		<div class="mkdf-mg-item-outer">
			<div class="mkdf-mg-item-inner">
				<div class="mkdf-mg-item-content">
					<?php if(!empty($item_image)) { ?>
						<img itemprop="image" class="mkdf-mg-item-icon" src="<?php echo esc_url($item_image['url'])?>" alt="<?php echo esc_attr($item_image['alt']); ?>" />
					<?php } ?>
					<?php if (!empty($item_title)) { ?>
						<<?php echo esc_attr($item_title_tag); ?> itemprop="name" class="mkdf-mg-item-title entry-title">
                            <?php echo wp_kses_post($item_title); ?>
                        </<?php echo esc_attr($item_title_tag); ?>>
					<?php } ?>
					<?php if (!empty($item_text)) { ?>
						<p class="mkdf-mg-item-text"><?php echo esc_html($item_text); ?></p>
					<?php } ?>
				</div>
				<?php if (!empty($item_link)) { ?>
					<a itemprop="url" href="<?php echo esc_url($item_link); ?>" target="<?php echo esc_attr($item_link_target); ?>" class="mkdf-mg-item-link"></a>
				<?php } ?>
			</div>
		</div>
	</div>
</article>
