<?php get_header();?>
    
    <?php
        $args = array( 
            'post_type'      => 'post', 
            'order'          => 'ASC',
            'orderby'        => 'rand',
            'numberposts' => 1
            );
        $quote_post = get_posts( $args ); 
    ?> <!-- returns an array of posts-->

     <section class="home-content">
        <div class="home-content-container">      
   
            <?php foreach ($quote_post as $post): setup_postdata( $post );?>

            <h1 class="the-quote">
                <?php echo $post -> post_content;?>
            </h1>
            <p class="the-author">
                &mdash; <?php echo $post -> post_title;?>
                <?php 
                
                    $fieldUrl = get_post_meta(get_the_ID(),'_qod_quote_source_url',true);
                    $fieldSource = get_post_meta(get_the_ID(),'_qod_quote_source',true);

                    if($fieldUrl && $fieldSource){ 
                        echo ", ";
                ;?>

                        <a href = "<?php echo $fieldUrl;?>">
                            <?php echo  $fieldSource;?>
                        </a>
                <?php
                    } elseif($fieldSource){
                        echo ", " . $fieldSource;
                    }
                ;?>
             
            </p>
            <button class = "random-quote">Show Me Another!</button>
            <?php endforeach; wp_reset_postdata();?>

        </div>
    </section>

    <?php wp_list_authors(); ?>
<?php get_footer();?>

