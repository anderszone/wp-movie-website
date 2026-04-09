<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Enqueue contact form validation script
 *
 * @return void
 */
/* function wp_movie_enqueue_contact_validation() {
    $pages_to_enqueue = array( 'page-contact.php' ); // Add more page templates if needed

    foreach ( $pages_to_enqueue as $template ) {
        if ( is_page_template( $template ) ) {
            wp_enqueue_script(
                'contact-validation',
                get_template_directory_uri() . '/js/contact-validation.js',
                array(), // Add dependencies like 'jquery' if needed
                '1.0',
                true
            );
        }
    }
}
add_action( 'wp_enqueue_scripts', 'wp_movie_enqueue_contact_validation' ); */
