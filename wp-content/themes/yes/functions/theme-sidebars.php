<?php

/*-----------------------------------------------------------------------------------*/
/*  Register Sidebars
/*-----------------------------------------------------------------------------------*/

function theme_widgets_init() {
    register_sidebar(array(
      'name' => 'Blog Sidebar',
      'id' => 'lt-sidebar',
      'description' => 'Widgets in this area will be shown in the sidebar.',
      'before_widget' => '<div class="widget">',
      'after_widget' => '</div>',
      'before_title' => '<h3>',
      'after_title' => '</h3>',
    ));
}
add_action( 'widgets_init', 'theme_widgets_init' );

?>