<?php

/************* VC ROW - Custom Stuff *************/

// Remove custom row css params
 vc_remove_param("vc_row", "css");
 vc_remove_param("vc_row", "full_width");
/**
 * Section header settings at row level
 */
$setting = array(
	"type" => "textfield",
	"heading" => __("ID attribute", 'js_composer' ),
    "param_name" => "id",
    "admin_label" => true,
    "value" => "",
    "description" => __("Custom ID element.", 'js_composer' )
    );
vc_add_param( 'vc_row', $setting );	

/**
 * Background parameters
 */
$setting = array(
	"type" => "dropdown",
    "heading" => __("Background", 'js_composer' ),
    "param_name" => "section_background",
    "value" => array("None"=>"none","Custom"=>"custom"),
);
vc_add_param( 'vc_row', $setting );

$setting = array(
	"type" => "attach_image",
    "heading" => __("Background image", 'js_composer' ),
    "param_name" => "bg_image",
    "value" => "",
    "admin_label" => true,
	"description" => __("Set section image", 'js_composer' ),
	"dependency" => array('element' => "section_background", 'value' => array('custom')),
);
vc_add_param( 'vc_row', $setting );

$setting = array(
	"type" => "checkbox",
    "heading" => __("", 'js_composer' ),
    "param_name" => "bg_paralax",
    "value" =>  array("Use paralax effect" => "on"),
    "admin_label" => true,
	// "description" => __("Use paralax effect"),
	"dependency" => array('element' => "section_background", 'value' => array('custom')),
);
vc_add_param( 'vc_row', $setting );

$setting = array(
	"type" => "colorpicker",
    "heading" => __("Background color and opacity on images", 'js_composer' ),
    "param_name" => "bg_color",
    "value" => "",
    "admin_label" => true,
	"description" => __("Opacity can be combined with background image", 'js_composer' ),
	"dependency" => array('element' => "section_background", 'value' => array('custom')),
);
vc_add_param( 'vc_row', $setting );

$setting = array(
	"type" => "textfield",
    "heading" => __("Youtube url", 'js_composer' ),
    "param_name" => "bg_video_url",
    "value" => "",
    "admin_label" => true,
	"description" => __("Plays video in section background, fallback to background image. Accepts only YouTube links. Only one per page.", 'js_composer' ),
	"dependency" => array('element' => "section_background", 'value' => array('custom')),
);
vc_add_param( 'vc_row', $setting );

$setting = array(
	"type" => "dropdown",
    "heading" => __("Row display", 'js_composer' ),
    "param_name" => "row_display",
    "value" => array("Fullwidth"=>"fullwidth","In Container"=>"container"),
    "admin_label" => true,
    "description" => __("Choose width size for row", 'js_composer' ),
);
vc_add_param( 'vc_row', $setting );
/*
$setting = array(
    "type" => "checkbox",
    "heading" => __("", 'js_composer' ),
    "param_name" => "left_right_padding",
    "value" =>  array("Remove Left and Right Padding" => "on"),
    "admin_label" => true,
    "description" => __("Check this if you are working on 'One Page' page that is not home page, to make it full width.", 'js_composer' ),
);
vc_add_param( 'vc_row', $setting );
*/
$setting = array(
    "type" => "checkbox",
    "heading" => __("", 'js_composer' ),
    "param_name" => "pattern",
    "value" =>  array("Pattern" => "on"),
    "admin_label" => true,
    "description" => __("Check this if you want section to have pattern background. Usually you want this on every second section.", 'js_composer' ),
);
vc_add_param( 'vc_row', $setting );

$setting = array(
    "type" => "checkbox",
    "heading" => __("", 'js_composer' ),
    "param_name" => "timeline",
    "value" =>  array("Middle Line" => "on"),
    "admin_label" => true,
    "description" => __("Check this if you need middle line with arrows to show.", 'js_composer' ),
);
vc_add_param( 'vc_row', $setting );

?>