<?php
# @Author: Nicolas Fazio <webmaster-fazio>
# @Date:   08-11-2017
# @Email:  contact@nicolasfazio.ch
# @Last modified by:   webmaster-fazio
# @Last modified time: 14-11-2017

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NG_WP_STARTER
 */

?>

			<footer id="colophon" class="site-footer">
				<div class="site-info">
					<a href="https://nomades.ch">2018 - https://nomades.ch</a>
				</div><!-- .site-info -->
			</footer><!-- footer#colophon -->
		</div><!-- .server_reading -->
	</app-root>
	<?php wp_footer();?>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-1217843-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-1217843-1');
	</script>
</body>
</html>
