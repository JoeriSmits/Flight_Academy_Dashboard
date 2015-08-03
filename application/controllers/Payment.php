<?php

/**
 * Created by Joeri Smits.
 * Date: 15/07/2015
 * Time: 19:19
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends MY_Controller
{
    /**
     * Class constructor.
     * Adding libraries for each call.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('merchant');
        $this->merchant->load('paypal_express');
        $this->load->model('M_coupon');
        $this->load->model('M_registration');
    }

    /**
     * On controller load call function.
     * Initializing paypal settings and make purchase call.
     */
    public function index($coupon)
    {
        // initialize gateway
        $settings = $this->merchant->default_settings();
        $this->initialize_settings();
        // sending values to payment gateway.

        $session = $this->session->all_userdata();
        $userId = $session['id'];
        if (!empty($coupon)) {
            $discount = $this->M_coupon->getDiscount($coupon);
        } else {
            $discount = 0;
        }

        $discountExclVAT = $discount / (($this->config->item('taxRate') + 100) / 100);
        $amountExclVAT = FIRST_COURSE_AMOUNT - ($discount - $this->calculateTax($discountExclVAT));
        $amountInclVAT = $amountExclVAT + $this->calculateTax($amountExclVAT);

        $params = array(
            'amount' => $amountInclVAT,
            'itemAmount' => $amountExclVAT,
            'tax' => $amountInclVAT - $amountExclVAT,
            'item' => 'Flight-Academy Membership',
            'description' => 'Flight-Academy membership (One course)',
            'currency' => $this->config->item('currency'),
            'return_url' => site_url() . '/payment/payment_return/' . $userId,
            'cancel_url' => site_url() . '/payment/cancel/'
        );

        if ($amountInclVAT > 0) {
            $response = $this->merchant->purchase($params);
            echo $response->message();
        } else {
            $this->M_registration->updateStep($userId, 4);
            redirect('/registration');
        }
    }

    /**
     * Handling return call.
     * Make final payment.
     * @param $userId
     */
    public function payment_return($userId)
    {
        $this->initialize_settings();

        $params = array(
            'amount' => 16.50,
            'itemAmount' => 16.50 - $this->calculateTax(16.50),
            'tax' => $this->calculateTax(16.50),
            'item' => 'Flight-Academy Membership',
            'description' => 'Flight-Academy membership (One course)',
            'currency' => $this->config->item('currency'),
            'return_url' => site_url() . '/payment/payment_return/',
            'cancel_url' => site_url() . '/payment/cancel/'
        );
        $response = $this->merchant->purchase_return($params);
        // A complete transaction.
        if ($response->status() == Merchant_response::COMPLETE) {
            // data which is return by payment gateway to use.
            $token = $this->input->get('token');
            $payer_id = $this->input->get('PayerID');
            // Unique id for payment must save it for further payment queries.
            $gateway_reference = ($response->reference() ? $response->reference() : '');
            // Do your stuff here db insertion, email etc..

            $this->db->where(array('payer_id' => $payer_id, 'token' => $token, 'gateway_reference' => $gateway_reference));
            $query = $this->db->get('PayPalSales');
            if (!$query->result() > 0) {
                $data = array(
                    'userId' => $userId,
                    'payer_id' => $payer_id,
                    'token' => $token,
                    'gateway_reference' => $gateway_reference
                );
                $this->db->insert('PayPalSales', $data);

                /**
                 * When the user has payed using PayPal and this is the first link registered
                 * it will push the user to the next step and send the user an E-Mail.
                 */
                $this->M_registration->updateStep($userId, 4);

                $this->load->model('M_user');
                $userData = $this->M_user->getUser($userId);

                $this->email->from(NO_REPLY_EMAIL);
                $this->email->to($userData['eMail']);
                $this->email->subject('Thank you for you payment');
                $this->email->message($this->mails->succesfullyPaymentMailRegistration($userData['firstName']));
                $this->email->set_mailtype("html");
                $this->email->send();

                redirect('/registration');
            } else {
                echo "This payment combination has already been used. If you believe that his is wrong please contact the staff.";
            }
        } else {
            //Your payment has been failed redirect with message.
            $message = ($response->message() ? $response->message() : '');
            $this->session->set_flashdata('error', 'Error processing payment: ' . $message . ' Please try again');
            $this->cancel();
        }
    }

    public function cancel()
    {
        redirect('/registration');
    }

    /**
     * Paypal settings initialization.
     */
    public function initialize_settings()
    {
        $settings = array(
            'username' => $this->config->item('api_username'),
            'password' => $this->config->item('api_password'),
            'signature' => $this->config->item('api_signature'),
            'test_mode' => $this->config->item('test_mode')
        );
        $this->merchant->initialize($settings);
    }

    /**
     * Calculates the taxes of an amount
     * @param $amount
     * @return float
     */
    private function calculateTax($amount)
    {
        return round(($this->config->item('taxRate') / 100) * $amount, 2);
    }

    public function requestBankTransfer($coupon)
    {
        $this->load->model('M_bank_transfer');
        $this->load->library('client');
        if (!empty($coupon)) {
            $discount = $this->M_coupon->getDiscount($coupon);
        } else {
            $discount = 0;
        }

        $session = $this->session->all_userdata();
        $userId = $session['id'];
        $amount = FIRST_COURSE_AMOUNT_INCLUSIVE_VAT - $discount;

        if ($this->M_bank_transfer->addTransfer($userId, $amount)) {
            $this->client->displayMessage('success', null);
        } else {
            $this->client->displayMessage('error', 'The bank transfer request could not be saved in our database. Please contact the web master if this issue continues showing.');
        }
    }
}