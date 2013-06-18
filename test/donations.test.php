<?php
/**
 * Minimal tests for donations tracking.
 */

// testing boilerplate

$ok = TRUE;
assert_options(ASSERT_CALLBACK, 'assert_handler');
function assert_handler($file, $line, $code, $desc = null)
{
	global $ok;
  $ok = FALSE;
}

echo_section("Donations");

require(__DIR__ . "/../source/donations.php");

$id = 'test';
$logFile = __DIR__ . "/../source/data/donations.log";
$totalFile = __DIR__ . "/../source/data/total-" . $id . ".txt";

// test

cleanup();

echo_item("Donations::log");
$testMessage = "Test message";
Donations::log($testMessage);
assert(file_get_contents($logFile) == $testMessage . "\n");

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
	global $totalFile, $logFile;
	if (file_exists($totalFile)) {
		unlink($totalFile);
	}
	if (file_exists($logFile)) {
		unlink($logFile);
	}
}

?>