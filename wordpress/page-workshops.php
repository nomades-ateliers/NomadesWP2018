<?php
# @Author: Nicolas Fazio <webmaster-fazio>
# @Date:   08-11-2017
# @Email:  contact@nicolasfazio.ch
# @Last modified by:   webmaster-fazio
# @Last modified time: 09-11-2017

/**
* The template for displaying workshops pages
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package NG_WP_STARTER
*/

get_header();
?>
			<main id="main" class="site-main">
			<h1><?php the_title();?></h1>
			<p><?php the_content();?></p>
			<?php
			
				$terms = get_terms('parcours');
				// print_r($terms);
				if ( !empty( $terms ) && !is_wp_error( $terms ) ){
					echo "<div>";
					foreach ( $terms as $term ) {
					echo "<section><p>" . $term->name . "</p></section>";

					}
					echo "</div>";
				}
				// while ( have_posts() ) : the_post();
				// 	// get_template_part( 'template-parts/content', 'page' );
				// endwhile; // End of the loop.
				?>
			</main><!-- #main -->
<?php get_footer();
