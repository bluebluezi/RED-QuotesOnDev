<?php get_header(); ?>
<section class = "not-found">
    <div class = "not-found-content-container">

        <h2>Oops</h2>
        <p>It looks like nothing was found at this location. Maybe try a search?</p>
        <div class="search-container">
           <?php get_search_form();?>
        </div>
    </div>
</section>
<?php get_footer();?>