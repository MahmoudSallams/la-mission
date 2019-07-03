<?php echo '<' . esc_attr( $title_tag ); ?> class="mkdf-accordion-title">
    <span class="mkdf-accordion-mark">
        <span class="mkdf-acc-open">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 25 25" style="enable-background:new 0 0 25 25;" xml:space="preserve">
                <g>
                    <rect x="11" y="1" width="3" height="23"/>
                </g>
                <g>
                    <rect x="1" y="11" width="23" height="3"/>
                </g>
            </svg>
        </span>
        <span class="mkdf-acc-close"></span>
    </span>
    <span class="mkdf-tab-title"><?php echo esc_html( $title ); ?></span>
<?php echo '</' . esc_attr( $title_tag ); ?>>
<div class="mkdf-accordion-content">
    <div class="mkdf-accordion-content-inner">
		<?php echo do_shortcode( $content ); ?>
    </div>
</div>