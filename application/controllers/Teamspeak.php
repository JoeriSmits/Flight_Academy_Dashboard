<?php

/**
 * Created by Joeri Smits.
 * Date: 28/06/2015
 * Time: 12:03
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Teamspeak extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("M_teamspeak");
        $this->load->model('M_auth');
        $session = $this->session->all_userdata();
        $this->M_auth->authorizePayedUser($session);
    }

    public function index()
    {
        $this->show_view_with_menu('dashboard/teamspeak/index', null);
    }

    public function getTeamspeakData()
    {
        $returnValue = array('status' => $this->M_teamspeak->getStatus(), 'viewer' => $this->M_teamspeak->getViewer());
        header('Content-Type: application/json');
        echo json_encode($returnValue);
    }
}