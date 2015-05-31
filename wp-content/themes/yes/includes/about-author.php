<div id="user" class="pattern">
	<?php echo get_avatar( get_the_author_meta('user_email'), '150', '' ); ?>
	<div class="info">
		<span class="name"><?php the_author_link(); ?></span> <?php esc_attr(the_author_meta('description')); ?>
		<span class="social">
			<?php if( get_the_author_meta('facebook') != '') { ?>
			<a target="_blank" href="<?php esc_url(the_author_meta('facebook')); ?>"><i class="fa fa-facebook"></i></a>
			<?php } ?>
			<?php if( get_the_author_meta('twitter') != '') { ?>
			<a target="_blank" href="<?php esc_url(the_author_meta('twitter')); ?>"><i class="fa fa-twitter"></i></a>
			<?php } ?>
			<?php if( get_the_author_meta('linkedin') != '') { ?>
			<a target="_blank" href="<?php esc_url(the_author_meta('linkedin')); ?>"><i class="fa fa-linkedin"></i></a>
			<?php } ?>
			<?php if( get_the_author_meta('google') != '') { ?>
			<a target="_blank" href="<?php esc_url(the_author_meta('google')); ?>"><i class="fa fa-googleplus"></i></a>
			<?php } ?>
			<?php if( get_the_author_meta('pinterest') != '') { ?>
			<a target="_blank" href="<?php esc_url(the_author_meta('pinterest')); ?>"><i class="fa fa-pinterest"></i></a>
			<?php } ?>
			<?php if( get_the_author_meta('instagram') != '') { ?>
			<a target="_blank" href="<?php esc_url(the_author_meta('instagram')); ?>"><i class="fa fa-instagram"></i></a>
			<?php } ?>
			<?php if( get_the_author_meta('dribbble') != '') { ?>
			<a target="_blank" href="<?php esc_url(the_author_meta('dribbble')); ?>"><i class="fa fa-dribbble"></i></a>
			<?php } ?>
		</span>
		<div class="clearfix"></div>
	</div>
</div>