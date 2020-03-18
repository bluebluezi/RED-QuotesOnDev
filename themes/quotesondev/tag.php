<?php get_header(); ?>

<?php
    // $tag = get_tag();

    $tag = $wp_query->query["tag"];
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $args = array(
        'post_type' => 'post',
        'tag' => $tag,
        'paged' => $paged,
        'order'     => 'ASC',
        'numberposts' => -1,
    );

    $tagPosts = new WP_Query($args);
?>

<section class="tag-content">
    <div class ="tag-content-container">
        <p><?php echo 'Tag: ' . $tag;?></p>
        
        <?php 
            if( $tagPosts->have_posts() ) :
            while($tagPosts->have_posts() ) :
            $tagPosts -> the_post();
        ?>

                <h2>
                    <?php echo $post -> post_content;?>
                </h2>
                <p>
                    &mdash; <?php echo $post -> post_title;?>
                    
                        <!-- conditional rendernig related to existence of quote source and/or its url-->
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

            <?php endwhile;?>

            <?php qod_numbered_pagination();?>
            <?php wp_reset_postdata();?>

        <?php else : ?>
                <p>No posts found</p>
        <?php endif;?>

    </div>
</section>

    
<?php get_footer();?>