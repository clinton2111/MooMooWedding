<?php
$output = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $css = '';
extract(shortcode_atts(array(
    'el_class'        => '',
    'bg_image'        => '',
    'bg_color'        => '',
    'bg_image_repeat' => '',
    'bg_paralax' => '',
    'bg_video_url' => '',
    'font_color'      => '',
    'padding'         => '',
    'margin_bottom'   => '',
    'css' => '',
    'section_header' => '',
    'pattern' => '',
    'row_display' => '',
 //   'left_right_padding' => '',
    'id' => '',
    'timeline' => '',
), $atts));


// wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
// wp_enqueue_style('js_composer_custom_css');

$el_class = $this->getExtraClass($el_class);
$row_class = $this->getExtraClass($row_display);

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row iva_vc_row wpb_row '. ( $this->settings('base')==='vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

$style = $this->buildStyle('', $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);
//$bgColorStyle = $this->buildStyle('', $bg_color);
$bgSectionStyle = $this->buildStyle($bg_image, $bg_color);

$sec_class = '';

// Extra Section Class
if($bg_video_url != '') { 
    $sec_class = 'nonbg ';
}
if($el_class != '') {
    $sec_class .= $el_class.' ';
}
if($bg_paralax == 'on' || $bg_image != '') {
    $sec_class .= 'parallax-background fixed ';
}
if($bgSectionStyle != '') {
    $sec_class .= 'bgcolor ';
}
if($pattern == 'on') {
    $sec_class .= 'pattern ';
}
if($timeline == 'on') {
    $sec_class .= 'timeline-on ';
}  
$bgSectionClass = $this->getExtraClass($sec_class);
if ($bgSectionClass != '') {
    $bgSectionClass = ' class="'.$bgSectionClass.'" ';
}

$data = $bg_paralax == 'on' ? ' data-type="parallax" ' : '';
$idAttr = $id ? ' id="'.$id.'" ' : '';
if($bg_video_url != '') {
    $idAttr = " id='video-bg' ";
}
$output .= '<section '.$bgSectionStyle . $idAttr . $bgSectionClass . $data.'>';

if($timeline == 'on') {
    $output .= '<div class="timeline"><span class="arrow-up"></span><span class="arrow-down"></span>';
}      
                
$output .= '<div class="'.$css_class.'"'.$style.'>';
$output .= '<div class="bg_color'.$row_class.' " >';
$output .= wpb_js_remove_wpautop($content);
$output .= '</div>';
$output .= '</div>'.$this->endBlockComment('row');
if($timeline == 'on') {
    $output .= '</div>';
}   
$output .= '</section>';
if($bg_video_url != '') {
    $output .= '<a id="bgndVideo" class="player" data-property="{ videoURL : \''.$bg_video_url.'\' , containment : \'#video-bg\' , autoPlay : true, mute : false, vol : 3, startAt : 0, opacity : 1}"></a>';
}
echo $output;