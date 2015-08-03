/**
 * Created by Gebruiker on 27/06/2015.
 */

$("#frm_getNOTAM").on('submit', function (e) {
    e.preventDefault();

    $('.spinner').removeClass('hidden');
    $("#notamNotFound").addClass('hidden');
    $('#notams').empty();

    var url = $(this).attr('action');
    var method = $(this).attr('method');
    var data = $(this).serialize();
    $.ajax({
        url: url,
        type: method,
        data: data
    }).success(function (data) {
        var notamSelector = $("#notams");
        var notams = "";
        if(data.error === undefined) {
            for (var i = 0; i < data.length; i = i + 1) {
                var message = data[i].message;
                message = message.replace(/(?:\r\n|\r|\n)/g, '<br />');
                var raw = data[i].raw;
                raw = raw.replace(/(?:\r\n|\r|\n)/g, '<br />');

                var typePanel = "warning";
                if (raw.indexOf('/NBO') > -1 || raw.indexOf('/NB') > -1) {
                    typePanel = "danger";
                }

                notams +=
                    "<div class='row'>" +
                    "<div class='col-md-12'>" +
                    "<div class='panel panel-" + typePanel + "'>" +
                    "<div class='panel-heading'>" +
                    message +
                    "</div>" +
                    "<div class='panel-body'>" +
                    raw +
                    "</div>" +
                    "</div>" +
                    "</div>" +
                    "</div>";
            }
            notamSelector.html(notams);
        } else {
            $("#notamNotFound").removeClass('hidden');
        }
        $('.spinner').addClass('hidden');
    }).error(function (error) {
        alert("Oh no, unfortunately the NOTAM information cannot been gathered. Please contact the webmaster at wm@flight-academy.nl with this message:" +  JSON.stringify(error));
    })
});