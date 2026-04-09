<?php
/**
 * Template Name: Contact
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php
    while ( have_posts() ) :
        the_post();
    ?>

        <section class="contact-section">

            <?php echo do_shortcode('[wp_movies_contact_form]'); ?>

        </section>

    <?php
    endwhile;
    ?>
</main>

<?php
get_sidebar();
get_footer();
