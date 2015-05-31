<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "lt_yes_theme";


    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';
    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
    }

    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();

    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }

    /*
     *
     * --> Action hook examples
     *
     */

    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );

    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    //add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');


    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ). ' Theme by Logicathemes',
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => __( 'Yes Options', 'redux-framework-demo' ),
        'page_title'           => __( 'Yes Options', 'redux-framework-demo' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => false,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => 'dashicons-menu',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'system_info'          => false,
        // REMOVE

        //'compiler'             => true,

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'light',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    $args['admin_bar_links'][] = array(
        'id'    => 'redux-docs',
        'href'  => 'http://docs.reduxframework.com/',
        'title' => __( 'Documentation', 'redux-framework-demo' ),
    );

    $args['admin_bar_links'][] = array(
        //'id'    => 'redux-support',
        'href'  => 'https://github.com/ReduxFramework/redux-framework/issues',
        'title' => __( 'Support', 'redux-framework-demo' ),
    );
    /*
    $args['admin_bar_links'][] = array(
        'id'    => 'redux-extensions',
        'href'  => 'reduxframework.com/extensions',
        'title' => __( 'Extensions', 'redux-framework-demo' ),
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
        'title' => 'Visit us on GitHub',
        'icon'  => 'el el-github'
        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/reduxframework',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://www.linkedin.com/company/redux-framework',
        'title' => 'Find us on LinkedIn',
        'icon'  => 'el el-linkedin'
    );
    */
    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = __( '<p>Thank You for purchasing Yes. If you need any help setting up template, check the documentation. If you need support contact us at support@logicathemes.com.</p>', 'redux-framework-demo' );
    } else {
        $args['intro_text'] = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo' );
    }

    // Add content after the form.
    // $args['footer_text'] = __( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'redux-framework-demo' );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */

    // -> START Basic Fields


    Redux::setSection( $opt_name, array(
        'title'     => __('General Settings', 'redux-framework-demo'),
     //     'desc'      => __('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'redux-framework-demo'),
        'icon'      => 'el-icon-video',
        'id'         => 'basic-checkbox',
        'fields'    => array(
            array(
                'id'        => 'custom-favicon',
                'type'      => 'media',
                'title'     => __('Favicon', 'redux-framework-demo'),
                'compiler'  => 'true',
                'url'       => true,
                'readonly'  => false,
                'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc'      => __('You can generate one at site such as www.favicon.cc', 'redux-framework-demo'),
                'subtitle'  => __('Upload a 16px x 16px Png/Gif/ico image that will represent your website\'s favicon.', 'redux-framework-demo')
            ), /*
            array(
                'id'        => 'opt-admin-bar',
                'type'      => 'switch',
                'title'     => __('Hide Admin Top Bar', 'redux-framework-demo'),
                'subtitle'  => __('You can hide admin bar if it is interfering with your menu when you are logged in.', 'redux-framework-demo'),
                'default'   => false,
            ), */
            array(
                'id'        => 'opt-404',
                'type'      => 'button_set',
                'title'     => __('404 Page', 'redux-framework-demo'),
                'subtitle'  => __('Do you want to show 404 page or redirect it to home page.', 'redux-framework-demo'),
                //Must provide key => value pairs for radio options
                'options'   => array(
                    '1' => 'Show 404', 
                    '2' => 'Redirect to Home'
                ), 
                'default'   => '1'
            )
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title'     => __('Styling Options', 'redux-framework-demo'),
        'id'         => 'styling-options',
        'icon'      => 'el-icon-website',
        'fields'    => array(
            array(
                'id'        => 'opt-theme-color',
                'type'      => 'select',
                'title'     => __('Theme Color', 'redux-framework-demo'),
                'subtitle'  => __('Select a predefined color scheme. They\'re located in \'/css/colors/\' theme folder', 'redux-framework-demo'),
                'options'   => array(
                    'default.css' => 'Default(Purple)', 
                    'light_turquoise.css' => 'Light Turquoise'
                    ),
                'default'   => 'default.css',
            ),
            array(
                'id'        => 'opt-custom-color',
                'type'      => 'switch',
                'title'     => __('Enable/Disable Custom Color Scheme', 'redux-framework-demo'),
                'subtitle'  => __('Use custom color scheme.', 'redux-framework-demo'),
                'default'   => false,
            ),
            array(
                'required'  => array('opt-custom-color', '=', '1'),
                'id'        => 'opt-custom-color-code',
                'type'      => 'color',
                'validate'  => 'color',
                'title'     => __('Custom Color', 'redux-framework-demo'),
                'subtitle'  => __('Chose custom color for your site.', 'redux-framework-demo'),
            ),
            array(
                'id'        => 'opt-theme-sec-color',
                'type'      => 'color',
                'validate'  => 'color',
                'title'     => __('Theme Secondary Color', 'redux-framework-demo'),
                'subtitle'  => __('Used for background for patterns', 'redux-framework-demo')
            ),
            array(
                'id'        => 'opt-custom-pattern',
                'type'      => 'select',
                'title'     => __('Theme Background Pattern', 'redux-framework-demo'),
                'subtitle'  => __('Select a predefined pattern you want to use. Images are located in /assets/iamges/bgs/ theme folder', 'redux-framework-demo'),
                'options'   => array(
                    'BG-halftone.png' => 'Default',
                    'BG-brickwall.png' => 'Bricks', 
                    'BG-crisp-paper-ruffles.png' => 'Paper',
                    'BG-damask.png' => 'Damask', 
                    'BG-debut-light.png' => 'Debut Light', 
                    'BG-flowers.png' => 'Flowers', 
                    'BG-greyfloral.png' => 'GrayFloral',
                    'BG-mnml.png' => 'Minimal',
                    'BG-restaurant_icons.png' => 'Fruits',
                    'BG-shattered.png' => 'Shattered',
                    'BG-subtlenet.png' => 'Subtlened',
                    'BG-subtle-white-feathers.png' => 'Feathers',
                    'BG-symphony.png' => 'Symphony',
                    ),
                'default'   => 'BG-halftone.png',
            ),
            array(
                'id'        => 'opt-animate',
                'type'      => 'switch',
                'title'     => __('Turn on animation on Home Page', 'redux-framework-demo'),
                'subtitle'  => __('You can enable or disable animations on home page sections.', 'redux-framework-demo'),
                'default'   => false,
            ),
            array(
                'id'        => 'opt-retina',
                'type'      => 'switch',
                'title'     => __('Retina Images', 'redux-framework-demo'),
                'subtitle'  => __('You can disable creating and serving retina images, if you need to save servers bandwidth', 'redux-framework-demo'),
                'default'   => true,
            ),
            array(
                'id'        => 'opt-preloader',
                'type'      => 'switch',
                'title'     => __('Enable/Disable Preloader', 'redux-framework-demo'),
                'subtitle'  => __('Enable/Disable the website\'s preloader.', 'redux-framework-demo'),
                'default'   => false,
            ),
            array(
                'id'        => 'opt-inside-preloader',
                'type'      => 'switch',
                'title'     => __('Enable/Disable Preloader for inside Pages', 'redux-framework-demo'),
                'subtitle'  => __('Enable/Disable the website\'s preloader for inside pages.', 'redux-framework-demo'),
                'default'   => false,
            ),
            array(
                'id'        => 'opt-custom-css',
                'type'      => 'ace_editor',
                'title'     => __('Custom CSS Code', 'redux-framework-demo'),
                'desc'      => __('Quickly add some CSS to your theme by adding it to this block.', 'redux-framework-demo'),
                'mode'      => 'css',
                'theme'     => 'chrome',
                'subtitle'  => __('CSS validation is on.', 'redux-framework-demo'),
            ),
            array(
                'id'        => 'opt-custom-js',
                'type'      => 'ace_editor',
                'title'     => __('Custom JS Code', 'redux-framework-demo'),
                'subtitle'  => __('Quickly add some JS code to your theme by adding it to this block.It will be called in footer on every page.', 'redux-framework-demo'),
                'mode'      => 'javascript',
                'theme'     => 'chrome',
                'desc'      => 'Paste your JS code here.',
                'default'   => "jQuery(document).ready(function(){});"
            ),
        )
    ) );


    Redux::setSection( $opt_name, array(
        'icon'      => 'el-icon-wrench',
        'title'     => __('Header Options', 'redux-framework-demo'),
        'fields'    => array(
            array(
                'id'        => 'opt-header-position',
                'type'      => 'button_set',
                'title'     => __('Menu Position', 'redux-framework-demo'),
                'subtitle'  => __('Choose where menu should appear', 'redux-framework-demo'),
                //Must provide key => value pairs for radio options
                'options'   => array(
                    'top'               => 'Top', 
                    'dotted'        => 'Dotted',
                    'below-hero'         => 'Below Hero',
                    'below-hero-hidden' => 'Below Hero Hidden'
                ), 
                'default'   => 'top'
            ),
            array(
                'id'        => 'opt-header-disable',
                'type'      => 'switch',
                'title'     => __('Disable Menu on Home Page', 'redux-framework-demo'),
                'subtitle'  => __('Completly disable menu on home page, this can be useful for smaller websites.', 'redux-framework-demo'),
                'default'   => false,
            ),
            array(
                'id'        => 'opt-inside-menu',
                'type'      => 'switch',
                'title'     => __('Disable Menu for Inside Pages', 'redux-framework-demo'),
                'subtitle'  => __('Completly disable menu for inside pages, this will place "Back to home" like on posts/events pages.', 'redux-framework-demo'),
                'default'   => false,
            )
        )
    ) );


    Redux::setSection( $opt_name, array(
        'icon'      => 'el-icon-pencil',
        'title'     => __('Single Post Options', 'redux-framework-demo'),
        'fields'    => array(
            array(
                'id'        => 'opt-post-author',
                'type'      => 'switch',
                'title'     => __('Enable/Disable Author Box for Single Posts', 'redux-framework-demo'),
                'subtitle'  => __('If the option is on, the author box will be displayed.', 'redux-framework-demo'),
                'default'   => false,
            ),
            array(
                'id'        => 'opt-post-comments',
                'type'      => 'switch',
                'title'     => __('Enable/Disable comments across the site', 'redux-framework-demo'),
                'subtitle'  => __('If the option is on, comment box will be displayed.', 'redux-framework-demo'),
                'default'   => true,
            ),
            array(
                'id'        => 'opt-post-tags',
                'type'      => 'switch',
                'title'     => __('Enable/Disable Tags for Single Posts', 'redux-framework-demo'),
                'subtitle'  => __('If the option is on, the tags will be displayed.', 'redux-framework-demo'),
                'default'   => true,
            ),
            array(
                'id'        => 'opt-post-share',
                'type'      => 'switch',
                'title'     => __('Enable/Disable Share Icons for Single Posts', 'redux-framework-demo'),
                'subtitle'  => __('If the option is on, the sharing icons will be displayed on posts page.', 'redux-framework-demo'),
                'default'   => true,
            ),
            array(
            'id'        => 'blog_sidebar_pos',
            'type'      => 'image_select',
            'title'     => __('Sidebar Position for Single Post Pages', 'redux-framework-demo'),
            'subtitle'  => __('Select a sidebar position for blog posts. It will be applied to single posts pages.', 'redux-framework-demo'),
            'options'   => array(
                'sidebar-right' => array('alt' => 'Sidebar Right',  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
                'sidebar-left' => array('alt' => 'Sidebar Left',  'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
                'no-blog-sidebar' => array('alt' => 'No Sidebar',  'img' => ReduxFramework::$_url . 'assets/img/1col.png')
            ),
            'default'   => 'no-blog-sidebar'
            )
        )
    ) );

    Redux::setSection( $opt_name, array(
        'icon'      => 'el-icon-check',
        'title'     => __('Blog Options', 'redux-framework-demo'),
        'fields'    => array(
            array(
                'id'        => 'blog-title',
                'type'      => 'text',
                'title'     => __('Blog Page Hero Title', 'redux-framework-demo'),
                'subtitle'  => __('This will show on your blog index page.', 'redux-framework-demo'),
                'default'   => __('Our Loveline', 'redux-framework-demo'),
            ),
            array(
                'id'        => 'blog-subtitle',
                'type'      => 'textarea',
                'title'     => __('Blog Page Hero Subtitle', 'redux-framework-demo'),
                'subtitle'  => __('This will show on your blog index page.', 'redux-framework-demo'),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'icon'      => 'el-icon-twitter',
        'title'     => __('Footer Options', 'redux-framework-demo'),
        'fields'    => array(
            array(
                'id'        => 'opt-footer',
                'type'      => 'editor',
                'title'     => __('Footer Left Copyright text', 'redux-framework-demo'),
                'subtitle'  => __('Place here your copyright line.', 'redux-framework-demo'),
                'desc'      => __('Use "< br />" tag for new line.', 'redux-framework-demo'),
                'default'   => ''
            ),
            array(
                'id'        => 'opt-footer-right',
                'type'      => 'editor',
                'title'     => __('Footer Right text', 'redux-framework-demo'),
                'subtitle'  => __('You can add some more text to the right side.', 'redux-framework-demo'),
                'desc'      => __('Use "< br />" tag for new line.', 'redux-framework-demo'),
                'default'   => ''
            ),
            array(
                'id'        => 'his-name',
                'type'      => 'text',
                'title'     => __('Add his first name', 'redux-framework-demo'),
                'subtitle'  => __('This will be used for bottom logo.', 'redux-framework-demo'),
                'default'   => __('Nick', 'redux-framework-demo'),
            ),
            array(
                'id'        => 'her-name',
                'type'      => 'text',
                'title'     => __('Add her name', 'redux-framework-demo'),
                'subtitle'  => __('This will be used for bottom logo.', 'redux-framework-demo'),
                'default'   => __('Ruby', 'redux-framework-demo'),
            ),
        )
    ) );


    if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
        $section = array(
            'icon'   => 'el el-list-alt',
            'title'  => __( 'Documentation', 'redux-framework-demo' ),
            'fields' => array(
                array(
                    'id'       => '17',
                    'type'     => 'raw',
                    'markdown' => true,
                    'content'  => file_get_contents( dirname( __FILE__ ) . '/../README.md' )
                ),
            ),
        );
        Redux::setSection( $opt_name, $section );
    }
    /*
     * <--- END SECTIONS
     */

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    function compiler_action( $options, $css, $changed_values ) {
        echo '<h1>The compiler hook has run!</h1>';
        echo "<pre>";
        print_r( $changed_values ); // Values that have changed since the last save
        echo "</pre>";
        //print_r($options); //Option values
        //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $return['error'] = $field;
                $field['msg']    = 'your custom error message';
            }

            if ( $warning == true ) {
                $return['warning'] = $field;
                $field['msg']      = 'your custom warning message';
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    function dynamic_section( $sections ) {
        //$sections = array();
        $sections[] = array(
            'title'  => __( 'Section via hook', 'redux-framework-demo' ),
            'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo' ),
            'icon'   => 'el el-paper-clip',
            // Leave this as a blank section, no options just some intro text set above.
            'fields' => array()
        );

        return $sections;
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    function change_arguments( $args ) {
        //$args['dev_mode'] = true;

        return $args;
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    function change_defaults( $defaults ) {
        $defaults['str_replace'] = 'Testing filter hook!';

        return $defaults;
    }

    // Remove the demo link and the notice of integrated demo from the redux-framework plugin
    function remove_demo() {

        // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
            remove_filter( 'plugin_row_meta', array(
                ReduxFrameworkPlugin::instance(),
                'plugin_metalinks'
            ), null, 2 );

            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
        }
    }



/************************************************************************
* Extended Example:
* Way to set menu, import revolution slider, and set home page.
*************************************************************************/

if ( !function_exists( 'wbc_extended_example' ) ) {
    function wbc_extended_example( $demo_active_import , $demo_directory_path ) {

        reset( $demo_active_import );
        $current_key = key( $demo_active_import );

        /************************************************************************
        * Import slider(s) for the current demo being imported
        *************************************************************************/

        if ( class_exists( 'RevSlider' ) ) {

            
            $wbc_sliders_array = array(
                'Fashion' => 'revslider.zip',
                'Slider' => 'slider5.zip',
                'SliderZoom' => 'slider4.zip'
            );

            if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_sliders_array ) ) {
                $wbc_slider_import = $wbc_sliders_array[$demo_active_import[$current_key]['directory']];

                if ( file_exists( $demo_directory_path.$wbc_slider_import ) ) {
                    $slider = new RevSlider();
                    $slider->importSliderFromPost( true, true, $demo_directory_path.$wbc_slider_import );
                }
            }
        }

        /************************************************************************
        * Setting Menus
        *************************************************************************/

        // If it's demo1 - demo6
        $wbc_menu_array = array( 'Main', 'Video' );

        if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
            $top_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' ); // name of the Iva menu - Main Menu
            $inside_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
            if ( isset( $top_menu->term_id ) ) {
                set_theme_mod( 'nav_menu_locations', array(
                        'main_menu' => $top_menu->term_id,
                        'inside_menu' => $inside_menu->term_id
                    )
                );
            }

        }

        /************************************************************************
        * Set HomePage
        *************************************************************************/

        // array of demos/homepages to check/select from
        $wbc_home_pages = array(
            'Main' => 'Home Page'
        );

        if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_home_pages ) ) {
            $page = get_page_by_title( $wbc_home_pages[$demo_active_import[$current_key]['directory']] );
            if ( isset( $page->ID ) ) {
                update_option( 'page_on_front', $page->ID );
                update_option( 'show_on_front', 'page' );
            }
        }

    }


    // Uncomment the below
    add_action( 'wbc_importer_after_content_import', 'wbc_extended_example', 10, 2 );
}