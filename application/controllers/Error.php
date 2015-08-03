<?php

/**
 * Created by Joeri Smits.
 * Date: 09/07/2015
 * Time: 03:15
 */
class Error extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Loads an error page. User is not logged in.
     */
    public function userNotLoggedIn()
    {
        $this->load->view('templates/simplePage/header');
        $this->load->view('errors/notLoggedIn');
        $this->load->view('templates/simplePage/footer');
    }
}