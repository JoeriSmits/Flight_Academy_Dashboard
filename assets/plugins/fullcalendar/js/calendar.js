/**
 * Created by Gebruiker on 20/07/2015.
 */
$(document).ready(function() {
    $('#calendar').fullCalendar({
        googleCalendarApiKey: 'AIzaSyCu5qG27oaD4sgvQX1hypKtjMorqBIOjB8',
        events: {
            googleCalendarId: 'o6fohog3lckmjpdbaccq0p8vm0@group.calendar.google.com'
        },
        contentHeight: 400,
        timezone: 'UTC',
        firstDay: 1,
        eventColor: '#4765a0',
        eventTextColor: '#fff',

        eventClick: function (calEvent) {
            $(this).css('background-color', '#567AC2');

            if (calEvent.url) {
                window.open(calEvent.url, '_blank');
                return false;
            }
        }
    });
});