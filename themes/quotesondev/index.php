<?php get_header();?>
    

    <?php
        $args = array( 
            'post_type' => 'post', 
            'order' => 'ASC',
            'orderby' => 'rand',
            'numberposts' => 1
            );
        $quote_post = get_posts( $args ); 
    ?> <!-- returns an array of posts-->


    <?php foreach ($quote_post as $post): setup_postdata( $post );
    ?>

        <h1 class="the-quote">
            <?php echo $post -> post_content;?>
        </h1>

        <p class="the-author">
            <?php echo $post -> post_title;?>
        </p>


    <button class = "randomQuote">CLICK ME</button>

    <?php endforeach;?>

<?php get_footer();?>

