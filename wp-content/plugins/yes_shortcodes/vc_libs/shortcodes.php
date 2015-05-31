<?php

/************* Custom ShortCodes - used in Visual Composer *************/


// [yes-section-header title="Title Here" tagline="Tagline Here"]
function yes_section_header( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'title' => '',
		'tagline' => '',
		'font_pe_icon' => ''
    ), $atts ) );
	
	$output = '<header class="section-header">';
	$output .= '<span class="sec-icon '.$font_pe_icon.'"></span>';
	$output .= '<h3 class="section-title">' . $title.'</h3>'; 
	if($tagline != "") {
		$output .= '<p class="section-tagline">' . $tagline.'</p>'; 
	}
	
	$output .= '</header>';

	return $output;
}
add_shortcode('yes-section-header', 'yes_section_header');

// CTA Section
function yes_cta( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'text' => '',
		'link_text' => '',
		'url' => ''
    ), $atts ) );
	
	$output = '<div class="invitation">
					<span>'.$text.'</span>
					<a href="'.$url.'" class="yes_button scrollTo">'.$link_text.'</a>
				</div>';
	
	return $output;
}
add_shortcode('yes-cta', 'yes_cta');

// Couple Section
function yes_couple( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'her_first_name' => '',
		'her_last_name' => '',
		'his_first_name' => '',
		'his_last_name' => '',
		'her_photo' => '',
		'his_photo' => ''
    ), $atts ) );
	
	$his_photo = wp_get_attachment_image_src($his_photo, 'large');
	$her_photo = wp_get_attachment_image_src($her_photo, 'large');
	$output = '
		<div class="couple">
            <div class="overlay-dark"></div>
            <div class="hero-heart"></div>
            <div class="images">
                <div class="column six girl" style="background-image: url(\''.$her_photo[0].'\');">
                    <span class="fname">'.$her_first_name.'</span>
                    <span class="lname">'.$her_last_name.'</span>
                </div>
                <div class="column six boy" style="background-image: url(\''.$his_photo[0].'\');">
                    <span class="fname">'.$his_first_name.'</span>
                    <span class="lname">'.$his_last_name.'</span>
                </div>
            </div>
        </div>';
	
	return $output;
}
add_shortcode('yes-couple', 'yes_couple');

//Couple's Story
function yes_couple_story( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'his_story' => '',
		'her_story' => '',
		'his_title' => '',
		'her_title' => '',
		'story_together' => ''
    ), $atts ) );
	
	$output = '
            <div class="column six right">
                <h2 class="vibe">'.$her_title.'</h2>
                <div class="story">'.$her_story.'</div>
            </div>
            <div class="column six left">
                <h2 class="vibe">'.$his_title.'</h2>
                <div class="story">'.$his_story.'</div>
            </div>
            <div class="clearfix"></div>
            <div class="box corner quote story wow zoomIn animated">
                <div class="corners-topleft"></div>
                <div class="corners-bottomleft"></div>
                <div class="corners-topright"></div>
                <div class="corners-bottomright"></div>
    '.$story_together.'
            </div>';
	
	return $output;
}
add_shortcode('yes-couple-story', 'yes_couple_story');

// Quote
function yes_quote( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'quote_text' => ''
    ), $atts ) );
	
	$output = '<h2 class="quote">'.$quote_text.'</h2>';
	
	return $output;
}
add_shortcode('yes-quote', 'yes_quote');

// Blog - loveline
function yes_loveline_box( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'posts_count' => '',
//		'categories' => ''
    ), $atts ) );
	
	$args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page'=> get_option('posts_per_page'),
	);
	$output = "<div id='love-posts'>";
	$posts_array = get_posts($args);
	
	if(!$posts_array) {
		return false;
	}

	$c = 0;

	foreach ( $posts_array as $post) {
		setup_postdata( $post );
		$format = get_post_format($post->ID);
		$c++;

		if($c == 2) {
			$side = 'wow fadeInRight animated movetop left';
		}
		else if($c%2 == 0) {
			$side = 'wow fadeInRight animated left';
		} else {
			$side = 'wow fadeInLeft animated right';
		}

		$output .= '<div class="column six heart '.$side.'">
	                	<div class="box pattern">
		                    <span class="date">'.mysql2date('M j Y', $post->post_date).'</span>
		                    <h2><a href="'. get_permalink($post->ID) . '">'. $post->post_title.'</a></h2>';

		if ( $format == 'image' ) {
			$thumb = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'full');
			if($thumb) {
				$thumb = $thumb[0];
			}
			$thumb = Aq_Resize( $thumb , '385' , '240', true , true , true );
			$output .= '<a href="'. get_permalink($post->ID) . '"><img src="'.esc_url($thumb).'" alt="thumb" /></a>';

		} else {
			$output .= '<div class="box-content"><p>'.wp_trim_words($post->post_content,40).'</p>
		                    	 <a class="more" href="'. get_permalink($post->ID) . '">'.__("Read more", "lt_yes").'</a>
		                </div>';

		}

		$output .= '</div></div>';

	}

	$output .= '</div><div class="clearfix"></div><div class="timeline-button"><a id="more-posts" href="#" class="yes_button">'.__('Load More', 'lt_yes').'</a></div>';

	return $output;
	wp_reset_postdata();
}
add_shortcode('yes-loveline-box', 'yes_loveline_box');


// Blog - loveline
function yes_events_list( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'posts_count' => ''
    ), $atts ) );
	
	$args = array(
		'post_type' => 'events',
		'post_status' => 'publish',
		'posts_per_page'=> $posts_count,
	);
	$output = "";
	$posts_array = get_posts($args);
	
	if(!$posts_array) {
		return false;
	}

	$c = 0;

	foreach ( $posts_array as $post) {
		setup_postdata( $post );
		$place   = esc_attr(get_post_meta($post->ID, 'lt_meta_place',true));
		$address = esc_attr(get_post_meta($post->ID, 'lt_meta_address',true));
		$date    = esc_attr(get_post_meta($post->ID, 'lt_meta_date',true));
		$time    = esc_attr(get_post_meta($post->ID, 'lt_meta_time',true));
		$c++;
		if($c == 2) {
			$side = 'movetop wow fadeInRight animated left';
		}
		else if($c%2 == 0) {
			$side = 'wow fadeInRight animated left';
		} else {
			$side = 'wow fadeInLeft animated right';
		}

        $output .= '<div class="column six event-box heart '.$side.'">
                        <div class="box center corner">
                            <div class="corners-topleft"></div>
                            <div class="corners-bottomleft"></div>
                            <div class="corners-topright"></div>
                            <div class="corners-bottomright"></div>
                            <h2>'. $post->post_title.'</h2>
                            <div class="details">
                                <span class="waddress">'.$place.'</span>
                                <span class="waddress">'.$address.'</span>
                                <span class="wdate">'.date("l, d F Y", strtotime($date)).'</span>
                                <span class="wtime">'.$time.'</span>
                            </div>
                            <a class="yes_button" href="'. get_permalink($post->ID) . '">Read more</a>                            
                        </div>
                    </div>';

	}

	return $output;
	wp_reset_postdata();
}
add_shortcode('yes-events-list', 'yes_events_list');

// Location Map
function yes_gmap_holder( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'map_type' => 'ROADMAP',
		'map_icons' => ''
    ), $atts ) );

    $icons = explode(",", $map_icons);
    $output = '';
    
    if (is_array($icons)) {
	    $output .= '<div class="container"><div id="map-pins"><ul>';  
	    foreach($icons as $icon) {
	    	$output .= '<li class="'.$icon.'">'.$icon.'</li>';
	    }
	    $output .= '</ul></div></div>';
	}

    $output .= '<div id="map" data-type="'.$map_type.'"></div>';
	$output .= '<div class="mapdata">'.do_shortcode($content).'</div>';
	return $output;
}
add_shortcode('map_holder', 'yes_gmap_holder');


function yes_gmap_loc( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'coords' => '',
		'map_title' => '',
		'map_text' => '',
		'map_type' => ''
    ), $atts ) );
    
    $coordsArr = explode(",", $coords);
    
	if(!($coordsArr && sizeof($coordsArr) == 3)) {
		return;
	}
	

	return '<input type="hidden" class="map-data" data-lat="'.$coordsArr[0].'" data-lon="'.$coordsArr[1].'" data-type="'.$map_type.'" data-title="'.$map_title.'" data-text="'.$map_text.'">';
}
add_shortcode('map_location', 'yes_gmap_loc');


// Important People
function important_people( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'posts_count' => '',
		'left_group' =>'',
		'right_group' =>''
    ), $atts ) );

	$output = "";

	$args_left = array(
		'post_type' => 'important-people',
		'post_status' => 'publish',
		'posts_per_page'=> -1,
		'tax_query' => array(
			array(
				'taxonomy' => 'people-category',
				'field'    => 'slug',
				'terms'    => $left_group,
			),
		),
	);
	$left_posts = get_posts($args_left);
	$left_title = get_term_by('slug', $left_group, 'people-category');

	//Left Group
	if($left_posts) {

		$output .= '<div class="column six right">
        	   		<h2 class="vibe">'. $left_title->name.'</h2>
        	   		<ul class="tabs people-image">';

			$left_posts = get_posts($args_left);
			foreach ( $left_posts as $post ) { 
				setup_postdata( $post );
				$thumb = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'full');
				if($thumb) {
					$thumb = $thumb[0];
				}
				$thumb = Aq_Resize( $thumb , '111' , '111', true , true , true );
            	$output .= '<li class="wow flipInY animated"><a href="#'.$post->post_name.'"><img src="'.esc_url($thumb).'" alt="" /></a></li>';
        	}
			wp_reset_postdata(); 
        $output .= '</ul>
        <div class="tab-content-wrap">';
	
		foreach ( $left_posts as $post) {
			setup_postdata( $post );

			$fb_meta = esc_url(get_post_meta($post->ID, 'lt_meta_person_facebook',true));
			$tw_meta = esc_url(get_post_meta($post->ID, 'lt_meta_person_twitter',true));
			$ln_meta = esc_url(get_post_meta($post->ID, 'lt_meta_person_linkedin',true));
			$gplus_meta = esc_url(get_post_meta($post->ID, 'lt_meta_person_gplus',true));
			$instagram_meta = esc_url(get_post_meta($post->ID, 'lt_meta_person_instagram',true));
			
			$output .= '<div id="'.$post->post_name.'" class="tab-content">
			    <h2>'. $post->post_title.'</h2>
			    <div class="story">'. $post->post_content .'</div>
			    <div class="social">
			        <ul>';
						if($fb_meta) {
							$output .= '<li><a target="_blank" href="'.$fb_meta.'"><i class="fa fa-facebook"></i></a></li>';
						}

						if($tw_meta) {
							$output .= '<li><a target="_blank" href="'.$tw_meta.'"><i class="fa fa-twitter"></i></a></li>';
						}
						
						if($ln_meta) {
							$output .= '<li><a target="_blank" href="'.$ln_meta.'"><i class="fa fa-linkedin"></i></a></li>';
						}
						
						if($gplus_meta) {
							$output .= '<li><a target="_blank" href="'.$gplus_meta.'"><i class="fa fa-google-plus"></i></a></li>';
						}

						if($instagram_meta) {
							$output .= '<li><a target="_blank" href="'.$instagram_meta.'"><i class="fa fa-instagram"></i></a></li>';
						}
			    $output .= '</ul></div></div>';

		}
		wp_reset_postdata(); 
		$output .= '</div></div>';
	}

	//Right Group
	$args_right = array(
		'post_type' => 'important-people',
		'post_status' => 'publish',
		'posts_per_page'=> -1,
		'tax_query' => array(
			array(
				'taxonomy' => 'people-category',
				'field'    => 'slug',
				'terms'    => $right_group,
			),
		),
	);
	$right_posts = get_posts($args_right);
	$right_title = get_term_by('slug', $right_group, 'people-category');

	
	if($right_posts) {

		$output .= '<div class="column six left">
        	   		<h2 class="vibe">'. $right_title->name.'</h2>
        	   		<ul class="tabs people-image">';

			$right_posts = get_posts($args_right);
			foreach ( $right_posts as $post ) { 
				setup_postdata( $post );
				$thumb = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'full');
				if($thumb) {
					$thumb = $thumb[0];
				}
				$thumb = Aq_Resize( $thumb , '111' , '111', true , true , true );
            	$output .= '<li class="wow flipInY animated"><a href="#'.$post->post_name.'"><img src="'.esc_url($thumb).'" alt="" /></a></li>';
        	}
			wp_reset_postdata(); 
        $output .= '</ul>
        <div class="tab-content-wrap">';
	
		foreach ( $right_posts as $post) {
			setup_postdata( $post );

			$fb_meta = esc_url(get_post_meta($post->ID, 'lt_meta_person_facebook',true));
			$tw_meta = esc_url(get_post_meta($post->ID, 'lt_meta_person_twitter',true));
			$ln_meta = esc_url(get_post_meta($post->ID, 'lt_meta_person_linkedin',true));
			$gplus_meta = esc_url(get_post_meta($post->ID, 'lt_meta_person_gplus',true));
			$instagram_meta = esc_url(get_post_meta($post->ID, 'lt_meta_person_instagram',true));
			
			$output .= '<div id="'.$post->post_name.'" class="tab-content">
			    <h2>'. $post->post_title.'</h2>
			    <div class="story">'. $post->post_content .'</div>
			    <div class="social">
			        <ul>';
						if($fb_meta) {
							$output .= '<li><a target="_blank" href="'.$fb_meta.'"><i class="fa fa-facebook"></i></a></li>';
						}

						if($tw_meta) {
							$output .= '<li><a target="_blank" href="'.$tw_meta.'"><i class="fa fa-twitter"></i></a></li>';
						}
						
						if($ln_meta) {
							$output .= '<li><a target="_blank" href="'.$ln_meta.'"><i class="fa fa-linkedin"></i></a></li>';
						}
						
						if($gplus_meta) {
							$output .= '<li><a target="_blank" href="'.$gplus_meta.'"><i class="fa fa-google-plus"></i></a></li>';
						}

						if($instagram_meta) {
							$output .= '<li><a target="_blank" href="'.$instagram_meta.'"><i class="fa fa-instagram"></i></a></li>';
						}
			    $output .= '</ul></div></div>';

		}
		wp_reset_postdata(); 
		$output .= '</div></div>';
	}

	return $output;
}
add_shortcode('important-people', 'important_people');

// Twitter
function yes_twitter_feed( $atts, $content = null ) {
	$her_username = $his_username = $count = $api_key = $api_secret = $access_token = $access_token_secret = '';
	
	extract( shortcode_atts( array(
		'his_username' => '',
		'her_username' => '',
		'count' => '',
		'api_key' => '',
		'api_secret' => '',
		'access_token' => '',
		'access_token_secret' => ''
    ), $atts ) );
	
	if((!$her_username && !$his_username) || !$count || !$api_key || !$api_secret || !$access_token || !$access_token_secret) {
		return;
	}

	$output = '';
	
	include YES_ADDON_DIR . "/helpers/OAuth.php";
	include YES_ADDON_DIR . "/helpers/Autolink.php";

	//His Tweets
	if($his_username != '') {
		$value = get_transient("tw-cache-his|{$his_username}|{$count}");
		if(false === $value) {
			$method = "GET";
		    $url = "https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$his_username."&count=".$count;
			
		    $signature_method = New OAuthSignatureMethod_HMAC_SHA1();
		    $consumer = New OAuthConsumer($api_key , $api_secret);        
		    $token = New OAuthConsumer($access_token , $access_token_secret);        
		    $request = OAuthRequest::from_consumer_and_token($consumer, $token, $method, $url);            
		    $request->sign_request($signature_method, $consumer, $token);
		    

		    $args = array(
		    	"user-agent"	=> "PHP",
		    	"headers"		=> array('Content-Type' => 'application/x-www-form-urlencoded'),
		    	"timeout"		=> 5
		    );
		    $response = wp_remote_get( $request->to_url(), $args );

		    $value = json_decode($response['body']);
		    
		    if(!$value || isset($value->errors)) {
		    	return;
		    }

			set_transient("tw-cache-his|{$his_username}|{$count}", $value, 3600);
		}
		
		$tweets = $value;

		$output .= ' <div class="column six right">
					<h2 class="twitters vibe">'.$tweets[0]->user->name.'</h2>
				    <span>@'.$tweets[0]->user->screen_name.'</span>
				    <div class="tweets">';
				    foreach ($tweets as $tweet) {
				    $output .= '<div class="tweet">
	                        <span class="one-tweet">'.Twitter_Autolink::create($tweet->text)->setNoFollow(false)->addLinks().'</span>
	                        <span class="time">'.human_time_diff(strtotime($tweet->created_at)).' ago</span>
	                        </div>';
				    }

		$output .= '<a href="https://www.twitter.com/'.$tweets[0]->user->screen_name.'" target="_blank" class="follow">&rarr; Follow '.$tweets[0]->user->screen_name.' on Twitter</a></div></div>';
	}

	//Her Tweets
	if($her_username != '') {

		$value = get_transient("tw-cache-her|{$her_username}|{$count}");
		
		if(false === $value) {
			$method = "GET";
		    $url = "https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$her_username."&count=".$count;
		    
		    $signature_method = New OAuthSignatureMethod_HMAC_SHA1();
		    $consumer = New OAuthConsumer($api_key , $api_secret);        
		    $token = New OAuthConsumer($access_token , $access_token_secret);        
		    $request = OAuthRequest::from_consumer_and_token($consumer, $token, $method, $url);            
		    $request->sign_request($signature_method, $consumer, $token);
		    

		    $args = array(
		    	"user-agent"	=> "PHP",
		    	"headers"		=> array('Content-Type' => 'application/x-www-form-urlencoded'),
		    	"timeout"		=> 5
		    );
		    $response = wp_remote_get( $request->to_url(), $args );

		    $value = json_decode($response['body']);
		    
		    if(!$value || isset($value->errors)) {
		    	return;
		    }
			
			set_transient("tw-cache-her|{$her_username}|{$count}", $value, 3600);
		}

		$tweets = $value;

		$output .= ' <div class="column six left">
					<h2 class="twitters vibe">'.$tweets[0]->user->name.'</h2>
				    <span>@'.$tweets[0]->user->screen_name.'</span>
				    <div id="twitter_one" class="tweets">';
				    foreach ($tweets as $tweet) {
				    $output .= '<div class="tweet">
	                        <span class="one-tweet">'.Twitter_Autolink::create($tweet->text)->setNoFollow(false)->addLinks().'</span>
	                        <span class="time">'.human_time_diff(strtotime($tweet->created_at)).' ago</span>
	                        </div>';
				    }

		$output .= '<a href="https://www.twitter.com/'.$tweets[0]->user->screen_name.'" target="_blank" class="follow">&rarr; Follow '.$tweets[0]->user->screen_name.' on Twitter</a></div></div>';
	}
	
	return $output;
}
add_shortcode('yes-twitter-feed', 'yes_twitter_feed');


// Gift Registry
function yes_gift_registry( $atts, $content = null ) {
	extract( shortcode_atts( array(
    ), $atts ) );
	
	$output = '<ul class="small-box corner">'.do_shortcode($content).'</ul>';
	return $output;
}
add_shortcode('yes_gift_registry', 'yes_gift_registry');


// Paypal Gift Registry
function gift_paypal( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'paypal_address' => '',
		'donation_amount' => ''
    ), $atts ) );
	
	$output = '<li class="wow fadeInUp animated"><div class="money"><span class="amount">$'.$donation_amount.'</span>';
	$output .= '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_donations">
<input type="hidden" name="business" value="'.$paypal_address.'">
<input type="hidden" name="lc" value="US">
<input type="hidden" name="amount" value="'.$donation_amount.'.00">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="no_note" value="0">
<input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>';
        $output .= '<div class="corners-topleft"></div><div class="corners-bottomleft"></div><div class="corners-topright"></div><div class="corners-bottomright"></div></div></li>';

	return $output;
}
add_shortcode('gift_paypal', 'gift_paypal');


// Image Gift Registry
function gift_image( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'gift_image' => '',
		'gift_link' => ''
    ), $atts ) );

	$src = wp_get_attachment_image_src($gift_image, 'large');

    $output = ' <li class="wow fadeInUp animated">
    			<a class="product" href="'.$gift_link.'" target="_blank"><img src="'.$src[0].'" alt=""></a>
                <div class="corners-topleft"></div>
                <div class="corners-bottomleft"></div>
                <div class="corners-topright"></div>
                <div class="corners-bottomright"></div></li>';

	return $output;
}
add_shortcode('gift_image', 'gift_image');


// Guestbook - comments Section
function yes_guestbook( $atts, $content = null ) {
	extract( shortcode_atts( array(
    ), $atts ) );
	$output = '';
	ob_start();
		comments_template('/includes/guestbook.php');
	$output .= ob_get_clean();   
	
	return $output;

}
add_shortcode('yes_guestbook', 'yes_guestbook');


// Instagram Secion
function yes_instagram( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'hash' => '',
		'gift_link' => '',
		'clientid' => ''
    ), $atts ) );

        $output = '<div id="instagram-section" data-hash="'.$hash.'" data-clientid="'.$clientid.'"><span class="hash">#'.$hash.'</span>
        			<div class="instagram-images"></div>
        			<div class="load-more">
        			<a href="#" class="yes_button">Load more</a>
        			</div></div>';
	
	return $output;
}
add_shortcode('yes-instagram', 'yes_instagram');


// Contact Form 7
function yes_contact_form( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'cf7'	=> ''
    ), $atts ) );

    $output = "<div class='contact_form'>
               	 <div class='container'>
                    <div class='row'>
                        ". do_shortcode('[contact-form-7 id='. $cf7 .' title=]')."
                    </div>";
                 
	$output .= "</div>
			</div>";
	
	return $output;
}

add_shortcode('yes-contact-form', 'yes_contact_form');


// Hero
function yes_hero( $atts, $content = null ) {
	global $lt_yes_theme;
	extract( shortcode_atts( array(
		'hero_main' => '',
		'date_time' => '',
		'his_name' => '',
		'her_name' => '',
		'hero_button_link' => '',
		'counter' => '',
		'date'	=> '',
		'slideshow' => '',
		'slide_images' => ''
    ), $atts ) );

	$css_class = "";
	
	$output = '<div id="logo">'.$his_name.' <span>&amp;</span> '.$her_name.'</div>';
	$output .= '<section id="top" class="hero" data-type="parallax">';

    if (!isset($lt_yes_theme['opt-header-disable']) || $lt_yes_theme['opt-header-disable'] != 1 ) {
		ob_start();
   		get_template_part( 'includes/page-nav' );
   		$output .= ob_get_clean();
	}

	if ($slideshow == 'yes') {

		$output .= '<div class="hero-slideshow">';
			$slide_images = explode(",", $slide_images); // create array from id's.
			$gallery = array();
			foreach ($slide_images as $image) {
				$slike = wp_get_attachment_image_src($image, 'full');
				$output .= '<img src="'.$slike[0].'" />';
			}
		$output .= '</div>';
		$output .= '<div class="overlay-dark"></div>';
	}

	$output .= '<div class="container">';
	$output .= '<div class="hero-inner">';
	$output .= '<h1>'.$hero_main.'</h1>';
    $output .= '<div class="info">';
    if($counter != "") {
    	$output .= '<div id="countdown" data-date="'.$date.'"> <span>'.__('days', 'lt_yes').'</span> <span>'.__('hours', 'lt_yes').'</span> <span>'.__('mins', 'lt_yes').'</span> <span>'.__('secs', 'lt_yes').'</span></div>';
    }
    $output .= '<span class="date">'.$date_time.'</span>';
    $output .= '</div>';
    $output .= '<a href="'.$hero_button_link.'" class="mouse scrollTo"><i class="fa fa-long-arrow-down"></i></a>';
    $output .= '</div></div></section>';

	return $output;
}
add_shortcode('yes-hero', 'yes_hero');

// Gallery
function yes_gallery( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'images'	=> ''
    ), $atts ) );

	$output = '';
	$images = explode(",", $images); // create array from id's.
	$gallery = array();
	foreach ($images as $image) {
		$attachment = get_post($image);
		$slike = wp_get_attachment_image_src($image, 'full');
		$gallery[] = array(
			"cat"	=> $attachment->post_excerpt,
			"image"	=> $slike[0],
			"title" => $attachment->post_title
		);
	}
	// Filter
	$output .= '<div class="container">';
	$output .= '<div class="row">';
	$output .= '<ul id="gallery-filter">';
	$output .= '<li class="active"><a href="#" data-filter="*">All</a></li>';

	if($gallery) {
		$added = array();
		foreach ($gallery as $key => $value) {
			// Remove all characters that are not the separator, a-z, 0-9, or whitespace
			$cat = preg_replace('![^'.preg_quote('-').'a-z0-_9\s]+!', '', strtolower($value["cat"]));
			// Replace all separator characters and whitespace by a single separator
			$cat = preg_replace('!['.preg_quote('-').'\s]+!u', '-', $cat);
			if(!in_array($value["cat"], $added)) {
				$output .= '<li><a href="#" data-filter=".'.$cat.'">'.$value["cat"].'</a></li>';
			}
			$added[] = $value["cat"];
		}
	}
	$output .= '</ul></div></div>';
	// Gallery
	$output .= '<div id="gallery-wrapper">';
	foreach ($gallery as $key => $value) {
		// Remove all characters that are not the separator, a-z, 0-9, or whitespace
		$cat = preg_replace('![^'.preg_quote('-').'a-z0-_9\s]+!', '', strtolower($value["cat"]));
		// Replace all separator characters and whitespace by a single separator
		$cat = preg_replace('!['.preg_quote('-').'\s]+!u', '-', $cat);
		$thumb = Aq_Resize( $value["image"] , '640' , '480', true , true , true );
        $output .= '<div class="block '.$cat.'">';
        $output .= '<div class="image-holder">';
        $output .= '<img src="'.$thumb.'" alt="image" />';
        $output .= '</div>';
        $output .= '<a href="'.$value["image"].'" class="video-hover">';
        $output .= '<div class="portfolio-info">';
        $output .= '<h3 class="portfolio-title">'.$value["title"].'<span class="cat">'.$value["cat"].'</span></h3>';
        $output .= '</div></a></div>';
	}
	$output .= '</div>';
	return $output;
}

add_shortcode('yes-gallery', 'yes_gallery');



?>