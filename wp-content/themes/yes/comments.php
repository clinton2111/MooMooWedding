<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */

if ( post_password_required() ) : 

if (comments_open() ) :
	?>
		<p><?php _e( 'This post is password protected. Enter the password to view any comments.', 'lt_yes' ); ?></p>
	<?php
endif;
/* Stop the rest of comments.php from being processed,
 * but don't kill the script entirely -- we still have
 * to fully load the template.
 */
return;
	
endif;
?>

<?php

$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );

if ( have_comments() ) : // we have comments ?

$iva_comments_args = array(
        'fields' => apply_filters( 'comment_form_default_fields', 
                array(
                'author' => '<div class="column six"><label for="contactname">Name</label><input type="text" name="author" id="contactname" title="'.__( 'Name', 'lt_yes' ).'*"></div>',
                'email'  => '<div class="column six"><label for="contactemail">Email</label><input type="email" name="email" id="contactemail" title="'.__( 'Email', 'lt_yes' ).'*"></div>',
                )
        ),
    	'logged_in_as' => '',
		'id_form' => 'guestbookform',
		'comment_notes_before' => '',
        'title_reply'=>__( 'Leave a Comment', 'lt_yes' ),
        'comment_field' => '<div class="column twelve"><label for="comment">' . __( 'Comment', 'lt_yes' ) . '</label><textarea id="comment" name="comment" cols="30" rows="10" aria-required="true"></textarea></div>',
		'label_submit' => __( 'Submit Comment' , 'lt_yes'),
		'cancel_reply_link' => __( '&#215','lt_yes' ),
		'id_submit' => 'comment-submit',
		'class_submit' => 'color',
		'comment_notes_after' => ' ' //remove "You may use these HTML tags and attributes: ...."
	);

?>

<section id="leave-comment" class="pattern">
    <div class="form">
        <div class="container smaller">
            <div class="row">
            	<?php comment_form($iva_comments_args); ?>
            </div>
        </div>
    </div>
</section>

<header class="section-header">
    <h3 class="section-title"><?php comments_number(__('No Comments', 'lt_yes'), __('<span>1</span> Comment', 'lt_yes'), __('<span>%</span> Comments', 'lt_yes') );?></h3>
</header>
<div class="container smaller">
    <div class="row">
        <div class="column twelve">
			<div class="real-comments" id="list_all_comments" data-type="post" data-id="<?php echo $post->ID; ?>">
				<!-- Looping Comments -->
				<?php wp_list_comments(array('max_depth' => '3','avatar_size' => '66','walker' => new LT_Walker_Comment, 'callback' => 'yes_comments','per_page' => '3')); ?>

			</div>
			<?php if(get_comments_number() > 3) { ?>
				<?php if(function_exists('lt_retrieve_comments')) { ?>
                <div class="timeline-button"><a href="#" class="yes_button" id="more-comments"><?php _e('Load more', 'lt_yes'); ?></a></div>
				<?php } else { ?>
					<div class="comments-navigation">
						<div class="alignleft"><?php previous_comments_link(__( '&larr; Older Comments', 'lt_yes' )); ?></div>
						<div class="alignright"><?php next_comments_link( __( '&larr; Newer Comments', 'lt_yes' ) ); ?></div>
					</div>
				<?php } 
			} ?>
<?php else : // no comments yet ?>
			<div id="no-comments">
				<?php if ('open' == $post->comment_status) : ?>
					<p><?php _e('', 'lt_yes'); ?></p>

				 <?php else : ?>
					<!-- [comments are closed, and no comments] -->
					<p><?php _e('Comments are closed.', 'lt_yes'); ?></p>

				<?php endif; ?>
			</div>	
<?php endif; ?>
		</div>
	</div>
</div>