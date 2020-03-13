(function ($) {
    console.log(" redvars:" + red_vars);

    $(function () {

        $('.random-quote').on('click', function (e) {
            console.log(`this is the rest_url property: ${red_vars.rest_url}`);
            e.preventDefault();
            $.ajax({
                method: 'GET',
                url:
                    red_vars.rest_url +
                    'wp/v2/posts?filter[orderby]=rand&filter[post_per_page]=1'
            }).done(function (data) {
                console.log(data); //one way to display data;

                data.forEach(quote => { //quote is the key we created for each data array element
                    console.log(quote);
                    console.log('title:' + quote.title.rendered);

                    console.log($(".the-author"));
                    $(".the-author")[0].innerHTML = quote.title.rendered;
                    $(".the-quote")[0].innerHTML = quote.content.rendered;
                });
            });

        });


        //$('.submitQuote).on('click), function(e){

    });

})(jQuery);