<?php 
	global $lt_yes_theme; // define global options 

	if(isset($lt_yes_theme['opt-inside-menu']) && $lt_yes_theme['opt-inside-menu'] == 0 ) { ?>
	    <header id="main-menu" class="inside-pages">
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
	                        if(!is_home()) {
				                wp_nav_menu( array( 'theme_location' => 'inside_menu' ) );
				            } else {
				                wp_nav_menu( array( 'theme_location' => 'main_menu' ) );
				            }
	                    ?>
	                </nav>
	                <a href="#" id="menu-toggle-wrapper">
	                    <div id="menu-toggle"></div>
	                </a>
	            </div>
	        </div>
	<?php } else { ?>
	<header class="fixed">
	    <a href="<?php echo get_site_url(); ?>" id="back-home"><?php _e('Back to home', 'lt_yes'); ?></a>
	<?php } ?>
	    <div id="title">
	        <div class="container">
	            <div class="row">
					<?php
					if(is_home()) { ?>
		                <div class="column twelve">
					        <?php if(isset($lt_yes_theme['blog-title']) && $lt_yes_theme['blog-title'] != '' ) { ?>
						        <h1><?php echo esc_attr($lt_yes_theme['blog-title']); ?></h1>
						    <?php } else { ?>
		                    	<h1><?php _e('Our Loveline', 'lt_yes'); ?></h1>
		                    <?php } ?>
		                </div>
					<?php }
					else if (is_archive()) { ?>
						<?php if (have_posts()) : ?>
							<?php if (is_category()) {
								// Lets find image for each category
							 	$category = get_category( get_query_var( 'cat' ) );
								$cat_id = $category->cat_ID;
							?>
				                <div class="column twelve">
				                    <h1><?php single_cat_title(); ?></h1>
				                </div>
							<?php } elseif(is_tag()) { ?>
				                <div class="column twelve">
				                    <h1><?php single_tag_title(); ?></h1>
				                </div>
							<?php } elseif (is_day() || is_month() || is_year()) { ?>
				                <div class="column twelve">
				                    <h1><?php the_time(get_option('date_format')); ?></h1>
				                </div>
							<?php } elseif (is_author()) { ?>
				                <div class="column twelve">
				                    <h1><?php _e('Author Archive: ', 'lt_yes'); ?></h1>
				                </div>
							<?php } ?>
					<?php	
						endif; 					
					}
					else if (is_search()) { ?>
		                <div class="column twelve">
		                    <h1><?php _e('Search Results for: ', 'lt_yes'); ?>"<?php the_search_query(); ?>"</h1>
		                </div>
					<?php
					}
					else if (is_page()) { ?>
	                    <div class="column twelve">
	                        <h1><?php the_title(); ?></h1>
	                    </div>
					<?php
					}
					else if (is_singular('events')) { ?>
		                <div class="column three">
		                    <?php echo previous_post_link('%link',__('Previous Event', 'lt_yes')); ?>
		                </div>
		                <div class="column six">
		                    <h1><?php the_title(); ?></h1>
		                </div>
		                <div class="column three">
		                    <?php echo next_post_link('%link',__('Next Event', 'lt_yes')) ?>
		                </div>
					<?php	
					}
					else if (is_single()) { ?>
		                <div class="column three">
		                    <?php echo previous_post_link('%link',__('Previous Article', 'lt_yes')); ?>
		                </div>
		                <div class="column six">
		                    <h1><?php the_title(); ?></h1>
		                </div>
		                <div class="column three">
		                    <?php echo next_post_link('%link',__('Next Article', 'lt_yes')) ?>
		                </div>
					<?php	
					}
					else if (is_404()) { ?>
		                <div class="column twelve">
		                    <h1><?php _e('Error 404 - Page Not Found.', 'lt_yes'); ?></h1>
		                </div>
					<?php } ?>
				</div>
	        </div>
	    </div>
	</header>