<?php
/**
 * taxonomy-genre.php
 * Lista både filmer och tv-serier kopplade till ett valt genre (custom taxonomy: genre).
 */

get_header();

// Hämta aktuellt genre-objekt, slug och name
$genre_obj  = get_queried_object();
$genre_slug = $genre_obj->slug;
$genre_name = $genre_obj->name;

// Hämta filmer och tv-serier baserat på genre
$movies = wp_movies_get_by_genre_smart( $genre_slug, 'movie');
$tv_shows = wp_movies_get_by_genre_smart( $genre_slug, 'tv');
?>

<main id="primary" class="site-main">
    <section class="tmdb-movies">
        <?php
        if ( $movies ) {
            echo '<h2 class="wp-block-heading" data-icon="movies">Movies in "' . esc_html( $genre_name ) . '"</h2>';
            echo '<div class="tmdb-grid">';
            foreach ( $movies as $movie ) {
                echo '<div class="tmdb-item">';
                echo '<a href="https://www.themoviedb.org/movie/' . esc_attr( $movie->tmdb_id ) . '" target="_blank">';
                // Poster with fallback image if missing
                if ( ! empty( $movie->poster ) ) {
                    echo '<img src="https://image.tmdb.org/t/p/w500' . esc_attr( $movie->poster ) . '" alt="' . esc_attr( $movie->title ) . '">';
                } else {
                    echo '<img src="https://via.placeholder.com/500x750?text=No+Image" alt="No image">';
                }
                echo '<h3>' . esc_html( $movie->title ) . '</h3>';
                echo '<h3>' . esc_html( date('Y', strtotime($movie->release_date)) ) . '</h3>';
                echo '</a></div>';
            }
            echo '</div>';
        } else {
            echo '<p>No movies found in this genre.</p>';
        }
        ?>
    </section>

    <section class="tmdb-tvshows">
    <?php
    if ( $tv_shows ) {
        echo '<h2 class="wp-block-heading" data-icon="tv">TV Shows in "' . esc_html( $genre_name ) . '"</h2>';
        echo '<div class="tmdb-grid">';
        foreach ( $tv_shows as $tv ) {
            echo '<div class="tmdb-item">';
            echo '<a href="https://www.themoviedb.org/tv/' . esc_attr( $tv->tmdb_id ) . '" target="_blank">';
            // Poster med fallback
            if ( ! empty( $tv->poster ) ) {
                echo '<img src="https://image.tmdb.org/t/p/w500' . esc_attr( $tv->poster ) . '" alt="' . esc_attr( $tv->title ) . '">';
            } else {
                echo '<img src="https://via.placeholder.com/500x750?text=No+Image" alt="No image">';
            }
            echo '<h3>' . esc_html( $tv->title ) . '</h3>';
            echo '<h3>' . esc_html( date('Y', strtotime($tv->release_date)) ) . '</h3>';
            echo '</a></div>';
        }
        echo '</div>';
    } else {
        echo '<p>No TV shows found in this genre.</p>';
    }
    ?>
</section>

</main><!-- #main -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
