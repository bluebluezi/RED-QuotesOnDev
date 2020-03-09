(function ($) {
    console.log(red_vars);

    $(function () {

        $('.randomQuote').on('click', function (e) {
            $.ajax({
                method: 'GET',
                url:
                    red_vars.rest_url +
                    'wp/v2/posts?filter[orderby]=rand&filter[post_per_page]=10'
            }).done(function (data) {
                console.log(data);
            });

        });

    });

})(jQuery);