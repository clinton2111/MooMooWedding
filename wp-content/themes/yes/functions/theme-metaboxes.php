<?php
// Post Metas Included in Yes:
/*
*
* Event Metas:
* -----------
* lt_meta_place
* lt_meta_address
* lt_meta_date
* lt_meta_time
* lt_meta_map
*
* Portfolio Metas:
* ----------------
* lt_meta_person_facebook
* lt_meta_person_twitter
* lt_meta_person_linkedin
* lt_meta_person_gplus
* lt_meta_person_instagram
* lt_gallery
*
*/

//include the main class file
require_once("meta-box-class/meta_box.php");
if (is_admin()){

$prefix = 'lt_meta_';

// Events MetaBoxes
$fields = array(
    array(
        'id'    => $prefix.'place',
        'label' => 'Place name',
        'type'  => 'text',
    ),
    array(
        'id'    => $prefix.'address',
        'label' => 'Address',
        'desc'  => 'Event addess, e.g.:"60 Switch Street, New York NY"',
        'type'  => 'text',
    ),
    array(
        'id'    => $prefix.'date',
        'label' => 'Date',
        'type'  => 'date',
    ),    
    array(
        'id'    => $prefix.'time',
        'label' => 'Time',
        'desc'  => 'Enter as text, such as: "8:00 PM - 5:00 AM"',
        'type'  => 'text',
    ),
    array(
        'id'    => $prefix.'title',
        'label' => 'Title',
        'desc'  => 'Title that will show when someone clicks on an icon',
        'type'  => 'text',
    ),
    array(
        'id'    => $prefix.'description',
        'label' => 'Description',
        'desc'  => 'Description that will show when someone clicks on an icon"',
        'type'  => 'text',
    )
);

$portfolio_meta = new custom_add_meta_box( 'portfolio_meta', 'Event Information', $fields, array('events'), true, 'normal' );

// Event MetaBoxes
$fields = array(
    array(
        'id'    => $prefix.'map',
        'label' => 'Place Map Pin',
        'desc'  => 'Leave empty to hide subtitle',
        'type'  => 'map',
    )
);

$map_meta = new custom_add_meta_box( 'map_meta', 'Event Map', $fields, array('events'), false, 'advanced' );


// Important People Metaboxes
$fields = array(
    array( // Facebook
        'id'    => $prefix.'person_facebook',
        'label' => 'Facebook Link',
        'desc'  => 'Facebook Profile link, together with http:...',
        'type'  => 'url',
    ),
    array( // Twitter
        'id'    => $prefix.'person_twitter',
        'label' => 'Twitter Link',
        'desc'  => 'Twitter Profile link, together with http:...',
        'type'  => 'url',
    ),
    array( // Linkedin
        'id'    => $prefix.'person_linkedin',
        'label' => 'Linkedin Link',
        'desc'  => 'Linkedin Profile link, together with http:...',
        'type'  => 'url',
    ),
    array( // Google
        'id'    => $prefix.'person_gplus',
        'label' => 'Google Plus Link',
        'desc'  => 'Google Plus Profile link, together with http:...',
        'type'  => 'url',
    ),
    array( // Pinterest
        'id'    => $prefix.'person_instagram',
        'label' => 'Instagram Link',
        'desc'  => 'Instagram Profile link, together with http:...',
        'type'  => 'url',
    )
);

$team_meta = new custom_add_meta_box( 'team_meta', 'Social Links', $fields, array('important-people' ), false, 'normal' );


  //Gallery MetaBox
  add_action( 'add_meta_boxes', 'gallery_meta_boxes' );

  function gallery_meta_boxes() {

    wp_register_script('gallery-picker', get_template_directory_uri() .'/functions/meta-box-class/js/gallery-picker.js', array('jquery'), false);
    wp_enqueue_script('gallery-picker');

    wp_enqueue_script( 'jquery-ui-sortable' );

    add_thickbox();

    $screens = array( 'post', 'events' );

    foreach ( $screens as $screen ) {

        add_meta_box(
            'gallery-images',
            "Gallery",
            'gallery_meta_box',
            $screen
        );
    }

  }

  function gallery_meta_box($post) {

    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'lt_gallery', 'lt_gallery_nonce' );

    echo '<table class="form-table"><tbody><tr><td>';   
    echo '<table class="gallery-images fixed widefat"><tbody>';
    ?>


    <?php 
    $value = get_post_meta( $post->ID, 'lt_gallery', true );
    if($value):
    foreach($value as $k => $v): 
      
      $media = get_post($v);
      
      if(!$media) {
        continue;
      }
      
      $image = wp_get_attachment_image($v);
      $title = $media->post_title;
      $mime = get_post_mime_type($media);
      $edit_link = get_edit_post_link($media->ID);

    ?>
    <tr>
      <td class="media-icon">
        <?php echo $image; ?>
      </td>
      <td class="column-title">
        <strong><?php echo $title; ?></strong>  
      </td>
      <td class="column-title"><p><?php echo $mime; ?></p></td>
      <td class="column-parent">
        <a href="<?php echo $edit_link; ?>">Edit</a>
      </td>
      <td class="column-parent">
        <a href="#" class="remove-gallery-image">Remove</a>
        <input type='hidden' name='gallery_images[]' value='<?php echo $v; ?>' />
      </td>
    </tr>

    <?php endforeach; ?>
    <?php endif; ?>


    <span class="description">Drag to arrange images.</span></td>

    <?php             
    echo '</tbody></table>';
    echo '<input class="gallery-image-upload auto button-primary" type="button" name="upload_button" value="Add new image" />';
    echo '</tbody></table>';

  } 


  function gallery_save_meta_box_data( $post_id ) {

    // Check if our nonce is set.
    if ( ! isset( $_POST['lt_gallery_nonce'] ) ) {
    return;
    }

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['lt_gallery_nonce'], 'lt_gallery' ) ) {
    return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return;
    }

    // Check the user's permissions.
    if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

    if ( ! current_user_can( 'edit_page', $post_id ) ) {
    return;
    }

    } else {

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
    return;
    }
    }

    $data = array();
    $data = $_POST['gallery_images'];
    $data = is_array( $data ) ? array_map( 'esc_attr', $data ) : esc_attr( $data );

    // Update the meta field in the database.
    update_post_meta( $post_id, 'lt_gallery', $data );

  }
  add_action( 'save_post', 'gallery_save_meta_box_data' );

}
