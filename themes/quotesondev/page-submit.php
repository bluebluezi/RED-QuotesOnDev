

<?php get_header(); ?>
    
<?php if ( is_user_logged_in() ):?>
    <section class = "submit">
    <div class = "submit-content-container">
        <h2><?php the_title();?></h2>

        <form> <!--maybe add action =/submit-result.php-->
            
            <label for="input-author">
                Author of Quote
            </label><br>
            <input type="text" id="input-author" name="author"><br>

            <label for="input-quote">
                Quote
            </label><br>
            <textarea id="input-quote" name="quote"></textarea><br>

            <label for="input-source-name">
                Where did you find this quote? (e.g. book name)
            </label><br>
            <input type="text" id="input-source-name" name="sourceName"><br>

            <label for="input-source-url">
                Provide the URL of the quote source, if available.
            </label><br>
            <input type="text" id="input-source-url" name="sourceUrl"><br>

            <input type="submit" id ="submit-quote-button" value="Submit Quote">

        </form>

    </div>
    </section>

<?php else : ?>

    <section class = "submit">
    <div class = "submit-content-container">
        <h2><?php the_title();?></h2>
        <p>Sorry, you must be logged in to submit a quote!</p>
        <a href= "<?php echo esc_url( wp_login_url( get_permalink() ) ); ?>" 
            alt="<?php esc_attr_e( 'Login', 'textdomain' ); ?>">
            
        <?php _e( 'Click here to log in.', 'textdomain' ); ?>
        </a>
    </div>
    </section>

<?php get_footer();?>