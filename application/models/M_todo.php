<?php

/**
 * Created by Joeri Smits.
 * Date: 11/06/2015
 * Time: 17:32
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');
class M_todo extends CI_Model
{
    /**
     * Add a To Do task to the database.
     * $user is the related person to the task.
     * $message is the actual task message.
     * @param $user
     * @param $message
     */
    public function addToDo($user, $message)
    {
        date_default_timezone_set('Europe/Amsterdam');
        $data = array(
            'userId' => $user,
            'message' => $message,
            'finished' => false,
            'date' => date('Y-m-d H:i:s')
        );
        $this->db->insert('ToDo', $data);
    }

    /**
     * Returns an array with all the To Do items for the $user.
     * Or if there are no To Do items it will return false.
     * @param $user
     * @return array|bool
     */
    public function getToDo($user)
    {
        $this->db->where(array('userId' => $user));
        $this->db->order_by('date', 'desc');
        $query = $this->db->get('ToDo');

        if ($query->num_rows() > 0) {
            $data = array();
            foreach ($query->result() as $row) {
                array_push($data, array('message' => $row->message, 'finished' => $row->finished));
            }
            if (!empty($data)) {
                return $data;
            }
        } else {
            return false;
        }
    }

    /**
     * Deletes an To Do task in the database
     * @param $user
     * @param $message
     */
    public function deleteToDo($user, $message)
    {
        $this->db->where(array('userId' => $user));
        $this->db->where(array('message' => $message));

        $this->db->delete('ToDo');
    }

    /**
     * Updates the finished column of a record. It sets the finished to true or false depending on $finish.
     * @param $user
     * @param $message
     * @param $finish boolean
     */
    public function finishToDo($user, $message, $finish)
    {
        $this->db->where(array('userId' => $user));
        $this->db->where(array('message' => $message));

        if ($finish === 'true') {
            $result = true;
        } else {
            $result = false;
        }
        $this->db->update('ToDo', array('finished' => $result));

    }
}