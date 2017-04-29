<?php
// page1.php

session_start();

echo 'Bienvenue à la page numéro 1';

$_SESSION['favcolor'] = 'green';
$_SESSION['animal']   = 'cat';
$_SESSION['time']     = time();

// Fonctionne si le cookie a été accepté
echo '<br /><a href="page2.php">page 2</a>';

// Ou bien, en indiquant explicitement l'identfiant de session
echo '<br /><a href="page2.php?' . SID . '">page 2</a>';
?>
