<?php
    include 'APIcall.php';

    $ovh = new APIcall('C6ymrPvIUrFQCyOh','Cdm69xSv2Pi2LD1TZOwKpHrlYnMpVjWd','ovh-eu','UVa1VtsaMpNCBLNomMj2TF3Axqr00cxO');

    $vps_name_array = $ovh->get_vps_name();

    print_r($vps_name_array);
 ?>
