<?php

if ( have_comments() ) : // we have comments ?>
        <div id="list_all_comments" data-type="guestbook" data-id="<?php echo $post->ID; ?>">
                <?php wp_list_comments(array('max_depth' => '1','avatar_size' => '66','walker' => new LT_Walker_Comment, 'callback' => 'yes_guestbook_comment','per_page' => '4')); ?>

        </div>
        <?php if(get_comments_number() > 4) { ?>
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

</div></div></div></div></div>
<div><div><div><div class="vc_row iva_vc_row wpb_row vc_row-fluid"><div class="container">

<?php

$comments_args = array(
        'fields' => apply_filters( 'comment_form_default_fields', 
                array(
                'author' => '<div class="column six"><label for="contactname">Name</label><input type="text" name="author" id="contactname" title="'.__( 'Name', 'lt_yes' ).'*"></div>',
                'email'  => '<div class="column six"><label for="contactemail">Email</label><input type="email" name="email" id="contactemail" title="'.__( 'Email', 'lt_yes' ).'*"></div>',
                )
        ),
        'id_form'              => 'guestbookform',
        'id_submit'            => 'submit',
        'class_submit'         => 'color',
        'name_submit'          => 'submit',
        'logged_in_as'         => '',
        // change the title of send button 
        'label_submit'=>'Send Your Message',
        // change the title of the reply section
        'title_reply'=>'Write a Wish',
        'comment_notes_before' => '',
        // remove "Text or HTML to be displayed after the set of comment fields"
        'comment_notes_after' => '',
        // redefine your own textarea (the comment body)
        'comment_field' => '<div class="column twelve"><label for="comment">' . __( 'Comment', 'lt_yes' ) . '</label><textarea id="comment" name="comment" cols="30" rows="10" aria-required="true"></textarea></div>',
        );

        comment_form($comments_args);

?>