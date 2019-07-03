<div class="mkdf-colored-clients <?php echo esc_attr( $holder_classes ); ?>">

	<?php foreach ( $clients as $client ): ?>

        <div class="mkdf-cc-item mkdf-item-space">

			<?php if ( ! empty( $client['link'] ) ): ?>
                <a href="<?php esc_attr_e( $client['link'] ) ?>" target="<?php echo( ! empty( $client['new_window'] ) ? '_blank' : '_self' ); ?>">
			<?php endif; ?>

                <div class="mkdf-cci-image-holder">
					<?php echo wp_get_attachment_image( $client['image'], 'full' ); ?>
                    <div class="mkdf-overlay-logo-holder" style="background-color: <?php esc_attr_e( $client['overlay_color'] ); ?>"></div>
                </div>
                <div class="mkdf-cci-logo-holder">
					<?php echo wp_get_attachment_image( $client['logo'], 'full' ); ?>
                </div>

			<?php if ( ! empty( $client['link'] ) ): ?>
                </a>
		    <?php endif; ?>

        </div>

	<?php endforeach; ?>

</div>