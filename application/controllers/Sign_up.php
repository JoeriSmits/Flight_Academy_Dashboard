<?php
/**
 * Created by Joeri Smits.
 * Date: 04/07/2015
 * Time: 01:36
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sign_up extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_registration');
        $this->load->library('recaptcha');
        $this->load->library('client');
    }

    public function recaptcha()
    {
        $captcha_answer = $this->input->post('g-recaptcha-response');
        $response = $this->recaptcha->verifyResponse($captcha_answer);

        if ($response['success']) {
            return true;
        }
    }

    public function validateForm()
    {
        $this->form_validation->set_rules('firstName', 'First name', 'trim|required|xss_clean|alpha');
        $this->form_validation->set_rules('prefix', 'Prefix', 'trim|xss_clean|alpha');
        $this->form_validation->set_rules('lastName', 'Last name', 'trim|required|xss_clean|alpha');
        $this->form_validation->set_rules('eMail', 'E-mail', 'trim|required|xss_clean|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

        if ($this->form_validation->run()) {
            $this->signUp();
        } else {
            $this->client->displayMessage('error', 'Whoops, something went wrong. Did you forget a required field?');
        }
    }

    public function signUp()
    {
        $firstName = $this->input->post('firstName');
        $prefix = $this->input->post('prefix');
        $lastName = $this->input->post('lastName');
        $eMail = $this->input->post('eMail');
        $password = $this->input->post('password');

        if ($this->recaptcha()) {
            if ($this->M_registration->checkUniqueEmail($eMail)) {
                $this->M_registration->signUp($firstName, $prefix, $lastName, $eMail, $password);
                $this->client->displayMessage('success', 'You have successfully signed up! You can now login with your credentials and follow the next steps. We have also send you these instructions by mail.');
            } else {
                $this->client->displayMessage('error', "There is already an user registered with this e-mail. We can only accept one user per e-mail.");
            }
        } else {
            $this->client->displayMessage('error', 'Please complete the ReCaptcha before you submit the form.');
        }
    }
}