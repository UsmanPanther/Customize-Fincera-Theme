<?php
/**
 * fionca functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package fionca
 */
define( 'FIONCA_THEME_URI', get_template_directory_uri() );
define( 'FIONCA_THEME_DRI', get_template_directory() );
define( 'FIONCA_IMG_URL', FIONCA_THEME_URI . '/assets/images/' );
define( 'FIONCA_CSS_URL', FIONCA_THEME_URI . '/assets/css/' );
define( 'FIONCA_JS_URL', FIONCA_THEME_URI . '/assets/js/' );
define( 'FIONCA_FRAMEWORK_DRI', FIONCA_THEME_DRI . '/framework/' );

require_once FIONCA_FRAMEWORK_DRI . 'styles/index.php';
require_once FIONCA_FRAMEWORK_DRI . 'scripts/index.php';
require_once FIONCA_FRAMEWORK_DRI . 'redux/redux-config.php';
require_once FIONCA_FRAMEWORK_DRI . '/plugin-list.php';
require_once FIONCA_FRAMEWORK_DRI . 'tgm/class-tgm-plugin-activation.php';
require_once FIONCA_FRAMEWORK_DRI . 'tgm/config-tgm.php';
require_once FIONCA_FRAMEWORK_DRI . '/dashboard/class-dashboard.php';
require_once FIONCA_THEME_DRI . '/assets/css/custom-style.php';

/**
 * Theme option compatibility.
 */


require_once get_template_directory() . '/inc/bootstrap-walker-menu.php';


if ( ! function_exists( 'fionca_get_options' ) ) :
	function fionca_get_options( $key ) {
		global $fionca_options;
		$opt_pref = 'fionca_';
		if ( empty( $fionca_options ) ) {
			$fionca_options = get_option( $opt_pref . 'options' );
		}
		$index = $opt_pref . $key;
		if ( ! isset( $fionca_options[ $index ] ) ) {
			return '';
		}
		return $fionca_options[ $index ];
	}
endif;


if ( ! function_exists( 'fionca_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function fionca_setup() {
		/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on love us, use a find and replace
		* to change 'fionca' to the name of your theme in all the template files.
		*/
		load_theme_textdomain( 'fionca', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
		add_theme_support( 'title-tag' );

		/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
		add_theme_support( 'post-thumbnails' );

		add_theme_support( 'woocommerce' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary'      => esc_html__( 'Primary', 'fionca' ),
				'top_bar'      => esc_html__( 'Top Menu', 'fionca' ),
				'footer_menu'  => esc_html__( 'Footer Menu', 'fionca' ),
				'service_menu' => esc_html__( 'Service Menu', 'fionca' ),
			)
		);

		/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'fionca_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
		add_filter( 'get_custom_logo', 'change_logo_class' );

		function change_logo_class( $html ) {

			$html = str_replace( 'custom-logo', 'main-nav__logo', $html );
			$html = str_replace( 'custom-logo-link', 'main-logo', $html );

			return $html;
		}

		add_image_size( 'fionca-blog-classic', 830, 453, true );
		add_image_size( 'fionca-blog-grid', 360, 280, true );
		add_image_size( 'fionca-blog-grid-big', 500, 595, true );
		add_image_size( 'fionca-blog-grid-2', 290, 300, true );
		add_image_size( 'fionca-recent-post-size', 80, 80, true );
		add_image_size( 'fionca-blog-single', 830, 453, true );

	}
endif;
add_action( 'after_setup_theme', 'fionca_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function fionca_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'fionca_content_width', 640 );
}
add_action( 'after_setup_theme', 'fionca_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function fionca_widgets_init() {
	register_sidebar(
		array(

			'name'          => esc_html__( 'Blog Sidebar', 'fionca' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'fionca' ),
			'before_widget' => '<div id="%1$s" class="sidebar-widget %1$s %2$s %s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="widget-title"><h3>',
			'after_title'   => '</h3></div>',
		)
	);
	if ( class_exists( 'woocommerce' ) ) {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Woo Shop Sidebar', 'fionca' ),
				'id'            => 'woo_shop_sideber',
				'before_widget' => '<div class="%2$s sidebar-widget widget" id="%1$s"><div class="widget-content">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<div class="widget-title"><h3>',
				'after_title'   => '</h3><div class="line"></div></div>',
			)
		);
	}
}
add_action( 'widgets_init', 'fionca_widgets_init' );

add_filter( 'widget_tag_cloud_args', 'fionca_tag_cloud_widget' );
function fionca_tag_cloud_widget() {
	$tag_args = array(
		'format' => 'list',
		'echo'   => false,
	);
	return $tag_args;
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * preloader compatibility.
 */
function fionca_preloader_fun() {   ?>
	<!-- Preloader -->
	<div class="loader-wrap">
		<div class="preloader">
			<div class="preloader-close"><?php echo esc_html( 'Preloader Close' ); ?></div>
		</div>
		<div class="layer layer-one"><span class="overlay"></span></div>
		<div class="layer layer-two"><span class="overlay"></span></div>
		<div class="layer layer-three"><span class="overlay"></span></div>
	</div>
	<?php
}
add_action( 'fionca_preloader', 'fionca_preloader_fun' );
/**
 * back to top compatibility.
 */
function fionca_back_to_top_fun() {
	?>
	<!--Scroll to top-->
	<button class="scroll-top scroll-to-target" data-target="html">
		<span class="fa fa-arrow-up"></span>
	</button>
	<?php
}
add_action( 'back_to_top', 'fionca_back_to_top_fun' );
/**
 * google font compatibility.
 */
function fionca_google_font() {
	 $protocol  = is_ssl() ? 'https' : 'http';
	$subsets    = 'latin,cyrillic-ext,latin-ext,cyrillic,greek-ext,greek,vietnamese';
	$variants   = ':400,400i,700,700i&display=swap';
	$query_args = array(
		'family' => 'Arimo' . $variants,
		'subset' => $subsets,
	);
	$font_url   = add_query_arg( $query_args, $protocol . '://fonts.googleapis.com/css' );
	wp_enqueue_style( 'fionca-google-fonts', $font_url, array(), null );
}
add_action( 'init', 'fionca_google_font' );

/**
 * is_blog compatibility.
 */
function is_blog() {
	if ( ( is_archive() ) || ( is_author() ) || ( is_category() ) || ( is_home() ) || ( is_single() ) || ( is_tag() ) ) {
		return true;
	} else {
		return false;
	}
}
/**
 * excerpt_length compatibility.
 */
function fionca_excerpt_length( $length ) {
	 return 20;
}
add_filter( 'excerpt_length', 'fionca_excerpt_length', 999 );
/*
* excerpt_more compatibility.
*/
function fionca_wpdocs_excerpt_more( $more ) {
	return ' <span>...</span>';
}
add_filter( 'excerpt_more', 'fionca_wpdocs_excerpt_more' );

function fionca_elementor_library() {
	$pageslist = get_posts(
		array(
			'post_type'      => 'elementor_library',
			'posts_per_page' => -1,
		)
	);
	$pagearray = array();
	if ( ! empty( $pageslist ) ) {
		foreach ( $pageslist as $page ) {
			$pagearray[ $page->ID ] = $page->post_title;
		}
	}
	return $pagearray;
}

function fionca_add_query_vars_filter( $vars ) {
	$vars[] = 'header_type';
	$vars[] = 'blog_type';
	return $vars;
}
add_filter( 'query_vars', 'fionca_add_query_vars_filter' );

function fionca_kses_allowed_html( $tags, $context ) {
	switch ( $context ) {

		case 'code_context':
			$tags = array(
				'div'    => array(
					'class' => array(),
				),
				'ul'     => array(
					'class' => array(),
				),
				'li'     => array(),
				'span'   => array(
					'class' => array(),
				),
				'a'      => array(
					'href'  => array(),
					'class' => array(),
					'target' => array(),
					'nofollow' => array(),
				),
				'i'      => array(
					'class' => array(),
				),
				'p'      => array(),
				'em'     => array(),
				'br'     => array(),
				'strong' => array(),
				'h1'     => array(),
				'h2'     => array(),
				'h3'     => array(),
				'h4'     => array(),
				'h5'     => array(),
				'h6'     => array(),
				'del'    => array(),
				'ins'    => array(),
			);
			return $tags;

		case 'social':
			$tags = array(
				'a'      => array( 'href' => array() ),
				'p'      => array(),
				'em'     => array(),
				'strong' => array(),
				'br'     => array(),
				'i'      => array(
					'class' => array(),
				),

			);
			return $tags;
		case 'author_avatar':
			$tags = array(
				'img' => array(
					'class'  => array(),
					'height' => array(),
					'width'  => array(),
					'src'    => array(),
					'alt'    => array(),
				),
			);
			return $tags;
		default:
			return $tags;
	}
}
add_filter( 'wp_kses_allowed_html', 'fionca_kses_allowed_html', 10, 2 );

// --------------------------- PASSWORD PROTECTED FORM
add_filter( 'the_password_form', 'fionca_custom_password_form' );
function fionca_custom_password_form() {
	global $post;
	$label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
	$o     = '<form class="protected-post-form" action="' . get_option( 'siteurl' ) . '/wp-login.php?action=postpass" method="post">
	<lebel>' . esc_html__( 'This content is password protected. To view it please enter your password below:', 'fionca' ) . '</level>
	<div class="form">
		<input placeholder="' . esc_attr__( 'Enter your password', 'fionca' ) . '" name="post_password" id="' . $label . '" type="password"/>
		<button type="submit" name="Submit" class="theme-btn">' . esc_attr__( 'Enter', 'fionca' ) . '</button>
	</div></form>';
	return $o;
}

function fionca_body_classes( $classes ) {
	$base_theme_on_off    = fionca_get_options( 'base_theme_on_off' );
	$theme_base_css_class = 'base-theme';
	if ( $base_theme_on_off == 1 ) :
		$theme_base_css_class = '';
	endif;

	$classes[] = $theme_base_css_class;

	return $classes;
}
add_filter( 'body_class', 'fionca_body_classes' );

/**
* Create Logo Setting and size Control
*/
function fionca_new_customizer_settings($wp_customize) {
	// add a setting for the site logo size
	$wp_customize->add_setting('fionca_logo_max_width', array(
		'sanitize_callback'  => 'esc_attr',
	));
	// Add a control to upload the logo size
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fionca_logo_max_width',
	array(
	'label' => 'Logo Max Width in px Value',
	'section' => 'title_tagline',
	'settings' => 'fionca_logo_max_width',
	'type'   => 'number',
	'priority' => 10,
	) ) );
	$wp_customize->add_setting('fionca_sticky_logo_max_width', array(
		'sanitize_callback'  => 'esc_attr',
	));
	// Add a control to upload the logo size
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fionca_sticky_logo_max_width',
	array(
	'label' => 'Sticky Logo Max Width in px Value',
	'section' => 'title_tagline',
	'settings' => 'fionca_sticky_logo_max_width',
	'type'   => 'number',
	'priority' => 10,
	) ) );
	$wp_customize->add_setting('fionca_responsive_logo_max_width', array(
		'sanitize_callback'  => 'esc_attr',
	));
	// Add a control to upload the logo size
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fionca_responsive_logo_max_width',
	array(
	'label' => 'Responsive Logo Max Width in px Value',
	'section' => 'title_tagline',
	'settings' => 'fionca_responsive_logo_max_width',
	'type'   => 'number',
	'priority' => 10,
	) ) );
	}
add_action('customize_register', 'fionca_new_customizer_settings');