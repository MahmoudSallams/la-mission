<div class="mkdf-project-slider-holder">
    <div class="mkdf-project-slider-text-holder">
        <h2 class="mkdf-ps-description">
			<?php echo esc_html( $params['description_text'] ); ?>
        </h2>
        <div class="mkdf-ps-button">
			<?php echo holmes_mkdf_execute_shortcode( 'mkdf_button', array(
				'text'        => $params['button_text'],
				'description' => $params['button_description'],
				'link'        => $params['button_link'],
			) ); ?>
        </div>
        <div class="mikado-ps-custom-nav">
            <span class="mkdf-custom-nav-prev">
                <svg version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 29.2 13.1" style="enable-background:new 0 0 29.2 13.1;" xml:space="preserve">
                    <style type="text/css">
                        .mkdf-st0 {
                            fill: #231F20;
                        }
                    </style>
                    <path class="mkdf-st0" d="M26.5,5.1H6.6L8,3.7c0.6-0.6,0.6-1.5,0-2.1C7.5,1,6.5,1,5.9,1.6l-4,4c-0.6,0.6-0.6,1.5,0,2.1l4,4
	C6.2,12,6.6,12.1,7,12.1S7.8,12,8,11.7c0.6-0.6,0.6-1.5,0-2.1L6.6,8.1h19.9c0.8,0,1.5-0.7,1.5-1.5C28,5.8,27.4,5.1,26.5,5.1z"></path>
                </svg>
            </span>
            <span class="mkdf-ps-back-button">
                <a href="<?php echo esc_html( $params['projects_link'] ); ?>">
                    <span class="social_flickr"></span>
                    <span class="social_flickr"></span>
                </a>
            </span>
            <span class="mkdf-custom-nav-next">
                <svg version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 29.2 13.1" style="enable-background:new 0 0 29.2 13.1;" xml:space="preserve">
                    <style type="text/css">
                        .mkdf-st0 {
                            fill: #231F20;
                        }
                    </style>
                    <path class="mkdf-st0" d="M3,5.1h19.9l-1.4-1.4c-0.6-0.6-0.6-1.5,0-2.1C22.1,1,23,1,23.6,1.6l4,4c0.6,0.6,0.6,1.5,0,2.1l-4,4
	c-0.3,0.3-0.7,0.4-1.1,0.4s-0.8-0.1-1.1-0.4c-0.6-0.6-0.6-1.5,0-2.1l1.4-1.4H3c-0.8,0-1.5-0.7-1.5-1.5C1.5,5.8,2.2,5.1,3,5.1z"></path>
                </svg>
            </span>
        </div>
    </div>
	<?php echo holmes_mkdf_execute_shortcode( 'mkdf_portfolio_list', $params ); ?>
</div>