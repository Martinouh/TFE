<?php

    function creeTableau($tab,$table_title){

        $mon_tab =  "<table id=myTable>";
        $mon_tab .= "<caption>$table_title</caption>";
        $mon_tab .= "<tr>";
        $mon_tab .= "<th>id</th>";
        $mon_tab .= "<th>vps_name</th>";
        $mon_tab .= "<th>IP</th>";
        $mon_tab .= "<th>password</th>";
        $mon_tab .= "<th onclick=sortTable(0)>name</th>";
        $mon_tab .= "<th onclick=sortTable(1)>last_name</th>";
        $mon_tab .= "<th>team</th>";
        $mon_tab .= "<th>class_room</th>";
        $mon_tab .= "<th></th>";
        $mon_tab .= "<th></th>";
        $mon_tab .= "</tr>";

        foreach ($tab as $n => $entree) {
            $mon_tab .= "<tr>";
            $mon_tab .= "<td>".$entree['id']."</td>";
            $mon_tab .= "<td class=".$entree['id'].">".$entree['vps_name']."</td>";
            $mon_tab .= "<td>".$entree['ip']."</td>";
            $mon_tab .= "<td><input class=".$entree['id']." type=text name='password' value=".$entree['password']."></td>";
            $mon_tab .= "<td><input class=".$entree['id']." type=text name='name' value=".$entree['name']."></td>";
            $mon_tab .= "<td><input class=".$entree['id']." type=text name='last_name' value=".$entree['last_name']."></td>";
            $mon_tab .= "<td><input class=".$entree['id']." type=text name='team' value=".$entree['team']."></td>";
            $mon_tab .= "<td><input class=".$entree['id']." type=text name='class_room' value=".$entree['class_room']."></td>";
            $mon_tab .= "<td><button id=".$entree['id']." value=modify>Modify</button>  </td>";
            $mon_tab .= "<td><a href=#ex1 rel=modal:open><button class=".$entree['id']." value=init>Reinstall</button></a></td>";
            $mon_tab .= "</tr>";
        }

        $mon_tab .= "</table>";
        echo $mon_tab;
    }
 ?>
