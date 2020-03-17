<?php get_header(); ?>

<?php
    $category = get_the_category();
    $categorySlug = $category[0]->slug;
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $args = array(
        'post_type' => 'post',
        'category_name' => $categorySlug,
        'paged' => $paged,
        'order'     => 'DSC',
        'numberposts' => -1,
    );

    $categoryposts = new WP_Query($args);
?>


<section class="category-content">
        <div class="category-content-container">  

        <p><?php echo 'Category: ' . $category[0]->name;?></p>

            <?php if( $categoryposts->have_posts() ) :
            //The WordPress Loop: loads post content 
                while($categoryposts->have_posts() ) :
                    $categoryposts -> the_post();?>
    
                    <?php the_content(); ?>

                    <h2><?php echo '&mdash; ';?>
                        <?php the_title(); ?>
                    </h2>

                    
                <!-- Loop ends -->
                <?php endwhile;?>
                <?php 
                qod_numbered_pagination();
                // the_posts_navigation();
                ?>
                <?php wp_reset_postdata();?>

            <?php else : ?>
                    <p>No posts found</p>
            <?php endif;?>

    </div>
</section>

    
<?php get_footer();?>