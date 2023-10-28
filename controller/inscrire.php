<?php
include_once("../model/db.php");


if (!empty($_POST)) {
    $name = mysqli_real_escape_string($conx, $_POST["name"]);
    $email = mysqli_real_escape_string($conx, $_POST["email"]);
    $phone = mysqli_real_escape_string($conx, $_POST["phone"]);
    $password = mysqli_real_escape_string($conx,password_hash($_POST['password'], PASSWORD_DEFAULT));
    $date = mysqli_real_escape_string($conx, date("Y-m-d H:i:s"));

    $insertValues = "INSERT INTO user (Nom,Email,N_Telephone,Password,DocName,isAdmin,reg_date) VALUES ('$name','$email','$phone','$password','vide',0,'$date')";

    if (!mysqli_query($conx, $insertValues)) {

        echo "Error inserting the data:" . mysqli_error($conx) . "<br>";
        mysqli_close($conx);


    } else {

        http_response_code(200);


        $get_user = "SELECT * FROM user WHERE Email = '$email'";
        $user_result = mysqli_query($conx, $get_user);

        if (!$user_result) {

            http_response_code(404);
            header("location:../");
            
        } else {

            $result = mysqli_fetch_assoc($user_result);
            session_start();

            $_SESSION['name'] = $name;
            $_SESSION['phone'] = $phone;
            $_SESSION['email'] = $email;
            $_SESSION['doc'] =  $result["DocName"];
            $_SESSION['msg']= "<span class='success alert'>Bienvenue, ".$name." </span>";

            if ($result["isAdmin"]) {
                echo "is an admin";
            } else {
                header("location:../profile/");
            }
        }

    }
} else {
    echo "Not post was founded! <br>";
    http_response_code(400);
}

?>
