<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Underscores_Starter_Template
 */

?>
	<footer id="colophon" class="site-footer">
		<hr class="divider">
		<div class="site-info">
			<?php
			printf(
				/* translators: 1: Theme name, 2: Author link, 3: Year */
				esc_html__( '%1$s | Theme by %2$s | © %3$s All rights reserved.', 'wp-movie-website' ),
				'WP Movies',
				'<a href="https://wpwebguide.com">Anders Johansson</a>',
				date('Y')
			);
			?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
