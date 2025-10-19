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

get_header();
?>
	<main id="primary" class="site-main">
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// Visa endast på startsidan
			if ( is_front_page() ) :

				// === Movies & TV Shows Front-End AJAX Buttons ===
				?>
				<!-- <section class="tmdb-controls">
					<h2>Random Movies & TV Shows</h2>
					<button id="refresh-movies-frontend" class="button button-primary">🎬 Refresh Movies</button>
					<button id="refresh-tvshows-frontend" class="button button-secondary">📺 Refresh TV Shows</button>
				</section> -->

				<section class="tmdb-movies" id="movies-list">
				<?php
				$movies = wp_movies_get_from_db('movie', 8, true);
				error_log('Movies shown on page load: ' . count($movies));

				if ( $movies ) {
					echo '<h2 class="wp-block-heading" data-icon="movies">Movies</h2>';
					echo '<div class="tmdb-grid">';
					foreach ( $movies as $movie ) {
						echo '<div class="tmdb-item">';
						echo '<a href="https://www.themoviedb.org/movie/' . esc_attr( $movie->tmdb_id ) . '" target="_blank">';
						echo '<img src="https://image.tmdb.org/t/p/w500' . esc_attr( $movie->poster ) . '" alt="' . esc_attr( $movie->title ) . '">';
						echo '<h3>' . esc_html( $movie->title ) . '</h3>';
						echo '</a></div>';
					}
					echo '</div>';
				} else {
					error_log('⚠️ No movies found in database at ' . date('Y-m-d H:i:s'));
				}
				?>
				</section>

				<section class="tmdb-tvshows" id="tvshows-list">
				<?php
				$tvshows = wp_movies_get_from_db('tv', 8, true);
				error_log('TV shows shown on page load: ' . count($tvshows));

				if ( $tvshows ) {
					echo '<h2 class="wp-block-heading" data-icon="tv">TV Shows</h2>';
					echo '<div class="tmdb-grid">';
					foreach ( $tvshows as $tv ) {
						echo '<div class="tmdb-item">';
						echo '<a href="https://www.themoviedb.org/tv/' . esc_attr( $tv->tmdb_id ) . '" target="_blank">';
						echo '<img src="https://image.tmdb.org/t/p/w500' . esc_attr( $tv->poster ) . '" alt="' . esc_attr( $tv->title ) . '">';
						echo '<h3>' . esc_html( $tv->title ) . '</h3>';
						echo '</a></div>';
					}
					echo '</div>';
				} else {
					error_log('⚠️ No TV shows found in database at ' . date('Y-m-d H:i:s'));
				}
				?>
				</section>

				<script>
				function fetchAndRender(action, containerId) {
					const container = document.getElementById(containerId);
					container.innerHTML = '<em>Loading...</em>';
					fetch('<?php echo admin_url("admin-ajax.php"); ?>?action=' + action)
						.then(r => r.json())
						.then(d => {
							const items = Object.values(d.data)[0]; // movies eller tvshows
							container.innerHTML = '<div class="tmdb-grid">' +
								items.map(i => `<div class="tmdb-item">
									<a href="${action.includes('movies') ? 'https://www.themoviedb.org/movie/' : 'https://www.themoviedb.org/tv/'}${i.tmdb_id}" target="_blank">
										<img src="https://image.tmdb.org/t/p/w500${i.poster}" alt="${i.title}">
										<h3>${i.title}</h3>
									</a>
								</div>`).join('') +
								'</div>';
						});
				}

				document.getElementById('refresh-movies-frontend').addEventListener('click', function(){
					fetchAndRender('front_refresh_movies', 'movies-list');
				});

				document.getElementById('refresh-tvshows-frontend').addEventListener('click', function(){
					fetchAndRender('front_refresh_tvshows', 'tvshows-list');
				});
				</script>
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
