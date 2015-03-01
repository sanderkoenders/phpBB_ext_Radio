$( document ).ready(function() {
    // Get the initial information
    getStreamInformation();
    
    // Set a interval to get information every 10 sec
    setInterval(getStreamInformation, 10000);
});

function getStreamInformation() {
    $.get("/api/radio", function(data) {
        $('#js_radio_station').html(data.serverTitle);
        $('#js_radio_song').html(data.songTitle);
        $('#js_radio_genre').html(data.serverGenre);
        $('#js_radio_bitrate').html(data.bitrate);
    });
}