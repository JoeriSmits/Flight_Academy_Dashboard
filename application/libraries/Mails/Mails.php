<?php
/**
 * Created by Joeri Smits.
 * Date: 05/07/2015
 * Time: 00:49
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mails
{
    public function signUpMailWithInstructionsAboutFurtherSteps($firstName, $callsign)
    {
        $mailLogo = base_url('assets/img/eMail/FA-LOGO_MAIL.png');
        return "
            <!DOCTYPE html>
            <html>
            <style>
                body {
                    font-family: 'Open Sans', sans-serif;
                }

                .container {
                    width: 600px;
                    margin: 0 auto;
                }

                .container .logo {
                    text-align: center;
                }

                .line {
                    margin: 15px 0;
                    border-bottom: 2px solid #4765a0;
                }

                h1 {
                    font-weight: 300;
                    padding: 0.5em;
                    color: #4765a0;
                }

                p {
                    padding: 15px;
                }

                small a {
                    padding: 0 15px;
                    text-decoration: none;
                    color: #4765a0;
                }
            </style>
            <body>
            <div class='container'>
                <div class='logo'>
                    <img src='$mailLogo' alt='Flight-Academy Logo'>
                </div>
                <div class='line'>&nbsp;</div>
                <h1>Welcome to the Flight-Academy, " . $firstName . "</h1>

                <p><a href='" . site_url('/') . "'>You can now log in with your credentials in our dashboard.</a> After you have logged
                    in please follow the steps in the wizard. The third step in the wizard contains the payment process through
                    PayPal or Bank transfer.</p>

                <p>Username (Callsign): <strong>" . $callsign . "</strong></p>

                <p>If there are any questions feel free to contact us via the public website.
                On behave of our Flight Academy we wish you happy flying and good luck with your studies.</p>

                <p>
                Kind regards,<br />
                The Flight-Academy team</p>
                <div class='line'>&nbsp;</div>
                <small><a href='https://www.facebook.com/flightacademyvt'>Like us on Facebook!</a></small>
            </div>
            </body>
            </html>
    ";
    }

    public function succesfullyPaymentMailRegistration($firstName) {
        $mailLogo = base_url('assets/img/eMail/FA-LOGO_MAIL.png');
        return "
            <!DOCTYPE html>
            <html>
            <style>
                body {
                    font-family: 'Open Sans', sans-serif;
                }

                .container {
                    width: 600px;
                    margin: 0 auto;
                }

                .container .logo {
                    text-align: center;
                }

                .line {
                    margin: 15px 0;
                    border-bottom: 2px solid #4765a0;
                }

                h1 {
                    font-weight: 300;
                    padding: 0.5em;
                    color: #4765a0;
                }

                p {
                    padding: 15px;
                }

                small a {
                    padding: 0 15px;
                    text-decoration: none;
                    color: #4765a0;
                }
            </style>
            <body>
            <div class='container'>
                <div class='logo'>
                    <img src='$mailLogo' alt='Flight-Academy Logo'>
                </div>
                <div class='line'>&nbsp;</div>
                <h1>Thank you for your purchase, " . $firstName . "</h1>
                <p>We have received your payment successfully and will update your account to the next step in the registration process.</p>

                <p>If you have any questions regarding your registration process, feel free to contact The Flight-Academy staff.</p>

                <p>
                Kind regards,<br />
                The Flight-Academy team</p>
                <div class='line'>&nbsp;</div>
                <small><a href='https://www.facebook.com/flightacademyvt'>Like us on Facebook!</a></small>
            </div>
            </body>
            </html>
    ";
    }

    public function trainerHasAssignedStudent($studentFirstName, $trainerFirstName, $trainerPrefix, $trainerLastName, $trainerEmail) {
        $mailLogo = base_url('assets/img/eMail/FA-LOGO_MAIL.png');
        return "
            <!DOCTYPE html>
            <html>
            <style>
                body {
                    font-family: 'Open Sans', sans-serif;
                }

                .container {
                    width: 600px;
                    margin: 0 auto;
                }

                .container .logo {
                    text-align: center;
                }

                .line {
                    margin: 15px 0;
                    border-bottom: 2px solid #4765a0;
                }

                h1 {
                    font-weight: 300;
                    padding: 0.5em;
                    color: #4765a0;
                }

                p {
                    padding: 15px;
                }

                small a {
                    padding: 0 15px;
                    text-decoration: none;
                    color: #4765a0;
                }
            </style>
            <body>
            <div class='container'>
                <div class='logo'>
                    <img src='$mailLogo' alt='Flight-Academy Logo'>
                </div>
                <div class='line'>&nbsp;</div>
                <h1>Good news, " . $studentFirstName . "</h1>
                <p>We have found a suitable trainer for you. " . $trainerFirstName . " " . $trainerPrefix . " " . $trainerLastName . " has assigned you to him.</p>
                <p>" . $trainerFirstName . " will contact you with information about an interview to determine in which course you belong.</p>

                <p>If you have any questions, you can mail " . $trainerFirstName . " on this e-mail address: " . $trainerEmail . "</p>

                <p>
                Kind regards,<br />
                The Flight-Academy team</p>
                <div class='line'>&nbsp;</div>
                <small><a href='https://www.facebook.com/flightacademyvt'>Like us on Facebook!</a></small>
            </div>
            </body>
            </html>
    ";
    }
}