<?php

/**
 * Created by Joeri Smits.
 * Date: 28/06/2015
 * Time: 12:21
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');
class M_teamspeak extends CI_Model
{

    function __construct()
    {
        $this->load->library('Teamspeak3');
        Teamspeak3::init();
    }

    /**
     * Makes connection to the Teamspeak 3 server.
     * It will return the connection to all other methods.
     * @return TeamSpeak3_Adapter_Abstract
     */
    private function connect()
    {
        $ts3 = Teamspeak3::factory("serverquery://webServer:FMWJ0RWP@176.31.170.56:10011/?server_port=9987");
        return $ts3;
    }

    /**
     * Returns the status.
     * "Online" for an online server.
     * "Offline" for an offline server.
     * @return string
     */
    public function getStatus()
    {
        try {
            $ts3 = $this->connect();
            $status = $ts3->getProperty("virtualserver_status");
        } catch (Exception $e) {
            $status = "offline";
        }
        return $status;
    }

    /**
     * Returns the amount of users that are currently connected to the Teamspeak 3 server.
     * @return int
     */
    public function getCount()
    {
        try {
            $ts3 = $this->connect();
            $count = $ts3->getProperty("virtualserver_clientsonline") - $ts3->getProperty("virtualserver_queryclientsonline");
        } catch (Exception $e) {
            $count = 0;
            mail("wm@flight-academy.nl", "Teamspeak3 server offline", $e->getCode() . ': ' . $e->getMessage() . ' : ' . $e->getLine() . ' in ' . $e->getFile());
        }
        return $count;
    }

    /**
     * Returns an by Teamspeak created "Teamspeak viewer".
     * It returns an string with html for the viewer.
     * @return null
     */
    public function getViewer()
    {
        try {
            $ts3 = $this->connect();
            $viewer = $ts3->getViewer(new Teamspeak3_Viewer_Html(base_url('assets/img/viewerIcons') . '/', base_url('assets/img/countryFlags') . '/', "data:image"));
        } catch (Exception $e) {
            $viewer = null;
        }
        return $viewer;
    }
}