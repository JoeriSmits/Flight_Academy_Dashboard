<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by Joeri Smits.
 * Date: 30/05/2015
 * Time: 19:24
 */
class Authentication extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_auth");
        $this->load->library('recaptcha');
    }

    /**
     * Initializes the view of the login container
     */
    public function index()
    {
        if ($this->M_auth->isLoggedIn()) {
            redirect('/dashboard');
        } else {
            $this->load->view('templates/simplePage/header.php');
            $this->load->view("authentication/login");
            $this->load->view('templates/simplePage/footer.php');
        }
    }


    /**
     * Validates the form on required fields and xss. It also trims the input.
     * If the form_validation is complete (The input is not empty && trimmed && xss_clean) it will start the method login().
     */
    public function validateForm()
    {
        $this->form_validation->set_rules('user', 'User ID / E-mail', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

        if ($this->form_validation->run()) {
            $this->login();
        }
    }

    /**
     * Login process.
     * Calls the model to check if the user exists in the database.
     * If so it will send a JSON object to the view with a redirect link.
     * If not it will send a JSON object to the view with the element success and it's value false.
     *
     */
    public function login()
    {
        $user = $this->input->post('user');
        $password = $this->input->post('password');

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        if ($this->M_auth->login($user, $password)) {
            $response = array('success' => true, 'redirect' => site_url('dashboard'));
            echo json_encode($response);
        } else {
            $response = array('success' => false);
            echo json_encode($response);
        }
    }

    /**
     * Logout process.
     * Deletes the session that has been created with the login process.
     * After this has been done it will redirect the user to the login page.
     */
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/', 'refresh');
        exit;
    }
}