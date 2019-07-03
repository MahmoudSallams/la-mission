<?php
$tags = get_the_tags();
?>
<?php if ( $tags ) { ?>
    <div class="mkdf-tags-holder">
        <div class="mkdf-tags">
            <span><?php esc_html_e( 'Tagged as:', 'holmes' ); ?></span>
			<?php the_tags( '', ', ', '' ); ?>
        </div>
    </div>
<?php } ?>