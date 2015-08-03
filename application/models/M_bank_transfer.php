<?php

/**
 * Created by Joeri Smits.
 * Date: 17/07/2015
 * Time: 20:01
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_bank_transfer extends CI_Model
{
    public function addTransfer($userId, $amount)
    {
        $data = array(
            'userId' => $userId,
            'amount' => $amount,
            'date' => date('Y-m-d')
        );

        if($this->db->insert('BankTransferRequest', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function hasTheUserABankTransfer($userId) {
        $this->db->where(array('userId' => $userId));
        $query = $this->db->get('BankTransferRequest');

        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}