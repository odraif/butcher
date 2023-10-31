<?php
session_start();

if (!$_SESSION && empty($_SESSION["msg"])) {
header("location: ../");
}
include_once("../model/db.php");

if (!empty($_GET)) {
    $id = mysqli_real_escape_string($conx, $_GET["s"]);


    $get_user = "SELECT * FROM user WHERE id = '$id'";
    $user_result = mysqli_query($conx, $get_user);

    if (!$user_result) {
        $_SESSION['msg'] = "<span class='failed alert'>Nous n'avons pas pu charger cet utilisateur</span>";
        http_response_code(404);
        header("location:../dashboard/");

    } else {
        $result = mysqli_fetch_assoc($user_result);

        $_SESSION['target_id'] = $result["id"];
        $_SESSION['target_name'] = $result["Nom"];
        $_SESSION['target_phone'] = $result["N_Telephone"];
        $_SESSION['target_email'] = $result["Email"];
        $_SESSION['target_doc'] = $result["DocName"];
        $_SESSION['target_valider'] = $result["Valider"];
        http_response_code(200);
        mysqli_close($conx);
        header("location:../dashboard/profile.php");

    }
}


if (!empty($_POST)) {
    echo "it a post with user id:".$_SESSION['target_id']."<br>";
    print_r($_POST);
    echo "<br>";

if (!empty($_POST['password'])) {
    echo "is password update<br>";
    $id = mysqli_real_escape_string($conx, $_POST["id"]);
    $name = mysqli_real_escape_string($conx, $_POST["Nom"]);
    $email = mysqli_real_escape_string($conx, $_POST["Email"]);
    $phone = mysqli_real_escape_string($conx, $_POST["N_telephone"]);
    $valid = mysqli_real_escape_string($conx, $_POST["valid"]);
    $password = mysqli_real_escape_string($conx, password_hash($_POST['password'], PASSWORD_DEFAULT));
    

    $updateQuery = "UPDATE user SET Nom = '$name'  , N_Telephone = '$phone' ,Email = '$email', Password = '$password' , Valider='$valid' WHERE id = '$id'";
    
    if (!mysqli_query($conx, $updateQuery)) {
        http_response_code(400);
        echo "Error inserting the data:" . mysqli_error($conx) . "<br>";
        mysqli_close($conx);


    } else {
        $_SESSION['target_name'] = $name;
        $_SESSION['target_phone'] = $phone;
        $_SESSION['target_valider'] = $valid;
        $_SESSION['msg'] = "<span class='success alert'>Le formulaire est valider</span>";
        mysqli_close($conx);
        header("location: ../dashboard/profile.php");
    }

}
if (empty($_POST['password'])) {
    echo "is not  password update<br>";

    $id = mysqli_real_escape_string($conx, $_POST["id"]);
    $name = mysqli_real_escape_string($conx, $_POST["Nom"]);
    $email = mysqli_real_escape_string($conx, $_POST["Email"]);
    $phone = mysqli_real_escape_string($conx, $_POST["N_telephone"]);
    $valid = mysqli_real_escape_string($conx, $_POST["valid"]);

    echo "All the values are converted<br>";

    $updateQuery = "UPDATE user SET Nom = '$name', N_Telephone = '$phone', Email = '$email', Valider='$valid' WHERE id = '$id'";

    echo "the sql query is ready<br>";

    if (!mysqli_query($conx, $updateQuery)) {
        http_response_code(400);
        echo "Error inserting the data:" . mysqli_error($conx) . "<br>";
        mysqli_close($conx);

    } else {
        $_SESSION['target_name'] = $name;
        $_SESSION['target_phone'] = $phone;
        $_SESSION['target_valider'] = $valid;
        $_SESSION['msg'] = "<span class='success alert'>Le formulaire est valider</span>";
        mysqli_close($conx);
        header("location: ../dashboard/profile.php");
        echo "done<br>";
    }
}


}

