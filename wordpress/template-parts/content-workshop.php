<?php
# @Author: Nicolas Fazio <webmaster-fazio>
# @Date:   08-11-2017
# @Email:  contact@nicolasfazio.ch
# @Last modified by:   webmaster-fazio
# @Last modified time: 08-11-2017

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package NG_WP_STARTER
 */

?>
<!-- Theme: template-parts/content-workshop.php -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
	 ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<!-- contenu_workshop -->
		<h2>Contenu</h2>
		<?php		
			echo get_post_meta($post->ID, 'contenu_workshop', true);
		?>
		<!-- public_workshop -->
		<h2>Public</h2>
		<?php
			echo get_post_meta($post->ID, 'public_workshop', true);
		?>
		<!-- programme_workshop -->
		<h2>Programme</h2>
		<?php
			echo get_post_meta($post->ID, 'programme_workshop', true);
		?>
		<!-- next session -->
		<h2>Prochaines dates</h2>
		<?php
			echo '<p>du '.get_post_meta($post->ID, 'date_session_1_du', true).' au '.get_post_meta($post->ID, 'date_session_1_au', true).'</p>';
		?>	
		<!-- ecolage_wk -->
		<h2>Écolage</h2>
		<?php
			echo '<p>CHF '.get_post_meta($post->ID, 'ecolage_wk', true).'.-</p>';
		?>		
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php //ng_wp_starter_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->