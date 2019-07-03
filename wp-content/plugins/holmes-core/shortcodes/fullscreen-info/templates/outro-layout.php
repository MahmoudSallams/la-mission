<div id="mkdf-outro" class="<?php echo esc_attr( $holder_classes ); ?>">
    <div class="mkdf-outro-bg"></div>
    <div class="mkdf-outro-inner">
        <div class="mkdf-outro-title-holder">
            <h1 class="mkdf-fi-title">
                <span class="mkdf-bg-stripe mkdf-start"></span>
                <span class="mkdf-bg-stripe mkdf-end"></span>
                <span><?php echo esc_attr( $outro_title ); ?></span>
            </h1>
        </div>
        <div>
            <img class="mkdf-outro-img mkdf-idle" src="<?php echo wp_get_attachment_url( $outro_subtitle_img ) ?>" alt="<?php echo the_title( $outro_subtitle_img ) ?>"/>
        </div>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 33 105">
                <path d="M27.3,76.5c-4.5,4.2-9.1,8.3-13.7,12.4c9.5-12.1,13.2-28.2,13.5-43.1c0.2-8.2-0.8-16.4-2-24.5  c-1.1-7.2-1.8-14.6-6.7-20.1c-0.3-0.4-1.1,0.1-0.8,0.5c3.6,6.2,3.7,15.3,4.4,22.5c0.7,7.1,1.1,14.2,0.8,21.4  c-0.5,12.3-3.4,23.4-9.2,33.8c1-4.1,1.8-8.2,2.4-12.3c0.4-3.1-4.8-4.2-5.5-1.1c-2.7,11.6-5.4,23-9.3,34.3c-1,2.7,2.5,4.9,4.6,3.1  c8.5-7.4,16.9-14.9,25.1-22.7C33.5,78.3,29.9,74.1,27.3,76.5z"/>
            </svg>
        </div>
		<?php if ( ! empty( $btn_text ) ) { ?>
            <div class="mkdf-outro-btn">
				<?php echo holmes_mkdf_get_button_html( array(
					'link'             => $btn_link,
					'text'             => $btn_text,
					'description'      => $btn_description,
					'target'           => $btn_link_target,
					'color'            => '#000',
					'background_color' => '#fff',
				) ); ?>
            </div>
		<?php } ?>
        <div class="mkdf-btm-info-holder">
            <span class="mkdf-btm-info-left"><?php echo holmes_mkdf_get_clean_output( $btm_info_left ); ?></span>
            <span class="mkdf-btm-info-center"><?php echo holmes_mkdf_get_clean_output( $btm_info_center ); ?></span>
            <span class="mkdf-btm-info-right"><?php echo holmes_mkdf_get_clean_output( $btm_info_right ); ?></span>
        </div>
    </div>
</div>