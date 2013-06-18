<?php
// storage constants
if (! defined("DATA_DIR")) {
	define("DATA_DIR", __DIR__ . "/data/");
}
if (! defined("LOG_FILE")) {
	define("LOG_FILE", DATA_DIR . "donations.log");
}

/**
 * Manages basic donations tracking.
 * 
 * - track total donations per campaign (campaign id = "item_number" in PayPal API).
 * - expose logging function
 */
class Donations {
	public static function log($msg) {
		file_put_contents(LOG_FILE, $msg . "\n", FILE_APPEND);
	}

	public static function add($campaignId, $amount) {
		$curTotal = self::getTotal($campaignId);
		self::setTotal($campaignId, $curTotal + $amount);
	}

	public static function getTotal($campaignId) {
		$totalFile = self::getTotalFile($campaignId);

  	if (! file_exists($totalFile)) {
   		return 0.0;
  	}
  
  	try {
	  	return (float)file_get_contents($totalFile);
		} catch (Exception $e) {
			$backupFile = $totalFile . ".bak";
			rename($totalFile, $backupFile);
			self::log("Error reading donations total; file renamed to " . $backupFile . ": " . $e->getMessage());
			return 0.0;
  	}
	}

	private static function setTotal($campaignId, $total) {
	  file_put_contents(self::getTotalFile($campaignId), $total);
	}

	private static function getTotalFile($campaignId) {
  	return DATA_DIR . "total-" . $campaignId . ".txt";
	}
}

?>