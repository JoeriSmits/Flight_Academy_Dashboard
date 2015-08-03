<?php
/**
 * Created by Joeri Smits.
 * Date: 26/06/2015
 * Time: 23:17
 */

class MY_Controller extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model("M_auth");
        $this->load->model("M_user");
        if (!$this->M_auth->isLoggedIn())
            redirect('/notLoggedIn', 'refresh');
    }

    function show_view_with_menu($view_name, $data) {
        $data['session'] = $this->session->all_userdata();
        $users = $this->M_user->getNewStudents();
        $data['newStudentsCount'] = count($users);

        $this->load->view('templates/dashboard/header');
        $this->load->view('templates/dashboard/menu', $data);
        $this->load->view($view_name, $data);
        $this->load->view('templates/dashboard/sideBarRight');
        $this->load->view('templates/dashboard/footer');
    }

    function show_view_with_menu_registration($view_name, $data) {
        $data['session'] = $this->session->all_userdata();

        $this->load->view('templates/registration/header');
        $this->load->view('templates/dashboard/menuRegistration', $data);
        $this->load->view($view_name, $data);
        $this->load->view('templates/registration/footer');
    }
}