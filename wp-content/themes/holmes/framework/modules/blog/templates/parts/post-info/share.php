<?php
$share_type = isset( $share_type ) ? $share_type : 'text';
?>
<?php if ( holmes_mkdf_core_plugin_installed() && holmes_mkdf_options()->getOptionValue( 'enable_social_share' ) === 'yes' && holmes_mkdf_options()->getOptionValue( 'enable_social_share_on_post' ) === 'yes' ) { ?>
	<div class="mkdf-blog-share">
        <span><?php echo esc_html__('Share this', 'holmes'); ?></span>
		<?php echo holmes_mkdf_get_social_share_html( array( 'type' => $share_type ) ); ?>
	</div>
<?php } ?>