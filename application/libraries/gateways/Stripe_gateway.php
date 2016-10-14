<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Omnipay\Omnipay;
require_once(APPPATH . 'third_party/omnipay/vendor/autoload.php');
class Stripe_gateway
{
    function __construct()
    {
        $this->ci =& get_instance();
    }
    public function make_purchase($data)
    {
        redirect(site_url('gateways/stripe/make_payment?invoiceid=' . $data['invoiceid'] . '&total=' . $data['amount'] . '&hash=' . $data['invoice']->hash));
    }
    public function finish_payment($data){
        // Process online for PayPal payment start
        $gateway = Omnipay::create('Stripe');
        $gateway->setApiKey(trim($this->ci->encryption->decrypt(get_option('paymentmethod_stripe_api_secret_key'))));
        $oResponse = $gateway->purchase(array(
            'amount' => number_format($data['amount'], 2, '.', ''),
            'metadata' => array(
                'ClientID' => $data['clientid']
            ),
            'description' => $data['description'],
            'currency' => $data['currency'],
            'token' => $data['stripeToken']
        ))->send();
       return $oResponse;
    }
}
