<?php

/**
 * Created by Joeri Smits.
 * Date: 03/08/2015
 * Time: 01:22
 */
class FlightPlan extends MY_Controller
{
    /**
     * FlightPlan constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $session = $this->session->get_userdata();
        $this->load->model('M_auth');
        $this->M_auth->authorizeUserWithTrainer($session);
    }

    public function validateFlightPlan() {

    }

    public function sendFlightPlan() {
        $session = $this->session->get_userdata();
        $this->show_view_with_menu('dashboard/flightplan/index', $session);
    }
}