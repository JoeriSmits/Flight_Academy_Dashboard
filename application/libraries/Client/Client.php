<?php
/**
 * Created by Joeri Smits.
 * Date: 08/07/2015
 * Time: 00:43
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Client
{
    public function displayMessage($type, $message)
    {
        header('Content-Type: application/json; charset=utf-8');
        $result = array($type => true, 'message' => $message);
        echo json_encode($result);
    }
}