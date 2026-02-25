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
            
            <h1><?php echo esc_html( get_the_title() ); ?></h1>

            <?php
            if ( isset( $_GET['contact'] ) && $_GET['contact'] === 'success' ) {
                echo '<p class="contact-success">Message sent successfully!</p>';
            }

            if ( isset( $_GET['contact'] ) && $_GET['contact'] === 'error' ) {
                echo '<p class="contact-error">Something went wrong. Please try again.</p>';
            }
            ?>

            <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">

                <p>
                    <label for="name">Your Name</label><br>
                    <input type="text" name="name" id="name" required aria-required="true">
                </p>

                <p>
                    <label for="email">Email</label><br>
                    <input type="email" name="email" id="email" required aria-required="true">
                </p>

                <p>
                    <label for="message">Message</label><br>
                    <textarea name="message" id="message" rows="5" required aria-required="true"></textarea>
                </p>

                <?php wp_nonce_field( 'wp_movie_contact_action', 'wp_movie_nonce' ); ?>
                <input type="hidden" name="action" value="wp_movie_contact">

                <p>
                    <button type="submit">Send</button>
                </p>

            </form>

        </section>

    <?php
    endwhile;
    ?>
</main>

<?php
get_sidebar();
get_footer();