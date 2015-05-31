<?php get_header(); ?>

	<?php if (have_posts()) : ?>
			
		<?php get_template_part( 'includes/page-title' ); ?>

	    <!-- Loveline Section -->
	    <section id="blog" data-posts-per-page="<?php echo get_option('posts_per_page'); ?>">
			<?php if(category_description() != '') { ?>
		        <header class="section-header">
		            <p class="section-tagline"><?php echo category_description(); ?></p>
		        </header>
			<?php } ?>
	        <div class="pattern">
	            <div class="container timeline">
	                <span class="arrow-up"></span>
	                <span class="arrow-down"></span>
	                <div class="row" id="love-posts">
						<?php 
						$posts_per_page = get_option('posts_per_page');
						// setup left/right classes
						$i = 0;
						while (have_posts()) : the_post();
						// Sticky fix - need new one for pair sticky posts
						if(is_sticky() && $i == 0) {
							$i++;
						}

						include(locate_template('includes/archive-single-item.php'));

						$i++;

			            endwhile; ?>
	        		</div>
	        	</div>
			<?php if(function_exists('lt_retrieve_posts')) { ?>
				</div><div class="clearfix"></div><div class="timeline-button"><a id="more-posts" data-cat-id="<?php echo get_query_var('cat'); ?>" href="#" class="yes_button"><?php _e('Load More', 'lt_yes'); ?></a></div>
	  		<?php } else { previous_posts_link(); ?> &bull; <?php next_posts_link(); } ?>

		</section>
	<?php else : ?>



	<?php endif; ?>

<?php get_footer(); ?>
