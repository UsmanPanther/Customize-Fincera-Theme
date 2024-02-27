<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fionca
 */
get_header();
$unittest_on_off = fionca_get_options( 'unittest_on_off' );
$unittest_class  = '';
if ( $unittest_on_off ) {
	$unittest_class = 'page-content';
} else {
	$unittest_class = 'page-content-unittest container sec-pad';
}

$page_single_col               = '12';
$page_single_col2 = '';
$fionca_theme_metabox_page_col = get_post_meta( get_the_ID(), 'fionca_metabox_page_col', true );
if ( $fionca_theme_metabox_page_col == 'on' ) :
	$page_single_col = '8';
	$page_single_col2 = 'service-details';
endif;

?>
	<section class="sidebar-page-container sec-pad page-single-rifa-t <?php echo esc_attr($page_single_col2).' '.esc_attr( $unittest_class ); ?>">
		<div class="auto-container">
			<div class="row clearfix">
				<?php
				if ( $fionca_theme_metabox_page_col == 'on' ) :
					do_action( 'page_advance_content_left' );
				endif;
				?>
				<div class="col-lg-<?php echo esc_attr( $page_single_col ); ?> col-md-12 col-sm-12 content-side">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content', 'page' );
						endwhile; // End of the loop.
					?>
				</div>
				<?php
				if ( $fionca_theme_metabox_page_col == 'on' ) :
					do_action( 'page_advance_content_right' );
				endif;
				?>
			</div>
		</div>
	</section>
<?php
get_footer();
