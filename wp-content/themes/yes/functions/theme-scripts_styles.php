<?php
/*-----------------------------------------------------------------------------------*/
/*  Enqueue styles and scripts
/*-----------------------------------------------------------------------------------*/

    // ENQUEUE STYLES
    function enqueue_styles() {

		global $lt_yes_theme;

		$protocol = is_ssl() ? 'https' : 'http';
		wp_enqueue_style( 'google-font-quicksand', "".$protocol."://fonts.googleapis.com/css?family=Quicksand:300,400,700");
		
		wp_enqueue_style( 'google-font-playfair', "".$protocol."://fonts.googleapis.com/css?family=Playfair+Display:400,700,400italic,700italic");

		wp_enqueue_style( 'google-font-great-vibes', "".$protocol."://fonts.googleapis.com/css?family=Great+Vibes");

        wp_register_style( 'basic', get_template_directory_uri() .'/assets/css/basic.css', array(), '1', 'all' );
        wp_enqueue_style( 'basic' );

        if(isset($lt_yes_theme['opt-animate'])) {
		    if($lt_yes_theme['opt-animate'] != 0) {		
		        wp_register_style( 'animate', get_template_directory_uri() .'/assets/css/animate.min.css', array(), '1', 'all' );
		        wp_enqueue_style( 'animate' );
			}
		}
		
		wp_register_style( 'font-awesome', get_template_directory_uri() .'/assets/css/font-awesome.min.css', array(), '1', 'all' );
        wp_enqueue_style( 'font-awesome' );

		wp_register_style( 'style', get_stylesheet_directory_uri() .'/style.css', array(), '1', 'all' );
        wp_enqueue_style( 'style' );

        // Dopuniti sa bojama
		if( (!isset($lt_yes_theme['opt-custom-color']) || ($lt_yes_theme['opt-custom-color'] == 0) || ($lt_yes_theme['opt-custom-color-code'] == '') ) ) {
			if(isset($lt_yes_theme['opt-theme-color'])) {
				wp_register_style( 'custom-color', get_template_directory_uri() .'/assets/css/colors/'.$lt_yes_theme['opt-theme-color'] , array(), '1', 'all' );
		        wp_enqueue_style( 'custom-color' );
			}
		}

    }

    add_action( 'wp_enqueue_scripts', 'enqueue_styles' );
        
    // ENQUEUE SCRIPTS
    function enqueue_scripts() {
		global $lt_yes_theme; //get theme options

		wp_enqueue_script( 'jquery', null, null, false );

		if( ! is_admin() ) 
			{

			if(isset($lt_yes_theme['opt-retina'])) {
			    if($lt_yes_theme['opt-retina'] != 0) {		
					wp_enqueue_script( 'retina-js', get_template_directory_uri() . '/assets/js/retina.min.js', array('jquery'), false, true );
				}
			}
			
			wp_enqueue_script( 'plugins-js', get_template_directory_uri() . '/assets/js/plugins.js', array('jquery'), false, true );

			if(isset($lt_yes_theme['opt-animate'])) {
			    if($lt_yes_theme['opt-animate'] != 0 && is_page()) {		
			        wp_enqueue_script( 'wow-js', get_template_directory_uri() . '/assets/js/wow.min.js', array('jquery'), false, true );
				}
			}

			if(is_singular()) {
				wp_enqueue_script( 'soc-share-js', get_template_directory_uri() . '/assets/js/jquery.soc-share.js', array('jquery'), false, true );
			}
			wp_enqueue_script( 'google-maps', 'https://maps.googleapis.com/maps/api/js?sensor=false', false, null, true);
			
			global $wp_query;
			if ( get_query_var('paged') ) {
		      $paged = get_query_var('paged');
		    } else if ( get_query_var('page') ) {
		      $paged = get_query_var('page');
		    } else {
		      $paged = 1;
		    }
		    if(is_front_page() && !is_home()) { //Home Page fix
			    $published_posts = wp_count_posts()->publish;
				$posts_per_page = get_option('posts_per_page');
				$page_number_max = ceil($published_posts / $posts_per_page);
		    } else {
				global $wp_query;
				$page_number_max = $wp_query->max_num_pages;
		    }
			$page_number_next = ($paged > 1) ? $paged + 1 : 2;

			wp_enqueue_script( 'custom-js', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), false, true );
			wp_localize_script('custom-js', 'admin_urls', 
				array( 
				'admin_ajax' => admin_url( 'admin-ajax.php'),
				'path'	=> get_template_directory_uri(),
				'page_number_max' => $page_number_max,
				'postCommentNonce' => wp_create_nonce( 'myajax-post-comment-nonce' ),
				'page_number_next' => $page_number_next,
				'postNonce' => wp_create_nonce( 'myajax-post-nonce' ) 
				)
			); // Call it after enqueue

			if(isset($lt_yes_theme['opt-preloader'])) {
			    if($lt_yes_theme['opt-preloader'] != 0) { 
			        if((is_front_page() && !is_home()) || $lt_yes_theme['opt-inside-preloader'] != 0) {
						wp_enqueue_script( 'queryloader2-js', get_template_directory_uri() . '/assets/js/imagesloaded.pkgd.js', array('jquery'), '3.1.8', true );
					}
				}
			}
			// Load Ajax Comments on single pages only
			if ( is_single() && get_option( 'thread_comments' ) ) 
			{ 
				wp_enqueue_script( 'comment-reply' ); 
			}

			//Custom Yes css
			$custom_css = '';
			if( isset($lt_yes_theme['opt-custom-css']) && trim($lt_yes_theme['opt-custom-css']) != '') {
				$custom_css .= $lt_yes_theme['opt-custom-css'];
			}	
			wp_add_inline_style( 'style', $custom_css );

			// Custom Color Scheme
			$color_scheme = '';
			$sec_color = '';
 			$output_scheme = '';
 			$custom_pattern = '';
			if( isset($lt_yes_theme['opt-custom-color']) && $lt_yes_theme['opt-custom-color'] != 0 && ($lt_yes_theme['opt-custom-color-code'] != '') ) {
				$color_scheme = $lt_yes_theme['opt-custom-color-code'];
				$output_scheme = '#comments h3.section-title span,#instagram-section .hash,#logo,#main-menu li.submenu:hover:after,#main-menu li:hover>a,#main-menu nav#navigation a.active,#main-menu nav#navigation a:hover,.tweets .follow:hover,.box .date:before,.box a,.form .column:after,.loaderOverlay i,.small-box .amount,.small-box .donate:hover,.social ul li a:hover,.timeline .column.heart:after,a,footer .logo span,h1,h2,h3,h4,h5,h6{color:'.$color_scheme.'}#page-content blockquote{border-left:3px solid '.$color_scheme.'}#back-home,#back-to-top,.invitation a,#menu-toggle,#menu-toggle:before,#navigation-dotted ul li a span,#navigation-dotted ul li a:before,.bgcolor,.form input[type=submit].color,.form input[type=submit].color:hover,.timeline-year span,a.button.fill,span.fill,input[type="submit"].color{background-color:'.$color_scheme.'}#navigation-dotted ul li a span:after{border-color:transparent transparent transparent '.$color_scheme.'}';
			} 

			if( isset($lt_yes_theme['opt-theme-sec-color']) && ($lt_yes_theme['opt-theme-sec-color'] != '') ) {
				$sec_color = $lt_yes_theme['opt-theme-sec-color'];
				$output_scheme .= '.pattern, .timeline .event-box.column.heart:after, .pattern, #wedding-events .timeline .column.heart:after,.box.pattern {background-color:'.$sec_color.'}';
			} 

			// Custom Pattern Scheme
			if( isset($lt_yes_theme['opt-custom-pattern']) && ($lt_yes_theme['opt-custom-pattern'] != '') ) {
				$custom_pattern = $lt_yes_theme['opt-custom-pattern'];
				$output_scheme .= '.pattern,.timeline .event-box.column.heart:after,.bgcolor,#blog .timeline .column.heart:after,#blog .timeline-button {background-image:url('.get_template_directory_uri().'/assets/images/bgs/'.$custom_pattern.');}';
			} 

			wp_add_inline_style( 'style', $output_scheme );	

		}

    }
    add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );


    // Custom Yes Editor Panel JS
	function lt_custom_js() {
		global $lt_yes_theme;
		if(isset($lt_yes_theme['opt-custom-js']) && ($lt_yes_theme['opt-custom-js'] !="jQuery(document).ready(function(){});")) { echo '<script>'. esc_js($lt_yes_theme['opt-custom-js']) .'</script>'; }
	}

	add_action('wp_footer', 'lt_custom_js', 100);
?>