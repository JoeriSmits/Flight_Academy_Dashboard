/**
 * Created by Gebruiker on 28/06/2015.
 */

function loadTeamspeakData(siteURL) {
    $.ajax({
        url: siteURL + '/teamspeak/getTeamspeakData'
    }).success(function (data) {
        if(data.status === 'offline') {
            $('#teamspeakOffline').removeClass('hidden');
        } else {
            $('#teamspeakViewer').html(data.viewer);
        }
    }).error(function (error) {
        console.log(error);
    })
}
