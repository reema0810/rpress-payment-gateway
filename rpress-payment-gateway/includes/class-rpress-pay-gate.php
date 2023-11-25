<?php
class RPRESS_Pay_Gate
{
    public function __construct() {
        add_filter('rpress_payment_gateways', array($this, 'rpress_register_gateway'));
        add_action('rpress_sample_gateway_cc_form', array($this, 'rpress_gateway_cc_form'));
        add_action('rpress_gateway_sample_gateway', array($this, 'rpress_process_payment'));
        add_filter('rpress_settings_gateways', array($this, 'rpress_add_settings'));
    }
     public function rpress_register_gateway($gateways) {
        $gateways['sample_gateway'] = array(
            'label'          => 'Sample Gateway',
            'admin_label'    => 'Sample Gateway',
            'checkout_label' => 'Sample Gateway',
        );
        return $gateways;
    }

    public function rpress_gateway_cc_form() {
        echo '<p>Custom payment form for the Sample Gateway.</p>';
    }

    public function rpress_process_payment($purchase_data) {
       
        $is_test_mode = rpress_is_test_mode();

        if ($is_test_mode) {

        } else {

        }

        $errors = rpress_get_errors();
        if (!$errors) {
            
            $payment_data = array(
                'price'          => $purchase_data['price'],
                'date'           => $purchase_data['date'],
                'user_email'     => $purchase_data['user_email'],
                'purchase_key'   => $purchase_data['purchase_key'],
                'currency'       => rpress_get_currency(),
                'downloads'      => $purchase_data['downloads'],
                'cart_details'   => $purchase_data['cart_details'],
                'user_info'      => $purchase_data['user_info'],
                'status'         => 'pending',
            );

            $payment_id = rpress_insert_payment($payment_data);

            $merchant_payment_confirmed = false;

            $merchant_payment_confirmed = true;

            if ($merchant_payment_confirmed) { 
                rpress_update_payment_status($payment_id, 'publish');

                rpress_send_to_success_page();

            } else {
                $fail = true; 
            }

        } else {
            $fail = true; 
        }

        if ($fail !== false) {
            
            rpress_send_back_to_checkout('?payment-mode=' . $purchase_data['post_data']['rpress-gateway']);
        }
    }
    public function rpress_add_settings($settings) {
        $sample_gateway_settings = array(
            array(
                'id'   => 'sample_gateway_settings',
                'name' => '<strong>' . __('Sample Gateway Settings', 'rpress') . '</strong>',
                'desc' => __('Configure the gateway settings', 'rpress'),
                'type' => 'header',
            ),
            array(
                'id'   => 'live_api_key',
                'name' => __('Live API Key', 'rpress'),
                'desc' => __('Enter your live API key, found in your gateway Account Settings', 'rpress'),
                'type' => 'text',
                'size' => 'regular',
            ),
            array(
                'id'   => 'test_api_key',
                'name' => __('Test API Key', 'rpress'),
                'desc' => __('Enter your test API key, found in your gateway Account Settings', 'rpress'),
                'type' => 'text',
                'size' => 'regular',
            ),
        );

        return array_merge($settings, $sample_gateway_settings);
    }
}

    ?>