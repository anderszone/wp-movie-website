<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Underscores_Starter_Template
 */

// Fix for Intelephense undefined function warning
if (!function_exists('wp_movies_get_from_db')) {
    /**
     * Dummy function definition for Intelephense only.
     * @return array
     */
    function wp_movies_get_from_db($type = 'movie', $limit = 8, $random = true) {
        return [];
    }
}

get_header();
?>
	<main id="primary" class="site-main">
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// Visa endast på startsidan
			if ( is_front_page() ) :
		?>
				<section class="tmdb-movies">
				<?php
				$movies = wp_movies_get_from_db('movie', 8, true);
				error_log('Movies shown on page load: ' . count($movies));

				if ( $movies ) {
					echo '<h2 class="wp-block-heading" data-icon="movies">Movies</h2>';
					echo '<div class="tmdb-grid">';
					foreach ( $movies as $movie ) {
						echo '<div class="tmdb-item">';
						echo '<a href="https://www.themoviedb.org/movie/' . esc_attr( $movie->tmdb_id ) . '" target="_blank">';
						// echo '<img src="https://image.tmdb.org/t/p/w500' . esc_attr( $movie->poster ) . '" alt="' . esc_attr( $movie->title ) . '">';
						echo '<img src="https://image.tmdb.org/t/p/w500' . esc_attr( $movie->poster ) . '" alt="Movie poster for ' . esc_attr( $movie->title ) . ', released in ' . esc_attr( date('Y', strtotime($movie->release_date)) ) . '">';
						echo '<h3>' . esc_html( $movie->title ) . '</h3>';
						echo '</a></div>';
					}
					echo '</div>';
				} else {
					error_log('⚠️ No movies found in database at ' . date('Y-m-d H:i:s'));
				}
				?>
				</section>

				<section class="tmdb-tvshows">
				<?php
				$tvshows = wp_movies_get_from_db('tv', 8, true);
				error_log('TV shows shown on page load: ' . count($tvshows));

				if ( $tvshows ) {
					echo '<h2 class="wp-block-heading" data-icon="tv">TV Shows</h2>';
					echo '<div class="tmdb-grid">';
					foreach ( $tvshows as $tv ) {
						echo '<div class="tmdb-item">';
						echo '<a href="https://www.themoviedb.org/tv/' . esc_attr( $tv->tmdb_id ) . '" target="_blank">';
						// echo '<img src="https://image.tmdb.org/t/p/w500' . esc_attr( $tv->poster ) . '" alt="' . esc_attr( $tv->title ) . '">';'
						echo '<img src="https://image.tmdb.org/t/p/w500' . esc_attr( $tv->poster ) . '" alt="TV show poster for ' . esc_attr( $tv->title ) . ', released in ' . esc_attr( date('Y', strtotime($tv->release_date)) ) . '">';
						echo '<h3>' . esc_html( $tv->title ) . '</h3>';
						echo '</a></div>';
					}
					echo '</div>';
				} else {
					error_log('⚠️ No TV shows found in database at ' . date('Y-m-d H:i:s'));
				}
				?>
				</section>
    		<?php endif;

			// Visa innehåll endast på sidan "movies"
			if ( is_page('movies') ) :
			?>
				<section class="tmdb-movies">
					<h2 class="wp-block-heading" data-icon="movies">Movies</h2>
					<?php
					// Hämta 16 filmer från databasen
					$movies = wp_movies_get_from_db('movie', 16, true);

					if ( $movies ) {
						echo '<div class="tmdb-grid">';
						foreach ( $movies as $movie ) {
							echo '<div class="tmdb-item">';
							echo '<a href="https://www.themoviedb.org/movie/' . esc_attr( $movie->tmdb_id ) . '" target="_blank">';
							// echo '<img src="https://image.tmdb.org/t/p/w500' . esc_attr( $movie->poster ) . '" alt="' . esc_attr( $movie->title ) . '">';
							echo '<img src="https://image.tmdb.org/t/p/w500' . esc_attr( $movie->poster ) . '" alt="Movie poster for ' . esc_attr( $movie->title ) . ', released in ' . esc_attr( date('Y', strtotime($movie->release_date)) ) . '">';
							echo '<h3>' . esc_html( $movie->title ) . '</h3>';
							echo '<h3>' . esc_html( date('Y', strtotime($movie->release_date)) ) . '</h3>';
							echo '</a></div>';
						}
						echo '</div>';
					} else {
						echo '<p>No movies found right now. Please check back later!</p>';
					}
					?>
				</section>
			<?php endif;

			// Visa innehåll endast på sidan "TV Shows"
			if ( is_page('tv') || is_page('tv-shows') ) :
			?>
				<section class="tmdb-movies">
					<h2 class="wp-block-heading" data-icon="tv">TV Shows</h2>
					<?php
					// Hämta 16 TV serier från databasen
					$tvshows = wp_movies_get_from_db('tv', 16, true);
					error_log('TV shows shown on page load: ' . count($tvshows));

					if ( $tvshows ) {
						echo '<div class="tmdb-grid">';
						foreach ( $tvshows as $tv ) {
							echo '<div class="tmdb-item">';
							echo '<a href="https://www.themoviedb.org/tv/' . esc_attr( $tv->tmdb_id ) . '" target="_blank">';
							// echo '<img src="https://image.tmdb.org/t/p/w500' . esc_attr( $tv->poster ) . '" alt="' . esc_attr( $tv->title ) . '">';
							echo '<img src="https://image.tmdb.org/t/p/w500' . esc_attr( $tv->poster ) . '" alt="TV show poster for ' . esc_attr( $tv->title ) . ', released in ' . esc_attr( date('Y', strtotime($tv->release_date)) ) . '">';
							echo '<h3>' . esc_html( $tv->title ) . '</h3>';
							echo '<h3>' . esc_html( date('Y', strtotime($tv->release_date)) ) . '</h3>';
							echo '</a></div>';
						}
						echo '</div>';
					} else {
						echo '<p>No TV shows found right now. Please check back later!</p>';
					}
					?>
				</section>
			<?php endif;

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
