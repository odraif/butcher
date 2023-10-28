<?php
session_start();
include_once("../model/db.php");


if (!empty($_POST)) {
    $email = mysqli_real_escape_string($conx, $_POST["email"]);
    $password = mysqli_real_escape_string($conx, $_POST["password"]);

    $get_user = "SELECT * FROM user WHERE Email = '$email'";
    $user_result = mysqli_query($conx, $get_user);

    if (!$user_result) {
        $_SESSION['msg']= "<span class='failed alert'>Votre email ou mot de passe est incorrect</span>";
        http_response_code(404);
        header("location:../");

    } else {
        $result = mysqli_fetch_assoc($user_result);

        if (password_verify($password, $result["Password"])) {

            

            $_SESSION['name'] = $result["Nom"];
            $_SESSION['phone'] = $result["N_Telephone"];
            $_SESSION['email'] = $result["Email"];
            $_SESSION['doc'] = $result["DocName"];

            if ($result["isAdmin"]) {
                echo "is an admin";
            } else {
                header("location:../profile/");
            }
        } else {
            $_SESSION['msg']= "<span class='failed alert'>Votre email ou mot de passe est incorrect</span>";
            http_response_code(404);
            header("location:../");
        }


    }
}

?>