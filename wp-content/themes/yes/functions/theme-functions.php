<?php 

    /* Event Gallery
    ================================================== */
	function yes_event_gallery(){
		
		$lt_gallery = get_post_meta( get_the_ID(), 'lt_gallery', true); // gallery
		$gallery = array();
		foreach ($lt_gallery as $image) {
			$attachment = get_post($image);
			$slike = wp_get_attachment_image_src($image, 'full');
			$gallery[] = array(
				"cat"	=> $attachment->post_excerpt,
				"image"	=> $slike[0],
				"title" => $attachment->post_title
			);
		}
		$output = '<div id="gallery-wrapper">';
		foreach ($gallery as $key => $value) {
			$thumb = Aq_Resize( $value["image"] , '640' , '480', true , true , true );
	        $output .= '<div class="block">';
	        $output .= '<div class="image-holder">';
	        $output .= '<img src="'.$thumb.'" alt="image">';
	        $output .= '</div>';
	        $output .= '<a href="'.$value["image"].'" class="video-hover">';
	        $output .= '<div class="portfolio-info">';
	        $output .= '<h3 class="portfolio-title">'.$value["title"].'<span class="cat">'.$value["cat"].'</span></h3>';
	        $output .= '</div></a></div>';
		}
		return $output;
	}

    /* Prev and Next Posts Filter to Add Class
    ================================================== */
	add_filter('next_post_link', 'yes_next_post_link_attributes');
	add_filter('previous_post_link', 'yes_prev_post_link_attributes');
	 
	function yes_next_post_link_attributes($output) {
	    $code = 'class="next"';
	    return str_replace('<a href=', '<a '.$code.' href=', $output);
	}

	function yes_prev_post_link_attributes($output) {
	    $code = 'class="prev"';
	    return str_replace('<a href=', '<a '.$code.' href=', $output);
	}

	/* Social Links for Authors backend 
	=================================================== */
	add_filter('user_contactmethods', 'yes_modify_user_contact_methods');

	function yes_modify_user_contact_methods( $user_contact ) {

		/* User contact methods */
		$user_contact['facebook'] = __('Facebook Link','lt_yes'); 
		$user_contact['twitter'] = __('Twitter Link','lt_yes'); 
		$user_contact['pinterest'] = __('Pinterest Link','lt_yes'); 
		$user_contact['linkedin'] = __('Linkedin Link','lt_yes');
		$user_contact['dribbble'] = __('Dribbble Link','lt_yes'); 
		$user_contact['googleplus'] = __('Google+ Link','lt_yes');
		$user_contact['instagram'] = __('Instagram Link','lt_yes');

		return $user_contact;
	}

	/* Guestbook Comments loop for Ajax
	=================================================== */
	if(!function_exists('yes_guestbook_comment')) { 
		function yes_guestbook_comment($comment, $args, $depth) {
			$GLOBALS['comment'] = $comment; 
			?>
	        <div <?php comment_class("column six heart"); ?> id="comment-<?php comment_ID() ?>">
                <div class="box pattern">
                    <span class="date"><?php echo get_comment_date(); ?></span>
                    <div class="guest">
                        <?php comment_text() ?>
                        <?php if ($comment->comment_approved == '0') : ?>
						<em><?php _e('<em>Your comment is awaiting moderation.</em>', 'lt_yes') ?></em>
						<br />
						<?php endif; ?>
                        <span class="name"><?php echo get_comment_author_link() ?></span>
                    </div>
                </div>
            </div>
		<?php }
	}

	/* Standard Comments loop for Ajax
	=================================================== */
	if(!function_exists('yes_comments')) { 
		function yes_comments($comment, $args, $depth) {
			$GLOBALS['comment'] = $comment; ?>
			<div <?php comment_class('single-comment'); ?> id="comment-<?php comment_ID() ?>">
                <div class="inside-comment">
                	<h4><?php echo get_comment_author_link() ?></h4>

                    <span class="comment-date"><?php printf(__('on %1$s at %2$s', 'lt_yes'), get_comment_date(),  get_comment_time()) ?></span>
					<?php if ($comment->comment_approved == '0') : ?>
					<em><?php _e('<em>Your comment is awaiting moderation.</em>', 'lt_yes') ?></em>
					<br />
					<?php endif; ?>
					<?php comment_text() ?>
					<?php edit_comment_link(__('Edit', 'lt_yes'),'  ','') ?> 
                    <?php comment_reply_link(array('reply_text' => '<i class="fa fa-reply"></i>', 'depth' => $depth, 'max_depth' => $args['max_depth'])) ?>
                </div>
            </div>
		<?php }
	}


	/* Ajax Posting of Comments
	=================================================== */
	add_action('comment_post', 'ajaxify_comments',20, 2);
	function ajaxify_comments($comment_ID, $comment_status){
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			//If Ajax Request Then
			switch($comment_status){
				case '0':
	                echo "success1";                        // send a message to ajax
	                wp_notify_moderator($comment_ID);       // notify moderator of unapproved comment
	                break;
				case '1': //Approved comment
	                echo "success2";                            // send a message to ajax
	                $commentdata = get_comment($comment_ID, ARRAY_A);
	                $post = get_post($commentdata['comment_post_ID']);
	                wp_notify_postauthor($comment_ID, $commentdata['comment_type']);
	                break;
	            default:
	            	echo "error";
			}
			exit();
		}
		
	}

	/* Ajax Loading Comments
	=================================================== */
	add_action('wp_ajax_nopriv_load_comments', 'lt_retrieve_comments');
	add_action('wp_ajax_load_comments', 'lt_retrieve_comments');

	function lt_retrieve_comments() {

		// Check nounce - security thingy
		$nonce = $_POST['postCommentNonce'];
		if ( ! wp_verify_nonce( $nonce, 'myajax-post-comment-nonce' ) ) {
			die ( 'Busted!');
		}
        
		$postID = $_REQUEST['post_id'];
		$offset = $_REQUEST['start_from'];
		$type = $_REQUEST['type'];
		print_r($type);
		$args = array(
				'post_id' => $postID,
				'offset' => $offset,
				'status' => 'approve',
				'order' => 'ASC',
				'number' => 4,
		);

		$comments = get_comments($args);
		if($type == "guestbook") {
			wp_list_comments(array('max_depth' => '1','callback' => 'yes_guestbook_comment','per_page' => '4'), $comments);
		} else {
			wp_list_comments(array('max_depth' => '1','callback' => 'yes_comments','per_page' => '4'), $comments);
		}
		
		exit;
	}

	/* Ajax Loading Posts
	=================================================== */
	add_action('wp_ajax_nopriv_load_posts', 'lt_retrieve_posts');
	add_action('wp_ajax_load_posts', 'lt_retrieve_posts');

	function lt_retrieve_posts() {

		// Check nounce - security thingy
		$nonce = $_POST['postNonce'];
		if ( ! wp_verify_nonce( $nonce, 'myajax-post-nonce' ) ) {
			die ( 'Busted!');
		}
        
		$paged = $_REQUEST['paged'];
		$args = array(
			'paged' => $paged,
			'post_status' => 'publish'
		);

		$posts_per_page = get_option('posts_per_page');
		// setup left/right classes
		if($posts_per_page % 2 == 0 || $paged % 2 != 0) {
			$i = 0;
		} else {
			$i = 1;
		}

		$lt_query = new WP_Query( $args );
		if ($lt_query->have_posts()) {
			while ($lt_query->have_posts()) {

				$lt_query->the_post();

				include(locate_template('includes/archive-single-item.php'));
				$i++;
				wp_reset_postdata();

			}
		}
		exit;
		
	}

	/* Increase Search Size
    ================================================== */
	function yes_change_wp_search_size($query) {
    if ( $query->is_search )
        $query->query_vars['posts_per_page'] = 999;
	    return $query;
	}
	add_filter('pre_get_posts', 'yes_change_wp_search_size');


	/* Hide Admin Bar
    ================================================== */
	global $lt_yes_theme;
    if(isset($lt_yes_theme['opt-admin-bar']) && $lt_yes_theme['opt-admin-bar'] != 0) {
		add_filter('show_admin_bar', '__return_false');
	}

?>