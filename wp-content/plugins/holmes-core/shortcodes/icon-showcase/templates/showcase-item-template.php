<div class="mkdf-showcase-item-holder">
	<div class="mkdf-showcase-icon">
		<?php echo holmes_mkdf_execute_shortcode('mkdf_icon', $icon_params); ?>
	</div>
	<div class="mkdf-showcase-content">
		<div class="mkdf-showcase-content-table">
			<div class="mkdf-showcase-content-cell">
				<?php if ($title !== '') { ?>
					<<?php echo esc_attr($title_tag);?> class='mkdf-showcase-title'><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag);?>>
				<?php } ?>
				<?php if ($content !== '') { ?>
					<div class="mkdf-showcase-content-inner">
						<?php echo wp_kses_post($content); ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>