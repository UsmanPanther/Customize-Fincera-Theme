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
get_template_part( 'components/header/breadcrumb/breadcrumb-404' ); 
?>
<section class="error-section centred">
    <div class="container">
        <div class="content-box">
            <h1><?php esc_html_e('404', 'fionca'); ?></h1>
            <h2><?php esc_html_e('Oops, This Page Not Be Found !', 'fionca'); ?></h2>
            <div class="text"><?php esc_html_e("Can't find what you need? Take a moment and do a search below or start from our", 'fionca'); ?> <a href="<?php echo get_home_url(); ?>"><?php esc_html_e('Homepage', 'fionca'); ?>.</a></div>
        </div>
    </div>
</section>
<?php
get_footer();
