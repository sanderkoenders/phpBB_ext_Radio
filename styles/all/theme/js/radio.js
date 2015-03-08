function getStreamInformation() {
    'use strict';

    $.get("app.php/api/radio", function(data) {
        $('#js_radio_station').html(data.serverTitle);
        $('#js_radio_song').html(data.songTitle);
        $('#js_radio_genre').html(data.serverGenre);
        $('#js_radio_bitrate').html(data.bitrate);
    });
}

$( document ).ready(function() {
    'use strict';

    // Get the initial information
    getStreamInformation();
    
    // Set a interval to get information every 10 sec
    setInterval(getStreamInformation, 10000);
});
