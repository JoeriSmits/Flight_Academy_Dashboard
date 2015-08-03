<?php

/**
 * Created by Joeri Smits.
 * Date: 06/07/2015
 * Time: 16:55
 */
class Registration extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_auth');
        $session = $this->session->all_userdata();
        $this->M_auth->authorizeNonPayedUsers($session);

        $this->load->model('M_registration');
        $this->load->model('M_country');
        $this->load->model('M_user');
        $this->load->library('client');
        $this->load->model('M_bank_transfer');
    }

    /**
     * Loads data and decides what step is shown to the user.
     * User data from the session and from the database is used to show the user the correct data.
     *
     */
    public function wizard()
    {
        $session = $this->session->all_userdata();

        $data = array(
            'session' => $session,
            'userData' => $this->M_user->getUser($session['id']),
            'amount' => FIRST_COURSE_AMOUNT_INCLUSIVE_VAT
        );

        if ($this->M_bank_transfer->hasTheUserABankTransfer($data['session']['id'])) {
            $data['bankTransfer'] = true;
        }

        $pageId = $this->M_registration->getStep($session['id']);
        if ($pageId == 1) {
            $countries = $this->M_country->getCountryIdAndName();
            $data['countries'] = $countries;
            $this->show_view_with_menu_registration('registration/updateProfile', $data);
        } else if ($pageId == 2) {
            $this->show_view_with_menu_registration('registration/uploadAvatar', $data);
        } else if ($pageId == 3) {
            $this->show_view_with_menu_registration('registration/payment', $data);
        } else if ($pageId == 4) {
            $this->notifyTrainers($data['session']['id']);
            $this->show_view_with_menu_registration('registration/explanation', $data);
        } else if ($pageId == 5) {
            $this->show_view_with_menu_registration('registration/tools', $data);
        } else if (!isset($pageId)) {
            redirect('/dashboard');
        }
    }

    /**
     * Validates each individual field. If the field does not comply with the rules it will show an error message to the user.
     */
    public function validateProfileData()
    {
        $this->form_validation->set_rules('dayOfBirth', 'Day of Birth', 'trim|required|xss_clean');
        $this->form_validation->set_rules('city', 'City', 'trim|xss_clean');
        $this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean');
        $this->form_validation->set_rules('phoneNumber', 'Telephone number', 'trim|xss_clean|numeric');
        $this->form_validation->set_rules('mobileNumber', 'Mobile number', 'trim|xss_clean|numeric');

        if ($this->form_validation->run()) {
            $this->updateProfile();
        } else {
            $this->client->displayMessage('error', 'Whoops, something went wrong. These things could be the issue: You have forgotten a required field, Telephone and mobile numbers should only contain numbers.');
        }
    }

    /**
     * Collects all the data from the post data. It then passes the data to the updateProfile method in the mRegistration model.
     * When this method fails it will show an error message to the user.
     */
    private function updateProfile()
    {
        $session = $this->session->all_userdata();
        $userId = $session['id'];
        $dayOfBirth = $this->input->post('dayOfBirth');
        $city = $this->input->post('city');
        $country = $this->input->post('country');
        $phoneNumber = $this->input->post('phoneNumber');
        $mobileNumber = $this->input->post('mobileNumber');

        if ($this->M_registration->updateProfile($userId, $dayOfBirth, $city, $country, $phoneNumber, $mobileNumber)) {
            $this->M_registration->updateStep($session['id'], 2);
            $this->client->displayMessage('success', site_url('/registration'));
        } else {
            $this->client->displayMessage('error', 'Whoops, something went wrong. You have submitted an invalid date of birth.');
        };
    }

    /**
     * Validates the avatar on size. It has to calculate the size of a base64 string by multiplying it bij 3/4.
     * Then it checks if its below 270000 bytes.
     */
    public function validateAvatar()
    {
        $avatarImg = $this->input->post('avatar');

        if (strlen($avatarImg) * (3 / 4) < 270000) {
            $this->uploadAvatar();
        } else {
            $this->client->displayMessage('error', 'Unfortunately, The avatar is too big. Please use a different kind of avatar or try to zoom in a bit more using the slider.');
        }
    }

    public function uploadAvatar()
    {
        $session = $this->session->all_userdata();
        $userId = $session['id'];
        $avatarImg = $this->input->post('avatar');

        if ($this->M_registration->uploadAvatar($userId, $avatarImg)) {
            $this->M_registration->updateStep($session['id'], 3);
            $this->client->displayMessage('success', site_url('/registration'));
        } else {
            $this->client->displayMessage('error', 'Whoops, something went wrong. We could not process your avatar, we are very sorry and advise you to upload another avatar.');
        }
    }

    public function validateCoupon()
    {
        $this->form_validation->set_rules('code', 'Coupon Code', 'required|trim|xss_clean');

        if ($this->form_validation->run()) {
            $this->checkCoupon();
        } else {
            $this->client->displayMessage('error', 'Whoops, something went wrong. The coupon code you have send is not accepted by our system.');
        }
    }

    private function checkCoupon()
    {
        $this->load->model('M_coupon');

        $code = $this->input->post('code');

        if ($this->M_coupon->checkCoupon($code)) {
            $this->client->displayMessage('success', $this->M_coupon->getDiscount($code));
        } else {
            $this->client->displayMessage('error', 'Oh no, unfortunately this coupon code is not valid.');
        }
    }

    /**
     * Notify all trainers about a new student that has almost completed the registration process.
     * @param $userId
     */
    private function notifyTrainers($userId)
    {
        //TODO Send all trainers a notification e-mail
    }

    public function continueToTools() {
        $session = $this->session->get_userdata();

        $registrationStep = $this->M_registration->getStep($session['id']);

        if($registrationStep == 4) {
            $this->M_registration->updateStep($session['id'], 5);
            redirect('/registration');
        }
    }

    public function continueToDashboard() {
        $session = $this->session->get_userdata();

        $registrationStep = $this->M_registration->getStep($session['id']);

        if($registrationStep == 5) {
            if($this->M_registration->deleteRegistration($session['id'])) {
                $this->M_user->updateUserType($session['id'], 1);
                redirect('/');
            }
        }
    }
}