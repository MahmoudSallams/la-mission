<div class="mkdf-team-carousel-holder <?php //echo esc_attr( $holder_classes ) ?> ">
    <div class="mkdf-tc-image-slider mkdf-owl-custom-slider" <?php //echo holmes_mkdf_get_inline_attrs( $slider_data ) ?>>
		<?php foreach ( $team_members as $member ) : ?>
            <div class="mkdf-tc-image">
				<?php echo wp_get_attachment_image( $member['image'], array(
					310,
					310
				), "", [ "class" => "mkdf-idle" ] ); ?>
            </div>
		<?php endforeach; ?>
    </div>
    <div class="mkdf-grid">
        <div class="mkdf-tc-text-slider mkdf-owl-custom-slider">
			<?php foreach ( $team_members as $member ) : ?>
                <div class="mkdf-tc-text">
                    <h5 class="mkdf-tc-text-subitle">
						<?php echo esc_html( $member['subtitle'] ); ?>
                    </h5>
                    <h2 class="mkdf-tc-text-title">
						<?php echo esc_html( $member['title'] ); ?>
                    </h2>
                    <div class="mkdf-tc-text-text">
						<?php echo esc_html( $member['text'] ); ?>
                    </div>
                </div>
			<?php endforeach; ?>
        </div>
    </div>
</div>
