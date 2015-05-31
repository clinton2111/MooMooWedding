<?php 
/**
* Default Template for displaying Posts
*/
get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<?php 
		// Post Meta's
		$lt_gallery = get_post_meta( get_the_ID(), 'lt_gallery', true); // gallery 
	?>

		<?php get_template_part( 'includes/page-title' ); ?>

		<?php if (has_post_thumbnail( $post->ID )) { ?>
		<?php 
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
        	<section id="background-image" data-type="parallax" style="background-image: url('<?php echo $image[0]; ?>')"></section>
        	<section <?php post_class("page-content") ?> id="post-<?php the_ID(); ?>">
		<?php } else { ?>
			<section <?php post_class("page-content no-image") ?> id="post-<?php the_ID(); ?>">
		<?php } ?>

			<?php // Page Content ?>
	        <div class="content">
				<div class="container <?php if(isset($lt_yes_theme['blog_sidebar_pos'])) { if($lt_yes_theme['blog_sidebar_pos'] =='no-blog-sidebar') { echo 'smaller'; } } ?>">
					<div class="row">
						<div class="column <?php if(isset($lt_yes_theme['blog_sidebar_pos'])) { if(($lt_yes_theme['blog_sidebar_pos'] == 'sidebar-left') ) { echo 'eight flow-opposite'; } else if( $lt_yes_theme['blog_sidebar_pos'] !='no-blog-sidebar' ) { echo 'eight'; } else { echo 'twelve'; } } ?>">
							<div class="post-content">
								<?php the_content(); ?>
								<?php wp_link_pages('before=<div class="page-links">Pages: &after=</div>'); ?>
							</div>
							<div class="clearfix"></div>
							<?php if(isset($lt_yes_theme['opt-post-tags'])) { if($lt_yes_theme['opt-post-tags'] != 0) { ?>
							<div id="tags">
								<?php the_tags( __( 'Tags: ', 'lt_yes') , ', ', ''); ?>
							</div>
							<?php } } ?>
	                        <div class="clearfix"></div>
							<?php  if(isset($lt_yes_theme['opt-post-author'])) { if($lt_yes_theme['opt-post-author'] != 0) {
								get_template_part( 'includes/about-author' );
		                    } } ?>
		                </div>
			            <?php 
							if(isset($lt_yes_theme['blog_sidebar_pos'])) {
								if($lt_yes_theme['blog_sidebar_pos'] == 'sidebar-left') { ?>
									<div class="column four">
										<div id="sidebar" class="left">
											<?php
												get_sidebar();
											?>
										</div>
									</div>
									<?php
								} else if($lt_yes_theme['blog_sidebar_pos'] == 'sidebar-right') { ?>
									<div class="column four">
										<div id="sidebar" class="right">
											<?php
												get_sidebar();
											?>
										</div>
									</div>
									<?php
								}
							}
						?>
	                </div>
	            </div>
	        </div>
			<?php if(isset($lt_yes_theme['opt-post-share'])) { 
			  		if($lt_yes_theme['opt-post-share'] != 0) {
						get_template_part( 'includes/share' );
			  		} 
				  } 
			?>
	    </section>

		<?php // Small Gallery Section ?>
		<?php if($lt_gallery != '') { ?>
		    <section id="wedding-gallery" class="single-page">
				<?php echo yes_event_gallery(); ?>
		    </section>
		<?php } ?>
		<?php if(isset($lt_yes_theme['opt-post-comments'])) { if($lt_yes_theme['opt-post-comments'] != 0) { ?>
			<section id="comments">
				<?php comments_template(); ?>
			</section>
		<?php } } ?>
	<?php endwhile; ?>

	<?php else : ?>

        <div class="content">
            <div class="container smaller">
                <div class="row">
                    <div class="twelve">
                        <?php _e('Sorry, no posts matched your criteria. ', 'lt_yes'); ?>
                    </div>
                </div>
            </div>
        </div>

	<?php endif; ?>

<?php get_footer(); ?>
