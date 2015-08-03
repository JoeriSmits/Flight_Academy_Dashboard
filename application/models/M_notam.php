<?php
/**
 * Created by Joeri Smits.
 * Date: 27/06/2015
 * Time: 21:32
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_notam extends CI_Model
{
    /**
     * Retrieves the active notam(s) of an airport determine via the icao code.
     * It makes connections with the VATSIM API for Notams and retrieves all the notams.
     * @param $icao
     * @return string JSON NOTAMS
     */
    public function getNotam($icao)
    {
        $icao = preg_replace('/\s+/', '', $icao);
        $json = @file_get_contents('http://api.vateud.net/notams/' . $icao . '.json');
        if($json == "No notams found for this airport")
            $json = json_encode(array('error' => true));
        return $json;
    }
}