<?php
/**
 * _jbs functions and definitions
 *
 * @package _jbs
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 750; /* pixels */

if ( ! function_exists( '_jbs_setup' ) ) :
/**
 * Set up theme defaults and register support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function _jbs_setup() {
    global $cap, $content_width;

    // This theme styles the visual editor with editor-style.css to match the theme style.
    add_editor_style();

    if ( function_exists( 'add_theme_support' ) ) {

		/**
		 * Add default posts and comments RSS feed links to head
		*/
		add_theme_support( 'automatic-feed-links' );
		
		/**
		 * Enable support for Post Thumbnails on posts and pages
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		*/
		add_theme_support( 'post-thumbnails' );
		
		/**
		 * Enable support for Post Formats
		*/
		add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
		
		/**
		 * Setup the WordPress core custom background feature.
		*/
		add_theme_support( 'custom-background', apply_filters( '_jbs_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );
	
    }

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on _jbs, use a find and replace
	 * to change '_jbs' to the name of your theme in all the template files
	*/
	load_theme_textdomain( '_jbs', get_template_directory() . '/languages' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	*/ 
    register_nav_menus( array(
        'primary'  => __( 'Primary menu', '_jbs' ),
    ) );

}
endif; // _jbs_setup
add_action( 'after_setup_theme', '_jbs_setup' );

/**
 * Register custom post types
 */
/*
function _jbs_create_my_post_types() {
	register_post_type( 'sample',
		array(
			'labels' => array(
				'name' => __( 'Samples' ),
				'singular_name' => __( 'Sample' ),
				'add_new_item' => __( 'Add New Sample' ),
				'edit_item' => __( 'Edit Sample' ),
				'view' => __( 'View Sample' ),
				'view_item' => __( 'View Sample' ),	
				'not_found' => __( 'No samples found' )
			),
			'public' => true,
			'hierarchical' => false,
			'supports' => array( 'title', 'editor', 'thumbnail' )
		)
	);
}
add_action( 'init', '_jbs_create_my_post_types' );
*/

/**
 * Add custom taxonomies
 */
/*
function _jbs_add_custom_taxonomies() {
	register_taxonomy('taxonomy', 'samples', array(
		'hierarchical' => true,
		'labels' => array(
			'name' => _x( 'Taxonomies', 'taxonomy general name' ),
			'singular_name' => _x( 'Taxonomy', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Taxonomies' ),
			'all_items' => __( 'All Taxonomies' ),
			'edit_item' => __( 'Edit Taxonomy' ),
			'update_item' => __( 'Update Taxonomy' ),
			'add_new_item' => __( 'Add New Taxonomy' ),
			'new_item_name' => __( 'New Taxonomy Name' ),
			'menu_name' => __( Taxonomies' ),
		),
	));
}
add_action( 'init', '_jbs_add_custom_taxonomies', 0 );
*/

/**
 * Register widgetized area and update sidebar with default widgets
 */
function _jbs_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', '_jbs' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', '_jbs_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function _jbs_scripts() {
	wp_enqueue_style( '_jbs-style', get_stylesheet_uri() );

	// load bootstrap js
	wp_enqueue_script('_jbs-bootstrapjs', get_template_directory_uri().'/includes/js/bootstrap.js', array('jquery') );
		
	// load bootstrap wp js
	wp_enqueue_script( '_jbs-bootstrapwp', get_template_directory_uri() . '/includes/js/bootstrap-wp.js', array('jquery') );

	wp_enqueue_script( '_jbs-skip-link-focus-fix', get_template_directory_uri() . '/includes/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( '_jbs-keyboard-image-navigation', get_template_directory_uri() . '/includes/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', '_jbs_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/includes/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/includes/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/includes/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/includes/jetpack.php';

/**
 * Load nav walker file.
 */
require get_template_directory() . '/includes/bootstrap-wp-navwalker.php';

/**
 * Load Advanced Custom Fields options page.
 */
if(function_exists('acf_add_options_page')) { 
	acf_add_options_page();
}

/**
 * Add custom CSS/JS for Advanced Custom Fields.
 */
function _jbs_acf_admin_head()
{
	?>
	<style type="text/css">
		.acf-editor-wrap iframe {
		    max-height: 120px;
		}
	</style>

	<script type="text/javascript">
	(function($){

		/* ... */

	})(jQuery);
	</script>
	<?php
}
add_action('acf/input/admin_head', '_jbs_acf_admin_head');

/**
 * Filter media library by PDF
 */
function modify_post_mime_types( $post_mime_types ) {
    $post_mime_types['application/pdf'] = array( __( 'PDFs' ), __( 'Manage PDFs' ), _n_noop( 'PDF <span class="count">(%s)</span>', 'PDFs <span class="count">(%s)</span>' ) );
    return $post_mime_types; 
}
add_filter( 'post_mime_types', 'modify_post_mime_types' );