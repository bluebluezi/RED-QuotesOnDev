<?php get_header(); ?>

<?php if( have_posts() ) :?>

    <section class = "about-content">
        <div class = "about-content-container">
        
            <?php while( have_posts() ) : the_post(); ?>
            
                <h2><?php the_title(); ?></h2>

                <?php the_content(); ?>

            <?php endwhile;?>

<?php else : ?>

                <p>No posts found</p>

<?php endif;?>

        </div>
    </section>
    
<?php get_footer();?>