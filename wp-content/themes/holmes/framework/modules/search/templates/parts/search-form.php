<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="mkdf-search-page-form" method="get">
    <h2 class="mkdf-search-title"><?php esc_html_e( 'New search:', 'holmes' ); ?></h2>
    <div class="mkdf-form-holder">
        <input type="text" name="s" class="mkdf-search-field" autocomplete="off" value="" placeholder="<?php esc_attr_e( 'Type here', 'holmes' ); ?>"/>
        <button type="submit" class="mkdf-search-submit"><span class="ion-ios-search-strong"></span></button>
    </div>
    <div class="mkdf-search-label">
		<?php esc_html_e( 'If you are not happy with the results below please do another search', 'holmes' ); ?>
    </div>
</form>