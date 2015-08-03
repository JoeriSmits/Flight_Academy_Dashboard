<?php
/**
 * Created by Joeri Smits.
 * Date: 27/06/2015
 * Time: 20:17
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Notam extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_notam');
        $this->load->model('M_auth');
        $session = $this->session->all_userdata();
        $this->M_auth->authorizePayedUser($session);
    }

    public function index()
    {
        $this->show_view_with_menu('dashboard/notam/index', null);
    }

    public function validateAirport()
    {
        $this->form_validation->set_rules('icao', 'ICAO', 'trim|required|xss_clean');
        if ($this->form_validation->run()) {
            $this->getNotam();
        } else {
            header('Content-Type: application/json');
            echo json_encode(array("error" => true));
        }
    }

    private function getNotam()
    {
        $icao = $this->input->post('icao');

        header('Content-Type: application/json');
        echo $this->M_notam->getNotam($icao);
    }
}