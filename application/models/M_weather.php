<?php
/**
 * Created by Joeri Smits.
 * Date: 27/06/2015
 * Time: 02:31
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');
class M_weather extends CI_Model {
    function __construct()
    {
        $this->load->library('ftp');
        $config['hostname'] = "tgftp.nws.noaa.gov";
        $config['username'] = "anonymous";
        $config['passive'] = true;
        $this->ftp->connect($config);
    }

    /**
     * Get's the METAR, TAF and Decoder from http://noaa.gov . It connects with their FTP and will look for a METAR, TAF and decoder with the input ICAO code.
     * If he can find a METAR, TAF, Decoder it will be send back as a JSON object. If not it will send false back
     * @param $icao
     * @return string | boolean
     */
    public function getWeather($icao) {
        $config['hostname'] = "tgftp.nws.noaa.gov";
        $directory = '/data/observations/metar/stations/';
        $weather = array();

        $weather['METAR'] =  @file_get_contents('ftp://' . $config['hostname'] . $directory . strtoupper($icao) . '.TXT');

        $directory = '/data/forecasts/taf/stations/';
        $weather['TAF'] = @file_get_contents('ftp://' . $config['hostname'] . $directory . strtoupper($icao) . '.TXT');

        $directory = '/data/observations/metar/decoded/';
        $weather['DECODED'] = @file_get_contents('ftp://' . $config['hostname'] . $directory . strtoupper($icao) . '.TXT');

        $this->ftp->close();
        return json_encode($weather);
    }
}