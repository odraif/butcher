<?php 
session_start();

include_once("../model/db.php");

$email = mysqli_escape_string($conx, $_SESSION["email"]);

$updateQuery="UPDATE user SET DocName = 'vide' WHERE Email = '$email'";

if(!mysqli_query($conx,$updateQuery)){
    echo "error ". mysqli_error($conx);
}else{

    $file_pointer = "../uploads/". $_SESSION["doc"]; 
  
  // Use unlink() function to delete a file 
  if (!unlink($file_pointer)) { 
    $_SESSION["msg"]="<span class='failed alert'>L'image n'a été supprimer du dossier</span>";
    header("location:../profile");
  } 
  else { 
      $_SESSION["doc"]="vide";
      $_SESSION["msg"]="<span class='success alert'>L'image a été supprimer avec successé</span>";
      header("location:../profile");
  } 

}