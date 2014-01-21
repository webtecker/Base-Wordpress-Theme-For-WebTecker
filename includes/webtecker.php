<?php
/* Welcome to webtecker Base theme */

// we're firing all out initial functions at the start
add_action('after_setup_theme','webtecker_startup', 15);


function webtecker_startup() {

    // launching operation cleanup
    add_action('init', 'webtecker_head_cleanup');
    // remove WP version from RSS
    add_filter('the_generator', 'webtecker_rss_version');
    // remove pesky injected css for recent comments widget
    add_filter( 'wp_head', 'webtecker_remove_wp_widget_recent_comments_style', 1 );
    // clean up comment styles in the head
    add_action('wp_head', 'webtecker_remove_recent_comments_style', 1);
    // clean up gallery output in wp
    add_filter('gallery_style', 'webtecker_gallery_style');

    // enqueue base scripts and styles
    add_action('wp_enqueue_scripts', 'webtecker_scripts_and_styles', 999);
    // ie conditional wrapper
    add_filter( 'style_loader_tag', 'webtecker_ie_conditional', 10, 2 );

    // launching this stuff after theme setup
    add_action('after_setup_theme','webtecker_theme_support');
    // adding sidebars to Wordpress (these are created in functions.php)
    //add_action( 'widgets_init', 'webtecker_register_sidebars' );
    // adding the webtecker search form (created in functions.php)
    add_filter( 'get_search_form', 'webtecker_wpsearch' );

    // cleaning up random code around images
    add_filter('the_content', 'webtecker_filter_ptags_on_images');
    // cleaning up excerpt
    add_filter('excerpt_more', 'webtecker_excerpt_more');

} /* end webtecker Startup */


/*********************
Clean up wordpress head.
*********************/

function webtecker_head_cleanup() {
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// index link
	remove_action( 'wp_head', 'index_rel_link' );
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// WP version
	remove_action( 'wp_head', 'wp_generator' );
  // remove WP version from css
  add_filter( 'style_loader_src', 'webtecker_remove_wp_ver_css_js', 9999 );
  // remove Wp version from scripts
  add_filter( 'script_loader_src', 'webtecker_remove_wp_ver_css_js', 9999 );

} /* end webtecker head cleanup */

// remove WP version from RSS
function webtecker_rss_version() { return ''; }

// remove WP version from scripts
function webtecker_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}

// remove injected CSS for recent comments widget
function webtecker_remove_wp_widget_recent_comments_style() {
   if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
      remove_filter('wp_head', 'wp_widget_recent_comments_style' );
   }
}

// remove injected CSS from recent comments widget
function webtecker_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  }
}

// remove injected CSS from gallery
function webtecker_gallery_style($css) {
  return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}

// loading modernizr and jquery, and reply script
function webtecker_scripts_and_styles() {
  if (!is_admin()) {

    // modernizr (without media query polyfill)
    wp_register_script( 'webtecker-modernizr', get_stylesheet_directory_uri() . '/js/vendor/modernizr.min.js', array(), '2.6.2', false );

    // register main stylesheet
    wp_register_style( 'webtecker-stylesheet', get_stylesheet_directory_uri() . '/css/main.css', array(), '', 'all' );

    // ie-only style sheet
    //wp_register_style( 'webtecker-ie-only', get_stylesheet_directory_uri() . '/library/css/ie.css', array(), '' );

    // comment reply script for threaded comments
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
      wp_enqueue_script( 'comment-reply' );
    }

    //adding scripts file in the footer
	wp_register_script( 'webtecker-bootstrap-js', get_stylesheet_directory_uri() . '/js/vendor/bootstrap.min.js', array( 'jquery' ), '', true );
    wp_register_script( 'webtecker-plugins-js', get_stylesheet_directory_uri() . '/js/plugins.js', array( 'jquery' ), '', true );
	wp_register_script( 'webtecker-js', get_stylesheet_directory_uri() . '/js/main.js', array( 'jquery' ), '', true );

    // enqueue styles and scripts
    wp_enqueue_script( 'webtecker-modernizr' );
    wp_enqueue_style( 'webtecker-stylesheet' );
    wp_enqueue_style('webtecker-ie-only');


    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'webtecker-bootstrap-js' );
	wp_enqueue_script( 'webtecker-plugins-js' );
	wp_enqueue_script( 'webtecker-js' );

  }
}

// adding the conditional wrapper around ie stylesheet
// source: http://code.garyjones.co.uk/ie-conditional-style-sheets-wordpress/
function webtecker_ie_conditional( $tag, $handle ) {
	if ( 'webtecker-ie-only' == $handle )
		$tag = '<!--[if lt IE 9]>' . "\n" . $tag . '<![endif]-->' . "\n";
	return $tag;
}

/*********************
THEME SUPPORT
*********************/

// Adding WP 3+ Functions & Theme Support
function webtecker_theme_support() {

	// wp thumbnails (sizes handled in functions.php)
	add_theme_support('post-thumbnails');

	// default thumb size
	set_post_thumbnail_size(125, 125, true);

	// rss thingy
	add_theme_support('automatic-feed-links');

	// adding post format support
	add_theme_support( 'post-formats',
		array(
			'aside',             // title less blurb
			'gallery',           // gallery of images
			'link',              // quick link to other site
			'image',             // an image
			'quote',             // a quick quote
			'status',            // a Facebook like status update
			'video',             // video
			'audio',             // audio
			'chat'               // chat transcript
		)
	);

	// wp menus
	add_theme_support( 'menus' );

	// registering wp3+ menus
	register_nav_menus(
		array(
			'main-nav' => __( 'The Main Menu', 'webtecker' ),   // main nav in header
			'footer-links' => __( 'Footer Links', 'webtecker' ) // secondary nav in footer
		)
	);
} /* end webtecker theme support */

/*********************
MENUS & NAVIGATION
*********************/

// the main menu
function webtecker_main_nav() {
	// display the wp3 menu if available
    wp_nav_menu(array(
    	'container' => false,                           // remove nav container
    	'container_class' => 'nav-collapse',           // class of container (should you choose to use it)
    	'menu' => __( 'The Main Menu', 'webtecker' ),  // nav name
    	'menu_class'      => 'nav',         // adding custom nav class
    	'theme_location' => 'main-nav',                 // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 0,                                   // limit the depth of the nav
    	'fallback_cb' => 'webtecker_main_nav_fallback',      // fallback function
		'walker' => new bootstrap_Nav_Walker()			//walker
	));
} /* end webtecker main nav */

// the footer menu (should you choose to use one)
function webtecker_footer_links() {
	// display the wp3 menu if available
    wp_nav_menu(array(
    	'container' => '',                              // remove nav container
    	'container_class' => 'footer-links clearfix',   // class of container (should you choose to use it)
    	'menu' => __( 'Footer Links', 'webtecker' ),   // nav name
    	'menu_class' => 'nav footer-nav clearfix',      // adding custom nav class
    	'theme_location' => 'footer-links',             // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 0,                                   // limit the depth of the nav
    	'fallback_cb' => 'webtecker_footer_links_fallback'  // fallback function
	));
} /* end webtecker footer link */

// this is the fallback for header menu
function webtecker_main_nav_fallback() {
	wp_page_menu( array(
		'show_home' => true,
		'container_class' => 'nav-collapse',
    	'menu_class' => 'nav',      // adding custom nav class
		'include'     => '',
		'exclude'     => '',
		'echo'        => true,
        'link_before' => '',                            // before each link
        'link_after' => ''                             // after each link
	) );
}

// this is the fallback for footer menu
function webtecker_footer_links_fallback() {
	/* you can put a default here if you like */
}




/*********************
RANDOM CLEANUP ITEMS
*********************/

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function webtecker_filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// This removes the annoying […] to a Read More link
function webtecker_excerpt_more($more) {
	global $post;
	// edit here if you like
	return '...  <a href="'. get_permalink($post->ID) . '" title="Read '.get_the_title($post->ID).'">Read more &raquo;</a>';
}

/*
 * This is a modified the_author_posts_link() which just returns the link.
 *
 * This is necessary to allow usage of the usual l10n process with printf().
 */
function webtecker_get_the_author_posts_link() {
	global $authordata;
	if ( !is_object( $authordata ) )
		return false;
	$link = sprintf(
		'<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
		get_author_posts_url( $authordata->ID, $authordata->user_nicename ),
		esc_attr( sprintf( __( 'Posts by %s' ), get_the_author() ) ), // No further l10n needed, core will take care of this one
		get_the_author()
	);
	return $link;
}
?>