<?php
/**
 * Simvance functions and definitions
 *
 * @package Simvance
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

/**
 * Initialize Options Panel
 */
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
	require_once get_template_directory() . '/inc/options-framework.php';
}

if ( ! function_exists( 'simvance_setup' ) ) :

function simvance_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Simvance, use a find and replace
	 * to change 'simvance' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'simvance', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_image_size('homepage-thumb',235,235,true);

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'simvance' ),
	) );
	add_theme_support( 'post-formats', array( 'image', 'video', 'quote' ) );

	add_theme_support( 'custom-background', apply_filters( 'simvance_custom_background_args', array(
		'default-image' => get_template_directory_uri()."/images/bg.png",
	) ) );
}
endif; // simvance_setup
add_action( 'after_setup_theme', 'simvance_setup' );

function simvance_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'simvance' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'simvance_widgets_init' );

add_action('optionsframework_custom_scripts', 'simvance_custom_scripts');

function simvance_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#example_showhidden').click(function() {
  		jQuery('#section-example_text_hidden').fadeToggle(400);
	});
	
	if (jQuery('#example_showhidden:checked').val() !== undefined) {
		jQuery('#section-example_text_hidden').show();
	}
	
});
</script> 
<?php
}
function simvance_scripts() {
	wp_enqueue_style( 'simvance-fonts', '//fonts.googleapis.com/css?family=Droid+Serif:400,700|Bree+Serif');
	wp_enqueue_style( 'simvance-basic-style', get_stylesheet_uri() );
	if ( (function_exists( 'of_get_option' )) && (of_get_option('sidebar-layout', true) != 1) ) {
		if (of_get_option('sidebar-layout', true) ==  'right') {
			wp_enqueue_style( 'simvance-layout', get_stylesheet_directory_uri()."/css/layouts/content-sidebar.css" );
		}
		else {
			wp_enqueue_style( 'simvance-layout', get_stylesheet_directory_uri()."/css/layouts/sidebar-content.css" );
		}	
	}	
	else {
		wp_enqueue_style( 'simvance-layout', get_stylesheet_directory_uri()."/css/layouts/content-sidebar.css" );
	}
	wp_enqueue_style( 'simvance-bootstrap-style', get_stylesheet_directory_uri()."/css/bootstrap.min.css", array('simvance-fonts','simvance-layout') );
	wp_enqueue_style( 'simvance-main-style', get_stylesheet_directory_uri()."/css/main.css", array('simvance-fonts','simvance-layout') );
	
	wp_enqueue_script( 'simvance-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'simvance-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	
	wp_enqueue_style( 'simvance-nivo-slider-default-theme', get_stylesheet_directory_uri()."/css/nivo/themes/default/default.css" );
	
	wp_enqueue_style( 'simvance-nivo-slider-style', get_stylesheet_directory_uri()."/css/nivo/nivo.css" );
		
	wp_enqueue_script('simvance-collapse', get_template_directory_uri() . '/js/collapse.js', array('jquery') );
	
	wp_enqueue_script( 'simvance-nivo-slider', get_template_directory_uri() . '/js/nivo.slider.js', array('jquery') );
	
	wp_enqueue_script( 'simvance-superfish', get_template_directory_uri() . '/js/superfish.js', array('jquery') );

	
	wp_enqueue_script( 'simvance-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery') );
	
	wp_enqueue_script( 'simvance-custom-js', get_template_directory_uri() . '/js/custom.js', array('jquery','simvance-nivo-slider','simvance-superfish') );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'simvance-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'simvance_scripts' );

function simvance_custom_head_codes() {
 if ( (function_exists( 'of_get_option' )) && (of_get_option('headcode1', true) != 1) ) {
	echo of_get_option('headcode1', true);
 }
 if ( (function_exists( 'of_get_option' )) && (of_get_option('style2', true) != 1) ) {
	echo "<style>".of_get_option('style2', true)."</style>";
 }
 if ( get_header_image() ) {
 	echo "<style>#masthead {background: url(".get_header_image().");,height:450px, overflow: auto;}</style>";
 	}
}	
add_action('wp_head', 'simvance_custom_head_codes');

function simvance_nav_menu_args( $args = '' )
{
    $args['container'] = false;
    return $args;
} // function
add_filter( 'wp_page_menu_args', 'simvance_nav_menu_args' );

function simvance_pagination() {
	global $wp_query;
	$big = 12345678;
	$page_format = paginate_links( array(
	    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	    'format' => '?paged=%#%',
	    'current' => max( 1, get_query_var('paged') ),
	    'total' => $wp_query->max_num_pages,
	    'type'  => 'array'
	) );
	if( is_array($page_format) ) {
	            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
	            echo '<div class="pagination"><div><ul>';
	            echo '<li><span>'. $paged . ' of ' . $wp_query->max_num_pages .'</span></li>';
	            foreach ( $page_format as $page ) {
	                    echo "<li>$page</li>";
	            }
	           echo '</ul></div></div>';
	 }
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
 * Custom Menu For Bootstrap
 */
require get_template_directory() . '/inc/wp_bootstrap_navwalker.php';
/**
 * Custom functions that act independently of the theme templates. Import Widgets
 */
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/widgets.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
