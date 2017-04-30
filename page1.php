<?php
// page1.php
// session_destroy();
session_start();
  include 'APIcall.php';
  $ovh = new APIcall('C6ymrPvIUrFQCyOh','Cdm69xSv2Pi2LD1TZOwKpHrlYnMpVjWd','ovh-eu','UVa1VtsaMpNCBLNomMj2TF3Axqr00cxO');
   var_dump(serialize($ovh));
   $ovh = unserialize($_SESSION['fakeovh']);
echo 'Bienvenue à la page numéro 1';

$_SESSION['favcolor'] = 'green';
$_SESSION['animal']   = 'okoko';
$_SESSION['time']     = 'look';
$_SESSION['jeje']     = 'heyeh';

// Fonctionne si le cookie a été accepté
echo '<br /><a href="page.php">page 2</a>';

// Ou bien, en indiquant explicitement l'identfiant de session
echo '<br /><a href="page2.php?' . SID . '">page 2</a>';
?>
