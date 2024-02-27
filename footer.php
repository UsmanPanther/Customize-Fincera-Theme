<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package fionca
 */

	$fionca_social        = fionca_get_options( 'fionca_social' );
	$fionca_social_global = fionca_get_options( 'fionca_social_global' );
	$back_to_top_on_off   = fionca_get_options( 'back_to_top_on_off' );
	$footer_copyright     = fionca_get_options( 'footer_copyright' );
	$footer_social        = fionca_get_options( 'footer_social_on_off' );

	$footer_style_select = get_post_meta( get_the_ID(), 'fionca_metabox_footer_style_select', true );
	if ( ! $footer_style_select ) {
		$footer_style_select = fionca_get_options( 'footer_style' );
	}
	$footer_class = '';
	$unittest_on_off = fionca_get_options( 'unittest_on_off' );
	if ( $footer_style_select == '5' ) {
		$footer_class = '';
	} elseif ( $footer_style_select == '2' ) {
		$footer_class = 'alternet-2';
	} elseif ( $footer_style_select == '3' ) {
		$footer_class = 'alternet-3';
	} elseif ( $footer_style_select == '4' ) {
		$footer_class = 'alternet-4';
	} else {
		$footer_class = 'alternet-5';
	}
?>
	<footer class="main-footer <?php echo esc_attr( $footer_class ); ?>">
		<?php
			if ( $unittest_on_off ) {
				get_template_part( 'components/footer/footer-top' );
			}
		?>
		<div class="footer-bottom">
			<div class="auto-container">
				<div class="copyright">
					<?php if ( $footer_copyright ) { ?>
						<p><?php echo wp_kses( $footer_copyright, 'code_context' ); ?></p>
					<?php } else { ?>
						<p><?php echo esc_html__('&copy; 2020 FIONCA. All Rights Reserved', 'fionca'); ?></p>
					<?php }; ?>
				</div>
			</div>
		</div>
	</footer>
<?php
	if ( $back_to_top_on_off == '1' ) :
		do_action( 'back_to_top' );
	endif;
?>
</div>
	<?php wp_footer(); ?>
</body>
</html>
