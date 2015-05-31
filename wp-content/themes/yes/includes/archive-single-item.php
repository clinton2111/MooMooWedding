<?php
 // File Used to Loop through single item in archive and blog page.
?>
<?php
	global $post;
	$cat_array = '';
	$post_categories = wp_get_post_categories($post->ID);
	foreach ($post_categories as $category) {
		$cat = get_category( $category );
		$cat_array = $cat_array . $cat->slug. ' ';
	}
	if($i % 2 == 0) {
		$cat_array = $cat_array . 'wow fadeInLeft animated right';
	} else {
		$cat_array = $cat_array . 'wow fadeInRight animated left';
	}
	
?>
<div id="post-<?php the_ID(); ?>" <?php post_class('column six heart ' . $cat_array ); ?>>
	<div class="box pattern">
	    <span class="date"><?php the_time( get_option( 'date_format' ) ); ?></span>
	    <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
	    <?php
	    $format = get_post_format();
		if ( $format == 'image' ) {
			$thumb = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'full');
			if($thumb) {
				$thumb = $thumb[0];
			}
			$thumb = Aq_Resize( $thumb , '385' , '240', true , true , true ); ?>
			<a href="<?php the_permalink() ?>"><img src="<?php echo esc_url($thumb); ?>" alt="thumb" /></a>
		<?php } else { ?>
	    <div class="box-content">
	    	<p><?php echo wp_trim_words(get_the_content(),40) ?></p>
	    	<a class="more" href="<?php the_permalink() ?>"><?php _e('Read more', 'lt_yes'); ?></a>
	    </div>
		<?php } ?>


	</div>
</div>