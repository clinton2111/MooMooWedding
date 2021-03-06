<?php
$output = $el_class = $css_animation = $width = '';
extract(shortcode_atts(array(
    'el_class' => '',
    'width' => '1/1',
    'css_animation' => '',
    'css' => ''
), $atts));

$el_class = $this->getExtraClass($el_class);
$width = wpb_translateColumnWidthToSpan($width);

$el_class .= ' wpb_column vc_column_container';

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $width.$el_class, $this->settings['base']);
$css_class .= $this->getCSSAnimation($css_animation);
$output .= "\n\t" . '<div class="' . $css_class . ' ' . vc_shortcode_custom_css_class( $css, ' ' ) . '">';
$output .= "\n\t\t" . '<div class="wpb_wrapper">';
$output .= "\n\t\t\t" . wpb_js_remove_wpautop( $content );
$output .= "\n\t\t" . '</div> ' . $this->endBlockComment( '.wpb_wrapper' );
$output .= "\n\t" . '</div> ' . $this->endBlockComment( $el_class ) . "\n";
echo $output;