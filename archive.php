<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fionca
 */
get_header();
	$blog_post_style 		= fionca_get_options('blog_post_style');
	$blog_type = get_query_var( 'blog_type' );
	if ($blog_post_style == '2' || $blog_type == '2') {
		$row_class = 'row';
	} else {
		$row_class = 'content-side';
	}
	$blog_class = '';
	$container_class = '';
	if (is_active_sidebar('sidebar-1') && $blog_type != '2') :
		$blog_class = 'col-lg-8 col-md-12 col-sm-12 content-side';
		$container_class = 'sidebar-page-container';
	else :
		$blog_class = 'col-lg-12';
	endif;
?>
<section class="<?php echo esc_attr($container_class); ?> news-section blog-grid sec-pad">
	<div class="auto-container">
		<div class="row clearfix">
			<div class="<?php echo esc_attr($blog_class); ?>">
				<div class="<?php echo esc_attr($row_class); ?>">
					<?php
					if (have_posts()) :

						while (have_posts()) :
							the_post();
							get_template_part('template-parts/content', get_post_format());

						endwhile;
					else :
						get_template_part('template-parts/content', 'none');
					endif;
					?>
				</div>

				<?php
				$pagination_blog = get_the_posts_pagination();
				if ($pagination_blog) :
				?>
					<div class="pagination-wrapper centred">
						<ul class="pagination clearfix">
							<?php
							the_posts_pagination(
								array(
									'type'      => 'list',
									'mid_size'  => 4,
									'prev_text' => '<i class="fas fa-arrow-left"></i>',
									'next_text' => '<i class="fas fa-arrow-right"></i>',
								)
							);
							?>
						</ul>
					</div>
				<?php endif; ?>
			</div>
			<?php
				if (is_active_sidebar('sidebar-1') && $blog_type != '2') {
				?>
					<div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
						<?php
						get_sidebar();
						?>
					</div>
				<?php
			}
			?>

		</div>
	</div>
</section>
<?php
get_footer();