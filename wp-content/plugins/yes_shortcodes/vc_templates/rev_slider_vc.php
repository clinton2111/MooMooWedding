<?php
global $lt_yes_theme;
$output = $title = $alias = $el_class = '';
extract( shortcode_atts( array(
    'title' => '',
    'alias' => '',
    'el_class' => ''
), $atts ) );

$el_class = $this->getExtraClass($el_class);
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_revslider_element wpb_content_element' . $el_class, $this->settings['base'], $atts );

$output .= '<div class="'.$css_class.'">';
$output .= wpb_widget_title(array('title' => $title, 'extraclass' => 'wpb_revslider_heading'));
$output .= apply_filters('vc_revslider_shortcode', do_shortcode('[rev_slider '.$alias.']'));
$output .= '</div>'.$this->endBlockComment('wpb_revslider_element')."\n";
if (!isset($lt_yes_theme['opt-header-disable']) || $lt_yes_theme['opt-header-disable'] != 1 || (!is_front_page())) {
	if( !isset($lt_yes_theme['opt-header-position']) || $lt_yes_theme['opt-header-position'] == 'below-hero' || $lt_yes_theme['opt-header-position'] == 'below-hero-hidden') {
		ob_start();
   		get_template_part( 'includes/page-nav' );
   		$output .= ob_get_clean();   
	}
}
$output .= '<div id="menu-place"></div>';
echo $output;