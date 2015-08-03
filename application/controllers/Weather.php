<?php
/**
 * Created by Joeri Smits.
 * Date: 26/06/2015
 * Time: 22:56
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Weather extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("M_weather");
        $this->load->model('M_auth');
        $session = $this->session->all_userdata();
        $this->M_auth->authorizePayedUser($session);
    }

    public function index()
    {
        $this->show_view_with_menu('dashboard/weather/index', null);
    }

    public function validateAirport()
    {
        $this->form_validation->set_rules('icao', 'ICAO', 'trim|required|xss_clean');
        if ($this->form_validation->run()) {
            $this->getWeather();
        } else {
            header('Content-Type: application/json');
            echo json_encode(array("Error" => true));
        }
    }

    public function getWeather()
    {
        $icao = $this->input->post('icao');

        header('Content-Type: application/json');
        echo $this->M_weather->getWeather($icao);
    }
}