<?php 
			
if ( function_exists( 'icl_get_languages' ) && !empty(icl_get_languages( 'skip_missing=0' ))) : 
$languages = icl_get_languages( 'skip_missing=0' );
else :
	// Simulate WPML language array for testing
	$languages = array(
		'en' => array(
			'id' => '1',
			'active' => true,
			'native_name' => 'English',
			'missing' => 0,
			'translated_name' => 'English',
			'language_code' => 'en',
			'country_flag_url' => 'https://staging15.liwadates.com/wp-content/plugins/sitepress-multilingual-cms/res/flags/en.png',
			'url' => home_url( '/' ),
			'tag' => 'en'
		),
		'ar' => array(
			'id' => '2',
			'active' => false,
			'native_name' => 'العربية',
			'missing' => 0,
			'translated_name' => 'Arabic',
			'language_code' => 'ar',
			'country_flag_url' => 'https://staging15.liwadates.com/wp-content/plugins/sitepress-multilingual-cms/res/flags/ar.png',
			'url' => home_url( '/ar/' ),
			'tag' => 'ar'
		)
	);
endif;
if ( ! empty( $languages ) ) : 
?>
	<div class="header-language-switcher dropdown">
		<?php 
		// Find the active language for the dropdown button
		$active_lang = null;
		foreach ( $languages as $lang ) {
			if ( $lang['active'] ) {
				$active_lang = $lang;
				break;
			}
		}
		?>
		
		<button class="dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false">
			<?php if ( ! empty( $active_lang['country_flag_url'] ) ) : ?>
				<img class="active-language-flag" src="<?php echo esc_url( $active_lang['country_flag_url'] ); ?>" alt="<?php echo esc_attr( $active_lang['native_name'] ); ?>" />
			<?php endif; ?>
			<svg class="language-globe" width="24" height="24" viewBox="0 0 24 24" fill="#95684B">
				<path d="M21 12C21 11.3124 20.9205 10.6434 20.7744 10H16.8369C16.9307 10.6528 16.9861 11.3139 17 11.9795C17.0003 11.9932 17.0003 12.0068 17 12.0205C16.9861 12.6861 16.9307 13.3472 16.8369 14H20.7744C20.9205 13.3566 21 12.6876 21 12ZM3.9375 16C5.08279 18.304 7.18516 20.0474 9.72559 20.709C8.76236 19.261 8.03823 17.6709 7.5791 16H3.9375ZM16.4209 16C15.9617 17.671 15.2368 19.2609 14.2734 20.709C16.8143 20.0476 18.9171 18.3043 20.0625 16H16.4209ZM9.66797 16C10.1752 17.6005 10.9617 19.1059 12 20.4443C13.0383 19.1059 13.8248 17.6005 14.332 16H9.66797ZM9.1875 10C9.07933 10.6582 9.01502 11.3262 9 12C9.01502 12.6738 9.07933 13.3418 9.1875 14H14.8125C14.9207 13.3418 14.984 12.6738 14.999 12C14.984 11.3262 14.9207 10.6582 14.8125 10H9.1875ZM14.2734 3.29004C15.237 4.73834 15.9616 6.32871 16.4209 8H20.0625C18.917 5.69561 16.8144 3.95141 14.2734 3.29004ZM12 3.55469C10.9615 4.89326 10.1752 6.39927 9.66797 8H14.332C13.8248 6.39927 13.0385 4.89326 12 3.55469ZM9.72559 3.29004C7.18505 3.95159 5.08283 5.69589 3.9375 8H7.5791C8.0383 6.32889 8.76213 4.73822 9.72559 3.29004ZM3 12C3 12.6876 3.07955 13.3566 3.22559 14H7.16309C7.06927 13.3472 7.01387 12.6861 7 12.0205C6.99972 12.0068 6.99972 11.9932 7 11.9795C7.01387 11.3139 7.06927 10.6528 7.16309 10H3.22559C3.07955 10.6434 3 11.3124 3 12ZM23 12C23 18.0751 18.0751 23 12 23C5.92487 23 1 18.0751 1 12C1 5.92487 5.92487 1 12 1C18.0751 1 23 5.92487 23 12Z" fill="#95684B"/>
			</svg>
			<span class="language-name"><?php echo esc_html( $active_lang ? $active_lang['native_name'] : 'Language' ); ?></span>
			<svg class="dropdown-arrow" width="14" height="8" viewBox="0 0 14 8" fill="none">
				<path d="M1.35372 0.555285C1.4756 0.716659 1.83951 1.1984 2.05624 1.47611C2.49031 2.03233 3.08342 2.77142 3.72323 3.50831C4.36627 4.24893 5.04178 4.97022 5.64189 5.50046C5.94281 5.76634 6.20714 5.96837 6.42527 6.09987C6.63042 6.22355 6.75161 6.24927 6.75161 6.24927C6.75161 6.24927 6.86923 6.22355 7.07437 6.09988C7.2925 5.96838 7.55684 5.76635 7.85775 5.50047C8.45786 4.97022 9.13337 4.24892 9.77641 3.5083C10.4162 2.7714 11.0093 2.0323 11.4434 1.47608C11.6601 1.19837 12.0235 0.717304 12.1454 0.555928C12.3911 0.222405 12.8611 0.150469 13.1946 0.396102C13.5281 0.641734 13.5994 1.11123 13.3537 1.44476L13.3518 1.4473C13.224 1.61655 12.8471 2.11556 12.6259 2.39892C12.1821 2.9677 11.5716 3.72861 10.9091 4.49171C10.2497 5.25109 9.52408 6.02979 8.85096 6.62454C8.51526 6.92116 8.17497 7.18788 7.8488 7.3845C7.54322 7.56872 7.15633 7.75 6.74982 7.75C6.34331 7.75 5.95642 7.56871 5.65084 7.3845C5.32468 7.18787 4.98439 6.92116 4.64869 6.62454C3.97557 6.02979 3.2499 5.2511 2.59058 4.49173C1.92803 3.72863 1.3176 2.96774 0.873719 2.39896C0.652432 2.11541 0.275506 1.61637 0.147929 1.44747L0.146279 1.44528C-0.0993552 1.11176 -0.0284597 0.641787 0.305062 0.396152C0.638572 0.150526 1.10808 0.221792 1.35372 0.555285Z" fill="#95684B"/>
			</svg>
		</button>

		<ul class="dropdown-menu">
			<?php foreach ( $languages as $lang ) : ?>
				<li class="dropdown-item <?php echo $lang['active'] ? 'active' : ''; ?>">
					<a href="<?php echo esc_url( $lang['url'] ); ?>">
						<?php if ( ! empty( $lang['country_flag_url'] ) ) : ?>
							<img src="<?php echo esc_url( $lang['country_flag_url'] ); ?>" alt="<?php echo esc_attr( $lang['native_name'] ); ?>" />
						<?php endif; ?>
						<span><?php echo esc_html( $lang['native_name'] ); ?></span>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>