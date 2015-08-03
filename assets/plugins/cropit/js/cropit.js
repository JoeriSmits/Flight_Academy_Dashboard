/**
 * Created by Gebruiker on 09/07/2015.
 */
$(function() {
    var $imageCropper = $('.image-editor');
    $imageCropper.cropit({
        exportZoom: 1
    });
    $imageCropper.cropit('imageSrc', '../assets/img/userAvatar/noUserFound.png');
});