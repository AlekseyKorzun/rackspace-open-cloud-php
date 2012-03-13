<?php
namespace Examples;
use Library\Cloud\Server;

/**
 * Sample code for creating back-ups of all servers, this is just proof-of-concept,
 * if you really need to back-up all of your servers you can create back-up
 * schedule using addBackupSchedule() method.
 *
 * @package examples
 * @version 0.2
 * @license bsd
 * @author Aleksey Korzun <al.ko@webfoundation.net>
 * @link http://github.com/AlekseyKorzun/php-cloudservers/
 * @link http://www.alekseykorzun.com
 */
include '../Cloud/Server.php';

// Provide your API ID (username) and API KEY (generated by Rackspace)
DEFINE('API_ID', '');
DEFINE('API_KEY', '');

try {
    // Initialize connection
    $cloud = new Server(API_ID, API_KEY);
    // Retrieve all of available servers
    $servers_response = $cloud->getServers();
    // If list of servers was successfully retrieved we should now have an array
    // of servers that we can loop throught and create back-up images
    $servers = array();
    
    if (property_exists($servers_response, 'servers')) {
      
      foreach($servers_response->servers as $server) {
        $servers[(int) $server->id]['name'] = (string) $server->name;
      }
    }
    
    if (is_array($servers) && !empty($servers)) {
        foreach ($servers as $serverId => $server) {
            // Create back-up images
            if(!$cloud->createImage('Back up for: '. $server['name'], $serverId)) {
                print 'Failed to back up server #: '. $serverId;
            };
        }
    }
    print "<pre>";
    // Get all of created back-up images
    print_r($cloud->getImages());
    print "</pre>";
} catch (Cloud_Exception $e) {
    print $e->getMessage();
}