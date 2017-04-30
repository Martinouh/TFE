<?php
    include 'APIcall.php';
    include 'mes_fonctions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Monitoring VPS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="./CSS/design.css">
  <link rel="stylesheet" href="./jquery-modal-master/jquery.modal.css" type="text/css" media="screen" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>

function myFunction() {
// Declare variables
var input, filter, table, tr, td, i;
input = document.getElementById("myInput");
filter = input.value.toUpperCase();
table = document.getElementById("myTable");
tr = table.getElementsByTagName("tr");

// Loop through all table rows, and hide those who don't match the search query
for (i = 0; i < tr.length; i++) {
td = tr[i].getElementsByTagName("td")[5];
if (td) {
  if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
    tr[i].style.display = "";
  } else {
    tr[i].style.display = "none";
  }
}
}
}
function sortTable() {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("myTable");
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[0];
      y = rows[i + 1].getElementsByTagName("TD")[0];
      //check if the two rows should switch place:
      if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
        //if so, mark as a switch and break the loop:
        shouldSwitch= true;
        break;
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}
</script>
</head>
<body>

   <div id="ex1" style="display:none;">
   <div id=form_reinit>  </div><a href="#" rel="modal:close">Close</a>
   </div>

    <a href='./appel_functions.php?function=init_db'><button>Initialiser la BD</button></a>
    <a href='./appel_functions.php?function=script'><button>Test</button></a>
    
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
    <?php

        $dir = 'sqlite:tfe.db';
        $dbh  = new PDO($dir) or die("cannot open the database");

        $sql="select * from VPS";

        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        creeTableau($res,'All VPS');





     ?>


     <script type="text/javascript" src="./JS/script.js"></script>
     <script src="./jquery-modal-master/jquery.modal.min.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>
