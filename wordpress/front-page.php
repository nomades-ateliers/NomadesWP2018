<?php
# @Author: Nicolas Fazio <webmaster-fazio>
# @Date:   09-11-2017
# @Email:  contact@nicolasfazio.ch
# @Last modified by:   webmaster-fazio
# @Last modified time: 09-11-2017

/**
 * WordPress FrontPage entry point
 */

 get_header();
// custom wp query
// $the_query = new WP_Query( array( 'post_type' => 'formation' ) );
 ?>

      <main id="main" class="site-main" role="main">
			<?php
				the_content();
				$terms = get_terms('cursus');
				if ( !empty( $terms ) && !is_wp_error( $terms ) ){
					echo "<ul>";
					foreach ( $terms as $term ) {
					echo "<li>" . $term->name . "</li>";

					}
					echo "</ul>";
				}	  
			?>
      </main><!-- #main -->
<?php 
// reset wp query with custom args
wp_reset_postdata();
get_footer();?>
