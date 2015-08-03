<?php

/**
 * Created by Joeri Smits.
 * Date: 25/05/2015
 * Time: 02:13
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_auth extends CI_Model
{
    /**
     * Login process
     * Checks if the user exists in the database.
     * If so it will return true and create a session with the UserID and it's current state (logged_in).
     * If not it will return false.
     * @param $user
     * @param $password
     * @return bool user logged in or not
     */
    public function login($user, $password)
    {
        $password = hash('sha256', $password);
        $this->db->where(array('callsign' => $user));
        $this->db->or_where(array('eMail' => $user));
        $this->db->where(array('password' => $password));
        $query = $this->db->get('User');

        if ($query->num_rows() == 1) {
            foreach ($query->result() as $row) {
                $data = array(
                    'id' => $row->userId,
                    'callsign' => $row->callsign,
                    'firstName' => $row->firstName,
                    'prefix' => $row->prefix,
                    'lastName' => $row->lastName,
                    'isOnline' => true
                );
            }
            $this->session->set_userdata($data);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Checks if the user session still exists.
     * If it does it will return true.
     * If not it will return false.
     * @return bool result
     */
    public function isLoggedIn()
    {
        header("cache-Control: no-store, no-cache, must-revalidate");
        header("cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
        $is_logged_in = $this->session->userdata('isOnline');

        if (!isset($is_logged_in) || $is_logged_in !== true) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * @param $session
     */

    public function authorizePayedUser($session)
    {
        $this->db->select('userType');
        $this->db->where(array('userId' => $session['id']));
        $query = $this->db->get('User');

        if($query->result() > 0) {
            foreach($query->result() as $row) {
                if($row->userType == 0) {
                    redirect('/registration');
                }
            }
        }
    }

    public function authorizeNonPayedUsers($session)
    {
        $this->db->select('userType');
        $this->db->where(array('userId' => $session['id']));
        $query = $this->db->get('User');

        if($query->result() > 0) {
            foreach($query->result() as $row) {
                if($row->userType > 0) {
                    redirect('/dashboard');
                }
            }
        }
    }

    public function authorizeStaff($session)
    {
        $this->db->select('userType');
        $this->db->where(array('userId' => $session['id']));
        $query = $this->db->get('User');

        if($query->result() > 0) {
            foreach($query->result() as $row) {
                if($row->userType < TRAINER_USER_TYPE) {
                    redirect('/userNotAllowed');
                }
            }
        }
    }

    public function authorizeUserWithTrainer($session) {
        $this->db->select('trainerId');
        $this->db->where(array('studentId' => $session['id']));
        $query = $this->db->get('TrainerStudent');

        if($query->num_rows() == 0) {
            redirect('dashboard/noTrainer');
        }
    }
}