<?php global $lt_yes_theme; //get theme options ?>
<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>

    <!-- Meta Tags
    ================================================== -->
	<meta charset="<?php bloginfo( 'charset' ); ?>" />

    <!-- Mobile Meta Tag
    ================================================== -->  
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Link Tags
    ================================================== -->  
    <link rel="alternate" type="text/xml" title="<?php bloginfo('name'); ?> RSS 0.92 Feed" href="<?php bloginfo('rss_url'); ?>">
    <link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>">
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS 2.0 Feed" href="<?php bloginfo('rss2_url'); ?>">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <!-- Favicons - ovo ubaciti u admin panel
    ================================================== --> 
    <?php if(!empty($lt_yes_theme['custom-favicon']['url'])) { ?>
    <link rel="icon" type="image/png" href="<?php echo esc_url($lt_yes_theme['custom-favicon']['url']); ?>" />
    <?php } ?>
    
	<!--[if lte IE 8]>
        <script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5.js"></script>
    <![endif]-->

    <!--=== WP_HEAD() ===-->
	<?php wp_head(); ?>
	
</head>
<body <?php body_class(); ?>>

    <?php
    // Enable/Disable Preloader on all pages or inside pages.
    if(isset($lt_yes_theme['opt-preloader'])) {
        if($lt_yes_theme['opt-preloader'] != 0) { 
            if((is_front_page() && !is_home()) || $lt_yes_theme['opt-inside-preloader'] != 0) { ?>
                <div class="loaderOverlay"><i class="fa fa-heart animate-spin"></i></div>
            <?php }
        }
    }

?>