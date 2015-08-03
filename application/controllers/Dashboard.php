<?php
/**
 * Created by Joeri Smits.
 * Date: 10/06/2015
 * Time: 01:06
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');


class Dashboard extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_toDo');
        $this->load->model('M_teamspeak');
        $this->load->model('M_auth');
        $session = $this->session->all_userdata();
        $this->M_auth->authorizePayedUser($session);
    }

    /**
     * Sets the view for the dashboard main page (First landing page)
     */
    public function index()
    {
        $data['session'] = $this->session->all_userdata();
        $data['teamspeakCount'] = $this->M_teamspeak->getCount();

        if(!empty($data['session']['id'])) {
            $user = $data['session']['id'];
            $data['toDo'] = $this->M_toDo->getToDo($user);
        }


        $this->show_view_with_menu('dashboard/main', $data);
    }

    /**
     * Validates the input field of the To Do list.
     * It will be checked on requirement and xss. It also will be trimmed.
     */
    public function validateToDo()
    {
        $this->form_validation->set_rules('message', 'Message', 'trim|required|xss_clean');

        if ($this->form_validation->run()) {
            $this->addToDo();
        }
    }

    /**
     * Add a To Do task.
     * It will get the post data message and sends it with the user to the model.
     */
    private function addToDo()
    {
        $message = $this->input->post('message');
        $session = $this->session->all_userdata();
        $user = $session['id'];

        $this->M_toDo->addToDo($user, $message);
    }

    /**
     * Same as addToDo().
     * It only calls another function in the model which will result in a deletion of the item.
     */
    public function deleteToDo()
    {
        $message = $this->input->post('message');
        $session = $this->session->all_userdata();
        $user = $session['id'];

        $this->M_toDo->deleteToDo($user, $message);
    }

    /**
     * Finishes a task. $finish is true when the item needs to show as finished. $finish it false when the item needs to show as unfinished.
     */
    public function finishToDo()
    {
        $message = $this->input->post('message');
        $finish = $this->input->post('finish');

        $session = $this->session->all_userdata();
        $user = $session['id'];

        $this->M_toDo->finishToDo($user, $message, $finish);
    }
}