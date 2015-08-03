<?php
/**
 * Created by Joeri Smits.
 * Date: 04/07/2015
 * Time: 14:42
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_registration extends CI_Model
{
    function __construct()
    {
        $this->load->library('email');
        $this->load->library('mails');
    }

    /**
     * SignUp process
     * Get's the data via the parameters. This method registers the user in the database.
     * An unique callsign will be generated and will be attached on the user.
     * When the user is registered in the database it will send the user an e-mail with more details about further steps.
     * See the Mails library for the mail's content.
     * @param $firstName
     * @param $prefix
     * @param $lastName
     * @param $eMail
     * @param $password
     */
    public function signUp($firstName, $prefix, $lastName, $eMail, $password)
    {
        date_default_timezone_set('Europe/Amsterdam');
        $password = hash('sha256', $password);
        $data = array(
            'callsign' => $this->generateUniqueCallsign(),
            'firstName' => $firstName,
            'prefix' => $prefix,
            'lastName' => $lastName,
            'password' => $password,
            'eMail' => $eMail,
            'country' => 1,
            'dateOfRegistration' => date('Y-m-d H:i:s')
        );
        $this->db->insert('User', $data);

        $this->db->select('userId');
        $query = $this->db->get_where('User', array('callsign' => $data['callsign']));
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $userId = array(
                    'userId' => $row->userId,
                    'step' => 1
                );
                $this->db->insert('RegistrationStep', $userId);
            }
        }

        $this->email->from(NO_REPLY_EMAIL);
        $this->email->to($eMail);
        $this->email->subject('Welcome to the flight-academy!');
        $this->email->message($this->mails->signUpMailWithInstructionsAboutFurtherSteps($firstName, $data['callsign']));
        $this->email->set_mailtype("html");
        $this->email->send();
    }

    /**
     * Generates an unique callsign.
     * When a callsign is generated it will look in the database if it already exists.
     * When it does it will recursively call this method again until an unique callsign is generated.
     * When the unique callsign is generated it will return it's value.
     * @return string callsign
     */
    private function generateUniqueCallsign()
    {
        $randomInt = rand(100, 999);
        $callsign = 'FAE' . $randomInt;

        $this->db->where('callsign', $callsign);
        $query = $this->db->get('User');
        if ($query->num_rows() > 0) {
            $this->generateUniqueCallsign();
        } else {
            return $callsign;
        }
    }

    /**
     * Checks if the eMail is unique in the database.
     * When it is it will return true if not it will return false.
     * @param $eMail
     * @return bool
     */
    public function checkUniqueEmail($eMail)
    {
        $this->db->where('eMail', $eMail);
        $query = $this->db->get('User');
        if ($query->num_rows() > 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * This method updates the user's profile. All data is already checked and will be updated in the database.
     * @param $userId
     * @param $dayOfBirth
     * @param $city
     * @param $country
     * @param $phoneNumber
     * @param $mobileNumber
     * @return bool
     */
    public function updateProfile($userId, $dayOfBirth, $city, $country, $phoneNumber, $mobileNumber)
    {
        if ($this->validateDate($dayOfBirth)) {
            $data = array(
                'dayOfBirth' => $dayOfBirth,
                'city' => $city,
                'country' => $country,
                'telephoneNr' => $phoneNumber,
                'mobileNr' => $mobileNumber
            );
            $this->db->where('userId', $userId);
            $this->db->update('User', $data);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Validates a date.
     * Validates if the date if correctly formatted.
     * If not it will reformat the date to a proper format.
     * @param $date
     * @return bool
     */
    private function validateDate($date)
    {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') == $date;
    }

    /**
     * Upload an avatar.
     * This method get's the userId and the base64 encoded avatar.
     * It will decode the base64 avatar and save it at 'assets/img/userAvatar/###.png'.
     * @param $userId
     * @param $avatarImg
     * @return bool
     */
    public function uploadAvatar($userId, $avatarImg)
    {
        $avatarImg = preg_replace('#^data:image/\w+;base64,#i', '', $avatarImg);
        $avatarImg = str_replace(' ', '+', $avatarImg);
        $avatarImg = base64_decode($avatarImg);
        $imageUrl = 'assets/img/userAvatar/' . $userId . '.png';

        if (file_put_contents($imageUrl, $avatarImg)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Updates a registration step.
     * These steps are used to check what step the user is in the registration process.
     * @param $userId
     * @param $step
     */
    public function updateStep($userId, $step)
    {
        $data = array(
            'step' => $step
        );

        $this->db->where(array('userId' => $userId));
        $this->db->update('RegistrationStep', $data);
    }

    /**
     * Returns the step of the userId that has been given.
     * @param $userId
     * @return null
     */
    public function getStep($userId)
    {
        $this->db->where(array('userId' => $userId));
        $query = $this->db->get('RegistrationStep');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                return $row->step;
            }
        }
        return null;
    }

    public function deleteRegistration($userId)
    {
        $this->db->where(array('userId' => $userId));
        $query = $this->db->delete('RegistrationStep');

        if ($query) {
            return true;
        } else {
            return false;
        }
    }
}