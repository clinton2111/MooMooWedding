<?php
    global $lt_yes_theme;
    /*
    * This one is tricky, well.. confusing. We are calling this menu - page-nav.php in two places. 
    * One is in header.php and other is in shortcodes where hero is. Depending on what is set in admin panel, we need to change position and class.
    * And in custom.js we are calculating width of hero, so that it can show or hide menu.
    */
    $menu_class = $data_pos = $menu_type = '';
    if( !isset($lt_yes_theme['opt-header-position']) || $lt_yes_theme['opt-header-position'] == 'below-hero') {
        $menu_class = 'below-hero gore';
        $data_pos   = 'top';
        $menu_type   = 'below-hero';
    } else if ($lt_yes_theme['opt-header-position'] == 'below-hero-hidden') {
        $menu_class = 'below-hero-hidden gore';
        $data_pos   = 'bottom';
        $menu_type   = 'below-hero-hidden';
    } else if ($lt_yes_theme['opt-header-position'] == 'dotted') {
        $menu_class = 'dotted';
        $menu_type   = 'dotted';
    }

    // We are adding inside-menu class to all pages except home and noheader template
    if(!is_front_page() && !is_page_template('template-noheader.php')) {
        $menu_class .= ' inside-menu';
    }

    // If there is no hero image, just dont show anything.
    if(is_home() && empty($lt_yes_theme['default-hero']['url'])) {
        $menu_class .= ' no-hero-image';
    }

?>
<header id="main-menu" class="<?php echo $menu_class; ?>" data-type="<?php echo $menu_type; ?>" data-pos="<?php echo $data_pos; ?>">
    <div class="container">
        <div class="row">
            <div id="menu-logo" >
            <?php if(isset($lt_yes_theme['his-name']) && $lt_yes_theme['his-name'] != '' ) {
                    echo esc_attr($lt_yes_theme['his-name']); 
                } ?>
                    <span>&</span>
                <?php if(isset($lt_yes_theme['her-name']) && $lt_yes_theme['her-name'] != '' ) {
                    echo esc_attr($lt_yes_theme['her-name']); 
                } ?>
            </div>
            <nav id="navigation" class="column twelve">
                <?php 
                    wp_nav_menu( array( 'theme_location' => 'main_menu' ) );
                ?>
            </nav>
            <a href="#" id="menu-toggle-wrapper">
                <div id="menu-toggle"></div>
            </a>
        </div>
        <!-- close .ha-header-perspective -->
    </div>
    <!-- close grid container -->
</header>
<?php if ($lt_yes_theme['opt-header-position'] == 'dotted') { ?>
<header id="navigation-dotted">
    <nav>
        <?php 
            if(!is_front_page() && !is_page_template('template-noheader.php')) {
                wp_nav_menu( array( 'theme_location' => 'inside_menu' ) );
            } else {
                wp_nav_menu( array( 'theme_location' => 'main_menu' ) );
            }
        ?>
    </nav>
</header>
<?php } ?>