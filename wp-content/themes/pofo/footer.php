<?php
/**
 * The template for displaying the footer
 *
 * @package Pofo
 */

	// Exit if accessed directly.
	if ( ! defined( 'ABSPATH' ) ) { exit; }
	
	$pofo_box_layout = pofo_option( 'pofo_enable_box_layout', '' );
	if( $pofo_box_layout == '1' ) {
		echo '</div><!-- .box-layout -->';
	}

	// Enable / Disable Footer Wrapper
	$pofo_disable_footer_wrapper = pofo_option( 'pofo_disable_footer_wrapper', '0' );
	// Enable / Disable Footer
	$pofo_disable_footer = pofo_option( 'pofo_disable_footer', '1' );
	// Enable / Disable Footer Bottom
	$pofo_disable_footer_bottom = pofo_option( 'pofo_disable_footer_bottom', '1' );

	if( $pofo_disable_footer_wrapper == 1 || $pofo_disable_footer == 1 || $pofo_disable_footer_bottom == 1 ){
		echo '<footer id="colophon" class="pofo-footer bg-extra-dark-gray site-footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter">';
			if( $pofo_disable_footer_wrapper == 1 ):
				get_template_part( 'templates/footer/footer-wrapper-content' );
			endif;
			if( $pofo_disable_footer == 1 ):
				get_template_part( 'templates/footer/content' );
			endif;
			if( $pofo_disable_footer_bottom == 1 ):
				get_template_part( 'templates/footer/footer-bottom-content' );
			endif;
		echo '</footer>';
	}

	$pofo_header_layout = pofo_option( 'pofo_header_type', 'headertype1' );
	if( $pofo_header_layout == 'headertype3' ) {
		echo '</div>';
	}

	$pofo_hide_scroll_to_top = get_theme_mod( 'pofo_hide_scroll_to_top', '1' );
    $pofo_hide_scroll_to_top_on_phone =  get_theme_mod( 'pofo_hide_scroll_to_top_on_phone','0' );
	if( $pofo_hide_scroll_to_top == 1 ) {
		$mobile_class = $pofo_hide_scroll_to_top_on_phone == 0 ? ' sm-display-none' : '';
		echo '<a class="scroll-top-arrow' . esc_attr( $mobile_class ) . '" href="javascript:void(0);"><i class="ti-arrow-up"></i></a>';
	}
	// GDPR 
	$pofo_gdpr_enable		= get_theme_mod( 'pofo_gdpr_enable', '0' );
	$pofo_gdpr_enable 		= apply_filters( 'pofo_gdpr_enable', $pofo_gdpr_enable );
	$pofo_gdpr_text			= get_theme_mod( 'pofo_gdpr_text', sprintf( '%s <a href="#">%s</a>', esc_html__( 'Our site uses cookies. By continuing to our site you are agreeing to our cookie', 'pofo' ), esc_html__( 'privacy policy', 'pofo' ) ) );
	$pofo_gdpr_button_text = get_theme_mod( 'pofo_gdpr_button_text', __( 'GOT IT', 'pofo' ) );
	$pofo_gdpr_style		= get_theme_mod( 'pofo_gdpr_style', 'left-content' );
	$pofo_gdpr_style		= ! empty( $pofo_gdpr_style ) ? ' ' . $pofo_gdpr_style : '';
	$gdpr_cookie_name		= ( is_multisite() ) ? 'pofo_gdpr_cookie_notice_accepted-'.get_current_blog_id() : 'pofo_gdpr_cookie_notice_accepted';

	if ( ! isset( $_COOKIE[ $gdpr_cookie_name ] ) && $pofo_gdpr_enable == '1' ) {
		if ( ! empty( $pofo_gdpr_text ) || ! empty( $pofo_gdpr_button_text ) ) {
		?>
			<div class="pofo-cookie-policy-wrapper<?php echo esc_attr( $pofo_gdpr_style ) ?>">
				<div class="cookie-container">
					<?php if ( ! empty( $pofo_gdpr_text ) ) { ?>
						<div class="pofo-cookie-policy-text alt-font">
							<?php echo sprintf( '%s', $pofo_gdpr_text ); ?>
						</div>
					<?php } ?>
					<?php if ( ! empty( $pofo_gdpr_button_text ) ) { ?>
						<a class="btn btn-black pofo-cookie-policy-button"><?php echo esc_html( $pofo_gdpr_button_text ) ?></a>
					<?php } ?>
				</div>
			</div>
		<?php
		}
	}

	wp_footer();
?>
</body>
</html>