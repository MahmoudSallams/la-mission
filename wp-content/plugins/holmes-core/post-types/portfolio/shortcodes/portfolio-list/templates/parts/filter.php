<?php if($filter == 'yes') {
	$filter_categories    = $this_object->getFilterCategories($params);
	$filter_holder_styles = $this_object->getFilterHolderStyles($params);
	$filter_styles        = $this_object->getFilterStyles($params);
	?>
	<div class="mkdf-pl-filter-holder" <?php holmes_mkdf_inline_style($filter_holder_styles); ?>>
		<div class="mkdf-plf-inner">
			<?php
			if(is_array($filter_categories) && count($filter_categories)){ ?>
				<ul <?php holmes_mkdf_inline_style($filter_styles); ?>>
					<?php foreach($filter_categories as $cat) { ?>
						<li class="mkdf-pl-filter" data-filter=".portfolio-category-<?php echo esc_attr($cat->slug); ?>">
							<span><?php echo esc_html($cat->name); ?></span><sup><?php echo esc_html($cat->count); ?></sup>
						</li>
					<?php } ?>
				</ul>
			<?php } ?>
		</div>
	</div>
<?php } ?>
