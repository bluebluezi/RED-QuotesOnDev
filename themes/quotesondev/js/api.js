(function ($) {
    // console.log(" redvars:" + red_vars);
    // let urlRaw = red_vars.rest_url;
    // console.log("Seperate")
    // console.log(urlRaw);
    // let urlAmended = urlRaw.replace('/wp-json/', '');
    // console.log(JSON.stringify());
    // history.replaceState(null, '', urlAmended);
    $(function () {

        $('.random-quote').on('click', function (e) {
            // console.log(red_vars);
            // console.log(`this is the rest_url property: ${red_vars.rest_url}`);
            e.preventDefault();
            $.ajax({

                method: 'GET',
                url:
                    red_vars.rest_url +
                    'wp/v2/posts?filter[orderby]=rand&filter[post_per_page]=1'

            })
                .done(function (data) {
                    // console.log(data); //one way to display data;
                    const authorText = $(".the-author")[0];
                    // console.log($(authorText));
                    $(authorText).empty();

                    data.forEach(quote => { //quote is the key we created for each data array element
                        // console.log(quote);
                        console.log('title:' + quote.title.rendered);
                        console.log('content: ' + quote.content.rendered);
                        console.log($(".the-quote"));

                        // console.log($(".the-author"));
                        authorText.innerHTML = '&mdash; ' + quote.title.rendered;
                        $(".the-quote")[0].innerHTML = quote.content.rendered;
                        console.log(quote._qod_quote_source);

                        if (quote._qod_quote_source && quote._qod_quote_source_url) {

                            $(".the-author").append(`, <a href = "${quote._qod_quote_source_url}">${quote._qod_quote_source}</a></span>`);
                        }
                        else if (quote._qod_quote_source) {
                            $(".the-author").append(`, ${quote._qod_quote_source}`);
                        }

                    });

                    const urlRaw = data[data.length - 1].link;
                    // console.log(urlRaw);
                    const urlAmended = urlRaw.replace('t:8888', 't:3000');
                    history.pushState(null, '', urlAmended); //History_API
                    // console.log("replaced");
                });

        });


        $('#submit-quote-button').on('click', function (e) {
            //catch all the inputted values in the form
            e.preventDefault();
            const $title = $('#input-author').val();
            const $quote = $('#input-quote').val();
            const $sourceName = $('#input-source-name').val();
            const $sourceUrl = $('#input-source-url').val();
            console.log($title);
            console.log($quote);
            console.log($sourceName);
            console.log($sourceUrl);

            $.ajax({
                method: 'POST',
                url: red_vars.rest_url + 'wp/v2/posts/',
                data: {
                    title: $title,
                    content: $quote,
                    _qod_quote_source: $sourceName,
                    _qod_quote_source_url: $sourceUrl,
                    status: 'pending'
                },
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('X-WP-Nonce', red_vars.wpapi_nonce);
                }
            })
                .done(function (response) {
                    $('#submit-quote-form').trigger("reset");
                    console.log("this is reponse")
                    console.log(response);

                    alert('Success! Your quote has been submitted.');
                })
                .fail(function () {
                    alert('Hmmm something went wrong...failed to submit.')
                })
        });

    });

})(jQuery);