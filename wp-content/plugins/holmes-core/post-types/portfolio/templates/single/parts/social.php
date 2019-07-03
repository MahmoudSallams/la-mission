<?php if ( holmes_mkdf_options()->getOptionValue( 'enable_social_share' ) == 'yes' && holmes_mkdf_options()->getOptionValue( 'enable_social_share_on_portfolio_item' ) == 'yes' ) : ?>
	<div class="mkdf-ps-info-item mkdf-ps-social-share">
		<?php
		/**
		 * Available params type, icon_type and title
		 *
		 * Return social share html
		 */
		echo holmes_mkdf_get_social_share_html( array( 'type'  => 'text', 'title' => esc_attr__( 'Share', 'holmes-core' ) ) ); ?>
	</div>
<?php endif; ?>