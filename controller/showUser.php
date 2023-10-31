<?php
session_start();
include_once("../model/db.php");

if(!empty($_GET["view"])){
    $_SESSION['view']= $_GET['view'];
}else{
    $_SESSION['view'] = 'all';
}



switch ($_SESSION['view']) {
    case "non":
        $get_users = "SELECT * FROM user WHERE Valider = 'non'";
        $users_result = mysqli_query($conx, $get_users);

        if (!$users_result) {
            $_SESSION['msg'] = "<span class='failed alert'>Erreur lors du chargement du tableau</span>";
            http_response_code(400);
            header("location:../");

        } else {
            $results = mysqli_fetch_all($users_result, MYSQLI_ASSOC);
            mysqli_close($conx);
        }
        break;
    case "oui":
        $get_users = "SELECT * FROM user WHERE Valider = 'oui'";
        $users_result = mysqli_query($conx, $get_users);

        if (!$users_result) {
            $_SESSION['msg'] = "<span class='failed alert'>Erreur lors du chargement du tableau</span>";
            http_response_code(400);
            header("location:../");

        } else {
            $results = mysqli_fetch_all($users_result, MYSQLI_ASSOC);
            mysqli_close($conx);
        }
        break;

    default:
        $get_users = "SELECT * FROM user ";
        $users_result = mysqli_query($conx, $get_users);

        if (!$users_result) {
            $_SESSION['msg'] = "<span class='failed alert'>Erreur lors du chargement du tableau</span>";
            http_response_code(400);
            header("location:../");

        } else {
            $results = mysqli_fetch_all($users_result, MYSQLI_ASSOC);
            mysqli_close($conx);
        }

}