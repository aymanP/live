<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Omnipay\Omnipay;
require_once(APPPATH . 'third_party/omnipay/vendor/autoload.php');
class Paypal_gateway
{
    function __construct()
    {
        $this->ci =& get_instance();
    }
    public function make_purchase($data)
    {
        // Process online for PayPal payment start
        $gateway = Omnipay::create('PayPal_Express');

        $gateway->setUsername(trim($this->ci->encryption->decrypt(get_option('paymentmethod_paypal_username'))));
        $gateway->setPassword(trim($this->ci->encryption->decrypt(get_option('paymentmethod_paypal_password'))));
        $gateway->setSignature(trim($this->ci->encryption->decrypt(get_option('paymentmethod_paypal_signature'))));

        $gateway->setTestMode(get_option('paymentmethod_paypal_test_mode_enabled'));
        $gateway->setlogoImageUrl(site_url('uploads/company/logo.png'));
        $gateway->setbrandName(get_option('companyname'));

        $request_data = array(
            'amount' => number_format($data['amount'], 2, '.', ''),
            'returnUrl' => site_url('gateways/paypal/complete_purchase?hash=' . $data['invoice']->hash . '&invoiceid=' . $data['invoiceid']),
            'cancelUrl' => site_url('viewinvoice/' . $data['invoiceid'] . '/' . $data['invoice']->hash),
            'currency' => $data['invoice']->currency_name,
            'description' =>'Payment for invoice ' . format_invoice_number($data['invoiceid']),
        );
        try {
            $response = $gateway->purchase($request_data)->send();
            if ($response->isRedirect()) {
                $this->ci->session->set_userdata(array(
                    'online_payment_amount' => number_format($data['amount'], 2, '.', ''),
                    'currency' => $data['currency']
                ));
                // Add the token to database
                $this->ci->db->where('id', $data['invoiceid']);
                $this->ci->db->update('tblinvoices', array(
                    'token' => $response->getTransactionReference()
                ));
                $response->redirect();
            } else {
                exit($response->getMessage());
            }
        }
        catch (\Exception $e) {
            echo $e->getMessage() . '<br />';
            exit('Sorry, there was an error processing your payment. Please try again later.');
        }
    }
    public function complete_purchase($data)
    {
        $gateway = Omnipay::create('PayPal_Express');
        $gateway->setUsername(trim($this->ci->encryption->decrypt(get_option('paymentmethod_paypal_username'))));
        $gateway->setPassword(trim($this->ci->encryption->decrypt(get_option('paymentmethod_paypal_password'))));
        $gateway->setSignature(trim($this->ci->encryption->decrypt(get_option('paymentmethod_paypal_signature'))));
        $gateway->setTestMode(get_option('paymentmethod_paypal_test_mode_enabled'));
        $response       = $gateway->completePurchase(array(
            'transactionReference' => $data['token'],
            'payerId' => $this->ci->input->get('PayerID'),
            'amount' => $data['amount'],
            'currency' => $data['currency']
        ))->send();
        $paypalResponse = $response->getData();
        return $paypalResponse;
    }
}
