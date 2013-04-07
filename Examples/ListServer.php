<?php
/**
 * Sample code for listing current servers.
 *
 * @package Cloud
 * @subpackage Cloud\Examples
 * @version 0.3
 * @license bsd
 * @author Aleksey Korzun <al.ko@webfoundation.net>
 * @link http://github.com/AlekseyKorzun/php-cloudservers/
 * @link http://www.alekseykorzun.com
 */

/**
 * You must run `composer install` in order to generate autoloader for this example
 */
require __DIR__ . '/../vendor/autoload.php';

// Provide your API ID (username) and API KEY (generated by Rackspace)
DEFINE('API_ID', '');
DEFINE('API_KEY', '');

try {
	// Initialize connection
	$cloud = new Cloud\Server(API_ID, API_KEY);

	// Retrieve all of available servers with full details
	$response = $cloud->getServers(true);

	// If list of servers was successfully retrieved we should now have number
	// of servers that we can loop throught
	if ($response) {
		foreach ($response->servers as $server) {
			print "Server id: {$server->id} \n";
			print_r($server);
			print "\n";
		}
	}
} catch (Exception $exception) {
	print $exception->getMessage();
}

