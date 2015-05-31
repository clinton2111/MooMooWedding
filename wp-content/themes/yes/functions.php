<?php

    /* Require Important Stuff
    ================================================== */
	$templatepath = get_template_directory();
	define('L_FUNCTIONS', $templatepath . '/functions/');
	require_once($templatepath.'/admin/init-panel.php' ); // Initialize Redux panel
	require_once(L_FUNCTIONS . '/theme-scripts_styles.php'); //Initialize JavaScripts and Styles
	require_once(L_FUNCTIONS . '/theme-image_resizer.php'); //Initialize Image Resizer
	require_once(L_FUNCTIONS . '/theme-functions.php'); //Initialize Functionality
	require_once(L_FUNCTIONS . '/theme-sidebars.php'); //Initialize Sidebar
	require_once(L_FUNCTIONS . '/theme-metaboxes.php'); //Initialize Meta Boxes
	if (is_admin()){
		require_once(L_FUNCTIONS . '/theme-plugins.php'); /* Required plugins for theme */
	}

    /* Translation Language Support
    ================================================== */
	if ( ! function_exists( 'yes_languages_setup' ) ) {
		function yes_languages_setup() {
			$language_dir = get_template_directory() . '/languages/';
			load_theme_textdomain( 'lt_yes', $language_dir );  // text domain is "iva"
		}
		add_action( 'after_setup_theme', 'yes_languages_setup' );
	}

    /* Thumbnail Size Options
    ================================================== */
	// Add support
	add_theme_support( 'post-thumbnails' );

	/* Register Menus
    ================================================== */
    function yes_excerpt_more($more) {
        global $post;
	    return '... <a class="more" href="'. get_permalink($post->ID) . '">Read more</a>';
	}
	add_filter('excerpt_more', 'yes_excerpt_more');

    /* Register Menus
    ================================================== */
	// Add support
	add_theme_support( 'menus' );
	// Register two navigation menus - standard stuff
	register_nav_menus(
	    array(
	    'main_menu'=>__( 'Main Menu', 'lt_yes' ),
	    'inside_menu'=>__( 'Inside Menu', 'lt_yes' )
	    )
	);

    /* Set Maximum Content Width
    ================================================== */
	if ( ! isset( $content_width ) ) {
		$content_width = 960;
	}

    /* Comment Walker
    ================================================== */
	class LT_Walker_Comment extends Walker_Comment
	{
	    function start_lvl( &$output, $depth = 0, $args = array() ) {
	        // do nothing.
	    }
	    function end_lvl( &$output, $depth = 0, $args = array() ) {
	        // do nothing.
	    }
	    function end_el( &$output, $comment, $depth = 0, $args = array() ) {
	        // do nothing, and no </li> will be created
	    }
	    protected function comment( $comment, $depth, $args ) {
	        // create the comment output
	        // use the code from your old callback here
	    }
	}

    /* Adds RSS feed links to <head> for posts and comments. Title tag and few fixes.
    ================================================== */
	add_theme_support( 'automatic-feed-links' );
	if ( ! function_exists( '_wp_render_title_tag' ) ) {
		function yes_render_title() {
	?>
		<title><?php wp_title( '|' ); ?></title>
	<?php
	}
		add_action( 'wp_head', 'yes_render_title' );
	}
	add_theme_support( "title-tag" );
	add_theme_support( 'post-formats', array( 'image' ) );

	wp_link_pages('before=<div class="page-links">Pages: &after=</div>');

?>