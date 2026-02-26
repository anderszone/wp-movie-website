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
            if ( isset( $_GET['form_status'] ) && $_GET['form_status'] === 'success' ) {
                echo '<p class="contact-success">Message sent successfully!</p>';
            }

            if ( isset( $_GET['form_status'] ) && $_GET['form_status'] === 'error' ) {
                echo '<p class="contact-error">Something went wrong. Please try again.</p>';
            }
            ?>

            <?php
            $name_value = '';
            $email_value = '';
            $message_value = '';

            if ( isset( $_SESSION['contact_form'] ) ) {
                $name_value    = esc_attr( $_SESSION['contact_form']['name'] ?? '' );
                $email_value   = esc_attr( $_SESSION['contact_form']['email'] ?? '' );
                $message_value = esc_textarea( $_SESSION['contact_form']['message'] ?? '' );

                unset( $_SESSION['contact_form'] ); // Clear after use
            }
            ?>

            <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" novalidate>

                <p>
                    <label for="name">Your Name</label><br>
                    <input type="text" name="name" id="name" value="<?php echo $name_value; ?>" required aria-required="true">
                </p>

                <p>
                    <label for="email">Email</label><br>
                    <input type="email" name="email" id="email" value="<?php echo $email_value; ?>" required aria-required="true">
                </p>

                <p>
                    <label for="message">Message</label><br>
                    <textarea name="message" id="message" rows="5" required aria-required="true"><?php echo $message_value; ?></textarea>
                </p>

                <?php wp_nonce_field( 'wp_movie_contact_action', 'wp_movie_nonce' ); ?>
                <input type="hidden" name="action" value="wp_movie_contact">

                <p>
                    <button type="submit" class="btn-primary">Send</button>
                    <!-- <button type="submit">Send</button> -->
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