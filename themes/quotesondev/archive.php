<?php
/* Template Name: Archive Page */
//this allows pages on wp admin dashboard to be assigned to this template
?>

<?php get_header(); ?>

<section class = "archive-content">
    <div class = "archive-content-container">
        <h2><?php the_title(); ?></h2>

        <?php 
            $args = array(
                        'post_type' => 'post',
                            'order' => 'ASC',
                          'orderby' => 'title',
                   'posts_per_page' => -1, //-1 specifies all posts
            );
            
            $quotes = new WP_Query( $args );?>
        <h3 class = "archive-headings">Quote Authors</h3>
            <div class="quote-authors-container">
                <?php if ( $quotes->have_posts() ) : ?>
                <?php while ( $quotes->have_posts() ) : $quotes->the_post(); ?>

                <a href="<?php the_permalink();?>">  <?php the_title();?>  </a>
            
                <?php endwhile; 
                      wp_reset_postdata(); 
                ?>

            </div>
                    

                <?php else : ?>
            
                    <h2>Nothing found!</h2>

                <?php endif; ?>
        <!--instead of get_sidebar, could use wp_list_categories & get_tags 
        following example on https://developer.wordpress.org/reference/functions/get_tags/-->
        <?php get_sidebar('archive');?>
    
    </div>
</section>

<?php get_footer();?>