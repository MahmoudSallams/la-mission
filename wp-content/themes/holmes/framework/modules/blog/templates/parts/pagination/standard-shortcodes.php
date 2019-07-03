<?php if ( $max_num_pages > 1 ) { ?>
    <div class="mkdf-blog-pag-loading">
        <div class="mkdf-blog-pag-bounce1"></div>
        <div class="mkdf-blog-pag-bounce2"></div>
        <div class="mkdf-blog-pag-bounce3"></div>
    </div>
	<?php
	$number_of_pages = $max_num_pages;
	$current_page    = $paged;

	if ( $number_of_pages > 1 ) { ?>
        <div class="mkdf-bl-standard-pagination">
            <ul>
                <li class="mkdf-pag-prev">
                    <a href="#" data-paged="1">
                        <span>
                            <svg version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 29.2 13.1" style="enable-background:new 0 0 29.2 13.1; width: 26px;" xml:space="preserve">
                            <style type="text/css">
                                .mkdf-st0 {
                                    fill: #231F20;
                                }
                            </style>
                                <path class="mkdf-st0" d="M26.5,5.1H6.6L8,3.7c0.6-0.6,0.6-1.5,0-2.1C7.5,1,6.5,1,5.9,1.6l-4,4c-0.6,0.6-0.6,1.5,0,2.1l4,4
                                C6.2,12,6.6,12.1,7,12.1S7.8,12,8,11.7c0.6-0.6,0.6-1.5,0-2.1L6.6,8.1h19.9c0.8,0,1.5-0.7,1.5-1.5C28,5.8,27.4,5.1,26.5,5.1z"/>
                            </svg>
                        </span>
                    </a>
                </li>
				<?php for ( $i = 1; $i <= $number_of_pages; $i ++ ) { ?>
					<?php
					$link_classes = '';
					if ( $current_page == $i ) {
						$link_classes = 'mkdf-pag-active';
					}
					?>
                    <li class="mkdf-pag-number <?php echo esc_attr( $link_classes ); ?>">
                        <a href="#" data-paged="<?php echo esc_attr( $i ); ?>"><?php echo esc_html( $i ); ?></a>
                    </li>
				<?php } ?>
                <li class="mkdf-pag-next">
                    <a href="#" data-paged="2">
                        <span>
                            <svg version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 29.2 13.1" style="enable-background:new 0 0 29.2 13.1; width: 26px;" xml:space="preserve">
                            <style type="text/css">
                                .mkdf-st0 {
                                    fill: #231F20;
                                }
                            </style>
                                <path class="mkdf-st0" d="M3,5.1h19.9l-1.4-1.4c-0.6-0.6-0.6-1.5,0-2.1C22.1,1,23,1,23.6,1.6l4,4c0.6,0.6,0.6,1.5,0,2.1l-4,4
                                c-0.3,0.3-0.7,0.4-1.1,0.4s-0.8-0.1-1.1-0.4c-0.6-0.6-0.6-1.5,0-2.1l1.4-1.4H3c-0.8,0-1.5-0.7-1.5-1.5C1.5,5.8,2.2,5.1,3,5.1z"/>
                            </svg>
                        </span>
                    </a>
                </li>
            </ul>
        </div>
	<?php }
} ?>
