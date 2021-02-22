$('.ratings_stars').hover(
    // Handles the mouseover
    function() {
        $(this).prevAll().andSelf().addClass('ratings_over');
        $(this).nextAll().removeClass('ratings_vote');
    },
    // Handles the mouseout
    function() {
        $(this).prevAll().andSelf().removeClass('ratings_over');
        set_votes($(this).parent()); //0: div#r1.rate_widget context: div.star_2.ratings_stars
    }
);

$('.rate_widget').each(function(i) {
    var widget = this; //<div id="r1" class="rate_widget"> ... </div>
    var out_data = { //widget)id:r1, fetch:1
        widget_id : $(widget).attr('id'),
        fetch: 1
    };
    $.post(
        '/../../src/Controllers/RatingController.php',
        out_data,
        function(INFO) {
            $(widget).data( 'fsr', INFO );
            set_votes(widget);
        },
        'json'
    );
});

// $('#one_of_your_widgets').data('fsr').widget_id;

function set_votes(widget) {

    var avg = $(widget).data('fsr').whole_avg;
    var votes = $(widget).data('fsr').number_votes;
    var exact = $(widget).data('fsr').dec_avg;

    $(widget).find('.star_' + avg).prevAll().andSelf().addClass('ratings_vote');
    $(widget).find('.star_' + avg).nextAll().removeClass('ratings_vote');
    $(widget).find('.total_votes').text(votes + ' votes recorded');

    $('.casino__part_4').find('.total_rating').text(exact * 2);
}

$('.ratings_stars').bind('click', function() {
    var star = this; //div class=star_4..
    var widget = $(this).parent(); //0: div#r1.rate_widget, context: div.star_3.ratings_stars
    var clicked_data = {
        clicked_on : $(star).attr('class'),
        widget_id : widget.attr('id')
    };//{clicked_on: "star_4 ratings_stars ratings_over", widget_id: "r1"}

    $.post(
        '/../../src/Controllers/RatingController.php',
        clicked_data,
        function(INFO) {
            widget.data( 'fsr', INFO );
            console.log(widget.data('fsr'));
            set_votes(widget);
        },
        'json'
    );
});
