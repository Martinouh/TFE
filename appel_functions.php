  <?php
  session_start();
    include 'APIcall.php';

    $vps_ip;
    $result;


    function init_db($result,$vps_ip){
        $dir = 'sqlite:tfe.db';
        $dbh  = new PDO($dir) or die("cannot open the database");
        foreach ($result as $key => $value) {
            $statement = $dbh->prepare("INSERT INTO VPS (nom_vps, ip, password, prenom, nom, classe) VALUES (:nom_vps,:ip,:password,:prenom,:nom,:classe)");
            $statement->execute(array(
              "nom_vps" => $value,
              "ip" => $vps_ip[$key+1][0],
              "password" => "modify",
              "prenom" => "modify",
              "nom" => "modify",
              "classe" => "modify"
            ));
        }
      }

    function script(){
        shell_exec('bash select.sh');
    }

    function update_db($id,$password,$prenom,$nom,$classe){
      $dir = 'sqlite:tfe.db';
      $dbh = new PDO($dir) or die("cannot open the database");

      $statement = $dbh->prepare("UPDATE VPS SET password=:password, prenom=:prenom, nom=:nom, classe=:classe WHERE id=:id");
      $statement->execute(array(
        "id" => $id,
        "password" => $password,
        "prenom" => $prenom,
        "nom" => $nom,
        "classe" => $classe
      ));

      echo json_encode(true);

      // $sql="select * from VPS";
      //
      // $stmt = $dbh->prepare($sql);
      // $stmt->execute();
      // $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // echo json_encode($res); //renvoie vers le JS
    }

    function reinit($nom_vps){

      global $ovh;

      $result = $ovh->get('/vps/'.$nom_vps.'/templates');

      $arrayName = array();



      foreach ($result as $key => $value) {
        $temp= $ovh->get('/vps/'.$nom_vps.'/templates/'.$value);
        $arrayName[] = $temp;
      }

      $data = array();
      $data['nom_vps'] = $nom_vps;
      $data['os_info'] = $arrayName;

      echo json_encode($data);
   }

  function reinit2($nom_vps,$option_value){

    global $ovh;

    $result = $ovh->post('/vps/'.$nom_vps.'/reinstall', array(
    'doNotSendPassword' => false, // If asked, the installation password will NOT be sent (only if sshKey defined) (type: boolean)
    'templateId' => $option_value, // Required: Id of the vps.Template fetched in /templates list (type: long)
    ));

    echo json_encode($result);
  }



    if(isset($_GET)){
      if($_GET['function'] == 'init_db'){
        // $ovh = $_SESSION['ovh'];

        $result = $_SESSION['ovh']->get_vps_name();
        foreach ($result as $key => $value) {
            $vps_ip[$key] = $_SESSION['ovh']->get_vps_ip($value);
        }

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
        update_db($_POST['id'],$_POST['password'],$_POST['prenom'],$_POST['nom'],$_POST['classe']);
      }
      if($_POST['function'] == 'reinit'){
        reinit($_POST['nom_vps']);
      }
      if($_POST['function'] == 'reinit2'){
        reinit2($_POST['nom_vps'],$_POST['option_value']);
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
