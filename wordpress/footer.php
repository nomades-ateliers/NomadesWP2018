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
  <!-- Simple pop-up dialog box -->
  <!-- <button id="openBtn">open</button> -->
  <dialog id="dialog">
		<style>
			dialog img#go {
				max-width: 400px;
				display: block;
				margin: 2rem auto;
				cursor: pointer;
			}
		</style>
		<h1>nomades e-learning</h1>
		<img id="go" src="./images/Cafetiere_tasses-only.png">
		<p>
			Les formations nomades.ateliers certifiantes ainsi que les workshops<br/> 
			peuvent être suivis dorenavant d'une manière interactive</br> 
			sur notre platforme Moodle
		</p>
		<p>
			Cliquez sur la cafetière
		</p>
  </dialog>
  <script>
    function displayModal() {
      // var openBtn = document.getElementById('openBtn');
      var cancelButton = document.getElementById('cancel');
      var goButton = document.getElementById('go');
			var dialog = document.querySelector('dialog');
			
      // openBtn.addEventListener('click', function() {
				// open modal
        dialog.showModal();
      // });
      dialog.addEventListener('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
        dialog.close();
      });
      goButton.addEventListener('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				dialog.close();
				window.open('https://nomades-ateliers.onschool.ch', '_blank');
      });
		};
		// auto display modal
		document.onreadystatechange = () => {
			if (document.readyState === 'complete') {
				// document ready
				setTimeout(() => {
					displayModal();
				}, 1000);
			}
		};
	</script>
	<!-- default wp footer -->
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
