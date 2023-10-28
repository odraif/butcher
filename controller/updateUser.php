<?php
session_start();

include_once("../model/db.php");


if (!empty($_POST)) {

    if (empty($_POST["doc"]) && !empty($_POST['password'])) {
        $name = mysqli_real_escape_string($conx, $_POST["Nom"]);
        $email = mysqli_real_escape_string($conx, $_SESSION["email"]);
        $phone = mysqli_real_escape_string($conx, $_POST["N_telephone"]);
        $password = mysqli_real_escape_string($conx, password_hash($_POST['password'], PASSWORD_DEFAULT));


        $updateQuery = "UPDATE user SET Nom = '$name'  , N_Telephone = '$phone' , Password = '$password' WHERE Email = '$email'";

        if (!mysqli_query($conx, $updateQuery)) {
            http_response_code(400);
            echo "Error inserting the data:" . mysqli_error($conx) . "<br>";
            mysqli_close($conx);


        } else {
            $_SESSION['name'] = $name;
            $_SESSION['phone'] = $phone;
            $_SESSION['msg'] = "<span class='success alert'>Le formulaire est valider</span>";
            header("location: ../profile/");
        }

    }
    if (empty($_POST["doc"]) && empty($_POST['password'])) {
        $name = mysqli_real_escape_string($conx, $_POST["Nom"]);
        $email = mysqli_real_escape_string($conx, $_SESSION["email"]);
        $phone = mysqli_real_escape_string($conx, $_POST["N_telephone"]);

        $updateQuery = "UPDATE user SET Nom = '$name'  , N_Telephone = '$phone'  WHERE Email = '$email'";

        if (!mysqli_query($conx, $updateQuery)) {
            http_response_code(400);
            echo "Error inserting the data:" . mysqli_error($conx) . "<br>";
            mysqli_close($conx);


        } else {
            $_SESSION['name'] = $name;
            $_SESSION['phone'] = $phone;
            $_SESSION['msg'] = "<span class='success alert'>Le formulaire est valider</span>";
            header("location: ../profile/");
        }
    }

    if (!empty($_FILES["doc"]) && empty($_POST['password'])) {

        // Define the target directory for the uploaded file.
        $target_dir = "../uploads/";

        $fileName = date("now") . '_' . basename($_FILES["doc"]["name"]);
        // Get the name of the uploaded file.
        $target_file = $target_dir . $fileName;

        // Check if the uploaded file is a valid image file.
        $FileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if ($FileType != "jpg" && $FileType != "png" && $FileType != "jpeg" && $FileType != "pdf") {
            $_SESSION['msg'] = "<span class='failed alert'>Désolé, seuls les fichiers JPG, JPEG, PDF et PNG sont autorisés</span>";
            exit();
        }

        // Check if the uploaded file is too large.
        if ($_FILES["doc"]["size"] > 2097152) {
            $_SESSION['msg'] = "<span class='failed alert'>Désolé, votre fichier est trop volumineux. Le maximum est de 2 Mo</span>";
            exit();
        }

        // Move the uploaded file to the target directory.
        if (move_uploaded_file($_FILES["doc"]["tmp_name"], $target_file)) {
            $_SESSION['msg'] = "<span class='success alert'>Le formulaire est valider</span>";

            $name = mysqli_real_escape_string($conx, $_POST["Nom"]);
            $email = mysqli_real_escape_string($conx, $_SESSION["email"]);
            $phone = mysqli_real_escape_string($conx, $_POST["N_telephone"]);
            $doc = mysqli_real_escape_string($conx, $fileName);

            $updateQuery = "UPDATE user SET Nom = '$name'  , N_Telephone = '$phone' , DocName = '$doc'  WHERE Email = '$email'";

            if (!mysqli_query($conx, $updateQuery)) {
                http_response_code(400);
                echo "Error inserting the data:" . mysqli_error($conx) . "<br>";
                mysqli_close($conx);

            } else {
                $_SESSION['name'] = $name;
                $_SESSION['phone'] = $phone;
                $_SESSION['doc'] = $doc;
                $_SESSION['msg'] = "<span class='success alert'>Le formulaire est valider</span>";
                header("location: ../profile/");
            }
        } else {
            //$_SESSION['msg'] = "<span class='failed alert'>Désolé, il y a eu une erreur lors du téléchargement de votre fichier</span>";
            $_SESSION['msg'] = "<span class='failed alert'>Désolé, votre fichier est trop volumineux. Le maximum est de 2 Mo</span>";
        }

    }

} else {
    http_response_code(400);
}