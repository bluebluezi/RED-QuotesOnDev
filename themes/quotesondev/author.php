

<?php get_header(); ?>

<p>Random Quote submitted by: <?php echo get_the_author();?> </p>
<?php if( have_posts() ) :
//The WordPress Loop: loads post content 
    while( have_posts() ) :
        the_post(); ?>
    
    <h2><?php the_title(); ?></h2>
    <?php the_content(); ?>
    
    <!-- Loop ends -->
    <?php endwhile;?>

<?php else : ?>
        <p>No posts found</p>
<?php endif;?>

    
<?php get_footer();?>