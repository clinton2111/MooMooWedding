<?php 
/**
* Default Template for displaying Events Pages
*/
get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<?php 
		// Post Meta's
		$lt_meta_place = get_post_meta( get_the_ID(), 'lt_meta_place', true); // place
		$lt_meta_address = esc_attr(get_post_meta( get_the_ID(), 'lt_meta_address', true)); // address
		$lt_meta_date = get_post_meta( get_the_ID(), 'lt_meta_date', true); // date 
		$lt_meta_time = get_post_meta( get_the_ID(), 'lt_meta_time', true); // time
		$lt_meta_title = get_post_meta( get_the_ID(), 'lt_meta_title', true); // Title 
		$lt_meta_description = get_post_meta( get_the_ID(), 'lt_meta_description', true); // Text
		$lt_meta_map = get_post_meta( get_the_ID(), 'lt_meta_map', true); // map
		$map_lat = explode(";", $lt_meta_map);
		$lt_gallery = get_post_meta( get_the_ID(), 'lt_gallery', true); // gallery
	?>

		<?php get_template_part( 'includes/page-title' ); ?>
		
		<?php // Map part ?>
		<?php if($lt_meta_map != '') { ?> 
		<section id="map" data-lat="<?php echo esc_attr($map_lat[0]); ?>" data-lon="<?php echo esc_attr($map_lat[1]); ?>" data-zoom="<?php echo esc_attr($map_lat[2]); ?>" data-title="<?php echo esc_attr($lt_meta_title); ?>" data-text="<?php echo esc_attr($lt_meta_description); ?>" ></section>
		<div class="mapdata">
			<?php echo '<input type="hidden" class="map-data" data-type="hotel" data-lat="'.esc_attr($map_lat[0]).'" data-lon="'.esc_attr($map_lat[1]).'" data-zoom="'.esc_attr($map_lat[2]).'" data-title="'.esc_attr($lt_meta_title).'" data-text="'.esc_attr($lt_meta_description).'">'; ?>
		</div>
		<?php } ?>
		<?php // Page Content ?>
		<section <?php post_class("page-content") ?> id="post-<?php the_ID(); ?>">
	        <div class="container smaller">
	            <div class="row">
	                <div class="twelve">
	                    <div class="box corner quote <?php if($lt_meta_map == '') { echo 'nomap'; } ?>">
	                        <div class="corners-topleft"></div>
	                        <div class="corners-bottomleft"></div>
	                        <div class="corners-topright"></div>
	                        <div class="corners-bottomright"></div>
	                        <?php if($lt_meta_place) : ?>
								<span class="waddress"><?php echo esc_attr($lt_meta_place); ?></span>
							<?php endif; ?>
	                        <?php if($lt_meta_address) : ?>
								<span><?php echo esc_attr($lt_meta_address); ?></span>
							<?php endif; ?>
	                        <?php if($lt_meta_date) : ?>
								<span class="wdate"><?php echo esc_attr($lt_meta_date); ?></span>
							<?php endif; ?>
	                        <?php if($lt_meta_time) : ?>
								<span class="wtime"><?php echo esc_attr($lt_meta_time); ?></span>
							<?php endif; ?>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <div class="content">
	            <div class="container smaller">
	                <div class="row">
	                    <div class="twelve">
	                        <?php the_content(); ?>
	                        <div class="clearfix"></div>
	                    </div>
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
