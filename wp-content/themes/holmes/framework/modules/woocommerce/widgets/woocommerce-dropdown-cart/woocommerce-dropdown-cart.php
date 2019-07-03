<?php

if ( class_exists( 'HolmesMkdfWidget' ) ) {
    class HolmesMkdfWoocommerceDropdownCart extends HolmesMkdfWidget
    {
        public function __construct() {
            parent::__construct(
                'mkdf_woocommerce_dropdown_cart',
                esc_html__('Holmes Woocommerce Dropdown Cart', 'holmes'),
                array('description' => esc_html__('Display a shop cart icon with a dropdown that shows products that are in the cart', 'holmes'),)
            );

            $this->setParams();
        }

        protected function setParams() {
            $this->params = array(
                array(
                    'type'        => 'textfield',
                    'name'        => 'woocommerce_dropdown_cart_margin',
                    'title'       => esc_html__('Icon Margin', 'holmes'),
                    'description' => esc_html__('Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'holmes')
                ),
                array(
                    'type'        => 'dropdown',
                    'name'        => 'show_label',
                    'title'       => esc_html__('Enable Cart Icon Text', 'holmes'),
                    'description' => esc_html__('Enable this option to show cart text next to cart icon in header', 'holmes'),
                    'options'     => holmes_mkdf_get_yes_no_select_array()
                )
            );
        }

        public function widget($args, $instance) {
            extract($args);

            global $woocommerce;

            $icon_styles = array();

            if ($instance['woocommerce_dropdown_cart_margin'] !== '') {
                $icon_styles[] = 'margin: ' . $instance['woocommerce_dropdown_cart_margin'];
            }

            $cart_is_empty = sizeof($woocommerce->cart->get_cart()) <= 0;

            $dropdown_cart_icon_class = holmes_mkdf_get_dropdown_cart_icon_class();

            ?>
            <div class="mkdf-shopping-cart-holder" <?php holmes_mkdf_inline_style($icon_styles) ?>>
                <span class="mkdf-header-icon-label mkdf-hil-close mkdf-cart-icon-text"><?php esc_html_e('Cart', 'holmes'); ?></span>
                <div class="mkdf-shopping-cart-inner">
                    <a itemprop="url" <?php holmes_mkdf_class_attribute($dropdown_cart_icon_class); ?>
                       href="<?php echo esc_url(wc_get_cart_url()); ?>">
                        <span class="mkdf-cart-icon"><?php echo holmes_mkdf_get_icon_sources_html('dropdown_cart', false, array('dropdown_cart' => 'yes')); ?></span>
                        <span class="mkdf-cart-number"><?php echo sprintf(_n('%d', '%d', WC()->cart->cart_contents_count, 'holmes'), WC()->cart->cart_contents_count); ?></span>
                    </a>
                    <div class="mkdf-shopping-cart-dropdown">
                        <ul>
                            <?php if (!$cart_is_empty) : ?>
                                <?php foreach ($woocommerce->cart->get_cart() as $cart_item_key => $cart_item) :
                                    $_product = $cart_item['data'];
                                    // Only display if allowed
                                    if (!$_product->exists() || $cart_item['quantity'] == 0) {
                                        continue;
                                    }
                                    // Get price
                                    $product_price = get_option('woocommerce_tax_display_cart') == 'excl' ? wc_get_price_excluding_tax($_product) : wc_get_price_including_tax($_product);
                                    ?>
                                    <li>
                                        <div class="mkdf-item-image-holder">
                                            <a itemprop="url"
                                               href="<?php echo esc_url(get_permalink($cart_item['product_id'])); ?>">
                                                <?php echo wp_kses($_product->get_image(), array(
                                                    'img' => array(
                                                        'src'    => true,
                                                        'width'  => true,
                                                        'height' => true,
                                                        'class'  => true,
                                                        'alt'    => true,
                                                        'title'  => true,
                                                        'id'     => true
                                                    )
                                                )); ?>
                                            </a>
                                        </div>
                                        <div class="mkdf-item-info-holder">
                                            <h5 itemprop="name" class="mkdf-product-title">
                                                <a itemprop="url"
                                                   href="<?php echo esc_url(get_permalink($cart_item['product_id'])); ?>"><?php echo apply_filters('holmes_mkdf_woo_widget_cart_product_title', $_product->get_name(), $_product); ?></a>
                                            </h5>
                                            <?php if (apply_filters('holmes_mkdf_woo_cart_enable_quantity', true)) { ?>
                                                <span class="mkdf-quantity"><?php esc_html_e('Quantity: ', 'holmes');
                                                    echo esc_html($cart_item['quantity']); ?></span>
                                            <?php } ?>
                                            <?php echo apply_filters('holmes_mkdf_woo_cart_item_price_html', wc_price($product_price), $cart_item, $cart_item_key); ?>
                                            <?php echo apply_filters('holmes_mkdf_woo_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s"><span class="icon_close"></span></a>', esc_url(wc_get_cart_remove_url($cart_item_key)), esc_attr__('Remove this item', 'holmes')), $cart_item_key); ?>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                                <li class="mkdf-cart-bottom">
                                    <div class="mkdf-btn-holder clearfix">
                                        <a itemprop="url" href="<?php echo esc_url(wc_get_cart_url()); ?>"
                                           class="mkdf-cart"><?php esc_html_e('Cart', 'holmes'); ?></a>
                                        <a itemprop="url" href="<?php echo esc_url(wc_get_checkout_url()); ?>"
                                           class="mkdf-checkout"><?php esc_html_e('Checkout', 'holmes'); ?></a>
                                    </div>
                                </li>
                            <?php else : ?>
                                <li class="mkdf-empty-cart"><?php esc_html_e('No products in the cart.', 'holmes'); ?></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}

add_filter( 'woocommerce_add_to_cart_fragments', 'holmes_mkdf_woocommerce_header_add_to_cart_fragment' );

function holmes_mkdf_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	$cart_is_empty = sizeof( $woocommerce->cart->get_cart() ) <= 0;

	$dropdown_cart_icon_class = holmes_mkdf_get_dropdown_cart_icon_class();

	?>
    <div class="mkdf-shopping-cart-inner">
        <a itemprop="url" <?php holmes_mkdf_class_attribute( $dropdown_cart_icon_class ); ?> href="<?php echo esc_url( wc_get_cart_url() ); ?>">
            <span class="mkdf-cart-icon"><?php echo holmes_mkdf_get_icon_sources_html( 'dropdown_cart', false, array( 'dropdown_cart' => 'yes' ) ); ?></span>
            <span class="mkdf-cart-number"><?php echo sprintf( _n( '%d', '%d', WC()->cart->cart_contents_count, 'holmes' ), WC()->cart->cart_contents_count ); ?></span>
        </a>
        <div class="mkdf-shopping-cart-dropdown">
            <ul>
				<?php if ( ! $cart_is_empty ) : ?>
					<?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :
						$_product = $cart_item['data'];
						// Only display if allowed
						if ( ! $_product->exists() || $cart_item['quantity'] == 0 ) {
							continue;
						}
						// Get price
						$product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? wc_get_price_excluding_tax( $_product ) : wc_get_price_including_tax( $_product );
						?>
                        <li>
                            <div class="mkdf-item-image-holder">
                                <a itemprop="url" href="<?php echo esc_url( get_permalink( $cart_item['product_id'] ) ); ?>">
									<?php echo wp_kses( $_product->get_image(), array(
										'img' => array(
											'src'    => true,
											'width'  => true,
											'height' => true,
											'class'  => true,
											'alt'    => true,
											'title'  => true,
											'id'     => true
										)
									) ); ?>
                                </a>
                            </div>
                            <div class="mkdf-item-info-holder">
                                <h5 itemprop="name" class="mkdf-product-title">
                                    <a itemprop="url" href="<?php echo esc_url( get_permalink( $cart_item['product_id'] ) ); ?>"><?php echo apply_filters( 'holmes_mkdf_woo_widget_cart_product_title', $_product->get_name(), $_product ); ?></a>
                                </h5>
								<?php if ( apply_filters( 'holmes_mkdf_woo_cart_enable_quantity', true ) ) { ?>
                                    <span class="mkdf-quantity"><?php esc_html_e( 'Quantity: ', 'holmes' );
										echo esc_html( $cart_item['quantity'] ); ?></span>
								<?php } ?>
								<?php echo apply_filters( 'holmes_mkdf_woo_cart_item_price_html', wc_price( $product_price ), $cart_item, $cart_item_key ); ?>
								<?php echo apply_filters( 'holmes_mkdf_woo_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s"><span class="icon_close"></span></a>', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), esc_attr__( 'Remove this item', 'holmes' ) ), $cart_item_key ); ?>
                            </div>
                        </li>
					<?php endforeach; ?>
                    <li class="mkdf-cart-bottom">
                        <div class="mkdf-btn-holder clearfix">
                            <a itemprop="url" href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="mkdf-cart"><?php esc_html_e( 'Cart', 'holmes' ); ?></a>
                            <a itemprop="url" href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="mkdf-checkout"><?php esc_html_e( 'Checkout', 'holmes' ); ?></a>
                        </div>
                    </li>
				<?php else : ?>
                    <li class="mkdf-empty-cart"><?php esc_html_e( 'No products in the cart.', 'holmes' ); ?></li>
				<?php endif; ?>
            </ul>
        </div>
    </div>

	<?php
	$fragments['div.mkdf-shopping-cart-inner'] = ob_get_clean();

	return $fragments;
}

?>