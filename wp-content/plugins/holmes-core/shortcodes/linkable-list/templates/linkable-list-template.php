<div class="mkdf-linkable-list-holder <?php echo esc_attr( $holder_classes ); ?>">
    <h2 class="mkdf-ll-title">
		<?php echo esc_html( $title ) ?>
    </h2>
    <ul>
		<?php foreach ( $list_items as $item ): ?>
            <li>
                <a href="<?php echo esc_url( $item['link'] ) ?>" target="_self">
					<?php echo esc_html($item['text']) ?>
                    <i class="fa fa-chevron-right"></i>
                </a>
            </li>
		<?php endforeach; ?>
    </ul>
</div>