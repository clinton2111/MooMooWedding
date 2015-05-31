<?php 
/**
* 404 Page Template
*/
get_header();

	get_template_part( 'includes/page-title' ); ?>

    <section id="page">
        <div id="post-<?php the_ID(); ?>" class="post">
            <div class="container">
                <div class="row">
                    <div class="column twelve">
						
					</div>
				</div>
			</div>
		</div>
	</section>
	
<?php
	if(isset($lt_yes_theme['opt-404'])) {
		if($lt_yes_theme['opt-404'] == '2') { 
			// Redirect	if its set in option.
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: " . esc_url(home_url()) );
			exit();
		}
	}

?>
<?php get_footer(); ?>