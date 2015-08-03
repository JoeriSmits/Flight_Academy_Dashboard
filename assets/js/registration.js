$(document).ready(function () {
    $('#frm_updateProfile').submit(function (e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var method = $(this).attr('method');
        var data = $(this).serialize();

        console.log(data);
        $.ajax({
            url: url,
            type: method,
            data: data
        }).success(function (data) {
            if(data.error) {
                $('#errorAlert').removeClass('hidden').html(data.message);
            }
            if(data.success) {
                $('#errorAlert').addClass('hidden');
                window.location = data.message;
            }
        }).error(function (error) {
            alert("Oh no, unfortunately something went wrong. Please contact the webmaster at wm@flight-academy.nl with this message:" +  JSON.stringify(error));
        });
    });

    $('#frm_uploadAvatar').submit(function (e) {
        e.preventDefault();

        var imageData = $('.image-editor').cropit('export');

        var url = $(this).attr('action');
        var method = $(this).attr('method');
        var data = 'avatar=' + imageData;
        $.ajax({
            url: url,
            type: method,
            data: data
        }).success(function (data) {
            if(data.error) {
                $('#errorAlert').removeClass('hidden').html(data.message);
            }
            if(data.success) {
                $('#errorAlert').addClass('hidden');
                window.location = data.message;
            }
        }).error(function (error) {
            alert("Oh no, unfortunately something went wrong. Please contact the webmaster at wm@flight-academy.nl with this message:" +  JSON.stringify(error));
        });
    });

    var coupon;

    $('#frm_Coupon').submit(function (e) {
        e.preventDefault();
        $('#useCouponBtn').addClass('disabled');
        $('.amount').removeClass('animated bounceIn');

        var url = $(this).attr('action');
        var method = $(this).attr('method');
        var post = $(this).serialize();
        $.ajax({
            url: url,
            type: method,
            data: post
        }).success(function (data) {
            if(data.error) {
                $('#errorAlert').removeClass('hidden').html(data.message);
                $('#useCouponBtn').removeClass('disabled');
                $('#couponCode').addClass('couponInCorrect');
            }
            if(data.success) {
                coupon = post.split('=')[1];
                var couponCode = $('#couponCode');

                $('#errorAlert').addClass('hidden');
                $('#useCouponBtn').removeClass('disabled');
                couponCode.addClass('couponCorrect');
                couponCode.removeClass('couponInCorrect');

                $('.amount').addClass('animated bounceIn').html('&euro;' + (16.50 - data.message).toFixed(2) + '*');
            }
        }).error(function (error) {
            $('#useCouponBtn').removeClass('disabled');
            $('#couponCode').removeClass('couponInCorrect');
            alert("Oh no, unfortunately something went wrong. Please contact the webmaster at wm@flight-academy.nl with this message:" +  JSON.stringify(error));
        });
    });

    $('#frm_PayPal').submit(function (e) {
        e.preventDefault();
        $('#payPalBtn').addClass('disabled').html('Loading <i class="fa fa-circle-o-notch fa-spin"></i>');
        window.location = $(this).attr('action') + '/index/' + coupon;
    });

    $('#frn_BankTransfer').submit(function (e) {
        e.preventDefault();

        $('#bankTransferBtn').addClass('disabled');

        var url = $(this).attr('action') + "/" + coupon;
        var method = $(this).attr('method');
        var post = $(this).serialize();
        $.ajax({
            url: url,
            type: method,
            data: post
        }).success(function (data) {
            if(data.success) {
                $('#bankTransferBtn').html('<i class="fa fa-check"></i> Bank transfer requested').addClass('disabled');
            }
        }).error(function (error) {
            alert("Oh no, unfortunately something went wrong. Please contact the webmaster at wm@flight-academy.nl with this message:" +  JSON.stringify(error));
        })
    })
});