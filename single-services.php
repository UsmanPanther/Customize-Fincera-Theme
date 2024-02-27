<?php
get_header();
$prefix                  = 'fionca_metabox';
$post_id                 = get_the_ID();
$single_service_subtitle = get_post_meta( $post_id, "{$prefix}_sub_title", true );
$single_service_title    = get_post_meta( $post_id, "{$prefix}_title", true );
?>
<section class="service-details"> 
	<div class="auto-container">
		<div class="row clearfix">
			<div class="col-lg-8 col-md-12 col-sm-12 content-side">
				<div class="service-details-content">
				<div class="content-style-one">
				<?php if ( has_post_thumbnail() ) : ?>
					<figure class="image-box"><?php the_post_thumbnail(); ?></figure>
					<?php endif; ?>
					<div class="sec-title left">
						<h5><?php echo esc_html( $single_service_subtitle ); ?></h5>
						<h2><?php echo esc_html( $single_service_title ); ?></h2>
					</div>
				</div>
			   
				<?php
					while ( have_posts() ) :
						the_post();
						the_content();
					endwhile; // End of the loop.
				?>
				</div>
			</div>   
			<div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
				<div class="service-sidebar default-sidebar">
				<?php dynamic_sidebar( 'sidebar-2' ); ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
$service_widget_meta_elementor = rwmb_meta( 'fionca_metabox_select_service_widget' );
if ( class_exists( '\\Elementor\\Plugin' ) ) {
	if ( is_array( $service_widget_meta_elementor ) && ! empty( $service_widget_meta_elementor ) ) :
		$pluginElementor = \Elementor\Plugin::instance();

		?>
		<?php
		foreach ( $service_widget_meta_elementor as $single_value ) {
			$fionca_all_save_element = $pluginElementor->frontend->get_builder_content( $single_value );
			echo do_shortcode( $fionca_all_save_element );
		}
		?>

		<?php

	endif;
}
get_footer();
