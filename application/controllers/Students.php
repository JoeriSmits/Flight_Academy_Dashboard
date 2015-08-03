<?php

/**
 * Created by Joeri Smits.
 * Date: 02/08/2015
 * Time: 22:16
 */
class Students extends MY_Controller
{

    /**
     * Students constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_auth');
        $session = $this->session->all_userdata();
        $this->M_auth->authorizeStaff($session);
    }

    public function myStudents() {
        $this->show_view_with_menu('dashboard/staffOnly/students/myStudents', null);
    }
}