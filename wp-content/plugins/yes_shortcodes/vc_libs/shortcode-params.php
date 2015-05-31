<?php

/************* Custom ShortCodes Attributes *************/

/*
Sometimes you may need to add new attribute type for content element attributes. 
The add_shortcode_param() function is used to register an attribute type handler which will form html markup for settings 
form in Visual Composer edit element form. It takes three parameters: the attribute type name (String used in vc_map() 
mapping function in type parameter), the callback function name and the javascript file absolute url.
https://wpbakery.atlassian.net/wiki/display/VC/Create+New+Param+Type
*/

// Custom type for google maps- shows map and have user click to point to his location
function yes_vc_gmap_coords_settings_fields($settings, $value) {
	
	return '<label class="lat">Latitude: <strong>0</strong>, </label>
			<label class="lng">Longitude: <strong>0</strong>, </label>
			<label class="zoom">Zoom level: <strong>0</strong></label>
			<input name="'.$settings['param_name']
			.'" class="wpb_vc_param_value wpb-textinput '
			.$settings['param_name'].' '.$settings['type'].'_field" type="hidden" value="'
			.$value.'"/>
			<div id="gmap_loc" style="width: 100%;height: 250px;"></div>';
}

add_shortcode_param('gmap_coords', 'yes_vc_gmap_coords_settings_fields', YES_ADDON_ASSETS_URL. 'js/run.js');

// Custom Type for choosing Icons - shows list of icons and let user to choose.
function yes_vc_pe_icon_settings_fields($settings, $value) {
	$font_icons = include YES_ADDON_DIR . "helpers/pe-icons.php"; // include pe-icons.
	
	$output = '<div class="font-icons-container">';
	
	if($font_icons && is_array($font_icons)) {
		foreach ($font_icons as $icon) {
			$output .= '<span class="'.$icon;
			
			if($icon == $value) {
				$output .= ' selected';
			}
			
			$output .='"></span>';
		}
	}
	
	$output .= '</div>';
	
	return '<script></script>'
		.'<div class="my_param_block">'
		.'<input name="'.$settings['param_name']
		.'" class="wpb_vc_param_value wpb-textinput '
		.$settings['param_name'].' '.$settings['type'].'_field" type="text" value="'
		.$value.'" />'
		.$output
		.'</div>';
}

add_shortcode_param('pe_icon_field', 'yes_vc_pe_icon_settings_fields', YES_ADDON_ASSETS_URL. 'js/run.js');

?>