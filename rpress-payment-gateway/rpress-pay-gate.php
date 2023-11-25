<?php
//  Plugin Name: RestroPress-payment-gateway
//  Plugin URI: https://www.restropress.com
//  Description: RestroPress is an online ordering system for WordPress.
//  Version: 2.9.8
//  Author: MagniGeeks
//  Author URI: https://magnigeeks.com
//  Text Domain: restropress
//  Domain Path: languages


defined( 'ABSPATH' ) || exit;

if ( !defined( 'RPRESS_Pay_Gate_FILE' ) )
{
	define( 'RPRESS_Pay_Gate_FILE', __FILE__ );
}

if ( !defined( 'RPRESS_Pay_Gate_FILE' ) )
{
	define( 'RPRESS_Pay_Gate_FILE', dirname( __FILE__ ) );
}
if ( !class_exists( 'RPRESS_Pay_Gate' ) ) {
    include_once dirname( __FILE__ ) . '/includes/class-rpress-pay-gate.php';
}
$rpress_pay_gate = new RPRESS_Pay_Gate();
?>