<?php
/**
 * Simple PayPal IPN listener.
 */
 
require("donations.php");
require("ipnlistener.php");

include("config.php");

$listener = new IpnListener();
$listener->use_sandbox = PAYPAL_USE_SANDBOX || false;

try {
  $verified = $listener->processIpn();
} catch (Exception $e) {
  Donations::log("Fatal error trying to process IPN: " . $e->getMessage());
  exit(0);
}

Donations::log($listener->getTextReport());

if ($verified) {
  // IPN response was "VERIFIED"
	Donations::add($_REQUEST["item_number"], $_REQUEST["mc_gross"]);
}

?>