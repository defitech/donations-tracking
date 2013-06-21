<?php
/**
 * Minimal tests for donations tracking.
 */

// boilerplate setup

$ok = TRUE;
assert_options(ASSERT_CALLBACK, 'assert_handler');
function assert_handler($file, $line, $code, $desc = null)
{
	global $ok;
  $ok = FALSE;
}

require(__DIR__ . "/../source/donations.php");

echo_section("Config");
echo_item("DATA_DIR=" . DATA_DIR);
echo_item("LOG_FILE=" . LOG_FILE);
echo_item("PAYPAL_USE_SANDBOX=" . (PAYPAL_USE_SANDBOX ? "true" : "false"));

// test

$id = 'test';
$totalFile = DATA_DIR . "total-" . $id . ".txt";

cleanup();

echo_section("Donations");

echo_item("Donations::log");
$testMessage = "Test message";
Donations::log($testMessage);
assert(file_get_contents(LOG_FILE) == $testMessage . "\n");

echo_item("Donations::getTotal");
assert(Donations::getTotal($id) == 0);

echo_item("Donations::add");
Donations::add($id, 250.00);
assert(file_exists($totalFile));

echo_item("Donations::getTotal");
assert(Donations::getTotal($id) == 250);

if ($ok) {
	echo "\nTest successful\n";
} else {
	echo "\nTest failed\n";
	exit(1);
}

function echo_section($title) {
  echo "\n# " . $title . "\n";
}

function echo_item($text) {
  echo "  - " . $text . "\n";
}

function cleanup() {
	global $totalFile;
	if (file_exists($totalFile)) {
		unlink($totalFile);
	}
	if (file_exists(LOG_FILE)) {
		unlink(LOG_FILE);
	}
}

?>