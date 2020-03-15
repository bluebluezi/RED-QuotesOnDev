<?php get_header(); ?>
<section class = "search-results-content">
    <div class = search-results-content-container>
        <p>
            Search Results for:<br>
            <?php echo esc_html(get_search_query(false));?>
        </p>

        <?php if( have_posts() ) :

            while( have_posts() ) :
                the_post(); ?>
            
            <h2><a href="<?php esc_html_e(get_permalink());?>"><?php the_title(); ?></a></h2>

            <?php the_content(); ?>
            
            <?php endwhile;?>

            <?php qod_numbered_pagination();?> <!--uses included pagination template-->

        <?php else : ?>
                <p>No posts found</p>
        <?php endif;?>

    </div>
</section>


    
<?php get_footer();?>