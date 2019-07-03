<div class="mkdf-portfolio-single-holder-inner">
    <div class="mkdf-grid-row">
        <div class="mkdf-grid-col-9">
            <div class="mkdf-ps-image-holder">
                <div class="mkdf-ps-image-inner">
					<?php
					$media = holmes_core_get_portfolio_single_media();

					if ( is_array( $media ) && count( $media ) ) : ?>
						<?php foreach ( $media as $single_media ) : ?>
                            <div class="mkdf-ps-image">
								<?php holmes_core_get_portfolio_single_media_html( $single_media ); ?>
                            </div>
						<?php endforeach; ?>
					<?php endif; ?>
                </div>
            </div>
        </div>
        <div class="mkdf-grid-col-3">
            <div class="mkdf-ps-content-holder">
				<?php echo holmes_core_get_cpt_single_module_template_part( 'templates/single/parts/content', 'portfolio', $item_layout ); ?>
				<?php holmes_core_get_cpt_single_module_template_part( 'templates/single/parts/like', 'portfolio', $item_layout ); ?>
            </div>
            <div class="mkdf-ps-info-holder">
				<?php

				//get portfolio custom fields section
				holmes_core_get_cpt_single_module_template_part( 'templates/single/parts/custom-fields', 'portfolio', $item_layout );

				//get portfolio categories section
				holmes_core_get_cpt_single_module_template_part( 'templates/single/parts/categories', 'portfolio', $item_layout );

				//get portfolio date section
				holmes_core_get_cpt_single_module_template_part( 'templates/single/parts/date', 'portfolio', $item_layout );

				//get portfolio tags section
				holmes_core_get_cpt_single_module_template_part( 'templates/single/parts/tags', 'portfolio', $item_layout );

				//get portfolio share section
				holmes_core_get_cpt_single_module_template_part( 'templates/single/parts/social', 'portfolio', $item_layout );
				?>
            </div>
        </div>
    </div>
</div>