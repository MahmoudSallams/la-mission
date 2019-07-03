<div class="mkdf-team-holder <?php echo esc_attr( $holder_classes ); ?>">
    <div class="mkdf-team-inner">
		<?php if ( $team_image !== '' ) : ?>
            <div class="mkdf-team-image">
				<?php echo wp_get_attachment_image( $team_image, 'full' ); ?>
            </div>
		<?php endif; ?>
        <div class="mkdf-team-info">
			<?php if ( $team_position !== "" ) : ?>
                <div class="mkdf-team-position">
					<?php echo holmes_mkdf_execute_shortcode( 'mkdf_numbered_title', array(
						'title' => $team_number,
						'text'  => $team_position,
					) ); ?>
                </div>
			<?php endif; ?>

			<?php if ( $team_name !== '' ) : ?>
				<?php echo '<' . esc_attr( $team_name_tag ); ?> class="mkdf-team-name" <?php echo holmes_mkdf_get_inline_style( $team_name_styles ); ?>>

				<?php if ( ! empty( $link ) ) : ?>
                    <a itemprop="url" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
				<?php endif; ?>

				<?php echo esc_html( $team_name ); ?>

				<?php if ( ! empty( $link ) ) : ?>
                    </a>
				<?php endif; ?>

				<?php echo '</' . esc_attr( $team_name_tag ); ?>>
			<?php endif; ?>

			<?php if ( $team_text !== "" ) : ?>
                <p class="mkdf-team-text" <?php echo holmes_mkdf_get_inline_style( $team_text_styles ); ?>><?php echo esc_html( $team_text ); ?></p>
			<?php endif; ?>
			<?php if ( $social_networks_title ) : ?>
                <div class="mkdf-team-social-wrapper">
                    <h6 class="mkdf-social-title"><?php echo esc_html($social_networks_title) ?></h6>
					<?php foreach ( $social_networks as $network ): ?>
                        <a href="<?php echo esc_url($network['link']) ?>" target="_blank">
                            <h5><?php echo esc_html($network['abbr']) ?></h5>
                        </a>
					<?php endforeach; ?>
                </div>
			<?php endif; ?>
        </div>
    </div>
</div>