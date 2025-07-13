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