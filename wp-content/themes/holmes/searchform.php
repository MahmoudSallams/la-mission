<form role="search" method="get" class="mkdf-searchform searchform" id="searchform-<?php echo esc_attr( rand( 0, 1000 ) ); ?>" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label class="screen-reader-text"><?php esc_html_e( 'Search for:', 'holmes' ); ?></label>
    <div class="input-holder clearfix">
        <input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search...', 'holmes' ); ?>" value="" name="s" title="<?php esc_attr_e( 'Search for:', 'holmes' ); ?>"/>
        <button type="submit" class="mkdf-search-submit"><?php echo holmes_mkdf_icon_collections()->renderIcon( 'ion-ios-search-strong', 'ion_icons' ); ?></button>
    </div>
</form>