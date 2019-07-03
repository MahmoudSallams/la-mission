<div class="mkdf-fu <?php echo esc_attr( $holder_classes ); ?>">

	<?php if ( ! empty( $title ) ): ?>
        <span class="mkdf-fu__title" <?php echo holmes_mkdf_inline_style( $title_styles ); ?>>
			<?php esc_attr_e( $title ); ?>
        </span>
	<?php endif; ?>

    <h5 class="mkdf-fu__links">

		<?php if ( ! empty( $link_one ) ): ?>
            <a class="mkdf-fu__link" href="<?php esc_attr_e( $link_one ); ?>" target="<?php esc_attr_e( $target ); ?>">
				<?php echo esc_attr_e( $label_one ); ?>
            </a>
		<?php endif; ?>

		<?php if ( ! empty( $link_two ) ): ?>
            <a class="mkdf-fu__link" href="<?php esc_attr_e( $link_two ); ?>" target="<?php esc_attr_e( $target ); ?>">
				<?php echo esc_attr_e( $label_two ); ?>
            </a>
		<?php endif; ?>

		<?php if ( ! empty( $link_three ) ): ?>
            <a class="mkdf-fu__link" href="<?php esc_attr_e( $link_three ); ?>" target="<?php esc_attr_e( $target ); ?>">
				<?php echo esc_attr_e( $label_three ); ?>
            </a>
		<?php endif; ?>

		<?php if ( ! empty( $link_four ) ): ?>
            <a class="mkdf-fu__link" href="<?php esc_attr_e( $link_four ); ?>" target="<?php esc_attr_e( $target ); ?>">
				<?php echo esc_attr_e( $label_four ); ?>
            </a>
		<?php endif; ?>

    </h5>

</div>