<?php
$content_styles = $this_object->getStandardContentStyles( $params );
echo holmes_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-list', 'parts/image', $item_style, $params ); ?>

<div class="mkdf-pli-text-holder" <?php holmes_mkdf_inline_style( $content_styles ); ?>>
    <div class="mkdf-pli-text-wrapper">
        <div class="mkdf-pli-text">
            <a class="mkdf-pli-title-link" itemprop="url" href="<?php echo esc_url( $this_object->getItemLink() ); ?>" target="<?php echo esc_attr( $this_object->getItemLinkTarget() ); ?>">
				<?php echo holmes_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-list', 'parts/title', $item_style, $params ); ?>
            </a>

			<?php echo holmes_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-list', 'parts/category', $item_style, $params ); ?>

			<?php echo holmes_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-list', 'parts/excerpt', $item_style, $params ); ?>
        </div>
    </div>
</div>