<?php
/**
 * Created by Joeri Smits.
 * Date: 08/07/2015
 * Time: 16:57
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_user extends CI_Model
{
    /**
     * M_user constructor.
     */
    public function __construct()
    {
        $this->load->library('email');
        $this->load->library('mails');
    }

    /**
     * Retrieve all user information.
     * It will return false if the user doest not exists.
     * @param $id
     * @return array|bool
     */
    public function getUser($id)
    {
        $this->db->where('userId', $id);
        $query = $this->db->get('User');
        if ($query->num_rows() > 0) {
            $data = array();
            foreach ($query->result() as $row) {
                $data = array(
                    'userId' => $row->userId,
                    'callsign' => $row->callsign,
                    'firstName' => $row->firstName,
                    'prefix' => $row->prefix,
                    'lastName' => $row->lastName,
                    'eMail' => $row->eMail,
                    'dayOfBirth' => $this->rewriteDate($row->dayOfBirth),
                    'city' => $row->city,
                    'country' => $row->country,
                    'telephoneNr' => $row->telephoneNr,
                    'mobileNr' => $row->mobileNr,
                    'dateOfRegistration' => $row->dateOfRegistration,
                    'userType' => $row->userType,
                    'isOnline' => $row->isOnline
                );
            }
            return $data;
        }
        return false;
    }

    public function updateUserType($userId, $type)
    {
        $this->db->where(array('userId' => $userId));
        $data = array(
            'userType' => $type
        );
        $this->db->update('User', $data);
        $userData = $this->getUser($userId);
        $data = array(
            'id' => $userId,
            'callsign' => $userData['callsign'],
            'firstName' => $userData['firstName'],
            'prefix' => $userData['prefix'],
            'lastName' => $userData['lastName'],
            'isOnline' => true
        );
        $this->session->set_userdata($data);
    }

    /**
     * Rewrites the data for the view.
     * Data has to be displayed as Y-m-d but if empty it has to be 0000-00-00.
     * @param $dateParam
     * @return string
     */
    private function rewriteDate($dateParam)
    {
        if (!empty($dateParam)) {
            $date = DateTime::createFromFormat('Y-m-d', $dateParam);
            return $date->format('Y-m-d');
        } else {
            return '0000-00-00';
        }
    }

    public function getNewStudents()
    {
        $this->db->select('User.userId');
        $this->db->where(array('User.userType' => NEW_USER_TYPE));
        $this->db->where(
            'userId NOT IN (SELECT studentId FROM TrainerStudent)', NULL, FALSE
            );
        $this->db->order_by('User.dateOfRegistration', 'desc');
        $query = $this->db->get('User');

        if ($query->result() > 0) {
            $data = array();
            foreach ($query->result() as $row) {
                array_push($data, $row->userId);
            }
            return $data;
        } else {
            return null;
        }
    }

    public function getTrainer($userId) {
        $this->db->select('trainerId');
        $this->db->where(array('studentId' => $userId));
        $query = $this->db->get('TrainerStudent');

        if($query->num_rows() > 0) {
            foreach($query->result() as $row) {
                return $row->trainerId;
            }
        } else {
            return null;
        }
    }

    public function assignStudentToTrainer($studentId, $trainerId)
    {
        if (!$this->isStudentAssignedToTrainer($studentId)) {
            $data = array('studentId' => $studentId, 'trainerId' => $trainerId);
            $this->db->insert('TrainerStudent', $data);

            $student = $this->getUser($studentId);
            $trainer = $this->getUser($trainerId);

            $this->email->from(NO_REPLY_EMAIL);
            $this->email->to($student['eMail']);
            $this->email->subject('You have been assigned to ' . $trainer['firstName']);
            $this->email->message($this->mails->trainerHasAssignedStudent($student['firstName'], $trainer['firstName'], $trainer['prefix'], $trainer['lastName'], $trainer['eMail']));
            $this->email->set_mailtype("html");
            $this->email->send();

            return true;
        } else {
            return false;
        }
    }

    public function isStudentAssignedToTrainer($studentId) {
        $this->db->where(array('studentId' => $studentId));
        $query = $this->db->get('TrainerStudent');

        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}