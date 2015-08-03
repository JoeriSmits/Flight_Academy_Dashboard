<?php

/**
 * Created by Joeri Smits.
 * Date: 20/07/2015
 * Time: 16:52
 */
class NewStudent extends MY_Controller
{

    /**
     * NewStudent constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_auth');
        $session = $this->session->all_userdata();
        $this->M_auth->authorizeStaff($session);
        $this->load->model('M_user');
        $this->load->model('M_country');
        $this->load->library('Client');
    }

    public function index()
    {
        $data['newStudents'] = $this->getNewStudents();
        $this->show_view_with_menu('dashboard/staffOnly/newStudent/newStudent', $data);
    }

    public function assignStudentToTrainer($userId) {
        $session = $this->session->get_userdata();

        if($this->M_user->assignStudentToTrainer($userId, $session['id'])) {
            $this->client->displayMessage('success', null);
        } else {
            $this->client->displayMessage('error', 'Could not assign the student to the trainer. Perhaps the student is already assigned?');
        }
    }

    public function assignStudent($userId)
    {
        $session = $this->session->get_userdata();

        $data['user'] = $this->M_user->getUser($userId);
        if($data['user']['userType'] < STUDENT_IN_COURSE && !empty($data['user'])) {
            if($this->M_user->isStudentAssignedToTrainer($userId)) {
                if($this->M_user->getTrainer($userId) == $session['id']) {
                    $data['alreadyAssigned'] = true;
                } else {
                    $data['wrongTrainer'] = true;
                }
            }
            else {
                $data['alreadyAssigned'] = false;
            }
            foreach($data['user'] as &$item) {
                if($item == null || empty($item)) {
                    $item = '-';
                }
            }
            $data['user']['country'] = $this->M_country->getCountryCodeAndName($data['user']['country']);
            $this->show_view_with_menu('dashboard/staffOnly/newStudent/detailInfo', $data);
        } else {
            $this->show_view_with_menu('dashboard/staffOnly/newStudent/studentAlreadyInCourse', null);
        }

    }

    private function getNewStudents()
    {
        $userTypes = $this->M_user->getNewStudents();

        if ($userTypes != null) {
            $users = array();
            foreach ($userTypes as $userType) {
                $user = $this->M_user->getUser($userType);
                array_push($users, $user);
            }
            return $users;
        } else {

        }
    }
}