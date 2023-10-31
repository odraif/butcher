<?php
session_start();

include_once("../model/db.php");

if($_GET['id']){
    $id = mysqli_escape_string($conx, $_GET['id']);
    $updateQuery="DELETE FROM user WHERE id = '$id'";

    if(!mysqli_query($conx,$updateQuery)){
        echo "".mysqli_error($conx);
    }else{
        $_SESSION["msg"]="<span class='success alert'>Supprimer avec successé</span>";
        header("location:../dashboard/");
    }
}
