<?php get_header(); ?>

<section class="home-content">
    <div class="home-content-container">

<?php if( have_posts() ) :
    while( have_posts() ) : the_post();
?>
    
    <h2 class="the-quote">
        <?php echo $post -> post_content;?>
    </h2>
    <p class="the-author">

                &mdash; <?php echo $post -> post_title;?> <!--shows - AuthorName-->
                
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

    <?php endwhile;?>

<?php else : ?>

        <p>No posts found</p>
        
<?php endif;?>

    </div>
</section>

<?php get_footer();?>