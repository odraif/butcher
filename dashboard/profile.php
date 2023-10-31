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
        <div class="modal hide_modal">
            <button>X</button>

        </div>
        <div class="client-form">
            <form action="../controller/userAction.php" method="POST" enctype="multipart/form-data"
                onsubmit="submitForm(event)">

                <div class="group-input">
                    <input type="hidden" name="id"  value='<?php echo $_SESSION['target_id'] ?>'>
                </div>
                
                <div class="group-input">
                    <label for="Nom">Nom et prénom:</label>
                    <input type="text" name="Nom" id="Nom" value='<?php echo $_SESSION['target_name'] ?>'>
                </div>
                <div class="group-input">
                    <label for="Email">Email:</label>
                    <input type="text" name="Email" id="Email" value='<?php echo $_SESSION['target_email'] ?>'>
                </div>
                <div class="group-input">
                    <label for="Numero de telephone">Numero de telephone:</label>
                    <input type="text" name="N_telephone" id="N_telephone"
                        value='<?php echo $_SESSION['target_phone'] ?>'>
                </div>
                <div class="group-input">
                    <label for="Mot de passe">Mot de passe:</label>
                    <input type="password" name="password" id="password">
                </div>
                <div class="group-input">
                    <label for="Confimer mot de passe">Confimer mot de passe:</label>
                    <input type="password" id="Cpassword">
                    <span id="alert"></span>
                </div>
                <div class="group-input">
                    <label for="Valider">Valider:</label>
                    <?php if ($_SESSION['target_valider'] == "non") { ?>
                        <select name="valid" >
                            <option value="non" selected>Non</option>
                            <option value="oui">Oui</option>
                        </select>
                    <?php } else { ?>
                        <select name="valid" >
                            <option value="non">Non</option>
                            <option value="oui" selected>Oui</option>
                        </select>
                    <?php } ?>
                </div>
                <?php if (!$_SESSION['target_doc'] || $_SESSION['target_doc'] == "vide") { ?>
                    <div class="file-upload">
                        <label for="paiement">Reçu de paiement: Aucun reçu</label>

                    </div>
                <?php } else {
                    if (!strpos($_SESSION['target_doc'], '.pdf')) {
                        ?>
                        <div>
                            <div>
                                <label for="paiement">Reçu de paiement:</label>
                                <img src='<?php echo '../uploads/' . $_SESSION['target_doc']; ?>' alt="" style="width:100px"  onclick="modalImage('<?php echo $_SESSION['target_doc']; ?>')">

                            </div>
                        </div>
                    <?php } else {
                        ?>
                        <div>
                            <div>
                                <label for="paiement">Reçu de paiement:</label>
                                <a href='<?php echo '../uploads/' . $_SESSION['target_doc']; ?>' target="_blank">PDF</a>
                            </div>
                        </div>
                    <?php }
                } ?>
                <div class="submit-btn">
                    <input type="submit" value="Mettre à jour">
                    <button onclick="removeuser(event)" type="button">Suppimer l'utilisateur</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
<script>
var logoutBtn = document.getElementById("logout");
logoutBtn.addEventListener("click", () => {
    location.href = "../controller/EndSession.php";
})

function removeuser(e){
    e.preventDefault;
    window.location.href="../controller/removeUser.php?id=<?php echo $_SESSION['target_id'] ?>";
}

var Modal = document.querySelector(".modal");
var closeModel = document.querySelector(".modal button");

function modalImage(srcimg) {
    console.log("clicked")
    const image = document.createElement('img');
    image.src = '../uploads/' + srcimg;
    Modal.appendChild(image);
    Modal.classList.toggle("hide_modal");
    Modal.classList.toggle("show_modal");
}

closeModel.addEventListener("click", () => {
    var imag = document.querySelector(".modal img");
    Modal.classList.toggle("hide_modal");
    Modal.classList.toggle("show_modal");
    imag.remove();
})

var pwd = document.getElementById("password");
var cpwd = document.getElementById("Cpassword");
var form = document.getElementById("form");




cpwd.addEventListener("keyup", (e) => {
    if (pwd.value != cpwd.value) {
        alert.style.display = "block";
        alert.style.color = "red"
        alert.innerText = "Le mot de passe ne correspond pas!";

    } else {
        alert.style.display = "none"
    }
});

function submitForm(event) {
    if (pwd.value != cpwd.value) {
        event.preventDefault();
    }
}


var alert = document.getElementById("alert");
alert.style.display = "none";
var removeAlert = document.querySelector('.alert');
setTimeout(() => {
    removeAlert.style.display = "none";
}, 5000);


</script>