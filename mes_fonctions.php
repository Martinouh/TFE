<?php






    function creeTableau($tab,$table_title){

        $mon_tab =  "<table id=myTable>";
        $mon_tab .= "<caption>$table_title</caption>";
        $mon_tab .= "<tr>";
        $mon_tab .= "<th>id</th>";
        $mon_tab .= "<th>nom_vps</th>";
        $mon_tab .= "<th>IP</th>";
        $mon_tab .= "<th>password</th>";
        $mon_tab .= "<th onclick=sortTable(0)>prenom</th>";
        $mon_tab .= "<th onclick=sortTable(1)>nom</th>";
        $mon_tab .= "<th>classe</th>";
        $mon_tab .= "<th></th>";
        $mon_tab .= "<th></th>";
        $mon_tab .= "</tr>";

        foreach ($tab as $n => $entree) {
            $mon_tab .= "<tr>";
            $mon_tab .= "<td>".$entree['id']."</td>";
            $mon_tab .= "<td class=".$entree['id'].">".$entree['nom_vps']."</td>";
            $mon_tab .= "<td>".$entree['ip']."</td>";
            $mon_tab .= "<td><input class=".$entree['id']." type=text name='password' value=".$entree['password']."></td>";
            $mon_tab .= "<td><input class=".$entree['id']." type=text name='prenom' value=".$entree['prenom']."></td>";
            $mon_tab .= "<td><input class=".$entree['id']." type=text name='nom' value=".$entree['nom']."></td>";
            $mon_tab .= "<td><input class=".$entree['id']." type=text name='classe' value=".$entree['classe']."></td>";
            $mon_tab .= "<td><button id=".$entree['id']." value=modifier>Modifier</button>  </td>";
            $mon_tab .= "<td><a href=#ex1 rel=modal:open><button class=".$entree['id']." value=init>Réinstaller</button></a></td>";
            $mon_tab .= "</tr>";
        }

        $mon_tab .= "</table>";
        echo $mon_tab;
    }
 ?>
