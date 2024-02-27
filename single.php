<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package fionca
 */
	get_header();
	$blog_class = '';
	if ( is_active_sidebar( 'sidebar-1' ) ) :
		$blog_class = 'col-lg-8 col-md-12 col-sm-12 content-side';
	else :
		$blog_class = 'col-lg-12';
	endif;
?>
	<section class="sidebar-page-container sec-pad">
		<div class="auto-container">
			<div class="row clearfix">
				<div class="<?php echo esc_attr( $blog_class ); ?>">
					<?php
						while ( have_posts() ) :
							the_post();
							get_template_part( 'template-parts/single/content' );
							// If comments are open or we have at least one comment, load up the comment template.
						endwhile; // End of the loop.
					?>
				</div>
				<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
					<div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
						<?php get_sidebar(); ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>
<?php
	get_footer();
