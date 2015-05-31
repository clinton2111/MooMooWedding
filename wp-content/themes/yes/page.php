<?php 
/**
* Default Template for displaying Pages
*/
get_header(); ?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        
        <?php if(!is_front_page()) { 
            get_template_part( 'includes/page-title' );
        ?>
        <section <?php post_class("page-content no-image") ?> id="post-<?php the_ID(); ?>">
            <?php // Page Content ?>
            <div class="container">
                <div class="row">
                    <div class="twelve">
                        <?php the_content(); ?>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </section>

        <?php } else {
            // If its home, just echo content
            the_content();
            } 
        ?>

    <?php endwhile; endif; ?>

<?php get_footer(); ?>
