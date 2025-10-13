<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Underscores_Starter_Template
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area site-sidebar">

	<!-- Custom Sidebar Layout (Figma-style) -->
	<div class="sidebar-top">

		<!-- Logo -->
		<div class="site-logo">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<span class="logo-icon">🎬</span> WP<span class="highlight">Movies</span>
			</a>
		</div>

		<!-- Search Widget -->
		<div class="sidebar-search">
    		<?php get_search_form(); ?>
		</div>

		<!-- Navigation Menu -->
		<nav class="main-navigation">
			<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1', // registreras i functions.php
					'menu_class'     => 'sidebar-menu',
					'container'      => false,
				) );
			?>
		</nav>

		<!-- Genres (dynamisk från taxonomi) -->
		<div class="sidebar-genres">
			<div class="genres-title-container">
				<h3 class="genres-title"><?php esc_html_e( 'Genres', 'wp-movie-website' ); ?></h3>
				<div class="divider"></div>
			</div>
			<ul>
				<?php
				$genres = get_terms( array(
					'taxonomy'   => 'genre',
					'orderby'    => 'name',
					'order'      => 'ASC',
					'hide_empty' => false,
				) );

				if ( ! empty( $genres ) && ! is_wp_error( $genres ) ) :
					foreach ( $genres as $genre ) :
				?>
						<li>
							<a href="<?php echo esc_url( get_term_link( $genre ) ); ?>">
								<?php echo esc_html( $genre->name ); ?>
							</a>
						</li>
				<?php
					endforeach;
				endif;
				?>
			</ul>
		</div><!-- .sidebar-genres -->

	</div><!-- .sidebar-top -->

	<!-- Original Underscores Widget Area -->
	<!-- <?php dynamic_sidebar( 'sidebar-1' ); ?> -->

</aside><!-- #secondary -->
