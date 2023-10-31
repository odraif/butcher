<?php
session_start();


if (!$_SESSION && empty($_SESSION["msg"])) {

    header("location: ../");
} else {
    include_once("../model/db.php");
    include_once("../controller/showUser.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../images/a-03.ico" type="image/x-icon">
    <title>Dashboard</title>
</head>

<body>
    <div class="dashboard-page">
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

        <div class="dashboard-content">
            <div class="table-content">
                <div class="filter-table">
                    <label for="afficher">Afficher:</label>
                    <?php
                    switch ($_SESSION['view']) {
                        case "oui": ?>
                            <select name="view" id="view">
                                <option value="all">Tout</option>
                                <option value="non">Non valider</option>
                                <option value="oui" selected>Est valider</option>
                            </select>
                            <?php break;
                        case "non": ?>
                            <select name="view" id="view">
                                <option value="all">Tout</option>
                                <option value="non" selected>Non valider</option>
                                <option value="oui">Est valider</option>
                            </select>
                            <?php break;
                        default: ?>
                            <select name="view" id="view">
                                <option value="all" selected>Tout</option>
                                <option value="non">Non valider</option>
                                <option value="oui">Est valider</option>
                            </select>
                    <?php } ?>
                </div>
                <table>
                    <tr>
                        <th>Id</th>
                        <th>Nom et prénom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>valider</th>
                        <th>Reçu de paiement</th>
                        <th>Action</th>
                    </tr>
                    <?php $nr = 0;
                    foreach ($results as $result) {

                        ?>

                        <tr>
                            <?php if (!$result["isAdmin"]) { ?>
                                <td><?php echo $result["id"];
                                $nr = 1 + $nr; ?></td>
                                <td><?php echo $result["Nom"]; ?></td>
                                <td><?php echo $result["Email"]; ?></td>
                                <td><?php echo $result["N_Telephone"]; ?></td>
                                <td><?php echo $result["Valider"]; ?></td>
                                <?php if ($result['DocName'] != "vide") {
                                    if (!strpos($result['DocName'], '.pdf')) { ?>
                                        <td><img src='<?php echo '../uploads/' . $result['DocName']; ?>' alt="" width="100px"
                                                onclick="modalImage('<?php echo $result['DocName']; ?>')"></td>
                                        <td onclick="getUser(<?php echo $result['id']; ?>)">Voir</td>
                                    <?php } else { ?>
                                        <td><a href='<?php echo '../uploads/' . $result['DocName']; ?>' target="_blank">PDF</a></td>
                                        <td onclick="getUser(<?php echo $result['id']; ?>)">Voir</td>
                                    <?php }
                                } else { ?>
                                    <td>aucun reçu</td>
                                    <td onclick="getUser(<?php echo $result['id']; ?>)">Voir</td>
                                <?php }
                            } ?>

                        </tr>
                    <?php } ?>
                    <tfoot>
                        <td><?php echo "results: " . $nr; ?></td>
                    </tfoot>

                </table>

            </div>
        </div>
    </div>
</body>

</html>
<script>
var logoutBtn = document.getElementById("logout");
logoutBtn.addEventListener("click", () => {
    location.href = "../controller/EndSession.php";
})

function getUser(val) {
    window.location.href = "../controller/userAction.php?s=" + val;
}

var filter = document.querySelector("#view");
filter.addEventListener("change", (e) => {
    window.location.href = './index.php?view=' + e.target.value;
})

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
</script>