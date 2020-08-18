<?php

use Mollie\Api\MollieApiClient;

/*
 * Make sure to disable the display of errors in production code!
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/../../../autoload.php";

/*
 * Initialize the Mollie API library with your API key.
 *
 * See: https://www.mollie.com/dashboard/settings/profiles
 */

$mollie = new \Mollie\Api\MollieApiClient();
$mollie->setApiKey("test_zAEBcgkvS9FA9KnJFcjn5mhKp9be7J");




