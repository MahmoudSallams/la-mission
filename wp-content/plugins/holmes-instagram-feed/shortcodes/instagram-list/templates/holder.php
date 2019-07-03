<div class="mkdf-instagram-list-holder <?php echo esc_attr($holder_classes); ?>">
    <?php if ( is_array( $images_array ) && count( $images_array ) ) { ?>
	    <ul class="mkdf-instagram-feed mkdf-outer-space <?php echo esc_attr($carousel_classes); ?> clearfix" <?php echo holmes_mkdf_get_inline_attrs( $data_attr ) ?>>
	    <?php
	    foreach ( $images_array as $image ) { ?>
		    <li class="mkdf-il-item mkdf-item-space">
			    <a href="<?php echo esc_url( $instagram_api->getHelper()->getImageLink( $image ) ); ?>" target="_blank">
				    <?php echo holmes_mkdf_kses_img( $instagram_api->getHelper()->getImageHTML( $image, $image_size ) ); ?>
				    <?php if ($show_instagram_icon =='yes' ) { ?>
                        <span class="mkdf-instagram-icon">
                            <svg version="1.1" width="21px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 29.2 13.1" style="enable-background:new 0 0 29.2 13.1;" xml:space="preserve">
                            <style type="text/css">
                                .mkdf-instagram-icon-color{fill:#fff;}
                            </style>
                                <path class="mkdf-instagram-icon-color" d="M3,5.1h19.9l-1.4-1.4c-0.6-0.6-0.6-1.5,0-2.1C22.1,1,23,1,23.6,1.6l4,4c0.6,0.6,0.6,1.5,0,2.1l-4,4
                                c-0.3,0.3-0.7,0.4-1.1,0.4s-0.8-0.1-1.1-0.4c-0.6-0.6-0.6-1.5,0-2.1l1.4-1.4H3c-0.8,0-1.5-0.7-1.5-1.5C1.5,5.8,2.2,5.1,3,5.1z"/>
                            </svg>
                        </span>
				    <?php } ?>
			    </a>
		    </li>
	    <?php } ?>
    </ul>
    <?php } else { ?>
        <div class="mkdf-instagram-not-connected">
            <?php esc_html_e( 'It seams that you haven\'t connected with your Instagram account', 'holmes-instagram-feed' ); ?>
        </div>
    <?php } ?>
</div>