<div class="mkdf-social-share-holder mkdf-dropdown">
	<a class="mkdf-social-share-dropdown-opener" href="javascript:void(0)">
		<?php if ( ! empty( $title ) ) { ?>
			<span class="mkdf-social-share-title"><?php echo esc_html( $title ); ?></span>
		<?php } else { ?>
			<span class="mkdf-social-share-title"><?php esc_html_e( 'Share', 'holmes-core' ); ?></span>
		<?php } ?>
		<i class="social_share"></i>
	</a>
	<div class="mkdf-social-share-dropdown">
		<ul>
			<?php foreach ( $networks as $net ) {
				echo wp_kses( $net, array(
					'li'   => array(
						'class' => true
					),
					'a'    => array(
						'itemprop' => true,
						'class'    => true,
						'href'     => true,
						'target'   => true,
						'onclick'  => true
					),
					'img'  => array(
						'itemprop' => true,
						'class'    => true,
						'src'      => true,
						'alt'      => true
					),
					'span' => array(
						'class' => true
					)
				) );
			} ?>
		</ul>
	</div>
</div>