<?php
/**
 * First, download the latest release of PHP wrapper on github
 * And include this script into the folder with extracted files
 */
require __DIR__ . '/vendor/autoload.php';
use \Ovh\Api;

/**
 * Instanciate an OVH Client.
 * You can generate new credentials with full access to your account on
 * the token creation page
 */
$ovh = new Api( 'C6ymrPvIUrFQCyOh',  // Application Key
                'Cdm69xSv2Pi2LD1TZOwKpHrlYnMpVjWd',  // Application Secret
                'ovh-eu',      // Endpoint of API OVH Europe (List of available endpoints)
                'UVa1VtsaMpNCBLNomMj2TF3Axqr00cxO'); // Consumer Key

?>
