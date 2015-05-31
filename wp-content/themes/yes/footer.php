<?php global $lt_yes_theme; ?>
    <!-- Footer Section -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="column four copyright">
                <?php if(isset($lt_yes_theme['opt-footer']) && $lt_yes_theme['opt-footer'] != '' ) {
                    echo wp_kses(
                        $lt_yes_theme['opt-footer'],
                        array(
                            'a' => array(
                                'href' => array(),
                                'title' => array()
                            ),
                            'br' => array(),
                            'em' => array(),
                            'strong' => array(),
                        )
                        ); 
                } else { ?>
                    Copyright LogicaThemes <?php echo date('Y'); ?>. All Rights Reserved.
                <?php } ?>
                </div>
                <div class="column four logo">
                <?php if(isset($lt_yes_theme['his-name']) && $lt_yes_theme['his-name'] != '' ) {
                    echo esc_attr($lt_yes_theme['his-name']); 
                } ?>
                    <span>&</span>
                <?php if(isset($lt_yes_theme['her-name']) && $lt_yes_theme['her-name'] != '' ) {
                    echo esc_attr($lt_yes_theme['her-name']); 
                } ?>
                </div>
                <?php if(isset($lt_yes_theme['opt-footer-right']) && $lt_yes_theme['opt-footer-right'] != '' ) {
                    echo '<div class="column four info">'. wp_kses($lt_yes_theme['opt-footer-right'],array('a' => array('href' => array(),'title' => array()),'br' => array(),'em' => array(),'strong' => array())) .'</div>'; 
                } ?>
            </div>
        </div>
    </footer>
	<?php wp_footer(); ?>
</body>
</html>
