<?php if ( class_exists( 'WooCommerce' ) ) : ?>
	<div class="header-cart">
		<a class="cart-menu cart-contents icon-cart" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'liwa' ); ?>">
			<?php $cart_count = WC()->cart->get_cart_contents_count(); ?>
			<span class="cart-count"><?php echo esc_html( $cart_count ); ?></span>
		</a>
	</div>
<?php endif; ?>	