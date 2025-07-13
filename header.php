<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package liwa
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">


	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'liwa' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php
			the_custom_logo();
			 
			  ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<?php esc_html_e( 'Primary Menu', 'liwa' ); ?>
			</button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-primary',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
		</nav><!-- #site-navigation -->

		<div class="header-widgets">
			<?php if ( class_exists( 'WooCommerce' ) ) : ?>
				<div class="header-cart">
					<a class="cart-menu cart-contents icon-cart" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'liwa' ); ?>">
						<?php $cart_count = WC()->cart->get_cart_contents_count(); ?>
						<span class="cart-count"><?php echo esc_html( $cart_count ); ?></span>
					</a>
				</div>
			<?php endif; ?>

			

			<div>
				<?php 
					wp_nav_menu(
						array(
							'theme_location' => 'menu-secondary',
							'menu_id'        => 'secondary-menu',
						)
					);
				?>
			</div>

			<?php if ( is_user_logged_in() ) : 
				$current_user = wp_get_current_user();
				$avatar = get_avatar( $current_user->ID, 56 );
				$profile_url = get_edit_profile_url( $current_user->ID );
			?>
				<div class="header-user-avatar">
					<a href="<?php echo esc_url( $profile_url ); ?>" title="<?php echo esc_attr( $current_user->display_name ); ?>">
						<?php echo $avatar; ?>
					</a>
				</div>
			<?php else : ?>
				<div class="header-login-link">
					<a href="<?php echo esc_url( wp_login_url() ); ?>">
						<?php esc_html_e( 'Login', 'liwa' ); ?>
					</a>
				</div>
			<?php endif; ?>
		</div>
	</header><!-- #masthead -->
