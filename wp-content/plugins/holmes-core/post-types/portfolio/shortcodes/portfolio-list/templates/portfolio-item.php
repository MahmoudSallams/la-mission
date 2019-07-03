<article class="mkdf-pl-item mkdf-item-space <?php echo esc_attr( $this_object->getArticleClasses( $params ) ); ?>">
    <div class="mkdf-pl-item-inner">
		<?php echo holmes_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-list', 'layout-collections/' . $item_style, '', $params ); ?>

		<?php if ( $item_style !== 'standard' ): ?>
            <a itemprop="url" class="mkdf-pli-link mkdf-block-drag-link" href="<?php echo esc_url( $this_object->getItemLink() ); ?>" target="<?php echo esc_attr( $this_object->getItemLinkTarget() ); ?>"></a>
		<?php endif; ?>
    </div>
</article>