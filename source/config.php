<?php

/**
 * Path of the directory where donations tracking files are stored
 */
define("DATA_DIR", __DIR__ . "/data/");

/**
 * Path of the log file
 */
define("LOG_FILE", DATA_DIR . "donations.log");

/**
 * Whether to use the PayPal sandbox (i.e. test) mode
 */
define("PAYPAL_USE_SANDBOX", false);

?>