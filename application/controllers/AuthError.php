<?php
/**
 * Created by Joeri Smits.
 * Date: 09/07/2015
 * Time: 03:16
 */

class AuthError extends MY_Controller {
    function __construct()
    {
        parent::__construct();
    }

    public function userNotAllowed() {
        $this->load->view('templates/simplePage/header');
        $this->load->view('errors/userNotAllowed');
        $this->load->view('templates/simplePage/footer');
    }

    public function noTrainer() {
        $this->show_view_with_menu('errors/noTrainer', null);
    }
}