<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package fionca
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div class="boxed_wrapper">
		<?php
			$preloader_on_off = fionca_get_options( 'preloader_on_off' );
			if ( $preloader_on_off == '1' ) :
				do_action( 'fionca_preloader' );
			endif;
			get_template_part( 'components/header/header' );
			if ( is_singular( 'services' ) ) {
				get_template_part( 'components/header/breadcrumb/breadcrumb-service-single' );
			} elseif ( is_blog() ) {
				if ( is_home() ) {
					get_template_part( 'components/header/breadcrumb/breadcrumb-blog-index' );
				} elseif ( is_archive() ) {
					get_template_part( 'components/header/breadcrumb/breadcrumb-archive' );
				} elseif ( is_single() ) {
					get_template_part( 'components/header/breadcrumb/breadcrumb-single' );
				}
			} else {
				if ( ! is_home() && ! is_front_page() && ! is_search() && ! is_404() ) {
					get_template_part( 'components/header/breadcrumb/breadcrumb-page' );
				}
			}