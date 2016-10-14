<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Stripe extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('gateways/stripe_gateway');
    }

    public function complete_purchase()
    {
        if ($this->input->post()) {
                $data      = $this->input->post();
                $total     = $this->input->post('total');
                $this->load->model('invoices_model');
                $invoice             = $this->invoices_model->get($this->input->post('invoiceid'));
                check_invoice_restrictions($invoice->id, $invoice->hash);
                load_client_language($invoice->clientid);
                $data['amount']      = $total;
                $data['description'] = 'Payment for invoice ' . format_invoice_number($invoice->id);
                $data['currency']    = $invoice->currency_name;
                $data['clientid']    = $invoice->clientid;
                $oResponse      = $this->stripe_gateway->finish_payment($data);
                if ($oResponse->isSuccessful()) {
                   $transactionid  = $oResponse->getTransactionReference();
                   $oResponse = $oResponse->getData();
                   if ($oResponse['status'] == 'succeeded') {
                    // Add payment to database
                    $payment_data['amount']        = ($oResponse['amount'] / 100);
                    $payment_data['invoiceid']     = $invoice->id;
                    $payment_data['paymentmode']   = 'stripe';
                    $payment_data['transactionid'] = $transactionid;
                    $this->load->model('payments_model');
                    $success = $this->payments_model->add($payment_data);
                    if ($success) {
                        set_alert('success', _l('online_payment_recorded_success'));
                    } else {
                        set_alert('danger', _l('online_payment_recorded_success_fail_database'));
                    }
                    redirect(site_url('viewinvoice/' . $invoice->id . '/' . $invoice->hash));
                }
            } elseif ($oResponse->isRedirect()) {
                $oResponse->redirect();
            } else {
                set_alert('danger', $oResponse->getMessage());
                redirect(site_url('viewinvoice/' . $invoice->id . '/' . $invoice->hash));
            }
        }
    }
    public function make_payment()
    {
        $form      = '';
        $hash      = $this->input->get('hash');
        $invoiceid = $this->input->get('invoiceid');
        check_invoice_restrictions($invoiceid, $hash);

        $this->load->model('invoices_model');
        $invoice      = $this->invoices_model->get($invoiceid);
        load_client_language($invoice->clientid);
        $total        = $this->input->get('total');
        $stripe_total = $total * 100;
        $data['title'] = _l('payment_for_invoice') . ' ' . format_invoice_number($invoice->id);
        $form .= '
        <form action="' . site_url('gateways/stripe/complete_purchase') . '" method="POST">
            <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="' . trim(get_option('paymentmethod_stripe_api_publishable_key')) . '"
            data-amount="' . $stripe_total . '"
            data-name="' . get_option('companyname') . '"
            data-description="Payment for invoice ' . format_invoice_number($invoice->id) . '";
            data-locale="auto"
            data-currency="'.$invoice->currency_name.'"
            >
        </script>
                '.form_hidden('invoiceid',$invoiceid).'
                '.form_hidden('total',$total).'
            </form>';
            $data['stripe_form']  = $form;
            $data['invoice']      = $invoice;
            $data['total']        = $total;
            $data['stripe_total'] = $total;
            $this->load->view('themes/' . active_clients_theme() . '/views/stripe_payment', $data);
        }
    }
