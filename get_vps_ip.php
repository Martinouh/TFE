<?php

/**
  * Retourne l'IPv4 & v6 d'un vps dans un array
  * Ex: $ovh->get('/vps/vps394120.ovh.net/ips') retourne;
  *["51.255.160.103","2001:41d0:302:2100:0000:0000:0000:1ece"]
**/

/**
  * Crée une variable $vps_ip[i] contenant l'IPv4 & v6 de tous les vps
**/
foreach ($result as $key => $value) {
    $vps_ip[($key+1)] = $ovh->get('/vps/'.$value.'/ips');
}

?>
