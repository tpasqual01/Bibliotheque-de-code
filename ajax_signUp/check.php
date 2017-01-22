<?php

if(!empty($_POST['pseudo']))
{
  extract($_POST);
  $pseudo = strip_tags($pseudo);
  
  try{
  $bdd = new PDO('mysql:host=localhost;dbname=tuto', 'root', '') or die(print_r($bdd->errorInfo()));
  $bdd->exec('SET NAMES utf8');
  }
  
  catch(Exeption $e){
  die('Erreur:'.$e->getMessage());
  }
  
  $req = $bdd->prepare('SELECT id FROM membres WHERE pseudo=:pseudo');
  $req->execute(array(':pseudo'=>$pseudo));
  
  if($req->rowCount()>0)
  {
    $status = 'error';
    $message = 'Pseudo indisponible';
  }
  else
  {
    $status = 'success';
    $message = 'Pseudo disponible';
  }
  
}
else
{
  $status = 'error';
  $message = 'Indiquez un pseudo';
}

$data = array('status'=>$status, 'message'=>$message);

echo json_encode($data);

?>