<?php
    include 'APIcall.php';
    $ovh = APICall::Instance('C6ymrPvIUrFQCyOh','Cdm69xSv2Pi2LD1TZOwKpHrlYnMpVjWd','ovh-eu','UVa1VtsaMpNCBLNomMj2TF3Axqr00cxO');


    // function associate_vpsname_to_ip(){
    //
    //
    // }

    $result = $ovh->get_vps_name();
    foreach ($result as $key => $value) {
        $vps_ip[$key] = $ovh->get_vps_ip($value);

    }

    function init_db($result,$vps_ip){
        $dir = 'sqlite:tfe.db';
        $dbh  = new PDO($dir) or die("cannot open the database");
        foreach ($result as $key => $value) {
            $statement = $dbh->prepare("INSERT INTO VPS (vps_name, ip, password, name, last_name, team, class_room) VALUES (:vps_name,:ip,:password,:name,:last_name,:team,:class_room)");
            $statement->execute(array(
              "vps_name" => $value,
              "ip" => $vps_ip[$key],
              "password" => "modify",
              "name" => "modify",
              "last_name" => "modify",
              "team" => "0",
              "class_room" => "modify"
            ));
        }
      }

    function script(){
        shell_exec('bash select.sh');
    }

    function update_db($id,$password,$name,$last_name,$team,$class_room){
      $dir = 'sqlite:tfe.db';
      $dbh = new PDO($dir) or die("cannot open the database");

      $statement = $dbh->prepare("UPDATE VPS SET password=:password, name=:name, last_name=:last_name, team=:team, class_room=:class_room WHERE id=:id");
      $statement->execute(array(
        "id" => $id,
        "password" => $password,
        "name" => $name,
        "last_name" => $last_name,
        "team" => $team,
        "class_room" => $class_room
      ));

      echo json_encode(true);
    }

    function reinit($vps_name){

      $resultt = $ovh->get_vps_template($vps_name);
      $arrayName = array();

      foreach ($resultt as $key => $value) {
        $temp= $ovh->get_template_properties($vps_name,$value);
        $arrayName[] = $temp;
      }

      $data = array();
      $data['vps_name'] = $vps_name;
      $data['os_info'] = $arrayName;

      echo json_encode($data);
   }

  function reinit2($vps_name,$template_id){
      $resulttt = $ovh->reinstall_vps($vps_name,$template_id);
      echo json_encode($resulttt);
  }



  if(isset($_GET)){
    if($_GET['function'] == 'init_db'){
      init_db($result,$vps_ip);
      header("Location: ./index.php");
    }
    if($_GET['function'] == 'script'){
      script();
      header("Location: ./index.php");
    }
    // else
    // {
    //   echo 'erreur';
    // }
  }



    if(isset($_POST)){
      if($_POST['function'] == 'update_db'){
        update_db($_POST['id'],$_POST['password'],$_POST['name'],$_POST['last_name'],$_POST['team'],$_POST['class_room']);
      }
      if($_POST['function'] == 'reinit'){
        reinit($_POST['vps_name']);
      }
      if($_POST['function'] == 'reinit2'){
        reinit2($_POST['vps_name'],$_POST['template_id']);
      }
      //else{
       // echo 'erreur';
      //}
    }
    else{
      echo 'erreur';
      header("Location: ./index.php");
    }
?>
