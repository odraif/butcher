<?php
session_start();


if (!$_SESSION && empty($_SESSION["msg"])) {

    header("location: ../");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../images/a-03.ico" type="image/x-icon">
    <title>Profile</title>
</head>
<body>
    <div class="profile-client">
        <header>
            <nav>
                <div class="logo">
                    <img src="../asset/logo.png" alt="">
                </div>
                <div class="logout-btn">
                <button id="logout">Deconnecter</button>
                </div>
            </nav>
        </header>
        <?php
        if (!empty($_SESSION["msg"])) {
            echo "" . $_SESSION["msg"] . "";
            $_SESSION["msg"] = "";
        }
        ?>
        <div class="client-form">
            <form action="../controller/updateUser.php" method="POST" enctype="multipart/form-data" onsubmit="submitForm(event)">
                <div class="group-input">
                    <label for="Nom">Nom et prénom:</label>
                    <input type="text" name="Nom" id="Nom" value='<?php echo $_SESSION['name'] ?>' >
                </div>
                <div class="group-input">
                    <label for="Email">Email:</label>
                    <input type="text" name="Email" id="Email" value='<?php echo $_SESSION['email'] ?>' disabled>
                </div>
                <div class="group-input">
                    <label for="Numero de telephone">Numero de telephone:</label>
                    <input type="text" name="N_telephone" id="N_telephone" value='<?php echo $_SESSION['phone'] ?>' >
                </div>
                <div class="group-input">
                    <label for="Numero de telephone">Mot de passe:</label>
                    <input type="password" name="password" id="password"  >
                </div>
                <div class="group-input">
                    <label for="Numero de telephone">Confimer mot de passe:</label>
                    <input type="password" id="Cpassword"  >
                    <span id="alert"></span>
                </div>
                <?php if (!$_SESSION['doc'] || $_SESSION['doc'] == "vide") { ?>
                                    <div class="file-upload">
                                    <label for="paiement">Reçu de paiement:</label>
                                        <input type="file" value="paiement" name="doc" id="doc">
                                    </div>
                <?php } else {
                    if (!strpos($_SESSION['doc'], '.pdf')) {
                        ?>
                                        <div>
                                            <div>
                                            <label for="paiement">Reçu de paiement:</label>
                                                <img src='<?php echo '../uploads/' . $_SESSION['doc']; ?>' alt="" style="width:100px">
                                                <button id="deleteFile" type="button">supprimer</button>
                                            </div>
                                        </div>
                    <?php } else {
                        ?>
                            <div>
                                <div>
                                    <label for="paiement">Reçu de paiement:</label>
                                                <a href='<?php echo '../uploads/' . $_SESSION['doc']; ?>' >PDF</a>
                                                <button id="deleteFile" type="button">supprimer</button>
                                            </div>
                                        </div>
                        <?php }
                } ?>
                <div class="submit-btn">
                    <input type="submit" value="valider">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<script>
    var logoutBtn = document.getElementById("logout");
    logoutBtn.addEventListener("click",()=>{
        location.href="../controller/EndSession.php";
    })

    var pwd = document.getElementById("password");
  var cpwd = document.getElementById("Cpassword");
  var form =document.getElementById("form");




  cpwd.addEventListener("keyup",(e)=>{
    if(pwd.value != cpwd.value){
      alert.style.display = "block";
      alert.style.color = "red"
      alert.innerText = "Le mot de passe ne correspond pas!";

    }else{
      alert.style.display = "none"
    }
  });

  function submitForm(event){
    if(pwd.value != cpwd.value){
        event.preventDefault();
      }
  }


  var alert = document.getElementById("alert");
  alert.style.display = "none";
  var removeAlert = document.querySelector('.alert');
  setTimeout(() => {
    removeAlert.style.display = "none";
  }, 5000);
  var deleteFile =document.getElementById("deleteFile") || null;
  deleteFile.addEventListener("click",()=>{
    location.href="../controller/removeImage.php";
  })


</script>