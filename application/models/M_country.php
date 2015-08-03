<?php
/**
 * Created by Joeri Smits.
 * Date: 08/07/2015
 * Time: 01:08
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_country extends CI_Model
{
    /**
     * Gets all the country's ids and names from the database. Data is from 2012-02-06.
     * @return array with country's ids and names
     */
    public function getCountryIdAndName()
    {
        $query = $this->db->get('Country');

        $returnArray = array();
        foreach ($query->result() as $row) {
            $country = array('countryId' => $row->idCountry, 'countryName' => $row->countryName);
            array_push($returnArray, $country);
        }
        return $returnArray;
    }

    public function getCountryCodeAndName($countryId)
    {
        $this->db->where(array('idCountry' => $countryId));
        $query = $this->db->get('Country');

        $returnArray = array();
        foreach ($query->result() as $row) {
            $returnArray['countryCode'] = $row->countryCode;
            $returnArray['countryName'] = $row->countryName;
        }
        return $returnArray;
    }
}