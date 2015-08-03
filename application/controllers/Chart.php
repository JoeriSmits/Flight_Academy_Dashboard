<?php
/**
 * Created by Joeri Smits.
 * Date: 03/07/2015
 * Time: 23:04
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Chart extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_auth');
        $session = $this->session->all_userdata();
        $this->M_auth->authorizePayedUser($session);
    }

    public function index()
    {
        $this->show_view_with_menu('dashboard/chart/index', null);
    }
}