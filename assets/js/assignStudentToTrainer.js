/**
 * Created by Gebruiker on 02/08/2015.
 */

$('#frm_assignStudent').submit(function (e) {
    e.preventDefault();

    var url = $(this).attr('action');
    var method = $(this).attr('method');
    var data = $(this).serialize();
    $.ajax({
        url: url,
        type: method,
        data: data
    }).success(function (data) {
        console.log(data);
        if(data.error) {
            $('#errorAlert').removeClass('hidden').html(data.message);
        }
        if(data.success) {
            $('#notAssigned').addClass('hidden');
            $('#assignedText').removeClass('hidden');
        }
    }).error(function (error) {
        alert("Oh no, unfortunately something went wrong. Please contact the webmaster at wm@flight-academy.nl with this message:" +  JSON.stringify(error));
    });
});