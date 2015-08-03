/**
 * Created by Gebruiker on 27/06/2015.
 */

$(document).ready(function (){
    $("#frm_getWeather").on('submit', function (e) {
        e.preventDefault();

        $('#getWeather').addClass('disabled');
        $('#METAR').empty();
        $('#TAF').empty();
        $('#DECODED').empty();
        $('.noAirport').addClass('hidden');
        $('.spinner').removeClass('hidden');
        $('#metarNotFound').addClass('hidden');
        $('#tafNotFound').addClass('hidden');
        $('#decodedNotFound').addClass('hidden');

        var url = $(this).attr('action');
        var method = $(this).attr('method');
        var data = $(this).serialize();
        $.ajax({
            url: url,
            type: method,
            data: data
        }).success(function (data) {
            $('#getWeather').removeClass('disabled');
            $('.spinner').addClass('hidden');

            console.log(data);
            if(data.METAR !== false) {
                var METAR = data.METAR;
                METAR = METAR.replace(/(?:\r\n|\r|\n)/g, '<br />');
                $('#METAR').html(METAR);
            } else {
                $('#metarNotFound').removeClass('hidden');
            }
            if(data.TAF !== false) {
                var TAF = data.TAF;
                TAF = TAF.replace(/(?:\r\n|\r|\n)/g, '<br />');
                $('#TAF').html(TAF);
            } else {
                $('#tafNotFound').removeClass('hidden');
            }
            if(data.DECODED !== false) {
                var DECODED = data.DECODED;
                DECODED = DECODED.replace(/(?:\r\n|\r|\n)/g, '<br />');
                $('#DECODED').html(DECODED);
            } else {
                $('#decodedNotFound').removeClass('hidden');
            }
            if(data.Error === true) {
                $('#metarNotFound').removeClass('hidden');
                $('#tafNotFound').removeClass('hidden');
            }
        }).error(function (error) {
            alert("Oh no, unfortunately the weather information cannot been gathered. Please contact the webmaster at wm@flight-academy.nl with this message:" + JSON.stringify(error));
        });
    });

    $("#sigwx").on('change', function () {
        var val = $(this).val();
        var sigWxImage = $(".sigwxImg");
        switch (val) {
            case "Europe":
                sigWxImage.attr('src', "http://weather.noaa.gov/pub/fax/PGDE14.PNG");
                break;
            case "Europe & Asia":
                sigWxImage.attr('src', "http://weather.noaa.gov/pub/fax/PGCE05.PNG");
                break;
            case "Europe & Africa":
                sigWxImage.attr('src', "http://weather.noaa.gov/pub/fax/PGRE05.PNG");
                break;
            case "Europe & Eastern Atlantic":
                sigWxImage.attr('src', "http://weather.noaa.gov/pub/fax/PGSE05.PNG");
                break;
            case "Europe & Middle East":
                sigWxImage.attr('src', "http://weather.noaa.gov/pub/fax/PGZE05.PNG");
                break;
        }
    });
});