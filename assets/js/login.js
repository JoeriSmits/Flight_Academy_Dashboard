$(document).ready(function () {
    /**
     * Prevents the submit button to executes it's standard behaviour.
     * After the POST request is finished it will look for a JSON Object (Data).
     * After that it will look for the element 'success'. If it's false it will show a warning.
     * If it's true (else) it will redirect the user to the profile page.
     * The URL of the profile page is passed in the redirect element.
     */
    $("#frm_login").submit(function (e) {
        e.preventDefault();
        $('#login-container').removeClass('animated runShakeAnimation');
        var url = $(this).attr('action');
        var method = $(this).attr('method');
        var data = $(this).serialize();

        $.ajax({
            url: url,
            type: method,
            data: data
        }).success(function (data) {
            if (!data.success) {
                $('#login-container').addClass('animated runShakeAnimation');
                $('#errorAlertLogin').removeClass('hidden');
                $('#frm_login')[0].reset();
            } else {
                window.location.replace(data.redirect);
            }
        }).error(function (error) {
            alert("Whoops something went wrong. Please send this error to the Webmaster: " + error);
        });
    });

    var isLogin = true;

    /**
     * Switches to the signUp container
     */
    $("#signUpBtn").on('click', function () {
        var loginWrapper = $("#login-wrapper");

        loginWrapper.addClass('animated flipOutX');
        isLogin = true;
        loginWrapper.on('oanimationend animationend webkitAnimationEnd', function (e) {
            if(isLogin) {
                var signInWrapper = $("#signUp-wrapper");
                loginWrapper.addClass('hidden');
                signInWrapper.removeClass('hidden').removeClass('animated flipOutX').addClass('animated flipInX');
            }
        });
    });

    /**
     * Switches to the logIn container
     */
    $("#loginBtn").on('click', function () {
        var signInWrapper = $("#signUp-wrapper");

        signInWrapper.addClass('animated flipOutX');
        isLogin = false;
        signInWrapper.on('oanimationend animationend webkitAnimationEnd', function (e) {
            if(!isLogin) {
                var loginWrapper = $("#login-wrapper");

                signInWrapper.addClass('hidden');
                loginWrapper.removeClass('hidden').removeClass('animated flipOutX').addClass('animated flipInX');
            }
        })
    });

    /**
     * Submits the signUp form to the server.
     */
    $("#frm_signUp").submit(function (e) {
        e.preventDefault();
        grecaptcha.reset();

        var url = $(this).attr('action');
        var method = $(this).attr('method');
        var data = $(this).serialize();

        $.ajax({
            url: url,
            type: method,
            data: data
        }).success(function (data) {
            if(data.error) {
                $('#errorAlert').removeClass('hidden').html(data.message);
                $('#successAlert').addClass('hidden');
            }
            if(data.success) {
                $('#errorAlert').addClass('hidden');
                $('#successAlert').removeClass('hidden').html(data.message);
                $('#password1').removeClass('has-success has-feedback');
                $('#password2').removeClass('has-success has-feedback');
                $('#password1Icon').addClass('hidden');
                $('#password2Icon').addClass('hidden');
                $("#frm_signUp")[0].reset();
            }
        }).error(function (error) {
            alert("Oh no, unfortunately something went wrong. Please contact the webmaster at wm@flight-academy.nl with this message:" +  JSON.stringify(error));
        });
    });

    /**
     * Compares the two password fields and if they are equal change them to a green
     */
    $("#password2Input").on('input', function () {
        if($(this).val() === $('#password1Input').val()) {
            $('#password1').addClass('has-success has-feedback');
            $('#password2').addClass('has-success has-feedback');
            $('#password1Icon').removeClass('hidden');
            $('#password2Icon').removeClass('hidden');
        } else {
            $('#password1').removeClass('has-success has-feedback');
            $('#password2').removeClass('has-success has-feedback');
            $('#password1Icon').addClass('hidden');
            $('#password2Icon').addClass('hidden');
        }
    })
});