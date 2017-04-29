<?php include 'connexion_api.php'; ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Template</title>
  </head>
  <body>

    <?php

    $result = $ovh->get('/vps/vps394120.ovh.net/templates');
    echo "<select>";

    foreach ($result as $key => $value) {
      $temp= $ovh->get('/vps/vps394120.ovh.net/templates/'.$value);
      echo "<option value =".$temp['id'].">".$temp['name'].' '.$temp['bitFormat'].' (bits)'."</option>";

    }

      echo "</select>";
    ?>
  </body>
</html>
