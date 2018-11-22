<?php
# @Author: Nicolas Fazio <webmaster-fazio>
# @Date:   08-11-2017
# @Email:  contact@nicolasfazio.ch
# @Last modified by:   webmaster-fazio
# @Last modified time: 08-11-2017

/**
 * Template part for displaying formations page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package NG_WP_STARTER
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php // ng_wp_starter_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<div class="block">
			<?php echo (get_post_meta($post->ID, 'content_block_formation_1', true));?>
		</div>
		<div class="block">
			<?php echo (get_post_meta($post->ID, 'content_block_formation_2', true));?>
		</div>
		<div class="block">
			<?php echo (get_post_meta($post->ID, 'content_block_formation_3', true));?>
		</div>
		<div class="block">
			<?php echo (get_post_meta($post->ID, 'content_block_formation_4', true));?>
		</div>
		<?php // print_r(get_post_meta($post->ID));?>
		</div>
		<div class="dates">
			Prochaine dates: du <?php echo (get_post_meta($post->ID, 'date_formation_du', true));?> au <?php echo (get_post_meta($post->ID, 'date_formation_au', true));?>
		</div>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php //ng_wp_starter_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
