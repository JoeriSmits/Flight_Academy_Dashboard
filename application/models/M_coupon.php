<?php

/**
 * Created by Joeri Smits.
 * Date: 16/07/2015
 * Time: 22:19
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_coupon extends CI_Model
{
    public function checkCoupon($code)
    {
        $this->db->where(array('code' => $code));
        $query = $this->db->get('CouponCode');

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getDiscount($code)
    {
        $this->db->select('discount');
        $this->db->where(array('code' => $code));
        $query = $this->db->get('CouponCode');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                return $row->discount;
            }
        } else {
            return 0;
        }
    }
}