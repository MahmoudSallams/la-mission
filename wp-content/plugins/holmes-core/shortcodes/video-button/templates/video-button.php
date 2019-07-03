<?php
$rand       = rand( 0, 1000 );
$link_class = ! empty( $play_button_hover_image ) ? 'mkdf-vb-has-hover-image' : '';
?>

<div class="mkdf-video-button-holder <?php echo esc_attr( $holder_classes ); ?>">
    <div class="mkdf-video-button-image">
		<?php echo wp_get_attachment_image( $video_image, 'full' ); ?>

		<?php if ( $enable_text == 'yes' ): ?>
            <div class="mkdf-video-button-text">
                <h4 class="mkdf-video-button-title">
					<?php echo esc_html( $title ) ?>
                </h4>
                <h6 class="mkdf-video-button-subtitle">
					<?php echo esc_html( $subtitle ) ?>
                </h6>
            </div>
		<?php endif; ?>
    </div>
	<?php if ( ! empty( $play_button_image ) ) : ?>
        <a class="mkdf-video-button-play-image <?php echo esc_attr( $link_class ); ?>" href="<?php echo esc_url( $video_link ); ?>" data-rel="prettyPhoto[video_button_pretty_photo_<?php echo esc_attr( $rand ); ?>]">
			<span class="mkdf-video-button-play-inner">
				<?php echo wp_get_attachment_image( $play_button_image, 'full' ); ?>
				<?php if ( ! empty( $play_button_hover_image ) ) : ?>
					<?php echo wp_get_attachment_image( $play_button_hover_image, 'full' ); ?>
				<?php endif; ?>
			</span>
        </a>
	<?php else: ?>
        <a class="mkdf-video-button-play" <?php echo holmes_mkdf_get_inline_style( $play_button_styles ); ?> href="<?php echo esc_url( $video_link ); ?>" data-rel="prettyPhoto[video_button_pretty_photo_<?php echo esc_attr( $rand ); ?>]">
			<span class="mkdf-video-button-play-inner">
				<span>
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            viewBox="0 0 37 44" style="enable-background:new 0 0 37 44;" xml:space="preserve">
                    <style type="text/css">
                        .mkdf-svg-vb {
                            fill: <?php echo esc_html($play_button_color); ?> !important;
                        }
                    </style>
                        <polygon class="mkdf-svg-vb" points="1,1 1,43 36,22 "/>
                    </svg>
                </span>
			</span>
        </a>
	<?php endif; ?>
</div>