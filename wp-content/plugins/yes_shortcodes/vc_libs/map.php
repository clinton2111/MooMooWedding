<?php

/************* Connecting ShortCodes to Visual Composer *************/
   
   // Section Header
   vc_map(array(
      "name" => __("Section Header", "js_composer") ,
      "icon" => YES_ADDON_ASSETS_URL ."images/yes-icon.png",
      "weight" => 21,
      "base" => "yes-section-header", // Shortcode tag. For [yes-section-header] shortcode base is yes-section-header
      "description" => __("Set a title and tagline for a section", "js_composer") ,
      "category" => __("Built for Yes", "js_composer") ,
      "params" => array(
         array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Section Title", "js_composer") ,
            "param_name" => "title",
            "description" => __("Set section title", "js_composer")
         ) ,
         array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Section Tagline", "js_composer") ,
            "param_name" => "tagline",
            "description" => __("Set section tagline (optional)", "js_composer")
         ) ,
         array(
            "type" => "pe_icon_field",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Section Icon", "js_composer") ,
            "param_name" => "font_pe_icon",
            "description" => __("Add section icon", "js_composer") ,
            "callback" => 'alert'
         )
      )
   ));

   // CTA Section
   vc_map(array(
      "name" => __("Yes Call To Action", "js_composer") ,
      "icon" => YES_ADDON_ASSETS_URL ."images/yes-icon.png",
      "weight" => 21,
      "base" => "yes-cta",
      "description" => __("Add CTA", "js_composer") ,
      "category" => __("Built for Yes", "js_composer") ,
      "params" => array(
         array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Text", "js_composer") ,
            "param_name" => "text",
            "description" => __("Content text", "js_composer")
         ) ,
         array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Link text", "js_composer") ,
            "param_name" => "link_text",
            "description" => __("Text on a link element", "js_composer")
         ) ,
         array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Url", "js_composer") ,
            "param_name" => "url",
            "description" => __("CTA link", "js_composer")
         )
      )
   ));

   // Couple Section
   vc_map(array(
      "name" => __("Couple Section", "js_composer") ,
      "icon" => YES_ADDON_ASSETS_URL ."images/yes-icon.png",
      "weight" => 21,
      "base" => "yes-couple",
      "description" => __("Intro Section With Image and Name", "js_composer") ,
      "category" => __("Built for Yes", "js_composer") ,
      "params" => array(
         array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Her First Name", "js_composer") ,
            "param_name" => "her_first_name"
         ) ,
         array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Her Last Name", "js_composer") ,
            "param_name" => "her_last_name"
         ) ,
         array(
            "type" => "attach_image",
            "admin_label" => true,
            "heading" => __("Her photo", "js_composer") ,
            "param_name" => "her_photo",
            "description" => __("Select her image", "js_composer")
         ) ,
         array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading" => __("His First Name", "js_composer") ,
            "param_name" => "his_first_name"
         ) ,
         array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading" => __("His Last Name", "js_composer") ,
            "param_name" => "his_last_name"
         ) ,
         array(
            "type" => "attach_image",
            "admin_label" => true,
            "heading" => __("His photo", "js_composer") ,
            "param_name" => "his_photo",
            "description" => __("Select his image", "js_composer")
         )

      )
   ));

   //Couple's Story
   vc_map(array(
      "name" => __("Couple's Story", "js_composer") ,
      "icon" => YES_ADDON_ASSETS_URL ."images/yes-icon.png",
      "weight" => 21,
      "base" => "yes-couple-story",
      "description" => __("Add Couple's Story", "js_composer") ,
      "category" => __("Built for Yes", "js_composer") ,
      "params" => array(
         array(
            "type" => "textarea",
            "class" => "",
            "admin_label" => true,
            "heading" => __("His Story", "js_composer") ,
            "param_name" => "his_story"
         ) ,
         array(
            "type" => "textarea",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Her Story", "js_composer") ,
            "param_name" => "her_story"
         ) , 
         array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading" => __("His Title", "js_composer") ,
            "param_name" => "his_title",
            "value" => __("Groom's story","js_composer")
         ) ,
         array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Her Title", "js_composer") ,
            "param_name" => "her_title",
            "value" => __("Bride's story","js_composer")
         ) ,
         array(
            "type" => "textarea",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Story Together", "js_composer") ,
            "param_name" => "story_together"
         ) ,   
      )
   ));

   //Quote
   vc_map(array(
      "name" => __("Quote Section", "js_composer") ,
      "weight" => 16,
      "base" => "yes-quote",
      "icon" => YES_ADDON_ASSETS_URL ."images/yes-icon.png",
      "description" => __("Place background image in row settings", "js_composer") ,
      "category" => __("Built for Yes", "js_composer") ,
      "params" => array(
         array(
            "type" => "textarea",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Quote text", "js_composer") ,
            "param_name" => "quote_text"
         )
      )
   ));

   // Blog - loveline
   $get_terms = get_terms('category', array(
      'hide_empty' => false
   ));
   $categories = array();

   foreach($get_terms as $term) {
      $categories[$term->name] = $term->term_id;
   }
   vc_map(array(
      "name" => __("Loveline Section", "js_composer") ,
      "icon" => YES_ADDON_ASSETS_URL ."images/yes-icon.png",
      "weight" => 21,
      "base" => "yes-loveline-box",
      "description" => __("Loveline blog posts", "js_composer") ,
      "category" => __("Built for Yes", "js_composer") ,
      "params" => array(
         array(
            "type" => "checkbox",
            "heading" => __("Categories", "js_composer") ,
            "param_name" => "categories",
            "value" => $categories,
            "description" => __("Which categories to display", "js_composer")
         ) ,
      )
   ));

   // Events List
   vc_map(array(
      "name" => __("Events Section", "js_composer") ,
      "icon" => YES_ADDON_ASSETS_URL ."images/yes-icon.png",
      "weight" => 21,
      "base" => "yes-events-list",
      "description" => __("Events list", "js_composer") ,
      "category" => __("Built for Yes", "js_composer")
   ));

   // Google Maps Holder
   vc_map(array(
      "name" => __("Google Map Holder", "js_composer") ,
      "icon" => YES_ADDON_ASSETS_URL ."images/yes-icon.png",
      "weight" => 21,
      "base" => "map_holder",
      "description" => __("Add all locations inside this container", "js_composer") ,
      "as_parent" => array(
         'only' => 'map_location'
      ) ,
      "content_element" => true,
      "show_settings_on_create" => false,
      "category" => __("Built for Yes", "js_composer") ,
      "params" => array(
         array(
            "type" => "dropdown",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Select Map Type", "js_composer") ,
            "value" => array('ROADMAP' => 'ROADMAP','SATELLITE' => 'SATELLITE','HYBRID' => 'HYBRID','TERRAIN' => 'TERRAIN' ),
            "param_name" => "map_type",
            "description" => __("Choose map type.", "js_composer")
         ),
         array(
            "type" => "checkbox",
            "heading" => __("Icons to show", "js_composer") ,
            "param_name" => "map_icons",
            "value" => array(
               'Hotel' => 'hotel',
               'Restaurant' => 'restaurant',
               'Airport' => 'airport',
               'Attraction' => 'attraction',
               'Bachelor' => 'bachelor',
               'Bachelorette' => 'bachelorette',
               'Shopping' => 'shopping',
               'Special' => 'special',
               'Wedding' => 'wedding',
               'Wedding Party' => 'weddingParty',
            ) ,
            "description" => __("Chose which icons to show on left side", "js_composer")
         )
      ) ,
      "js_view" => 'VcColumnView'
   ));

   // Google Maps Locations - Holder Child
   vc_map(array(
      "name" => __("Single Location", "js_composer") ,
      "base" => "map_location",
      "icon" => YES_ADDON_ASSETS_URL ."images/yes-icon.png",
      "description" => __("Show your location in a google map widget", "js_composer") ,
      "as_child" => array(
         'only' => 'map_holder'
      ) ,
      "category" => __("Built for Yes", "js_composer") ,
      "params" => array(
         array(
            "type" => "gmap_coords",
            "heading" => __("Coordinates", "js_composer") ,
            "param_name" => "coords",
            "description" => __("Click on the map to set latitude, longitude and zoom level. NOTICE: If you are using scrollwheel or hand icon, you again need to click on map to update location.", "js_composer")
         ),
         array(
            "type" => "dropdown",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Hero Copy Look", "js_composer") ,
            "value" => array(
               'Hotel' => 'hotel',
               'Restaurant' => 'restaurant',
               'Airport' => 'airport',
               'Attraction' => 'attraction',
               'Bachelor' => 'bachelor',
               'Bachelorette' => 'bachelorette',
               'Shopping' => 'shopping',
               'Special' => 'special',
               'Wedding' => 'wedding',
               'Wedding Party' => 'weddingParty',
            ) ,
            "param_name" => "map_type",
            "description" => __("Chose Location Type", "js_composer")
         ),
         array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Title", "js_composer") ,
            "param_name" => "map_title"
         ) ,
         array(
            "type" => "textarea",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Description", "js_composer") ,
            "param_name" => "map_text"
         )
      )
   ));

   // Important People
   $get_terms = get_terms('people-category', array(
      'hide_empty' => false
   ));

   $portfolio_categories = array();

   foreach($get_terms as $term) 
   {
      $portfolio_categories[$term->name] = $term->slug;
   }

   vc_map(array(
      "name" => __("Important People", "js_composer") ,
      "icon" => YES_ADDON_ASSETS_URL ."images/yes-icon.png",
      "weight" => 21,
      "base" => "important-people",
      "description" => __("List Important People", "js_composer") ,
      "category" => __("Built for Yes", "js_composer") ,
      "params" => array(
         array(
            "type" => "dropdown",
            "heading" => __("Chose Left Group", "js_composer") ,
            "param_name" => "left_group",
            "value" => $portfolio_categories,
            "description" => __("Which people you want to show on the left side", "js_composer")
         ),
         array(
            "type" => "dropdown",
            "heading" => __("Chose Right Group", "js_composer") ,
            "param_name" => "right_group",
            "value" => $portfolio_categories,
            "description" => __("Which people you want to show on the right side", "js_composer")
         ),
      )
   ));

   // Twitter Feeds
   vc_map(array(
      "name" => __("Twitter Feed", "js_composer") ,
      "icon" => YES_ADDON_ASSETS_URL ."images/yes-icon.png",
      "weight" => 21,
      "base" => "yes-twitter-feed",
      "description" => __("Display latest tweets for him and her", "js_composer") ,
      "category" => __("Built for Yes", "js_composer") ,
      "params" => array(
         array(
            "type" => "textfield",
            "heading" => __("His twitter username", "js_composer") ,
            "param_name" => "his_username",
            "admin_label" => true,
            "description" => __("His tweets to fetch", "js_composer")
         ) ,
         array(
            "type" => "textfield",
            "heading" => __("Her twitter username", "js_composer") ,
            "param_name" => "her_username",
            "admin_label" => true,
            "description" => __("Her tweets to fetch", "js_composer")
         ) ,
         array(
            "type" => "textfield",
            "heading" => __("Number of tweets", "js_composer") ,
            "param_name" => "count",
            "admin_label" => true,
            "description" => __("How many tweets to display for each", "js_composer")
         ) ,
         array(
            "type" => "textfield",
            "heading" => __("API key", "js_composer") ,
            "param_name" => "api_key",
         ) ,
         array(
            "type" => "textfield",
            "heading" => __("API secret", "js_composer") ,
            "param_name" => "api_secret",
         ) ,
         array(
            "type" => "textfield",
            "heading" => __("Access token", "js_composer") ,
            "param_name" => "access_token",
         ) ,
         array(
            "type" => "textfield",
            "heading" => __("Access token secret", "js_composer", "js_composer") ,
            "param_name" => "access_token_secret",
         ) ,
      )
   ));

   // Gift Registry
   vc_map(array(
      "name" => __("Gift Registry", "js_composer") ,
      "icon" => YES_ADDON_ASSETS_URL ."images/yes-icon.png",
      "weight" => 21,
      "as_parent" => array(
         'only' => 'gift_paypal,gift_image'
      ) ,
      "show_settings_on_create" => false,
      "base" => "yes_gift_registry",
      "description" => __("Add a new gift group", "js_composer") ,
      "category" => __("Built for Yes", "js_composer")
   ));
   // Gift Paypal
   vc_map(array(
      "name" => __("Paypal", "js_composer") ,
      "icon" => YES_ADDON_ASSETS_URL ."images/yes-icon.png",
      "weight" => 21,
      "as_child" => array(
         'only' => 'yes_gift_registry'
      ) ,
      "base" => "gift_paypal",
      "description" => __("Add Paypal Gift", "js_composer") ,
      "category" => __("Built for Yes", "js_composer") ,
      "params" => array(
         array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Paypal Address", "js_composer") ,
            "param_name" => "paypal_address",
            "description" => __("Set your paypal email address to which you will recieve donations.", "js_composer")
         ) ,
         array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Donation Amount", "js_composer") ,
            "param_name" => "donation_amount",
            "description" => __("Set your paypal donation amount, make sure you enter just numbers. Such as 100.", "js_composer")
         ) ,
      )
   ));
   // Gift Image
   vc_map(array(
      "name" => __("Image Link", "js_composer") ,
      "icon" => YES_ADDON_ASSETS_URL ."images/yes-icon.png",
      "weight" => 21,
      "as_child" => array(
         'only' => 'yes_gift_registry'
      ) ,
      "base" => "gift_image",
      "description" => __("Add Image Link Gift", "js_composer") ,
      "category" => __("Built for Yes", "js_composer") ,
      "params" => array(
         array(
            "type" => "attach_image",
            "admin_label" => true,
            "heading" => __("Donation Image", "js_composer") ,
            "param_name" => "gift_image",
            "description" => __("Select Donation image to display and act as a hyperlink.", "js_composer")
         ) ,
         array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Donation Link", "js_composer") ,
            "param_name" => "gift_link",
            "description" => __("Add Donation link that would link to donation item.", "js_composer")
         )
      )
   ));

   // Guestbook Section
   vc_map(array(
      "name" => __("Guestbook Section", "js_composer") ,
      "icon" => YES_ADDON_ASSETS_URL ."images/yes-icon.png",
      "weight" => 21,
      "base" => "yes_guestbook",
      "description" => __("Number of comments can be edited in wordpress settings.", "js_composer") ,
      "category" => __("Built for Yes", "js_composer") ,
      "params" => array(
         array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Donation Link", "js_composer") ,
            "param_name" => "gift_link",
            "description" => __("Add Donation link that would link to donation item.", "js_composer")
         )
      )
   ));

   // Instagram Section
   vc_map(array(
      "name" => __("Instagram Section", "js_composer") ,
      "icon" => YES_ADDON_ASSETS_URL ."images/yes-icon.png",
      "weight" => 21,
      "base" => "yes-instagram",
      "description" => __("Place instagram .", "js_composer") ,
      "category" => __("Built for Yes", "js_composer") ,
      "params" => array(
         array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Hash", "js_composer") ,
            "param_name" => "hash",
            "description" => __("Hash tag that you are using to fetch data.Without # !", "js_composer")
         ),
         array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Instagram clientID", "js_composer") ,
            "param_name" => "clientid",
            "description" => __("Check documentation how to obtain one.", "js_composer")
         ),
      )
   ));

   // Contact Form 7
   $args = array('post_type' => 'wpcf7_contact_form',);
   $form_array = get_posts( $args );
   $cf7_array = array();
   foreach ($form_array as $key => $value) {
      $cf7_array[$value->post_name] = $value->ID;
   }

   vc_map(array(
      "name" => __("RSVP Form", "js_composer") ,
      "icon" => YES_ADDON_ASSETS_URL ."images/yes-icon.png",
      "weight" => 21,
      "base" => "yes-contact-form",
      "description" => __("Contact Form 7 powered RSVP form", "js_composer") ,
      "category" => __("Built for Yes", "js_composer") ,
      "params" => array(
         array(
            "type" => "dropdown",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Select Contact Form", "js_composer") ,
            "value" => $cf7_array,
            "param_name" => "cf7",
            "description" => __("Choose from your prebuilt Contact Form 7 Forms", "js_composer")
         ),
      )
   ));

   vc_map(array(
      "name" => __("Yes Hero", "js_composer") ,
      "icon" => YES_ADDON_ASSETS_URL ."images/yes-icon.png",
      "weight" => 40,
      "base" => "yes-hero",
      "description" => __("Homepage Hero(Header) for Yes", "js_composer") ,
      "category" => __("Built for Yes", "js_composer") ,
      "params" => array(
         array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Main Headings", "js_composer") ,
            "param_name" => "hero_main",
            "description" => __("Main Headings (h1)", "js_composer") ,
         ) ,
         array(
            "type" => "textarea",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Date and Place", "js_composer") ,
            "param_name" => "date_time",
            "description" => __("Goes below heading, example:(on August 19th 2015, Los Angeles, CA)", "js_composer")
         ) ,
         array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading" => __("His Name", "js_composer") ,
            "param_name" => "his_name",
            "description" => __("Goes at the top of hero.", "js_composer") ,
         ) ,
         array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Her Name", "js_composer") ,
            "param_name" => "her_name",
            "description" => __("Goes at the top of hero.", "js_composer") ,
         ) ,
         array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Button Link", "js_composer") ,
            "param_name" => "hero_button_link",
            "description" => __("Button link", "js_composer")
         ) ,
         array(
            "type" => "dropdown",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Countdown", "js_composer") ,
            "value" => array(
               'No' => '',
               'Yes' => 'yes',
            ) ,
            "param_name" => "counter",
            "description" => __("Add Countdown to hero", "js_composer")
         ) ,
         array(
            "type" => "dropdown",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Slideshow", "js_composer") ,
            "value" => array(
               'No' => '',
               'Yes' => 'yes',
            ) ,
            "param_name" => "slideshow",
            "description" => __("If you want to add slideshow, make sure to remove video and background image in row property.", "js_composer")
         ) ,   
         array(
            "type" => "attach_images",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Slideshow", "js_composer") ,
            "param_name" => "slide_images",
            "dependency" => array('element' => "slideshow", 'value' => array('yes')),
            "description" => __("If you want to add slideshow, make sure to remove video and background image in row property.", "js_composer")
         ) ,
         array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Wedding Date", "js_composer") ,
            "dependency" => array('element' => "counter", 'value' => array('yes')),
            "param_name" => "date",
            "description" => __("IMPORTANT:Add date in this format: 12/28/2015 12:00 AM", "js_composer")
         ) ,
      )
   ));

   vc_map(array(
      "name" => __("Yes Gallery", "js_composer") ,
      "icon" => YES_ADDON_ASSETS_URL ."images/yes-icon.png",
      "weight" => 75,
      "base" => "yes-gallery",
      "description" => __("Set Image caption as category.", "js_composer") ,
      "category" => __("Built for Yes", "js_composer") ,
      "params" => array(
         array(
            "type" => "attach_images",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Image Gallery", "js_composer") ,
            "param_name" => "images",
            "description" => __("Set caption for each image as category", "js_composer")
         ) ,
      )
   ));

?>