<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Underscores_Starter_Template
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'underscores-starter-template' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php the_custom_logo(); ?>

			<?php if ( is_front_page() && is_home() ) : ?>
				<!-- <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a> -->
				<h1 class="site-title">Home</h1>

			<?php elseif ( is_singular() ) : ?>
				<h1 class="page-title">
					<?php the_title(); ?>
				</h1>

			<?php elseif ( is_archive() ) : ?>
				<h1 class="archive-title">
					<?php the_archive_title(); ?>
				</h1>

			<?php elseif ( is_search() ) : ?>
				<h1 class="search-title">
					Search results for: <?php echo esc_html( get_search_query() ); ?>
				</h1>

			<?php elseif ( is_404() ) : ?>
				<h1 class="error-title">
					Page not found
				</h1>

			<?php else : ?>
				<h1 class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<?php bloginfo( 'name' ); ?>
					</a>
				</h1>
			<?php endif; ?>
			<button class="btn-primary">Contact Us</button>
			<?php
			$underscores_starter_template_description = get_bloginfo( 'description', 'display' );
			if ( $underscores_starter_template_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $underscores_starter_template_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->
		<hr class="divider">
	</header><!-- #masthead -->
