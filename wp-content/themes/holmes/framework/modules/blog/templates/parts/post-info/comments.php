<?php if(comments_open()) { ?>
	<div class="mkdf-post-info-comments-holder">
		<a itemprop="url" class="mkdf-post-info-comments" href="<?php comments_link(); ?>">
			<?php comments_number('0 ' . esc_html__('Comments','holmes'), '1 '.esc_html__('Comment','holmes'), '% '.esc_html__('Comments','holmes') ); ?>
		</a>
	</div>
<?php } ?>